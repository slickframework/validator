<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\StaticValidator;
use Slick\Validator\ValidationChain;

/**
 * Validation Chain Test Case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class ValidationChainTest extends TestCase
{

    /**
     * @var ValidationChain
     */
    protected $validationChain;

    /**
     * Sets the SUT validation chain object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validationChain = new ValidationChain();
        $this->validationChain->add(StaticValidator::create('notEmpty'));
        $this->validationChain[] = StaticValidator::create('email');
    }

    /**
     * Clear all for next test
     */
    protected function tearDown()
    {
        $this->validationChain = null;
        parent::tearDown();
    }

    /**
     * Should validate true
     * @test
     */
    public function validChain()
    {
        $this->assertTrue(
            $this->validationChain->validates('jondoe@example.com')
        );
    }

    /**
     * Should have 2 messages for the 2 failing validators
     * @test
     */
    public function emptyString()
    {
        $expected = [
            'The value cannot be empty.',
            'The address  is not a valid e-mail address.'
        ];
        $this->validationChain->validates('');
        $this->assertEquals($expected, $this->validationChain->getMessages());
    }

    /**
     * Should have only the invalid email message
     * @test
     */
    public function invalidEmail()
    {
        $expected = [
            'The address wrong is not a valid e-mail address.'
        ];
        $this->validationChain->validates('wrong');
        $this->assertEquals($expected, $this->validationChain->getMessages());
    }

    /**
     * Should return a single message for all validation
     * @test
     */
    public function setCustomMessage()
    {
        $this->validationChain->setMessage('Validation fails');
        $this->validationChain->validates('');
        $this->assertEquals(
            'Validation fails',
            $this->validationChain->getMessage()
        );
    }

    /**
     * Should return the last error if no message is set
     * @test
     */
    public function returnLastError()
    {
        $expected = 'The address  is not a valid e-mail address.';
        $this->validationChain->validates('');
        $this->assertEquals($expected, $this->validationChain->getMessage());
    }
}
