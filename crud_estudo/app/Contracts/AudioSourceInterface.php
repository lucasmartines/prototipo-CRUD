<?php 

namespace App\Contracts;

interface AudioSourceInterface
{
    /**
     * Retorna o conteúdo binário do áudio
     */
    public function getAudio(): string;
}
