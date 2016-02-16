<?php
namespace Braddle;

class TaxCalculator
{
    private $taxRate;

    public function __construct($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function addTax($price)
    {
        $tax = bcmul($price, bcdiv($this->taxRate, 100, $this->getBcScale()), $this->getBcScale());
        $priceIncludingTax = bcadd($price, $tax, $this->getBcScale());
        $formattedPrice = number_format($priceIncludingTax, 2, '.', '');
        return $formattedPrice;
    }

    public function removeTax($price)
    {
        $tax = bcadd(bcdiv($this->taxRate, 100, $this->getBcScale()), 1, $this->getBcScale());
        $priceExcludingTax = bcdiv($price, $tax, $this->getBcScale());
        $formattedPrice = number_format($priceExcludingTax, 2, '.', '');
        return $formattedPrice;
    }

    private function getBcScale()
    {
        return 6;
    }
}
