<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [LoginController::class, 'showFormLogin']);
Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('{provider}/callback/', [SocialController::class, 'callback']);

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('{id}/edit', [UserController::class, 'update'])->name('users.update');
        Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/search', [UserController::class, 'search'])->name('users.search');
    });
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/create', [BookController::class, 'store'])->name('books.store');
        Route::get('{id}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::post('{id}/edit', [BookController::class, 'update'])->name('books.update');
        Route::get('{id}/destroy', [BookController::class, 'destroy'])->name('books.destroy');
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/create', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::post('/{id}/edit', [StudentController::class, 'update'])->name('students.update');
        Route::get('/{id}/destroy', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::prefix('borrows')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('borrows.index');
        Route::get('/return', [BorrowController::class, 'indexReturn'])->name('borrows.return');
        Route::get('/create', [BorrowController::class, 'create'])->name('borrows.create');
        Route::post('/create', [BorrowController::class, 'store']);
        Route::get('/search-student', [BorrowController::class, 'searchStudent']);
        Route::get('/search-book', [BorrowController::class, 'searchBook']);
        Route::get('/find-student/{idStudent}', [BorrowController::class, 'findStudent']);
        Route::get('/find-book/{idBook}', [BorrowController::class, 'findBook']);
        Route::get('/{idBorrow}/confirmReturn', [BorrowController::class, 'confirmReturn']);
    });

    Route::get('/changePassword', [LoginController::class, 'showFormChangePassword'])->name('showChangePassword');
    Route::post('/changePassword', [LoginController::class, 'changePassword'])->name('changePassword');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



