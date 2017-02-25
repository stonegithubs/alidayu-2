<?php

namespace Mingyoung\Alidayu\Providers;

class IotRecharge extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.iot.rechargeCard';

    protected $methodToVarMaps = [
        'billSource' => 'bill_source|required',
        'billReal' => 'bill_real|required',
        'offer_id' => 'offer_id|required',
        'outRechargeId' => 'out_recharge_id|required',
        'iccid' => 'iccid|required',
        'effCode' => 'eff_code|required',
    ];
}
