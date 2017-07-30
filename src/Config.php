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
     * @param string|array [$file]
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    public function __construct($file = null)
    {
        if (is_array($file)) {
            $this->data = $file;
        } else if (is_string($file)) {
            $this->file = $file;
            if (file_exists($file)) {
                $this->data = $this->driver('parse', $file);
            }
        }
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return string
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    protected function driver($method, ...$arguments)
    {
        if ($this->file === null) {
            throw new NoFileSpecifiedException();
        }

        $suffix = end(explode('.', $this->file));
        $driver = DriversManager::get($suffix);

        if ($driver === null) {
            throw new UndefinedDriverException($suffix);
        }

        return call_user_func_array([$driver, $method], $arguments);
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
        $this->driver('write', $this->file, $this->data);
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

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function remove($key)
    {
        unset($this->data[$key]);
        return $this;
    }
}
