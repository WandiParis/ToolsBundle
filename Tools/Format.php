<?php

namespace Wandi\ToolsBundle\Tools;

class Format
{
    private $str;

    /**
     * Format constructor.
     *
     * @param Str $str
     */
    public function __construct(Str $str)
    {
        $this->str = $str;
    }

    /**
     * Format a weight.
     *
     * @param int    $value
     * @param int    $nbDecimals
     * @param string $decSep
     * @param string $thousandsSep
     * @param string $unit
     * @param string $kunit
     * @param string $separator
     *
     * @return string
     */
    public function weightFormat(
        int $value,
        int $nbDecimals = 3,
        string $decSep = '.',
        string $thousandsSep = ',',
        string $unit = 'g',
        string $kunit = 'Kg',
        string $separator = ''
    ) {
        if ($value >= 1000) {
            $unit = $kunit;
            $value /= 1000;
        }

        $formatted = number_format($value, $nbDecimals, $decSep, $thousandsSep);

        $integerPart = $this->str->substrBeforeLastDelimiter($formatted, $decSep);
        $decimalsPart = $this->str->substrAfterLastDelimiter($formatted, $decSep);

        $formatted = $integerPart;
        if (intval($decimalsPart)) {
            $formatted .= $decSep.$decimalsPart;
        }

        return $formatted.$separator.trim($unit);
    }

    /**
     * Format a price.
     *
     * @param float       $value
     * @param int         $nbDecimals
     * @param string      $decSep
     * @param string      $thousandsSep
     * @param null|string $symbol
     * @param string      $separator
     *
     * @return string
     */
    public function priceFormat(
        float $value,
        int $nbDecimals = 2,
        string $decSep = '.',
        string $thousandsSep = ',',
        ?string $symbol = null,
        string $separator = ''
    ): string {
        $formatted = number_format($value, $nbDecimals, $decSep, $thousandsSep);

        $integerPart = $this->str->substrBeforeLastDelimiter($formatted, $decSep);
        $decimalsPart = $this->str->substrAfterLastDelimiter($formatted, $decSep);

        $formatted = $integerPart;
        if (intval($decimalsPart)) {
            $formatted .= $decSep.$decimalsPart;
        }

        if ($symbol) {
            $formatted .= $separator.trim($symbol);
        }

        return $formatted;
    }

    /**
     * Format a card number.
     *
     * @param int    $value
     * @param string $separator
     *
     * @return string
     */
    public function cardNumberFormat(int $value, string $separator = ' ')
    {
        return implode($separator, str_split($value, 4));
    }

    /**
     * Format a percentage.
     *
     * @param float       $value
     * @param int         $nbDecimals
     * @param string      $decSep
     * @param string      $thousandsSep
     * @param null|string $symbol
     * @param string      $separator
     *
     * @return string
     */
    public function percentageFormat(
        float $value,
        int $nbDecimals = 2,
        string $decSep = '.',
        string $thousandsSep = ',',
        ?string $symbol = '%',
        string $separator = ''
    ): string {
        $formatted = number_format($value * 100, $nbDecimals, $decSep, $thousandsSep);

        $integerPart = $this->str->substrBeforeLastDelimiter($formatted, $decSep);
        $decimalsPart = $this->str->substrAfterLastDelimiter($formatted, $decSep);

        $formatted = $integerPart;
        if (intval($decimalsPart)) {
            $formatted .= $decSep.$decimalsPart;
        }

        if ($symbol) {
            $formatted .= $separator.trim($symbol);
        }

        return $formatted;
    }
}
