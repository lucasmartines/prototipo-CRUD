<?php

namespace App\Services\AudioSources;

use App\Contracts\AudioSourceInterface;
use Illuminate\Http\UploadedFile;

class UploadedAudio implements AudioSourceInterface
{
    protected UploadedFile $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function getAudio(): string
    {
        return file_get_contents($this->file->getRealPath());
    }
}
