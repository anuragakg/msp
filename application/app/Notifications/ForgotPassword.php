<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPassword extends Notification
{
    use Queueable;

    public $_channels = [];
    public $_options = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($channels = [], $_options = [])
    {
        $this->_channels = $channels;
        $this->_options = $_options;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return count($this->_channels)
            ? $this->_channels
            : ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = env('REQUEST_URL') . 'auth/reset-password.php?token=' . $this->_options['token'];
        return (new MailMessage)
            ->subject('Reset Password,VDY (TRIFED)')
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings!!,')
            ->line('You have requested to reset your password. Please click on  below link to reset your password.')
            ->action('Reset Password', $url)
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
        $otp=$this->_options['otp'];
        $url = env('REQUEST_URL') . 'auth/reset-password.php?token=' . $this->_options['otp'];
        return sprintf(
            'Dear, Student OTP for Registration is '.$otp.'.'
        );
    }
}
