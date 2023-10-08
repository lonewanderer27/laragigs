<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello World!',
    ], 200);
});

Route::get('/search', function (Request $request) {
    dd($request);
});

Route::get('/posts', function () {
    return response()->json([
        'posts' => [
            'title' => 'Post One',
            'title2' => 'Post Two',
            'title3' => 'Post Three',
        ]
    ], 201);
});