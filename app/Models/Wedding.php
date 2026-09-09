<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Wedding extends Model
{
    protected $fillable = [
        'slug','bride_name','bride_nickname','bride_child_order','bride_father','bride_mother',
        'groom_name','groom_nickname','groom_child_order','groom_father','groom_mother',
        'wedding_date','wedding_date_hijri','wedding_time',
        'location_address','location_map_embed',
        'cover_image','couple_photo','audio_file',
        'quote_arabic','quote_translation','quote_source','is_active',
        'theme',
        'gallery_photos',
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'gallery_photos' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($wedding) {
            if (empty($wedding->slug)) {
                $wedding->slug = Str::slug(
                    $wedding->bride_nickname . 'dan' . $wedding->groom_nickname,
                    ''
                );
            }
        });
    }

    /**
     * Daftar tema yang tersedia. Tambah tema baru cukup tambah 1 baris di sini.
     * key = nilai kolom `theme`, juga dipakai untuk nama file blade: "{key}-theme.blade.php"
     */
    protected static function availableThemes(): array
    {
        return [
            'gold' => [
                'bg'   => 'assets/bg-abstract-gold.png',
                'ring' => 'assets/ring-gold.png',
            ],
            'maroon' => [
                'bg'   => 'assets/bg-maroon.png',
                'ring' => 'assets/ring-maroon.png',
            ],
        ];
    }

    /**
     * Path aset (bg & ring) sesuai tema — masih dipertahankan untuk
     * kebutuhan lain (mis. thumbnail preview tema di admin panel).
     */
    public function getThemeAssetsAttribute(): array
    {
        $themes = self::availableThemes();

        return $themes[$this->theme] ?? $themes['gold'];
    }

    /**
     * Nama view blade yang sesuai dengan tema, contoh:
     * theme = 'maroon' -> 'wedding.maroon-theme'
     * Kalau tema tidak dikenal / file blade-nya belum dibuat, fallback ke gold.
     */
    public function getThemeViewAttribute(): string
    {
        $view = 'wedding.' . $this->theme . '-theme';

        return view()->exists($view) ? $view : 'wedding.gold-theme';
    }

    public function giftAccounts(): HasMany
    {
        return $this->hasMany(WeddingGiftAccount::class);
    }

    public function loveStories(): HasMany
    {
        return $this->hasMany(WeddingLoveStory::class)->orderBy('order');
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(WeddingWish::class)->latest();
    }
}