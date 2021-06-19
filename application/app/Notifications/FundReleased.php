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

class FundReleased extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $vdvk;
    public $amount;
    public $no_of_vdvk;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from,$vdvk,$amount,$no_of_vdvk)
    {
        $this->from = $from;
        $this->vdvk = $vdvk;
        $this->amount = $amount;
        $this->no_of_vdvk = $no_of_vdvk;
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
        $location = $this->vdvk->getProposedLocation;
        return (new MailMessage)
            ->subject('Funds Released ('.$location->kendra_name.')')
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Funds of Rs. '.$this->amount.' for '.$this->no_of_vdvk.' VDVKs has been released successfully. Please login and take action accordingly.')
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
        $this->action .= "fund-distribution/screen2.php?id=".$this->vdvk->user_id;
        return [
            'message' => sprintf(
                'Fund Released by %s dated : %s',
                $this->from->name,
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
