<?php

use Slexx\Config\Drivers\Yaml;
use PHPUnit\Framework\TestCase;

class YamlTest extends TestCase
{
    const TEST_ARRAY = [
        'foo' => 'bar',
        'bar' => [
            'foo' => 'bar',
            'bar' => 'baz',
        ],
    ];

    const TEST_STRING = "foo: bar\nbar:\n    foo: bar\n    bar: baz\n";

    const TEST_FILE = __DIR__ . '/config.yaml';

    public function testWrite()
    {
        Yaml::write(self::TEST_FILE, self::TEST_ARRAY);
        $this->assertEquals(file_get_contents(self::TEST_FILE), self::TEST_STRING);
    }

    public function testParse()
    {
        $this->assertEquals(self::TEST_ARRAY, Yaml::parse(self::TEST_FILE));
        unlink(self::TEST_FILE);
    }
}
