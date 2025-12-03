<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(int $orderId)
    {
        $this->order = Order::find($orderId);
    }

    public function build()
    {
        return $this
            ->subject("Order Confirmation Email")
            ->view('emails.order-confirmation')
            ->with('order', $this->order);
    }
}
