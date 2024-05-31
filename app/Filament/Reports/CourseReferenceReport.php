<?php

namespace App\Filament\Reports;

use App\Models\CourseReference;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Forms\Form;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class CourseReferenceReport extends Report
{
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Course References Report")
                                    ->title()
                                    ->primary(),
                                Text::make("A report displaying course references data")
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
                        Text::make("Course References List")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("title")
                                    ->label("Title"),
                                Body\TextColumn::make("description")
                                    ->label("Description"),
                                Body\TextColumn::make("courseContent.title")
                                    ->label("Course Title"),
                            ])
                            ->data(
                                function (?array $filters) {
                                    return CourseReference::query()
                                        ->with('courseContent')
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
                Text::make("Fin de reporte")
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
