<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletionResponse extends Model
{
    use HasFactory;

    //For Status Column
    public const REJECTED = 0;
    public const APPROVED = 1;

    protected $fillable = [
        'deletion_request_id',
        'admin_id',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function deletionRequest()
    {
        return $this->belongsTo(DeletionRequest::class);
    }
}