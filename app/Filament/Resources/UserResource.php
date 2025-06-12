<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Correo electrónico')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Select::make('role_usuario')
                ->label('Rol')
                ->options([
                    'admin' => 'Administrador',
                    'usuario' => 'Usuario',
                ])
                ->required(),

            Toggle::make('activo')
                ->label('Activo')
                ->inline(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Nombre'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('role_usuario')->label('Rol')->badge(),
            IconColumn::make('activo')
                ->label('Estado')
                ->boolean()
                ->trueIcon('heroicon-m-check-circle')
                ->falseIcon('heroicon-m-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),
        ])
        ->actions([
            Action::make('toggleActivo')
                ->label(fn (User $record) => $record->activo ? 'Bloquear' : 'Desbloquear')
                ->icon(fn (User $record) => $record->activo ? 'heroicon-m-lock-closed' : 'heroicon-m-lock-open')
                ->color(fn (User $record) => $record->activo ? 'danger' : 'success')
                ->requiresConfirmation()
                ->action(function (User $record) {
                    $record->activo = !$record->activo;
                    $record->save();
                }),

            Action::make('edit')
                ->url(fn (User $record) => static::getUrl('edit', ['record' => $record]))
                ->icon('heroicon-o-pencil'),

            Action::make('delete')
                ->requiresConfirmation()
                ->icon('heroicon-o-trash')
                ->action(fn (User $record) => $record->delete()),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
