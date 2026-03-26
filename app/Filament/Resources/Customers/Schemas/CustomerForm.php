<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')

                    ->default(null),
                TextInput::make('email')

                    ->default(null),
                TextInput::make('password')

                    ->default(null),
                TextInput::make('alamat')
                    ->default(null),
                TextInput::make('customerNoTelp')
                    ->default(null),
                Select::make('customerJenisKelamin')
                    ->options(['Laki-laki' => 'Laki laki', 'Perempuan' => 'Perempuan'])
                    ->default(null),
                \Filament\Forms\Components\FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->directory('images/profile')
                    ->visibility('public')
                    ->avatar()
                    ->fetchFileInformation(true)
                    ->previewable(false)
                    ->openable()
                    ->downloadable(),
            ]);
    }
}
