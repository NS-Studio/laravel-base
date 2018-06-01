<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 29.3.18.
 * Time: 23.22
 */

namespace App\Traits;


trait IsCustomer
{

    public function isCustomer()
    {
        return $this->role === 'customer' || $this->table === 'customers';
    }
}