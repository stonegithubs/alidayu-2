# 阿里大于 Alidayu PHP SDK.


## 安装

你可以使用 Composer 进行安装

```sh
$ composer require mingyoung/alidayu
```

## 实例化
```php
<?php

use Mingyoung\Alidayu\Client;

$appKey = 'your-app-key';
$appSecret = 'your-app-secret';

$alidayu = new Client($appKey, $appSecret);

```

## 使用

### Api

```
 $alidayu->call                     多方通话
 $alidayu->tts                      文本转语音通知
 $alidayu->voice                    语音通知
 $alidayu->sms                      短信发送
 $alidayu->sms_query                短信发送记录查询
 $alidayu->data_query               流量直充查询
 $alidayu->data_charge              流量直充
 $alidayu->data_grade               流量直充档位表
 $alidayu->data_charge_province     流量直充分省接口
 $alidayu->iot                      查询终端信息
 $alidayu->iot_recharge             按终端号订购增值业务
```

参数请求使用骆驼命名法
- 如发送短信示例
```php
<?php
// 如请求参数为 sms_type 则使用 withSmsType('value')
$sms = $alidayu->sms
        ->withSmsType('normal')
        ->smsFreeSignName('短信签名')
        ->recNum('138*****000')
        ->smsTemplateCode('SMS_888888');

$alidayu->execute($sms);
```
请求参数请查看[阿里大于API](https://api.alidayu.com/docs/api_list.htm)官方文档。

