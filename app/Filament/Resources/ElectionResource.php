<?php

namespace App\Filament\Resources;

use App\Enums\Position;
use App\Filament\Exports\ElectionExporter;
use App\Filament\Resources\ElectionResource\Pages;
use App\Filament\Resources\ElectionResource\RelationManagers;
use App\Models\Election;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;


class ElectionResource extends Resource
{
    protected static ?string $model = Election::class;
    protected static ?string $modelLabel = 'ELECTION PARTYLIST';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'For Students';

    protected static ?string $navigationIcon = 'heroicon-m-finger-print';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('VOTE WISELY!')
                ->schema([
                    Forms\Components\Select::make('election_id')
                        ->label('Partylist')
                        ->relationship('election_id', 'name_of_partylist'),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('election_id.name_of_partylist')
                ->label('Partylist Name'),
                Tables\Columns\TextColumn::make('created_at')
                ->date(),
            ])
            ->filters([
                //
            ])

            ->headerActions([
                ExportAction::make()
                    ->exporter(ElectionExporter::class)
                    ->label('Export this')
                    ->icon('heroicon-m-arrow-down-circle')
                    ->size(ActionSize::Small)
                    ->color('success')
            ])

            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->successNotificationTitle('Updated successfully!')
                        ->color('warning')
                        ->label('Update')
                        ->slideOver()
                    ->hidden(!auth()->user()->hasPermission('candidate_update')),



                ])->tooltip('Actions')
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->dropdownPlacement('top-start')

            ], position: Tables\Enums\ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListElections::route('/'),
//            'create' => Pages\CreateElection::route('/create'),
//            'edit' => Pages\EditElection::route('/{record}/edit'),
        ];
    }
}
