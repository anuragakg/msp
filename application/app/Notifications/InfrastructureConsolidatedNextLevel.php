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
class InfrastructureConsolidatedNextLevel extends Notification implements ShouldQueue
{
    use Queueable;
    public $consolidated;
    public $from;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($consolidated,$from)
    {
        $this->consolidated = $consolidated;
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
        return ['mail','database', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $year_id=$this->consolidated->getProposedFinancialYear->title;
        $state=$this->consolidated->getState->title;
        $reference_number=$this->consolidated->reference_number;
            return (new MailMessage)
            ->subject('Infrastructure consolidated Proposals Recommended for consolidated id '.$reference_number )
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Infrastructure for '.$year_id.' of '.$state.' state with consolidated id '.$reference_number.' has been Recommended by '.$this->from->name)
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
        $this->action .= "proposal-verification/consolidated-infrastructure-verification.php?id=".$this->consolidated->id;
        $year_id=$this->consolidated->getProposedFinancialYear->title;
        $state=$this->consolidated->getState->title;
        $reference_number=$this->consolidated->reference_number;
        return [
            'message' => 'You have received Infrastructure consolidated Proposals of '.$state.' state request with consolidated id '.$reference_number.' for verification.',
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
        $year_id=$this->consolidated->getProposedFinancialYear->title;
        $state=$this->consolidated->getState->title;
        $reference_number=$this->consolidated->reference_number;
        return sprintf(
            'Infrastructure for '.$year_id.' of '.$state.' state with consolidated id '.$reference_number.' has been Recommended by '.$this->from->name.'.Please verify.'
        );
    }
}
