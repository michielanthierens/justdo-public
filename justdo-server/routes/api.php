<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\Fitusers_ExerciseController;
use App\Http\Controllers\FitusersController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// route -> controller -> service -> controller (check validation) -> return answer

// users for devs
Route::controller(FitusersController::class)->group(function () {
    Route::get('/users', 'getAllFitusers');
    Route::get('/users/{fitusers_id}', 'getFituserById');
    Route::post('/users', 'createFituser');
    Route::put('/users/{fitusers_id}', 'updateFituser');
    Route::delete('/users/{fitusers_id}', 'deleteFituser');
});

// auth for users in vue
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});

// exercises
Route::controller(ExerciseController::class)->group(function () {
    Route::get('/exercises', 'getAllExercises');
    Route::get('exercises/list', 'getAllExercisesList');
    Route::get('/exercises/{exercise_id}', 'getExerciseById');
    Route::post('/exercises', 'createExercise');
    Route::put('/exercises/{exercise_id}', 'updateExercise');
    Route::delete('/exercises/{exercise_id}', 'deleteExercise');
});

// users_exercises
Route::middleware('auth:api')->group(function () {
    Route::controller(Fitusers_ExerciseController::class)->group(function () {
        Route::get('/users/{fitusers_id}/exercises', 'getExercisesByFituserId');
        Route::post('/users/{fitusers_id}/exercises/{exercise_id}/reps/{number_of_reps}', 'addExerciseToUser');
        Route::put('/users/{fitusers_id}/exercises/{exercise_id}/reps/{number_of_reps}', 'updateExerciseReps');
        Route::delete('users/{fitusrs_id}/exercises/all', 'removeAllExercisesFromUser');
        Route::delete('/users/{fitusers_id}/exercises/{exercise_id}', 'removeExerciseFromUser');
    });
});

