<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout']);

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetPassword'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{email}/{token}', [ForgotPasswordController::class, 'showResetPassword'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->middleware('guest')->name('password.update');

// Profile Routes
Route::resource('/profile', ProfileController::class)->middleware('auth');

// Blogs Routes
Route::controller(BlogController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/posts', 'index')->name('posts.index');
        Route::get('/posts/{post}', 'show')->name('posts.show');
    });

// Comment Routes
Route::controller(CommentController::class)->group(function () {
    Route::post('/comments', 'store')->name('comments.store');
    Route::delete('/comments/{comment}', 'destroy')->name('comments.destroy');
});
