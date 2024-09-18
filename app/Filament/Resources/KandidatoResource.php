<?php

namespace App\Filament\Resources;

use App\Enums\Course;
use App\Enums\Position;
use App\Enums\YearLevel;
use App\Filament\Exports\KandidatoExporter;
use App\Filament\Resources\KandidatoResource\Pages;
use App\Filament\Resources\KandidatoResource\RelationManagers;
use App\Models\Candidates;
use App\Models\Kandidato;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class KandidatoResource extends Resource
{
    protected static ?string $model = Kandidato::class;

    protected static ?string $modelLabel = 'ELECTION CANDIDATES';
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

                Forms\Components\Section::make('Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->label('Enter your Fullname')
                    ->unique(ignoreRecord: true),

                    Forms\Components\Select::make('year')
                    ->label('Year Level')
                        ->options([
                            'Freshman' => YearLevel::FRESHMAN->value,
                            'Sophomore' => YearLevel::SOPHOMORE->value,
                            'Junior' => YearLevel::JUNIOR->value,
                            'Senior' => YearLevel::SENIOR->value,
                        ]),

                    Forms\Components\Select::make('course')
                        ->label('Course')
                        ->helperText('Type here like: BS Information Technology')
                        ->searchable()
                        ->options([
                            'BS Architecture' => Course::BSAR->value,
                            'BS Interior Design' => Course::BSID->value,
                            'BS English Language' => Course::BSEL->value,
                            'BS Mathematics' => Course::BSMATH->value,
                            'BS Environmental Science' => Course::BSES->value,
                            'BS Chemistry' => Course::BSCHEM->value,
                            'BS Statistics' => Course::BSSTAT->value,
                            'BS Entrepreneurship' => Course::BSE->value,
                            'BS Office Administrator' => Course::BSOA->value,
                            'BS Accountancy' => Course::BSA->value,
                            'BS Marketing' => Course::BSM->value,
                            'BS Chemical Engineering' => Course::BSCHE->value,
                            'BS Civil Engineering' => Course::BSCE->value,
                            'BS Electrical Engineering' => Course::BSEE->value,
                            'BS Electronics Engineering' => Course::BSECE->value,
                            'BS Geodetic Engineering' => Course::BSGE->value,
                            'BS Mechanical Engineering' => Course::BSME->value,
                            'BS Industrial Engineering' => Course::BSIE->value,
                            'BS Information Technology' => Course::BSIT->value,
                            'BS Hospitality Management' => Course::BSHM->value,
                            'BS Nutrition & Diabetics' => Course::BSND->value,
                        ]),

                ])->columns(3),

                Forms\Components\Repeater::make('vote')
                ->schema([
                    Forms\Components\Select::make('position_vote')
                    ->label('Position')
                    ->options([
                        'President' => Position::PRESIDENT->value,
                        'Vice President' => Position::VICE->value,
                        'CAAD Senator' => Position::CAAD->value,
                        'COBE Senator' => Position::COBE->value,
                        'CAS Senator' => Position::CAS->value,
                        'COT Senator' => Position::COT->value,
                        'COED Senator' => Position::COED->value,

                        'BSF Representative' => Position::BSF->value,
                        'BSECE Representative' => Position::BSECE->value,
                        'BTVTED Representative' => Position::BTVTED->value,
                        'BSES Representative' => Position::BSES->value,
                        'BSIT Representative' => Position::BSIT->value,
                        'BTLED Representative' => Position::BTLED->value,
                    ]),

                    Forms\Components\Select::make('candidates_id')
                    ->label('Candidates Fullname')
                    ->options(Candidates::query()->pluck('fullname', 'id')),


                ])->collapsible()
                    ->columns(2)
                    ->columnSpanFull()
                    ->deletable('true')
                    ->addActionLabel('Add another vote.')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Voters Fullname')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('year')
                ->label('Year Level')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('course')
                ->label('Course')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date()
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
                        ->slideOver()
                        ->hidden(!auth()->user()->hasPermission('candidate_update')),

                ])->tooltip('Actions')
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->dropdownPlacement('top-start')

            ], position: Tables\Enums\ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(KandidatoExporter::class)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKandidatos::route('/'),
            'create' => Pages\CreateKandidato::route('/create'),
            'edit' => Pages\EditKandidato::route('/{record}/edit'),
        ];
    }
}
