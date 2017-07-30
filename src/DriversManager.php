<?php

namespace Slexx\Config;

use Slexx\Config\Drivers\Ini;
use Slexx\Config\Drivers\Php;
use Slexx\Config\Drivers\Json;
use Slexx\Config\Drivers\Yaml;

class DriversManager
{
    /**
     * @var string[]
     */
    protected static $drivers = [];

    /**
     * @param string $suffix
     * @param string $class
     * @return void
     */
    public static function set($suffix, $class)
    {
        static::$drivers[$suffix] = $class;
    }

    /**
     * @param string $suffix
     * @return bool
     */
    public static function has($suffix)
    {
        return isset(static::$drivers[$suffix]);
    }

    /**
     * @param string $suffix
     * @return void
     */
    public static function remove($suffix)
    {
        unset(static::$drivers[$suffix]);
    }

    /**
     * @param string $suffix
     * @return null|string
     */
    public static function get($suffix)
    {
        return static::has($suffix) ? static::$drivers[$suffix] : null;
    }
}

DriversManager::set('ini', Ini::class);
DriversManager::set('php', Php::class);
DriversManager::set('yaml', Yaml::class);
DriversManager::set('json', Json::class);
