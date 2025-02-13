<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', [NoteController::class, 'welcome'])->name('welcome');
//notes
Route::get('/my-feed', [NoteController::class, 'index'])->name('note.index');
Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
Route::post('/note/store', [NoteController::class,'store'])->name('note.store');
Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('note.edit');
Route::put('/note/update/{note}', [NoteController::class, 'update' ])->name('note.update');
Route::get('/note/{note}', [NoteController::class, 'show'])->name('note.show');
Route::delete('/note/destroy/{note}', [NoteController::class,'destroy'])->name('note.destroy');

    //dashboard para admins (a futuro)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    //profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    //comments
use App\Http\Controllers\CommentController;

    Route::get('/notes/{noteId}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::middleware(['auth'])->group(function () {
    Route::post('/notes/{noteId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php'; // Rutas de autenticación
