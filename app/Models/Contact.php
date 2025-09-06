<?php

namespace App\Models;

use App\Scopes\LatestFirst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Contact extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'dob'
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'datetime'
        ];
    }
    protected static function booted()
    {
        static::addGlobalScope(new LatestFirst);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('contact/image')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMedia('contact/image') ? $this->getFirstMedia('contact/image')->getFullUrl() : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=282828&background=FFCD05&size=512&format=png';
    }
}
