<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Wandi\ToolsBundle\Util\Form;
use Wandi\ToolsBundle\Util\Format;
use Wandi\ToolsBundle\Util\Str;

class VariousExtension extends Twig_Extension
{
    protected $str;
    protected $format;
    protected $form;

    public function __construct(Str $str, Format $format)
    {
        $this->str = $str;
        $this->format = $format;
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter("slug", [$this, "slug"]),
            new Twig_SimpleFilter("small", [$this, "small"]),
            new Twig_SimpleFilter("ckeditor", [$this, "ckeditor"]),
            new Twig_SimpleFilter('html', [$this, 'html'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('price_format', [$this, 'priceFormat'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('card_number_format', [$this, 'cardNumberFormat']),
            new Twig_SimpleFilter('percentage_format', [$this, 'percentageFormat']),
            new Twig_SimpleFilter('weight_format', [$this, 'weightFormat']),
            new Twig_SimpleFilter('start_replace', [$this, 'startReplace']),
        );
    }

    public function getName()
    {
        return 'wandi.twig.extension.various';
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

    public function html($html)
    {
        return $html;
    }

    public function priceFormat($str, $strong = false)
    {
        return $this->format->priceFormat($str, $strong);
    }

    public function cardNumberFormat($str)
    {
        return $this->format->cardNumberFormat($str);
    }

    public function percentageFormat($str)
    {
        return $this->format->percentageFormat($str);
    }

    public function weightFormat($str)
    {
        return $this->format->weightFormat($str);
    }

    public function startReplace($str, $needle)
    {
        return $this->str->startReplace($str, $needle);
    }
}
