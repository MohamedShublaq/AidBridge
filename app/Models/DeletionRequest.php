<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletionRequest extends Model
{
    use HasFactory;

    //For Status Column
    public const PENDING = 1;
    public const APPROVED = 2;
    public const REJECTED = 3;
    public const DEFAULT_STATUS = self::PENDING;

    protected $fillable = [
        'deletable_type',
        'deletable_id',
        'requester',
        'status',
    ];

    public function deletable()
    {
        return $this->morphTo();
    }

    public function admin(){
        return $this->belongsTo(Admin::class , 'requester');
    }

    public function responses()
    {
        return $this->hasMany(DeletionResponse::class);
    }
}