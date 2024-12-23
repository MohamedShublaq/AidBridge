<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function ngos()
    {
        return $this->belongsToMany(Ngo::class, 'ngos_donors')
            ->withPivot('status', 'rejected_at', 'deleted_at')
            ->withTimestamps();
    }

    public function ngosDonors()
    {
        return $this->hasMany(NgosDonors::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($donor) {
            $donor->ngosDonors()->forceDelete();
        });
    }
}