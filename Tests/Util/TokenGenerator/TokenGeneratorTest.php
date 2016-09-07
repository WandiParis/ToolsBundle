<?php

namespace Wandi\ToolsBundle\Tests\Util\TokenGenerator;

use Wandi\ToolsBundle\Util\TokenGenerator\TokenGenerator;

class TokenGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testParse(){
        $tokenGenerator = new TokenGenerator();

        $this->assertEquals(1, strlen($tokenGenerator->generate(0)));
        $this->assertEquals(1, strlen($tokenGenerator->generate(1)));
        $this->assertEquals(2, strlen($tokenGenerator->generate(2)));
        $this->assertEquals(32, strlen($tokenGenerator->generate(32)));
        $this->assertEquals(32, strlen($tokenGenerator->generate(64)));
    }
}