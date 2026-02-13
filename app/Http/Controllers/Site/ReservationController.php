<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Car;
use App\Model\Client;
use App\Model\Driver;
use App\Model\Reserve;
use App\Mail\ConfirmacaoReservaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Model\Card;
use App\Model\CompanyAccount;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // ----------------- Etapa 1 -----------------
    public function step1(Request $request, Car $car)  // ← $car já vem pelo slug!
    {
        // Removido: $car = Car::findOrFail($car_id);  ← não precisa mais!

        Log::info('Carro recebido via slug:', ['slug' => $car->slug, 'id' => $car->id]);

        // Converter datas para formato MySQL
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate   = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        $delivery_time = \Carbon\Carbon::createFromFormat('H:i:s', $request->input('delivery_time'))->format('H:i:s');
        $return_time   = \Carbon\Carbon::createFromFormat('H:i:s', $request->input('return_time'))->format('H:i:s');

        $data = [
            'car_id'            => $car->id,              // continua a guardar o ID na sessão
            'pickup_location' => $request->input('pickup_location'),
            'return_location' => $request->input('return_location'),
            'start_date'      => $startDate,
            'end_date'        => $endDate,
            'delivery_time'   => $delivery_time,
            'return_time'     => $return_time,
        ];

        session([
            'reservation_data' => $data,
            'car_id'           => $car->id,
        ]);

        return redirect()->route('site.reservation.checkout')
            ->with('reservation_stage', 1);
    }

    // ----------------- Etapa 2 -----------------
    public function step2(Request $request, Car $car)  // ← recebe pelo slug, mas usamos o ID da sessão
    {
        $data = session('reservation_data');

        $extrasInput = $request->input('extras', '');
        $extrasArray = $extrasInput !== '' ? explode(',', $extrasInput) : [];

        session([
            'reservation_services' => [
                'extras'    => $extrasArray,
                'driver_id' => $request->input('driver_id'),
            ]
        ]);

        return redirect()->route('site.reservation.checkout')
            ->with('reservation_stage', 2);
    }

    // ----------------- Etapa 3 -----------------
    public function step3(Request $request, Car $car)
    {
        $client = Client::updateOrCreate(
            ['email' => $request->email],
            [
                'name'  => $request->name,
                'phone' => $request->phone,
            ]
        );

        session(['reservation_client' => $client]);

        return $this->confirm($request);
    }

    // ----------------- Confirmação (igualzinho ao teu) -----------------
    public function confirm(Request $request)
    {
        $data = session('reservation_data');
        $dataServices = session('reservation_services');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'remeber' => 'required',
        ]);

        if (!$data || !$dataServices) {
            return redirect()->route('site.reservation.checkout')
                ->with('error', 'Sessão expirada, faça a reserva novamente.')
                ->with('reservation_stage', 1);
        }

        $car = Car::findOrFail($data['car_id']);

        $start = new \Carbon\Carbon($data['start_date']);
        $end   = new \Carbon\Carbon($data['end_date']);
        $days = $end->diffInDays($start) ?: 1;
        $price = $days * $car->price;

        $driver = null;
        if (!empty($dataServices['driver_id'])) {
            $driver = Driver::find($dataServices['driver_id']);
            $price += $driver ? $days * $driver->daily_price : 0;
        }

        if (!empty($dataServices['extras']) && is_array($dataServices['extras'])) {
            foreach ($dataServices['extras'] as $extra) {
                if (!empty($extra)) {
                    $config = config("resources.extras.$extra");
                    $price += $config['price'] ?? 0;
                }
            }
        }

        DB::beginTransaction();
        try {
            $client = Client::updateOrCreate(
                ['email' => $validated['email']],
                ['name' => $validated['name'], 'phone' => $validated['phone']]
            );

            $reserva = Reserve::create([
                'car_id'          => $car->id,
                'client_id'       => $client->id,
                'driver_id'       => $driver ? $driver->id : null,   // compatível PHP 7.4
                'pickup_location' => $data['pickup_location'],
                'return_location' => $data['return_location'],
                'start_date'      => $data['start_date'],
                'end_date'        => $data['end_date'],
                'delivery_time'   => $data['delivery_time'],
                'return_time'     => $data['return_time'],
                'resources'       => !empty($dataServices['extras']) && is_array($dataServices['extras'])
                    ? json_encode(array_filter($dataServices['extras']))
                    : null,
                'total_amount'    => $price,
                'status'          => 'peding',
            ]);

            session(['last_reservation_id' => $reserva->id, 'reservation_stage' => 4]);
            DB::commit();

            /* try {
                Mail::to($client->email)->send(new ConfirmacaoReservaMail($reserva));
            } catch (\Exception $e) {
                Log::error('Erro email: ' . $e->getMessage());
            } */

            session()->forget(['reservation_data', 'reservation_services', 'reservation_client']);

            return redirect()->route('car.confirmed', ['id' => $reserva->id])
                ->with('success', 'Reserva enviada com sucesso! Você receberá um email de confirmação assim que for aprovada pela nossa equipe');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('site.reservation.checkout')
                ->with('error', 'Erro ao criar reserva: ' . $e->getMessage())
                ->with('reservation_stage', 2);
        }
    }

    // ----------------- Checkout (igual ao teu) -----------------
    public function checkout()
    {
        $stage = session('reservation_stage', 1);
        $car = Car::find(session('car_id'));

        if (!$car) {
            return redirect()->route('home')->with('error', 'Carro não encontrado ou sessão expirada.');
        }

        $data = session('reservation_data', []);
        $services = session('reservation_services', []);

        $pickup_location = $data['pickup_location'] ?? '';
        $return_location = $data['return_location'] ?? '';
        $start_date = $data['start_date'] ?? '';
        $end_date = $data['end_date'] ?? '';
        $delivery_time = $data['delivery_time'] ?? '';
        $return_time = $data['return_time'] ?? '';

        $days = 1;
        $price = $car->price;
        if (!empty($data['start_date']) && !empty($data['end_date'])) {
            $start = new \Carbon\Carbon($data['start_date']);
            $end   = new \Carbon\Carbon($data['end_date']);
            $days  = $end->diffInDays($start) ?: 1;
            $price = $days * $car->price;
        }

        $selectedExtras = [];
        $extrasTotal = 0;
        foreach (($services['extras'] ?? []) as $key) {
            $extra = config("resources.extras.$key");
            if ($extra) {
                $selectedExtras[] = $extra;
                $extrasTotal += $extra['price'];
            }
        }

        $selectedDriver = null;
        $driverTotal = 0;
        if (!empty($services['driver_id'])) {
            $selectedDriver = Driver::find($services['driver_id']);
            if ($selectedDriver) {
                $driverTotal = $selectedDriver->daily_price * $days;
            }
        }

        $totalEstimate = $price + $extrasTotal + $driverTotal;
        $client = Auth::guard('client')->user();

        switch ($stage) {
            case 1:
                $drivers = Driver::all();
                return view('site.reservation.book-checkout.index', compact(
                    'car','pickup_location','return_location','start_date','end_date',
                    'delivery_time','return_time','drivers','selectedExtras',
                    'selectedDriver','totalEstimate','client'
                ));
            case 2:
                return view('site.reservation.details-checkout.index', compact(
                    'car','pickup_location','return_location','start_date','end_date',
                    'delivery_time','return_time','selectedExtras','selectedDriver','totalEstimate','client'
                ));
            case 3:
            case 4:
                return redirect()->route('car.confirmed', ['id' => session('last_reservation_id')]);
            default:
                return redirect()->route('home')->with('error', 'Sessão inválida.');
        }
    }

    // ----------------- PDF -----------------
    public function generatePdf($id)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '512M');

        $reservation = Reserve::with(['car', 'client', 'driver'])->findOrFail($id);
        $reservation->decoded_resources = $reservation->resources
            ? json_decode($reservation->resources, true)
            : [];

        $pdf = Pdf::loadView('site.reservation.pdf.index', compact('reservation'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("reserva_{$reservation->id}.pdf");
    }

    public function cancel($id)
    {
    $reserve = Reserve::where('id', $id)
        ->where('client_id', Auth::guard('client')->id())
        ->firstOrFail();

    if (!in_array($reserve->status, ['peding', 'in_progress'])) {
        return back()->with('error', 'Esta reserva não pode ser cancelada.');
    }

    $reserve->status = 'cancelled'; // ou 'cancelled' se usares essa grafia
    $reserve->save();

    return back()->with('success', 'Reserva cancelada com sucesso.');
    }

    public function delete($id)
    {
        $reserve = Reserve::where('id', $id)
            ->where('client_id', Auth::guard('client')->id())
            ->firstOrFail();

        if (!in_array($reserve->status, ['cancelled', 'completed'])) {
            return back()->with('error', 'Esta reserva não pode ser excluída.');
        }

        $reserve->delete();

        return back()->with('success', 'Reserva excluída com sucesso.');
    }
}