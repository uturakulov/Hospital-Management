<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
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

Route::get('/', function () {
    return view('index');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('signin', [AuthController::class, 'signin'])->name('signin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin-login', [AuthController::class, 'adminLogin'])->name('admin-login');
Route::post('admin-signin', [AuthController::class, 'adminSignin'])->name('admin-signin');

Route::get('doctor-home', [DoctorController::class, 'index'])->name('doctor-home');
Route::get('doctor-add', [DoctorController::class, 'addHistoryView'])->name('doctor-add-history');
Route::post('doctor-add-history', [DoctorController::class, 'addHistoryStore'])->name('add-history');
Route::get('doctor-history/{id}', [DoctorController::class, 'showHistory'])->name('show-history');
Route::get('doctor-history/edit/{id}', [DoctorController::class, 'editHistory'])->name('edit-history');
Route::post('doctor-history/update/{id}', [DoctorController::class, 'updateHistory'])->name('update-history');
Route::get('doctor-history/delete/{id}', [DoctorController::class, 'deleteHistory'])->name('delete-history');

Route::get('patient-home', [PatientController::class, 'index'])->name('patient-home');
Route::get('patient-histories/{title}', [PatientController::class, 'histories'])->name('patient-doctor');
Route::get('patient-histories/{title}/{id}', [PatientController::class, 'history'])->name('patient-show-history');

Route::get('admin-home', [AdminController::class, 'index'])->name('admin-home');
Route::get('admin-patients', [AdminPatientController::class, 'index'])->name('admin-patients');
Route::get('admin-add-patient', [AdminPatientController::class, 'create'])->name('admin-add-patient');
Route::post('admin-store-patient', [AdminPatientController::class, 'store'])->name('admin-store-patient');
Route::get('admin-show-patient', [AdminPatientController::class, 'show'])->name('admin-show-patient');
Route::get('admin-edit-patient', [AdminPatientController::class, 'edit'])->name('admin-edit-patient');
Route::get('admin-delete-patient', [AdminPatientController::class, 'destroy'])->name('admin-delete-patient');

Route::get('admin-doctor', [AdminDoctorController::class, 'index'])->name('admin-doctor');
Route::get('admin-add-doctor', [AdminDoctorController::class, 'create'])->name('admin-add-doctor');
Route::get('admin-show-doctor', [AdminDoctorController::class, 'show'])->name('admin-show-doctor');
Route::get('admin-edit-doctor', [AdminDoctorController::class, 'edit'])->name('admin-edit-doctor');
Route::get('admin-delete-doctor', [AdminDoctorController::class, 'destroy'])->name('admin-delete-doctor');
