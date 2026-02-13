<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/css/dataTables.bs5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/theme.min.css')}}">
    <!-- inicio dependecias do editor de texto -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.1.1/ckeditor5.css" crossorigin>
    <link rel="stylesheet" href="{{ url('assets/css/ckeditor.css') }}">
     <!-- fim dependecias do editor de texto -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    @include('layout._admin.header')
    @include('layout._admin.menu')
    @include('layout._admin.thema')

    <main class="nxl-container">
        @include('components.alerts')
        @yield('content-admin')
    </main>

    <!-- Modal de Confirmação Genérico -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Ação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmModalBody">Tem certeza que deseja realizar esta ação?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário escondido para submissão segura (resolve 419) -->
    <form id="confirmForm" method="POST" style="display: none;"></form>

    @include('layout._admin.footer')

    <!-- Vendors JS (já inclui jQuery, NÃO carregues outro jQuery depois!) -->
    <script src="{{ url('assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ url('assets/vendors/js/dataTables.min.js')}}"></script>
    <script src="{{ url('assets/vendors/js/dataTables.bs5.min.js')}}"></script>

    <script src="{{ url('assets/js/common-init.min.js')}}"></script>
    <script src="{{ url('assets/js/payment-init.min.js')}}"></script>
    <script src="{{ url('assets/js/theme-customizer-init.min.js')}}"></script>

    @yield('scripts')

    <!-- inicio script ckEditor -->
     <script src="https://cdn.ckeditor.com/ckeditor5/46.1.1/ckeditor5.umd.js" crossorigin></script>
    <!-- fim script ckEditor -->

    <!-- Script do Modal de Confirmação (funciona sem erro 419) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('confirmModal');
            const form = document.getElementById('confirmForm');
            const confirmButton = document.getElementById('confirmButton');

            if (modal && form && confirmButton) {
                modal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    const action = button.getAttribute('data-action');
                    const title = button.getAttribute('data-title') || 'Confirmar Ação';
                    const message = button.getAttribute('data-message') || 'Tem certeza que deseja realizar esta ação?';
                    const buttonText = button.getAttribute('data-button-text') || 'Confirmar';
                    const buttonClass = button.getAttribute('data-button-class') || 'btn-primary';
                    const method = button.getAttribute('data-method') || 'POST';

                    document.getElementById('confirmModalLabel').textContent = title;
                    document.getElementById('confirmModalBody').innerHTML = message;
                    confirmButton.textContent = buttonText;
                    confirmButton.className = 'btn ' + buttonClass;

                    // Configura o form escondido
                    form.action = action;
                    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">';

                    if (['DELETE', 'PUT', 'PATCH'].includes(method.toUpperCase())) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = method.toUpperCase();
                        form.appendChild(methodInput);
                    }

                    confirmButton.onclick = () => form.submit();
                });

                modal.addEventListener('hidden.bs.modal', function () {
                    confirmButton.textContent = 'Confirmar';
                    confirmButton.className = 'btn btn-primary';
                    confirmButton.onclick = null;
                    form.action = '';
                    form.innerHTML = '';
                });
            }
        });
    </script>

    <!-- Inicialização do DataTables com pesquisa e entradas por página (em PT) -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json'
                },
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                searching: true,
                ordering: true,
                info: true,
                paging: true
            });
        });
    </script>

    <!-- Script de carregamento de modelos (se necessário em algumas páginas) -->
    <script>
        $(document).ready(function() {
            function loadModels(brandId, selectedModelId = null) {
                const $modelSelect = $('#models_id');
                if (!brandId) {
                    $modelSelect.html('<option value="">Selecione primeiro a Marca</option>');
                    return;
                }
                $modelSelect.html('<option value="">Carregando...</option>');

                $.ajax({
                    url: '/get-models-by-brand/' + brandId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(models) {
                        $modelSelect.html('<option value="">Selecione o Modelo</option>');
                        if (models.length === 0) {
                            $modelSelect.append('<option value="">Nenhum modelo encontrado</option>');
                            return;
                        }
                        $.each(models, function(index, model) {
                            const selected = (selectedModelId && model.id == selectedModelId) ? 'selected' : '';
                            $modelSelect.append(`<option value="${model.id}" ${selected}>${model.name}</option>`);
                        });
                    },
                    error: function() {
                        $modelSelect.html('<option value="">Erro ao carregar</option>');
                    }
                });
            }

            $('#brand_id').on('change', function() {
                loadModels($(this).val());
            });

            @if(isset($car) && $car->brand_id)
                loadModels({{ $car->brand_id }}, {{ $car->models_id ?? 'null' }});
            @elseif(old('brand_id'))
                loadModels({{ old('brand_id') }}, {{ old('models_id') ?? 'null' }});
            @endif
        });
    </script>


</body>
</html>