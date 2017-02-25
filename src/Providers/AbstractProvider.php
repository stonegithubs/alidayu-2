<?php

namespace Mingyoung\Alidayu\Providers;

use Mingyoung\Alidayu\Exceptions\InvalidArgumentException;

abstract class AbstractProvider implements ProviderInterface
{
    /**
     * Api method name for request.
     *
     * @var string
     */
    protected $apiMethodName;

    protected $methodToVarMaps = [];

    protected $required = [];
    /**
     * Api parameters for request.
     *
     * @var array
     */
    protected $apiParameters = [];

    /**
     * Api Parameters getter.
     *
     * @return array
     */
    public function getApiParameters()
    {
        return $this->apiParameters;
    }

    /**
     * Get api method name.
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    public function getApiMethodName()
    {
        if (!$methodName = $this->apiMethodName) {
            throw new InvalidArgumentException('Missing api method name.');
        }

        return $methodName;
    }

    /**
     * Get required parameter.
     *
     * @return array
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Magic access.
     *
     * @param string $method
     * @param array  $args
     *
     * @return $this
     */
    public function __call($method, $args)
    {
        if (0 === stripos($method, 'with') && strlen($method) > 4) {
            $method = lcfirst(substr($method, 4));

            $maps = $this->getMaps();

            if (isset($maps[$method])) {
                $this->apiParameters[$maps[$method]] = array_shift($args);
            }

            return $this;
        }

        return $this;
    }

    private function getMaps()
    {
        $maps = [];
        $required = [];
        foreach ($this->methodToVarMaps as $method => $param) {
            $explodeRule = explode('|', $param);
            if (count($explodeRule) > 1) {
                if ($explodeRule[1] === 'required') {
                    $required[] = $explodeRule[0];
                }
            }
            $maps[$method] = $explodeRule[0];
        }

        $this->required = $required;

        return $maps;
    }
}
