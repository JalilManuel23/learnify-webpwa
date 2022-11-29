<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\InstructoresRequest;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function index() 
    {
        // Conectar a model de Role y extraer todos sus datos
        // $roles = Role::all()->toJson();
        // $roles = Role::all()->toArray();
        // dd($roles);
        $instructors = Instructor::all();

        return view('instructores', compact('instructors'));
    }

    public function save(InstructoresRequest $request)
    {
        $instructors = new Instructor;
        $instructors ->usuario = $request->usuario;
        $instructors ->calificacion = $request->calificacion;
        $instructors ->especialidad = $request->especialidad;
        $instructors ->save();

        return redirect('instructores');
    }

    public function update(Request $request)
    {
        $instructors = Instructor::find($request->id);
        $instructors ->usuario = $request->usuario;
        $instructors ->calificacion = $request->calificacion;
        $instructors ->especialidad = $request->especialidad;
        $instructors ->save();
    }

    public function delete($id)
    {
        Instructor::find($id)->delete();
    }
}
