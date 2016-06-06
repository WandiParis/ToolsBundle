<?php
namespace Wandi\ToolsBundle\Services;

class Str
{
    public static function trimStringToLength($str, $length, $more = '...')
    {
        $hasMore = false;

        if(!empty($more)){
            $hasMore = true;
            $length -= strlen($more);
        }

        $trimmed = $str;
        if (strlen($trimmed) > $length) {
            $trimmed = mb_substr($trimmed, 0, strrpos(substr($trimmed, 0, $length), ' '), 'UTF-8');
            if ($hasMore === true) {
                $trimmed .= $more;
            }
        }

        return $trimmed;
    }

    public function slugify($str, $charset = 'utf-8')
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
        $stringExploded = explode($delimiter, $string);

        if (count($stringExploded) > 0) {
            return $stringExploded[0];
        } else {
            return $string;
        }
    }

    public function substrBeforeLastDelimiter($string, $delimiter)
    {
        $stringExploded = explode($delimiter, $string);
        $newString = "";

        if (count($stringExploded) > 0) {
            for ($i = 0; $i < $count = (count($stringExploded) - 1); $i++) {
                $newString .= $stringExploded[$i];
                if ($i < $count - 1) {
                    $newString .= $delimiter;
                }
            }
            return $newString;
        } else {
            return $string;
        }
    }

    public function substrAfterLastDelimiter($string, $delimiter)
    {
        $stringExploded = explode($delimiter, $string);

        if (count($stringExploded) > 0) {
            return $stringExploded[count($stringExploded) - 1];
        } else {
            return $string;
        }
    }

    public function substrAfterFirstDelimiter($string, $delimiter)
    {
        $stringExploded = explode($delimiter, $string);
        $newString = "";

        if (count($stringExploded) > 0) {
            for ($i = 1; $i < $count = count($stringExploded); $i++) {
                $newString .= $stringExploded[$i];
                if ($i < $count - 1) {
                    $newString .= $delimiter;
                }
            }
            return $newString;
        } else {
            return $string;
        }
    }
}

?>