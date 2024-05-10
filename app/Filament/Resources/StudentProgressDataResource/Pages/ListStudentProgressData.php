<?php

namespace App\Filament\Resources\StudentProgressDataResource\Pages;

use App\Filament\Resources\StudentProgressDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentProgressData extends ListRecords
{
    protected static string $resource = StudentProgressDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
