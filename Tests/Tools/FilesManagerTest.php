<?php

namespace Wandi\ToolsBundle\Tests\Tools;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\FilesManager;

class FilesManagerTest extends TestCase
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
        $fm = new FilesManager();
        $this->assertSame(true, $fm->isDirectory($directory));
        $this->assertSame(true, $fm->isFile($file));
        $fm->removeDirectory($directory);
        $this->assertSame(false, $fm->isDirectory($directory));
        $this->assertSame(false, $fm->isDirectory($subDirectory));
        $this->assertSame(false, $fm->isFile($file));
    }
}
