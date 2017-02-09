<?php
namespace Wandi\ToolsBundle\Util;

class Format
{
    public function weightFormat($value){
        $value = intval($value);
        $unit = 'g';

        if($value >= 1000){
            $unit = 'Kg';
            $value /= 1000;
            $exploded = explode('.', number_format($value, 3, '.', ''));
            $integer = $exploded[0];
            $decimal = $exploded[1];

            $value = $integer;
            if ($decimal != '000') {
                $value .= ','.$decimal;
            }
        }

        return $value.$unit;
    }

    public function priceFormat($value, $strong = false, $currency = true)
    {
        $exploded = explode('.', number_format($value, 2, '.', ''));

        $integer = $exploded[0];
        $decimal = $exploded[1];

        if ($strong) {
            $formatted = '<b>'.$integer.'</b>';
        } else {
            $formatted = $integer;
        }

        if ($decimal != '00') {
            $formatted .= ','.$decimal;
        }

        if($currency){
            $formatted .= '€';
        }

        return $formatted;
    }

    public function cardNumberFormat($value)
    {
        return implode(' ', str_split($value, 4));
    }

    public function percentageFormat($value)
    {
        $exploded = explode('.', number_format($value, 2, '.', ''));
        $integer = $exploded[0];
        $decimal = $exploded[1];

        $formatted = $integer;
        if ($decimal != '00') {
            $formatted .= ','.$decimal;
        }

        return $formatted.'%';
    }
}
