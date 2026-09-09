<?php

namespace App\Filament\Resources\Weddings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WeddingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slug / Path Undangan')
                    ->schema([
                        TextInput::make('slug')
                            ->label('Path (contoh: andidananda)')
                            ->unique(ignoreRecord: true)
                            ->helperText('Kosongkan untuk generate otomatis dari nama panggilan')
                            ->maxLength(255),
                    ]),

                Section::make('Tema Undangan')
                    ->description('Menentukan warna background & bingkai ring pada undangan.')
                    ->schema([
                        Radio::make('theme')
                            ->label('Pilih Tema Warna')
                            ->options([
                                'gold' => 'Gold',
                                'maroon' => 'Maroon',
                            ])
                            ->descriptions([
                                'gold' => 'Nuansa emas & krem',
                                'maroon' => 'Nuansa merah marun & krem',
                            ])
                            ->default('gold')
                            ->inline()
                            ->inlineLabel(false)
                            ->required(),
                    ]),

                Section::make('Mempelai Wanita')
                    ->schema([
                        TextInput::make('bride_name')->label('Nama Lengkap')->required(),
                        TextInput::make('bride_nickname')->label('Nama Panggilan')->required(),
                        TextInput::make('bride_child_order')->label('Anak ke-'),
                        TextInput::make('bride_father')->label('Nama Ayah'),
                        TextInput::make('bride_mother')->label('Nama Ibu'),
                    ])->columns(2),

                Section::make('Mempelai Pria')
                    ->schema([
                        TextInput::make('groom_name')->label('Nama Lengkap')->required(),
                        TextInput::make('groom_nickname')->label('Nama Panggilan')->required(),
                        TextInput::make('groom_child_order')->label('Anak ke-'),
                        TextInput::make('groom_father')->label('Nama Ayah'),
                        TextInput::make('groom_mother')->label('Nama Ibu'),
                    ])->columns(2),

                Section::make('Waktu & Lokasi Acara')
                    ->schema([
                        DatePicker::make('wedding_date')->required(),
                        TextInput::make('wedding_date_hijri')->label('Tanggal Hijriah'),
                        TextInput::make('wedding_time')->label('Waktu (mis: 09.00 WIB s/d Selesai)'),
                        Textarea::make('location_address')->label('Alamat Lengkap')->columnSpanFull(),
                        Textarea::make('location_map_embed')
                            ->label('URL Embed Google Maps (src iframe)')
                            ->helperText('Ambil dari tombol Share > Sematkan peta di Google Maps')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('cover_image')
                            ->image()
                            ->disk('public')
                            ->directory('weddings/cover'),

                        FileUpload::make('couple_photo')
                            ->image()
                            ->disk('public')
                            ->directory('weddings/photo'),

                        FileUpload::make('audio_file')
                            ->disk('public')
                            ->directory('weddings/audio'),
                    ])->columns(3),

                Section::make('Galeri Foto Prewedding')
                    ->description('Foto-foto ini akan tampil sebagai galeri responsif di halaman undangan.')
                    ->schema([
                        FileUpload::make('gallery_photos')
                            ->label('Upload Foto Prewedding')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->disk('public')
                            ->directory('weddings/gallery')
                            ->imagePreviewHeight('120')
                            ->panelLayout('grid')
                            ->maxFiles(20)
                            ->helperText('Bisa upload beberapa foto sekaligus, urutan bisa diatur dengan drag & drop.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Ayat / Doa')
                    ->schema([
                        Textarea::make('quote_arabic')->columnSpanFull(),
                        Textarea::make('quote_translation')->columnSpanFull(),
                        TextInput::make('quote_source'),
                    ]),

                Section::make('Kisah Cinta (Love Story)')
                    ->schema([
                        Repeater::make('loveStories')
                            ->relationship()
                            ->schema([
                                TextInput::make('label')->label('Label (mis: AWAL BERTEMU)')->required(),
                                TextInput::make('title')->label('Judul')->required(),
                                Textarea::make('content')->label('Isi Cerita')->rows(4)->required(),
                            ])
                            ->columns(2)
                            ->orderColumn('order')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel('Tambah Bagian Cerita'),
                    ]),

                Section::make('Rekening / E-Wallet Hadiah')
                    ->schema([
                        Repeater::make('giftAccounts')
                            ->relationship()
                            ->schema([
                                TextInput::make('bank_name')->label('Nama Bank/E-wallet')->required(),
                                TextInput::make('account_number')->label('Nomor Rekening')->required(),
                                TextInput::make('account_holder')->label('Atas Nama')->required(),
                                FileUpload::make('logo')
                                ->image()
                                ->disk('public')
                                ->directory('weddings/gift-logo'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->addActionLabel('Tambah Rekening'),
                    ]),

                Toggle::make('is_active')->label('Aktifkan Undangan')->default(true),
            ]);
    }
}