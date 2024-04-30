<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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

// Route::controller(ProjectController::class)->group(function () {
//     Route::get('projects', 'index');
//     Route::get('projects/{project}', 'show');

//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('projects', 'store');
//         Route::put('projects/{project}', 'update');
//         Route::delete('projects/{project}', 'destroy');

//         Route::post('projects/{project}/links', 'storeLink');
//         Route::put('projects/{project}/links/{link}', 'updateLink');
//         Route::delete('projects/{project}/links', 'destroyLinks');

//         Route::post('projects/{project}/images', 'storeImage');
//         Route::delete('projects/{project}/images', 'destroyImages');
//     });
// });
