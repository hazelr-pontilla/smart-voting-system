<?php

namespace App\Filament\Exports;

use App\Models\Candidates;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CandidatesExporter extends Exporter
{
    protected static ?string $model = Candidates::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('date_filing'),
            ExportColumn::make('student_id'),
            ExportColumn::make('position'),
            ExportColumn::make('fullname'),
            ExportColumn::make('gender'),
            ExportColumn::make('email'),
            ExportColumn::make('c_year_level'),
            ExportColumn::make('c_course'),
            ExportColumn::make('motivation'),
            ExportColumn::make('key_issues'),
            ExportColumn::make('key_solutions'),
            ExportColumn::make('plan_to_action'),
            ExportColumn::make('conclusion'),
            ExportColumn::make('vision_statement'),
            ExportColumn::make('key_priorities'),
            ExportColumn::make('action_plan'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your candidates export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
