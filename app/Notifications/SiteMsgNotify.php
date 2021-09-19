<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class SiteMsgNotify extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->time = Carbon::now()->toDateTimeString();
    }
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $time;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'time' => $this->time,
            'content' => $this->content,
        ]);
    }
}
