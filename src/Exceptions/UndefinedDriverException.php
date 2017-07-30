<?php

namespace Slexx\Config\Exceptions;

class UndefinedDriverException extends ConfigException
{
    public function __construct($suffix, $code = 0, \Throwable $previous = null)
    {
        parent::__construct('Драйвер для "' . $suffix . '" расширения файла, не определён!', $code, $previous);
    }
}
