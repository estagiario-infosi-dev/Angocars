@extends('layout._admin.main')

@section('title', 'Duralux || Reservas')

@section('content-admin')
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Reservas</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Reservas</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">Voltar</a>
                    </div>

                    @if (auth()->user()->role !== 'financial')
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="{{ route('reserves.create') }}" class="btn btn-primary">Nova Reserva</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="reserveList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Carro</th>
                                            <th>Valor</th>
                                            <th>Motorista</th>
                                            <th>Estado</th>
                                            <th class="text-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $showRoute = auth()->user()->role === 'financial' ? 'financeiro.reserves.show' : 'reserves.show';
                                        @endphp

                                        @forelse($reserves as $reserve)
                                            <tr>
                                                <td>{{ $reserve->id }}</td>
                                                <td>{{ $reserve->client->name ?? 'N/A' }}</td>
                                                <td>{{ $reserve->car->brand->name ?? 'N/A' }} {{ $reserve->car->models->name ?? 'N/A' }}</td>
                                                <td>{{ number_format($reserve->total_amount, 2, ',', '.') }} KZ</td>
                                                <td>{{ $reserve->driver->full_name ?? 'Sem motorista' }}</td>
                                                <td>
                                                    @if ($reserve->status == 'peding')
                                                        <span class="badge bg-info">Pendente</span>
                                                    @elseif ($reserve->status == 'in_progress')
                                                        <span class="badge bg-warning">Em Andamento</span>
                                                    @elseif($reserve->status == 'completed')
                                                        <span class="badge bg-success">Concluída</span>
                                                    @elseif($reserve->status == 'canceled')
                                                        <span class="badge bg-danger">Cancelada</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($reserve->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route($showRoute, $reserve->id) }}" class="avatar-text avatar-md" title="Ver detalhes">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        @if($reserve->status === 'peding')
                                                            <button type="button" class="avatar-text avatar-md text-success" title="Aprovar reserva"
                                                                data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                                data-action="{{ route('reserves.approve', $reserve->id) }}"
                                                                data-title="Aprovar Reserva"
                                                                data-message="Tem certeza que deseja <strong>aprovar</strong> esta reserva?"
                                                                data-button-text="Sim, Aprovar Reserva"
                                                                data-button-class="btn-success">
                                                                <i class="feather feather-check-circle"></i>
                                                            </button>

                                                            <!-- Botão Cancelar reserva -->
                                                        <button type="button" class="avatar-text avatar-md text-danger" title="Cancelar reserva"
                                                           data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                        data-action="{{ route('reserves.cancel', $reserve->id) }}"
                                                        data-title="Cancelar Reserva"
                                                        data-message="Tem certeza que deseja <strong>cancelar</strong> esta reserva?"
                                                        data-button-text="Sim, Cancelar Reserva"
                                                        data-button-class="btn-danger">
                                                        <i class="feather feather-x-circle"></i>
                                                    </button>
                                                                                                            @endif

                                                        @if (auth()->user()->role !== 'financial')
                                                            @php
                                                                $canEdit = !in_array($reserve->status, ['peding', 'in_progress', 'completed', 'cancelled']);
                                                                $canDelete = in_array($reserve->status, ['cancelled', 'completed']);
                                                            @endphp

                                                            @if($canEdit || $canDelete)
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                        <i class="feather feather-more-horizontal"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        @if($canEdit)
                                                                            <li><a class="dropdown-item" href="{{ route('reserves.edit', $reserve->id) }}">Editar</a></li>
                                                                        @endif
                                                                        @if($canDelete)
                                                                            @if($canEdit)<li class="dropdown-divider"></li>@endif
                                                                            <li>
                                                                                <button type="button" class="dropdown-item text-danger"
                                                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                                                    data-action="{{ route('reserves.destroy', $reserve->id) }}"
                                                                                    data-title="Apagar Reserva"
                                                                                    data-method="DELETE"
                                                                                    data-message="Tem certeza que deseja <strong> apagar permanentemente</strong> esta reserva?"
                                                                                    data-button-text="Sim, Apagar Reserva"
                                                                                    data-button-class="btn-danger">
                                                                                    APAGAR
                                                                                </button>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <!-- <tr>
                                                <td colspan="7" class="text-center">Nenhuma reserva cadastrada.</td>
                                            </tr> -->
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Token CSRF escondido -->
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reserveList').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' },
                pageLength: 10,
                responsive: true,
                order: [[0, 'desc']], // Ordena por ID descrescente (mais recente primeiro)
                columnDefs: [
                    { orderable: false, targets: 6 },
                    { width: '50px', targets: 0 },
                    { width: '120px', targets: 3 }
                ]
            });
        });

        const confirmModal = document.getElementById('confirmModal');
        if (confirmModal) {
            confirmModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                const action = button.getAttribute('data-action');
                const title = button.getAttribute('data-title') || 'Confirmar Ação';
                const message = button.getAttribute('data-message');
                const buttonText = button.getAttribute('data-button-text');
                const buttonClass = button.getAttribute('data-button-class') || 'btn-primary';
                const method = button.getAttribute('data-method') || 'POST';

                // Título do modal
                document.getElementById('confirmModalLabel').textContent = title;

                // Mensagem
                document.getElementById('confirmModalBody').innerHTML = message;

                // Botão Confirmar
                const confirmBtn = document.getElementById('confirmButton');
                confirmBtn.textContent = buttonText;
                confirmBtn.className = 'btn ' + buttonClass;

                // Form
                const form = document.getElementById('confirmForm');
                form.action = action;

                // _method para DELETE
                let methodInput = form.querySelector('input[name="_method"]');
                if (method === 'DELETE') {
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);
                    }
                } else if (methodInput) {
                    methodInput.remove();
                }

                // Token CSRF
                let csrfInput = form.querySelector('input[name="_token"]');
                if (!csrfInput) {
                    csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    form.appendChild(csrfInput);
                }
                csrfInput.value = document.getElementById('csrf-token').value;
            });

            // Reset ao fechar
            confirmModal.addEventListener('hidden.bs.modal', () => {
                document.getElementById('confirmModalLabel').textContent = 'Confirmar Ação';
                document.getElementById('confirmModalBody').innerHTML = 'Tem certeza que deseja realizar esta ação?';
                document.getElementById('confirmButton').textContent = 'Confirmar';
                document.getElementById('confirmButton').className = 'btn btn-primary';
            });
        }
    </script>
@endsection