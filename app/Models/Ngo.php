<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Ngo extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'email',
        'password',
        'address',
        'phone',
        'logo',
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


    public function users(){
        return $this->belongsToMany(User::class, 'ngos_users')
                    ->withPivot('status','rejected_at','deleted_at')
                    ->withTimestamps();
    }

    public function donors(){
        return $this->belongsToMany(Donor::class, 'ngos_donors')
                    ->withPivot('status','rejected_at','deleted_at')
                    ->withTimestamps();
    }

    public function locations(){
        return $this->hasMany(Location::class);
    }

    public function aids(){
        return $this->hasMany(Aid::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function ngosDonors()
    {
        return $this->hasMany(NgosDonors::class);
    }

    public function ngosUsers()
    {
        return $this->hasMany(NgosUsers::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($ngo) {
            $ngo->locations()->delete();
        });
        static::deleting(function($ngo) {
            $ngo->aids()->delete();
        });
        static::deleting(function($ngo) {
            $ngo->providers()->delete();
        });
        static::deleting(function ($ngo) {
            $ngo->ngosDonors()->forceDelete();
        });
        static::deleting(function ($ngo) {
            $ngo->ngosUsers()->forceDelete();
        });
        static::deleting(function ($ngo) {
            if ($ngo->logo && Storage::disk('uploads')->exists('Ngos/' . $ngo->logo)) {
                Storage::disk('uploads')->delete('Ngos/' . $ngo->logo);
            }
        });
    }
}