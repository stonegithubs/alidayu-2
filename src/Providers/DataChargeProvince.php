<?php

namespace Mingyoung\Alidayu\Providers;

class DataChargeProvince extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.flow.charge.province';

    protected $methodToVarMaps = [
        'phoneNum' => 'phone_num|required',
        'reason' => 'reason',
        'grade' => 'grade|required',
        'outRechargeId' => 'out_recharge_id|required',
    ];
}
