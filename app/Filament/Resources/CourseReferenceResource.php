<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseReferenceResource\Pages;
use App\Models\CourseContent;
use App\Models\CourseReference;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseReferenceResource extends Resource
{
    protected static ?string $model = CourseReference::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Añadir título en español para el recurso
    protected static ?string $navigationLabel = 'Referencias de Curso';
    protected static ?string $navigationGroup = 'Gestión de Cursos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull()
                    ->rules(['string']),
                Forms\Components\FileUpload::make('text')
                    ->label('Archivo')
                    ->rules(['file']),
                Forms\Components\Select::make('course_content_id')
                    ->label('Contenido del Curso')
                    ->required()
                    ->options(CourseContent::all()->pluck('title', 'id'))
                    ->searchable()
                    ->rules(['exists:course_contents,id']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('text')
                    ->label('Archivo'),
                Tables\Columns\TextColumn::make('course_content_id')
                    ->label('Contenido del Curso')
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
            'index' => Pages\ListCourseReferences::route('/'),
            'create' => Pages\CreateCourseReference::route('/create'),
            'edit' => Pages\EditCourseReference::route('/{record}/edit'),
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
