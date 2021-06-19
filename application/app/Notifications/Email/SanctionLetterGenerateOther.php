<?php

namespace App\Notifications\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Sanction Letter Generate
 * 
 * This Notification is called when Trifed Admin Saction Letter Generate, Mail Sent To SND
 * 
 * Notification Called:
 * 1. Mail
 */

class SanctionLetterGenerateOther extends Notification implements ShouldQueue
{
    use Queueable;
    public $from;
    public $letter;
    public $from_text;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $letter,$from_text)
    {
        $this->from = $from;
        $this->from_text = $from_text;
        $this->letter = $letter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $vdvkCount = $this->letter->getVdvks->count();
        $sanctionedAmount = $this->letter->sanctioned_amount;

        return (new MailMessage)
            ->subject('Funds Sanctioned for VDY')
            ->line('Dear Sir/Madam,')
            ->line('Greetings,')
            ->line(
                sprintf(
                    "Sanction letter for %s VDVKs for Rs %s has been issued to %s. Requested to login to verify the same.",
                    $vdvkCount,
                    $sanctionedAmount,
                    $this->from_text
                )
            )
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
       $vdvkCount = $this->letter->getVdvks->count();
        $sanctionedAmount = $this->letter->sanctioned_amount;

        $this->action .= "fund-management/screen2.php";
        return [
            'message' => sprintf(
                'Sanction letter for %s VDVKs for Rs %s has been issued to %s',
                $vdvkCount,
                $sanctionedAmount,
                $this->from_text

            ),
            'action' => $this->action
        ];
    }
}
