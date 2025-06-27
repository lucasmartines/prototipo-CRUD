<?php
namespace App\Http\Controllers;

use App\Models\Dia;
use Illuminate\Http\Request;
use App\Services\MusicaService;

class MusicController extends Controller
{
    public function __construct(
        protected MusicaService $musicaService
    ) {}

    public function index()
    {
        $dias = Dia::orderBy('data', 'desc')->get();
        return view('music.index', compact('dias'));
    }

    public function show($id)
    {
        $dia = Dia::with('musicas')->findOrFail($id);
        return view('music.show', compact('dia'));
    }

    public function deleteDia($id)
    {
        $this->musicaService->deletarDia($id);
        return redirect()->route('musicas.index')->with('success', 'Dia deletado com sucesso!');
    }

    public function deleteMusica($id)
    {
        $this->musicaService->deletarMusica($id);
        return back()->with('success', 'Música deletada com sucesso!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prioridade' => 'nullable|integer',
            'descricao'  => 'required|string|max:255',
            'dia_id'     => 'required|exists:dias,id',
            'dica'       => 'nullable|string|max:255',
        ]);

    
        try {
            $this->musicaService->adicionarMusica($validated);
            return redirect()->back()->with('success', 'Música adicionada com sucesso!');
        } catch (\Throwable $e) {
            return back()->withErrors(['erro' => $e->getMessage()]);
        }
    }
}
