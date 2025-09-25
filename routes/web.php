<?php

use App\Http\Controllers\ACL\PermissionController;
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

// PÚBLICA
Route::get('/', function () {
    return view('welcome');
});

// PAINEL (livre) TESTES - REMOVER DEPOIS
Route::get('painel', [PortController::class, 'painel'])->name('painel');

// ROTAS COM AUTENTICAÇÃO E VERIFICAÇÃO
Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * ADMINISTRAÇÃO
     * Aqui você pode aplicar ACL por recurso (can:harvest.view, etc.)
     */
    Route::prefix('admin')->group(function () {

        // SAFRAS
        Route::resource('harvests', HarvestController::class)->names('harvests');
        // Route::post('harvest/search', [SearchController::class, 'harvestSearch'])->name('harvest.search');

        // PORTOS
        Route::resource('ports', PortController::class)->names('ports');

        // MOTIVOS
        Route::resource('reasons', ReasonController::class)->names('reasons');

        // USUÁRIOS
        Route::resource('users', UserController::class)->names('users');
        Route::get('users-pending', [UserController::class, 'approvationUser'])->name('users.pending');
        
        // ENCOSTE DE VAGÕES
        Route::resource('dockings', DockingController::class)->names('dockings');

        // PARADAS
        Route::resource('stops', StopController::class)->names('stops');
        Route::get('dockings/{docking}/stops/create', [StopController::class, 'create'])->name('stop.create');

        // NOTIFICAÇÕES
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('read/{id}', [NotificationController::class, 'read'])->name('read');
            Route::get('mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
        });
        
        
        // PERFIL
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });
    
        // ACL
        Route::prefix('acl')->group(function () {
    
            // GRUPOS (ROLES)
            // Route::resource('roles', RoleController::class)->names('roles');

            Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('can:role.index');
            Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:role.create');
            Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('can:role.store');
            Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('can:role.show');
            Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:role.edit');
            Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:role.update');
            Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('can:role.destroy');

            Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');
    
            // PERMISSÕES
            Route::resource('permissions', PermissionController::class)->names('permissions');
        });
        
    });
});



require __DIR__ . '/auth.php';