<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spark\Events\SubscriptionUpdated;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class UpdateSubscriptionCredits
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubscriptionUpdated $event): void
    {
        \Log::info(print_r($event, true));


        $user = $event->user;
        $plan = $event->plan;

        if ($plan->monthly_id) {
            // Lógica para plan mensual, por ejemplo, reajustar a 1000 créditos
            $user->credits = 1000;
        } elseif ($plan->yearly_id) {
            // Lógica para plan anual, por ejemplo, ajustar a 12000 créditos
            $user->credits = 12000;
        }

        $user->save();
    }
}
