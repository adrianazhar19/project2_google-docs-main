<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CollaboratorController;

Route::get('/', function () {
    return redirect('/documents');
});

Route::get('/dashboard', function () {
    return redirect('/documents');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('documents', DocumentController::class);

    Route::post('/documents/{id}/typing', [DocumentController::class, 'typing']);

    Route::post('/documents/{document}/invite', [CollaboratorController::class, 'invite'])
        ->name('documents.invite');

    Route::put('/documents/{document}/collaborator/{user}', [CollaboratorController::class, 'update'])
        ->name('documents.collaborator.update');

    Route::delete('/documents/{document}/collaborator/{user}', [CollaboratorController::class, 'destroy'])
        ->name('documents.collaborator.destroy');
});

require __DIR__.'/auth.php';