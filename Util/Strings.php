<?php

namespace Wandi\ToolsBundle\Util;

class Strings
{
    /**
     * @param string $haystack
     * @param int    $length
     * @param string $more
     *
     * @return string
     */
    public static function substrToLength(string $haystack, int $length, string $more = '...'): string
    {
        $haystackLength = mb_strlen($haystack, 'utf-8');
        if ($haystackLength <= $length) {
            return $haystack;
        }

        $hasMore = false;
        if (!empty($more)) {
            $hasMore = true;
            $length -= mb_strlen($more, 'utf-8');
        }

        $result = mb_substr($haystack, 0, $length, 'utf-8');

        if (preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ]*$/i', $haystack[$length])) {
            $result = mb_substr($result, 0, mb_strrpos($result, ' ', 'utf-8'), 'utf-8');
        }

        if (true === $hasMore) {
            $result .= $more;
        }

        return $result;
    }

    /**
     * @param string $haystack
     *
     * @return string
     */
    public static function slug(string $haystack): string
    {
        $haystack = htmlentities($haystack, ENT_NOQUOTES, 'utf-8');
        $haystack = preg_replace(
            '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#',
            '\1',
            $haystack
        );
        $haystack = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $haystack);
        $haystack = preg_replace('#&[^;]+;#', '', $haystack);
        $haystack = preg_replace('/[^a-z0-9]+/', '-', strtolower($haystack));

        return trim($haystack, '-');
    }

    /**
     * @param string $haystack
     * @param string $delimiter
     *
     * @return string
     */
    public static function substrBeforeFirstDelimiter(string $haystack, string $delimiter): string
    {
        $exploded = explode($delimiter, $haystack);
        if (count($exploded) > 0) {
            return $exploded[0];
        }

        return $haystack;
    }

    /**
     * @param string $haystack
     * @param string $delimiter
     *
     * @return string
     */
    public static function substrBeforeLastDelimiter(string $haystack, string $delimiter): string
    {
        $exploded = explode($delimiter, $haystack);

        return implode($delimiter, array_slice($exploded, 0, max(1, count($exploded) - 1)));
    }

    /**
     * @param string $haystack
     * @param string $delimiter
     *
     * @return string
     */
    public static function substrAfterLastDelimiter(string $haystack, string $delimiter): string
    {
        $exploded = explode($delimiter, $haystack);

        return $exploded[count($exploded) - 1];
    }

    /**
     * @param string $haystack
     * @param string $delimiter
     *
     * @return string
     */
    public static function substrAfterFirstDelimiter(string $haystack, string $delimiter): string
    {
        $exploded = explode($delimiter, $haystack);
        $count = count($exploded);

        return implode($delimiter, array_slice($exploded, 1 === $count ? 0 : 1, max(1, $count - 1)));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return string
     */
    public static function startsWith(string $haystack, string $needle): string
    {
        $length = mb_strlen($needle, 'utf-8');

        return mb_substr($haystack, 0, $length, 'utf-8') === $needle;
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return string
     */
    public static function endsWith(string $haystack, string $needle): string
    {
        $length = mb_strlen($needle, 'utf-8');
        if (0 == $length) {
            return true;
        }

        return mb_substr($haystack, -$length, null, 'utf-8') === $needle;
    }
}
