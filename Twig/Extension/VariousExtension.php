<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use \Twig_Extension;
use Twig_SimpleFilter;
use Wandi\ToolsBundle\Services\Str;

class VariousExtension extends Twig_Extension
{
    protected $container;
    protected $str;

    public function __construct(ContainerInterface $container, Str $str)
    {
        $this->container = $container;
        $this->str = $str;
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter("slugify", array($this, "slugify")),
            new Twig_SimpleFilter("smallify", array($this, "smallify")),
            new Twig_SimpleFilter("ckeditor", array($this, "ckeditor")),
        );
    }

    public function slugify($str)
    {
        return $this->str->slugify($str);
    }

    public function smallify($str, $length = 140)
    {
        return $this->str->trimStringToLength($str, $length);
    }

    public function ckeditor($str, $boPath = 'admin')
    {
        return str_replace('"/Public/', '"/' . $boPath . '/Public/', $str);
    }

    public function getName()
    {
        return 'wandi.extension.str';
    }
}