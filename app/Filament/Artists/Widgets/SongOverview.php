<?php

namespace App\Filament\Artists\Widgets;

use App\Models\Song;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SongOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Songs Count', Song::where('user_id', auth()->user()->id)->count())
            ->description('Total uploaded songs on platform')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make('Streams', Song::where('user_id', auth()->user()->id)->sum('song_streams'))
            ->description('Total streams on platform')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make('Avr. Streams', Song::where('user_id', auth()->user()->id)->avg('song_streams'))
            ->description('Average streams per song on platform')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')

        ];
    }
}
