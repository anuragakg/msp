<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    public $_channels = [];
    public $_options = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->_channels = $channels;
        //$this->_options = $_options;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        //$url = env('REQUEST_URL') . 'auth/reset-password.php?token=' . $this->_options['token'];
        return (new MailMessage)
            ->subject('Reset Password,VDY (TRIFED)')
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings!!,')
            ->line('Your password has been updated successfully.Please check and login')
            //->action('Reset Password', $url)
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
        return [
            //
        ];
    }

    /**
     * Sends notification through sms channel.
     * @param mixed $notifiable 
     * @return string 
     */
    public function toSms($notifiable)
    {
        //$otp=$this->_options['otp'];
        //$url = env('REQUEST_URL') . 'auth/reset-password.php?token=' . $this->_options['otp'];
        return sprintf(
            'Your password has been updated successfully.Please check and login.'
        );
    }
}
