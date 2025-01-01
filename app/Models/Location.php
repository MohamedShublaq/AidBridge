<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ngo_id',
    ];

    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }

    public function ngo(){
        return $this->belongsTo(Ngo::class);
    }

    public function aids(){
        return $this->belongsToMany(Aid::class , 'aid_locations');
    }

    public function aidLocations()
    {
        return $this->hasMany(AidLocation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($location) {
            $location->aidLocations()->delete();
        });
        static::deleting(function ($location) {
            $location->aidDistributions()->delete();
        });
    }
}