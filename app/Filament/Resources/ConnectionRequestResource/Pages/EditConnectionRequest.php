<?php

namespace App\Filament\Resources\ConnectionRequestResource\Pages;

use App\Filament\Resources\ConnectionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConnectionRequest extends EditRecord
{
    protected static string $resource = ConnectionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
