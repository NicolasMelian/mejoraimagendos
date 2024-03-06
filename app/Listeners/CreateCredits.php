<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionCreated;
use App\Models\User;

class CreateCredits
{

    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreated $event): void
    {

        $user = $event->user;
        $credits = 0;

        if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $credits = 1000;
        }else{
            $credits = 10000;
        }


        $user->credits += $credits;
        $user->save();
    }
}
