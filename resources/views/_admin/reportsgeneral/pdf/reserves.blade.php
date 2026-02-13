<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo ?? 'Relatório de Reservas' }}</title>
    <style>
        @page {
            margin: 50px 30px 70px 30px; /* Reduzi um pouco as margens para ganhar espaço */
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #222;
            line-height: 1.5;
            position: relative;
        }

        /* Marca d’água */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('{{ public_path("assets/user/img/ango-cars-2.png") }}');
            background-size: 500px;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.08;
            z-index: -1;
        }

        /* Cabeçalho */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 4px solid #f7c600;
            padding-bottom: 15px;
        }

        .header img {
            height: 70px;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #1a3c6d;
            font-size: 28px;
            margin: 10px 0 5px 0;
            font-weight: bold;
        }

        .header .subtitle {
            font-size: 16px;
            color: #444;
            margin: 5px 0;
        }

        .info {
            margin: 20px 0;
            font-size: 14px;
            color: #444;
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px; /* Reduzido para caber melhor */
        }

        th {
            background: #f7c600;
            color: #000;
            padding: 10px 6px; /* Padding menor */
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 8px 6px; /* Padding menor */
            border-bottom: 1px solid #ddd;
            word-wrap: break-word; /* Quebra texto longo */
        }

        /* Colunas com texto longo */
        th:nth-child(2), td:nth-child(2), /* Cliente */
        th:nth-child(3), td:nth-child(3), /* Carro */
        th:nth-child(4), td:nth-child(4) { /* Modelo */
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        tr:hover {
            background-color: #fffbe6;
        }

        .total-row {
            font-weight: bold;
            font-size: 14px;
            background-color: #1a3c6d !important;
            color: white;
        }

        th.amount, td.amount {
            text-align: right;
            white-space: nowrap;
        }

        .total-row td.amount {
            text-align: center;
        }

        /* Rodapé */
        .footer {
            position: fixed;
            bottom: 30px;
            left: 0; right: 0;
            text-align: center;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #f7c600;
            padding-top: 8px;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <div class="header">
        <img src="{{ public_path('assets/user/img/ango-cars-2.png') }}" alt="AngoCars">
        <h1>{{ $titulo }}</h1>
        <div class="subtitle">
            @if(request()->has('start_date') && request()->has('end_date'))
                Período: {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }}
                até {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}
            @endif
        </div>
        <div class="info">
            Emitido em: {{ now()->format('d/m/Y \à\s H:i') }} 
            | Total de reservas: {{ $reports->count() }}
        </div>
    </div>

    <!-- Tabela de Reservas -->
    <table>
        <thead>
            <tr>
                <th width="5%">Id</th>              <!-- 5% -->
                <th width="16%">Cliente</th>        <!-- 16% -->
                <th width="11%">Carro</th>          <!-- 11% -->
                <th width="11%">Modelo</th>         <!-- 11% -->
                <th width="10%">Matricula</th>      <!-- 10% -->
                <th width="10%">Estado</th>         <!-- 10% -->
                <th width="11%">Data Retirada</th>  <!-- 11% -->
                <th width="11%">Data Devolução</th> <!-- 11% -->
                <th width="15%" class="amount">Valor Total</th> <!-- 15% para dar espaço ao valor -->
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $reserve)
                <tr>
                    <td>{{ $reserve->id }}</td>
                    <td>{{ $reserve->client->name ?? 'Cliente removido' }}</td>
                    <td>{{ $reserve->car->brand->name ?? '' }}</td>
                    <td>{{ $reserve->car->models->name ?? '' }}</td>
                    <td>{{ $reserve->car->license_plate ?? '' }}</td>
                    <td>
                        <strong>
                            @switch($reserve->status)
                                @case('completed')   Concluída    @break
                                @case('in_progress') Em Andamento @break
                                @case('cancelled')   Cancelada    @break
                                @default                     {{ ucfirst($reserve->status) }}
                            @endswitch
                        </strong>
                    </td>
                    <td>{{ $reserve->start_date ? \Carbon\Carbon::parse($reserve->start_date)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $reserve->end_date ? \Carbon\Carbon::parse($reserve->end_date)->format('d/m/Y') : '-' }}</td>
                    <td class="amount" style="font-weight: bold;">
                        {{ number_format($reserve->total_amount, 2, ',', '.') }} KZ
                    </td>
                </tr>
            @empty
                <!-- <tr>
                    <td colspan="9" style="text-align:center; padding: 30px; color: #999;">
                        Nenhuma reserva encontrada para o período selecionado.
                    </td>
                </tr> -->
            @endforelse

            @if($reports->count() > 0)
                <tr class="total-row">
                    <td colspan="8">
                        <strong>TOTAL GERAL</strong>
                    </td>
                    <td class="amount">
                        <strong>(AOA) {{ number_format($reports->sum('total_amount'), 2, ',', '.') }} KZ</strong>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Rodapé fixo -->
    <div class="footer">
        © {{ date('Y') }} AngoCars - Todos os direitos reservados<br>
        Relatório gerado automaticamente pelo sistema Rent-Car
        | suporte@angocars.com | +244 930 000 000
    </div>

</body>
</html>