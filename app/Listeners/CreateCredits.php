<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionCreated;

class CreateCredits
{

    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreated $event): void
    {
        if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $credits = 1000;
        }else{
            $credits = 10000;
        }

        $user = $event->user;

        $user->credits += $credits;
        $user->save();
    }
}
