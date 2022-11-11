<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamenRequest;
use App\Models\Examen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        $examenes = Examen::all();

        return view('examenes', compact('examenes'));
    }

    public function save(ExamenRequest $request)
    {
        $examenes = new Examen;
        $examenes->curso = $request->curso;
        $examenes->pregunta = $request->pregunta;
        $examenes->avance = $request->avance;
        $examenes->titulo = $request->titulo;
        $examenes->calificacion = $request->calificacion;
        
        $examenes->save();

        return redirect('examenes');
    }

    public function update($id)
    {
        $examenes = Examen::find($id);
        $examenes->curso = '';
        $examenes->pregunta = '';
        $examenes->avance = '';
        $examenes->titulo = '';
        $examenes->calificacion = '';
        $examenes->save();

        return redirect('examenes');
    }

    public function delete(Request $request)
    {
        $examenes = Examen::find($request->id);
        $examenes->delete();

        return redirect('examenes');
    }
}
