Config
=========================================
[![Latest Stable Version](https://poser.pugx.org/slexx/config/v/stable)](https://packagist.org/packages/slexx/config) [![Total Downloads](https://poser.pugx.org/slexx/config/downloads)](https://packagist.org/packages/slexx/config) [![Latest Unstable Version](https://poser.pugx.org/slexx/config/v/unstable)](https://packagist.org/packages/slexx/config) [![License](https://poser.pugx.org/slexx/config/license)](https://packagist.org/packages/slexx/config)

## Установка

Установка через `composer`:

```
$ composer require slexx/config
```

## Документация

### Config->__construct([$file])

**Аргументы:**

| Имя     | Тип               | Описание                    |
|---------|-------------------|-----------------------------|
| [$file] | `string`, `array` | Имя файла имя массив данных |

**Пример:**

```php
new Config('config.json');
new Config('config.ini');
new Config();
new Config(['foo' => 'bar']);
```

### Config->setFile($file)

Установка пути к файлу

**Аргументы:**

| Имя   | Тип              | Описание     |
|-------|------------------|--------------|
| $file | `null`, `string` | Путь к файлу |

**Возвращает:** `$this`

### Config->getFile()

Получение пути к файлу

**Возвращает:** `null`, `string`

### Config->save()

Сохранение конфигурайии

**Возвращает:** `$this`

**Пример:**

```php
$config = new Config('config.json')
$config->set('foo', 'bar');
$config->save();
```

### Config->toArray()

Преобразование в массив

**Возвращает:** `array`

### Config->all()

**Возвращает:** `array`

### Config->count()

**Возвращает:** `int`

### Config->getIterator()

**Возвращает:** `\ArrayIterator`

### Config->set($key, $value)

Установка переменной конфигурации

**Аргументы:**

| Имя    | Тип      | Описание            |
|--------|----------|---------------------|
| $key   | `string` | Имя переменной      |
| $value | `mixed`  | Значение переменной |

**Возвращает:** `$this`

### Config->has($key)

Проверка существования переменной конфигурации

**Аргументы:**

| Имя  | Тип      | Описание       |
|------|----------|----------------|
| $key | `string` | Имя переменной |

**Возвращает:** `bool`

### Config->get($key)

Получение значение переменной конфигурации

**Аргументы:**

| Имя  | Тип      | Описание       |
|------|----------|----------------|
| $key | `string` | Имя переменной |

**Возвращает:** `mixed`, `null` - Значение переменной или null в случае её отсуцтвия

### Config->remove($key)

Удаление переменной конфигурации

**Аргументы:**

| Имя  | Тип      | Описание       |
|------|----------|----------------|
| $key | `string` | Имя переменной |

**Возвращает:** `$this`
