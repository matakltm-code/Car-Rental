<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarManagementController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DriverLicenseController;
use App\Http\Controllers\MessageController;
use App\Models\Car;

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
    $cars = Car::orderBy('created_at', 'DESC')->paginate(10);
    return view('welcome', [
        'cars' => $cars
    ]);
});

Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']); // Reserve/Book a car
Route::get('/cars/{car}', [CarController::class, 'show']);


Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile route
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/edit', [ProfileController::class, 'edit']);
Route::patch('/profile/{profile}', [ProfileController::class, 'update']);
Route::get('/profile/change-password', [ChangepasswordController::class, 'index']);
Route::post('/profile/change-password', [ChangepasswordController::class, 'store']);
Route::get('/profile/driver-license', [DriverLicenseController::class, 'index']);
Route::post('/profile/driver-license', [DriverLicenseController::class, 'store']);

// Report and Feedback Routes


// Admin
Route::get('/account', [AccountController::class, 'index']);
Route::post('/account', [AccountController::class, 'store']);
Route::get('/account/login-history', [AccountController::class, 'login_history']);
Route::post('/account/enable-disable', [AccountController::class, 'enable_disable_account']);



// manager

Route::get('/m/view-report-from-rental-officer', [MessageController::class, 'view_report_from_rental_officer']);
Route::get('/m/send-report-for-rental-officer', [MessageController::class, 'send_report_for_rental_officer']);
Route::post('/m/send-report-for-rental-officer', [MessageController::class, 'store_send_report_for_rental_officer']);
Route::get('/m/feedback-from-customer', [MessageController::class, 'view_feedback_from_customer']);




// rentalofficer
Route::get('/car-management', [CarManagementController::class, 'index']);
Route::get('/car-management/create', [CarManagementController::class, 'create']);
Route::post('/car-management', [CarManagementController::class, 'store']);
Route::get('/car-management/{car}', [CarManagementController::class, 'show']);
Route::get('/car-management/{car}/edit', [CarManagementController::class, 'edit']);
Route::put('/car-management/{car}', [CarManagementController::class, 'update']);
Route::delete('/car-management/{car}', [CarManagementController::class, 'destroy']);
Route::post('/car-management/enable-disable', [CarManagementController::class, 'enable_disable_car']);

Route::get('/r/send-report-for-manager', [MessageController::class, 'send_report_for_manager']);
Route::post('/r/send-report-for-manager', [MessageController::class, 'store_send_report_for_manager']);
Route::get('/r/report-from-manager', [MessageController::class, 'view_report_from_manager']);
Route::get('/r/report-from-driver', [MessageController::class, 'view_report_from_driver']);




// driver

Route::get('/d/send-report-rental-officer', [MessageController::class, 'send_report_for_rental_officer_from_driver']);
Route::post('/d/send-report-rental-officer', [MessageController::class, 'store_send_report_for_rental_officer_from_driver']);


// customer

Route::get('/c/send-feedback', [MessageController::class, 'send_feedback_for_manager']);
Route::post('/c/send-feedback', [MessageController::class, 'store_send_feedback_for_manager']);
