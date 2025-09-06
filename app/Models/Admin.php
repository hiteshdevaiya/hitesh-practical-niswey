<?php

namespace App\Models;

use App\Enums\Status;
use App\Notifications\AdminResetPasswordNotification;
use App\Notifications\customPasswordResetNotification;
use App\Rules\NormalizeSpaces;
use App\Scopes\LatestFirst;
use App\Traits\HasAppDateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Vite;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    use HasAppDateTime, HasFactory, InteractsWithMedia, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected $appends = ['profile_picture'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('admin/profile-picture')->singleFile();
    }

    protected static function booted()
    {
        static::addGlobalScope(new LatestFirst);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function toggleStatus()
    {
        if ($this->status == 1) {
            $this->status = (string) 0;
        } else {
            $this->status = (string) 1;
        }
        $this->update();
    }

    /**
     * returns the user default profile picture if found
     */
    public function getProfilePictureAttribute()
    {
        return $this->getFirstMedia('admin/profile-picture') ? $this->getFirstMedia('admin/profile-picture')->getFullUrl() : Vite::asset('resources/images/user.png');
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = NormalizeSpaces::sanitize($value);
    }
}
