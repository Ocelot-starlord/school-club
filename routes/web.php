<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClubRegistrationController;
use App\Http\Controllers\StudentImportController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ หน้า Dashboard หลัง Login
Route::get('/dashboard', function () {
    return Auth::user()->role === 'teacher'
        ? view('teacher-dashboard')
        : view('dashboard'); // สำหรับนักเรียน
})->middleware('auth')->name('dashboard');

// ✅ หน้า Home (redirect ไป login)
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ หน้าลงทะเบียนสำเร็จ (เปิดให้ทุกคนที่ login แล้วเห็น)
Route::middleware('auth')->get('/register-success', function () {
    return view('register_success');
})->name('register.success');

// ✅ นักเรียน (Student Role)
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/register-club', [ClubRegistrationController::class, 'showForm'])->name('register-club');
    Route::post('/register-club', [ClubRegistrationController::class, 'submitForm'])->name('register-club.submit');
});

// ✅ รายงานนักเรียนที่ลงทะเบียน (เปิดให้ทุกคนที่ login แล้วเห็น)
Route::middleware('auth')->group(function () {
    Route::get('/registered-list', [ClubRegistrationController::class, 'showRegisteredList'])->name('report-all');
});

// ✅ ครู (Teacher Role)
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/report-by-class', [ClubRegistrationController::class, 'reportByClassroom'])->name('report-class');
});

// Laravel Breeze Auth Routes
require __DIR__.'/auth.php';
