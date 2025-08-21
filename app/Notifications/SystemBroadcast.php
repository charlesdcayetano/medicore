<?php
namespace App\Notifications;
use App\Enums\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class SystemBroadcast extends Notification
{
    use Queueable;

    public function __construct(
        public string $title,
        public string $message,
        public string $priority = 'normal',
        public ?string $link = null
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    protected function payload(): array
    {
        return [
            'type' => NotificationType::System,
            'priority' => $this->priority,
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
        ];
    }

    public function toDatabase($notifiable): array
    {
        return $this->payload();
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->payload());
    }
}