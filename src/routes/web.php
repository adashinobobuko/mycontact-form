<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

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

//管理User、登録、ログインのルート
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');//登録画面表示
Route::post('/register', [AuthController::class, 'register']);//登録処理
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // ログインフォーム表示
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); // ログイン処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // ログアウト処理

//admin関連のルート
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
    Route::delete('/admin/{id}/delete', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/{id}/details', [AdminController::class, 'showDetails'])->name('admin.details');
});

//お問い合わせ関連のルート
Route::get('/', [ContactController::class,'index']);
Route::post('/inquiry/confirm', [ContactController::class, 'confirm'])->name('inquiry.confirm'); // 確認画面
Route::post('/inquiry/edit', [ContactController::class, 'edit'])->name('inquiry.edit'); // 修正画面
Route::post('/inquiry/submit', [ContactController::class, 'submit'])->name('inquiry.submit'); // 送信処理
//お問い合わせ完了ページの表示
Route::get('/thanks', function () {return view('thanks');})->name('thanks');



