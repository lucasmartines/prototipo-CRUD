<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Armazena um novo dia.
     */
    public function store(Request $request)
    {
        // 🔍 Validação dos dados
        $validated = $request->validate([
            'data'       => 'required|date',
            'titulo'     => 'required|string|max:255',
            'descricao'  => 'nullable|string|max:1000',
        ]);

        // 💾 Salvar no banco de dados
        Dia::create([
            'data'      => $validated['data'],
            'titulo'    => $validated['titulo'],
            'descricao' => $validated['descricao'],
        ]);

        // 🔁 Redirecionar com sucesso
        return redirect()->back()->with('success', 'Dia criado com sucesso!');
    }
}
