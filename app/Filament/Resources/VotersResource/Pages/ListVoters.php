<?php

namespace App\Filament\Resources\VotersResource\Pages;

use App\Filament\Resources\VotersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoters extends ListRecords
{
    protected static string $resource = VotersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-user-plus'),
        ];
    }
}
