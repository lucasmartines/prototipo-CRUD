<?php
// app/Services/MusicaService.php
namespace App\Services;

use App\Models\Dia;
use App\Models\Musica;
use App\Services\AudioService;
use Illuminate\Support\Facades\DB;

class MusicaService
{
    public function __construct(
        protected AudioService $audioService
    ) {}

    public function adicionarMusica(array $data): Musica
    {
       
        return DB::transaction(function () use ($data) {
            
            $dia = Dia::findOrFail($data['dia_id']);
          

            $url = $this->audioService->gerarAudio($data['descricao']);

            return $dia->musicas()->create([
                'descricao' => $data['descricao'],
                'dica' => $data['dica'] ?? null,
                'url' => $url,
                'prioridade' => $data['prioridade'] ?? 0,
            ]);
        });
    }

    public function deletarDia(int $id): void
    {
        $dia = Dia::findOrFail($id);
        $dia->musicas()->delete();
        $dia->delete();
    }

    public function deletarMusica(int $id): void
    {
        $musica = Musica::findOrFail($id);
        $musica->delete();
    }
}
