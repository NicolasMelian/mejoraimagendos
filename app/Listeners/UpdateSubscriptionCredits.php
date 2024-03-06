<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionUpdated;
use App\Models\User;

class UpdateSubscriptionCredits
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionUpdated $event): void
    {
        $user = $event->billable;
        $credits;

        // Asignar créditos basados en el price_id
        if ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr') {
            $credits = 1000; // Plan mensual
        } elseif ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h3cqg5fervw0zr2zehk0b') {
            $credits = 12000; // Plan anual
        }

            $user->credits += $credits; // Suponiendo que quieres añadir créditos, no establecer un nuevo total
            $user->save();
        
    }
}
