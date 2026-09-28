<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])
    ->name('home');

Route::prefix('dashboard')->group(function() {
    Route::get('/about', [PageController::class, 'about'])
        ->name('about');
    Route::get('/project-idea', [PageController::class, 'project'])
        ->name('project');
});
Route::get('/hitung/{angka1}/{angka2}/{operasi}', [PageController::class, 'kalkulator'])
    ->name('kalkulator');
Route::get('/mahasiswa/{nrp}', [PageController::class, 'mahasiswa'])
    ->where('nrp', '[0-9]{10}')
    ->name('mahasiswa.show');
Route::get('/agent/{tema?}', [AgentController::class, 'agent'])
    ->name('agent');
Route::get('/hitung-ipk', [PageController::class, 'hitungipkForm'])
    ->name('hitung-ipk');
Route::get('/hitung-ipk/{ip1}/{ip2}', [PageController::class, 'hitungipkResult'])
    ->name('hitung-ipk.result');
Route::post('/hitung-ipk', [PageController::class, 'hitungipk'])
    ->name('hitung-ipk.calculate');

Route::get('/profil-mahasiswa', [PageController::class, 'profilMahasiswa'])
    ->name('profilMahasiswa');
Route::get('/ide-agent', [PageController::class, 'ideAgent'])
    ->name('ideAgent');

Route::get('/form', [PageController::class, 'form'])
    ->name('form.get');
Route::post('/form', [PageController::class, 'formPost'])
    ->name('form.post');


Route::fallback(function () {
    return response()->view('fallback', ['pageTitle' => 'Not Found'], 404);
})
    ->name('fallback');