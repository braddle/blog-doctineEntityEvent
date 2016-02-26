<?php
namespace Braddle;

use Braddle\Entity\Price;

class EntityListener
{

    /**
     * Fired before an object is about to be saved by doctrine
     *
     * @param PricingConfigAware $object The model to inject the price config into
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return void
     */
    public function prePersist(Price $object)
    {
        $object->setTaxCalculator($this->getTaxCalculator());
    }

    /**
     * Fired before an object is about to be saved by doctrine
     *
     * @param PricingConfigAware $object The model to inject the price config into
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return void
     */
    public function postLoad(Price $object)
    {
        $object->setTaxCalculator($this->getTaxCalculator());
    }

    /**
     * @return \Braddle\TaxCalculator
     */
    private function getTaxCalculator()
    {
        return new TaxCalculator(20);
    }
}
