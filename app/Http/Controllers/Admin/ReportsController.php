<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Model\Reserve;

class ReportsController extends Controller
{
    public function reportsgeneral()
    {
        return view('_admin.reportsgeneral.index');
    }

    public function reserves(Request $request)
{
    $request->validate([
        'report_type' => 'required|in:all,completed,cancelled,in_progress',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
    ]);

    $tipo      = $request->report_type;
    $startDate = $request->start_date;
    $endDate   = $request->end_date;

    // Query base
    $query = Reserve::query();

    // FILTRAR POR PERÍODO DE DATAS (inclui o último dia inteiro)
    $query->whereDate('start_date', '>=', $startDate)
          ->whereDate('start_date', '<=', $endDate);

// Aplicar filtro por status
switch ($tipo) {
    case 'all':
        $titulo = "Relatório de Todas as Reservas";
        break;

    case 'completed':
        $query->where('status', 'completed');
        $titulo = "Relatório de Reservas Concluídas";
        break;

    case 'cancelled':
        $query->where('status', 'cancelled');
        $titulo = "Relatório de Reservas Canceladas";
        break;

    case 'in_progress':
        $query->where('status', 'in_progress');
        $titulo = "Relatório de Reservas Em Progresso";
        break;
}

    $query->orderByDesc('id');
    $reports = $query->get();

    // Título com período
    $periodo = \Carbon\Carbon::parse($startDate)->format('d/m/Y') . ' até ' . \Carbon\Carbon::parse($endDate)->format('d/m/Y');
    $titulo .= " - Período: {$periodo}";

    $response = [
        'reports' => $reports,
        'titulo'  => $titulo,
        'tipo'    => $tipo
    ];

    ini_set('max_execution_time', 300); // corrigido o nome da variável

    $pdf = Pdf::loadView('_admin.reportsgeneral.pdf.reserves', $response)
              ->setPaper('a4', 'portrait'); // corrigi aqui também (tinha "a4  a3")

    $filename = "relatorio_reservas_{$tipo}_" . date('d-m-Y') . ".pdf";

    return $pdf->download($filename);
}
}