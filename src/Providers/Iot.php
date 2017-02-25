<?php

namespace Mingyoung\Alidayu\Providers;

class Iot extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.iot.qrycard';

    protected $methodToVarMaps = [
        'billSource' => 'bill_source|required',
        'billReal' => 'bill_real|required',
        'iccid' => 'iccid|required'
    ];
}
