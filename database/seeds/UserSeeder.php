<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Username: admin@admin.com
         * Password: test123
         */
        User::create( [

            'name'     => 'Admin User',
            'email'    => 'admin@admin.com',
            'password' => bcrypt( 'test123' ),
            'role'     => 'admin',
        ] );
    }
}
