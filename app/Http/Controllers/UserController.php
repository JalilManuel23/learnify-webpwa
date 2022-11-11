<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::all();
        return view('users', compact('usuarios'));
    }

    public function save(UserRequest $request)
    {
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();

        return redirect('usuarios');
    }

    public function update(Request $request)
    {
        $usuario = User::find($request->id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();

        return redirect('usuarios');
    }

    public function delete(Request $request)
    {
        $usuario = User::find($request->id);
        $usuario->delete();

        return redirect('usuarios');
    }
}
