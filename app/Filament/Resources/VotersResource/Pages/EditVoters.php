<?php

namespace App\Filament\Resources\VotersResource\Pages;

use App\Filament\Resources\VotersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoters extends EditRecord
{
    protected static string $resource = VotersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
