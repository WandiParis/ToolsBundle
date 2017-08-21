<?php

namespace Wandi\ToolsBundle\Tools;

class FilesManager
{
    /** Is file
     * @param string $path
     *
     * @return bool
     */
    public function isFile(string $path): bool
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
    public function isDirectory(string $path): bool
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
    public function removeDirectory(string $target): bool
    {
        if ($this->isDirectory($target)) {
            $files = glob($target.'*', GLOB_MARK);
            foreach ($files as $file) {
                $this->removeDirectory($file);
            }
            @rmdir($target);
        } elseif ($this->isFile($target)) {
            @unlink($target);
        }

        return true;
    }
}
