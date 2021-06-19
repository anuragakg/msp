<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Proposal Approved
 * 
 * This Notification is called when VDVK Proposal Approved
 * 
 * Notification Called:
 * 1. Database
 * 2. Mail
 */
class ProposalApproved extends Notification implements ShouldQueue
{
    use Queueable;
    public $vdvk;
    public $from;
    public $action;
    public $reference_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vdvk,$from,$reference_id)
    {
        $this->vdvk = $vdvk;
        $this->from = $from;
        $this->reference_id = $reference_id;
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
        return ['database','mail', SmsChannel::class];
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
        $mo = $this->vdvk->users;
        $district = $location->getDistrict;
        return (new MailMessage)
            ->subject('Proposal Recommended Status')
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line("VDVK under VDY for ".$district->title." (".$location->kendra_name.") submitted by Mentoring Organisation (".$mo->name."), reference id ".$this->reference_id." dated ".now()." has been Recommended by ".$this->from.".")
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
        $this->action .= "project-proposal/proposal-detail-view.php?id=".$this->vdvk->id;
        return [
            'message' => 'Proposal received from '.$this->from,
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
        $location = $this->vdvk->getProposedLocation;
        $mo = $this->vdvk->users;
        $district = $location->getDistrict;
        return sprintf(
            'Dear Sir/Madam, Proposal of VDY '.$location->kendra_name.' has been Recommended by Authority Name '.$this->from.'.'
        );
    }
}
