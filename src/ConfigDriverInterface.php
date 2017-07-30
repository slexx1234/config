<?php

namespace Slexx\Config;

interface ConfigDriverInterface
{
    /**
     * @param string $file
     * @return array
     */
    public static function parse($file);

    /**
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function write($file, $data);
}

