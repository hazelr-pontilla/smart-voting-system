<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\YearLevel;
use App\Filament\Exports\VotersExporter;
use App\Filament\Resources\VotersResource\Pages;
use App\Filament\Resources\VotersResource\RelationManagers;
use App\Models\Voters;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VotersResource extends Resource
{
    protected static ?string $model = Voters::class;
    protected static ?string $navigationGroup = 'MANAGE';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 1;


    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('PROFILE')
                ->schema([
                    Forms\Components\TextInput::make('voters_id')
                        ->label('Voters ID')
                        ->unique(ignoreRecord: true)
                        ->autofocus(),

                    Forms\Components\TextInput::make('voters_fullname')
                        ->label('Students Fullname'),

                    Forms\Components\Select::make('gender')
                        ->label('Gender')
                    ->options([
                        'Male' => Gender::MALE->value,
                        'Female' => Gender::FEMALE->value,
                    ]),

                    Forms\Components\TextInput::make('email')
                        ->label('EVSU Email'),

                    Forms\Components\Select::make('v_year_level')
                    ->label('Year Level')
                    ->options([
                        'Freshman' => YearLevel::FRESHMAN->value,
                        'Sophomore' => YearLevel::SOPHOMORE->value,
                        'Junior' => YearLevel::JUNIOR->value,
                        'Senior' => YearLevel::SENIOR->value,
                    ]),

                    Forms\Components\Select::make('v_course')
                        ->searchable()
                    ->label('Course')
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('voters_id')
                ->label('Voters ID')
                ->badge()
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('voters_fullname')
                ->label('Students Fullname')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('gender')
                ->label('Gender')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                ->label('EVSU Email')
                    ->iconColor('warning')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->copyMessage('Email address copied!')
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('v_year_level')
                ->label('Year Level')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('v_course')
                ->label('Course')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])

            ->headerActions([
                ExportAction::make()
                    ->exporter(VotersExporter::class)
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
            'index' => Pages\ListVoters::route('/'),
            'create' => Pages\CreateVoters::route('/create'),
            'edit' => Pages\EditVoters::route('/{record}/edit'),
        ];
    }
}
