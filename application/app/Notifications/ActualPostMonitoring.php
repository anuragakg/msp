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
class ActualPostMonitoring extends Notification implements ShouldQueue
{
    use Queueable;

    public $from;
    public $vdvk;
    public $post_monitoring_id;
    public $location;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vdvk_data, $from,$post_monitoring_id)
    {
        $this->from = $from;
        $this->vdvk = $vdvk_data;
        $this->post_monitoring_id = $post_monitoring_id;
        $this->location = $this->vdvk->getProposedLocation->kendra_name;
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
            ->subject('Post Monitoring Submitted for '.$this->location)
            ->line('Dear Sir/Madam')
            ->greeting('Greetings !!')
            ->line(
                sprintf(
                    'Post Monitoring Submitted by %s for %s . Kindly check',
                    $this->from,$this->location
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
        $this->action .= "project-proposal/actual-proposal-detail-view.php?id=".$this->post_monitoring_id;
        return [
            'message' => sprintf(
                'Post Monitoring Submitted by %s for %s . Kindly check',
                    $this->from,$this->location
            ),
            'action' => $this->action
        ];
    }
}
