<?php

use Slexx\Config\Drivers\Ini;
use PHPUnit\Framework\TestCase;

class IniTest extends TestCase
{
    const TEST_ARRAY = [
        'foo' => 'bar',
        'bar' => [
            'foo' => 'bar',
            'bar' => 'baz',
        ],
    ];

    const TEST_STRING = "foo = \"bar\"\n[bar]\nfoo = \"bar\"\nbar = \"baz\"\n";

    public function testWrite()
    {
        Ini::write(__DIR__ . '/config.ini', self::TEST_ARRAY);
        $this->assertEquals(file_get_contents(__DIR__ . '/config.ini'), self::TEST_STRING);
    }

    public function testParse()
    {
        $this->assertEquals(self::TEST_ARRAY, Ini::parse(__DIR__ . '/config.ini'));
        unlink(__DIR__ . '/config.ini');
    }
}
