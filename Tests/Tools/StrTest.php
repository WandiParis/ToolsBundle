<?php

namespace Wandi\ToolsBundle\Tests\Tools;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\Str;

class StrTest extends TestCase
{
    private $str;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->str = new Str();
    }

    public function testSubstrToLength()
    {
        $chars = 'Lorem ipsum dolor sit amet.';
        $this->assertEquals('Lorem ipsum dolor sit amet.', $this->str->substrToLength($chars, 27));
        $this->assertEquals('Lorem ipsum dolor sit amet.', $this->str->substrToLength($chars, 100));
        $this->assertEquals('Lorem...', $this->str->substrToLength($chars, 10));
        $this->assertEquals('Lorem...', $this->str->substrToLength($chars, 10, '...'));
        $this->assertEquals('Lorem', $this->str->substrToLength($chars, 10, ''));
        $this->assertEquals('Lorem!', $this->str->substrToLength($chars, 10, '!'));
        $this->assertEquals('Lorem ipsum...', $this->str->substrToLength($chars, 14));
        $this->assertEquals('Lorem ipsum...', $this->str->substrToLength($chars, 15));
        $this->assertEquals('Lorem ipsum...', $this->str->substrToLength($chars, 16));
    }

    public function testSlug()
    {
        $this->assertEquals('hello-world', $this->str->slug('Hello world!'));
        $this->assertEquals('hello-world', $this->str->slug('Hello world'));
        $this->assertEquals('hello-world', $this->str->slug('!!Hello!world!!'));
        $this->assertEquals('hello-world', $this->str->slug('  Hello  world     '));
    }

    public function testSubstrBeforeFirstDelimiter()
    {
        $this->assertEquals('lorem ipsum', $this->str->substrBeforeFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', $this->str->substrBeforeFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem', $this->str->substrBeforeFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', $this->str->substrBeforeFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', $this->str->substrBeforeFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrBeforeLastDelimiter()
    {
        $this->assertEquals('lorem ipsum', $this->str->substrBeforeLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', $this->str->substrBeforeLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem-ipsum', $this->str->substrBeforeLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', $this->str->substrBeforeLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', $this->str->substrBeforeLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterLastDelimiter()
    {
        $this->assertEquals('lorem ipsum', $this->str->substrAfterLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', $this->str->substrAfterLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('dolor', $this->str->substrAfterLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', $this->str->substrAfterLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', $this->str->substrAfterLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterFirstDelimiter()
    {
        $this->assertEquals('lorem ipsum', $this->str->substrAfterFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', $this->str->substrAfterFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('ipsum-dolor', $this->str->substrAfterFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', $this->str->substrAfterFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', $this->str->substrAfterFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testStartsWith()
    {
        $this->assertEquals(false, $this->str->startsWith('lorem ipsum', 'L'));
        $this->assertEquals(false, $this->str->startsWith('lorem ipsum', ' l'));
        $this->assertEquals(true, $this->str->startsWith('lorem ipsum', 'l'));
        $this->assertEquals(true, $this->str->startsWith('Élorem ipsum', 'É'));
        $this->assertEquals(true, $this->str->startsWith('élorem ipsum', 'é'));
        $this->assertEquals(false, $this->str->startsWith('Élorem ipsum', 'E'));
    }

    public function testEndsWith()
    {
        $this->assertEquals(false, $this->str->endsWith('lorem ipsum', 'M'));
        $this->assertEquals(false, $this->str->endsWith('lorem ipsum', 'm '));
        $this->assertEquals(true, $this->str->endsWith('lorem ipsum', 'm'));
        $this->assertEquals(true, $this->str->endsWith('lorem ipsumÉ', 'É'));
        $this->assertEquals(true, $this->str->endsWith('lorem ipsumé', 'é'));
        $this->assertEquals(false, $this->str->endsWith('lorem ipsumé', 'e'));
    }
}
