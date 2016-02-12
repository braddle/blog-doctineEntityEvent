<?php
namespace Braddle\Entity;

use Braddle\Exception\NoTaxCalculatorException;
use Braddle\TaxCalculator;

abstract class Price
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var TaxCalculator
     */
    private $taxCalculator;

    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @param TaxCalculator $taxCalculator
     */
    public function setTaxCalculator($taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    /**
     * @return TaxCalculator
     *
     * @throws NoTaxCalculatorException
     */
    protected function getTacCalculator()
    {
        if (!$this->taxCalculator instanceof TaxCalculator) {
            throw new NoTaxCalculatorException('');
        }

        return $this->taxCalculator;
    }

    /**
     *
     * @return flaat
     *
     * @throws NoTaxCalculatorException
     */
    public abstract function getPriceIncludingTax();
}