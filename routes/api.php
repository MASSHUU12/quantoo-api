<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes related to books
Route::get("books/{number}", [BookController::class, "show"]);
Route::post("book", [BookController::class, "store"]);
Route::post("book/{id}", [BookController::class, "update"]);
Route::delete("book/{id}", [BookController::class, "destroy"]);

// Routes related to authors
Route::post("author", [AuthorController::class, "store"]);
Route::delete("author/{number}", [AuthorController::class, "destroy"]);
Route::get("author/{name}", [AuthorController::class, 'show']);
Route::get("author/{id}/books", [BookController::class, 'showByAuthor']);
