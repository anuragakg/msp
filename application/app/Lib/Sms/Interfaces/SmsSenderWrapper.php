<?php

namespace App\Lib\Sms\Interfaces;

interface SmsSenderWrapper
{
    public function send($phone, $message);
}
