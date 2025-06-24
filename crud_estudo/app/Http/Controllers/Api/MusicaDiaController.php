<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dia;
use App\Models\Musica;
use Illuminate\Support\Facades\Storage;
use App\Services\AudioService;

class MusicaDiaController extends Controller
{
    // ▶️ Listar todos os dias com músicas
    public function listarDias()
    {
        return Dia::with('musicas')->get();
    }

    // ▶️ Criar um Dia
    public function criarDia(Request $request)
    {

         $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'nullable|string',
            'data' => 'required|date',
        ]);
        

        $dia = Dia::create($request->only(['titulo', 'descricao', 'data']));

        return response()->json(  
            [
                'msg' => 'mensagem: tudo certo' ,
                'retorno' => $dia
            ] 
        , 201);


    }

    // ▶️ Adicionar uma música a um Dia
    public function adicionarMusica(Request $request, $diaId , AudioService $audioService)
    {
        $request->validate([
            'texto' => 'required|string',
            'prioridade' => 'nullable|integer',
            // 'arquivo' => 'required|file|mimes:mp3',
        ]);

        $dia = Dia::findOrFail($diaId);
        $texto = $request->input('texto');
        $dica = $request->input('dica');

        try {

            $caminho = $audioService->gerarAudio($texto);

            $musica = $dia->musicas()->create([
                'descricao' => $texto,
                'dica' => $dica,
                'url' => $caminho,
                'prioridade' => $request->prioridade ?? 0,
            ]);

            return response()->json([
                'status' => 'ok',
                'url' => asset($caminho),
            ]);


        } catch (\Exception $e) 
        {
            
            return response()->json([
                'status' => 'erro',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    // ▶️ Listar músicas de um Dia específico
    public function listarMusicas($diaId)
    {
        $dia = Dia::with('musicas')->findOrFail($diaId);

        return response()->json($dia);
    }


    // 🗑️ Deletar um dia com suas músicas
    public function deleteDia($id)
    {
        $dia = Dia::find($id);

        if (!$dia) {
            return response()->json(['error' => 'Dia não encontrado'], 404);
        }

        $dia->musicas()->delete();
        $dia->delete();

        return response()->json(['message' => 'Dia deletado com sucesso']);
    }

    // 🗑️ Deletar uma música
    public function deleteMusica($id)
    {
        $musica = Musica::find($id);

        if (!$musica) {
            return response()->json(['error' => 'Música não encontrada'], 404);
        }

        $musica->delete();

        return response()->json(['message' => 'Música deletada com sucesso']);
    }

    public function adicionarMusicasEmLote(Request $request ,   AudioService $audioService)
    {
        $request->validate([
            'dia_id' => 'required|exists:dias,id',
            'musicas' => 'required|array',
            'musicas.*.descricao' => 'required|string',
            'musicas.*.prioridade' => 'nullable|integer',
            'musicas.*.dica' => 'nullable|string',
        ]);

        $dia = Dia::findOrFail($request->dia_id);

        foreach ($request->musicas as $musicaData) {

            $caminho = $audioService->gerarAudio($musicaData['descricao']);

            $dia->musicas()->create([
                'descricao' => $musicaData['descricao'],
                'prioridade' => $musicaData['prioridade'] ?? 0,
                'dica' => $musicaData['dica'] ?? null,
                'url' => $caminho, // ou defina se tiver
            ]);
        }

        return response()->json([
            'message' => 'Músicas adicionadas com sucesso',
            'dia_id' => $dia->id
        ], 201);
    }
}
