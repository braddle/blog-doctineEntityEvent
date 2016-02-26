<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Braddle\Entity\Price;
use Braddle\Entity\PriceExcludingTax;
use Braddle\Entity\PriceIncludingTax;
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
     * @var int
     */
    private $priceId;

    /**
     * @var float
     */
    private $response;

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
            'path'   => __DIR__ . '/../../db.sqlite',
        ];

        $config = Setup::createYAMLMetadataConfiguration($paths, true);
        $this->entityManager = EntityManager::create($databaseConfig, $config);
    }

    /**
     * @Given There is a PriceIncludingTax with value :price
     */
    public function thereIsAPriceIncludingTaxWithValue($price)
    {
        $this->price = new PriceIncludingTax($price);
    }

    /**
     * @Given There is a PriceExcludingTax with value :price
     */
    public function thereIsAPriceExcludingTaxWithValue($price)
    {
        $this->price = new PriceExcludingTax($price);
    }

    /**
     * @Given it is saved
     */
    public function itIsSaved()
    {
        $this->entityManager->persist($this->price);
        $this->entityManager->flush();

        $this->priceId = $this->price->getId();
    }

    /**
     * @Given the object is dropped
     */
    public function theObjectIsDropped()
    {
        $this->price = null;
        $this->entityManager->clear();
    }

    /**
     * @When I get PriceIncludingTax
     */
    public function iGetPriceincludingtax()
    {
        try {
            $this->response = $this->price->getPriceIncludingTax();
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I get PriceExcludingTax
     */
    public function iGetPriceexcludingtax()
    {
        try {
            $this->response = $this->price->getPriceExcludingTax();
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I retrieve the PriceIncludingTax
     */
    public function iRetrieveThePriceincludingtax()
    {
       $this->price = $this->entityManager->find('Braddle\Entity\Price', $this->priceId);
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

    /**
     * @Then the response is :arg1
     */
    public function theResponseIs($expectedResponse)
    {
        if ($this->exception != null) {
            throw new \RuntimeException("Exception thrown during get price call: " . $this->exception->getMessage());
        }

        if ($this->response != $expectedResponse) {
            throw new \RuntimeException('Expected ' . $expectedResponse . ' actual ' . var_export($this->response, true));
        }
    }
}
