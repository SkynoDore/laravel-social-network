<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GroupController;

Route::get('/', [NoteController::class, 'index'])->name('index');
//profile
Route::get('/profile', [NoteController::class, 'profile'])->name('note.profile');
Route::get('/profile/{userId}', [NoteController::class, 'profile'])->name('note.profile.other');

//notes
Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('note.edit');
Route::put('/note/update/{note}', [NoteController::class, 'update'])->name('note.update');
Route::get('/note/{note}', [NoteController::class, 'show'])->name('note.show');
Route::delete('/note/destroy/{note}', [NoteController::class, 'destroy'])->name('note.destroy');
//notes like
Route::post('/notes/{note}/like', [NoteController::class, 'like'])->middleware('auth')->name('notes.like');
//notes category
Route::get('/category/{category}', [NoteController::class, 'category'])->name('note.category');

//dashboard para admins
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/dashboard/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
Route::get('/group/{group}', [GroupController::class, 'show'])->name('group.show');
Route::get('/groups/nearby', [GroupController::class, 'nearby'])->name('group.nearby');

//profile settings
Route::middleware('auth')->group(function () {
    Route::get('/config', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/config', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/config', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//comments
Route::middleware(['auth'])->group(function () {
    Route::post('/notes/{noteId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php'; // Rutas de autenticación
