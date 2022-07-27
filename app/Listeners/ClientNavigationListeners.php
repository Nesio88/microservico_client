<?php

namespace App\Listeners;

use App\Events\ClientNavigationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClientNavigationListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClientNavigationEvent  $event
     * @return void
     */
    public function handle(ClientNavigationEvent $event)
    {
        $event->client->count_access++;
        $event->client->save();
    }
}
