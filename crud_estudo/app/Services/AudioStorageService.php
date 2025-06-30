<?php 


namespace App\Services;

use App\Contracts\AudioSourceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioStorageService
{
    public function salvar(AudioSourceInterface $source): string
    {
        $audio = $source->getAudio();

        $nomeArquivo = 'audios/' . now()->format('Ymd_His') . '_' . Str::uuid() . '.mp3';
        Storage::disk('public')->put($nomeArquivo, $audio);

        return '/storage/' . $nomeArquivo;
    }
}
