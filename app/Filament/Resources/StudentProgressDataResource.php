<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentProgressDataResource\Pages;
use App\Models\CourseContent;
use App\Models\StudentProgress;
use App\Models\StudentProgressData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentProgressDataResource extends Resource
{
    protected static ?string $model = StudentProgressData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Añadir título en español para el recurso
    protected static ?string $navigationLabel = 'Datos de Progreso de Estudiantes';
    protected static ?string $navigationGroup = 'Gestión de Estudiantes';

    protected static ?string $label = 'Datos de Progreso de Estudiantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_progress_id')
                    ->label('Progreso del Estudiante')
                    ->options(StudentProgress::all()->pluck('last_accessed_content_id', 'id'))
                    ->required()
                    ->searchable()
                    ->rules(['exists:student_progress,id']),
                Forms\Components\Select::make('content_id')
                    ->label('Contenido')
                    ->options(CourseContent::all()->pluck('title', 'id'))
                    ->required()
                    ->searchable()
                    ->rules(['exists:course_contents,id']),
                Forms\Components\Textarea::make('completed_content')
                    ->label('Contenido Completado')
                    ->required()
                    ->columnSpanFull()
                    ->rules(['string']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content.title')
                    ->label('Contenido')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->label('Ver eliminados'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
                    Tables\Actions\ForceDeleteBulkAction::make()->label('Eliminar permanentemente seleccionados'),
                    Tables\Actions\RestoreBulkAction::make()->label('Restaurar seleccionados'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Agregar relaciones si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentProgressData::route('/'),
            'create' => Pages\CreateStudentProgressData::route('/create'),
            'edit' => Pages\EditStudentProgressData::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
