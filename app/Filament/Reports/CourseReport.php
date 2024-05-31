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
                                Text::make("Informe de Cursos")
                                    ->title()
                                    ->primary(),
                                Text::make("Un informe simple que muestra los datos de los cursos")
                                    ->subtitle(),
                                Text::make("Generado el: " . now()->format("d/m/Y H:i:s"))
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
                        Text::make("Lista de Cursos")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("title")
                                    ->label("Título"),
                                Body\TextColumn::make("subject")
                                    ->label("Asignatura"),
                                Body\TextColumn::make("description")
                                    ->label("Descripción"),
                                Body\TextColumn::make("status")
                                    ->label("Estado"),
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
                Text::make("Fin del Informe")
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
