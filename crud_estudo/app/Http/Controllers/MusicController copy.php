<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\Musica;
use Illuminate\Http\Request;
use App\Services\AudioService;

class MusicController extends Controller
{
    public function index()
    {
        // Busca todos os dias com suas músicas (opcional carregar músicas)
        $dias = Dia::orderBy('data', 'desc')->get();

        return view('music.index', compact('dias'));
    }

    public function show($id)
    {
        // Busca um dia específico junto com suas músicas
        $dia = Dia::with('musicas')->findOrFail($id);

        return view('music.show', compact('dia'));
    }

    // 🗑️ Deletar um dia
    public function deleteDia($id)
    {
        $dia = Dia::findOrFail($id);
        $dia->musicas()->delete(); // Deleta todas as músicas do dia
        $dia->delete();

        return redirect()->route('musicas.index')->with('success', 'Dia deletado com sucesso!');
    }

    // 🗑️ Deletar uma música
    public function deleteMusica($id)
    {
        $musica = Musica::findOrFail($id);
        $musica->delete();

        return back()->with('success', 'Música deletada com sucesso!');
    }
    
    
    
     /**
     * Armazena uma nova música.
     */
    public function store(Request $request , AudioService $audioService)
    {
   
        $validated = $request->validate([
            'prioridade' => 'nullable|integer',
            'descricao'   => 'required|string|max:255',
            'dia_id'      => 'required|exists:dias,id',
            'dica'        => 'nullable|string|max:255',
        ]);


        $diaId =  $validated['dia_id'];
        $dia = Dia::findOrFail($diaId);
        
        try {

            $caminho = $audioService->gerarAudio( $validated['descricao']);

            $musica = $dia->musicas()->create([
                'descricao' =>  $validated['descricao'],
                'dica' => $validated['dica'],
                'url' => $caminho,
                'prioridade' => $request->prioridade ?? 0,
            ]);

            return redirect()->back()->with('success', 'Música adicionada com sucesso!');

        } catch (\Exception $e) 
        {
            
            return response()->json([
                'status' => 'erro',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

}
