<?php

namespace Slexx\Config;

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
    protected static function set($suffix, $class)
    {
        static::$drivers[$suffix] = $class;
    }

    /**
     * @param string $suffix
     * @return bool
     */
    protected static function has($suffix)
    {
        return isset(static::$drivers[$suffix]);
    }

    /**
     * @param string $suffix
     * @return void
     */
    protected static function remove($suffix)
    {
        unset(static::$drivers[$suffix]);
    }

    /**
     * @param string $suffix
     * @return null|string
     */
    protected static function get($suffix)
    {
        return static::has($suffix) ? static::$drivers[$suffix] : null;
    }
}
