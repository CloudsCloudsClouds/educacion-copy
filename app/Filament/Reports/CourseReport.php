<?php

namespace App\Filament\Reports;

use App\Models\Course;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Forms\Form;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class CourseReport extends Report
{
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Course Report")
                                    ->title()
                                    ->primary(),
                                Text::make("A simple report displaying course data")
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
                        Text::make("Course List")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("title")
                                    ->label("Title"),
                                Body\TextColumn::make("subject")
                                    ->label("Subject"),
                                Body\TextColumn::make("description")
                                    ->label("Description"),
                                Body\TextColumn::make("status")
                                    ->label("Status"),
                            ])
                            ->data(
                                function (?array $filters) {
                                    return Course::query()
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
        // No filters needed for this report
        return $form;
    }
}
