<?php

namespace Mingyoung\Alidayu\Providers;

class DataQuery extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.flow.query';

    protected $methodToVarMaps = [
        'OutId' => 'out_id',
    ];
}
