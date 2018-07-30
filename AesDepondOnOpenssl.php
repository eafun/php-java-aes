<?php

class Aes
{
    public $cipher = "AES-128-ECB";

    /**
     * @param $encrypt string 待加密的数据
     * @param $key string 密钥
     * @return string
     */
    public function encrypt($encrypt, $key)
    {
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = substr(openssl_digest(openssl_digest($key, 'sha1', true), 'sha1', true), 0, 16);
        $encrypted = openssl_encrypt($encrypt, $this->cipher, $key, OPENSSL_RAW_DATA, $iv);
        return strtoupper(bin2hex($encrypted));
    }

    /**
     * @param $decrypt string 待解密的数据
     * @param $key string 密钥
     * @return string
     */
    public function decrypt($decrypt, $key)
    {
        $decoded = $this->hex2bin($decrypt);
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = substr(openssl_digest(openssl_digest($key, 'sha1', true), 'sha1', true), 0, 16);
        return openssl_decrypt($decoded, $this->cipher, $key, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * 16进制转换为2进制
     * @param $str string
     * @return string
     */
    public function hex2bin($str)
    {
        $sbin = "";
        $len = strlen($str);
        for ($i = 0; $i < $len; $i += 2) {
            $sbin .= pack("H*", substr($str, $i, 2));
        }
        return $sbin;
    }
}