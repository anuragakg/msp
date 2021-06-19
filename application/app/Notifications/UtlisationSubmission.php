<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Utlisation Submission
 * 
 * This Notification is called when utilization details submitted by Mentoring Organisation
 * 
 * Notification Called:
 * 1. Database
 */
class UtlisationSubmission extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $vdvk;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from,$vdvk)
    {
        $this->from = $from;
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
            ->subject('Utilisation document Submission by Mentoring Organization')
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings !!')
            ->line(
                sprintf(
                    'Utilisation document has been submitted by Mentoring Organization %s.',
                    $this->from->name
                )
            )
            ->line('Please login and take action accordingly.')
            ->line('Thanks & Regards')
            ->line('VDY (TRIFED) Team');
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
                'Utlization certificate submitted by Mentoring Organization %s',
                $this->from->name
            ),
            'action' => $this->action
        ];
    }
}
