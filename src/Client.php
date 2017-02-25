<?php

namespace Mingyoung\Alidayu;

use Mingyoung\Alidayu\Core\Alidayu;
use Mingyoung\Alidayu\Exceptions\InvalidArgumentException;
use Mingyoung\Alidayu\Providers\ProviderInterface;

/**
 * @property \Mingyoung\Alidayu\Providers\Call $call
 * @property \Mingyoung\Alidayu\Providers\Tts $tts
 * @property \Mingyoung\Alidayu\Providers\Voice $voice
 * @property \Mingyoung\Alidayu\Providers\Sms $sms
 * @property \Mingyoung\Alidayu\Providers\SmsQuery $sms_query
 * @property \Mingyoung\Alidayu\Providers\DataQuery $data_query
 * @property \Mingyoung\Alidayu\Providers\DataCharge $data_charge
 * @property \Mingyoung\Alidayu\Providers\DataGrade $data_grade
 * @property \Mingyoung\Alidayu\Providers\DataChargeProvince $data_charge_province
 * @property \Mingyoung\Alidayu\Providers\Iot $iot
 * @property \Mingyoung\Alidayu\Providers\IotRecharge $iot_recharge
 * @property \Mingyoung\Alidayu\Providers\Ip $ip
 */
class Client
{
    /**
     * Alidayu app key.
     *
     * @var string
     */
    protected $appKey;

    /**
     * Alidayu app secret.
     *
     * @var string
     */
    protected $appSecret;

    /**
     * Alidayu providers.
     *
     * @var array
     */
    protected $providers = [
        'call' => Providers\Call::class,                                // 多方通话
        'tts' => Providers\Tts::class,                                  // 文本转语音通知
        'voice' => Providers\Voice::class,                              // 语音通知
        'sms' => Providers\Sms::class,                                  // 短信发送
        'sms_query' => Providers\SmsQuery::class,                       // 短信发送记录查询
        'data_query' => Providers\DataQuery::class,                     // 流量直充查询
        'data_charge' => Providers\DataCharge::class,                   // 流量直充
        'data_grade' => Providers\DataGrade::class,                     // 流量直充档位表
        'data_charge_province' => Providers\DataChargeProvince::class,  // 流量直充分省接口
        'iot' => Providers\Iot::class,                                  // 查询终端信息
        'iot_recharge' => Providers\IotRecharge::class,                 // 按终端号订购增值业务
        'ip' => Providers\Ip::class,
    ];

    /**
     * Client constructor.
     *
     * @param string $appKey
     * @param string $appSecret
     */
    public function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

    /**
     * Execute.
     *
     * @param ProviderInterface $provider
     *
     * @return mixed
     */
    public function execute(ProviderInterface $provider)
    {
        return (new Alidayu($this))->setProvider($provider)->execute();
    }

    /**
     * Magic get access.
     *
     * @param string $name
     *
     * @throws \Mingyoung\Alidayu\Exceptions\InvalidArgumentException
     *
     * @return \Mingyoung\Alidayu\Providers\ProviderInterface
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->providers)) {
            return new $this->providers[$name]();
        }

        throw new InvalidArgumentException("Does not has property \"{$name}\"");
    }

    /**
     * Gets the value of appKey.
     *
     * @return mixed
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Sets the value of appKey.
     *
     * @param mixed $appKey the app key
     *
     * @return self
     */
    protected function setAppKey($appKey)
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * Gets the value of appSecret.
     *
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * Sets the value of appSecret.
     *
     * @param mixed $appSecret the app secret
     *
     * @return self
     */
    protected function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;

        return $this;
    }
}
