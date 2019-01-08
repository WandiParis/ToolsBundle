<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Wandi\ToolsBundle\Util\HostParser;

class HostParserTest extends TestCase
{
    public function testParse()
    {
        $domainParsed = HostParser::parse('domain.tdl');
        $this->assertInternalType('array', $domainParsed);
        $this->assertArrayHasKey('domain', $domainParsed);
        $this->assertArrayHasKey('subdomain', $domainParsed);
        $this->assertSame('domain.tdl', $domainParsed['domain']);
        $this->assertSame('', $domainParsed['subdomain']);

        $domainParsed = HostParser::parse('www.domain.tdl');
        $this->assertSame('domain.tdl', $domainParsed['domain']);
        $this->assertSame('www', $domainParsed['subdomain']);

        $domainParsed = HostParser::parse('subdomain.www.domain.tdl');
        $this->assertSame('www.domain.tdl', $domainParsed['domain']);
        $this->assertSame('subdomain', $domainParsed['subdomain']);

        $domainParsed = HostParser::parse('test.subdomain.www.domain.tdl');
        $this->assertSame('subdomain.www.domain.tdl', $domainParsed['domain']);
        $this->assertSame('test', $domainParsed['subdomain']);
    }
}
