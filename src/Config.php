<?php

namespace Schnittstabil\Sugared\PhpCsFixer;

use Symfony\CS\Config\Config as BaseConfig;

class Config extends BaseConfig
{
    private $extended = array();

    public function __get($name)
    {
        if (isset($this->extended[$name])) {
            return $this->extended[$name];
        }
    }

    public function __set($name, $value)
    {
        $this->extended[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->extended[$name]);
    }

    public function __unset($name)
    {
        unset($this->extended[$name]);
    }
}
