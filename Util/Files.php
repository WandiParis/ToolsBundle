<?php

namespace Wandi\ToolsBundle\Util;

class Files
{
    /** Is file
     * @param string $path
     *
     * @return bool
     */
    public static function isFile(string $path): bool
    {
        return is_file($path);
    }

    /**
     * Is directory.
     *
     * @param string $path
     *
     * @return bool
     */
    public static function isDirectory(string $path): bool
    {
        return is_dir($path);
    }

    /**
     * Remove directory.
     *
     * @param string $target
     *
     * @return bool
     */
    public static function deleteDirectory(string $target): bool
    {
        if (self::isDirectory($target)) {
            $files = glob($target.'*', GLOB_MARK);
            foreach ($files as $file) {
                self::deleteDirectory($file);
            }
            @rmdir($target);
        } elseif (self::isFile($target)) {
            @unlink($target);
        }

        return true;
    }
}
