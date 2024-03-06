<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\SubscriptionCanceled;
use App\Models\User;

class DeleteCredits
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionCanceled $event): void
    {
        $user = $event->billable;

        $user->credits = 0;

        $user->save();
    }
}
