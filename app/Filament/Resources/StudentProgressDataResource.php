<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentProgressDataResource\Pages;
use App\Filament\Resources\StudentProgressDataResource\RelationManagers;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_progress_id')
                    ->options(StudentProgress::all()->pluck('last_accessed_content_id', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('content_id')
                    ->options(CourseContent::all()->pluck('title', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Textarea::make('completed_content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_progress_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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
