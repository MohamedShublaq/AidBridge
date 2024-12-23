<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'ngo_id',
    ];

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }

    public function users(){
        return $this->hasMany(User::class , 'added_by_provider');
    }
}