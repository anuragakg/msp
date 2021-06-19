<?php

namespace App\Notifications\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Survey Form Verify
 * 
 * This Notification is called when Supervisor Verify The Survey Form
 * 
 * Notification Called:
 * 1. Mail
 */

class SurveyFormVerify extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $form_name;
    public $status_type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from,$form_name,$status)
    {
        $this->from = $from;
        $this->form_name = $form_name;
        if($status == 0)
        {
            $this->status_type = "Pending";
        }
        if($status == 1)
        {
            $this->status_type = "Approved";
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
        return ['mail'];
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
            ->subject('Status Update of '.$this->form_name.' Survey by Supervisor')
            ->line('Dear Sir/Madam,')
            ->line('Greetings,')
            ->line('This is to inform that supervisor ('.$this->from->name.') have update status of '.$this->form_name.'  Survey in '.$this->status_type.'.')
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
        return [
            'message' => 'New User Created',
            'action' => $this->user->id
        ];
    }
}
