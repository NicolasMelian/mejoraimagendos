<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionUpdated;

class RefreshCredits
{

    /**
     * Handle the event.
     */
    public function handle(SubscriptionUpdated $event): void
    {
        $user = $event->billable;

        $creditsToAdd = 0;

        $price_id = $event->payload['data']['items'][0]['price']['id'];

        if($price_id == 'pri_01ha2h29b39sgwd9rj5ebwn7jr'){
            $creditsToAdd = 1000;
        }else if($price_id == 'pri_01ha2h3cqg5fervw0zr2zehk0b'){
            $creditsToAdd = 12000;
        } else {
            $creditsToAdd = 0;
        }
    
        $user->credits = $creditsToAdd;
        $user->save();


    }
}
