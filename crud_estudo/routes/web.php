<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\DiaController;


Route::get('/', function () {
    return redirect('/musicas');
});


// rotas post
Route::post('/musicas/store', [MusicController::class, 'store'])->name('musicas.store');
Route::post('/dias/store', [DiaController::class, 'store'])->name('dias.store');

Route::post('/musicas/store2', [MusicController::class, 'store2'])->name('musicas.store2');


// rotas get
Route::get('/musicas', [MusicController::class, 'index'])->name('musicas.index');
Route::get('/musicas/{id}', [MusicController::class, 'show'])->name('musicas.show');

// Rotas para deletar
Route::delete('/musicas/dia/{id}', [MusicController::class, 'deleteDia'])->name('musicas.delete.dia');
Route::delete('/musicas/musica/{id}', [MusicController::class, 'deleteMusica'])->name('musicas.delete.musica');



/** teste */
Route::get('/music' , function () {

    $response = Http::withHeaders([
        'xi-api-key' => env('ELEVEN_API_KEY'),
    ])->get('https://api.elevenlabs.io/v1/voices');

    print_r($response->json());

});

Route::get('/teste-url', function() 
{
        $dia = now()->day;        // Ex: 23
        $mes = now()->month;      // Ex: 6
        $caminho = 'audios/' . $dia. '_' . $mes . '_' . Str::uuid() . '.mp3';
        Storage::disk('public')->put($caminho, 'teste');
        // $caminho = '/storage' . '/' . $caminho;
        return Storage::url($caminho);
        
        // return $caminho;
});