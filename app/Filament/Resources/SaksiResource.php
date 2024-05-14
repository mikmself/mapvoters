<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaksiResource\Pages;
use App\Filament\Resources\SaksiResource\RelationManagers;
use App\Models\Saksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaksiResource extends Resource
{
    protected static ?string $model = Saksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $slug = 'saksi';
    protected static ?string $navigationLabel = 'Saksi';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tps')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_suara')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('foto_kertas_suara')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('provinsi_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kabupaten_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kecamatan_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kelurahan_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('koordinator_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_suara')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('foto_kertas_suara')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('koordinator_id')
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
            'index' => Pages\ListSaksis::route('/'),
            'create' => Pages\CreateSaksi::route('/create'),
            'edit' => Pages\EditSaksi::route('/{record}/edit'),
        ];
    }
}
