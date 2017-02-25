<?php
namespace Mingyoung\Alidayu\Core;

class Encryptor
{
    public function encrypt($params, $appSecret)
    {
        ksort($params);
        $stringToBeSigned = $appSecret;

        foreach ($params as $key => $value) {
            if (is_string($value) && '@' !== substr($value, 0, 1)) {
                $stringToBeSigned .= "$key$value";
            }
        }

        unset($key, $value);
        $stringToBeSigned .= $appSecret;

        return strtoupper(md5($stringToBeSigned));
    }
}
