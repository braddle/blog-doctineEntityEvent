<?php
namespace Braddle\Entity;

use Braddle\Exception\NoTaxCalculatorException;

class PriceExcludingTax extends Price
{

    /**
     *
     * @return flaat
     *
     * @throws NoTaxCalculatorException
     */
    public function getPriceIncludingTax()
    {
        return $this->getTaxCalculator()->addTax($this->price);
    }

    /**
     *
     * @return flaat
     *
     * @throws NoTaxCalculatorException
     */
    public function getPriceExcludingTax()
    {
        $this->getTaxCalculator();

        return $this->price;
    }
}
