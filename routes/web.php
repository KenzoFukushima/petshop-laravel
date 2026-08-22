<?php

use App\Http\Controllers\DonoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name("loginSubmit");

// Rotas de Pet

Route::get('/dono/{id_dono}/new-pet', [PetController::class, 'newPet'])->name('new.pet');
Route::post('/new-pet-submit', [PetController::class, 'newPetSubmit'])->name('newPetSubmit');

Route::get('/edit-pet/{id}', [PetController::class, 'editPet'])->name('edit.pet');
Route::post('/edit-pet-submit', [PetController::class, 'editPetSubmit'])->name('edit.pet.submit');

Route::get('/delete-pet/{id}', [PetController::class, 'deletePet'])->name('delete.pet');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas de Dono

Route::get('/lista-dono', [DonoController::class, 'index'])->name('telaListaDono');

Route::get('/new-dono', [DonoController::class, 'newDono'])->name('new.dono');
Route::post('/new-dono-submit', [DonoController::class, 'newDonoSubmit'])->name('newDonoSubmit');

Route::get('/edit-dono/{id}', [DonoController::class, 'editDono'])->name('edit.dono');
Route::post('/edit-dono-submit', [DonoController::class, 'editDonoSubmit'])->name('edit.dono.submit');

Route::get('/delete-dono/{id}', [DonoController::class, 'deleteDono'])->name('delete.dono');