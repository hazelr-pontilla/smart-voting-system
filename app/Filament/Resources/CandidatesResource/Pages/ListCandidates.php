<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Enums\YearLevel;
use App\Filament\Resources\CandidatesResource;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;

class ListCandidates extends ListRecords
{
    protected static string $resource = CandidatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-user-plus'),
        ];
    }

}
