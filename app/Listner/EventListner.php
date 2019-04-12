<?php

namespace App\Listner;

use App\Events\Add\Events\event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListner
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
     * @param  event  $event
     * @return void
     */
    public function handle(event $event)
    {
        //
    }
}
