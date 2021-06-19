<?php

namespace App\Channels;

use App\Lib\Sms\SmsSender;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        $smsSender = new SmsSender;

        if ($notifiable->mobile_no) {
            return $smsSender->send($notifiable->mobile_no, $message);
        }
    }
}
