<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Internet Connectivity',
                'content' => '<h2>High-Speed Dedicated Internet</h2><p>SuperSpeed Network offers a range of solutions for any business need and budget. We offer internet access services with various service level descriptions for corporates and SMEs that require a premium internet experience, high availability and consistency.</p>',
            ],
            [
                'title' => 'Data Connectivity',
                'content' => '<h2>Secure Data Connectivity</h2><p>Dedicated link can be established using fiber optic or wireless radios between the state-of-the-art POPs and the gateway/router that connects customer LAN. When network ensures excellent quality, high capacity, and low latency connectivity with QoS over the entire network, the data connectivity solution is proved to be working efficiently.</p>',
            ],
            [
                'title' => 'About Us',
                'content' => '<h2>Who We Are</h2><p>SuperSpeed Network is one of the leading Nationwide ISP in Bangladesh. Providing best quality Bandwidth in all over the country with prosper and goodwill. We have GGC server, Facebook server and much more useful content.</p>',
            ],
            [
                'title' => 'Support',
                'content' => '<h2>24/7 Dedicated Support</h2><p>Our highly qualified experience and hardworking largest support team working for marvelous support and showing their dedication to work. Reach out to us via our portal or contact numbers for immediate assistance.</p>',
            ]
        ];

        foreach ($pages as $pageData) {
            $pageData['slug'] = Str::slug($pageData['title']);
            Page::updateOrCreate(['slug' => $pageData['slug']], $pageData);

            // Update the menu item to point to this page
            Menu::where('name', $pageData['title'])->update(['url' => '/' . $pageData['slug']]);
        }
    }
}
