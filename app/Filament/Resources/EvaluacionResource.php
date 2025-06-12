<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluacionResource\Pages;
use App\Models\Evaluacion;
use App\Models\Module;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
class EvaluacionResource extends Resource
{
    protected static ?string $model = Evaluacion::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Contenido';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('module_id')
                ->label('Módulo')
                ->options(Module::all()->pluck('titulo', 'id'))
                ->required(),

            TextInput::make('titulo')
                ->label('Título de la evaluación')
                ->required()
                ->maxLength(255),

            Textarea::make('preguntas')
                ->label('Preguntas (en formato JSON)')
                ->rows(10)
                ->required()
                ->helperText('Ejemplo: [{"pregunta":"¿Qué es hidroponía?","opciones":["A","B","C"],"respuesta":"A"}]'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('module.titulo')->label('Módulo'),
                TextColumn::make('titulo'),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvaluacions::route('/'),
            'create' => Pages\CreateEvaluacion::route('/create'),
            'edit' => Pages\EditEvaluacion::route('/{record}/edit'),
        ];
    }
}
