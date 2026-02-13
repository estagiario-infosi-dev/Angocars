<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Car;
use App\Model\Driver;
use App\Model\Reserve;
use App\Model\Accessory;
use App\Model\Sell;
use App\Model\Brand;
use App\Model\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // === DADOS DE CARROS ===
    $totalCars = Car::count();
    $carsWithMoreThanEightSeats = Car::where('number_of_seats', '>', 8)->count();
    $carsWithEightOrFewerSeats = Car::where('number_of_seats', '<=', 8)->count();

    $luxuryCars = Car::where('category', 'Luxury')->count();
    $standardCars = Car::where('category', 'Standard')->count();
    $economyCars = Car::where('category', 'Economy')->count();

    $luxuryPercentage = $totalCars > 0 ? round(($luxuryCars / $totalCars) * 100, 2) : 0;
    $standardPercentage = $totalCars > 0 ? round(($standardCars / $totalCars) * 100, 2) : 0;
    $economyPercentage = $totalCars > 0 ? round(($economyCars / $totalCars) * 100, 2) : 0;

    // === DADOS DE MOTORISTAS ===
    $driversMale = Driver::where('gender', 'male')->count();
    $driversFemale = Driver::where('gender', 'female')->count();
    $totalDrivers = Driver::count();
    $driversReserved = Reserve::whereNotNull('driver_id')->distinct('driver_id')->count('driver_id');

    // === DADOS DE RESERVAS (vendas do mês) ===
    $totalReservesThisMonth = Reserve::whereBetween('start_date', [
        now()->startOfMonth(),
        now()->endOfMonth()
    ])->sum('total_amount');

    // === CARROS RESERVADOS (exemplo: com reserva ativa) ===
    $reservedCars = Reserve::whereNotNull('car_id')
        ->where('status', 'confirmed') // ajuste conforme seu status
        ->distinct('car_id')
        ->count('car_id');

    $availableCars = $totalCars - $reservedCars;

    // === PORCENTAGENS PARA PROGRESS BARS ===
    $collectivePercentage = $totalCars > 0 ? round(($carsWithMoreThanEightSeats / $totalCars) * 100, 2) : 0;
    $lightPercentage = $totalCars > 0 ? round(($carsWithEightOrFewerSeats / $totalCars) * 100, 2) : 0;
    $availablePercentage = $totalCars > 0 ? round(($availableCars / $totalCars) * 100, 2) : 0;

    //total de acessorios no sistema

    $totalAccessories = Accessory::count();

    //total de venda no sistema
        $totalSells = Sell::count();

    //total de marcas no sistema
    $totalbrands = Brand::count(); 
    
    // === ÚLTIMAS 10 RESERVAS PARA MOSTRAR NA DASHBOARD ===
$recentReserves = Reserve::with(['client', 'car.brand', 'car.models', 'driver'])
    ->latest()
    ->take(10)
    ->get();

    // === ÚLTIMOS 6 FORNECEDORES PARA MOSTRAR NA DASHBOARD ===
$recentSuppliers = \App\Model\Supplier::withCount('cars')
    ->latest('id')
    ->take(6)
    ->get();

    // === ÚLTIMOS 6 CLIENTES PARA MOSTRAR NA DASHBOARD ===
$recentClients = \App\Model\Client::withCount('reserves')  // conta quantas reservas o cliente fez
    ->latest()
    ->take(6)
    ->get();

    return view('_admin.dashboard.crm.index', compact(
        'totalCars',
        'carsWithMoreThanEightSeats',
        'carsWithEightOrFewerSeats',
        'luxuryCars',
        'standardCars',
        'economyCars',
        'luxuryPercentage',
        'standardPercentage',
        'economyPercentage',
        'driversMale',
        'driversFemale',
        'totalDrivers',
        'driversReserved',
        'totalReservesThisMonth',
        'reservedCars',
        'availableCars',
        'collectivePercentage',
        'lightPercentage',
        'availablePercentage',
        'totalAccessories',
        'totalSells',
        'totalbrands',
        'recentReserves',
        'recentSuppliers',
        'recentClients'
    ));
}
    public function analytics()
    {
        return view('_admin.dashboard.Analytics.index');
    }
    public function showSalesReport()
    {
        return view('_admin.reports.reserves.index');
    }
    public function reportsLeads()
    {
        //CONTAR TOTAL DE CARROS
        $totalCars = Car::count();

        //Carros com lugares maior que 8
        $carsWithMoreThanEigthSeats = Car::where('number_of_seats', '>', 8)->count();

        //Carros com lugares menor ou igual a 8
        $carsWithEightOrFewerSeats = Car::where('number_of_seats', '<=', 8)->count();

        //CATEGORIAS DE CARROS
        $luxuryCars = Car::where('category', 'Luxury')->count();
        $standardCars = Car::where('category', 'Standard')->count();
        $economyCars = Car::where('category', 'Economy')->count();

        //CALCULAR PORCENTAJES
        $luxuryPercentage = $totalCars > 0 ? round(($luxuryCars / $totalCars) * 100, 2) : 0;
        $standardPercentage = $totalCars > 0 ? round(($standardCars / $totalCars) * 100, 2) : 0;
        $economyPercentage = $totalCars > 0 ? round(($economyCars / $totalCars) * 100, 2) : 0;

        return view('_admin.reports.cars.index', compact(
            'totalCars',
            'luxuryPercentage',
            'standardPercentage',
            'economyPercentage',
            'carsWithMoreThanEigthSeats',
            'carsWithEightOrFewerSeats'
        ));
    }
    public function reportsProject()
    {
        //motorista sexo masculino
        $driversMale = Driver::where('gender','male')->count();
        //motorista sexo feminino   
        $driversFemale = Driver::where('gender','female')->count();
        //total de motoristas
        $totalDrivers = Driver::count();
        //motorista para reservas
        $driversReserved = Reserve::whereNotNull('driver_id')->distinct('driver_id')->count('driver_id');
        

        return view('_admin.reports.drivers.index', compact('driversMale','driversFemale','totalDrivers','driversReserved'));
    }
    public function reportsSales()
    {
        // Calcular o total de vendas (soma do total_amount das reservas)
        $totalReserves = Reserve::whereBetween('start_date', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->sum('total_amount');

        // Passar a variável para a view
        return view('_admin.reports.reserves.index', compact('totalReserves'));
    }

        
   
}
