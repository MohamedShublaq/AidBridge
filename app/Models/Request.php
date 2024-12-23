<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    //For Status Column
    public const PENDING = 1;
    public const APPROVED = 2;
    public const REJECTED = 3;
    public const UNAVAILABLE = 4;
    public const DEFAULT_STATUS = self::PENDING;

    protected $fillable = [
        'aid_id',
        'user_id',
        'status',
    ];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }
}