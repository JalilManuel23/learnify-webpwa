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
        $estudiante = new Estudiante;
        $estudiante->nombre = $request->nombre;
        $estudiante->save();

        return redirect('estudiantes');
    }

    public function update($id)
    {
        $estudiante = Estudiante::find($id);
        $estudiante->nombre = '';
        $estudiante->save();

        return redirect('estudiantes');
    }

    public function delete(Request $request)
    {
        $estudiante = Estudiante::find($request->id);
        $estudiante->delete();

        return redirect('estudiantes');
    }
}
