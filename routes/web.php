<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiConsumer\TaskApiController;


Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [TaskApiController::class, 'loginForm'])->name('login.form');
Route::post('/login', [TaskApiController::class, 'login'])->name('login');
Route::post('/logout', [TaskApiController::class, 'logout'])->name('logout');

Route::middleware('web')->group(function () {
    Route::get('/tasks', [TaskApiController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskApiController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskApiController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskApiController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskApiController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskApiController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskApiController::class, 'destroy'])->name('tasks.destroy');
    // Search and filtering
    Route::get('/tasks/status/{status}', [TaskApiController::class, 'filterByStatus'])->name('tasks.filter');
    Route::get('/tasks/search', [TaskApiController::class, 'search'])->name('tasks.search');

    // Trash management
    Route::get('/tasks/trashed', [TaskApiController::class, 'trashed'])->name('tasks.trashed');
    Route::patch('/tasks/{id}/restore', [TaskApiController::class, 'restore'])->name('tasks.restore');
    Route::delete('/tasks/{id}/force', [TaskApiController::class, 'forceDelete'])->name('tasks.forceDelete');
});
