<?php

namespace App\Filament\Resources\Weddings\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class WeddingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->disk('public')
                    ->square(),
                TextColumn::make('slug')
                    ->label('Path')
                    ->searchable()
                    ->copyable()
                    ->prefix('/'),

                TextColumn::make('bride_nickname')
                    ->label('Mempelai Wanita')
                    ->searchable(['bride_nickname', 'bride_name'])
                    ->sortable(),

                TextColumn::make('groom_nickname')
                    ->label('Mempelai Pria')
                    ->searchable(['groom_nickname', 'groom_name'])
                    ->sortable(),

                TextColumn::make('wedding_date')
                    ->label('Tanggal Acara')
                    ->date('d F Y')
                    ->sortable(),

                TextColumn::make('wishes_count')
                    ->label('Ucapan')
                    ->counts('wishes')
                    ->badge(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}

