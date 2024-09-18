<?php

namespace App\Filament\Resources;

use App\Filament\Exports\PartylistExporter;
use App\Filament\Resources\CandidatesResource\RelationManagers\CandidateRelationManager;
use App\Filament\Resources\CandidatesResource\RelationManagers\CandidatesRelationManager;
use App\Filament\Resources\CandidatesResource\RelationManagers\PartyRelationManager;
use App\Filament\Resources\PartylistResource\Pages;
use App\Filament\Resources\PartylistResource\RelationManagers;
use App\Models\Partylist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartylistResource extends Resource
{
    protected static ?string $model = Partylist::class;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'MANAGE';
    protected static ?int $navigationSort = 2;


    protected static ?string $navigationIcon = 'heroicon-m-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Information')
                ->schema([
                   Forms\Components\DatePicker::make('p_date_filling')
                   ->date()
                   ->label('Date of Filing'),

                   Forms\Components\TextInput::make('name_of_partylist')
                   ->label('Name of Partylist'),

                    Forms\Components\Select::make('candidates_id')
                    ->label('President of the Partylist')
                    ->preload()
                    ->searchable()
                    ->relationship('candidates', 'fullname')


                ])->columns(3),

                Forms\Components\Section::make('')
                ->schema([
                    Forms\Components\TextInput::make('p_vision_statement')
                    ->label('Vision Statement'),

                    Forms\Components\TextInput::make('p_key_priorities')
                    ->label('Key Priorities'),

                    Forms\Components\TextInput::make('collaboration_plan')
                    ->label('Collaboration Plan')
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('p_date_filling')
                ->label('Date of Filing')
                ->date()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name_of_partylist')
                ->label('Name of the Partylist')
                ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('candidates.fullname')
                ->label('President of the Partylist')
                ->badge()
                ->color('success')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('p_vision_statement')
                ->label('Vision Statement')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('p_key_priorities')
                ->label('Key Priorities')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('collaboration_plan')
                ->label('Collaboration Plan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])

            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->successNotificationTitle('Updated successfully!')
                        ->color('warning')
                        ->label('Update')
                        ->slideOver(),

                    Tables\Actions\DeleteAction::make()
                        ->color('danger'),

                    Tables\Actions\RestoreAction::make()
                        ->label('Restore')
                        ->color('info'),

                ])->tooltip('Actions')
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->dropdownPlacement('top-start')

            ], position: Tables\Enums\ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(PartylistExporter::class)
                        ->label('Export this')
                        ->icon('heroicon-m-arrow-down-circle')
                        ->size(ActionSize::Small)
                        ->color('success')
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PersonsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartylists::route('/'),
            'create' => Pages\CreatePartylist::route('/create'),
            'edit' => Pages\EditPartylist::route('/{record}/edit'),
        ];
    }
}
