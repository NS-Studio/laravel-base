<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;

class AdminController extends Controller
{

    public function panel()
    {
        return redirect()->to( '/#/admin/panel' );
    }

    public function listUsers()
    {
        $users = User::all();

        return response()->json( compact( 'users' ) );
    }

    public function store( UserRequest $request )
    {
        $this->validate( $request, [
            'password' => 'required',
        ] );

        $request->merge( [

            'password' => bcrypt( $request->get( 'password' ) ),
        ] );

        /**
         * @var $user User
         */
        $user = User::create( $request->all() );

        return response()->json( compact( 'user' ) );
    }

    public function update( UserRequest $request, User $user )
    {
        $user->update( $request->all() );

        return response()->json( compact( 'user' ) );
    }

    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete( User $user )
    {
        $user->delete();

        return response()->json( 'success' );
    }
}
