<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\NapsaContributionController;
use App\Http\Controllers\PayslipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('employees', EmployeeController::class);
    Route::resource('payrolls', PayrollController::class);
    Route::resource('napsa', NapsaContributionController::class);

    Route::get('/payslips/{payroll}/generate', [PayslipController::class, 'generate'])->name('payslips.generate');
    Route::post('/payslips/{payroll}/email', [PayslipController::class, 'email'])->name('payslips.email');
});

require __DIR__.'/auth.php';
