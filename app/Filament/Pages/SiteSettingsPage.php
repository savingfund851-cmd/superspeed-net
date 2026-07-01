<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class SiteSettingsPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        return auth()->user()->hasPermission('manage_settings');
    }

    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $S = fn($k, $d='') => SiteSetting::get($k, $d);

        $this->form->fill([
            'site_name'        => $S('site_name', 'SuperSpeed Net'),
            'site_email'       => $S('site_email', 'info@superspeed.net'),
            'site_phone'       => $S('site_phone', '+880 1700-000000'),
            'site_address'     => $S('site_address', ''),
            'hero_subtitle'    => $S('hero_subtitle', "Bangladesh's Fastest Fiber Internet"),
            'packages_heading' => $S('packages_heading', 'Choose Your Perfect Plan'),
            'packages_sub'     => $S('packages_sub', 'All packages include unlimited data, free installation, and BTRC regulatory compliance.'),
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
            'btrc_heading'     => $S('btrc_heading', 'BTRC Licensed & Fully Compliant'),
            'btrc_desc'        => $S('btrc_desc', 'SuperSpeed Net operates under full authorization from the Bangladesh Telecommunication Regulatory Commission (BTRC). All packages are at or below approved tariff ceilings.'),
            'btrc_link_url'    => $S('btrc_link_url', 'https://www.btrc.gov.bd'),
            'btrc_link_lbl'    => $S('btrc_link_lbl', 'View BTRC Tariff Matrix'),
            'cta_heading'      => $S('cta_heading', 'Ready to Get Connected?'),
            'cta_sub'          => $S('cta_sub', 'Call us now or visit our office. Online within 24 hours of sign-up.'),
            'stat_1_val'       => $S('stat_1_val', '5,000+'),
            'stat_1_lbl'       => $S('stat_1_lbl', 'Happy Customers'),
            'stat_2_val'       => $S('stat_2_val', '99.9%'),
            'stat_2_lbl'       => $S('stat_2_lbl', 'Uptime Guarantee'),
            'stat_3_val'       => $S('stat_3_val', '48+'),
            'stat_3_lbl'       => $S('stat_3_lbl', 'Coverage Areas'),
            'stat_4_val'       => $S('stat_4_val', '5+'),
            'stat_4_lbl'       => $S('stat_4_lbl', 'Years of Service'),
            'marquee_1'        => $S('marquee_1', 'BTRC Licensed ISP'),
            'marquee_2'        => $S('marquee_2', 'Starting Price ৳500+'),
            'marquee_3'        => $S('marquee_3', '24/7 NOC Support'),
            'marquee_4'        => $S('marquee_4', 'Zero Throttling Policy'),
            // ── Footer & Social ──
            'footer_brand_text'=> $S('footer_brand_text', "Bangladesh's premium dedicated fiber ISP. Fast, reliable and BTRC compliant since 2020."),
            'footer_copy'      => $S('footer_copy', '© 2024 SuperSpeed Net. All rights reserved.'),
            'developer_name'   => $S('developer_name', 'TR'),
            'social_facebook'  => $S('social_facebook', ''),
            'social_youtube'   => $S('social_youtube', ''),
            'social_instagram' => $S('social_instagram', ''),
            'social_twitter'   => $S('social_twitter', ''),
            'social_whatsapp'  => $S('social_whatsapp', ''),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([

                        // ── TAB 1: General ──────────────────────────────────
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')->label('Site Name')->required(),
                                Forms\Components\TextInput::make('site_email')->label('Contact Email (CTA Button)')->email(),
                                Forms\Components\TextInput::make('site_phone')->label('Contact Phone (CTA Button)')->tel(),
                                Forms\Components\Textarea::make('site_address')->label('Office Address')->rows(3),
                            ]),

                        // ── TAB 2: Homepage Texts ───────────────────────────
                        Forms\Components\Tabs\Tab::make('Homepage Texts')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Hero Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_subtitle')->label('Hero Subtitle'),
                                    ]),

                                Forms\Components\Section::make('Packages Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('packages_heading')->label('Heading'),
                                        Forms\Components\Textarea::make('packages_sub')->label('Sub-text')->rows(2),
                                    ]),

                                Forms\Components\Section::make('Features / Why Choose Us')
                                    ->schema([
                                        Forms\Components\TextInput::make('features_chip')->label('Top Chip Text'),
                                        Forms\Components\TextInput::make('features_heading')->label('Heading'),
                                        Forms\Components\TextInput::make('features_sub')->label('Sub-text'),
                                    ]),

                                Forms\Components\Section::make('BTRC Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('btrc_heading')->label('Heading'),
                                        Forms\Components\Textarea::make('btrc_desc')->label('Description')->rows(3),
                                        Forms\Components\TextInput::make('btrc_link_url')->label('Link URL'),
                                        Forms\Components\TextInput::make('btrc_link_lbl')->label('Link Text'),
                                    ]),

                                Forms\Components\Section::make('Contact / CTA Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_heading')->label('Heading'),
                                        Forms\Components\TextInput::make('cta_sub')->label('Sub-text'),
                                    ]),
                            ]),

                        // ── TAB 3: Feature Cards ────────────────────────────
                        Forms\Components\Tabs\Tab::make('Feature Cards')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\Section::make('Card 1 ⚡')->schema([
                                        Forms\Components\TextInput::make('feat_1_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_1_desc')->label('Description')->rows(2),
                                    ]),
                                    Forms\Components\Section::make('Card 2 🌐')->schema([
                                        Forms\Components\TextInput::make('feat_2_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_2_desc')->label('Description')->rows(2),
                                    ]),
                                    Forms\Components\Section::make('Card 3 🛡️')->schema([
                                        Forms\Components\TextInput::make('feat_3_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_3_desc')->label('Description')->rows(2),
                                    ]),
                                    Forms\Components\Section::make('Card 4 🕐')->schema([
                                        Forms\Components\TextInput::make('feat_4_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_4_desc')->label('Description')->rows(2),
                                    ]),
                                    Forms\Components\Section::make('Card 5 💳')->schema([
                                        Forms\Components\TextInput::make('feat_5_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_5_desc')->label('Description')->rows(2),
                                    ]),
                                    Forms\Components\Section::make('Card 6 📊')->schema([
                                        Forms\Components\TextInput::make('feat_6_title')->label('Title'),
                                        Forms\Components\Textarea::make('feat_6_desc')->label('Description')->rows(2),
                                    ]),
                                ]),
                            ]),

                        // ── TAB 4: Stats Section ────────────────────────────
                        Forms\Components\Tabs\Tab::make('Stats Section')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('stat_1_val')->label('Stat 1 Value (e.g. 5,000+)'),
                                    Forms\Components\TextInput::make('stat_1_lbl')->label('Stat 1 Label'),
                                    Forms\Components\TextInput::make('stat_2_val')->label('Stat 2 Value'),
                                    Forms\Components\TextInput::make('stat_2_lbl')->label('Stat 2 Label'),
                                    Forms\Components\TextInput::make('stat_3_val')->label('Stat 3 Value'),
                                    Forms\Components\TextInput::make('stat_3_lbl')->label('Stat 3 Label'),
                                    Forms\Components\TextInput::make('stat_4_val')->label('Stat 4 Value'),
                                    Forms\Components\TextInput::make('stat_4_lbl')->label('Stat 4 Label'),
                                ]),
                            ]),

                        // ── TAB 5: Animated Marquee ─────────────────────────
                        Forms\Components\Tabs\Tab::make('Animated Marquee')
                            ->icon('heroicon-o-arrow-path')
                            ->schema([
                                Forms\Components\TextInput::make('marquee_1')->label('Marquee Text 1'),
                                Forms\Components\TextInput::make('marquee_2')->label('Marquee Text 2'),
                                Forms\Components\TextInput::make('marquee_3')->label('Marquee Text 3'),
                                Forms\Components\TextInput::make('marquee_4')->label('Marquee Text 4'),
                            ]),

                        // ── TAB 6: Footer & Social Media ─────────────────────
                        Forms\Components\Tabs\Tab::make('Footer & Social')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\Section::make('Footer Text')->schema([
                                    Forms\Components\Textarea::make('footer_brand_text')->label('Brand Description')->rows(2),
                                    Forms\Components\TextInput::make('footer_copy')->label('Copyright Text'),
                                    Forms\Components\TextInput::make('developer_name')->label('Developer Name (Developed by: ?)'),
                                ])->columns(1),
                                Forms\Components\Section::make('Social Media Links')->schema([
                                    Forms\Components\TextInput::make('social_facebook')->label('Facebook URL')->url()->placeholder('https://facebook.com/yourpage'),
                                    Forms\Components\TextInput::make('social_youtube')->label('YouTube URL')->url()->placeholder('https://youtube.com/@yourchannel'),
                                    Forms\Components\TextInput::make('social_instagram')->label('Instagram URL')->url()->placeholder('https://instagram.com/yourpage'),
                                    Forms\Components\TextInput::make('social_twitter')->label('Twitter/X URL')->url()->placeholder('https://x.com/yourhandle'),
                                    Forms\Components\TextInput::make('social_whatsapp')->label('WhatsApp Number')->placeholder('+8801700000000'),
                                ])->columns(2),
                            ]),

                    ])->columnSpanFull()
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            SiteSetting::set($key, $value ?? '');
        }

        // Clear all frontend caches so changes appear immediately
        Cache::forget('site_settings');
        Cache::forget('home_banners');
        Cache::forget('api_menus');
        Cache::forget('api_packages');

        Notification::make()
            ->title('✅ Settings saved successfully!')
            ->success()
            ->send();
    }
}
