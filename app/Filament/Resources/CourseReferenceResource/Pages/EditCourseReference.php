<?php

namespace App\Filament\Resources\CourseReferenceResource\Pages;

use App\Filament\Resources\CourseReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseReference extends EditRecord
{
    protected static string $resource = CourseReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
