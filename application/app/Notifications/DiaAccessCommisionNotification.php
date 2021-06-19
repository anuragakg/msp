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
class DiaAccessCommisionNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $commision_master;
    public $procurement;
    public $proposal_id;
    public $commission_amount;
    public $from;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($commision_master,$procurement,$from)
    {
        $this->commision_master = $commision_master;
        $this->procurement = $procurement;
        
        $this->proposal_id=$procurement->proposal_id;
        $this->commission_amount=$procurement->commission_amount;
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
        return (new MailMessage)
            ->subject('MFP Procurement commission amount is exceded from max aggregate for proposal id '.$this->proposal_id )
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('MFP Procurement commission amount is exceded from max aggregate .Please find below details')
            ->line('Commission amount : '.$this->commission_amount)
            ->line('Max Aggregate Commission : '.$this->commision_master->max_aggregate_commission)
            ->line('Proposal id : '.$this->proposal_id)
            ->line('User Name : '.$this->from->name)
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
        $this->action .= "fund-management/commission_received_by_dia.php?proposal_id=".$this->procurement->id;
        return [
            'message' => 'MFP Procurement commission amount is exceded from max aggregate for proposal_id '.$this->proposal_id.' .',
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
        return sprintf(
            'MFP Procurement commission amount is exceded from max aggregate for proposal id '.$this->proposal_id.' .'
        );
    }
}
