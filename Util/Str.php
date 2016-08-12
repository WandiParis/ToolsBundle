<?php
namespace Wandi\ToolsBundle\Util;

class Str
{
    public static function substrToLength($str, $length, $more = '...')
    {
        $strLength = mb_strlen($str, 'utf-8');
        if($strLength <= $length){
            return $str;
        }

        $hasMore = false;
        if(!empty($more)){
            $hasMore = true;
            $length -= mb_strlen($more, 'utf-8');
        }

        $result = mb_substr($str, 0, $length, 'utf-8');

        if(preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ]*$/i', $str[$length])){
            $result = mb_substr($result, 0, mb_strrpos($result, ' ', 'utf-8'), 'utf-8');
        }

        if ($hasMore === true) {
            $result .= $more;
        }

        return $result;
    }

    public function slug($str, $charset = 'utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        $str = preg_replace('#&[^;]+;#', '', $str);
        $str = preg_replace('/[^a-z0-9]+/', '-', strtolower($str));
        return trim($str, '-');
    }

    public function substrBeforeFirstDelimiter($string, $delimiter)
    {
        $exploded = explode($delimiter, $string);
        if (count($exploded) > 0) {
            return $exploded[0];
        }
        return $string;
    }

    public function substrBeforeLastDelimiter($string, $delimiter)
    {
        $exploded = explode($delimiter, $string);
        return implode($delimiter, array_slice($exploded, 0, max(1, count($exploded) -1)));
    }

    public function substrAfterLastDelimiter($string, $delimiter)
    {
        $exploded = explode($delimiter, $string);
        return $exploded[count($exploded) - 1];
    }

    public function substrAfterFirstDelimiter($string, $delimiter)
    {
        $exploded = explode($delimiter, $string);
        $count = count($exploded);
        return implode($delimiter, array_slice($exploded, $count === 1 ? 0 : 1, max(1, $count -1)));
    }
}
