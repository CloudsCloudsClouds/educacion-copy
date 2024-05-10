<?php

namespace App\Filament\Resources\CourseReferenceResource\Pages;

use App\Filament\Resources\CourseReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseReferences extends ListRecords
{
    protected static string $resource = CourseReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
