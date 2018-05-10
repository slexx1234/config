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
     * @param string|array [$file] - Имя файла имя массив данных
     * @throws UndefinedDriverException|NoFileSpecifiedException
     * @example:
     * new Config('config.json');
     * new Config('config.ini');
     * new Config();
     * new Config(['foo' => 'bar']);
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
     * Вызов метода драйвера конфигурации
     * @param string $method - Имя метода
     * @param array $arguments - Аргументы метода
     * @return string
     * @throws UndefinedDriverException|NoFileSpecifiedException
     */
    protected function driver($method, ...$arguments)
    {
        if ($this->file === null) {
            throw new NoFileSpecifiedException();
        }

        $parts = explode('.', $this->file);
        $suffix = end($parts);
        $driver = DriversManager::get($suffix);

        if ($driver === null) {
            throw new UndefinedDriverException($suffix);
        }

        return call_user_func_array([$driver, $method], $arguments);
    }

    /**
     * Установка пути к файлу
     * @param null|string $file - Путь к файлу
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Получение пути к файлу
     * @return null|string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Сохранение конфигурайии
     * @return $this
     * @throws UndefinedDriverException|NoFileSpecifiedException
     * @example:
     * $config = new Config('config.json')
     * $config->set('foo', 'bar');
     * $config->save();
     */
    public function save()
    {
        $this->driver('write', $this->file, $this->data);
        return $this;
    }

    /**
     * Преобразование в массив
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * @see Config::toArray()
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
     * Установка переменной конфигурации
     * @param string $key - Имя переменной
     * @param mixed $value - Значение переменной
     * @return $this
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Проверка существования переменной конфигурации
     * @param string $key - Имя переменной
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Получение значение переменной конфигурации
     * @param string $key - Имя переменной
     * @return mixed|null - Значение переменной или null в случае её отсуцтвия
     */
    public function get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * Удаление переменной конфигурации
     * @param string $key - Имя переменной
     * @return $this
     */
    public function remove($key)
    {
        unset($this->data[$key]);
        return $this;
    }
}

