<?php

namespace App;

use App\Traits\IsAdmin;
use App\Traits\IsCompany;
use App\Traits\IsCustomer;
use App\Traits\IsUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,
        IsAdmin,
        IsCompany,
        IsCustomer,
        IsUser,
        HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'locale',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
