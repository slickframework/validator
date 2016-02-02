<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validator;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit_Framework_Assert as Assert;
use Slick\Validator\StaticValidator;

/**
 * Step definitions for slick/validator package
 *
 * @package Validator
 * @behatContext
 */
class ValidatorContext extends \AbstractContext implements
    Context, SnippetAcceptingContext
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var bool
     */
    protected $result;

    /**
     * Sets the value to be validated
     *
     * @Given /^the input "([^"]*)"$/
     * @Given /^I set input "([^"]*)"$/
     *
     * @param string $value Validator name
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Run a validator on current value
     *
     * @When /^I run validator "([^"]*)"$/
     *
     * @param $validator
     */
    public function iRunValidator($validator)
    {
        $this->result = StaticValidator::validates($validator, $this->value);
    }

    /**
     * @Then /^the result should be "([^"]*)"$/
     */
    public function theResultShouldBe($result)
    {
        $falseValues = ['false', false, 0, null, ''];
        $expected = true;
        foreach ($falseValues as $value) {
            if ($result === $value) {
                $expected = false;
                break;
            }
        }


        Assert::assertEquals($expected, $this->result);
    }
}