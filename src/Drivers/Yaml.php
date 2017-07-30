<?php

namespace Slexx\Config\Drivers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;
use Slexx\Config\ConfigDriverInterface;

class Yaml implements ConfigDriverInterface
{
    /**
     * @param string $file
     * @return array
     */
    public static function parse($file)
    {
        return SymfonyYaml::parse(file_get_contents($file));
    }

    /**
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function write($file, $data)
    {
        file_put_contents($file, SymfonyYaml::dump($data));
    }
}
