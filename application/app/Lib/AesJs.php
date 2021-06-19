<?php
namespace App\Lib;
class AesJs
{
    /**vector
     * @var string
     */
    const IV = "1234567890123412";//16 bits

    /**
     * Decrypted string
     * @param string $data Character string
     * @param string $key Encrypted key
     * @return string
     */
    public static function decryptWithOpenssl($data,$key,$iv = self::IV){
        return openssl_decrypt(base64_decode($data),"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv);
    }

    /**
     * Encrypted string
     * @param string $data Character string
     * @param string $key Encrypted key
     * @return string
     */
    public static function encryptWithOpenssl($data,$key,$iv = self::IV){
        return base64_encode(openssl_encrypt($data,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv));
    }

}
