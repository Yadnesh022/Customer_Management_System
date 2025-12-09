<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via($notifiable)
    {
        return ['mail']; // Add 'database' for dashboard notifications
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order #' . $this->order->order_number)
            ->line('A new order has been placed!')
            ->line('**Order Details:**')
            ->line('Order #: ' . $this->order->order_number)
            ->line('Customer: ' . $this->order->customer->name)
            ->line('Email: ' . $this->order->customer->email)
            ->line('Amount: ₹' . number_format($this->order->amount, 2))
            ->line('Status: ' . ucfirst($this->order->status))
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('Thank you for using  CRM!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'customer_name' => $this->order->customer->name,
            'amount' => $this->order->amount,
        ];
    }
}
