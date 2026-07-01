<?php

namespace App\Filament\Widgets;

use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Ticket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', User::where('role', 'customer')->count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 12, 18, 24, 30, 35, 42]),

            Stat::make('Active Subscriptions', Subscription::where('status', 'active')->count())
                ->description('Currently active')
                ->descriptionIcon('heroicon-m-signal')
                ->color('info')
                ->chart([3, 8, 12, 15, 20, 25, 30]),

            Stat::make('Revenue (BDT)', '৳' . number_format(Payment::where('status', 'completed')->sum('amount'), 0))
                ->description('Total collected')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning')
                ->chart([500, 1200, 2400, 3600, 5000, 7200, 9000]),

            Stat::make('Open Tickets', Ticket::whereIn('status', ['open', 'in_progress'])->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('danger')
                ->chart([5, 3, 7, 4, 2, 6, 3]),

            Stat::make('Active Packages', Package::where('is_active', true)->count())
                ->description('Available plans')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Payments', Payment::count())
                ->description('All transactions')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('info'),
        ];
    }
}
