<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Post Monitoring
 * 
 * This Notification is called when initation of Post Monitoring request 
 * 
 * Notification Called:
 * 1. Database
 */
class PostMonitoring extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $vdvk;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$vdvk)
    {
        $this->user = $user;
        $this->vdvk = $vdvk;
        $this->action = env('REQUEST_URL');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New User Created : '.$this->user->name.' '.$this->user->last_name.'')
            ->line('The introduction to the notification.')
            ->action('View User', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->action .= "post-monitoring/screen2.php?id=".$this->vdvk->id;
        return [
            'message' => 'You have received request to submit Post Monitoring details by '.$this->user->name.' '.$this->user->last_name.'',
            'action' => $this->action
        ];
    }
}
