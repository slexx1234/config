<?php

namespace Slexx\Config;

use Slexx\Config\Exceptions\NoFileSpecifiedException;
use Slexx\Config\Exceptions\UndefinedDriverException;

class Config implements \Countable, \IteratorAggregate
{
    /**
     * @var null|string
     */
    protected $file = null;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string [$file]
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    public function __construct($file = null)
    {
        if ($file !== null) {
            $this->file = $file;
            if (file_exists($file)) {
                $this->data = call_user_func([$this->driver(), 'parse'], $file);
            }
        }
    }

    /**
     * @return string
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    protected function driver()
    {
        if ($this->file === null) {
            throw new NoFileSpecifiedException();
        }

        $suffix = end(explode('.', $this->file));
        $driver = DriversManager::get($suffix);

        if ($driver === null) {
            throw new UndefinedDriverException($suffix);
        }

        return $driver;
    }

    /**
     * @param null|string $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return $this
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    public function save()
    {
        call_user_func([$this->driver(), 'write'], $this->file, $this->data);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}

