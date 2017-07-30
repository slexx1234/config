<?php

namespace Slexx\Config;

interface ConfigDriverInterface
{
    /**
     * @param string $path
     * @return array
     */
    public function parseFile($path);

    /**
     * @param string $string
     * @return array
     */
    public function parseString($string);

    /**
     * @param string $path
     * @param array $array
     * @return array
     */
    public function writeToFile($path, $array);

    /**
     * @param array $array
     * @return array
     */
    public function writeToString($array);
}

