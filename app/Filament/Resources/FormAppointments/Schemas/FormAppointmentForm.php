<?php

namespace App\Filament\Resources\FormAppointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class FormAppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customerId')
                    ->default(null),
                TextInput::make('namaPasien')
                    ->label('Nama Pasien')
                    ->default(null),
                TextInput::make('dokterId')
                    ->default(null),
                DatePicker::make('date'),
                TimePicker::make('time'),
                TextInput::make('pesan')
                    ->default(null),
            ]);
    }
}
