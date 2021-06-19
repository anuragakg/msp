<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Inspection Submission
 * 
 * This Notification is called when User Submit The Inspection Form 
 * 
 * Notification Called:
 * 1. Database
 */

class InspectionSubmission extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $vdvk;
    public $action;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$vdvk)
    {
        $this->user = $user;
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
        return ['database'];
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
            ->subject('New User Created : '.$this->user->name.' '.$this->user->last_name.'')
            ->line('The introduction to the notification.')
            ->action('View User', url('/'))
            ->line('Thank you for using our application!');
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
        $this->action .= "inspection-management/add-comments.php?id=".$this->vdvk->id;
        return [
            'message' => 'Inspection report submitted by Inspection user ('.$this->user->name.' '.$this->user->last_name.') for state name '.$location->kendra_name.'',
            'action' => $this->action
        ];
    }
}
