<?php

namespace App\Notifications;

use App\Enums\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LowStockAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $medicineName,
        public int $quantity
    ) {}

    /**
     * Channels where the notification will be sent
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail']; 
    }

    /**
     * Payload for database
     */
    public function toDatabase($notifiable): array
{
    return [
        'type'     => 'medicine_stock',
        'title'    => 'Low Stock Alert',
        'message'  => "The medicine '{$this->medicineName}' is low on stock. Only {$this->quantity} left.",
        'priority' => 'high',
        'link'     => route('medicines.index'),
    ];
}


    /**
     * Payload for broadcast
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }

    /**
     * Payload for email
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('⚠️ Low Stock Alert: ' . $this->medicineName)
            ->line("The medicine **{$this->medicineName}** is running low.")
            ->line("Current stock: {$this->quantity}")
            ->action('View Medicines', route('medicines.index'))
            ->line('Please restock as soon as possible.');
    }
}
