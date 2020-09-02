<?php

namespace App\Http\Controllers;

use App\Facades\CounterFacade;
use App\Http\Requests\UpdateUser;
use App\Services\Counter;
use App\User;
use App\Image;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    // index, create, store

    // show
    public function show(User $user)
    {
        return view('users.show', ['user' => $user, 'counter' => CounterFacade::increment("user-{$user->id}")]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    // update user
    public function update(UpdateUser $request, User $user)
    {
        if($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('avatars');

            if($user->image){
                $user->image->path = $path;
                $user->image->save();
            }else{
                $user->image->save(Image::make(['path' => $path]));
            }
        }

        $user->locale = $request->get('locale');
        $user->save();

        return redirect()->back()->withStatus('Profile was updated');
    }

    public function destroy(User $user)
    {}
}
