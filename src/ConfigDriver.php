<?php

namespace Slexx\Config;

abstract class ConfigDriver implements ConfigDriverInterface
{
    /**
     * @var null|ConfigDriver
     */
    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return ConfigDriver
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @param string $file
     * @return array
     */
    abstract public function parse($file);

    /**
     * @param string $file
     * @param array $data
     * @return array
     */
    abstract public function write($file, $data);
}
