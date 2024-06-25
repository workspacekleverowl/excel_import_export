<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// customers route
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.list');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/indexexcel', [ExcelController::class, 'index'])->name('indexexcel'); // view
Route::post('/import', [ExcelController::class, 'import'])->name('import');
Route::post('/export-excel', [ExcelController::class, 'export'])->name('export-excel');
Route::get('/averages/{identifier}', [ExcelController::class, 'showData'])->name('showData');

// //--------------------role--------------------------------------------------------
//  // Route to list all roles
//  Route::get('roles/index', [RoleController::class, 'index'])->name('roles/index');

// // Route to show the form for creating a new role
// Route::get('roles/create', [RoleController::class, 'create'])->name('roles/create');

// // Route to store a newly created role in the database
// Route::post('roles/store', [RoleController::class, 'store'])->name('roles/store');

// // Route to show the form for editing a specific role
// Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');

// // Route to update a specific role in the database
// Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');

// // Route to delete a specific role
// Route::get('roles/{role}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');

// // Route to show the form for adding permissions to a specific role
// Route::get('roles/{role}/permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.permissions');

// // Route to assign permissions to a specific role
// Route::put('roles/{role}/permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.givePermissions');


// //--------------------Permission--------------------------------------------------------
// // Index Route
// Route::get('permissions/index', [PermissionController::class, 'index'])->name('permissions/index');

// // Create Route
// Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');

// // Store Route
// Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');

// // Edit Route
// Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');

// // Update Route
// Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');

// // Destroy Route
// Route::get('permissions/{permission}/delete', [PermissionController::class, 'destroy'])->name('permissions.destroy');


// //-----------------------setting permission------------------------------------------------------------

// Route::group(['middleware' => ['role:super-admin']], function () {
       
// //--------------------User--------------------------------------------------------
// // Index Route
// Route::get('users/index', [UserController::class, 'index'])->name('users/index');

// // Create Route
// Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// // Store Route
// Route::post('users/store', [UserController::class, 'store'])->name('users.store');

// // Edit Route
// Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// // Update Route
// Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

// // Destroy Route
// Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');

// });


