<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Wandi\ToolsBundle\Util\Strings;

class StringsTest extends TestCase
{
    public function testSubstrToLength()
    {
        $chars = 'Lorem ipsum dolor sit amet.';
        $this->assertSame('Lorem ipsum dolor sit amet.', Strings::substrToLength($chars, 27));
        $this->assertSame('Lorem ipsum dolor sit amet.', Strings::substrToLength($chars, 100));
        $this->assertSame('Lorem...', Strings::substrToLength($chars, 10));
        $this->assertSame('Lorem...', Strings::substrToLength($chars, 10, '...'));
        $this->assertSame('Lorem', Strings::substrToLength($chars, 10, ''));
        $this->assertSame('Lorem!', Strings::substrToLength($chars, 10, '!'));
        $this->assertSame('Lorem ipsum...', Strings::substrToLength($chars, 14));
        $this->assertSame('Lorem ipsum...', Strings::substrToLength($chars, 15));
        $this->assertSame('Lorem ipsum...', Strings::substrToLength($chars, 16));
    }

    public function testSlug()
    {
        $this->assertSame('hello-world', Strings::slug('Hello world!'));
        $this->assertSame('hello-world', Strings::slug('Hello world'));
        $this->assertSame('hello-world', Strings::slug('!!Hello!world!!'));
        $this->assertSame('hello-world', Strings::slug('  Hello  world     '));
    }

    public function testSubstrBeforeFirstDelimiter()
    {
        $this->assertSame('lorem ipsum', Strings::substrBeforeFirstDelimiter('lorem ipsum', '-'));
        $this->assertSame('lorem', Strings::substrBeforeFirstDelimiter('lorem-ipsum', '-'));
        $this->assertSame('lorem', Strings::substrBeforeFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertSame('lorem ipsum dolor', Strings::substrBeforeFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertSame('lorem ipsum dolor ! ', Strings::substrBeforeFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrBeforeLastDelimiter()
    {
        $this->assertSame('lorem ipsum', Strings::substrBeforeLastDelimiter('lorem ipsum', '-'));
        $this->assertSame('lorem', Strings::substrBeforeLastDelimiter('lorem-ipsum', '-'));
        $this->assertSame('lorem-ipsum', Strings::substrBeforeLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertSame('lorem ipsum dolor', Strings::substrBeforeLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertSame('lorem ipsum dolor ! ', Strings::substrBeforeLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterLastDelimiter()
    {
        $this->assertSame('lorem ipsum', Strings::substrAfterLastDelimiter('lorem ipsum', '-'));
        $this->assertSame('ipsum', Strings::substrAfterLastDelimiter('lorem-ipsum', '-'));
        $this->assertSame('dolor', Strings::substrAfterLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertSame('1', Strings::substrAfterLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertSame(' 1', Strings::substrAfterLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterFirstDelimiter()
    {
        $this->assertSame('lorem ipsum', Strings::substrAfterFirstDelimiter('lorem ipsum', '-'));
        $this->assertSame('ipsum', Strings::substrAfterFirstDelimiter('lorem-ipsum', '-'));
        $this->assertSame('ipsum-dolor', Strings::substrAfterFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertSame('1', Strings::substrAfterFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertSame(' 1', Strings::substrAfterFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testStartsWith()
    {
        $this->assertSame(false, Strings::startsWith('lorem ipsum', 'L'));
        $this->assertSame(false, Strings::startsWith('lorem ipsum', ' l'));
        $this->assertSame(true, Strings::startsWith('lorem ipsum', 'l'));
        $this->assertSame(true, Strings::startsWith('Élorem ipsum', 'É'));
        $this->assertSame(true, Strings::startsWith('élorem ipsum', 'é'));
        $this->assertSame(false, Strings::startsWith('Élorem ipsum', 'E'));
    }

    public function testEndsWith()
    {
        $this->assertSame(false, Strings::endsWith('lorem ipsum', 'M'));
        $this->assertSame(false, Strings::endsWith('lorem ipsum', 'm '));
        $this->assertSame(true, Strings::endsWith('lorem ipsum', 'm'));
        $this->assertSame(true, Strings::endsWith('lorem ipsumÉ', 'É'));
        $this->assertSame(true, Strings::endsWith('lorem ipsumé', 'é'));
        $this->assertSame(false, Strings::endsWith('lorem ipsumé', 'e'));
    }
}
