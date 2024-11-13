<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {

    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts ]);

});

Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'postLogin']);
Route::get("/login", [UserController::class, 'getLogin']);


Route::middleware([AuthMiddleware::class])->group(function () {
    Route::post("/logout", [UserController::class, 'logout']);
    Route::get('/user-posts', [PostController::class, 'userPosts']);

    Route::post("/create-post", [PostController::class, 'createPost']);
    Route::get("/edit-post/{post}", [PostController::class, 'showEditPost']);
    Route::put("/edit-post/{post}", [PostController::class, 'editPost']);
    Route::delete("/delete-post/{post}", [PostController::class, 'deletePost']);
});