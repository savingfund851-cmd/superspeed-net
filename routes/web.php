<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();

    // Single DB call for ALL settings (cached 10 min via SiteSetting model)
    $S = fn($k, $d='') => \App\Models\SiteSetting::get($k, $d);

    $settings = [
        // ── General ──
        'site_name'        => $S('site_name', 'SuperSpeed Net'),
        'site_phone'       => $S('site_phone', '+880 1700-000000'),
        'site_email'       => $S('site_email', 'info@superspeed.net'),
        'site_address'     => $S('site_address', ''),
        // ── Hero ──
        'hero_subtitle'    => $S('hero_subtitle', "Bangladesh's Fastest Fiber Internet"),
        // ── Packages ──
        'packages_heading' => $S('packages_heading', 'Choose Your Perfect Plan'),
        'packages_sub'     => $S('packages_sub', 'All packages include unlimited data, free installation, and BTRC regulatory compliance.'),
        // ── Features ──
        'features_chip'    => $S('features_chip', 'Why Choose Us'),
        'features_heading' => $S('features_heading', 'Built for Speed & Reliability'),
        'features_sub'     => $S('features_sub', 'Enterprise-grade infrastructure for every customer.'),
        'feat_1_title'     => $S('feat_1_title', 'Dedicated Bandwidth'),
        'feat_1_desc'      => $S('feat_1_desc', 'Your speed is yours alone. No sharing, no slowdowns during peak hours. Guaranteed 24/7.'),
        'feat_2_title'     => $S('feat_2_title', 'Fiber Optic Network'),
        'feat_2_desc'      => $S('feat_2_desc', 'Ultra-low latency fiber connecting you to the world at the speed of light.'),
        'feat_3_title'     => $S('feat_3_title', '99.9% Uptime SLA'),
        'feat_3_desc'      => $S('feat_3_desc', 'Mission-critical reliability backed by a Service Level Agreement.'),
        'feat_4_title'     => $S('feat_4_title', '24/7 NOC Support'),
        'feat_4_desc'      => $S('feat_4_desc', 'Round-the-clock Network Operations Center monitoring with instant response.'),
        'feat_5_title'     => $S('feat_5_title', 'Easy Online Payment'),
        'feat_5_desc'      => $S('feat_5_desc', 'Pay with bKash, Nagad, Cards or Bank Transfer. Automated renewal reminders.'),
        'feat_6_title'     => $S('feat_6_title', 'Usage Dashboard'),
        'feat_6_desc'      => $S('feat_6_desc', 'Real-time usage monitoring, billing history and support tickets from your portal.'),
        // ── BTRC ──
        'btrc_heading'     => $S('btrc_heading', 'BTRC Licensed & Fully Compliant'),
        'btrc_desc'        => $S('btrc_desc', 'SuperSpeed Net operates under full authorization from the Bangladesh Telecommunication Regulatory Commission (BTRC). All packages are at or below approved tariff ceilings.'),
        'btrc_link_url'    => $S('btrc_link_url', 'https://www.btrc.gov.bd'),
        'btrc_link_lbl'    => $S('btrc_link_lbl', 'View BTRC Tariff Matrix'),
        // ── CTA ──
        'cta_heading'      => $S('cta_heading', 'Ready to Get Connected?'),
        'cta_sub'          => $S('cta_sub', 'Call us now or visit our office. Online within 24 hours of sign-up.'),
        // ── Stats ──
        'stat_1_val'       => $S('stat_1_val', '5,000+'),
        'stat_1_lbl'       => $S('stat_1_lbl', 'Happy Customers'),
        'stat_2_val'       => $S('stat_2_val', '99.9%'),
        'stat_2_lbl'       => $S('stat_2_lbl', 'Uptime Guarantee'),
        'stat_3_val'       => $S('stat_3_val', '48+'),
        'stat_3_lbl'       => $S('stat_3_lbl', 'Coverage Areas'),
        'stat_4_val'       => $S('stat_4_val', '5+'),
        'stat_4_lbl'       => $S('stat_4_lbl', 'Years of Service'),
        // ── Marquee ──
        'marquee_1'           => $S('marquee_1', 'BTRC Licensed ISP'),
        'marquee_2'           => $S('marquee_2', 'Starting Price ৳500+'),
        'marquee_3'           => $S('marquee_3', '24/7 NOC Support'),
        'marquee_4'           => $S('marquee_4', 'Zero Throttling Policy'),
        // ── Footer ──
        'footer_brand_text'   => $S('footer_brand_text', "Bangladesh's premium dedicated fiber ISP. Fast, reliable and BTRC compliant since 2020."),
        'footer_copy'         => $S('footer_copy', '© 2024 SuperSpeed Net. All rights reserved.'),
        'developer_name'      => $S('developer_name', 'TR'),
        // ── Social Media ──
        'social_facebook'     => $S('social_facebook', '#'),
        'social_youtube'      => $S('social_youtube', '#'),
        'social_instagram'    => $S('social_instagram', '#'),
        'social_twitter'      => $S('social_twitter', '#'),
        'social_whatsapp'     => $S('social_whatsapp', '#'),
    ];
    return view('welcome', compact('banners', 'settings'));
});

Route::get('/dashboard', [\App\Http\Controllers\CustomerPortalController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment Routes
    Route::post('/payment/pay', [\App\Http\Controllers\PaymentController::class, 'pay'])->name('payment.pay');
});

// Language Switcher
Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');

// Quick Pay Routes (Public)
Route::get('/quick-pay', [\App\Http\Controllers\PaymentController::class, 'showQuickPay'])->name('quick-pay');
Route::post('/quick-pay/process', [\App\Http\Controllers\PaymentController::class, 'processQuickPay'])->name('quick-pay.process');

// Gateway Callbacks (Must be outside auth as gateway redirects back)
Route::get('/payment/callback', [\App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');

Route::get('/new-connection', [\App\Http\Controllers\NewConnectionController::class, 'create'])->name('new-connection');
Route::post('/new-connection', [\App\Http\Controllers\NewConnectionController::class, 'store'])->name('new-connection.store');

// Support Ticket Routes (Public view, auth required for create/reply)
Route::get('/support', [\App\Http\Controllers\SupportController::class, 'index'])->name('support.index');
Route::middleware('auth')->group(function () {
    Route::get('/support/create', [\App\Http\Controllers\SupportController::class, 'create'])->name('support.create');
    Route::post('/support', [\App\Http\Controllers\SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket}', [\App\Http\Controllers\SupportController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}/reply', [\App\Http\Controllers\SupportController::class, 'reply'])->name('support.reply');
});

// Auth routes must come before the slug catch-all
require __DIR__.'/auth.php';

// ⚠️ Catch-all slug route — must be LAST
Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');
