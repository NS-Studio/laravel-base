<?php

namespace App;

use App\Traits\HasRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRole, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'locale',
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

    public function scopeLoadRoles()
    {
        $this->isUser = $this->hasRole('user');
        $this->isAdmin = $this->hasRole('admin');
        $this->isCompany = $this->hasRole('company');
        $this->isCustomer = $this->hasRole('customer');
        $this->isDeveloper = $this->hasRole('developer');

        return $this;
    }
}
