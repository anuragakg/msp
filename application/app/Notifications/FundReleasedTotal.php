<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Fund Released By Any User
 * 
 * This Notification is called when fund released/distributed any any stage to below next level
 * 
 * Notification Called:
 * 1. Database
 */

class FundReleasedTotal extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
   
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
           
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
        return ['mail','database', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //$location = $this->vdvk->getProposedLocation;
        return (new MailMessage)
            ->subject('Funds has been released Successfully for VDY ')
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line($this->messgae)
            ->line('Thanks & Regards')
            ->line('VDY VDIS Admin');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->action .= "fund-distribution/screen2.php";
        return [
            'message' => sprintf(
                'Fund Released/Distributed by %s dated : %s',
                '',
                now()->format('d/m/Y')
            ),
            'action' => $this->action
        ];
    }

    /**
     * Sends notification through sms channel.
     * @param mixed $notifiable 
     * @return string 
     */
    public function toSms($notifiable)
    {
        return sprintf(
            'Funds for VDY has been released Successfully.'
        );
    }
}
