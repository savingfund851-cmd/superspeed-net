<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Home', 'url' => '/', 'order' => 1],
            ['name' => 'Packages', 'url' => '#packages', 'order' => 2],
            [
                'name' => 'Our Service',
                'url' => '#',
                'order' => 3,
                'children' => [
                    ['name' => 'Internet Connectivity', 'url' => '#features', 'order' => 1],
                    ['name' => 'Data Connectivity', 'url' => '#', 'order' => 2],
                    ['name' => 'WAN', 'url' => '#', 'order' => 3],
                    ['name' => 'Email Hosting Service', 'url' => '#', 'order' => 4],
                    ['name' => 'Our Offerings', 'url' => '#', 'order' => 5],
                    ['name' => 'CCTV & IP Surveillance', 'url' => '#', 'order' => 6],
                    ['name' => 'Corporate IP-VPN services', 'url' => '#', 'order' => 7],
                ]
            ],
            ['name' => 'Bill Payment', 'url' => '/login', 'order' => 4],
            [
                'name' => 'Contact',
                'url' => '#contact',
                'order' => 5,
                'children' => [
                    ['name' => 'About Us', 'url' => '#', 'order' => 1],
                    ['name' => 'Jobs', 'url' => '#', 'order' => 2],
                    ['name' => 'Support', 'url' => '#', 'order' => 3],
                ]
            ],
            ['name' => 'SuperSpeed Network APP', 'url' => '#', 'order' => 6],
            ['name' => 'BTRC Tariff', 'url' => 'https://www.btrc.gov.bd', 'order' => 7],
            ['name' => 'New Connection', 'url' => '#contact', 'order' => 8],
        ];

        foreach ($menus as $menuData) {
            $children = $menuData['children'] ?? [];
            unset($menuData['children']);
            
            $parent = Menu::updateOrCreate(['name' => $menuData['name']], $menuData);
            
            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                Menu::updateOrCreate(['name' => $childData['name']], $childData);
            }
        }
    }
}
