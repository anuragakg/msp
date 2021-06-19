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
class InfrastructureFundReleased extends Notification implements ShouldQueue
{
    use Queueable;
    public $fund_released;
    public $from;
    public $release_amount;
    public $reference_number;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fund_released,$from,$release_amount)
    {
        $this->reference_number=$fund_released->getConsolidatedData->reference_number;
        $this->fund_released = $fund_released;
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
        $reference_number=$this->reference_number;
        return (new MailMessage)
            ->subject('MFP Procurement fund released for consolidated id '.$reference_number)
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('MFP Procurement fund released for consolidated id '.$reference_number.' of Rs. '.$this->release_amount.' done by '.$this->from->name)
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
        $reference_number=$this->reference_number;
        $this->action .= "fund-management/infrastructure_release_fund.php";
        
        return [
            'message' => 'Infrastructure fund released for consolidated id '.$reference_number.' of Rs. '.$this->release_amount.' done by '.$this->from->name,
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
        $reference_number=$this->reference_number;
        
        return sprintf(
            'Dear Sir/Madam, Infrastructure fund released for consolidated id  '.$reference_number.' of Rs. '.$this->release_amount.' done by '.$this->from->name.'.'
        );
    }
}
