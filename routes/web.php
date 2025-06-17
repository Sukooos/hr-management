<?php

use Illuminate\Support\Facades\Route;
use Mews\Captcha\Captcha;
use App\Http\Controllers\Hr\RecruitmentController;
use App\Http\Controllers\Hr\JobVacancyController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/karyawan', [App\Http\Controllers\EmployeeController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan', [App\Http\Controllers\EmployeeController::class, 'update'])->name('karyawan.update');
    Route::get('/karyawan/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('karyawan.edit');
    Route::delete('/karyawan/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('karyawan.destroy');

    // Additional routes for authenticated users can be added here
});

Route::middleware('auth')->prefix('departments')->group(function () {
    Route::get('/', [\App\Http\Controllers\HR\DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/create', [\App\Http\Controllers\HR\DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/', [\App\Http\Controllers\HR\DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/{id}/edit', [\App\Http\Controllers\HR\DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/{id}', [\App\Http\Controllers\HR\DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/{id}', [\App\Http\Controllers\HR\DepartmentController::class, 'destroy'])->name('departments.destroy');
});

Route::middleware('auth')->prefix('recruitment')->group(function () {
        // Step 1: Data Diri Awal
    Route::get('{jobUuid}', [RecruitmentController::class, 'step1'])->name('step1');
    Route::post('{jobUuid}', [RecruitmentController::class, 'saveStep1'])->name('saveStep1');

    // Step 2: Pertanyaan
    Route::get('{jobUuid}/step2', [RecruitmentController::class, 'step2'])->name('step2');
    Route::post('{jobUuid}/step2', [RecruitmentController::class, 'saveStep2'])->name('saveStep2');

    // Step 3: Dokumen & Salary
    Route::get('{jobUuid}/step3', [RecruitmentController::class, 'step3'])->name('step3');
    Route::post('{jobUuid}/step3', [RecruitmentController::class, 'saveStep3'])->name('saveStep3');

    // Finish/thanks page
    Route::get('{jobUuid}/finish', [RecruitmentController::class, 'finish'])->name('finish');
});

Route::middleware('auth', 'hr')->prefix('job-vacancies')->name('jobvacancies')->group(function () {
    Route::get('/', [JobVacancyController::class, 'index'])->name('index');
    Route::get('/create', [JobVacancyController::class, 'create'])->name('create');
    Route::post('/', [JobVacancyController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [JobVacancyController::class, 'edit'])->name('edit');
    Route::put('/{id}', [JobVacancyController::class, 'update'])->name('update');
    Route::delete('/{id}', [JobVacancyController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/show-link', [JobVacancyController::class, 'showLink'])->name('showLink');
});