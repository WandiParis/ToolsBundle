<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Wandi\ToolsBundle\Tools\Format;
use Wandi\ToolsBundle\Tools\Str;

class ToolsExtension extends \Twig_Extension
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
            new Twig_SimpleFilter('slug', [$this, 'slug']),
            new Twig_SimpleFilter('price_format', [$this, 'priceFormat'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('card_number_format', [$this, 'cardNumberFormat']),
            new Twig_SimpleFilter('percentage_format', [$this, 'percentageFormat']),
            new Twig_SimpleFilter('weight_format', [$this, 'weightFormat']),
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

    public function priceFormat($str, $strong = false, $currency = true)
    {
        return $this->format->priceFormat($str, $strong, $currency);
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
}
