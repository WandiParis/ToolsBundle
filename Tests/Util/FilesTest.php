<?php

namespace Wandi\ToolsBundle\Tests\Util;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Util\Files;

class FilesTest extends TestCase
{
    public function testDeleteDirectory()
    {
        // params
        $directory = sys_get_temp_dir().'/'.uniqid();
        $subDirectory = $directory.'/'.uniqid();
        $file = $directory.'/lorem.txt';

        // set up
        mkdir($directory);
        mkdir($subDirectory);
        $fp = fopen($file, 'w');
        fwrite($fp, 'lorem');
        fclose($fp);

        // tests
        $this->assertSame(true, Files::isDirectory($directory));
        $this->assertSame(true, Files::isFile($file));
        Files::deleteDirectory($directory);
        $this->assertSame(false, Files::isDirectory($directory));
        $this->assertSame(false, Files::isDirectory($subDirectory));
        $this->assertSame(false, Files::isFile($file));
    }
}
