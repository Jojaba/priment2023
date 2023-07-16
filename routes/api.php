<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

// Obtenir toutes les actualités
Route::get('posts', function () {
    return response(Post::all(),200);
});

// Obtenir une actualité particulière
Route::get('post-{post_id}', function ($post_id) {
    return response(Post::find($post_id), 200);
});

