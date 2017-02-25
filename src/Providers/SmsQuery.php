<?php

namespace Mingyoung\Alidayu\Providers;

class SmsQuery extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.sms.num.query';

    protected $methodToVarMaps = [
        'bizId' => 'biz_id',
        'recNum' => 'rec_num|required',
        'queryDate' => 'query_date|required',
        'currentPage' => 'current_page|required',
        'pageSize' => 'page_size|required',
    ];
}
