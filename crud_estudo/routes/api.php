<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\MusicaDiaController;


Route::get('/test', function () {
    return ['status' => 'API funcionando!'];
});

// Route::post('/dias', [DiaController::class, 'store']);

Route::get('/dias', [MusicaDiaController::class, 'listarDias']);
Route::post('/dias', [MusicaDiaController::class, 'criarDia']);

Route::get('/dias/{dia}/musicas', [MusicaDiaController::class, 'listarMusicas']);
Route::post('/dias/{dia}/musicas', [MusicaDiaController::class, 'adicionarMusica']);

Route::post('/musicas/adicionar-em-lote', [MusicaDiaController::class, 'adicionarMusicasEmLote']);


Route::delete('/dias/{id}', [MusicaDiaController::class, 'deleteDia']);
Route::delete('/musicas/{id}', [MusicaDiaController::class, 'deleteMusica']);