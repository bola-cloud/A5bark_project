<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;


class User extends Authenticatable implements LaratrustUser, HasMedia
{
    use HasRolesAndPermissions, InteractsWithMedia;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'category',
        'phone_verified_at', 'email_verified_at', 'is_active',
        'parent_id', 'group_id', 'picture', 'birthdate', 'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['avatar'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('profile_picture')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('avatar')
             ->fit(Manipulations::FIT_CROP, 150, 150)
             ->nonQueued()
             ->performOnCollections('profile_picture');
    }

    public function getAvatarAttribute() {
        $avatar = $this->getFirstMedia('avatar');
        
        if ($avatar) {
            return $avatar->getUrl();
        }

        return null;
    }

    public function OTP() {
        return $this->hasOne(OTP::class, 'user_id');
    }

}
