<?php

namespace Mingyoung\Alidayu\Providers;

class Voice extends AbstractProvider
{
    protected $apiMethodName = 'alibaba.aliqin.fc.voice.num.singlecall';

    protected $methodToVarMaps = [
        'extend' => 'extend',
        'calledNum' => 'called_num|required',
        'calledShowNum' => 'called_show_num|required',
        'voiceCode' => 'voice_code|required',
    ];
}
