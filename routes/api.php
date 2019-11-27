<?php

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

Route::group([
    'prefix' => '',
    'middleware' => []
], function () {
    Route::post('/task', [
        'middleware' => [],
        'uses' => 'TaskController@store',
        'as' => 'task.create',
    ]);

    Route::put('/task/{id}', [
        'middleware' => [],
        'uses' => 'TaskController@update',
        'as' => 'task.update',
    ]);
});
