<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Twilio\Rest\Client;
class SendTrackingNumberSMS
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        $customerPhone = $order->mobile;
        $trackingNumber = $order->tracking_number;

        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $message = $twilio->messages->create(
            $customerPhone,
            array(
                'from' => config('services.twilio.from'),
                'body' => 'Your tracking number is: ' . $trackingNumber
            )
        );
    }
    
}
