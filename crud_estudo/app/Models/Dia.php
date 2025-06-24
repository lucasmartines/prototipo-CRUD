<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dia extends Model
{
     use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'data'];

    public function musicas()
    {
        return $this->hasMany(Musica::class);
    }
}
