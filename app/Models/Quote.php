<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Carbon;

class Quote extends Model implements HasMedia
{
    protected $policy = QuotePolicy::class;
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'description',
        'message',
        'creation_date',
        'creation_place',
        'image_rights',
        'response_date',
        'response_message',
    ];

    protected $dates = ['creation_date','response_date', 'response_message',];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($quote) {
            $quote->creation_date = Carbon::now()->toDateString();
        });
    }
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('quote_images')->singleFile();
    }

    public function getImageUrl(): ?string
    {
        $media = $this->getFirstMedia('quote_images');

        return $media ? $media->getUrl() : null;
    }

    public function getImage(): ?string
    {
        $media = $this->getFirstMedia('quote_images');
        return $media ? $media->getFullUrl() : null;
    }
}
