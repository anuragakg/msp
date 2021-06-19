<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Fund Released By Sio/Dio
 * 
 * This Notification is called when fund released to MO by DIO/SIO
 * 
 * Notification Called:
 * 1. Database
 */

class FundReleasedBySioDio extends Notification implements ShouldQueue
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
        $this->action .= "fund-utilization/screen1.php";
        return [
            'message' => 'Requested to submit utilization doucment',
            'action' => $this->action
        ];
    }
}
