<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks/{task}/edit', [TaskController::class , 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class , 'update'])->name('tasks.update');
