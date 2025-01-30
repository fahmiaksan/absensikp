<?php

use App\Exports\ActivitiesExport;
use App\Exports\AttendanceExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityExportController;
use Faker\Guesser\Name;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/absen', [App\Http\Controllers\AttendanceController::class, 'index'])->name('absen.index');
    Route::get('/absen/create', [App\Http\Controllers\AttendanceController::class, 'create'])->name('absen.create');
    Route::post('/absen/create', [App\Http\Controllers\AttendanceController::class, 'store'])->name('absen.store');
    Route::resource('activities', ActivityController::class);
    Route::put('activities/{activity}/status/{status}', [ActivityController::class, 'updateStatus'])->name('activities.updateStatus');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.updated');
    Route::get('/admin/activities/export', function () {
        return Excel::download(new ActivitiesExport, 'activities.xlsx');
    })->name('admin.activities.export');

    Route::get('/admin/users/export', function () {
        return Excel::download(new UsersExport, 'users.xlsx');
    })->name('admin.users.export');


    Route::get('/admin/attendance/export', function () {
        return Excel::download(new AttendanceExport, 'attendance.xlsx');
    })->name('admin.attendance.export');

    // Route untuk melihat daftar pengguna  
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Route untuk menghapus pengguna  
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route untuk melihat daftar pengguna, hanya untuk admin  
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index')->middleware('auth', 'admin');

    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
});
