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

    // START PARENT RELATION
        public function students () {
            return $this->hasMany(User::class, 'parent_id');
        }
    // END   PARENT RELATION

    // START STUDENT RELATION
        public function student () {
            return $this->hasOne(Student::class, 'user_id');
        }

        public function parent () {
            return $this->belongsTo(User::class, 'parent_id');
        }
        
        public function wallet() {
            return $this->hasOne(Wallet::class, 'user_id');
        }

        public function walletCharges() {
            return $this->hasMany(WalletCharge::class, 'user_id');
        }
    // END   STUDENT RELATION

    // START TRAINER RELATION
        public function trainer () {
            return $this->hasOne(Trainer::class, 'user_id');
        }

        public function courses () {
            return $this->hasMany(Course::class, 'trainer_id');
        }

        public function files () {
            return $this->hasMany(UserFiles::class, 'user_id');
        }
    // END   TRAINER RELATION

    // START GENARIC USER RELATION
        public function notifications() {
            return $this->hasMany(Notification::class, 'user_id');
        }

        public function devices() {
            return $this->hasMany(UserDevice::class, 'user_id');
        }
    // END   GENARIC USER RELATION


    // START FILTRATION; Keep in the end of the model !
    public function scopeAdminFilter(Builder $query) {
        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request()->query('name') . '%');
        }

        if (request()->filled('email')) {
            $query->where('email', 'like', '%' . request()->query('email') . '%');
        }

        if (request()->filled('phone')) {
            $query->where('phone', 'like', '%' . request()->query('phone') . '%');
        }

        if (request()->filled('category')) {
            $query->where('category', request()->query('category'));
        }

        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }

        if (request()->filled('roles')) {
            $roles = request()->query('roles');
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('roles.id', $roles);
            });
        } 

        if (request()->filled('groups')) {
            $query->whereIn('group_id', request()->query('groups'));
        }

        if (request()->filled('parents')) {
            $query->whereIn('parent_id', request()->query('parents'));
        }

        if (request()->filled('specialties')) {
            $specialties = request()->query('specialties');
            $query->whereHas('specialties', function ($q) use ($specialties) {
                $q->whereIn('course_categories.id', $specialties);
            });
        } 
    }
}
