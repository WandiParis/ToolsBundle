<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Twig_SimpleFilter;

class ToolsExtension extends \Twig_Extension
{
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
        return Strings::slug($str);
    }

    public function priceFormat($str, $strong = false, $currency = true)
    {
        return Formatter::priceFormat($str, $strong, $currency);
    }

    public function cardNumberFormat($str)
    {
        return Formatter::cardNumberFormat($str);
    }

    public function percentageFormat($str)
    {
        return Formatter::percentageFormat($str);
    }

    public function weightFormat($str)
    {
        return Formatter::weightFormat($str);
    }
}
