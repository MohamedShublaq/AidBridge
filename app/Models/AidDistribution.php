<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidDistribution extends Model
{
    use HasFactory;

    //For Status Column
    public const NOT_RECEIVED = 0;
    public const RECEIVED = 1;
    public const DEFAULT_STATUS = self::NOT_RECEIVED;

    protected $fillable = [
        'request_id',
        'location_id',
        'distribution_date',
        'status',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}