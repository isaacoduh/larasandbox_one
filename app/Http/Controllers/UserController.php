<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Authorizable;

class UserController extends Controller
{
    use Authorizable;
    public function index()
    {
        $result = User::latest()->paginate();
        return view('user.index', compact('result'));
    }

    public function create()
    {
        $result = Role::pluck('name', 'id');
        return view('user.new',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // create user
        if($user = User::create($request->except('roles', 'permissions'))){
            $this->syncPermissions($request, $user);
            flash('User has been created');
        }else{
            flash()->error('Unable to create user.');
        }

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name','id');
        return view('user.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        // get user
        $user = User::findOrFail($id);

        // update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if($request->get('password')){
            $user->password = bcrypt($request->get('password'));
        }

        // handle the user roles
        $this->syncPermissions($request, $user);
        $user->save();
        flash()->success('User has been updated');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if(User::findOrFail($id)->delete()){
            flash()->success('User has been deleted');
        }else{
            flash()->success('User not deleted');
        }
    }

    private function syncPermissions(Request $request, $user)
    {
        // get submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);
        // get the roles
        $roles = Role::find($roles);
        // check for current role changes
        if(!$user->hasAllRoles($roles)){
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        }else{
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
