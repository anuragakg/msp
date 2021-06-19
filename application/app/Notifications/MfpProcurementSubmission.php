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
class MfpProcurementSubmission extends Notification implements ShouldQueue
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
        $year_id=$this->procurement->getProposedFinancialYear->title;
        $proposal_id=$this->procurement->proposal_id;
        return (new MailMessage)
            ->subject('MFP Procurement Submitted successfully for financial year '.$year_id)
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('MFP Procurement for '.$year_id.' with proposal id '.$proposal_id.' has been submitted by District Implementing Agency ('.$this->from->name.')')
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
        $this->action .= "project-proposal/view-mfp-procurement.php?id=".$this->procurement->ref_id;
        $proposal_id=$this->procurement->proposal_id;
        return [
            'message' => 'You have received MFP procurement request with proposal id '.$proposal_id.' for verification.',
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
        $proposal_id=$this->procurement->proposal_id;
        $year_id=$this->procurement->getProposedFinancialYear->title;
        return sprintf(
            'Dear Sir/Madam, MFP Procurement for '.$year_id.' with proposal id '.$proposal_id.' has been submitted by District Implementing Agency ('.$this->from->name.').'
        );
    }
}
