<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudianteRequest;
use App\Models\Estudiante;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();

        return view('estudiante', compact('estudiantes'));
    }

    public function save(EstudianteRequest $request)
    {
        $estudiantes = new Estudiante;
        $estudiantes->name = $request->name;
        $estudiantes->key_name = Str::slug($request->name);
        $estudiantes->save();

        return redirect('estudiantes');
    }

    public function update($id)
    {
        $estudiantes = Estudiante::find($id);
        $estudiantes->name = '';
        $estudiantes->key_name = '';
        $estudiantes->save();
    }

    public function delete($id)
    {
        Estudiante::find($id)->delete();
    }
}
