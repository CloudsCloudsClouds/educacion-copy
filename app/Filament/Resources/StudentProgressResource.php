<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentProgressResource\Pages;
use App\Models\CourseContent;
use App\Models\Student;
use App\Models\StudentProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentProgressResource extends Resource
{
    protected static ?string $model = StudentProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Añadir título en español para el recurso
    protected static ?string $navigationLabel = 'Progreso de Estudiantes';
    protected static ?string $navigationGroup = 'Gestión de Estudiantes';

    protected static ?string $label = 'Progreso de Estudiantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Estudiante')
                    ->required()
                    ->options(Student::all()->pluck('rude', 'id'))
                    ->searchable()
                    ->rules(['exists:students,id']),
                Forms\Components\Select::make('last_accessed_content_id')
                    ->label('Último Contenido Accedido')
                    ->options(CourseContent::all()->pluck('title', 'id'))
                    ->required()
                    ->searchable()
                    ->rules(['exists:course_contents,id']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.ci')
                    ->label('Estudiante')
                    ->sortable(),
                Tables\Columns\TextColumn::make('content.title')
                    ->label('Último Contenido Accedido')
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
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Eliminado el')
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
            'index' => Pages\ListStudentProgress::route('/'),
            'create' => Pages\CreateStudentProgress::route('/create'),
            'edit' => Pages\EditStudentProgress::route('/{record}/edit'),
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
