<?php

namespace App\Filament\Resources\StudentProgressResource\Pages;

use App\Filament\Resources\StudentProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentProgress extends EditRecord
{
    protected static string $resource = StudentProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
