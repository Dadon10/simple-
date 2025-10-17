<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\NapsaContributionController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\ReconciliationController;
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

    Route::middleware('role:Admin|Payroll Officer')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('payrolls', PayrollController::class);
        Route::resource('napsa', NapsaContributionController::class);
        Route::get('/payslips/{payroll}/generate', [PayslipController::class, 'generate'])->name('payslips.generate');
        Route::post('/payslips/{payroll}/email', [PayslipController::class, 'email'])->name('payslips.email');
        Route::get('/reconciliation/export', [ReconciliationController::class, 'export'])->name('reconciliation.export');
    });

    // Employee self-service
    Route::middleware('role:Employee')->group(function () {
        Route::get('/my-payslips', function () {
            $user = auth()->user();
            $employee = \App\Models\Employee::where('email', $user->email)->first();
            $payslips = $employee ? $employee->payslips()->latest()->with('payroll')->get() : collect();
            return view('payslips.index', compact('payslips'));
        })->name('payslips.index');
    });
});

require __DIR__.'/auth.php';
