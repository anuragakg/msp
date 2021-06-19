<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;
/**
 * Proposal Approved
 * 
 * This Notification is called when VDVK Proposal Approved
 * 
 * Notification Called:
 * 1. Database
 * 2. Mail
 */
class InfrastructureReject extends Notification implements ShouldQueue
{
    use Queueable;
    public $procurement;
    public $from;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($procurement,$from)
    {
        $this->procurement = $procurement;
        $this->from = $from;
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
        $year_id=$this->procurement->getProposedFinancialYear->title;
        $proposal_id=$this->procurement->proposal_id;
        
            return (new MailMessage)
            ->subject('Infrastructure Development Proposal Rejected ')
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Infrastructure Development for '.$year_id.' with proposal id '.$proposal_id.' has been Rejected by '.$this->from->name)
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
        $this->action .= "modification-infrastructure/view-infrastructure.php?id=".$this->procurement->ref_id;
        $year_id=$this->procurement->getProposedFinancialYear->title;
        $proposal_id=$this->procurement->proposal_id;
        return [
            'message' => 'Infrastructure Development for '.$year_id.' with proposal id '.$proposal_id.' has been Rejected by '.$this->from->name,
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
        $year_id=$this->procurement->getProposedFinancialYear->title;
        $proposal_id=$this->procurement->proposal_id;

        return sprintf(
            'Dear Sir/Madam, Infrastructure Development for '.$year_id.' with proposal id '.$proposal_id.' has been Rejected by '.$this->from->name.'.Please verify.'
        );
    }
}
