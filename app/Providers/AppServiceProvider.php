<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share $settings globally to ALL blade views
        View::composer('*', function ($view) {
            $S = fn($k, $d = '') => \App\Models\SiteSetting::get($k, $d);

            $settings = [
                'site_name'           => $S('site_name', 'SuperSpeed Net'),
                'site_phone'          => $S('site_phone', '+880 1700-000000'),
                'site_email'          => $S('site_email', 'info@superspeed.net'),
                'site_address'        => $S('site_address', ''),
                'footer_brand_text'   => $S('footer_brand_text', "Bangladesh's premium dedicated fiber ISP. Fast, reliable and BTRC compliant since 2020."),
                'footer_copy'         => $S('footer_copy', '© 2024 SuperSpeed Net. All rights reserved.'),
                'developer_name'      => $S('developer_name', 'TR'),
                'btrc_link_url'       => $S('btrc_link_url', 'https://www.btrc.gov.bd'),
                'social_facebook'     => $S('social_facebook', '#'),
                'social_youtube'      => $S('social_youtube', '#'),
                'social_instagram'    => $S('social_instagram', '#'),
                'social_twitter'      => $S('social_twitter', '#'),
                'social_whatsapp'     => $S('social_whatsapp', '#'),
            ];

            // Only share if not already set (so welcome.blade.php's richer $settings wins)
            if (! $view->offsetExists('settings')) {
                $view->with('settings', $settings);
            }
        });
    }
}
