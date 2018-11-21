<?php

namespace Wandi\ToolsBundle\Tests\Util;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Util\Formatter;

class FormatterTest extends TestCase
{
    public function testWeightFormat()
    {
        $this->assertSame('1g', Formatter::weightFormat(1));
        $this->assertSame('100g', Formatter::weightFormat(100));
        $this->assertSame('999g', Formatter::weightFormat(999));
        $this->assertSame('999g', Formatter::weightFormat(999, 2));
        $this->assertSame('1Kg', Formatter::weightFormat(1000));
        $this->assertSame('1.100Kg', Formatter::weightFormat(1100));
        $this->assertSame('1.10Kg', Formatter::weightFormat(1100, 2));
        $this->assertSame('1,100Kg', Formatter::weightFormat(1100, 3, ','));
        $this->assertSame('1,000Kg', Formatter::weightFormat(1000000, 3, '.'));
        $this->assertSame('1,000.100Kg', Formatter::weightFormat(1000100, 3, '.'));
        $this->assertSame('1000.100Kg', Formatter::weightFormat(1000100, 3, '.', ''));
        $this->assertSame('1000.100Kilograms', Formatter::weightFormat(1000100, 3, '.', '', 'Grams', 'Kilograms'));
        $this->assertSame('1000.100 Kilograms', Formatter::weightFormat(1000100, 3, '.', '', 'Grams', 'Kilograms', ' '));
    }

    /*public function testPriceFormat()
    {
        $this->assertSame('0', Formatter::priceFormat(0));
        $this->assertSame('0', Formatter::priceFormat(0, 3));
        $this->assertSame('1.50', Formatter::priceFormat(1.5));
        $this->assertSame('1.5', Formatter::priceFormat(1.5, 1));
        $this->assertSame('1.500', Formatter::priceFormat(1.5, 3));
        $this->assertSame('1,50', Formatter::priceFormat(1.5, 2, ','));
        $this->assertSame('1 000', Formatter::priceFormat(1000, 3, ',', ' '));
        $this->assertSame('1 000,50', Formatter::priceFormat(1000.5, 2, ',', ' '));
        $this->assertSame('1 000,50€', Formatter::priceFormat(1000.5, 2, ',', ' ', '€'));
        $this->assertSame('1000,50€', Formatter::priceFormat(1000.5, 2, ',', '', '€'));
        $this->assertSame('1 000,50$', Formatter::priceFormat(1000.5, 2, ',', ' ', ' $'));
        $this->assertSame('1 000,50 $', Formatter::priceFormat(1000.5, 2, ',', ' ', ' $', ' '));
        $this->assertSame('1 000,50', Formatter::priceFormat(1000.5, 2, ',', ' ', null, ' '));
    }

    public function testCardNumberFormat()
    {
        $this->assertSame('1234 1234 1234 1234', Formatter::cardNumberFormat('1234123412341234'));
        $this->assertSame('1234 1234 1234 123', Formatter::cardNumberFormat('123412341234123'));
        $this->assertSame('1234-1234-1234-123', Formatter::cardNumberFormat('123412341234123', '-'));
    }

    public function testPercentageFormat()
    {
        $this->assertSame('1%', Formatter::percentageFormat(0.01));
        $this->assertSame('1%', Formatter::percentageFormat(0.01, 3));
        $this->assertSame('1%', Formatter::percentageFormat(0.01, 3, ','));
        $this->assertSame('1', Formatter::percentageFormat(0.01, 3, ',', ' ', false));
        $this->assertSame('1.500%', Formatter::percentageFormat(0.015, 3));
        $this->assertSame('1.50%', Formatter::percentageFormat(0.015, 2));
        $this->assertSame('1,50%', Formatter::percentageFormat(0.015, 2, ','));
        $this->assertSame('10,001.50%', Formatter::percentageFormat(100.015, 2, '.', ','));
        $this->assertSame('10001.500%', Formatter::percentageFormat(100.015, 3, '.', ''));
        $this->assertSame('10001.5000', Formatter::percentageFormat(100.015, 4, '.', '', false));
        $this->assertSame('10001.5000', Formatter::percentageFormat(100.015, 4, '.', '', false, ''));
        $this->assertSame('10001.5000 %', Formatter::percentageFormat(100.015, 4, '.', '', '%', ' '));
    }*/
}
