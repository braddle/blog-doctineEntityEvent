Feature: Price Inclusive of Tax

  Scenario: Ensure that a getting a price including tax from a new PriceIncludingTax throws a NoTaxCalculatorException
    Given There is a PriceIncludingTax with value 20.00
    When I get PriceIncludingTax
    Then a NoTaxCalculatorException exception should be thrown
