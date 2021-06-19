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
class MfpProcurementConsolidationAssignNextLevel extends Notification implements ShouldQueue
{
    use Queueable;
    public $consolidation;
    public $from;
    public $action;
    public $reference_number;
    public $year_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($consolidation,$from)
    {
        $this->consolidation = $consolidation;
        $this->from = $from;
        $this->reference_number=$consolidation->reference_number;
        $this->year_id=$consolidation->getProposedFinancialYear->title;
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
        
        
            return (new MailMessage)
            ->subject('MFP Procurement Consolidation ID '.$this->reference_number.' Assigned ' )
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Consolidation for year '.$this->year_id.' with consolidation id '.$this->reference_number.' has been assigned by '.$this->from->name)
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
        $this->action .= "proposal-verification/mfp-procurement-verification.php?tab=4";
        
        return [
            'message' => 'Consolidation for year '.$this->year_id.' with consolidation id '.$this->reference_number.' has been assigned by '.$this->from->name,
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
            'Dear Sir/Madam, Consolidation for year '.$this->year_id.' with consolidation id '.$this->reference_number.' has been assigned by '.$this->from->name
        );
    }
}
