<?php

namespace App\Services;

use App\Clients\ElevenLabsClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioService
{
    protected string $apiKey;
    protected string $voiceId;

    public function __construct()
    {
        $this->apiKey = env('ELEVEN_API_KEY');
        $this->voiceId = env('ELEVEN_VOICE_ID', '21m00Tcm4TlvDq8ikWAM'); // voz padrão
    }

    public function gerarAudio(string $texto): string
    {
        $url = "https://api.elevenlabs.io/v1/text-to-speech/{$this->voiceId}/stream";

        $data = [
            'text' => $texto, 
            // 'model_id' => 'eleven_multilingual_v2',
            'voice_settings' => [
                'stability' => 0.7,
                'similarity_boost' => 0.7
            ]
        ];

        $headers = [
            'Content-Type: application/json',
            'xi-api-key: ' . $this->apiKey
        ];

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => implode("\r\n", $headers),
                'content' => json_encode($data),
            ]
        ]);

        $audio = file_get_contents($url, false, $context);

        if (!$audio || str_starts_with($audio, '{')) {
            throw new \Exception("Erro ao gerar áudio");
        }

        $dia = now()->day;        // Ex: 23
        $hour = now()->hour;        // Ex: 23
        $minute = now()->minute;        // Ex: 23
        $mes = now()->month;      // Ex: 6

        $fim = $minute . '_' . $hour . '_' . $dia . '_' . $mes . '_';
        
        $caminho = 'audios/' . $fim . Str::uuid() . '.mp3';

        Storage::disk('public')->put($caminho, $audio);
        $caminho = '/storage' . '/' . $caminho;
        // return Storage::url($caminho);

        return $caminho;
    }
}
