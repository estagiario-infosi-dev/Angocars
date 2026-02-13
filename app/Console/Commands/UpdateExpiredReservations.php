<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Reserve;
use Carbon\Carbon;

class UpdateExpiredReservations extends Command
{
    protected $signature = 'reservations:update-expired';
    protected $description = 'Atualiza reservas expiradas e liberta carros/motoristas';

    public function handle()
    {
        $now = Carbon::now();

        // Atualiza reservas cujo prazo acabou
        $expired = Reserve::where('end_date', '<', $now)
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($expired as $reserve) {
            $reserve->status = 'completed';
            $reserve->save();

            // Libertar o carro e motorista
            if ($reserve->car) {
                $reserve->car->available = true;
                $reserve->car->save();
            }

            if ($reserve->driver) {
                $reserve->driver->available = true;
                $reserve->driver->save();
            }
        }

        $this->info('Reservas expiradas atualizadas com sucesso!');
    }
}
