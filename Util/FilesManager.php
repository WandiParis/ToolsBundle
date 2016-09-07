<?php

namespace Wandi\ToolsBundle\Util;

class FilesManager
{
    public function deleteDirectory($target)
    {
        if (is_dir($target)) {
            $files = glob($target.'*', GLOB_MARK);
            foreach ($files as $file) {
                $this->deleteDirectory($file);
            }
            @rmdir($target);
        } elseif (is_file($target)) {
            @unlink($target);
        }
    }
}
