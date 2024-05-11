<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseCommentResource\Pages;
use App\Filament\Resources\CourseCommentResource\RelationManagers;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseCommentResource extends Resource
{
    protected static ?string $model = CourseComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->options(Course::all()->pluck('title', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('student_id')
                    ->required()
                    ->options(Student::all()->pluck('ci', 'id'))
                    ->searchable(),
                Forms\Components\Textarea::make('review_text')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_id')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCourseComments::route('/'),
            'create' => Pages\CreateCourseComment::route('/create'),
            'edit' => Pages\EditCourseComment::route('/{record}/edit'),
        ];
    }
}
