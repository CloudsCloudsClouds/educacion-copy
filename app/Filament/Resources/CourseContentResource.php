<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseContentResource\Pages;
use App\Models\Course;
use App\Models\CourseContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseContentResource extends Resource
{
    protected static ?string $model = CourseContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Añadir título en español para el recurso
    protected static ?string $navigationLabel = 'Contenido del Curso';
    protected static ?string $navigationGroup = 'Gestión de Cursos';
    protected static ?string $label = 'Contenido del curso';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('content_type')
                    ->label('Tipo de Contenido')
                    ->required()
                    ->options([
                        'resource' => 'Recurso',
                        'class' => 'Clase',
                        'Homework' => 'Tarea',
                        'Activity' => 'Actividad'
                    ]),
                Forms\Components\Select::make('course_id')
                    ->label('Curso')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->required()
                    ->rules(['exists:courses,id']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content_type')
                    ->label('Tipo de Contenido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Curso')
                    ->numeric()
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
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar'),
                    Tables\Actions\ForceDeleteBulkAction::make()->label('Eliminar permanentemente'),
                    Tables\Actions\RestoreBulkAction::make()->label('Restaurar'),
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
            'index' => Pages\ListCourseContents::route('/'),
            'create' => Pages\CreateCourseContent::route('/create'),
            'edit' => Pages\EditCourseContent::route('/{record}/edit'),
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
