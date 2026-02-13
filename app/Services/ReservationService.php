<?php

namespace App\Services;

use App\Model\Reserve;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReservationService
{
    public function updateExpiredReservations()
    {
        $now = Carbon::now();

        $expired = Reserve::where('end_date', '<', $now)
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($expired as $reserve) {
            $reserve->status = 'completed';
            $reserve->save();

            if ($reserve->car) {
                $reserve->car->available = true;
                $reserve->car->save();
            }

            if ($reserve->driver) {
                $reserve->driver->available = true;
                $reserve->driver->save();
            }
        }

        Log::info('Serviço de atualização de reservas executado com sucesso.', ['reservas_atualizadas' => count($expired)]);

        return count($expired);
    }
}
