<?php

class CryptAes{
    private $hash;

    function __construct($hash=null){
        $key = md5($hash,TRUE);
        $key .= substr($key,0,8);
        $this->hash = $key;
    }

    /**
     * @param $data
     * @return string
     */

    public function Encrypt($data){
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encData = openssl_encrypt($data, 'aes-256-cbc', $this->hash, 0, $iv);
        return base64_encode($encData. '::' . $iv);
        
    }   

    /**
     * @param $data
     * @return string
     */

    public function Decrypt($data){
        list($encdata, $iv) = explode('::', base64_decode($data), 2);
        $decData = openssl_decrypt($encdata, 'aes-256-cbc', $this->hash,  0, $iv);
        return $decData;
    }

    
}
