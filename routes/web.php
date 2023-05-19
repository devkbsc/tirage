<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TirageController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::resource('tirage', TirageController::class);

Route::get('/tirage', [TirageController::class, 'index'])->name('tirage.index')->middleware('auth');

Route::get('/tirage/create', [TirageController::class, 'create'])->name('tirage.create');

Route::post('/tirage/store', [TirageController::class, 'store'])->name('tirage.store');

Route::get('/tirage/destroy', [TirageController::class, 'destroy'])->name('tirage.destroy');

Route::get('/tirage/edit', [TirageController::class, 'edit'])->name('tirage.edit');

Route::get('/tirage/show', [TirageController::class, 'show'])->name('tirage.show');


require __DIR__ . '/auth.php';
