<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('All Users', User::whereNot('role', 'admin')->count())
            ->description('All users currently registered on platform')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make('Listeners', User::where('role', 'user')->count())
            ->description('Total number of listeners')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make('Artists', User::where('role', 'artist')->count())
            ->description('All artists on platform')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
        ];
    }
}
