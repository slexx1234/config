<?php

namespace Slexx\Config;

interface ConfigDriverInterface
{
    /**
     * @param string $file
     * @return array
     */
    public function parse($file);

    /**
     * @param string $file
     * @param array $data
     * @return array
     */
    public function write($file, $data);
}

