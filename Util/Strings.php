<?php

namespace Wandi\ToolsBundle\Util;

class Strings
{
    /**
     * @param string $haystack
     * @param int $length
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
     *
     * @param string $replace
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
     * @return string
     */
    public static function normalize($string)
    {
        $table = [
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
        ];

        return strtr($string, $table);
    }
}
