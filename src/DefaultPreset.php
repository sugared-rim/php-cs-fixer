<?php

namespace Schnittstabil\Sugared\PhpCsFixer;

class DefaultPreset
{
    public static function get()
    {
        $config = new \stdClass();
        $config->diff = true;
        $config->{'dry-run'} = true;
        $config->cache = true;
        $config->path = new \stdClass();
        $config->path->in = ['.'];
        $config->path->name = ['*.php', '*.phtml', '*.twig', '*.xml', '*.yml'];
        $config->path->exclude = [
            'build',
            'bower_components',
            'node_modules',
            'vendor',
        ];
        $config->path->ignoreDotFiles = true;
        $config->path->ignoreVCS = true;

        return $config;
    }
}
