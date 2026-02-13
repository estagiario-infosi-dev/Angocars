@extends('layout._admin.main')

@section('title', 'Duralux || Vendas')

@section('content-admin')
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Vendas</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Vendas</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Voltar</span>
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        @if(auth()->user()->role !== 'financial')
                            <a href="{{ route('sells.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Nova Venda</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="sellsList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                            <th>Imagem</th>
                                            <th>Telefone</th>
                                            <th>WhatsApp</th>
                                            <th class="text-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $showRoute = auth()->user()->role === 'financial' 
                                                ? 'financeiro.sells.show' 
                                                : 'sells.show';
                                        @endphp

                                        @forelse($sells as $sell)
                                            <tr>
                                                <td>
                                                    <a href="{{ route($showRoute, $sell) }}" class="fw-bold">
                                                        {{ $sell->id }}
                                                    </a>
                                                </td>
                                                <td>{{ $sell->name }}</td>
                                                <td>{{ Str::limit($sell->description, 50) }}</td>
                                                <td>{{ number_format($sell->price, 2, ',', '.') }} Kz</td>
                                                <td>
                                                    @if($sell->image)
                                                        <img src="{{ asset('uploads/sells/' . $sell->image) }}" 
                                                             alt="Imagem" width="60" height="40" style="object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">Sem imagem</span>
                                                    @endif
                                                </td>
                                                <td>{{ $sell->number ?? '—' }}</td>
                                                <td>
                                                    @if($sell->whatsapp)
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sell->whatsapp) }}" 
                                                           target="_blank" class="btn btn-sm btn-success">
                                                            WhatsApp {{ $sell->whatsapp }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route($showRoute, $sell) }}" 
                                                           class="avatar-text avatar-md" title="Ver detalhes">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        @if(auth()->user()->role !== 'financial')
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" 
                                                                   class="avatar-text avatar-md" 
                                                                   data-bs-toggle="dropdown">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('sells.edit', $sell) }}">
                                                                            <i class="feather feather-edit-3 me-3"></i> Editar
                                                                        </a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li>
                                                                        <button type="button"
                                                                                class="dropdown-item text-danger"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#confirmModal"
                                                                                data-action="{{ route('sells.destroy', $sell) }}"
                                                                                data-title="Excluir Venda"
                                                                                data-message="Tem certeza que deseja <strong>excluir permanentemente</strong> esta venda?<br><small>Esta ação não pode ser desfeita.</small>"
                                                                                data-button-text="Sim, Excluir"
                                                                                data-button-class="btn-danger"
                                                                                data-method="DELETE">
                                                                            <i class="feather feather-trash-2 me-3"></i> Excluir
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <!-- <tr>
                                                <td colspan="8" class="text-center">Nenhuma venda encontrada.</td>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#sellsList').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' },
                pageLength: 10,
                responsive: true,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: 7 },
                    { width: '50px', targets: 0 },
                    { width: '120px', targets: 3 }
                ]
            });
        });
    </script>
    
@endsection