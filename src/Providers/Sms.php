<?php

namespace Mingyoung\Alidayu\Providers;

class Sms extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.sms.num.send';

    protected $methodToVarMaps = [
        'extend' => 'extend',
        'smsType' => 'sms_type|required',
        'smsFreeSignName' => 'sms_free_sign_name|required',
        'smsParam' => 'sms_param',
        'recNum' => 'rec_num|required',
        'smsTemplateCode' => 'sms_template_code|required',
     ];
}
