<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function authorization()
    {
        return $this->belongsTo(Authorization::class, 'role_id');
    }

    public function hasAccess($config_permission)
    {
        $authorization = $this->authorization;
        foreach ($authorization->permissions as $permission) {
            if ($config_permission == $permission ?? false) {
                return true;
            }
        }
    }
}