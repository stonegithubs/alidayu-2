<?php

namespace Mingyoung\Alidayu\Providers;

class DataCharge extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.flow.charge';

    protected $methodToVarMaps = [
        'phoneNum' => 'phone_num|required',
        'reason' => 'reason',
        'grade' => 'grade|required',
        'outRechargeId' => 'out_recharge_id|required',
    ];
}
