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
        'hero_subtitle'       => $S('hero_subtitle', "Bangladesh's Fastest Fiber Internet"),
        'hero_description'    => $S('hero_description', "Blazing-fast dedicated bandwidth with zero throttling. Powering homes and businesses across Bangladesh with enterprise-grade fiber."),
        'hero_network_speed'  => $S('hero_network_speed', '1024'),
        'hero_uptime'         => $S('hero_uptime', '99.9%'),
        'hero_latency'        => $S('hero_latency', '2ms'),
        'hero_active_clients' => $S('hero_active_clients', '1,200+'),
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
        // 💳 CTA 💳
        'pay_bill_instruction' => $S('pay_bill_instruction', 'Payment can be made via bKash and Nagad.
Payment number: 01608430537'),
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
    $packages = Cache::remember('api_packages', 300, function () {
        return \App\Models\Package::where('is_active', true)
            ->orderBy('price', 'asc')
            ->get(['id', 'name', 'speed_mbps', 'price', 'validity_days',
                   'btrc_approved_tariff', 'btrc_approval_number',
                   'description', 'features'])->toArray();
    });

    $menus = Cache::remember('api_menus', 300, function () {
        return \App\Models\Menu::with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()->toArray();
    });

    return view('welcome', compact('banners', 'settings', 'packages', 'menus'));
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

Route::get('/reset-admin', function () {
    $user = \App\Models\User::firstOrCreate(
        ['email' => 'admin@superspeed.net'],
        ['name' => 'Super Admin', 'phone' => '01700000000', 'role' => 'superadmin', 'status' => 'active']
    );
    $user->password = \Illuminate\Support\Facades\Hash::make('Admin@12345');
    $user->role = 'superadmin';
    $user->save();
    return 'Admin user reset successful. Email: admin@superspeed.net, Password: Admin@12345';
});

// ─── TEMPORARY STORAGE EXPORT (will be removed after migration) ───────────────
Route::get('/export-storage-9988', function () {
    $storagePath = storage_path('app/public');
    $zipFileName = storage_path('app/storage-export.zip');

    $zip = new ZipArchive;
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        if (is_dir($storagePath)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($storagePath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath     = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($storagePath) + 1);
                    $zip->addFile($filePath, str_replace('\\', '/', $relativePath));
                }
            }
        }
        $zip->close();
    }

    return response()->download($zipFileName)->deleteFileAfterSend(true);
});

// Auth routes must come before the slug catch-all
require __DIR__.'/auth.php';

// ─── EMBEDDABLE NAVBAR SCRIPT ─────────────────────────────────────────────────
Route::get('/navbar.js', function () {
    $menus = \Illuminate\Support\Facades\Cache::remember('api_menus_embed', 120, function () {
        return \App\Models\Menu::with(['children' => function ($q) {
            $q->where('is_active', true)->orderBy('order');
        }])
        ->whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('order')
        ->get()
        ->toArray();
    });

    $siteUrl    = rtrim(config('app.url'), '/');
    $menusJson  = json_encode($menus, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    // Build JS using PHP string concatenation to avoid template-literal conflicts inside HEREDOC
    $js = '(function() {
    var SITE_URL = ' . json_encode($siteUrl) . ';
    var menus    = ' . $menusJson . ';

    /* ── Inject CSS ── */
    var css = [
        "#superspeed-navbar-wrap{position:fixed;top:14px;left:50%;transform:translateX(-50%);width:calc(100% - 32px);max-width:1280px;z-index:99999;display:grid;grid-template-columns:auto 1fr auto;align-items:center;background:rgba(2,8,23,0.88);backdrop-filter:blur(20px) saturate(1.8);border:1px solid rgba(255,255,255,0.09);border-radius:16px;padding:10px 20px;gap:16px;transition:background .3s,box-shadow .3s;}",
        "#superspeed-navbar-wrap.scrolled{background:rgba(2,8,23,0.98);box-shadow:0 8px 32px rgba(0,0,0,0.4);}",
        ".ssn-logo-link{display:flex;align-items:center;gap:10px;text-decoration:none;}",
        ".ssn-logo-img{height:36px;width:auto;}",
        ".ssn-brand{font-weight:700;font-size:15px;color:#fff;line-height:1;display:flex;flex-direction:column;gap:2px;}",
        ".ssn-brand .ssn-top{color:#22d3ee;letter-spacing:1px;}",
        ".ssn-brand .ssn-bot{font-size:10px;font-weight:400;letter-spacing:4px;opacity:.7;}",
        ".ssn-links{display:flex;align-items:center;justify-content:center;gap:4px;list-style:none;flex-wrap:wrap;}",
        ".ssn-links li a{color:rgba(255,255,255,.75);text-decoration:none;font-size:14px;font-weight:500;padding:6px 14px;border-radius:8px;transition:color .2s,background .2s;display:flex;align-items:center;gap:4px;}",
        ".ssn-links li a:hover{color:#22d3ee;background:rgba(34,211,238,.08);}",
        ".ssn-dropdown-wrap{position:relative;}",
        ".ssn-dropdown{position:absolute;top:calc(100% + 12px);left:50%;transform:translateX(-50%) scale(.95);min-width:180px;background:rgba(2,8,23,.97);border:1px solid rgba(34,211,238,.15);border-radius:12px;padding:8px;opacity:0;pointer-events:none;transition:opacity .2s,transform .2s;}",
        ".ssn-dropdown a{display:block;padding:8px 14px;color:rgba(255,255,255,.75);font-size:13px;border-radius:8px;text-decoration:none;transition:background .15s,color .15s;}",
        ".ssn-dropdown a:hover{background:rgba(34,211,238,.1);color:#22d3ee;}",
        ".ssn-dropdown-wrap:hover .ssn-dropdown,.ssn-dropdown-wrap:focus-within .ssn-dropdown{opacity:1;pointer-events:all;transform:translateX(-50%) scale(1);}",
        ".ssn-actions{display:flex;align-items:center;gap:12px;}",
        ".ssn-login-btn{display:flex;align-items:center;gap:6px;background:linear-gradient(135deg,#0ea5e9,#22d3ee);color:#fff;text-decoration:none;font-size:13px;font-weight:600;padding:8px 18px;border-radius:10px;transition:opacity .2s,transform .2s;}",
        ".ssn-login-btn:hover{opacity:.9;transform:translateY(-1px);}",
        ".ssn-hamburger{display:none;flex-direction:column;justify-content:center;gap:5px;background:none;border:none;cursor:pointer;padding:4px;width:34px;height:34px;}",
        ".ssn-hamburger span{display:block;height:2px;border-radius:2px;background:rgba(255,255,255,.75);transition:.3s;}",
        "#ssn-overlay{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:99998;opacity:0;pointer-events:none;transition:opacity .3s;}",
        "#ssn-overlay.open{opacity:1;pointer-events:all;}",
        "#ssn-sidebar{position:fixed;top:0;right:-320px;width:300px;height:100dvh;background:rgba(2,8,23,.98);border-left:1px solid rgba(34,211,238,.12);z-index:99999;padding:24px 16px;display:flex;flex-direction:column;gap:8px;overflow-y:auto;transition:right .35s cubic-bezier(.4,0,.2,1);}",
        "#ssn-sidebar.open{right:0;}",
        ".ssn-sb-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.08);}",
        ".ssn-sb-brand{color:#fff;font-weight:700;font-size:16px;}",
        ".ssn-sb-close{background:rgba(255,255,255,.08);border:none;color:#fff;width:32px;height:32px;border-radius:8px;cursor:pointer;font-size:16px;}",
        ".ssn-sb-link{display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:15px;padding:12px 14px;border-radius:10px;transition:background .2s;}",
        ".ssn-sb-link:hover{background:rgba(34,211,238,.1);color:#22d3ee;}",
        ".ssn-sb-sub a{display:block;color:rgba(255,255,255,.6);text-decoration:none;padding:9px 14px 9px 42px;font-size:14px;border-radius:8px;}",
        ".ssn-sb-sub a:hover{background:rgba(34,211,238,.08);color:#22d3ee;}",
        "@media(max-width:900px){.ssn-links{display:none!important;}.ssn-hamburger{display:flex!important;}}"
    ].join("");
    var styleEl = document.createElement("style");
    styleEl.textContent = css;
    document.head.appendChild(styleEl);

    /* ── Google Font ── */
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap";
    document.head.appendChild(link);

    /* ── Build menu HTML ── */
    var icons = {"Home":"🏠","Packages":"📦","Support":"🎧","Contact":"📞","About Us":"ℹ️","BTRC Tariff":"📄","New Connection":"🔗"};
    var linksHtml = "";
    var sidebarHtml = "";

    menus.forEach(function(menu) {
        if (menu.hide_navbar) return;
        var name = menu.name;
        var url  = menu.url || "#";

        if (menu.children && menu.children.length > 0) {
            var childLinks = menu.children.map(function(c){
                return "<a href=\"" + c.url + "\">" + c.name + "</a>";
            }).join("");
            linksHtml += "<li class=\"ssn-dropdown-wrap\"><a href=\"" + url + "\">" + name + " &#9662;</a><div class=\"ssn-dropdown\">" + childLinks + "</div></li>";

            var childSb = menu.children.map(function(c){
                return "<a href=\"" + c.url + "\">" + c.name + "</a>";
            }).join("");
            sidebarHtml += "<a href=\"" + url + "\" class=\"ssn-sb-link\">" + (icons[name] || "🔹") + " " + name + "</a><div class=\"ssn-sb-sub\">" + childSb + "</div>";
        } else {
            linksHtml   += "<li><a href=\"" + url + "\">" + name + "</a></li>";
            sidebarHtml += "<a href=\"" + url + "\" class=\"ssn-sb-link\">" + (icons[name] || "🔹") + " " + name + "</a>";
        }
    });

    /* ── Inject Navbar ── */
    var navHtml =
        "<a href=\"" + SITE_URL + "\" class=\"ssn-logo-link\">" +
            "<img src=\"" + SITE_URL + "/images/logo.png\" alt=\"SuperSpeed\" class=\"ssn-logo-img\">" +
            "<span class=\"ssn-brand\"><span class=\"ssn-top\">SUPER SPEED</span><span class=\"ssn-bot\">NET</span></span>" +
        "</a>" +
        "<ul class=\"ssn-links\">" + linksHtml + "</ul>" +
        "<div class=\"ssn-actions\">" +
            "<a href=\"" + SITE_URL + "/login\" class=\"ssn-login-btn\">&#128274; Login</a>" +
            "<button class=\"ssn-hamburger\" id=\"ssnHamburger\"><span></span><span></span><span></span></button>" +
        "</div>";

    var target = document.getElementById("superspeed-navbar");
    if (!target) { target = document.createElement("div"); document.body.prepend(target); }
    target.id = "superspeed-navbar-wrap";
    target.innerHTML = navHtml;

    /* ── Inject Sidebar ── */
    var overlay = document.createElement("div"); overlay.id = "ssn-overlay";
    var sidebar = document.createElement("aside"); sidebar.id = "ssn-sidebar";
    sidebar.innerHTML =
        "<div class=\"ssn-sb-header\">" +
            "<span class=\"ssn-sb-brand\">SuperSpeed NET</span>" +
            "<button class=\"ssn-sb-close\" id=\"ssnClose\">&#x2715;</button>" +
        "</div>" + sidebarHtml;
    document.body.appendChild(overlay);
    document.body.appendChild(sidebar);

    /* ── Events ── */
    function openSidebar()  { sidebar.classList.add("open"); overlay.classList.add("open"); document.body.style.overflow = "hidden"; }
    function closeSidebar() { sidebar.classList.remove("open"); overlay.classList.remove("open"); document.body.style.overflow = ""; }

    document.getElementById("ssnHamburger").addEventListener("click", openSidebar);
    document.getElementById("ssnClose").addEventListener("click", closeSidebar);
    overlay.addEventListener("click", closeSidebar);
    document.addEventListener("keydown", function(e){ if(e.key === "Escape") closeSidebar(); });

    /* ── Scroll class ── */
    window.addEventListener("scroll", function(){
        target.classList.toggle("scrolled", window.scrollY > 60);
    }, { passive: true });

    /* ── Body padding ── */
    if (!document.querySelector("style[data-ssn-pad]")) {
        var padStyle = document.createElement("style");
        padStyle.setAttribute("data-ssn-pad", "1");
        padStyle.textContent = "body{padding-top:80px!important;}";
        document.head.appendChild(padStyle);
    }
})();';

    return response($js, 200)
        ->header('Content-Type', 'application/javascript; charset=utf-8')
        ->header('Cache-Control', 'public, max-age=60')
        ->header('Access-Control-Allow-Origin', '*');
})->name('navbar.embed');



// ⚠️ Catch-all slug route — must be LAST
Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');

