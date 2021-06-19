<?php

namespace App\Lib\Sms;

use App\Lib\Sms\Wrappers\Mvaayoo;

class SmsSender
{

    private $sender;

    public function __construct()
    {
        $this->sender = new Mvaayoo;
    }

    /**
     * Send Sms
     * @param string $phone 
     * @param string $message 
     * @return void 
     */
    public function send($phone, $message)
    {
        return $this->sender->send($phone, $message);
    }
}
