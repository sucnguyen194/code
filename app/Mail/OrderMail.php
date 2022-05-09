<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), setting('site.name'))
            ->markdown('emails.order')
            ->with([
                'name' => auth()->user()->name ?? $this->order->name,
                'phone' => $this->order->phone,
                'email' => $this->order->email,
                'orders' => json_decode($this->order->content),
                'total' => $this->order->total
            ])
            ->subject('Đơn hàng mới');
    }
}
