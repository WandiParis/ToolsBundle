<?php

namespace Wandi\ToolsBundle\Tests\Tools;

use PHPUnit\Framework\TestCase;
use Wandi\ToolsBundle\Tools\Format;
use Wandi\ToolsBundle\Tools\Str;

class FormatTest extends TestCase
{
    private $format;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->format = new Format(new Str());
    }

    public function testWeightFormat()
    {
        $this->assertSame('1g', $this->format->weightFormat(1));
        $this->assertSame('100g', $this->format->weightFormat(100));
        $this->assertSame('999g', $this->format->weightFormat(999));
        $this->assertSame('999g', $this->format->weightFormat(999, 2));
        $this->assertSame('1Kg', $this->format->weightFormat(1000));
        $this->assertSame('1.100Kg', $this->format->weightFormat(1100));
        $this->assertSame('1.10Kg', $this->format->weightFormat(1100, 2));
        $this->assertSame('1,100Kg', $this->format->weightFormat(1100, 3, ','));
        $this->assertSame('1,000Kg', $this->format->weightFormat(1000000, 3, '.'));
        $this->assertSame('1,000.100Kg', $this->format->weightFormat(1000100, 3, '.'));
        $this->assertSame('1000.100Kg', $this->format->weightFormat(1000100, 3, '.', ''));
        $this->assertSame('1000.100Kilograms', $this->format->weightFormat(1000100, 3, '.', '', 'Grams', 'Kilograms'));
        $this->assertSame('1000.100 Kilograms', $this->format->weightFormat(1000100, 3, '.', '', 'Grams', 'Kilograms', ' '));
    }

    public function testPriceFormat()
    {
        $this->assertSame('0', $this->format->priceFormat(0));
        $this->assertSame('0', $this->format->priceFormat(0, 3));
        $this->assertSame('1.50', $this->format->priceFormat(1.5));
        $this->assertSame('1.5', $this->format->priceFormat(1.5, 1));
        $this->assertSame('1.500', $this->format->priceFormat(1.5, 3));
        $this->assertSame('1,50', $this->format->priceFormat(1.5, 2, ','));
        $this->assertSame('1 000', $this->format->priceFormat(1000, 3, ',', ' '));
        $this->assertSame('1 000,50', $this->format->priceFormat(1000.5, 2, ',', ' '));
        $this->assertSame('1 000,50€', $this->format->priceFormat(1000.5, 2, ',', ' ', '€'));
        $this->assertSame('1000,50€', $this->format->priceFormat(1000.5, 2, ',', '', '€'));
        $this->assertSame('1 000,50$', $this->format->priceFormat(1000.5, 2, ',', ' ', ' $'));
        $this->assertSame('1 000,50 $', $this->format->priceFormat(1000.5, 2, ',', ' ', ' $', ' '));
        $this->assertSame('1 000,50', $this->format->priceFormat(1000.5, 2, ',', ' ', null, ' '));
    }

    public function testCardNumberFormat()
    {
        $this->assertSame('1234 1234 1234 1234', $this->format->cardNumberFormat('1234123412341234'));
        $this->assertSame('1234 1234 1234 123', $this->format->cardNumberFormat('123412341234123'));
        $this->assertSame('1234-1234-1234-123', $this->format->cardNumberFormat('123412341234123', '-'));
    }

    public function testPercentageFormat()
    {
        $this->assertSame('1%', $this->format->percentageFormat(0.01));
        $this->assertSame('1%', $this->format->percentageFormat(0.01, 3));
        $this->assertSame('1%', $this->format->percentageFormat(0.01, 3, ','));
        $this->assertSame('1', $this->format->percentageFormat(0.01, 3, ',', ' ', false));
        $this->assertSame('1.500%', $this->format->percentageFormat(0.015, 3));
        $this->assertSame('1.50%', $this->format->percentageFormat(0.015, 2));
        $this->assertSame('1,50%', $this->format->percentageFormat(0.015, 2, ','));
        $this->assertSame('10,001.50%', $this->format->percentageFormat(100.015, 2, '.', ','));
        $this->assertSame('10001.500%', $this->format->percentageFormat(100.015, 3, '.', ''));
        $this->assertSame('10001.5000', $this->format->percentageFormat(100.015, 4, '.', '', false));
        $this->assertSame('10001.5000', $this->format->percentageFormat(100.015, 4, '.', '', false, ''));
        $this->assertSame('10001.5000 %', $this->format->percentageFormat(100.015, 4, '.', '', '%', ' '));
    }
}
