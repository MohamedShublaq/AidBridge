<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NgosUsers extends Model
{
    use HasFactory , SoftDeletes;

    //For Status Column
    public const PENDING = 1;
    public const APPROVED = 2;
    public const REJECTED = 3;
    public const DEFAULT_STATUS = self::PENDING;

    protected $fillable = [
        'user_id',
        'ngo_id',
        'status',
        'rejected_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }
}