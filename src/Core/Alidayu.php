<?php

namespace Mingyoung\Alidayu\Core;

use Mingyoung\Alidayu\Client;
use Mingyoung\Alidayu\Exceptions\Errors;
use Mingyoung\Alidayu\Support\Collection;

class Alidayu
{
    protected $apiVersion = '2.0';
    protected $format = 'json';
    protected $signMethod = 'md5';
    protected $gatewayUrl = 'https://eco.taobao.com/router/rest';
    protected $sdkVersion = 'top-sdk-php-20151012';


    protected $provider;

    protected $client;

    protected $encryptor;

    protected $http;

    public function __construct(Client $client)
    {
        $this->client = $client;

        $this->encryptor = new Encryptor();

        $this->http = new Http();
    }

    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    public function execute($session = null, $bestUrl = null)
    {
        //        dump($this->provider->getApiParameters());die;
        // check required.
        foreach ($this->provider->getRequired() as $item) {
            if (!array_key_exists($item, $this->provider->getApiParameters())) {
                throw new \Exception("Parameter \"{$item}\" is required.");
            }
        }
        $sysParams = [
            'app_key' => $this->client->getAppKey(),
            'v' => $this->apiVersion,
            'format' => $this->format,
            'sign_method' => $this->signMethod,
            'method' => $this->provider->getApiMethodName(),
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        if (!is_null($session)) {
            $sysParams['session'] = $session;
        }

        $apiParams = [];
        //获取业务参数
        $apiParams = $this->provider->getApiParameters();

        //系统参数放入GET请求串
        if ($bestUrl) {
            $requestUrl = $bestUrl."?";
            $sysParams["partner_id"] = $this->getClusterTag();
        } else {
            $requestUrl = $this->gatewayUrl."?";
            $sysParams["partner_id"] = $this->sdkVersion;
        }
        //签名
        $sysParams['sign'] = $this->encryptor->encrypt(array_merge($apiParams, $sysParams), $this->client->getAppSecret());

        foreach ($sysParams as $sysParamKey => $sysParamValue) {
            $requestUrl .= "$sysParamKey=".urlencode($sysParamValue).'&';
        }


        $fileFields = array();
        foreach ($apiParams as $key => $value) {
            if (is_array($value) && array_key_exists('type', $value) && array_key_exists('content', $value)) {
                $value['name'] = $key;
                $fileFields[$key] = $value;
                unset($apiParams[$key]);
            }
        }

        // $requestUrl .= "timestamp=" . urlencode($sysParams["timestamp"]) . "&";
        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
        try {
            if (count($fileFields) > 0) {
                $resp = $this->curl_with_memory_file($requestUrl, $apiParams, $fileFields);
            } else {
                $resp = $this->http->curl($requestUrl, $apiParams);
            }
        } catch (Exception $e) {
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_ERROR_'.$e->getCode(), $e->getMessage());
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();

            return $result;
        }

        unset($apiParams);
        unset($fileFields);
        //解析TOP返回结果
        $respWellFormed = false;
        if ('json' === $this->format) {
            $respObject = json_decode($resp, true);
            $respObject = new Collection($respObject);
            if (null !== $respObject) {
                $respWellFormed = true;
                foreach ($respObject as $propKey => $propValue) {
                    $respObject = $propValue;
                }
            }
        } elseif ('xml' === $this->format) {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject) {
                $respWellFormed = true;
            }
        }

        //返回的HTTP文本不是标准JSON或者XML，记下错误日志
        if (false === $respWellFormed) {
            die('recode rizhi');
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_RESPONSE_NOT_WELL_FORMED', $resp);
            $result->code = 0;
            $result->msg = 'HTTP_RESPONSE_NOT_WELL_FORMED';

            return $result;
        }

        //如果TOP返回了错误码，记录到业务错误日志中
  
        if (isset($respObject['code'])) {
            $sub_code = $respObject['sub_code'];
            $sub_msg=$respObject['sub_msg'];

            $errors = [
                'errcode'=>$sub_code,
                'errmsg' => Errors::getMessage($sub_code)
            ];

            return $errors;
            
         // $logger = new Logger;
         // $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_biz_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
         // $logger->log(array(
         //     date("Y-m-d H:i:s"),
         //     $resp
         //     ));
        }
        return $respObject;
    }
}
