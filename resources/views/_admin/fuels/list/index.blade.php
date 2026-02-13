@extends('layout._admin.main')

@section('title', 'Duralux || Combustíveis')

@section('content-admin')
<div class="nxl-content">

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Combustíveis</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">Combustíveis</li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('fuels.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Novo Cadastro</span>
                    </a>
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

                            <table class="table table-hover" id="paymentList">
                                <thead>
                                    <tr>
                                        <th class="wd-30">
                                            <div class="custom-control custom-checkbox ms-1">
                                                <input type="checkbox" class="custom-control-input" id="checkAllPayment">
                                                <label class="custom-control-label" for="checkAllPayment"></label>
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Data de Cadastro</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($fuels as $fuel)
                                        <tr class="single-item">

                                            <td>
                                                <div class="custom-control custom-checkbox ms-1">
                                                    <input type="checkbox"
                                                           class="custom-control-input checkbox"
                                                           id="checkBox_{{ $fuel->id }}">
                                                    <label class="custom-control-label"
                                                           for="checkBox_{{ $fuel->id }}"></label>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="{{ route('fuels.show', $fuel) }}" class="fw-bold">
                                                    {{ $fuel->id }}
                                                </a>
                                            </td>

                                            <td>
                                                <span class="text-truncate-1-line">
                                                    {{ $fuel->name }}
                                                </span>
                                            </td>

                                            <td class="fw-bold text-dark">
                                                {{ \Str::limit($fuel->description, 40) }}
                                            </td>

                                            <td class="fw-bold text-dark">
                                                {{ $fuel->date ? \Carbon\Carbon::parse($fuel->date)->format('d/m/Y') : 'N/A' }}
                                            </td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">

                                                    <!-- Ver -->
                                                    <a href="{{ route('fuels.show', $fuel) }}"
                                                       class="avatar-text avatar-md"
                                                       title="Ver detalhes">
                                                        <i class="feather feather-eye"></i>
                                                    </a>

                                                    <!-- Dropdown -->
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)"
                                                           class="avatar-text avatar-md"
                                                           data-bs-toggle="dropdown"
                                                           data-bs-offset="0,21">
                                                            <i class="feather feather-more-horizontal"></i>
                                                        </a>

                                                        <ul class="dropdown-menu">

                                                            <!-- Editar -->
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ route('fuels.edit', $fuel) }}">
                                                                    <i class="feather feather-edit-3 me-3"></i>
                                                                    <span>Editar</span>
                                                                </a>
                                                            </li>

                                                            <li class="dropdown-divider"></li>

                                                            <!-- Excluir com Modal -->
                                                            <li>
                                                                <button type="button"
                                                                        class="dropdown-item text-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#confirmModal"
                                                                        data-action="{{ route('fuels.destroy', $fuel) }}"
                                                                        data-title="Excluir Combustível"
                                                                        data-message="Tem certeza que deseja <strong>excluir permanentemente</strong> este combustível?<br><small>Esta ação não pode ser desfeita.</small>"
                                                                        data-button-text="Sim, Excluir"
                                                                        data-button-class="btn-danger"
                                                                        data-method="DELETE">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Excluir</span>
                                                                </button>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
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
    $(document).ready(function () {
        $('#paymentList').DataTable({
            retrieve: true,
            destroy: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 10,
            responsive: true,
            order: [[1, 'desc']],
            columnDefs: [
                { orderable: false, targets: [0, 5] }
            ]
        });
    });
</script>
@endsection
