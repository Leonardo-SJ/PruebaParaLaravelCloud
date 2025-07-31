<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ExerciseController;
use App\Http\Controllers\API\ExerciseWebController;
use App\Http\Controllers\Controladores\UsuarioController;



// routes/web.php

Route::get('/exercises', [ExerciseWebController::class, 'index'])->name('exercises.index');

Route::get('/exercises', [ExerciseController::class, 'getAllExercises']);
Route::get('/bodyparts', [ExerciseController::class, 'getBodyParts']);
Route::get('/exercises/bodypart/{bodyPart}', [ExerciseController::class, 'getExercisesByBodyPart']);
    Route::get('/usuarios', [UsuarioController::class, 'apiList'])->name('api.usuarios.index');
    Route::get('/usuarios/{id}', [UsuarioController::class, 'apiShow'])->name('api.usuarios.show');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('api.usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('api.usuarios.destroy');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('api.usuarios.store');
