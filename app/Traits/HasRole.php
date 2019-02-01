<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 2/1/19
 * Time: 5:22 PM
 */

namespace App\Traits;

trait HasRole
{
    public function hasRole($role)
    {

        return $this->role === $role;
    }

    public function hasAnyRole()
    {
        foreach (func_get_args() as $role) {

            if ($this->role === $role) {

                return true;
            }
        }

        return false;
    }
}