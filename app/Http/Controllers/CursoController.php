<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Cursos;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Cursos::all();

        return view('cursos', compact('cursos'));
    }

    public function save(CursoRequest $request)
    {
        $cursos = new Cursos;
        $cursos->instructor  = $request->instructor;
        $cursos->categoria   = $request->categoria;
        $cursos->duracion    = $request->duracion;
        $cursos->titulo      = $request->titulo;
        $cursos->descripcion = $request->descripcion;
        $cursos->precio      = $request->precio;
        
        $cursos->save();

        return redirect('cursos');
    }

    public function update($id)
    {
        $cursos = Cursos::find($id);
        $cursos->instructor  = '';
        $cursos->categoria   = '';
        $cursos->duracion    = '';
        $cursos->titulo      = '';
        $cursos->descripcion = '';
        $cursos->precio      = '';
        $cursos->save();

        return redirect('cursos');
    }

    public function delete(Request $request)
    {
        $cursos = Cursos::find($request->id);
        $cursos->delete();

        return redirect('cursos');
    }
}
