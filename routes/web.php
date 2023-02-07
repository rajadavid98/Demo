<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//Route::middleware('auth')->group(static function () {
Route::group(['middleware' => ['auth:web,admin'] ], function(){
    Route::get('/', function () {
            return redirect()->route('home');
    });
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('change-password', [EmployeeController::class, 'changePassword'])->name('change-password');
    Route::post('password-update', [EmployeeController::class, 'passwordUpdate'])->name('password-update');
    Route::post('global-search', [HomeController::class, 'globalSearch'])->name('globalSearch');

    Route::resource('role', RoleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('product-category', ProductCategoryController::class)->except(['create', 'edit']);
    Route::resource('product', ProductController::class);
    Route::resource('sale', SaleController::class);
    Route::get('get-product-list/{category_id}', [ProductController::class, 'getProductList']);
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'loginAttempt'])->name('admin.loginAttempt');

//Method 2:separate dashboard for guard's
//Route::middleware('auth:admin')->group(static function () {
//    Route::prefix('admin')->group(function () {
//        Route::get('/home', [AdminController::class, 'adminDashboard'])->name('admin.home');
//        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
//    });
//});

Route::get('student-list', [ProductController::class, 'getStudentList']);
