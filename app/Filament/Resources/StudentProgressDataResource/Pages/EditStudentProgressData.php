<?php

namespace App\Filament\Resources\StudentProgressDataResource\Pages;

use App\Filament\Resources\StudentProgressDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentProgressData extends EditRecord
{
    protected static string $resource = StudentProgressDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
