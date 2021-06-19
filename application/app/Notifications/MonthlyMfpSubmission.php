<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * 
 * Monthly MFP Submission Notification
 * 
 * Triggers when the MO submit the mfp submission form.
 * 
 * Sent To : DIO, SIO, MO, TRIFED Based on the proposal approval.
 *  
 * @package App\Notifications
 */
class MonthlyMfpSubmission extends Notification implements ShouldQueue
{
    use Queueable;

    public $from;
    public $vdvk;
    public $data;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $vdvk, $data)
    {
        $this->from = $from;
        $this->vdvk = $vdvk;
        $this->data = $data;
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

        $now = now();
        $location = $this->vdvk->getProposedLocation;

        return (new MailMessage)
            ->subject('VDY : Submission of MFP Details')
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings !!')
            ->line(
                sprintf(
                    'MFP/Production Details for (fortnightly period of Month %s, %s)  has been submitted by Mentoring Organization',
                    $this->data['month'],
                    $this->data['year']
                )
            )
            ->line(
                sprintf(
                    'for VDVK %s on %s',
                    $location->kendra_name,
                    now()
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
        $now = now();
        $this->action .= "monthly-mfp/monthly-mfp-by-vdvk.php?id=".$this->vdvk->id;
        return [
            'message' => sprintf(
                'MFP details for the month of %s and %s has been submitted by Mentoring Organization',
                $this->data['month'],
                $this->data['year']
            ),
            'action' => $this->action
        ];
    }
}
