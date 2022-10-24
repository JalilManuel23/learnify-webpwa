<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function index() 
    {
        $roles = Role::all();

        return view('ejemplo', compact('roles'));
    }

    public function save(RoleRequest $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->key_name = Str::slug($request->name);
        $role->save();

        return redirect('roles');
    }

    public function update($id)
    {
        $role = Role::find($id);
        $role->name = 'Administrativos';
        $role->key_name = 'administrativos';
        $role->save();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
    }
}
