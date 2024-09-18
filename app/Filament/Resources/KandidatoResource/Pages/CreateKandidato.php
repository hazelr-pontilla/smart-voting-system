<?php

namespace App\Filament\Resources\KandidatoResource\Pages;

use App\Filament\Resources\KandidatoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKandidato extends CreateRecord
{
    protected static string $resource = KandidatoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
