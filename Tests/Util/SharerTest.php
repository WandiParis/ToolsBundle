<?php

namespace Wandi\ToolsBundle\Tests\Util;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Util\Sharer;

class SharerTest extends TestCase
{
    public function testGetUrls()
    {
        $title = 'Lorem ipsum';
        $url = 'https://subdomain.domain.tdl/lorem-ipsum?dolor=set';
        $email = 'mail@domain.tdl';

        $titleEncoded = 'Lorem+ipsum';
        $urlEncoded = 'https%3A%2F%2Fsubdomain.domain.tdl%2Florem-ipsum%3Fdolor%3Dset';

        $this->assertSame("mailto:$email?&subject=$titleEncoded&body=$urlEncoded", Sharer::getMail($url, $title, $email));
        $this->assertSame("https://www.facebook.com/sharer/sharer.php?u=$urlEncoded", Sharer::getFacebook($url));
        $this->assertSame("https://twitter.com/share?url=$urlEncoded", Sharer::getTwitter($url));
        $this->assertSame("https://plus.google.com/share?url=$urlEncoded", Sharer::getGooglePlus($url));
        $this->assertSame("https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded", Sharer::getLinkedIn($url, $title));
        $this->assertSame("https://pinterest.com/pin/create/button/?url=$urlEncoded&description=$titleEncoded", Sharer::getPinterest($url, $title));
    }
}
