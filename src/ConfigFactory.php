<?php

namespace SugaredRim\PhpCsFixer;

use Schnittstabil\Get;
use Schnittstabil\ComposerExtra\ComposerExtra;
use Schnittstabil\FinderByConfig\FinderByConfig;

class ConfigFactory
{
    protected $defaults;

    public function __construct()
    {
        $this->defaults = new \stdClass();
        $this->defaults->presets = [
            'SugaredRim\\PhpCsFixer\\DefaultPreset::get',
        ];
    }

    protected function getComposerConfig($namespace)
    {
        return (new ComposerExtra(
            $namespace,
            $this->defaults,
            'presets'
        ))->get();
    }

    public function __invoke($namespace)
    {
        $composerConfig = $this->getComposerConfig($namespace);
        $config = new Config();

        $config->diff = Get\value('diff', $composerConfig, false);
        $config->{'dry-run'} = Get\value('dry-run', $composerConfig, false);
        $config->setUsingCache(Get\value('cache', $composerConfig, false));

        $path = Get\value('path', $composerConfig);
        if (!empty($path)) {
            $finderByConfig = new FinderByConfig();
            $config->setFinder($finderByConfig($path));
        }

        return $config;
    }
}
