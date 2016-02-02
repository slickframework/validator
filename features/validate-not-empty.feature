# validate-not-empty
  Feature: Validate not empty input
    In order to validate data input
    As a developer
    I want to have a not empty validator input

  Scenario: Valid input
    Given the input "test"
    When I run validator "notEmpty"
    Then the result should be "true"

    Scenario: Invalid input
      Given the input ""
      When I run validator "notEmpty"
      Then the result should be "false"