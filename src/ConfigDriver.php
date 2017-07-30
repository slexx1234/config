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
     * @param string $path
     * @return array
     */
    public function parseFile($path)
    {
        return $this->parseString(file_get_contents($path));
    }

    /**
     * @param string $string
     * @return array
     */
    abstract public function parseString($string);

    /**
     * @param string $path
     * @param array $array
     * @return void
     */
    public function writeToFile($path, $array)
    {
        file_put_contents($path, $this->writeToString($array));
    }

    /**
     * @param array $array
     * @return array
     */
    abstract public function writeToString($array);
}
