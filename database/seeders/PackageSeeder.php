<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name'                  => 'Starter 5 Mbps',
                'speed_mbps'            => 5,
                'price'                 => 500.00,
                'validity_days'         => 30,
                'is_active'             => true,
                'btrc_approved_tariff'  => 600.00,
                'btrc_approval_number'  => 'BTRC/LL/ISP/2024/001',
                'description'           => 'Perfect for light browsing, social media and emails.',
                'features'              => ['5 Mbps Dedicated', 'Unlimited Data', '24/7 Support', 'Free Installation'],
            ],
            [
                'name'                  => 'Home 10 Mbps',
                'speed_mbps'            => 10,
                'price'                 => 900.00,
                'validity_days'         => 30,
                'is_active'             => true,
                'btrc_approved_tariff'  => 1100.00,
                'btrc_approval_number'  => 'BTRC/LL/ISP/2024/002',
                'description'           => 'Ideal for HD streaming, gaming and work from home.',
                'features'              => ['10 Mbps Dedicated', 'Unlimited Data', '24/7 Priority Support', 'Free Router', 'Free Installation'],
            ],
            [
                'name'                  => 'Power 20 Mbps',
                'speed_mbps'            => 20,
                'price'                 => 1500.00,
                'validity_days'         => 30,
                'is_active'             => true,
                'btrc_approved_tariff'  => 1800.00,
                'btrc_approval_number'  => 'BTRC/LL/ISP/2024/003',
                'description'           => 'Perfect for multiple devices, 4K streaming and video calls.',
                'features'              => ['20 Mbps Dedicated', 'Unlimited Data', 'Priority Support', 'Free Router', 'Static IP Available', 'Free Installation'],
            ],
            [
                'name'                  => 'Business 50 Mbps',
                'speed_mbps'            => 50,
                'price'                 => 3500.00,
                'validity_days'         => 30,
                'is_active'             => true,
                'btrc_approved_tariff'  => 4000.00,
                'btrc_approval_number'  => 'BTRC/LL/ISP/2024/004',
                'description'           => 'Enterprise-grade connection for offices and businesses.',
                'features'              => ['50 Mbps Dedicated', 'Unlimited Data', 'Dedicated Support Manager', 'Static IP Included', 'SLA Guaranteed', 'Free Installation'],
            ],
            [
                'name'                  => 'Enterprise 100 Mbps',
                'speed_mbps'            => 100,
                'price'                 => 6000.00,
                'validity_days'         => 30,
                'is_active'             => true,
                'btrc_approved_tariff'  => 7000.00,
                'btrc_approval_number'  => 'BTRC/LL/ISP/2024/005',
                'description'           => 'Maximum speed for large offices, ISP resellers and data centers.',
                'features'              => ['100 Mbps Dedicated', 'Unlimited Data', '24/7 NOC Support', 'Multiple Static IPs', 'SLA 99.9% Uptime', 'BGP Routing Available', 'Free Installation'],
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(['name' => $package['name']], $package);
        }
    }
}
