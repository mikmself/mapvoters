<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemilihPotensialResource\Pages;
use App\Filament\Resources\PemilihPotensialResource\RelationManagers;
use App\Models\PemilihPotensial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PemilihPotensialResource extends Resource
{
    protected static ?string $model = PemilihPotensial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'pemilih-potensial';
    protected static ?string $navigationLabel = 'Pemilih Potensial';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('foto_ktp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('tps')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('koordinator_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto_ktp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan_id')
                    ->searchable(),
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
            'index' => Pages\ListPemilihPotensials::route('/'),
            'create' => Pages\CreatePemilihPotensial::route('/create'),
            'edit' => Pages\EditPemilihPotensial::route('/{record}/edit'),
        ];
    }
}
