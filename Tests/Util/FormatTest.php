<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Wandi\ToolsBundle\Util\Format;

class FormatTest extends \PHPUnit_Framework_TestCase
{
    public function testWeightFormat()
    {
        $format = new Format();
        $this->assertEquals('1g', $format->weightFormat(1));
        $this->assertEquals('100g', $format->weightFormat(100));
        $this->assertEquals('1Kg', $format->weightFormat(1000));
        $this->assertEquals('1.25Kg', $format->weightFormat(1250));
        $this->assertEquals('1.6Kg', $format->weightFormat(1600));
        $this->assertEquals('10.5Kg', $format->weightFormat(10500));
    }


    public function testPriceFormat()
    {
        $format = new Format();
        $this->assertEquals('1 €', $format->priceFormat(1));
        $this->assertEquals('1,50 €', $format->priceFormat(1.5));
        $this->assertEquals('1,50 €', $format->priceFormat(1.50));
        $this->assertEquals('1,50 €', $format->priceFormat(1.501));
        $this->assertEquals('100 €', $format->priceFormat(100));
        $this->assertEquals('100,50 €', $format->priceFormat(100.5));
        $this->assertEquals('100,50 €', $format->priceFormat(100.50));
        $this->assertEquals('100,50 €', $format->priceFormat(100.501));
        $this->assertEquals('1000 €', $format->priceFormat(1000));
        $this->assertEquals('1000,50 €', $format->priceFormat(1000.50));
    }

    public function testCardNumberFormat()
    {
        $format = new Format();
        $this->assertEquals('1234 1234 1234 1234', $format->cardNumberFormat('1234123412341234'));
        $this->assertEquals('1234 1234 1234', $format->cardNumberFormat('123412341234'));
    }

    public function testPercentageFormat()
    {
        $format = new Format();
        $this->assertEquals('1 %', $format->percentageFormat('1'));
        $this->assertEquals('1,50 %', $format->percentageFormat('1.5'));
        $this->assertEquals('1,50 %', $format->percentageFormat('1.50'));
        $this->assertEquals('1,50 %', $format->percentageFormat('1.501'));
        $this->assertEquals('10 %', $format->percentageFormat('10'));
        $this->assertEquals('99,99 %', $format->percentageFormat('99.99'));
        $this->assertEquals('100 %', $format->percentageFormat('100'));
    }

}