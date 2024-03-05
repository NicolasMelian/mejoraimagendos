<?php
namespace App\Listeners;

use Laravel\Paddle\Events\SubscriptionCreated;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UpdateSubscriptionCredits
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreated $event): void
    {
        // Acceso al price_id del payload del evento
        $priceId = $event->payload['data']['items'][0]['price']['id'];

        // Acceso al usuario billable (asegúrate de que este acceso sea correcto según tu implementación)
        $user = $event->billable;

        // Verifica que el usuario exista
        if (!$user) {
            Log::error("Usuario no encontrado en el evento SubscriptionCreated.");
            return;
        }

        // log al price_id
        Log::info("price_id: {$priceId}");

        // Asigna créditos basado en el price_id
        switch ($priceId) {
            case 'pri_01ha2h3cqg5fervw0zr2zehk0b': // ID para el plan anual
                $user->credits += 10000; // Asigna 10000 créditos para el plan anual
                break;
            case 'pri_01ha2h29b39sgwd9rj5ebwn7jr': // ID para el plan mensual
                $user->credits += 1000; // Asigna 1000 créditos para el plan mensual
                break;
            default:
                Log::info("Plan no reconocido con price_id: {$priceId}");
                return;
        }

        // Guarda los cambios en el usuario
        $user->save();
        
        Log::info("Créditos actualizados para el usuario: {$user->id}, nuevo saldo de créditos: {$user->credits}");
    }
}
