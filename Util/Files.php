<?php

namespace Wandi\ToolsBundle\Util;

use Mimey\MimeTypes;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * Delete directory.
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

    /**
     * @param string $path
     *
     * @return UploadedFile
     */
    public static function getUploadedFile(string $path): ?UploadedFile
    {
        $mimes = new MimeTypes();
        $pathinfo = pathinfo($path);

        $basename = Strings::substrBeforeLastDelimiter($pathinfo['basename'], '.');
        $extension = $pathinfo['extension'] ?? null;

        if (null === $extension && ((false === copy($path, $tmpPath = sys_get_temp_dir().'/'.uniqid())) || (false === $extension = $mimes->getExtension(mime_content_type($tmpPath))))) {
            return null;
        }

        if (null !== $extension) {
            // path width extension
            $tmpPath = $tmpPath = sys_get_temp_dir().'/'.uniqid().'.'.$extension;
            if (false === copy($path, $tmpPath)) {
                return null;
            }
        } else {
            // path without extension
            $tmpPath = $tmpPath = sys_get_temp_dir().'/'.uniqid();
            if (false === copy($path, $tmpPath) || false === $extension = $mimes->getExtension(mime_content_type($tmpPath))) {
                return null;
            }

            $oldTmpPath = $tmpPath;
            $tmpPath .= '.'.$extension;

            if (false === rename($oldTmpPath, $tmpPath)) {
                return null;
            }
        }

        return new UploadedFile($tmpPath, $pathinfo['basename'], null, null, true);
    }

    /**
     * @param array      $paths
     * @param array|null $extensions
     *
     * @return null|UploadedFile
     */
    public static function getRandomUploadedFile(array $paths, array $extensions = null): ?UploadedFile
    {
        $finder = new Finder();
        $finder->in($paths);

        if (null !== $extensions) {
            $regex = '/('.implode('|', $extensions).')/i';
            $finder->name($regex);
        }

        $files = [];
        foreach ($finder->files() as $file) {
            /* @var SplFileInfo $file */
            $files[] = $file->getPathname();
        }

        if (empty($files)) {
            return null;
        }

        return self::getUploadedFile(Arrays::getRandom($files));
    }
}
