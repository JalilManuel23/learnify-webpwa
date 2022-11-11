<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias', compact('categorias'));
    }

    public function save(CategoriaRequest $request)
    {
        $categorias = new Categoria;
        $categorias->titulo      = $request->titulo;
        $categorias->curso = $request->curso;
        
        $categorias->save();

        return redirect('categorias');
    }

    public function update($id)
    {
        $categorias = Categoria::find($id);
        $categorias->titulo      = '';
        $categorias->curso   = '';
        $categorias->save();

        return redirect('categorias');
    }

    public function delete(Request $request)
    {
        $categorias = Categoria::find($request->id);
        $categorias->delete();

        return redirect('categorias');
    }
}
