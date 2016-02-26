Feature: Price Inclusive of Tax

  Scenario: Ensure that getting a price including tax from a new PriceExcludingTax throws a NoTaxCalculatorException
    Given There is a PriceExcludingTax with value 20.00
    When I get PriceIncludingTax
    Then a NoTaxCalculatorException exception should be thrown

  Scenario: Ensure that getting a price excluding tax form a new PriceExcludingTax throws a NoTaxCalculatorException
    Given There is a PriceExcludingTax with value 20.00
    When I get PriceExcludingTax
    Then a NoTaxCalculatorException exception should be thrown

  Scenario: Ensure that saving a PriceIncludingTax injects a TaxCalculator and it is possible to get a price including tax
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    When I get PriceIncludingTax
    Then the response is 20.00

  Scenario: Ensure that saving a PriceIncludingTax injects a TaxCalculator and it is possible to get a price excluding tax
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    When I get PriceExcludingTax
    Then the response is 16.67

  Scenario: Ensure that getting a price including tax from the database injects a TaxCalculator and it is possible to get a price including tax
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    And the object is dropped
    When I retrieve the PriceIncludingTax
    When I get PriceIncludingTax
    Then the response is 20.00

  Scenario: Ensure that getting a price including tax from the database injects a TaxCalculator and it is possible to get a price excluding tax
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    And the object is dropped
    When I retrieve the PriceIncludingTax
    When I get PriceExcludingTax
    Then the response is 16.67
