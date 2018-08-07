<?php

namespace Wandi\ToolsBundle\Tools;

class Sharer
{
    /**
     * Get mailto url.
     *
     * @param string $url
     * @param string $subject
     * @param string $email
     *
     * @return string
     */
    public function getMail(string $url, string $subject, string $email): string
    {
        $subjectEncoded = urlencode($subject);
        $urlEncoded = urlencode($url);

        return "mailto:$email?&subject=$subjectEncoded&body=$urlEncoded";
    }

    /**
     * Get facebook share url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getFacebook(string $url): string
    {
        $urlEncoded = urlencode($url);

        return "https://www.facebook.com/sharer/sharer.php?u=$urlEncoded";
    }

    /**
     * Get twitter share url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getTwitter(string $url): string
    {
        $urlEncoded = urlencode($url);

        return "https://twitter.com/share?url=$urlEncoded";
    }

    /**
     * Get google plus share url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getGooglePlus(string $url): string
    {
        $urlEncoded = urlencode($url);

        return "https://plus.google.com/share?url=$urlEncoded";
    }

    /**
     * Get linked in share url.
     *
     * @param string $url
     * @param string $title
     *
     * @return string
     */
    public function getLinkedIn(string $url, string $title): string
    {
        $titleEncoded = urlencode($title);
        $urlEncoded = urlencode($url);

        return "https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded";
    }

    /**
     * Get pinterest share url.
     *
     * @param string $url
     * @param string $title
     *
     * @return string
     */
    public function getPinterest(string $url, string $title): string
    {
        $titleEncoded = urlencode($title);
        $urlEncoded = urlencode($url);

        return "https://pinterest.com/pin/create/button/?url=$urlEncoded&description=$titleEncoded";
    }
}
