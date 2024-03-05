<?php

namespace App\Listeners;

use Laravel\Paddle\Events\SubscriptionUpdated;
use App\Models\User;


class UpdateSubscriptionCredits
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionUpdated $event): void
    {

// Asumiendo que $event->payload ya es un array asociativo como se muestra en tu ejemplo
$priceId = $event->payload['data']['items'][0]['price']['id'];

// Encuentra al usuario basado en el customer_id
$customerId = $event->payload['data']['customer_id'];
$user = User::where('customer_id', $customerId)->first();

if (!$user) {
    Log::error("Usuario no encontrado con customer_id: {$customerId}");
    return;
}

// Asigna créditos basado en el price_id
switch ($priceId) {
    case 'pri_01ha2h3cqg5fervw0zr2zehk0b': // ID para el plan anual
        $user->credits += 10000;
        break;
    case 'pri_01ha2h29b39sgwd9rj5ebwn7jr': // ID para el plan mensual
        $user->credits += 1000;
        break;
    default:
        Log::info("Plan no reconocido con price_id: {$priceId}");
        return;
}

$user->save();
Log::info("Créditos actualizados para el usuario: {$user->id}, nuevo saldo de créditos: {$user->credits}");
    }
}
