<?php

namespace Wandi\ToolsBundle\Util;

class Sharer
{
    public function getUrls($url, $title, $email = '')
    {
        $urlEncoded = urlencode($url);
        $titleEncoded = urlencode($title);

        return [
            'mail' => "mailto:$email?&subject=$title&body=$urlEncoded",
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$urlEncoded",
            'twitter' => "https://twitter.com/home?status=$urlEncoded",
            'google_plus' => "https://plus.google.com/share?url=$urlEncoded",
            'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded",
            'pinterest' => "https://pinterest.com/pin/create/button/?url=$urlEncoded&description=$titleEncoded",
        ];
    }
}
