Feature: Price Inclusive of Tax

  Scenario: Ensure that getting a price including tax from a new PriceIncludingTax throws a NoTaxCalculatorException
    Given There is a PriceIncludingTax with value 20.00
    When I get PriceIncludingTax
    Then a NoTaxCalculatorException exception should be thrown

  Scenario: Ensure that getting a price excluding tax form a new PriceIncludingTax throws a NoTaxCalculatorException
    Given There is a PriceIncludingTax with value 20.00
    When I get PriceExcludingTax
    Then a NoTaxCalculatorException exception should be thrown

  Scenario: Ensure that getting a price including tax from a new PriceIncludingTax throws a NoTaxCalculatorException
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    When I get PriceIncludingTax
    Then the response is 20.00

  Scenario: Ensure that getting a price including tax from a new PriceIncludingTax throws a NoTaxCalculatorException
    Given There is a PriceIncludingTax with value 20.00
    And it is saved
    When I get PriceExcludingTax
    Then the response is 16.67

