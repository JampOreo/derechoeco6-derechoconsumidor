<?php

namespace App\Http\Controllers;

use App\Models\Juridico;
use Illuminate\Http\Request;

class JuridicoController extends Controller
{
    public function index()
    {
        $juridicos = Juridico::all();
        return view('juridico.index', compact('juridicos'));
    }

    public function create()
    {
        return view('juridico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'nullable|string|max:255',
            'contenido' => 'required|string',
        ]);

        Juridico::create($request->all());

        return redirect()->route('juridico.index')->with('success', 'Contenido jurídico guardado.');
    }

    public function edit(Juridico $juridico)
    {
        return view('juridico.edit', compact('juridico'));
    }

    public function update(Request $request, Juridico $juridico)
    {
        $request->validate([
            'titulo' => 'nullable|string|max:255',
            'contenido' => 'required|string',
        ]);

        $juridico->update($request->all());

        return redirect()->route('juridico.index')->with('success', 'Contenido actualizado.');
    }

    public function destroy(Juridico $juridico)
    {
        $juridico->delete();
        return redirect()->route('juridico.index')->with('success', 'Contenido eliminado.');
    }
}