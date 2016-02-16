<?php
namespace Braddle\Entity;

use Braddle\Exception\NoTaxCalculatorException;

class PriceIncludingTax extends Price
{

    /**
     *
     * @return flaat
     *
     * @throws NoTaxCalculatorException
     */
    public function getPriceIncludingTax()
    {
        $this->getTaxCalculator();

        return $this->price;
    }

    /**
     *
     * @return flaat
     *
     * @throws NoTaxCalculatorException
     */
    public function getPriceExcludingTax()
    {
        return $this->getTaxCalculator()->removeTax($this->price);
    }
}
