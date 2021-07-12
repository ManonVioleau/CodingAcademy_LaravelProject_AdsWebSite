<?php

use App\Http\Controllers\SignupController;
use App\Http\Controllers\SigninController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\IndexController;
use App\Models\Category;
use App\Http\Controllers\IsAdminController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// idex
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::post('/filter', [FilterController::class, 'filter']);
Route::get('/page{page}', [IndexController::class, 'index']);

// signin-signup
Route::get('signup', [SignupController::class, 'form'])->name('signup');
Route::post('signup', [SignupController::class, 'dataprocess']);
Route::get('signin', [SigninController::class, 'form'])->name('signin');
Route::post('signin', [SigninController::class, 'dataprocess']);
Route::get('logout', [SigninController::class, 'logout'])->name('logout');

// admin
Route::get('admin', [IsAdminController::class, 'form'])->middleware(['auth', 'role'])->name('admin');
Route::get('admin/users/show', [UserController::class, 'index'])->middleware(['auth', 'role']);
Route::get('admin/users/show/{page}', [UserController::class, 'index'])->middleware(['auth', 'role']);
Route::delete('admin/users/show', [UserController::class, 'destroy'])->middleware(['auth', 'role']);
Route::delete('admin/users/show/{page}', [UserController::class, 'destroy'])->middleware(['auth', 'role']);
Route::get('admin/user/add', [UserController::class, 'createView'])->middleware(['auth', 'role']);
Route::post('admin/user/add', [UserController::class, 'store'])->middleware(['auth', 'role']);
Route::get('admin/user/{id}', [UserController::class, 'show'])->middleware(['auth', 'role']);
Route::post('admin/user/{id}', [UserController::class, 'update'])->middleware(['auth', 'role']);

//Route Admin CRUD Ad
Route::group(['middleware' => ['auth', 'role'], 'prefix' => 'admin/ads'], function () {
    // Route::get('show', [AdController::class, 'index']);
    Route::get('show/{page?}', [AdController::class, 'index']);
    Route::get('add', [AdController::class, 'createView']);
    Route::post('add', [AdController::class, 'store']);
    Route::get('{id}', [AdController::class, 'show']);
    Route::put('{id}', [AdController::class, 'update']);
    Route::delete('show', [AdController::class, 'destroy']);
});

//Route Admin CRUD Category
Route::resource('admin/categories', CategoryController::class)->middleware(['auth', 'role']);
Route::delete('admin/categories/delete', [CategoryController::class, 'destroy'])->middleware(['auth', 'role']);

// Route Email Confirm

Route::get('/email/verify', function () {
    return view('signinup.verify_email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request, $id) {
    $request->fulfill();
    $user = User::where('id', $id);
    $user->email_verified_at = now();
    $message = 'Email verified';
    return view('signinup.verify_email', ['message' => $message]);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ad
Route::get('ad/{id}', [IndexController::class, 'displayad']);
// user
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user'], function () {
    Route::get('{nickname}', [IndexController::class, 'displayuser']);
    Route::delete('{nickname}/{ad_id}', [IndexController::class, 'destroy']);
    Route::get('add/{nickname}', [IndexController::class, 'create']);
    Route::post('add/{nickname}', [IndexController::class, 'store']);
    Route::get('edit/{nickname}/ad/{ad_id}', [IndexController::class, 'edit']);
    Route::put('edit/{nickname}/ad/{ad_id}', [IndexController::class, 'update']);
    Route::get('edit/{nickname}/user', [IndexController::class, 'edituser']);
    Route::put('edit/{nickname}/user', [IndexController::class, 'updateuser']);
    Route::get('profile/{nickname}', [IndexController::class, 'profile']);
    Route::get('info/profile/{nickname}', [IndexController::class, 'privateprofile']);
});


Route::get('public/profile/{nickname}', [IndexController::class, 'public']);
