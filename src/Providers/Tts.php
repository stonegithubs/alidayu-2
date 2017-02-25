<?php

namespace Mingyoung\Alidayu\Providers;

class Tts extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.tts.num.singlecall';

    protected $methodToVarMaps = [
        'extend' => 'extend',
        'ttsParam' => 'tts_param',
        'calledNum' => 'called_num|required',
        'calledShowNum' => 'called_show_num|required',
        'ttsCode' => 'tts_code|required',
    ];
}
