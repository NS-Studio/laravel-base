<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 29.3.18.
 * Time: 22.39
 */

namespace App\Traits;


trait IsAdmin
{

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}