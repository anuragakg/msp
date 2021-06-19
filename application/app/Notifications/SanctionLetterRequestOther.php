<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * 
 * Sanction letter request notification
 * 
 * Triggers when the proposal is finally approved at the top level.
 * 
 * Sent To : Users having generate sanction letter permissions.
 *  
 * @package App\Notifications
 */
class SanctionLetterRequestOther extends Notification implements ShouldQueue
{
    use Queueable;

    public $from;
    public $pendingVdvks;
    public $vdvk;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $pendingVdvks,$vdvk)
    {
        $this->from = $from;
        $this->pendingVdvks = $pendingVdvks;
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
            ->subject('Request for generating sanction letter.')
            ->line('Dear Sir/Madam')
            ->greeting('Greetings !!')
            ->line(
                sprintf(
                    'VDVK Proposal request have been approved by Approving Authority requested to Generate Sanction for the same. ',
                    $this->pendingVdvks
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
        $location = $this->vdvk->getProposedLocation;
        $this->action .= "fund-management/screen2.php?state=".$location->state;
        return [
            'message' => sprintf(
                'New Proposal request approved by Approving Authority Kindly take action.',
                $this->pendingVdvks
            ),
            'action' => $this->action
        ];
    }
}
