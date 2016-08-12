<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Symfony\Component\Form\FormView;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use Wandi\ToolsBundle\Util\Form;
use Wandi\ToolsBundle\Util\Str;

class VariousExtension extends Twig_Extension
{
    protected $str;
    protected $form;

    public function __construct(Str $str, Form $form)
    {
        $this->str = $str;
        $this->form = $form;
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter("slug", array($this, "slug")),
            new Twig_SimpleFilter("small", array($this, "small")),
            new Twig_SimpleFilter("ckeditor", array($this, "ckeditor")),
        );
    }

    public function slug($str)
    {
        return $this->str->slug($str);
    }

    public function small($str, $length = 140)
    {
        return $this->str->substrToLength($str, $length);
    }

    public function ckeditor($str, $boPath = 'admin')
    {
        return str_replace('"/Public/', '"/'.$boPath.'/Public/', $str);
    }

    public function getName()
    {
        return 'wandi.twig.extension.various';
    }
}
