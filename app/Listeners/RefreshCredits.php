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
  // Extrayendo el customer_id del payload del evento
  $customerId = $event->payload['data']['customer_id'];

  // Buscando al usuario basado en el customer_id de Paddle
  $user = User::where('paddle_id', $customerId)->first();

  // Asegúrate de que el usuario existe
  if (!$user) {
      // Considera loguear este caso o manejarlo según sea necesario
      return;
  }

  // Ahora, realiza la lógica para actualizar los créditos, como antes
  if ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h29b39sgwd9rj5ebwn7jr') {
      $credits = 1000;
  } else if ($event->payload['data']['items'][0]['price']['id'] == 'pri_01ha2h3cqg5fervw0zr2zehk0b') {
      $credits = 10000;
  } else {
      $credits = 0;
  }

  // Actualizando los créditos del usuario
  $user->credits += $credits;
  $user->save();
}
}