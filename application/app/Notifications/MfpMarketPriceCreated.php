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

class MfpMarketPriceCreated extends Notification implements ShouldQueue
{
    use Queueable;
    
    public $logs;
    public $from;
    public $mfp_name;
    public $haat_master_name;
    public $action;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($logs,$from)
    {
        $this->logs = $logs;
        $this->from = $from;

        $this->mfp_name=isset($logs->getMfpData->getMfpName->title)?$logs->getMfpData->getMfpName->title:'';
        $this->haat_master_name=isset($logs->getHaat->getHaatBazaarDetail->getPartOne->rpm_name)?$logs->getHaat->getHaatBazaarDetail->getPartOne->rpm_name:null;

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
        $mfp_name=$this->mfp_name;
        $haat_master_name=$this->haat_master_name;
        $market_price=$this->logs->market_price;
        
        return (new MailMessage)
            ->subject('Msp Market price update for '.ucfirst($mfp_name))
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line('Price updated for mfp '.ucfirst($mfp_name).' . Please check and approve')
            ->line('Haat Bazaar Name : '.$haat_master_name)
            ->line('Mfp Name : '.$mfp_name)
            ->line('MFP Market Price : '.$market_price)
            ->line('Thanks & Regards')
            ->line('MSP for MFP');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $mfp_name=$this->mfp_name;
        $haat_master_name=$this->haat_master_name;

        $this->action .= "msp_market_price/msp_market_price_approval_listing.php";
        return [
            'message' => 'Msp Market price update for '.ucfirst($mfp_name),
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
        $mfp_name=$this->mfp_name;
        $haat_master_name=$this->haat_master_name;

        return sprintf(
            'Msp Market price update for '.ucfirst($mfp_name).'.Please check and approve that.'
        );
    }
}
