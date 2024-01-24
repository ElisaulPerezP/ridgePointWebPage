<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Carousel extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'message',
        'creation_date',
        'creation_place',
        'image_rights',
    ];

    protected $dates = ['creation_date'];

    // Definir la colección de medios para las imágenes del carrusel
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('carousel_images')->singleFile();
    }

    // Método para obtener la URL de la imagen del carrusel
    public function getImageUrl(): ?string
    {
        $media = $this->getFirstMedia('carousel_images');

        return $media ? $media->getUrl() : null;
    }

    // Método para obtener la URL del primer recurso multimedia del carrusel
    public function getImage(): ?string
    {
        $media = $this->getFirstMedia('carousel_images');
        return $media ? $media->getFullUrl() : null;
    }
}
