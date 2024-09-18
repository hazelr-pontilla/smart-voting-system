<?php

namespace App\Filament\Pages;

use App\Enums\Course;
use App\Enums\VotingPosition;
use App\Enums\YearLevel;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;

class Registration extends Register
{
    protected ?string $maxWidth = '2xl';

    protected static ?string $navigationIcon = 'heroicon-m-user';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Account')
                        ->schema([
                            $this->getNameFormComponent(),
                            $this->getEmailFormComponent(),
                        ]),
                    Wizard\Step::make('Basic Information')
                        ->schema([
                            $this->getStudentIDFormComponent(),
                            $this->getVotingPosition(),
                            $this->getYearLevelFormComponent(),
                            $this->getCourseFormComponent(),
                        ]),
                    Wizard\Step::make('Password')
                        ->schema([
                            $this->getPasswordFormComponent(),
                            $this->getPasswordConfirmationFormComponent(),
                        ]),
                ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                        wire:submit="register"
                    >
                        Register
                    </x-filament::button>
                    BLADE))),
            ]);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getStudentIDFormComponent(): Component
    {
        return TextInput::make('student_id')
//            ->prefix('https://github.com/')
            ->label(__('Student ID'))
            ->maxLength(255);
    }

    protected function getVotingPosition(): Component
    {
        return Select::make('voting_position')
            ->label(__('Voting Position'))
            ->options([
                'Candidate' => VotingPosition::CANDIDATE->value,
                'Voter' => VotingPosition::VOTER->value,
            ]);
    }

    protected function getYearLevelFormComponent(): Component
    {
        return Select::make('year_level')
            ->label(__('Year Level'))
            ->options([
                'Freshman' => YearLevel::FRESHMAN->value,
                'Sophomore' => YearLevel::SOPHOMORE->value,
                'Junior' => YearLevel::JUNIOR->value,
                'Senior' => YearLevel::SENIOR->value,
            ]);
    }

    protected function getCourseFormComponent(): Component
    {
        return Select::make('course')
            ->label(__('Course'))
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
            ->helperText('Type here like: BS Information Technology');
    }
}
