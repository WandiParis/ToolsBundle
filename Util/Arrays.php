<?php

namespace Wandi\ToolsBundle\Util;

class Arrays
{
    /**
     * @param array    $elements
     * @param int|null $min
     * @param int|null $max
     *
     * @return array
     */
    public static function getRandSubArray(array $array, int $min = null, int $max = null): ?array
    {
        $count = \count($array);

        if (null === $min) {
            $min = 0;
        }

        if (null === $max || $max > $count) {
            $max = $count;
        }

        $randomIndexes = array_rand($array, rand($min, $max));
        $randomIndexes = is_array($randomIndexes) ? $randomIndexes : [$randomIndexes];

        return array_intersect_key($array, array_flip($randomIndexes));
    }

    /**
     * @param array $array
     *
     * @return mixed
     */
    public static function getRandom(array $array)
    {
        return empty($array) ? null : $array[array_rand($array)];
    }
}
