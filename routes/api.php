<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HeloController;
use App\Http\Controllers\SiswaController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('hallo', function(){  
//     $data = ["me" => "hamid_ganteng"];
//     return $data;
// });

// Route::get('hallo', [HeloController::class, 'index']);
Route::resource('hallo', HeloController::class);
Route::resource('siswa', SiswaController::class);
Route::resource('book', BookController::class);


Route::middleware('auth:sanctum')->get('/user', function(Request $request){
    return $request->user();
});

// public route

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::get('/books',[AuthController::class, 'index']);
Route::get('/Books/{id}',[AuthController::class, 'show']);
Route::get('/Authors',[BookController::class, 'index']);
Route::get('/Authors/{id}',[BookController::class, 'show']);

Route::middleware('auth:scantum')->group(function(){
    Route::resource('books', BookController::class)->except('create','edit','show','index');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('authors', AuthorController::class)->except('create','edit','show','index');

});