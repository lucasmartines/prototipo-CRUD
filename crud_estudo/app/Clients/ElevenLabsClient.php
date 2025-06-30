<?php 

namespace App\Clients;

class ElevenLabsClient
{
    protected string $apiKey;
    protected string $voiceId;

    public function __construct(string $apiKey, string $voiceId)
    {
        $this->apiKey = $apiKey;
        $this->voiceId = $voiceId;
    }

    public function gerarAudio(string $texto): string
    {
        $url = "https://api.elevenlabs.io/v1/text-to-speech/{$this->voiceId}/stream";

        $data = [
            'text' => $texto,
            'voice_settings' => [
                'stability' => 0.7,
                'similarity_boost' => 0.7,
            ],
        ];

        $headers = [
            'Content-Type: application/json',
            'xi-api-key: ' . $this->apiKey,
        ];

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => implode("\r\n", $headers),
                'content' => json_encode($data),
            ],
        ]);

        $audio = file_get_contents($url, false, $context);

        if (!$audio || str_starts_with($audio, '{')) {
            throw new \Exception('Erro ao gerar áudio');
        }

        return $audio;
    }
}
