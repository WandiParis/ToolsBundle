<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Wandi\ToolsBundle\Util\Sharer;

class SharerTest extends TestCase
{
    public function testGetUrls()
    {
        $title = 'Lorem ipsum dolor sit amet';
        $url = 'https://subdomain.domain.tdl/lorem-ipsum?dolor=set';
        $email = 'mail@domain.tdl';
        $summary = 'Ut aliquam ultricies mi';
        $source = 'Aliquam arcu magna';
        $description = 'Nullam commodo auctor orci non pulvinar';

        $titleEncoded = urlencode($title);
        $urlEncoded = urlencode($url);
        $summaryEncoded = urlencode($summary);
        $sourceEncoded = urlencode($source);
        $descriptionEncoded = urlencode($description);

        $this->assertSame("mailto:$email?&subject=$titleEncoded&body=$urlEncoded", Sharer::getMail($url, $title, $email));
        $this->assertSame("https://www.facebook.com/sharer/sharer.php?u=$urlEncoded", Sharer::getFacebook($url));
        $this->assertSame("https://twitter.com/home?status=$urlEncoded", Sharer::getTwitter($url));
        $this->assertSame("https://plus.google.com/share?url=$urlEncoded", Sharer::getGooglePlus($url));
        $this->assertSame("https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded&summary=$summaryEncoded&source=$sourceEncoded", Sharer::getLinkedIn($url, $title, $summary, $source));
        $this->assertSame("https://pinterest.com/pin/create/button/?url=$urlEncoded&media=$sourceEncoded&description=$descriptionEncoded", Sharer::getPinterest($url, $source, $description));
    }
}
