<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 5/23/18
 * Time: 3:22 PM
 */

namespace App\Traits;


trait IsUser
{

    public function isUser()
    {
        return $this->role === 'user';
    }
}