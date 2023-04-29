<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
<<<<<<< HEAD
use App\Http\Controllers\StoreController;
=======
use App\Http\Controllers\ItemController;
use App\Http\Controlelrs\InventoryController;
>>>>>>> 6d284de84cb737d919c33882ae07a05043a14406
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

<<<<<<< HEAD
// Route::get('/dashboard', [StoreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [StoreController::class, 'index']) ->middleware(['auth', 'verified'])->name('store.index');
Route::post('dashboard', [StoreController::class, 'index']) ->middleware(['auth', 'verified'])->name('store.index');
Route::get('/employee', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');
Route::post('employee', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');
=======
//all authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    //dashboard route
    Route::get('/dashboard', function () { 
        return Inertia::render('Dashboard');
    })->name('dashboard');
>>>>>>> 6d284de84cb737d919c33882ae07a05043a14406

    //employee routes
    Route::prefix('employee')->group(function () {
        Route::post('/', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    });

    //item routes
    Route::prefix('item')->group(function () {
        Route::match(['get', 'post'], '/', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item.index');
    });

    //Inventory routes
    Route::prefix('inventory')->group(function () {
        Route::match(['get', 'post'], '/', [InventoryController::class, 'index'])->middleware(['auth', 'verified'])->name('iventory.index');
    });
});

//default profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
