<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'aid_id',
        'location_id',
    ];

    public function aid()
    {
        return $this->belongsTo(Aid::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}