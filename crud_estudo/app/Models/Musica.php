<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Musica extends Model
{
    //
    use HasFactory;

    protected $fillable = ['descricao', 'url', 'prioridade', 'dia_id','dica'];

    public function dia()
    {
        return $this->belongsTo(Dia::class);
    }
}
