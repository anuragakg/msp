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
class InfrastructureDevelopmentSubmission extends Notification implements ShouldQueue
{
    use Queueable;
    public $infra;
    public $from;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($infra,$from)
    {
        $this->infra = $infra;
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
        $year_id=$this->infra->getProposedFinancialYear->title;
        $proposal_id=$this->infra->proposal_id;
        return (new MailMessage)
            ->subject('Infrastructure Development Submitted successfully for financial year '.$year_id)
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Infrastructure Development for '.$year_id.' with proposal id '.$proposal_id.' has been submitted by District Implementing Agency ('.$this->from->name.')')
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
        $this->action .= "modification-infrastructure/view-infrastructure.php?id=".$this->infra->ref_id;
        $proposal_id=$this->infra->proposal_id;
        return [
            'message' => 'You have received Infrastructure Development request with proposal id '.$proposal_id.' for verification.',
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
        $proposal_id=$this->infra->proposal_id;
        $year_id=$this->infra->getProposedFinancialYear->title;
        return sprintf(
            'Dear Sir/Madam, Infrastructure Development for '.$year_id.' with proposal id '.$proposal_id.' has been submitted by District Implementing Agency ('.$this->from->name.').'
        );
    }
}
