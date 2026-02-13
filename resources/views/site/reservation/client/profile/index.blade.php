{{-- resources/views/site/reservation/client/profile/index.blade.php --}}

@extends('site.reservation.layouts.main')

@section('title', 'AngoCar - Meu Perfil')

@section('content')

<div class="main-wrapper">

    <!-- Breadscrumb Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Meu Perfil</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Meu Perfil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadscrumb Section -->

    <div class="content dashboard-content">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">

                <!-- Formulário de Edição de Perfil -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Perfil</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('site.client.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Nome completo <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Telefone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}" required placeholder="+244 ...">
                                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Nova Senha (deixe em branco para manter a atual)</label>
                                        <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres">
                                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Confirmar Nova Senha</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Formulário de Edição de Perfil -->

                <!-- Minhas Reservas -->
                <div class="col-lg-12 mt-5">
                    <div class="content-header d-flex align-items-center justify-content-between">
                        <h4>Minhas Reservas</h4>
                    </div>

                    <div class="sorting-info mt-3">
                        <div class="booking-lists">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('status') ? '' : 'active' }}"
                                       href="{{ route('site.client.profile') }}">
                                        Todas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('status') === 'peding' ? 'active' : '' }}"
                                       href="{{ route('site.client.profile') }}?status=peding">
                                        Pendente
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('status') === 'in_progress' ? 'active' : '' }}"
                                       href="{{ route('site.client.profile') }}?status=in_progress">
                                        Em Andamento
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('status') === 'completed' ? 'active' : '' }}"
                                       href="{{ route('site.client.profile') }}?status=completed">
                                        Concluída
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('status') === 'cancelled' ? 'active' : '' }}"
                                       href="{{ route('site.client.profile') }}?status=cancelled">
                                        Cancelada
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tabela de Reservas -->
                    <div class="row mt-3">
                        <div class="col-lg-12 d-flex">
                            <div class="card book-card flex-fill mb-0">
                                <div class="card-header">
                                    <h4>
                                        Todas as Reservas
                                        <span>{{ $reserves->count() }}</span>
                                    </h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive dashboard-table">
                                        <table class="table datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Carro</th>
                                                    <th>Entrega</th>
                                                    <th>Retorno</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th class="text-end">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($reserves as $reserve)
                                                    <tr>
                                                        <td>
                                                            <label class="custom_check">
                                                                <input type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </td>

                                                        <td>{{ $reserve->id }}</td>

                                                        <td>
                                                            <div class="table-avatar">
                                                                <a class="avatar avatar-lg">
                                                                    <img class="avatar-img"
                                                                         src="{{ $reserve->car && $reserve->car->image
                                                                             ? asset('uploads/car/car_images/'.$reserve->car->image)
                                                                             : asset('assets/user/img/cars/car-01.jpg') }}"
                                                                         alt="Carro">
                                                                </a>
                                                                <div class="table-head-name">
                                                                    <a>
                                                                        {{ $reserve->car->brand->name ?? '' }}
                                                                        {{ $reserve->car->models->name ?? '' }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            {{ $reserve->pickup_location }}
                                                            <span class="d-block">
                                                               {{ \Carbon\Carbon::parse($reserve->start_date)->format('d/m/Y') }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            {{ $reserve->return_location }}
                                                            <span class="d-block">
                                                                {{ \Carbon\Carbon::parse($reserve->end_date)->format('d/m/Y') }} 
                                                            </span>
                                                        </td>

                                                        <td>
                                                            {{ number_format($reserve->total_amount, 2, ',', '.') }} Kz
                                                        </td>

                                                        <td>
                                                            @switch($reserve->status)
                                                                @case('pending')
                                                                @case('peding')
                                                                    <span class="badge badge-light-secondary">Pendente</span>
                                                                    @break
                                                                @case('in_progress')
                                                                    <span class="badge badge-light-warning">Em andamento</span>
                                                                    @break
                                                                @case('completed')
                                                                    <span class="badge badge-light-success">Concluída</span>
                                                                    @break
                                                                @case('canceled')
                                                                @case('cancelled')
                                                                    <span class="badge badge-light-danger">Cancelada</span>
                                                                    @break
                                                                @default
                                                                    <span class="badge badge-light-dark">{{ $reserve->status }}</span>
                                                            @endswitch
                                                        </td>

                                                        <td class="text-end">
                                                            <div class="dropdown dropdown-action">
                                                                <a class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item"
                                                                       href="{{ route('car.confirmed', $reserve->id) }}">
                                                                        <i class="feather-eye"></i> Ver
                                                                    </a>

                                                                    @if(in_array($reserve->status, ['pending', 'peding', 'in_progress']))
                                                                        <a href="javascript:void(0);"
                                                                           class="dropdown-item text-danger"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#cancel_modal"
                                                                           data-cancel-action="{{ route('site.client.reservation.cancel', $reserve->id) }}">
                                                                            <i class="feather-trash-2"></i> Cancelar
                                                                        </a>
                                                                    @endif

                                                                    @if(in_array($reserve->status, ['canceled', 'cancelled']))
                                                                        <a href="javascript:void(0);"
                                                                           class="dropdown-item text-danger"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#delete_modal"
                                                                           data-reserve-action="{{ route('site.client.reservation.delete', $reserve->id) }}">
                                                                            <i class="feather-trash-2"></i> Apagar
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Nenhuma reserva encontrada.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Minhas Reservas -->

            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal new-modal fade" id="cancel_modal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="delete-action">
                    <div class="delete-header">
                        <h4>Cancelar Reserva</h4>
                        <p>Tem certeza que deseja cancelar esta reserva?</p>
                    </div>

                    <form id="cancel-reserve-form" method="POST">
                        @csrf
                        <!-- Não precisa de @method('DELETE') aqui, pois sua rota de cancelar é POST -->
                    </form>

                    <div class="modal-btn mt-4">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" form="cancel-reserve-form" class="btn btn-danger w-100">
                                    Cancelar Reserva
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">
                                    Voltar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal new-modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="delete-action">
                    <div class="delete-header">
                        <h4>Apagar a Reserva</h4>
                        <p>Você tem certeza de que deseja apagar esta reserva? Esta ação não pode ser desfeita.</p>
                    </div>

                    <form id="delete-reserve-form" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    <div class="modal-btn mt-4">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" form="delete-reserve-form" class="btn btn-danger w-100">
                                    Apagar
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para modais dinâmicos -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Modal de Apagar
        const deleteModal = document.getElementById('delete_modal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const actionUrl = button.getAttribute('data-reserve-action');

            const form = document.getElementById('delete-reserve-form');
            if (actionUrl) {
                form.action = actionUrl;
            }
        });

        // Modal de Cancelar
        const cancelModal = document.getElementById('cancel_modal');
        cancelModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const actionUrl = button.getAttribute('data-cancel-action');

            const form = document.getElementById('cancel-reserve-form');
            if (actionUrl) {
                form.action = actionUrl;
            }
        });
    });
</script>

@endsection