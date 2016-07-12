<?php

namespace Wandi\ToolsBundle\Tests\Services;

use Wandi\ToolsBundle\Services\HostParser;

class HostParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse(){
        $parser = new HostParser();

        $domainParsed = $parser->parse('domain.tdl');
        $this->assertEquals('domain.tdl', $domainParsed['domain']);
        $this->assertEquals(null, $domainParsed['subdomain']);

        $domainParsed = $parser->parse('www.domain.tdl');
        $this->assertEquals('domain.tdl', $domainParsed['domain']);
        $this->assertEquals('www', $domainParsed['subdomain']);

        $domainParsed = $parser->parse('subdomain.subdomain.domain.tdl');
        $this->assertEquals('domain.tdl', $domainParsed['domain']);
        $this->assertEquals('subdomain.subdomain', $domainParsed['subdomain']);
    }
}