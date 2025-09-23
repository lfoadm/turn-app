<?php

use App\Http\Controllers\ACL\RoleController;
use App\Http\Controllers\Admin\DockingController;
use App\Http\Controllers\Admin\HarvestController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PortController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\SearchController;
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
    
    // USUÁRIOS
    Route::resource('users', UserController::class)->names('users');
    Route::get('users-pending', [UserController::class, 'approvationUser'])->name('users.pending');
    
    //PARADAS
    Route::resource('stops', StopController::class)->names('stops');
    Route::get('/dockings/{docking}/stops/create', [StopController::class, 'create'])->name('stop.create');
    Route::resource('reasons', ReasonController::class)->names('reasons');

    //PESQUISAS
    Route::post('harvest/search', [SearchController::class, 'harvestSearch'])->name('harvest.search');

    //NOTIFICAÇÕES
    Route::get('notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::get('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::middleware('auth')->group(function () {
    
    // CONFIGURAÇÕES DE PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ACL - PERMISSÕES E GRUPOS DE USUÁRIOS
    //Route::resource('roles', RoleController::class)->names('roles');

    Route::prefix('acl')->group(function () {
        // Roles
        Route::resource('roles', RoleController::class)->names('roles');

        // Rota específica para atualizar permissões do grupo
        Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
            ->name('roles.updatePermissions');

        // Permissions
        Route::resource('permissions', PermissionController::class);
    });

});

Route::get('painel', [PortController::class, 'painel'])->name('painel');

require __DIR__.'/auth.php';
