<?php

use Slexx\Config\Drivers\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    const TEST_ARRAY = [
        'foo' => 'bar',
        'bar' => [
            'foo' => 'bar',
            'bar' => 'baz',
        ],
    ];

    const TEST_STRING = "{\n    \"foo\": \"bar\",\n    \"bar\": {\n        \"foo\": \"bar\",\n        \"bar\": \"baz\"\n    }\n}\n";

    const TEST_FILE = __DIR__ . '/config.json';

    public function testWrite()
    {
        Json::write(self::TEST_FILE, self::TEST_ARRAY);
        $this->assertEquals(file_get_contents(self::TEST_FILE), self::TEST_STRING);
    }

    public function testParse()
    {
        $this->assertEquals(self::TEST_ARRAY, Json::parse(self::TEST_FILE));
        unlink(self::TEST_FILE);
    }
}
