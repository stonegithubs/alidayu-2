<?php

namespace Mingyoung\Alidayu\Providers;

interface ProviderInterface
{
    /**
     * Get api parameters.
     *
     * @return array
     */
    public function getApiParameters();

    /**
     * Get api method name.
     *
     * @return string
     */
    public function getApiMethodName();
}
