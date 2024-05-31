<?php

namespace App\Filament\Reports;

use App\Models\Student;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Component;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class StudentReport extends Report
{
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Student Report")
                                    ->title()
                                    ->primary(),
                                Text::make("A simple report displaying student data")
                                    ->subtitle(),
                                Text::make("Generated on: " . now()->format("d/m/Y H:i:s"))
                                    ->subtitle(),
                            ])->alignCenter(),
                    ]),
            ]);
    }

    public function body(Body $body): Body
    {
        return $body
            ->schema([
                Body\Layout\BodyColumn::make()
                    ->schema([
                        Text::make("Student List")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("first_name")
                                    ->label("First Name"),
                                Body\TextColumn::make("last_name")
                                    ->label("Last Name"),
                                Body\TextColumn::make("email")
                                    ->label("Email"),
                                Body\TextColumn::make("course")
                                    ->label("Course"),
                                Body\TextColumn::make("age")
                                    ->label("Age"),
                                Body\TextColumn::make("birth_date")
                                    ->label("Birth Date")
                                    ->dateTime(),
                            ])
                            ->data(
                                function (?array $filters) {
                                    return Student::query()
                                        ->select("first_name", "last_name", "email", "course", "age", "birth_date")
                                        ->take(10)
                                        ->get();
                                }
                            ),
                    ]),
            ]);
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                Text::make("End of Report")
                    ->fontSm()
                    ->secondary(),
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                DateRangePicker::make("birth_date")
                    ->label("Birth Date")
                    ->placeholder("Select a date range"),

            ]);
    }
}