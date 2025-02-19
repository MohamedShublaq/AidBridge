<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use HasFactory;

    public const NUTRITIONAL = 1;
    public const CASH = 2;
    public const MEDICAL = 3;

    public const DEFAULT_TYPE = self::NUTRITIONAL;

    protected $fillable = [
        'name',
        'description',
        'type',
        'quantity',
        'from',
        'due',
        'ngo_id',
    ];


    public function ngo(){
        return $this->belongsTo(Ngo::class , 'ngo_id');
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }

    public function locations(){
        return $this->belongsToMany(Location::class , 'aid_locations');
    }

    public function aidLocations()
    {
        return $this->hasMany(AidLocation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($aid) {
            $aid->requests()->delete();
        });
        static::deleting(function ($aid) {
            $aid->aidLocations()->delete();
        });
    }
}