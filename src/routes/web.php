<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FolderController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::post('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
Route::get('/folders/create', [FolderController::class, 'create'])->name('folders.create');
Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');