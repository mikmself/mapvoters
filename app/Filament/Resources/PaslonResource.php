<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaslonResource\Pages;
use App\Filament\Resources\PaslonResource\RelationManagers;
use App\Models\Partai;
use App\Models\Paslon;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaslonResource extends Resource
{
    protected static ?string $model = Paslon::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $slug = 'paslon';
    protected static ?string $navigationLabel = 'Paslon';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        $partaiOptions = Partai::pluck('nama', 'id')->toArray();
        $userOptions = User::pluck('name', 'id')->toArray();
        return $form
            ->schema([
                Forms\Components\TextInput::make('foto')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('nomor_urut')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dapil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('partai_id')
                    ->options($partaiOptions)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('user_id')
                    ->options($userOptions)
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dapil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partai.nama')
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
            'index' => Pages\ListPaslons::route('/'),
            'create' => Pages\CreatePaslon::route('/create'),
            'edit' => Pages\EditPaslon::route('/{record}/edit'),
        ];
    }
}
