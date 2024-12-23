<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'aid_id',
    ];

    public function aid()
    {
        return $this->belongsTo(Aid::class);
    }

    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }
}