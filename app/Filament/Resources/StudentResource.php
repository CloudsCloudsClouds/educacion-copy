<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    // Añadir título en español para el recurso
    protected static ?string $navigationLabel = 'Estudiantes';
    protected static ?string $navigationGroup = 'Gestión de Estudiantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\TextInput::make('last_name')
                    ->label('Apellido')
                    ->maxLength(255)
                    ->default(null)
                    ->rules(['nullable', 'string', 'max:255']),
                Forms\Components\TextInput::make('second_name')
                    ->label('Segundo Nombre')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\TextInput::make('middle_name')
                    ->label('Segundo Apellido')
                    ->maxLength(255)
                    ->default(null)
                    ->rules(['nullable', 'string', 'max:255']),
                Forms\Components\TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->rules(['email', 'max:255']),
                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\TextInput::make('rude')
                    ->label('RUDE')
                    ->required()
                    ->maxLength(8)
                    ->rules(['string', 'max:8']),
                Forms\Components\TextInput::make('ci')
                    ->label('CI')
                    ->required()
                    ->maxLength(12)
                    ->rules(['string', 'max:12']),
                Forms\Components\TextInput::make('direction')
                    ->label('Dirección')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\TextInput::make('course')
                    ->label('Curso')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                Forms\Components\TextInput::make('age')
                    ->label('Edad')
                    ->required()
                    ->numeric()
                    ->minValue(4)
                    ->maxValue(99)
                    ->rules(['integer', 'min:4', 'max:99']),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento')
                    ->required()
                    ->before(now())
                    ->rules(['date', 'before:today']),
                Forms\Components\TextInput::make('institution_code')
                    ->label('Código de Institución')
                    ->required()
                    ->numeric()
                    ->rules(['integer']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('second_name')
                    ->label('Segundo Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->label('Segundo Apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rude')
                    ->label('RUDE')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                    ->label('CI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direction')
                    ->label('Dirección')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course')
                    ->label('Curso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->label('Edad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Fecha de Nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institution_code')
                    ->label('Código de Institución')
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
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
