<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Wandi\ToolsBundle\Util\Str;

class StrTest extends \PHPUnit_Framework_TestCase
{
    public function testSubstrToLength()
    {
        $str = new Str();
        $string = 'Lorem ipsum dolor sit amet.';

        $this->assertEquals($string, $str->substrToLength($string, 27));
        $this->assertEquals($string, $str->substrToLength($string, 100));
        $this->assertEquals('Lorem...', $str->substrToLength($string, 10));
        $this->assertEquals('Lorem...', $str->substrToLength($string, 10, '...'));
        $this->assertEquals('Lorem', $str->substrToLength($string, 10, ''));
        $this->assertEquals('Lorem', $str->substrToLength($string, 10, null));
        $this->assertEquals('Lorem!', $str->substrToLength($string, 10, '!'));
        $this->assertEquals('Lorem ipsum...', $str->substrToLength($string, 14));
        $this->assertEquals('Lorem ipsum...', $str->substrToLength($string, 15));
        $this->assertEquals('Lorem ipsum...', $str->substrToLength($string, 16));
    }

    public function testSlug()
    {
        $str = new Str();
        $this->assertEquals('hello-world', $str->slug('Hello world!'));
        $this->assertEquals('hello-world', $str->slug('Hello world'));
        $this->assertEquals('hello-world', $str->slug('!!Hello!world!!'));
        $this->assertEquals('hello-world', $str->slug('  Hello  world     '));
    }

    public function testSubstrBeforeFirstDelimiter()
    {
        $str = new Str();
        $this->assertEquals('lorem ipsum', $str->substrBeforeFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', $str->substrBeforeFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem', $str->substrBeforeFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', $str->substrBeforeFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', $str->substrBeforeFirstDelimiter('lorem ipsum dolor ! - 1', '-'));

    }

    public function testSubstrBeforeLastDelimiter()
    {
        $str = new Str();
        $this->assertEquals('lorem ipsum', $str->substrBeforeLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('lorem', $str->substrBeforeLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('lorem-ipsum', $str->substrBeforeLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('lorem ipsum dolor', $str->substrBeforeLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals('lorem ipsum dolor ! ', $str->substrBeforeLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }


    public function testSubstrAfterLastDelimiter()
    {
        $str = new Str();
        $this->assertEquals('lorem ipsum', $str->substrAfterLastDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', $str->substrAfterLastDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('dolor', $str->substrAfterLastDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', $str->substrAfterLastDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', $str->substrAfterLastDelimiter('lorem ipsum dolor ! - 1', '-'));
    }

    public function testSubstrAfterFirstDelimiter()
    {
        $str = new Str();
        $this->assertEquals('lorem ipsum', $str->substrAfterFirstDelimiter('lorem ipsum', '-'));
        $this->assertEquals('ipsum', $str->substrAfterFirstDelimiter('lorem-ipsum', '-'));
        $this->assertEquals('ipsum-dolor', $str->substrAfterFirstDelimiter('lorem-ipsum-dolor', '-'));
        $this->assertEquals('1', $str->substrAfterFirstDelimiter('lorem ipsum dolor-1', '-'));
        $this->assertEquals(' 1', $str->substrAfterFirstDelimiter('lorem ipsum dolor ! - 1', '-'));
    }
}