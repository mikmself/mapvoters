<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemilihPotensialResource\Pages;
use App\Filament\Resources\PemilihPotensialResource\RelationManagers;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Koordinator;
use App\Models\PemilihPotensial;
use App\Models\Provinsi;
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

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $slug = 'pemilih-potensial';
    protected static ?string $navigationLabel = 'Pemilih Potensial';
    protected static ?int $navigationSort = 5;



    public static function form(Form $form): Form
    {
        $provinsiOption = Provinsi::pluck('nama', 'id')->toArray();
        $kabupatenOption = Kabupaten::pluck('nama', 'id')->toArray();
        $kecamatanOption = Kecamatan::pluck('nama', 'id')->toArray();
        $kelurahanOption = Kelurahan::pluck('nama', 'id')->toArray();
        $koodinatorOption = Koordinator::pluck('nama', 'id')->toArray();
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
                Forms\Components\Select::make('provinsi_id')
                    ->options($provinsiOption)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('kabupaten_id')
                    ->options($kabupatenOption)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('kecamatan_id')
                    ->options($kecamatanOption)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('kelurahan_id')
                    ->options($kelurahanOption)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('koordinator_id')
                    ->options($koodinatorOption)
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
                Tables\Columns\TextColumn::make('provinsi.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('koordinator.user.name')
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
