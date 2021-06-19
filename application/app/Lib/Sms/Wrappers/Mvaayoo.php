<?php

namespace App\Lib\Sms\Wrappers;

use App\Lib\Sms\Interfaces\SmsSenderWrapper;

class Mvaayoo implements SmsSenderWrapper
{
    public function send($phone, $message)
    { 
		/*$curl="curl -k 'https://smsgw.sms.gov.in/failsafe/HttpLink?username=trifed.sms&pin=B8%26qU7%40yN6&message='".urlencode($message)."'&mnumber='".urlencode($phone)."'&signature=TRIFED'";	
		exec($curl);*/ 
		$SLBS_USERNAME='lbssms';
		$SLBS_PASSWORD='Lbs@1234';
		$SLBS_SENDER_ID='SMSHUB';
        $message = urlencode($message);
		$mobile = "91" . $phone;
        $cSession = curl_init();
        curl_setopt($cSession, CURLOPT_URL, "http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=" . $SLBS_USERNAME . "&password=" . $SLBS_PASSWORD . "&msisdn=" . $mobile . "&sid=" . $SLBS_SENDER_ID . "&msg=" . $message . "&fl=0&gwid=2");

        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_HEADER, false);
        $result = curl_exec($cSession);
        curl_close($cSession);
        //$response = json_decode($result);
        //print_r($response); die();
        //return $response->ErrorMessage;
        
    }
}
