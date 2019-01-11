<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Wandi\ToolsBundle\Util\TokenGenerator;

class TokenGeneratorTest extends TestCase
{
    public function testParse()
    {
        $this->assertSame(0, strlen(TokenGenerator::generate(0)));
        $this->assertSame(1, strlen(TokenGenerator::generate(1)));
        $this->assertSame(2, strlen(TokenGenerator::generate(2)));
        $this->assertSame(2048, strlen(TokenGenerator::generate(2048)));
        $this->assertSame(1, preg_match('/([a-zA-Z0-9])*/', TokenGenerator::generate(2048)));
    }
}
