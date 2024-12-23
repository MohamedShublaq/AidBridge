<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    //For status Column
    public const UNREAD = 0;
    public const READ = 1;
    public const DEFAULT_STATUS = self::UNREAD;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'body',
        'status',
    ];
}
