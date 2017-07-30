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

    const TEST_FILE = __DIR__ . '/config.ini';

    public function testWrite()
    {
        Ini::write(self::TEST_FILE, self::TEST_ARRAY);
        $this->assertEquals(file_get_contents(self::TEST_FILE), self::TEST_STRING);
    }

    public function testParse()
    {
        $this->assertEquals(self::TEST_ARRAY, Ini::parse(self::TEST_FILE));
        unlink(self::TEST_FILE);
    }
}
