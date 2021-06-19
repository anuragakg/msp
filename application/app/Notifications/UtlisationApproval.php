<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * 
 * Utilisation Approval Notification
 * 
 * Triggers when the DIO/SIO approves the utilisation submitted by MO.
 * 
 * Sent To : DIO, SIO, MO, TRIFED Based on the proposal approval.
 *  
 * @package App\Notifications
 */
class UtlisationApproval extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $vdvk;
    public $status;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from,$vdvk,$status)
    {
        $this->from = $from;
        $this->vdvk = $vdvk;
        $this->status = $status;
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
        return ['database', 'mail'];
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
            ->subject('VDY : '.$this->status.' of Utilisation Document.')
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings !!')
            ->line(
                sprintf(
                    'Utilisation document has been %s by DIO/SIO %s with remarks.',
                     $this->status,$this->from->name
                )
            )
            ->line('Please login and take action accordingly.')
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
        $this->action .= "fund-utilization/screen3-listing.php?id=".$this->vdvk->id;
        return [
            'message' => sprintf(
                'Utilisation document has been %s by DIO/SIO %s with remarks.',
                $this->status,$this->from->name
            ),
            'action' => $this->action
        ];
    }
}
