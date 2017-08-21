<?php

namespace Wandi\ToolsBundle\Tests\Tools;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\Sharer;

class SharerTest extends TestCase
{
    public function testGetUrls()
    {
        $sharer = new Sharer();

        $title = 'Lorem ipsum';
        $url = 'https://subdomain.domain.tdl/lorem-ipsum?dolor=set';
        $email = 'mail@domain.tdl';

        $titleEncoded = 'Lorem+ipsum';
        $urlEncoded = 'https%3A%2F%2Fsubdomain.domain.tdl%2Florem-ipsum%3Fdolor%3Dset';

        $this->assertSame("mailto:$email?&subject=$titleEncoded&body=$urlEncoded", $sharer->getMail($url, $title, $email));
        $this->assertSame("https://www.facebook.com/sharer/sharer.php?u=$urlEncoded", $sharer->getFacebook($url));
        $this->assertSame("https://twitter.com/share?url=$urlEncoded", $sharer->getTwitter($url));
        $this->assertSame("https://plus.google.com/share?url=$urlEncoded", $sharer->getGooglePlus($url));
        $this->assertSame("https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded", $sharer->getLinkedIn($url, $title));
        $this->assertSame("https://pinterest.com/pin/create/button/?url=$urlEncoded&description=$titleEncoded", $sharer->getPinterest($url, $title));
    }
}
