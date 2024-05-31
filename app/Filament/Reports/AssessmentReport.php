<?php

namespace App\Filament\Reports;

use App\Models\Assessment;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Forms\Form;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class AssessmentReport extends Report
{
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Informe de Evaluaciones")
                                    ->title()
                                    ->primary(),
                                Text::make("Un informe que muestra los datos de las evaluaciones")
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
                        Text::make("Lista de Evaluaciones")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("type")
                                    ->label("Tipo"),
                                Body\TextColumn::make("score")
                                    ->label("Puntuación"),
                                Body\TextColumn::make("student.first_name")
                                    ->label("Nombre del Estudiante"),
                                Body\TextColumn::make("student.last_name")
                                    ->label("Apellido del Estudiante"),
                                Body\TextColumn::make("courseContent.title")
                                    ->label("Título del Curso"),
                            ])
                            ->data(
                                function (?array $filters) {
                                    return Assessment::query()
                                        ->with(['student', 'courseContent'])
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
