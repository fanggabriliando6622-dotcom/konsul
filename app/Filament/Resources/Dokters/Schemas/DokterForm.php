<?php

namespace App\Filament\Resources\Dokters\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DokterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('dokterName')
                    ->default(null),
                TextInput::make('namaBidang')
                    ->default(null),
                TextInput::make('dokterAge')
                    ->numeric()
                    ->default(null),
                Select::make('jenisKelamin')
                    ->options(['Laki-laki' => 'Laki laki', 'Perempuan' => 'Perempuan'])
                    ->default(null),
                \Filament\Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar Dokter')
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('images/team')
                    ->visibility('public')
                    ->fetchFileInformation(true)
                    ->previewable(false)
                    ->openable()
                    ->downloadable(),
                Select::make('statusDokter')
                    ->options(['online' => 'Online', 'offline' => 'Offline', 'sibuk' => 'Sibuk', 'tersedia' => 'Tersedia'])
                    ->default('online')
                    ->required(),
                DateTimePicker::make('jadwalPraktik'),
                TextInput::make('hargaKonsultasi')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('adminId')
                    ->label('Admin')
                    ->options(fn () => \Illuminate\Support\Facades\DB::table('admin')->pluck('name', 'adminId'))

                    ->required()
                    ->searchable(),
            ]);
    }
}
