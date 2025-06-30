<?php

namespace App\Services;

use App\Clients\ElevenLabsClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioService
{
    // protected string $apiKey;
    // protected string $voiceId;

    protected ElevenLabsClient $client;


    public function __construct(ElevenLabsClient $client)
    {
        $this->client = $client;
    }
 
    public function gerarAudio(string $texto): string
    {

        $audio = $this->client->gerarAudio($texto);

        $nomeArquivo = now()->format('i_H_d_m_') . Str::uuid() . '.mp3';
        $caminho = 'audios/' . $nomeArquivo;

        Storage::disk('public')->put($caminho, $audio);

        return '/storage/' . $caminho;

    }
    
}
