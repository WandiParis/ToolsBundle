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
            $pos = mb_strrpos($result, ' ', 0, 'utf-8');
            $result = mb_substr($result, 0, is_int($pos) ? $pos : null, 'utf-8');
        }

        if (true === $hasMore) {
            $result .= $more;
        }

        return $result;
    }

    /**
     * @param string $haystack
     * @param string $replace
     *
     * @return string
     */
    public static function slug(string $haystack, string $replace = '-'): ?string
    {
        $haystack = htmlentities($haystack, ENT_NOQUOTES, 'utf-8');
        $haystack = preg_replace(
            '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#',
            '\1',
            $haystack
        );

        if (null !== $haystack) {
            $haystack = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $haystack);
        }

        if (null !== $haystack) {
            $haystack = preg_replace('#&[^;]+;#', '', $haystack);
        }

        if (null !== $haystack) {
            $haystack = preg_replace('/[^a-z0-9]+/', $replace, strtolower($haystack));
        }

        return null !== $haystack ? trim($haystack, $replace) : null;
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

        if (false === $exploded || 0 === \count($exploded)) {
            return $haystack;
        }

        return $exploded[0];
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

        if (false === $exploded) {
            return $haystack;
        }

        return implode($delimiter, array_slice($exploded, 0, max(1, \count($exploded) - 1)));
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

        if (false === $exploded) {
            return $haystack;
        }

        return $exploded[\count($exploded) - 1];
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

        if (false === $exploded) {
            return $haystack;
        }

        $count = \count($exploded);

        return implode($delimiter, array_slice($exploded, 1 === $count ? 0 : 1, max(1, $count - 1)));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        $length = mb_strlen($needle, 'utf-8');

        return mb_substr($haystack, 0, $length, 'utf-8') === $needle;
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        $length = mb_strlen($needle, 'utf-8');
        if (0 == $length) {
            return true;
        }

        return mb_substr($haystack, -$length, null, 'utf-8') === $needle;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function normalize(string $string): string
    {
        $search = ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'];
        $replace = ['A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'];

        return str_replace($search, $replace, $string);
    }
}
