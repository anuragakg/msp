<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * VDVK Submission
 * 
 * This Notification is called when MO is Submit The Proposal Form
 * 
 * Notification Called:
 * 1. Database
 * 2. Mail
 */
class MfpProcurementDiaReleased extends Notification implements ShouldQueue
{
    use Queueable;
    public $proposal_id;
    public $procurement;
    public $from;
    public $release_amount;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($procurement,$from,$release_amount)
    {
        $this->proposal_id=$procurement->proposal_id;
        $this->procurement = $procurement;
        $this->from = $from;
        $this->release_amount = $release_amount;
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
        //return ['database','mail', SmsChannel::class];
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
        $proposal_id=$this->proposal_id;
        return (new MailMessage)
            ->subject('MFP Procurement fund released for proposal id '.$proposal_id)
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('MFP Procurement fund released for proposal id '.$proposal_id.' of Rs. '.$this->release_amount.' done by '.$this->from->name)
            ->line('Thanks & Regards')
            ->line('MSP for MFP Admin');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $proposal_id=$this->proposal_id;
        $this->action .= "fund-management/mfp_procurement_release_fund_agent.php";
        
        return [
            'message' => 'MFP Procurement fund released for proposal id '.$proposal_id.' of Rs. '.$this->release_amount.' done by '.$this->from->name,
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
        $proposal_id=$this->proposal_id;
        
        return sprintf(
            'Dear Sir/Madam, MFP Procurement fund released for proposal id  '.$proposal_id.' of Rs. '.$this->release_amount.' done by '.$this->from->name.'.'
        );
    }
}
