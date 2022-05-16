<?php

namespace App\Listeners;

use App\Events\ProductCreatedEvent;
use App\Mail\NotifyProductCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ProductCreatedListner implements ShouldQueue
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
     * @param  \App\Events\ProductCreatedEvent  $event
     * @return void
     */
    public function handle(ProductCreatedEvent $event)
    {
        Mail::to('admin@gmail.com')->send(new NotifyProductCreatedMail($event->product));

    }
}
