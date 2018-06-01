<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 29.3.18.
 * Time: 22.40
 */

namespace App\Traits;


trait IsCompany
{

    public function isCompany()
    {
        return $this->role === 'company';
    }
}