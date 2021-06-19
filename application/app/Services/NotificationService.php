<?php

namespace App\Services;

use Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use DB;
use \App\Mail\GenericMail;
use App\Models\EmailTemplate;
use Carbon\Carbon;

class NotificationService extends ApiController
{
    public $action;

    public function __construct()
    {
        $this->action = new \stdClass();
    }

    
    //...........Call this function for send emails..............//
    public function sendDbTemplateMail($mailable, $request = null)
    {
        $mail = $this->selectMail($mailable, $request);
        if ($mail) {
            $mail = Mail::to($mail)
            ->bcc(['test@trifed.com'])
            ->send($this->genericMailable($mailable, $request));
        }
    }

    public function genericMailable($mailable, $request = null)
    {
        $email_template = EmailTemplate::where('type', $mailable)->first();
        return new GenericMail($email_template->description, $mailable, $request, $email_template->subject);
    }

    public function selectMail($type, $data)
    {
        if ($type == 'Trifed-Demo') {
            $mailId = $data->email;
        } 

        return $mailId;
    }

    // call this function for send sms
    public function sendSms($type, $request, $data = [])
    {
        $now = Carbon::now();
        $date = $now->format('d/m/Y');
        $time = $now->format('H:i:s');
        $url = null;

        $YourAPIKey = 'xxxxxxxxx';

        switch ($type) {
            case 'Trifed-Demo':
                //details for sms
                $name = rawurlencode($data->name);
                //$url with details
            break;
        }
        $this->finallySendSms($url);
    }

    public function finallySendSms($url)
    {
        \Log::info($url);
        if (env('APP_ENV') == 'production') {
            $ch = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, $url);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $status = \curl_exec($ch);
            \curl_close($ch);
            return $status;
        }

        return true;
    }
}
