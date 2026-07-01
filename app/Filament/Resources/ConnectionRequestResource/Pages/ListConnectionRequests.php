<?php

namespace App\Filament\Resources\ConnectionRequestResource\Pages;

use App\Filament\Resources\ConnectionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConnectionRequests extends ListRecords
{
    protected static string $resource = ConnectionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
