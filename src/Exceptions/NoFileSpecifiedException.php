<?php

namespace Slexx\Config\Exceptions;

class NoFileSpecifiedException extends ConfigException
{
    public function __construct($code = 0, \Throwable $previous = null)
    {
        parent::__construct('Для этого действия требуется указать имя файла!', $code, $previous);
    }
}
