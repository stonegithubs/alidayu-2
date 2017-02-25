<?php

namespace Mingyoung\Alidayu\Exceptions;

class Errors
{
    /**
     * Alidayu error codes.
     *
     * @var array
     */
    protected static $codes = [
        'isv.OUT_OF_SERVICE' => '业务停机',
        'isv.PRODUCT_UNSUBSCRIBE' => '产品服务未开通',
        'isv.ACCOUNT_NOT_EXISTS' => '账户信息不存在',
        'isv.ACCOUNT_ABNORMAL' => '账户信息异常',
        'isv.MOBILE_NUMBER_ILLEGAL' => '手机号码格式不合法',
        'isv.DISPLAY_NUMBER_ILLEGAL' => '号显不合法',
        'isv.INVALID_PARAMETERS' => '参数异常',
        'isv.TTS_TEMPLATE_ILLEGAL' => '文本转语音模板不合法',
        'isv.TEMPLATE_MISSING_PARAMETERS' => '文本转语音模板参数缺失',
        'isv.BLACK_KEY_CONTROL_LIMIT' => '模板变量中存在黑名单关键字。如：阿里大鱼、阿里大于',
        'isv.PARAM_NOT_SUPPORT_URL' => '变量不支持url参数',
        'isv.BUSINESS_LIMIT_CONTROL' => '触发业务流控',
        'isv.PARAM_LENGTH_LIMIT' => '参数长度受限',
        'isp.SYSTEM_ERROR' => '系统错误',
        'isv.VOICE_FILE_ILLEGAL' => '语音文件不合法',
        'isv.SMS_TEMPLATE_ILLEGAL' => '模板不合法',
        'isv.SMS_SIGNATURE_ILLEGAL' => '签名不合法',
        'isv.MOBILE_COUNT_OVER_LIMIT' => '手机号码数量超过限制',
        'isv.INVALID_JSON_PARAM' => 'JSON参数不合法',
        'isv.AMOUNT_NOT_ENOUGH' => '余额不足',
        'isv.QUERY_DATE_ILLEGAL' => '查询时间非法',
        'isv.SPLIT_PAGE_ILLEGAL' => '分页参数不合法',
    ];

    /**
     * Get message by code.
     *
     * @param $code
     * @return string
     */
    public static function getMessage($code)
    {
        if (array_key_exists($code, static::$codes)) {
            return static::$codes[$code];
        }

        return 'unknown';
    }
}
