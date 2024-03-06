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

        if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $credits = 1000;
        }else if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $credits = 12000;
        } else {
            $credits = 0;
        }

            $user->credits += $credits; // Suponiendo que quieres añadir créditos, no establecer un nuevo total
            $user->save();
        
    }
}
