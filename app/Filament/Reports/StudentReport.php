<?php

namespace App\Filament\Reports;

use App\Models\Student;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Forms\Form;
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
                                Text::make("Informe de Estudiantes")
                                    ->title()
                                    ->primary(),
                                Text::make("Un informe simple que muestra los datos de los estudiantes")
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
                        Text::make("Lista de Estudiantes")
                            ->fontXl()
                            ->fontBold()
                            ->primary(),
                        Body\Table::make()
                            ->columns([
                                Body\TextColumn::make("first_name")
                                    ->label("Nombre"),
                                Body\TextColumn::make("last_name")
                                    ->label("Apellido"),
                                Body\TextColumn::make("email")
                                    ->label("Correo Electrónico"),
                                Body\TextColumn::make("course")
                                    ->label("Curso"),
                                Body\TextColumn::make("age")
                                    ->label("Edad"),
                                Body\TextColumn::make("birth_date")
                                    ->label("Fecha de Nacimiento")
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
                Text::make("Fin del Informe")
                    ->fontSm()
                    ->secondary(),
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                DateRangePicker::make("birth_date")
                    ->label("Fecha de Nacimiento")
                    ->placeholder("Selecciona un rango de fechas"),
            ]);
    }
}
