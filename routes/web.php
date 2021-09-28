<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Master;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('data', [AdminController::class, 'data'])->name('admin.data');
    Route::get('approved/{id}',[AdminController::class, 'approved']);
    Route::get('rejected/{id}',[AdminController::class, 'rejected']);
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    // Data User
    Route::get('user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('add', [AdminController::class, 'add']);
    Route::post('insertAdmin', [AdminController::class, 'insertAdmin']);
    Route::get('deleteAdmin/{id}',[AdminController::class, 'deleteAdmin']);
    // End Data User
    Route::get('akun', [AdminController::class, 'akun'])->name('admin.akun');
    Route::post('update-profile-info',[AdminController::class,'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture',[AdminController::class,'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password',[AdminController::class,'changePassword'])->name('adminChangePassword');

});

Route::group(['prefix'=>'user','middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('addData', [UserController::class, 'addData'])->name('user.addData');
    Route::post('insertData', [UserController::class, 'insertData']);
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('update-profile-info',[UserController::class,'updateInfo'])->name('userUpdateInfo');
    Route::post('change-profile-picture',[UserController::class,'updatePicture'])->name('userPictureUpdate');
    Route::post('change-password',[UserController::class,'changePassword'])->name('userChangePassword');
     // Route::get('riwayatPendaftaran', [UserController::class, 'riwayatPendaftaran'])->name('user.riwayatPendaftaran');
    Route::get('data', function () {
        $master = Master::with('user')->get();
        return view('dashboard.user.data', ['master' => $master]);
    })->name('user.data');
});
