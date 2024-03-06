<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionUpdated;
use App\Models\User;

class UpdateSubscriptionCredits implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(SubscriptionUpdated $event): void
    {
        $user = $event->billable;
        $credits;

        // Verificar si hay un cambio programado y si es una cancelación
        if (isset($event->payload['data']['scheduled_change']) && $event->payload['data']['scheduled_change']['action'] == 'cancel') {
            // No hacer nada si la suscripción está programada para ser cancelada
            return;
        }

        // Asignar créditos basados en el price_id
        if ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr') {
            $credits = 1000; // Plan mensual
        } elseif ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h3cqg5fervw0zr2zehk0b') {
            $credits = 12000; // Plan anual
        }

        // Solo actualizar si se asignaron créditos
        if ($credits > 0) {
            $user->credits += $credits; // Suponiendo que quieres añadir créditos, no establecer un nuevo total
            $user->save();
        }
    }
}
