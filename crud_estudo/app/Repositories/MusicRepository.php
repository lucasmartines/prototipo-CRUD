<?php

namespace App\Repositories;

use App\Models\Musica;

class MusicaRepository
{
    public function create(array $data): Musica
    {
        return Musica::create($data);
    }

    public function delete(int $id): bool
    {
        return Musica::where('id', $id)->delete();
    }

    public function findById(int $id): ?Musica
    {
        return Musica::find($id);
    }

    public function getByDiaId(int $diaId)
    {
        return Musica::where('dia_id', $diaId)->orderBy('prioridade')->get();
    }
}
