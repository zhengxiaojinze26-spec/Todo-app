<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/',function(){return redirect('/todos');});
Route::resource('todos', TodoController::class);
Route::PATCH('/todos/{todo}/complete',[TodoController::class,'complete']);
