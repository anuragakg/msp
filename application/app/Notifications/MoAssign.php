<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Proposal Reverted
 * 
 * This Notification is called when VDVK Proposal Reverted
 * 
 * Notification Called:
 * 1. Database
 * 2. Mail
 */
class MoAssign extends Notification implements ShouldQueue
{
    use Queueable;
    public $type;
    public $mo_name;
    public $action;
    public $user_type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type,$mo_name)
    {
        $this->type = $type;
        $this->mo_name = $mo_name;
        $this->action = env('REQUEST_URL');
        if($this->type == 1)
        {
            $this->user_type = "Inspection";
        }
        if($this->type == 2)
        {
            $this->user_type = "Evaluation";
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
            ->subject('You have been empanlled for '.$this->user_type)
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('You have been empanlled for '.$this->user_type.' of Mentionring Organisation for '.$this->mo_name.'.')
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
        $this->action .= "project-proposal/proposal-detail-view.php";
        return [
            'message' => 'You have been empanelled for '.$this->user_type,
            'action' => $this->action
        ];
    }
}
