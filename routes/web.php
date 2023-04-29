<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//unauthenticated route for login
Route::get('/', function () {
    return Inertia::render('Login', [
                'title' => 'Login Page',
        // 'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});


//all authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    //dashboard route
    Route::match(['get', 'post'], '/dashboard', [StoreController::class, 'index'])->name('dashboard');

    //employee routes
    Route::prefix('employee')->group(function () {
        Route::match(['get', 'post'], '/', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    });

    //item routes
    Route::prefix('item')->group(function () {
        Route::match(['get', 'post'], '/', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item.index');
    });

    //Inventory routes
    Route::prefix('inventory')->group(function () {
        Route::match(['get', 'post'], '/', [InventoryController::class, 'index'])->middleware(['auth', 'verified'])->name('inventory.index');
    });
});

//default profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
