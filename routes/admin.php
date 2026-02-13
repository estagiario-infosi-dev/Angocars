<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ModelsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ReserveController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\SellController;
use App\Http\Controllers\Admin\ReportsController;

// ===============================================
// 1. ROTAS PÚBLICAS (login, register, password reset)
// ===============================================
Auth::routes();

Route::get('/home', fn() => redirect()->route('dashboard'));

// Password Reset (qualquer um logado)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// ===============================================
// 2. DASHBOARD
// ===============================================
Route::get('/admin', function () {
    $user = auth()->user();

    // Financial → vai direto pro financeiro
    if ($user->role === 'financial') {
        return redirect('financeiro.reserves');
    }

    // Employee → vai direto pras marcas (ou qualquer tela que você quiser)
    if ($user->role === 'employee') {
        return redirect()->route('brands.index'); // /admin/brands
    }

    // Admin → Dashboard completo
    return app(\App\Http\Controllers\Admin\DashboardController::class)->index();

})->name('dashboard')->middleware('auth');


// ===============================================
// 3. ADMIN + EMPLOYEE → Acesso TOTAL (criar, editar, apagar)
// ===============================================

Route::middleware(['auth', 'checknivel:admin,employee'])->group(function () {

    // CORES
    Route::prefix('/admin/colors')->name('colors.')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::get('/create', [ColorController::class, 'create'])->name('create');
        Route::post('/', [ColorController::class, 'store'])->name('store');
        Route::get('{color}', [ColorController::class, 'show'])->name('show');
        Route::get('{color}/edit', [ColorController::class, 'edit'])->name('edit');
        Route::put('{color}', [ColorController::class, 'update'])->name('update');
        Route::delete('{color}/delete', [ColorController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [ColorController::class, 'trashed'])->name('trashed');
        Route::post('{color}/restore', [ColorController::class, 'restore'])->name('restore');
    });

    // MODELOS
    Route::prefix('/admin/models')->name('models.')->group(function () {
        Route::get('/', [ModelsController::class, 'index'])->name('index');
        Route::get('/create', [ModelsController::class, 'create'])->name('create');
        Route::post('/', [ModelsController::class, 'store'])->name('store');
        Route::get('{models}', [ModelsController::class, 'show'])->name('show');
        Route::get('{models}/edit', [ModelsController::class, 'edit'])->name('edit');
        Route::put('{models}', [ModelsController::class, 'update'])->name('update');
        Route::delete('{models}/delete', [ModelsController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [ModelsController::class, 'trashed'])->name('trashed');
        Route::post('{models}/restore', [ModelsController::class, 'restore'])->name('restore');
    });

    // MARCAS
    Route::prefix('/admin/brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/', [BrandController::class, 'store'])->name('store');
        Route::get('{brand}', [BrandController::class, 'show'])->name('show');
        Route::get('{brand}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::put('{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('{brand}/delete', [BrandController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [BrandController::class, 'trashed'])->name('trashed');
        Route::post('{brand}/restore', [BrandController::class, 'restore'])->name('restore');
    });

    // COMBUSTÍVEIS
    Route::prefix('/admin/fuels')->name('fuels.')->group(function () {
        Route::get('/', [FuelController::class, 'index'])->name('index');
        Route::get('/create', [FuelController::class, 'create'])->name('create');
        Route::post('/', [FuelController::class, 'store'])->name('store');
        Route::get('{fuel}', [FuelController::class, 'show'])->name('show');
        Route::get('{fuel}/edit', [FuelController::class, 'edit'])->name('edit');
        Route::put('{fuel}', [FuelController::class, 'update'])->name('update');
        Route::delete('{fuel}/delete', [FuelController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [FuelController::class, 'trashed'])->name('trashed');
        Route::post('{fuel}/restore', [FuelController::class, 'restore'])->name('restore');
    });

    // CARROS
    Route::prefix('/admin/cars')->name('cars.')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('index');
        Route::get('/create', [CarController::class, 'create'])->name('create');
        Route::post('/', [CarController::class, 'store'])->name('store');
        Route::get('{car}/edit', [CarController::class, 'edit'])->name('edit');
        Route::put('{car}', [CarController::class, 'update'])->name('update');
        Route::delete('{car}', [CarController::class, 'destroy'])->name('destroy');
        Route::get('{car}', [CarController::class, 'show'])->name('show');

    });

    // AJAX para modelos por marca
    Route::get('/get-models-by-brand/{brandId}', [ModelsController::class, 'getModelsByBrand']);
    

    // FORNECEDORES
    Route::prefix('/admin/suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::post('/', [SupplierController::class, 'store'])->name('store');
        Route::get('{supplier}', [SupplierController::class, 'show'])->name('show');
        Route::get('{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
        Route::put('{supplier}', [SupplierController::class, 'update'])->name('update');
        Route::delete('{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
    });

    // CLIENTES
    Route::prefix('/admin/clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('{client}', [ClientController::class, 'show'])->name('show');
        Route::get('{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('{client}', [ClientController::class, 'update'])->name('update');
        Route::delete('{client}', [ClientController::class, 'destroy'])->name('destroy');
    });

    // CARTÕES
    Route::prefix('/admin/cards')->name('cards.')->group(function () {
        Route::get('/', [CardController::class, 'index'])->name('index');
        Route::get('/create', [CardController::class, 'create'])->name('create');
        Route::post('/', [CardController::class, 'store'])->name('store');
        Route::get('{card}', [CardController::class, 'show'])->name('show');
        Route::get('{card}/edit', [CardController::class, 'edit'])->name('edit');
        Route::put('{card}', [CardController::class, 'update'])->name('update');
        Route::delete('{card}', [CardController::class, 'destroy'])->name('destroy');
    });

    // MOTORISTAS
    Route::prefix('/admin/drivers')->name('drivers.')->group(function () {
        Route::get('/', [DriverController::class, 'index'])->name('index');
        Route::get('/create', [DriverController::class, 'create'])->name('create');
        Route::post('/', [DriverController::class, 'store'])->name('store');
        Route::get('{driver}', [DriverController::class, 'show'])->name('show');
        Route::get('{driver}/edit', [DriverController::class, 'edit'])->name('edit');
        Route::put('{driver}', [DriverController::class, 'update'])->name('update');
        Route::delete('{driver}', [DriverController::class, 'destroy'])->name('destroy');
    });

    // RESERVAS (com create/edit)
    Route::prefix('/admin/reserves')->name('reserves.')->group(function () {
        Route::get('/', [ReserveController::class, 'index'])->name('index');
        Route::get('/create', [ReserveController::class, 'create'])->name('create');
        Route::post('/', [ReserveController::class, 'store'])->name('store');
        Route::get('{id}', [ReserveController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ReserveController::class, 'edit'])->name('edit');
        Route::put('{id}', [ReserveController::class, 'update'])->name('update');
        Route::delete('{id}', [ReserveController::class, 'destroy'])->name('destroy');
        Route::post('{id}/approve', [ReserveController::class, 'approve'])->name('approve');
        Route::post('{id}/cancel', [ReserveController::class, 'cancel'])->name('cancel');
    });

    route::get('relatorio', [ReportsController::class, 'reserves'])->name('relatorio.reservescompleted');

    // VENDAS (com create/edit)
    Route::prefix('/admin/sells')->name('sells.')->group(function () {
        Route::get('/', [SellController::class, 'index'])->name('index');
        Route::get('/create', [SellController::class, 'create'])->name('create');
        Route::post('/', [SellController::class, 'store'])->name('store');
        Route::get('{sell}', [SellController::class, 'show'])->name('show');
        Route::get('{sell}/edit', [SellController::class, 'edit'])->name('edit');
        Route::put('{sell}', [SellController::class, 'update'])->name('update');
        Route::delete('{sell}', [SellController::class, 'destroy'])->name('destroy');
    });

    // ACESSÓRIOS (com create/edit)
    Route::prefix('/admin/accessories')->name('accessories.')->group(function () {
        Route::get('/', [AccessoryController::class, 'index'])->name('index');
        Route::get('/create', [AccessoryController::class, 'create'])->name('create');
        Route::post('/', [AccessoryController::class, 'store'])->name('store');
        Route::get('{accessory}', [AccessoryController::class, 'show'])->name('show');
        Route::get('{accessory}/edit', [AccessoryController::class, 'edit'])->name('edit');
        Route::put('{accessory}', [AccessoryController::class, 'update'])->name('update');
        Route::delete('{accessory}', [AccessoryController::class, 'destroy'])->name('destroy');
    });
});

// ===============================================
// 4. FINANCIAL → APENAS LEITURA
// ===============================================
Route::middleware(['auth', 'checknivel:financial'])->group(function () {

    Route::prefix('/admin/financeiro')->name('financeiro.')->group(function () {

        // Rota raiz – se alguém cair em /admin/financeiro vai direto para reserves
        Route::get('/', fn() => redirect()->route('financeiro.reserves'))->name('index');

        // RESERVAS
        Route::get('/reserves', [ReserveController::class, 'index'])
            ->name('reserves');
        Route::get('/reserves/{id}', [ReserveController::class, 'show'])
            ->name('reserves.show');

        // VENDAS
        Route::get('/sells', [SellController::class, 'index'])
            ->name('sells');
        Route::get('/sells/{sell}', [SellController::class, 'show'])
            ->name('sells.show');

        // ACESSÓRIOS
        Route::get('/accessories', [AccessoryController::class, 'index'])
            ->name('accessories');
        Route::get('/accessories/{accessory}', [AccessoryController::class, 'show'])
            ->name('accessories.show');
    });
});



// ===============================================
// 5. APENAS ADMIN → Usuários + Relatórios
// ===============================================
Route::middleware(['auth', 'checknivel:admin'])->group(function () {

    // USUÁRIOS
    Route::prefix('/admin/users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // RELATÓRIOS
    Route::get('/admin/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/admin/reports/reportsSales', [DashboardController::class, 'reportsSales'])->name('reportsSales');
    Route::get('/admin/reports/reportsLeads', [DashboardController::class, 'reportsLeads'])->name('reportsLeads');
    Route::get('/admin/reports/reserves', [DashboardController::class, 'reservesReport'])->name('reports.reserves');

   //Relatório geral do sistema
   Route::get('/admin/reportsgeneral', [ReportsController::class, 'reportsgeneral'])->name('reportsgeneral');
   Route::get('/admin/reportsgeneral/carsstatus', [ReportsController::class, 'carsstatus'])->name('carsstatus');
   Route::get('/admin/reportsgeneral/carsreserve', [ReportsController::class, 'carsreserve'])->name('carsreserve');
   Route::get('/admin/reportsgeneral/reservescompleted', [ReportsController::class, 'reservescompleted'])->name('reservescompleted');
   Route::get('/admin/reportsgeneral/reservescancelled', [ReportsController::class, 'reservescancelled'])->name('reservescancelled');
   Route::get('/admin/reportsgeneral/suppliersystem', [ReportsController::class, 'suppliersystem'])->name('suppliersystem');
   Route::get('/admin/reportsgeneral/clientsystem', [ReportsController::class, 'clientsystem'])->name('clientsystem');
    // Rota para gerar relatórios em PDF
    Route::get('/admin/reports/pdf/{type}', [ReportsController::class, 'generatePdf'])->name('reports.pdf');


});

