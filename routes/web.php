<?php

use App\Http\Controllers\Admin\DockingController;
use App\Http\Controllers\Admin\HarvestController;
use App\Http\Controllers\Admin\PortController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\StopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('harvests', HarvestController::class)->names('harvests');
    Route::resource('ports', PortController::class)->names('ports');
    Route::resource('dockings', DockingController::class)->names('dockings');
    Route::resource('users', UserController::class)->names('users');
    Route::get('users-pending', [UserController::class, 'approvationUser'])->name('users.pending');
    
    //PARADAS
    Route::resource('stops', StopController::class)->names('stops');
    Route::get('/dockings/{docking}/stops/create', [StopController::class, 'create'])->name('stop.create');
    Route::resource('reasons', ReasonController::class)->names('reasons');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
