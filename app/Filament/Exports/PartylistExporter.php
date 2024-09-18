<?php

namespace App\Filament\Exports;

use App\Models\Partylist;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PartylistExporter extends Exporter
{
    protected static ?string $model = Partylist::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('candidates_id'),
            ExportColumn::make('p_date_filling'),
            ExportColumn::make('name_of_partylist'),
            ExportColumn::make('members'),
            ExportColumn::make('p_vision_statement'),
            ExportColumn::make('p_key_priorities'),
            ExportColumn::make('collaboration_plan'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your partylist export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
