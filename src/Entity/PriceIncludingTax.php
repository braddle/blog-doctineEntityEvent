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
        $this->getTacCalculator();
    }
}
