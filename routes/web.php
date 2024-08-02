<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', [TaskController::class, 'index'])->name('task.index');
    Route::get('create', [TaskController::class, 'create'])->name('task.create');
    Route::post('store', [TaskController::class, 'store'])->name('task.store');
    Route::get('{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('{task}/update', [TaskController::class, 'update'])->name('task.update');
    Route::delete('{task}/delete', [TaskController::class, 'delete'])->name('task.delete');
    Route::post('reorder-tasks', [TaskController::class, 'ajaxReorderTasks'])->name('task.reorder');

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        Route::get('create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('store', [ProjectController::class, 'store'])->name('project.store');
    });
});
