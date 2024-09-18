<?php

namespace App\Filament\Resources;

use App\Enums\Course;
use App\Enums\VotingPosition;
use App\Enums\YearLevel;
use App\Filament\Exports\UserExporter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Access Control';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->label('Full name'),
                    Forms\Components\TextInput::make('email'),
                    Forms\Components\TextInput::make('password')
                        ->password()
                    ->revealable(),

                    Forms\Components\TextInput::make('student_id')
                    ->label('Student ID'),

                    Forms\Components\Select::make('voting_position')
                        ->label('Voting Position')
                        ->options([
                            'Candidate' => VotingPosition::CANDIDATE->value,
                            'Voter' => VotingPosition::VOTER->value,
                        ]),

                    Forms\Components\Select::make('year_level')
                        ->label('Year Level')
                        ->options([
                            'Freshman' => YearLevel::FRESHMAN->value,
                            'Sophomore' => YearLevel::SOPHOMORE->value,
                            'Junior' => YearLevel::JUNIOR->value,
                            'Senior' => YearLevel::SENIOR->value,
                        ]),
                ])->columns(3),

                Forms\Components\Select::make('course')
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
                ->columnSpanFull(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Fullname')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->iconColor('warning')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->copyMessage('Email address copied!')
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('student_id')
                    ->label('Student ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('voting_position')
                    ->label('Voting Position')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('year_level')
                    ->label('Year Level')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('course')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
            ])
            ->headerActions([
                ExportAction::make()
                ->exporter(UserExporter::class)
                    ->label('Export this')
                    ->icon('heroicon-m-arrow-down-circle')
                    ->size(ActionSize::Small)
                    ->color('success')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
