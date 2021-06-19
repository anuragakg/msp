<?php

namespace App\Notifications\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Survey Form Complete
 * 
 * This Notification is called when Surveyor is Submit Any Survey From (Haat Bazaar, Warehouse, SHG Gatherer)
 * 
 * Notification Called:
 * 1. Mail
 */

class SurveyFormComplete extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $form_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from,$form_name)
    {
        $this->from = $from;
        $this->form_name = $form_name;
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
            ->subject('Survey of '.$this->form_name.' by Surveyor ('.$this->from->name.')')
            ->line('Dear Sir/Madam,')
            ->line('Greetings,')
            ->line('Surveyor '.$this->from->name.' have completed the survey of '.$this->form_name.'. Requested to kindly verify the same.')
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
            'action' => $this->from->id
        ];
    }
}
