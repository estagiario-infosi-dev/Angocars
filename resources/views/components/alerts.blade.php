{{-- Sucesso --}}
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: @json(session('success')),
            showConfirmButton: false,
            timer: 2500
        });
    </script>
@endif

{{-- Erro geral --}}
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: @json(session('error')),
            showConfirmButton: false,
            timer: 2500
        });
    </script>
@endif

{{-- Aviso --}}
@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Atenção',
            text: @json(session('warning')),
            showConfirmButton: false,
            timer: 2500
        });
    </script>
@endif

{{-- Erros de validação --}}
@if ($errors->any())
    <script>
        let errorMessages = `<ul style="text-align:left;">`;
        @foreach ($errors->all() as $error)
            errorMessages += `<li>{{ $error }}</li>`;
        @endforeach
        errorMessages += `</ul>`;

        Swal.fire({
            icon: 'error',
            title: 'Erro de validação',
            html: errorMessages,
            confirmButtonText: 'Ok'
        });
    </script>
@endif