@extends('layout._admin.main')
@section('title', 'Dashboard')
@section('content-admin')

<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
            <!-- <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ul> -->
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                    </div>
                    <!-- <div class="dropdown filter-dropdown">
                        <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10" data-bs-auto-close="outside">
                            <i class="feather-filter me-2"></i>
                            <span>Relatório</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="reports_car" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="reports_car">Carros</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="reports_reserves" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="reports_reserves">Reservas</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="reports_driver" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="reports_driver">Motoristas</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="reports_supplier" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="reports_supplier">Fornecedores</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="reports_client" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="reports_client">Clientes</label>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" id="btnreportsgeneral" class="dropdown-item">
                                <i class="feather-filter me-3"></i>
                                <span>Gerar Relatório</span>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <!-- [Invoices Awaiting Payment] start -->
<!-- TOTAL DE CARROS -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-truck"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                           <!--  <span class="counter">{{ $carsWithMoreThanEightSeats }}</span>/ -->
                            <span class="counter">{{ $totalCars }}</span>
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">TOTAL DE CARROS</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted"></a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $totalCars }}%</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-primary" style="width: {{ $totalCars }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- CARROS COLETIVO -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-truck"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $carsWithMoreThanEightSeats }}</span>
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS COLETIVO</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">> 8 lugares</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $collectivePercentage }}%</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-warning" style="width: {{ $collectivePercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CARROS LIGEIRO -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-truck"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $carsWithEightOrFewerSeats }}</span>
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS LIGEIRO</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">≤ 8 lugares</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $lightPercentage }}%</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-success" style="width: {{ $lightPercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- CARROS DE LUXO -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-truck"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $luxuryPercentage }}</span>%
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS DE LUXO</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">Luxury</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $luxuryCars }} carros</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-danger" style="width: {{ $luxuryPercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
              <!-- CLASSE MÉDIA (Standard) -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-truck"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $standardPercentage }}</span>%
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS DE CLASSE MÉDIA</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">Standard</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $standardCars }} Carros</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-primary" style="width: {{ $standardPercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div><!-- CLASSE ECONÔMICA -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-activity"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $economyPercentage }}</span>%
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS DE CLASSE ECONÔMICA</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">Economy</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $economyCars }} carros</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-warning" style="width: {{ $economyPercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>


          <!-- CARROS RESERVADOS -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-activity"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $reservedCars }}</span>
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS RESERVADOS</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">Confirmados</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $reservedCars }}</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-success" style="width: {{ ($totalCars > 0 ? ($reservedCars/$totalCars)*100 : 0) }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CARROS DISPONÍVEIS -->
<div class="col-xxl-3 col-md-6">
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-activity"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold text-dark">
                            <span class="counter">{{ $availablePercentage }}</span>%
                        </div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">CARROS DISPONÍVEIS</h3>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">Livres</a>
                    <div class="w-100 text-end">
                        <span class="fs-12 text-dark">{{ $availableCars }} carros</span>
                    </div>
                </div>
                <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-danger" style="width: {{ $availablePercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="col-xxl-8">
    <div class="card stretch stretch-full">
        <div class="card-header">
            <h5 class="card-title">MOTORISTA</h5>
        </div>
        <div class="card-body custom-card-action p-0">
            <div id="payment-records-chart"></div>
        </div>
        <div class="card-footer">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="p-3 border border-dashed rounded">
                        <div class="fs-12 text-muted mb-1">TOTAL</div>
                        <h6 class="fw-bold text-dark">{{ $totalDrivers }}</h6>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 border border-dashed rounded">
                        <div class="fs-12 text-muted mb-1">Gênero Masculino</div>
                        <h6 class="fw-bold text-dark">{{ $driversMale }}</h6>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-success" style="width: {{ $totalDrivers > 0 ? ($driversMale/$totalDrivers)*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 border border-dashed rounded">
                        <div class="fs-12 text-muted mb-1">Gênero Feminino</div>
                        <h6 class="fw-bold text-dark">{{ $driversFemale }}</h6>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-danger" style="width: {{ $totalDrivers > 0 ? ($driversFemale/$totalDrivers)*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 border border-dashed rounded">
                        <div class="fs-12 text-muted mb-1">Selecionados para Reserva</div>
                        <h6 class="fw-bold text-dark">{{ $driversReserved }}</h6>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-dark" style="width: {{ $totalDrivers > 0 ? ($driversReserved/$totalDrivers)*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-star"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">Viaturas a Venda</div>
                                <div class="fs-12 text-muted"></div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">{{$totalSells}}</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="task-completed-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap">
                            <span class="fw-semibold text-primary"></span><br />
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-file-text"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">Acessórios a Venda</div>
                                <div class="fs-12 text-muted"></div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">{{$totalAccessories}}</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="new-tasks-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap">
                            <span class="fw-semibold text-success"></span><br />
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-airplay"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">MARCAS</div>
                                <div class="fs-12 text-muted"></div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">{{$totalbrands}}</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="project-done-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap"></span><br />
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
    <div class="col-xxl-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="feather feather-calendar me-2"></i>
                    Últimas Reservas
                </h5>
                <div class="card-header-action">
                    <a href="{{ route('reserves.index') }}" class="btn btn-sm btn-primary">
                        Ver todas
                    </a>
                </div>
            </div>

            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="border-b">
                                <th>Cliente</th>
                                <th>Carro</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Motorista</th>
                                <th>Status</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReserves as $reserve)
                                <tr>
                                    <!-- Cliente com avatar -->
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image avatar-md">
                                                @if($reserve->client && $reserve->client->photo)
                                                    <img src="{{ asset('storage/' . $reserve->client->photo) }}" 
                                                         alt="{{ $reserve->client->name }}" 
                                                         class="img-fluid rounded-circle">
                                                @else
                                                    <div class="avatar-text avatar-md bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold">
                                                        {{ $reserve->client ? substr($reserve->client->name, 0, 2) : '??' }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="d-block fw-semibold">
                                                    {{ $reserve->client->name ?? 'Cliente removido' }}
                                                </span>
                                                <small class="text-muted">
                                                    {{ $reserve->client->phone ?? '' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Carro -->
                                    <td>
                                        <span class="fw-medium">
                                            {{ $reserve->car->brand->name ?? '—' }} {{ $reserve->car->models->name ?? '' }}
                                        </span>
                                        <br>
                                        <small class="text-muted">{{ $reserve->car->plate ?? '' }}</small>
                                    </td>

                                    <!-- Data -->
                                    <td>
                                        {{ \Carbon\Carbon::parse($reserve->start_date)->format('d/m/Y') }}
                                        <br>
                                        <!-- <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($reserve->start_date)->format('H:i') }}
                                        </small> -->
                                    </td>

                                    <!-- Valor -->
                                    <td class="fw-bold text-primary">
                                        {{ number_format($reserve->total_amount, 2, ',', '.') }} KZ
                                    </td>

                                    <!-- Motorista -->
                                    <td>
                                        @if($reserve->driver)
                                            <span class="d-block">{{ $reserve->driver->full_name }}</span>
                                            <small class="text-muted">{{ $reserve->driver->phone }}</small>
                                        @else
                                            <span class="text-muted">Sem motorista</span>
                                        @endif
                                    </td>

                                    <!-- Status com cores bonitas -->
                                    <td>
                                        @switch($reserve->status)
                                            @case('in_progress')
                                                <span class="badge bg-soft-warning text-warning">Em Andamento</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-soft-success text-success">Concluída</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-soft-danger text-danger">Cancelada</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Pendente</span>
                                        @endswitch
                                    </td>

                                    <!-- Ações -->
                                    <td class="text-end">
                                        <a href="{{ route(auth()->user()->role === 'financial' ? 'financeiro.reserves.show' : 'reserves.show', $reserve->id) }}"
                                           class="avatar-text avatar-md bg-info text-white"
                                           title="Ver detalhes">
                                            <i class="feather feather-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <!-- <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="feather feather-inbox fs-2"></i><br>
                                        Nenhuma reserva recente.
                                    </td>
                                </tr> -->
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('reserves.index') }}" class="text-primary fw-medium">
                    Ver todas as reservas →
                </a>
            </div>
        </div>
    </div>
</div>
            <!-- [Latest Leads] end -->
            
           
            <div class="row mt-4">
    <div class="col-xxl-4">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="feather feather-truck me-2"></i>
                    Fornecedores Recentes
                </h5>
                <div class="card-header-action">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-primary">
                        Ver todos
                    </a>
                </div>
            </div>

            <div class="card-body custom-card-action p-0">
                @forelse($recentSuppliers as $supplier)
                    <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-3 hover-shadow-sm transition">
                        <div class="hstack gap-3">
                            <div class="avatar-image avatar-lg">
                                @if($supplier->photo && file_exists(public_path('uploads/supplier/supplier_photo/' . $supplier->photo)))
                                    <img src="{{ asset('uploads/supplier/supplier_photo/' . $supplier->photo) }}" 
                                         alt="{{ $supplier->name }}" 
                                         class="img-fluid rounded-circle" 
                                         style="width: 56px; height: 56px; object-fit: cover;">
                                @else
                                    <div class="avatar-text avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold fs-5">
                                        {{ substr($supplier->name, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('suppliers.show', $supplier) }}" class="fw-semibold text-dark hover-primary">
                                    {{ $supplier->name }}
                                </a>
                                <div class="fs-12 text-muted">
                                    <i class="feather feather-phone fs-10"></i>
                                    {{ $supplier->phone ?? 'Sem telefone' }}
                                </div>
                                <div class="fs-11 text-muted mt-1">
    {{ $supplier->cars_count }} carro{{ $supplier->cars_count !== 1 ? 's' : '' }} fornecido{{ $supplier->cars_count !== 1 ? 's' : '' }}
</div>
                            </div>
                        </div>

                        <!-- Pequeno badge com status ou data -->
                        <div class="text-end">
                            <small class="text-muted d-block">
                                {{ $supplier->registration_date ? \Carbon\Carbon::parse($supplier->registration_date)->format('d/m/Y') : 'Sem data' }}
                            </small>
                            <a href="{{ route('suppliers.show', $supplier) }}" 
                               class="avatar-text avatar-md bg-info text-white" 
                               title="Ver detalhes">
                                <i class="feather feather-eye"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- <div class="text-center py-5 text-muted">
                        <i class="feather feather-users fs-2"></i><br>
                        Nenhum fornecedor cadastrado ainda.
                    </div> -->
                @endforelse
            </div>

            @if($recentSuppliers->count() > 0)
            <div class="card-footer text-center bg-light">
                <a href="{{ route('suppliers.index') }}" class="text-primary fw-medium small">
                    Ver todos os fornecedores →
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Aqui podes colocar o bloco das reservas do lado, se quiseres em col-xxl-8 -->
    <div class="col-xxl-8">
        <!-- (opcional) aqui podes colocar o bloco das reservas que já fizemos antes -->
    </div>
</div>

            <div class="col-xxl-4">
    <div class="card stretch stretch-full">
        <div class="card-header">
            <h5 class="card-title">
                <i class="feather feather-users me-2"></i>
                Clientes Recentes
            </h5>
            <div class="card-header-action">
                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">
                    Ver todos
                </a>
            </div>
        </div>

        <div class="card-body custom-card-action p-0">
            @forelse($recentClients as $client)
                <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-3 hover-shadow-sm transition">
                    <div class="hstack gap-3">
                        <div class="avatar-image avatar-lg">
                            @if($client->photo && file_exists(public_path('storage/clients/' . $client->photo)))
                                <img src="{{ asset('storage/clients/' . $client->photo) }}" 
                                     alt="{{ $client->name }}" 
                                     class="img-fluid rounded-circle"
                                     style="width: 56px; height: 56px; object-fit: cover;">
                            @else
                                <div class="avatar-text avatar-lg bg-success rounded-circle d-flex align-items-center justify-content-center text-white fw-bold fs-5">
                                    {{ strtoupper(substr($client->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('clients.show', $client) }}" class="fw-semibold text-dark hover-primary">
                                {{ $client->name }}
                            </a>
                            <div class="fs-12 text-muted">
                                <i class="feather feather-phone fs-10"></i>
                                {{ $client->phone ?? 'Sem telefone' }}
                            </div>
                            <div class="fs-11 text-muted mt-1">
                                <i class="feather feather-calendar fs-10"></i>
                                {{ $client->reserves_count }} reserva{{ $client->reserves_count !== 1 ? 's' : '' }} feita{{ $client->reserves_count !== 1 ? 's' : '' }}
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <small class="text-muted d-block fs-11">
                            {{ $client->created_at->format('d/m/Y') }}
                        </small>
                        <a href="{{ route('clients.show', $client) }}" 
                           class="avatar-text avatar-md bg-info text-white" 
                           title="Ver cliente">
                            <i class="feather feather-eye"></i>
                        </a>
                    </div>
                </div>
            @empty
                <!-- <div class="text-center py-5 text-muted">
                    <i class="feather feather-user-x fs-2"></i><br>
                    Nenhum cliente cadastrado ainda.
                </div> -->
            @endforelse
        </div>

        @if($recentClients->count() > 0)
        <div class="card-footer text-center bg-light">
            <a href="{{ route('clients.index') }}" class="text-primary fw-medium small">
                Ver todos os clientes →
            </a>
        </div>
        @endif
    </div>
</div>
            <!--! END: [Team Progress] !-->
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script>
    $(document).ready(function(){
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
@endpush