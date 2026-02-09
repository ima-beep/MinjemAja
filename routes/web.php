<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfilePhotoController;

/*
|--------------------------------------------------------------------------
| ROOT → LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| LOGIN (TANPA REGISTER)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [LoginController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [LoginController::class, 'register'])
    ->name('register.store');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ================= ADMIN (sebelumnya: GURU/TEACHER) =================
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [AdminDashboardController::class, 'index'])
                ->name('dashboard');

            Route::resource('books', BookController::class)->except(['show']);
            Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
            Route::post('books/approve-return/{loan}', [BookController::class, 'approveReturn'])->name('books.approve-return');
            Route::post('books/reject-return/{loan}', [BookController::class, 'rejectReturn'])->name('books.reject-return');
            Route::resource('publishers', PublisherController::class)->except(['show']);
            Route::resource('authors', AuthorController::class)->except(['show']);
            Route::resource('categories', CategoryController::class)->except(['show']);
            Route::resource('loans', LoanController::class)->except(['show']);
            Route::post('loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
            Route::resource('fines', FineController::class);
            Route::post('fines/{id}/approve-payment', [FineController::class, 'approveFinePayment'])->name('fines.approve-payment');
            Route::post('fines/{id}/reject-payment', [FineController::class, 'rejectFinePayment'])->name('fines.reject-payment');
            // Reviews (admin view - sebelumnya: teacher view)
            Route::get('reviews', [\App\Http\Controllers\ReviewController::class, 'adminIndex'])->name('reviews.index');
            Route::delete('reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
            Route::resource('members', MemberController::class);
        });

    // ================= SISWA =================
    Route::middleware('role:student')
        ->prefix('student')
        ->name('student.')
        ->group(function () {

            Route::get('/dashboard', [StudentDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/books', [BookController::class, 'index'])->name('books.index');
            Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
            Route::post('/books/{book}/borrow', [BookController::class, 'borrowBook'])->name('books.borrow');
            Route::post('/books/return/{loan}', [BookController::class, 'returnBook'])->name('books.return');
            Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
            Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
            Route::post('/fines/{id}/pay', [FineController::class, 'pay'])->name('fines.pay');
            // Reviews (student)
            Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'studentIndex'])->name('reviews.index');
            Route::get('/reviews/create/{book}', [\App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create');
            Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
                Route::get('/profile-photo', [ProfilePhotoController::class, 'edit'])->name('profile-photo.edit');
                Route::post('/profile-photo/upload', [ProfilePhotoController::class, 'upload'])->name('profile-photo.upload');
                Route::post('/profile-photo/delete', [ProfilePhotoController::class, 'destroy'])->name('profile-photo.delete');
            
        });
});
