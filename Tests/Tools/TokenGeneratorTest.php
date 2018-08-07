<?php

namespace Wandi\ToolsBundle\Tests\Tools\TokenGenerator;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\TokenGenerator;

class TokenGeneratorTest extends TestCase
{
    public function testParse()
    {
        $tokenGenerator = new TokenGenerator();

        $this->assertSame(0, strlen($tokenGenerator->generate(0)));
        $this->assertSame(1, strlen($tokenGenerator->generate(1)));
        $this->assertSame(2, strlen($tokenGenerator->generate(2)));
        $this->assertSame(2048, strlen($tokenGenerator->generate(2048)));
        $this->assertSame(1, preg_match('/([a-zA-Z0-9])*/', $tokenGenerator->generate(2048)));
    }
}
