<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', 'App\Http\Controllers\Api\TaskController@index');

Route::prefix('tasks')->group(function () {
    Route::get('/', 'App\Http\Controllers\Api\TaskController@index')->name('get_tasks');
    Route::get('/{id}', 'App\Http\Controllers\Api\TaskController@show')->name('single_task');

    Route::post('/', 'App\Http\Controllers\Api\TaskController@store')->name('store_tasks');
});
