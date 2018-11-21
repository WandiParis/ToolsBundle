<?php

namespace Wandi\ToolsBundle\Tests\Util;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Util\Strings;

class StringsTest extends TestCase
{
    public function testSubstrToLength()
    {
        $chars = 'Lorem ipsum dolor sit amet.';
        $this->assertEquals('Lorem ipsum dolor sit amet.', Strings::substrToLength($chars, 27));
        $this->assertEquals('Lorem ipsum dolor sit amet.', Strings::substrToLength($chars, 100));
        $this->assertEquals('Lorem...', Strings::substrToLength($chars, 10));
        $this->assertEquals('Lorem...', Strings::substrToLength($chars, 10, '...'));
        $this->assertEquals('Lorem', Strings::substrToLength($chars, 10, ''));
        $this->assertEquals('Lorem!', Strings::substrToLength($chars, 10, '!'));
        $this->assertEquals('Lorem ipsum...', Strings::substrToLength($chars, 14));
        $this->assertEquals('Lorem ipsum...', Strings::substrToLength($chars, 15));
        $this->assertEquals('Lorem ipsum...', Strings::substrToLength($chars, 16));
    }

    public function testSlug()
    {
        $this->assertEquals('hello-world', Strings::slug('Hello world!'));
        $this->assertEquals('hello-world', Strings::slug('Hello world'));
        $this->assertEquals('hello-world', Strings::slug('!!Hello!world!!'));
        $this->assertEquals('hello-world', Strings::slug('  Hello  world     '));
    }

    public function testSubstrBeforeFirstDelimiter()
    {
        $this->assertEquals('lorem ipsum', Strings::substrBeforeFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', Strings::substrBeforeFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem', Strings::substrBeforeFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', Strings::substrBeforeFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', Strings::substrBeforeFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrBeforeLastDelimiter()
    {
        $this->assertEquals('lorem ipsum', Strings::substrBeforeLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', Strings::substrBeforeLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem-ipsum', Strings::substrBeforeLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', Strings::substrBeforeLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', Strings::substrBeforeLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterLastDelimiter()
    {
        $this->assertEquals('lorem ipsum', Strings::substrAfterLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', Strings::substrAfterLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('dolor', Strings::substrAfterLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', Strings::substrAfterLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', Strings::substrAfterLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterFirstDelimiter()
    {
        $this->assertEquals('lorem ipsum', Strings::substrAfterFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', Strings::substrAfterFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('ipsum-dolor', Strings::substrAfterFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', Strings::substrAfterFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', Strings::substrAfterFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testStartsWith()
    {
        $this->assertEquals(false, Strings::startsWith('lorem ipsum', 'L'));
        $this->assertEquals(false, Strings::startsWith('lorem ipsum', ' l'));
        $this->assertEquals(true, Strings::startsWith('lorem ipsum', 'l'));
        $this->assertEquals(true, Strings::startsWith('Élorem ipsum', 'É'));
        $this->assertEquals(true, Strings::startsWith('élorem ipsum', 'é'));
        $this->assertEquals(false, Strings::startsWith('Élorem ipsum', 'E'));
    }

    public function testEndsWith()
    {
        $this->assertEquals(false, Strings::endsWith('lorem ipsum', 'M'));
        $this->assertEquals(false, Strings::endsWith('lorem ipsum', 'm '));
        $this->assertEquals(true, Strings::endsWith('lorem ipsum', 'm'));
        $this->assertEquals(true, Strings::endsWith('lorem ipsumÉ', 'É'));
        $this->assertEquals(true, Strings::endsWith('lorem ipsumé', 'é'));
        $this->assertEquals(false, Strings::endsWith('lorem ipsumé', 'e'));
    }
}
