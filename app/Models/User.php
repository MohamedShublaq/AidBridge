<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //For marital_status
    public const SINGLE = 1;
    public const MARRIED = 2;
    public const DIVORCED = 3;
    public const WIDOWED  = 4;

    //For gender
    public const MALE = 0;
    public const FEMALE = 1;

    //For joining_way Column
    public const REGISTER = 0;
    public const EXCEL = 1;
    public const DEFAULT_WAY = self::REGISTER;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_number',
        'password',
        'joining_way',
        'added_by_provider',
        'city',
        'street',
        'phone',
        'id_photo',
        'gender',
        'age',
        'marital_status',
        'childrens',
        'country_id',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class , 'added_by_provider');
    }

    public function ngos(){
        return $this->belongsToMany(Ngo::class, 'ngos_users')
                    ->withPivot('status','rejected_at','deleted_at')
                    ->withTimestamps();
    }

    public function ngosUsers()
    {
        return $this->hasMany(NgosUsers::class);
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->ngosUsers()->forceDelete();
        });
        static::deleting(function ($user) {
            $user->requests()->delete();
        });
        static::deleting(function ($user) {
            if ($user->id_photo && Storage::disk('uploads')->exists('Civilians/' . $user->id_photo)) {
                Storage::disk('uploads')->delete('Civilians/' . $user->id_photo);
            }
        });
    }
}