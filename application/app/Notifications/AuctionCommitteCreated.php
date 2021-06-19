<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Fund Released By Any User
 * 
 * This Notification is called when fund released/distributed any any stage to below next level
 * 
 * Notification Called:
 * 1. Database
 */

class AuctionCommitteCreated extends Notification implements ShouldQueue
{
    use Queueable;
    public $auction_id;
    public $auction_title;
    public $auction_date;
    public $venue;
    public $hour;
    public $minute;
    public $from;
    public $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auction_id,$auction_title,$auction_date,$venue,$hour,$minute,$from)
    {
        $this->from = $from;
        $this->auction_id = $auction_id;
        $this->auction_title = $auction_title;
        $this->auction_date = $auction_date;
        $this->venue = $venue;
        $this->hour = $hour;
        $this->minute = $minute;
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
        //$location = $this->vdvk->getProposedLocation;
        return (new MailMessage)
            ->subject('Auction Committe Created for venue '.ucfirst($this->venue))
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('You have been added in Auction Committe for venue '.ucfirst($this->venue))
            ->line('Date : '.$this->auction_date)
            ->line('Time : '.$this->hour.':'.$this->minute)
            ->line('venue : '.$this->venue)
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
        $this->action .= "auction/view-auction-committe-details.php?id=".$this->auction_id;
        return [
            'message' => sprintf(
                'Auction Committe Created for venue : %s',
                ucfirst($this->venue),
                now()->format('d/m/Y')
            ),
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
            'Auction Committe Created for venue '.ucfirst($this->venue).' for data '.$this->auction_date
        );
    }
}
