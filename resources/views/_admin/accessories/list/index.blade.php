@extends('layout._admin.main')
@section('title', 'Duralux || Acessórios')
@section('content-admin')

<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Acessórios</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Acessórios</li>
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
                    <!-- Botão "Novo Acessório" - SOMENTE se NÃO for financial -->
                    @if(auth()->user()->role !== 'financial')
                        <a href="{{ route('accessories.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Novo Acessório</span>
                        </a>
                    @endif
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
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover" id="accessoriesList">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Preço (Kz)</th>
                                        <th>Imagem</th>
                                        <th>Descrição</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Rota de visualização diferente para financial -->
                                    @php
                                        $showRoute = auth()->user()->role === 'financial' 
                                            ? 'financeiro.accessories.show' 
                                            : 'accessories.show';
                                    @endphp

                                    @forelse($accessories as $accessory)
                                        <tr>
                                            <td>
                                                <a href="{{ route($showRoute, $accessory) }}" class="fw-bold">
                                                    {{ $accessory->id }}
                                                </a>
                                            </td>
                                            <td>{{ $accessory->name }}</td>
                                            <td>{{ number_format($accessory->price, 2, ',', '.') }}</td>
                                            <td>
                                                @if($accessory->image)
                                                    <img src="{{ asset('uploads/accessories/' . $accessory->image) }}" 
                                                         alt="Imagem do acessório" width="60" height="40" 
                                                         style="object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Sem imagem</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($accessory->description, 50, '...') }}</td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">

                                                    <!-- Botão VER sempre aparece -->
                                                    <a href="{{ route($showRoute, $accessory) }}" 
                                                       class="avatar-text avatar-md" title="Ver Detalhes">
                                                        <i class="feather feather-eye"></i>
                                                    </a>

                                                    <!-- EDITAR e EXCLUIR: SOMENTE se NÃO for financial -->
                                                    @if(auth()->user()->role !== 'financial')
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" 
                                                               class="avatar-text avatar-md"
                                                               data-bs-toggle="dropdown">
                                                                <i class="feather feather-more-horizontal"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" 
                                                                       href="{{ route('accessories.edit', $accessory) }}">
                                                                        <i class="feather feather-edit-3 me-3"></i>
                                                                        Editar
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown-divider"></li>
                                                                <li>
                                                                    <!-- Botão Excluir usando o modal global -->
                                                                    <button type="button"
                                                                            class="dropdown-item text-danger"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#confirmModal"
                                                                            data-action="{{ route('accessories.destroy', $accessory) }}"
                                                                            data-title="Excluir Acessório"
                                                                            data-message="Tem certeza que deseja <strong>excluir permanentemente</strong> este acessório?<br><small>Esta ação não pode ser desfeita.</small>"
                                                                            data-button-text="Sim, Excluir"
                                                                            data-button-class="btn-danger"
                                                                            data-method="DELETE">
                                                                        <i class="feather feather-trash-2 me-3"></i>
                                                                        Excluir
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
                                            <td colspan="6" class="text-center">Nenhum acessório encontrado.</td>
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
    <!-- [ Main Content ] end -->
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#accessoriesList').DataTable({
                retrieve: true,
                destroy: true,
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' },
                pageLength: 10,
                responsive: true,
                order: [[0, 'desc']], // Ordena por ID descendente
                columnDefs: [
                    { orderable: false, targets: 5 } // Coluna Ações
                ]
            });
        });
    </script>
@endsection