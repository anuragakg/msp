<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Fund Distribution
 * 
 * This Notification is called and will notification generated every month
 * after Mentoring Organisation receives funds from VDVK
 * 
 * Notification Called:
 * 1. Database
 */

class FundDistribution extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $this->action .= "monthly-mfp/monthly-mfp-by-vdvk.php?id=".$this->vdvk->id;
        return [
            'message' => 'Kindly submit MFP details for the month of …. (month name will come)',
            'action' => $this->action
        ];
    }
}
