<?php

namespace App\Filament\Resources\KandidatoResource\Pages;

use App\Filament\Resources\KandidatoResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;

class ListKandidatos extends ListRecords
{
    protected static string $resource = KandidatoResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\CreateAction::make()
                ->label('MAKE MY VOTE COUNT!')
                ->color('success')
                ->icon('heroicon-m-finger-print'),

        ];
    }
}
