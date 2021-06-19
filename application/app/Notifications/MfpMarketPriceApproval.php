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

class MfpMarketPriceApproval extends Notification implements ShouldQueue
{
    use Queueable;
    
    public $logs;
    public $from;
    public $mfp_name;
    public $haat_master_name;
    public $action;
    public $status_text;
    public $message;
    

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

        switch ($logs->status) {
            case '1':
                $status_text='Approved';
                break;
            case '2':
                $status_text='Reverted';
                break;
            case '3':
                $status_text='Rejected';
                break;
            
            default:
                $status_text='Pending';
                break;
        }

        $this->status_text = $status_text;
        $mfp_name=$this->mfp_name;
        $haat_master_name=$this->haat_master_name;
        $market_price=$logs->market_price;
        $this->message="DIA has been $status_text for MFP $mfp_name under haat bazaar $haat_master_name of market price $market_price";
        
        
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
        $remarks=$this->logs->remarks;

        

        return (new MailMessage)
            ->subject('Msp Market price status updated for '.ucfirst($mfp_name))
            ->line('Dear Sir/Madam,')
            ->line('Greetings!!,')
            ->line($this->message)
            ->line('Haat Bazaar Name : '.$haat_master_name)
            ->line('Mfp Name : '.$mfp_name)
            ->line('MFP Market Price : '.$market_price)
            ->line('Remarks : '.$remarks)
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
        if($this->logs->status==1)
        {
            $this->action .= "msp_market_price/msp_market_price_approved_listing.php";    
        }else{
            $this->action .= "msp_market_price/msp_market_price_listing.php";
        }
        
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
            'Msp Market price update for '.ucfirst($mfp_name).'.Please check .'
        );
    }
}
