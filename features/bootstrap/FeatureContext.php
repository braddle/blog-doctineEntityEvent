<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Braddle\Entity\Price;
use Braddle\Exception\NoTaxCalculatorException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var \Exception
     */
    private $exception;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $paths = [
            __DIR__ . '/../../config',
        ];

        $databaseConfig = [
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__ . '/db.sqlite',
        ];

        $config = Setup::createYAMLMetadataConfiguration($paths, true);
        $this->entityManager = EntityManager::create($databaseConfig, $config);
    }

    /**
     * @Given There is a PriceIncludingTax with value :arg1
     */
    public function thereIsAPriceIncludingTaxWithValue($price)
    {
        $this->price = new \Braddle\Entity\PriceIncludingTax($price);
    }

    /**
     * @When I get PriceIncludingTax
     */
    public function iGetPriceincludingtax()
    {
        try {
            $this->price->getPriceIncludingTax();
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then a NoTaxCalculatorException exception should be thrown
     */
    public function aNotaxcalculatorexceptionExceptionShouldBeThrown()
    {
        if (!$this->exception instanceof NoTaxCalculatorException) {
            throw new \RuntimeException('NoTaxCalculatorException was not thrown');
        }
    }
}
