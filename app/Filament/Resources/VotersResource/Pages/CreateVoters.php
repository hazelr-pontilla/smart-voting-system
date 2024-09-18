<?php

namespace App\Filament\Resources\VotersResource\Pages;

use App\Filament\Resources\VotersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVoters extends CreateRecord
{
    protected static string $resource = VotersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
