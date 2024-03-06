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

        $user = $event->billable;

        

        if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $credits = 1000;
        }else if($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h3cqg5fervw0zr2zehk0b'){
            $credits = 12000;
        } else {
            $credits = 0;
        }


        $user->credits += $credits;
        $user->save();
    }
}
