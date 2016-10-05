<?php

namespace Wandi\ToolsBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
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
            new Twig_SimpleFilter("slug", [$this, "slug"]),
            new Twig_SimpleFilter("small", [$this, "small"]),
            new Twig_SimpleFilter("ckeditor", [$this, "ckeditor"]),
            new Twig_SimpleFilter('html', [$this, 'html'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('price_format', [$this, 'priceFormat'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('card_number_format', [$this, 'cardNumberFormat'])
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

    public function html($html)
    {
        return $html;
    }

    public function priceFormat($str)
    {
        $exploded = explode('.', number_format($str, 2));
        $integer = $exploded[0];
        $decimal = $exploded[1];

        $formatted = '<b>'.$integer.'</b>';
        if($decimal != '00'){
            $formatted .= ',' . $decimal;
        }

        return $formatted.' €';
    }

    public function cardNumberFormat($str)
    {
        return implode(' ', str_split($str, 4));
    }

    public function getName()
    {
        return 'wandi.twig.extension.various';
    }
}
