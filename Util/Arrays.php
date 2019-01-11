<?php

namespace Wandi\ToolsBundle\Util;

class Arrays
{
    /**
     * @param array    $array
     * @param int      $min
     * @param int|null $max
     *
     * @return array|null
     */
    public static function getRandomSubArray(array $array, int $min = 0, int $max = null): ?array
    {
        $count = \count($array);
        $max = $max ?? $count;

        if ($min < 0 || $max > $count) {
            throw new \InvalidArgumentException();
        }

        if (0 === $rand = rand($min, $max)) {
            return [];
        }

        $randomIndexes = array_rand($array, $rand);
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
