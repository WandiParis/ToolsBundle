<?php

namespace Wandi\ToolsBundle\Util;

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
    public static function getMail(string $url, string $subject, string $email): string
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
    public static function getFacebook(string $url): string
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
    public static function getTwitter(string $url): string
    {
        $urlEncoded = urlencode($url);

        return "https://twitter.com/home?status=$urlEncoded";
    }

    /**
     * Get google plus share url.
     *
     * @param string $url
     *
     * @return string
     */
    public static function getGooglePlus(string $url): string
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
    public static function getLinkedIn(string $url, string $title, string $summary = "", string $source = ""): string
    {
        $titleEncoded = urlencode($title);
        $urlEncoded = urlencode($url);
        $summaryEncoded = urlencode($summary);
        $sourceEncoded = urlencode($source);

        return "https://www.linkedin.com/shareArticle?mini=true&url=$urlEncoded&title=$titleEncoded&summary=$summaryEncoded&source=$sourceEncoded";
    }

    /**
     * Get pinterest share url.
     *
     * @param string $url
     * @param string $title
     *
     * @return string
     */
    public static function getPinterest(string $url, string $source, string $description = ""): string
    {
        $sourceEncoded = urlencode($source);
        $urlEncoded = urlencode($url);
        $descriptionEncoded = urlencode($description);

        return "https://pinterest.com/pin/create/button/?url=$urlEncoded&media=$sourceEncoded&description=$descriptionEncoded";
    }
}
