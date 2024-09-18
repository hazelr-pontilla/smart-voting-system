<?php

namespace App\Filament\Resources\KandidatoResource\Pages;

use App\Filament\Resources\KandidatoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKandidato extends EditRecord
{
    protected static string $resource = KandidatoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
