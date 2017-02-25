<?php

namespace Mingyoung\Alidayu\Providers;

class Call extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.voice.num.doublecall';

    protected $methodToVarMaps = [
        'sessionTimeOut' => 'session_time_out',
        'extend' => 'extend',
        'callerNum' => 'caller_num|required',
        'callerShowNum' => 'caller_show_num|required',
        'calledNum' => 'called_num|required',
        'calledShowNum' => 'called_show_num|required',
     ];
}
