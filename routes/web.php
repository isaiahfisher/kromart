<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StoreController;
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

Route::get('/', function () {
    return Inertia::render('Login', [
                'title' => 'Login Page',
        // 'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', [StoreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [StoreController::class, 'index']) ->middleware(['auth', 'verified'])->name('store.index');
Route::post('dashboard', [StoreController::class, 'index']) ->middleware(['auth', 'verified'])->name('store.index');
Route::get('/employee', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');
Route::post('employee', [EmployeeController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.index');

Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');

Route::get('/inventory', function () {
    return Inertia::render('Employee');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/item', function () {
    return Inertia::render('Employee');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
