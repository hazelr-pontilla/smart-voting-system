<?php

namespace App\Filament\Resources;

use App\Enums\Course;
use App\Enums\Gender;
use App\Enums\Position;
use App\Enums\YearLevel;
use App\Filament\Exports\CandidatesExporter;
use App\Filament\Exports\UserExporter;
use App\Filament\Resources\CandidatesResource\Pages;
use App\Filament\Resources\CandidatesResource\RelationManagers;
use App\Filament\Resources\PartylistResource\RelationManagers\PartyRelationManager;
use App\Models\Candidates;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidatesResource extends Resource
{
    protected static ?string $model = Candidates::class;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationGroup = 'MANAGE';

    protected static ?string $navigationIcon = 'heroicon-m-users';

    protected static array $position = [
        'President' => 'President',
        'Vice President' => 'Vice President',
        'CAAD Senator' => 'CAAD Senator',
        'COBE Senator' => 'COBE Senator',
        'CAS Senator' => 'CAS Senator',
        'COT Senator' => 'COT Senator',
        'COED Senator' => 'COED Senator',
        'BSF Representative' => 'BSF Representative',
        'BSECE Representative' => 'BSECE Representative',
        'BTVTED Representative' => 'BTVTED Representative',
        'BSES Representative' => 'BSES Representative',
        'BSIT Representative' => 'BSIT Representative',
        'BTLED Representative' => 'BTLED Representative',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('PROFILE')
                ->schema([
                    Forms\Components\DatePicker::make('date_filing')
                    ->label('Date of Filling'),

                    Forms\Components\TextInput::make('student_id')
                    ->label('Candidates ID')
                    ->helperText('this is similar to voters id'),

                    Forms\Components\Select::make('position')
                    ->label('Position')
                        ->searchable()
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

                    Forms\Components\TextInput::make('fullname')
                    ->label('Candidates Fullname'),

                    Forms\Components\Select::make('gender')
                        ->label('Gender')
                        ->options([
                            'Male' => Gender::MALE->value,
                            'Female' => Gender::FEMALE->value,
                        ]),
                    Forms\Components\TextInput::make('email')
                    ->label('EVSU Email'),

                    Forms\Components\Select::make('c_year_level')
                        ->label('Year Level')
                        ->options([
                            'Freshman' => YearLevel::FRESHMAN->value,
                            'Sophomore' => YearLevel::SOPHOMORE->value,
                            'Junior' => YearLevel::JUNIOR->value,
                            'Senior' => YearLevel::SENIOR->value,
                        ]),

                    Forms\Components\Select::make('c_course')
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
                        ])
                        ->helperText('Type here like: BS Information Technology')
                        ->label('Course'),

                ])->columns(4),

                Forms\Components\Textarea::make('motivation')
                ->label('Motivation for Running')
                ->columnSpanFull(),

                Forms\Components\Fieldset::make('AGENDAS')
                ->schema([
                   Forms\Components\Textarea::make('key_issues')
                   ->label('Key Issues'),

                   Forms\Components\Textarea::make('key_solutions')
                   ->label('Key Solutions'),

                   Forms\Components\Textarea::make('plan_to_action')
                    ->label('Plan to Action'),

                    Forms\Components\Textarea::make('conclusion')
                    ->label('Conclusions'),
                ])->columns(4),

                Forms\Components\Fieldset::make('PLANS')
                ->schema([
                    Forms\Components\Textarea::make('vision_statement')
                    ->label('Vision Statement'),

                    Forms\Components\Textarea::make('key_priorities')
                    ->label('Key Priorities'),

                    Forms\Components\Textarea::make('action_plan')
                    ->label('Action Plan')
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('date_filing')
                    ->label('Date Filling')
                ->date()
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('student_id')
                    ->label('Candidates ID')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                ->label('Position')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fullname')
                ->label('Candidates Fullname')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable(),

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

                Tables\Columns\TextColumn::make('c_year_level')
                ->label('Year Level')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('c_course')
                ->label('Course')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('motivation')
                ->label('Motivation to Run')
                ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('key_issues')
                ->label('Key Issues')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('key_solutions')
                ->label('Key Solutions')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('plan_to_action')
                ->label('Plan to Action')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('conclusion')
                ->label('Conclusion')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('vision_statement')
                ->label('Vision Statement')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('key_priorities')
                ->label('Key Priorities')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('action_plan')
                ->label('Action Plan')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                ->label('Position')
                ->searchable()
                ->options(self::$position)
                ->preload(),
            ], layout: Tables\Enums\FiltersLayout::Modal)
            ->filtersFormColumns(1)
            ->persistFiltersInSession()

            ->headerActions([
                ExportAction::make()
                    ->exporter(CandidatesExporter::class)
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
                        ->color('danger')
                        ->hidden(!auth()->user()->hasPermission('candidate_delete')),

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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
//            'create' => Pages\CreateCandidates::route('/create'),
//            'edit' => Pages\EditCandidates::route('/{record}/edit'),
        ];
    }
}
