<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KoordinatorResource\Pages;
use App\Filament\Resources\KoordinatorResource\RelationManagers;
use App\Models\Koordinator;
use App\Models\Paslon;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KoordinatorResource extends Resource
{
    protected static ?string $model = Koordinator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $slug = 'koordinator';
    protected static ?string $navigationLabel = 'Koordinator';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        $userOption = User::pluck('name', 'id')->toArray();
        $paslonOption = Paslon::pluck('nama', 'id')->toArray();
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('foto')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('paslon_id')
                    ->options($paslonOption)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('user_id')
                    ->options($userOption)
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('paslon.user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
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
            'index' => Pages\ListKoordinators::route('/'),
            'create' => Pages\CreateKoordinator::route('/create'),
            'edit' => Pages\EditKoordinator::route('/{record}/edit'),
        ];
    }
}
