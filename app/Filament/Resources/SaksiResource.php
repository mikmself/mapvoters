<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaksiResource\Pages;
use App\Filament\Resources\SaksiResource\RelationManagers;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Koordinator;
use App\Models\Provinsi;
use App\Models\Saksi;
use App\Models\User;
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
        $provinsiOption = Provinsi::pluck('nama', 'id')->toArray();
        $kabupatenOption = Kabupaten::pluck('nama', 'id')->toArray();
        $kecamatanOption = Kecamatan::pluck('nama', 'id')->toArray();
        $kelurahanOption = Kelurahan::pluck('nama', 'id')->toArray();
        $koodinatorOption = Koordinator::pluck('nama', 'id')->toArray();
        $userOption = User::pluck('name', 'id')->toArray();
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
                Forms\Components\Select::make('user_id')
                    ->options($userOption)
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
                Tables\Columns\TextColumn::make('tps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_suara')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('foto_kertas_suara')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListSaksis::route('/'),
            'create' => Pages\CreateSaksi::route('/create'),
            'edit' => Pages\EditSaksi::route('/{record}/edit'),
        ];
    }
}
