<?php

use Slexx\Config\Config;
use PHPUnit\Framework\TestCase;
use Slexx\Config\Exceptions\UndefinedDriverException;
use Slexx\Config\Exceptions\NoFileSpecifiedException;

class ConfigTest extends TestCase
{
    public function testNoFileSpecifiedException()
    {
        $this->expectException(NoFileSpecifiedException::class);

        (new Config())->save();
    }

    public function testUndefinedDriverException()
    {
        $this->expectException(UndefinedDriverException::class);

        (new Config())
            ->setFile('config.xml')
            ->save();
    }

    public function testHas()
    {
        $config = new Config();
        $this->assertFalse($config->has('foo'));
        $config->set('foo', 'bar');
        $this->assertTrue($config->has('foo'));
    }

    public function testGet()
    {
        $config = new Config();
        $this->assertNull($config->get('foo'));
        $config->set('foo', 'bar');
        $this->assertEquals('bar', $config->get('foo'));
    }

    public function testRemove()
    {
        $config = new Config();
        $this->assertNull($config->get('foo'));
        $config->set('foo', 'bar');
        $this->assertEquals('bar', $config->get('foo'));
        $config->remove('foo');
        $this->assertNull($config->get('foo'));
    }

    public function testAll()
    {
        $config = new Config();
        $this->assertEquals([], $config->all());
        $config->set('foo', 'bar');
        $this->assertEquals(['foo' => 'bar'], $config->all());
    }

    public function testToArray()
    {
        $config = new Config();
        $this->assertEquals([], $config->toArray());
        $config->set('foo', 'bar');
        $this->assertEquals(['foo' => 'bar'], $config->toArray());
    }

    public function testCount()
    {
        $config = new Config();
        $this->assertEquals(0, count($config));
        $config->set('foo', 'bar');
        $this->assertEquals(1, count($config));
    }

    public function testIterable()
    {
        $config = new Config([
            'foo' => 'bar',
            'bar' => [
                'foo' => 'bar',
                'bar' => 'baz',
            ]
        ]);

        $i = 0;
        foreach($config as $key => $value) {
            switch($i) {
                case 0: $this->assertEquals($key, 'foo'); break;
                case 1: $this->assertEquals($key, 'bar'); break;
                default: $this->assertTrue(false); break;
            }
            $i++;
        }
    }

    public function testSave()
    {
        $file = __DIR__ . '/config.ini';

        (new Config([
            'foo' => 'bar',
            'bar' => [
                'foo' => 'bar',
                'bar' => 'baz',
            ]
        ]))->setFile($file)->save();

        $this->assertTrue(file_exists($file));
    }

    public function testRead()
    {
        $file = __DIR__ . '/config.ini';

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => [
                'foo' => 'bar',
                'bar' => 'baz',
            ]
        ], (new Config($file))->toArray());

        unlink($file);
    }
}

