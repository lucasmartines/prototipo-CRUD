<?php

namespace App\Services\AudioSources;

use App\Contracts\AudioSourceInterface;
use App\Clients\ElevenLabsClient;

class ElevenLabsAudio implements AudioSourceInterface
{
    protected string $texto;
    protected ElevenLabsClient $client;

    public function __construct(string $texto, ElevenLabsClient $client)
    {
        $this->texto = $texto;
        $this->client = $client;
    }

    public function getAudio(): string
    {
        return $this->client->gerarAudio($this->texto); // binário do áudio
    }
}
