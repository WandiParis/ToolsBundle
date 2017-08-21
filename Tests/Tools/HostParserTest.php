<?php

namespace Wandi\ToolsBundle\Tests\Tools;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\HostParser;

class HostParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new HostParser();

        $domainParsed = $parser->parse('domain.tdl');
        $this->assertInternalType('array', $domainParsed);
        $this->assertArrayHasKey('domain', $domainParsed);
        $this->assertArrayHasKey('subdomain', $domainParsed);
        $this->assertSame('domain.tdl', $domainParsed['domain']);
        $this->assertSame('', $domainParsed['subdomain']);

        $domainParsed = $parser->parse('www.domain.tdl');
        $this->assertSame('domain.tdl', $domainParsed['domain']);
        $this->assertSame('www', $domainParsed['subdomain']);

        $domainParsed = $parser->parse('subdomain.www.domain.tdl');
        $this->assertSame('www.domain.tdl', $domainParsed['domain']);
        $this->assertSame('subdomain', $domainParsed['subdomain']);

        $domainParsed = $parser->parse('test.subdomain.www.domain.tdl');
        $this->assertSame('subdomain.www.domain.tdl', $domainParsed['domain']);
        $this->assertSame('test', $domainParsed['subdomain']);
    }
}
