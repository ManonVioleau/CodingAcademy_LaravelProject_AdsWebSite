<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;





use App\Models\Ad;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    // use BasicAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    protected $fillable = [
        'login',
        'email',
        'password',
        'phone_number',
        'nickname',
        'role',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
