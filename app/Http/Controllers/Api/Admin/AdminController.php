<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\UserResource;
use App\Notifications\UserCreatedNotification;
use App\User;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function panel()
    {
        return redirect()->to('/admin/panel');
    }

    public function index()
    {
        $users = UserResource::collection(User::all());

        return response()->json(compact('users'));
    }

    public function store(UserRequest $request)
    {
        $password = str_random(8);

        $request->merge([

            'password' => bcrypt($password),
        ]);

        /**
         * @var $user User
         */
        $user = User::create($request->all());

        App::setLocale($request->get('locale'));

        $user->notify(new UserCreatedNotification($password));

        return response()->json(compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->json(compact('user'));
    }

    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $user->delete();

        return response()->json('success');
    }
}
