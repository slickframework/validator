<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\Exception\InvalidArgumentException;
use Slick\Validator\Exception\UnknownValidatorClassException;
use Slick\Validator\StaticValidator;

/**
 * Static Validator Test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class StaticValidatorTest extends TestCase
{

    public function testValidation()
    {
        $this->assertFalse(StaticValidator::isValid('notEmpty', ''));
    }

    public function testGetMessages()
    {
        $this->assertContains(
            'The value cannot be empty.',
            StaticValidator::geMessages()
        );
    }

    public function testFQClassName()
    {
        $this->assertFalse(
            StaticValidator::isValid(
                'Slick\Validator\NotEmpty',
                ''
            )
        );
    }

    public function testCreateValidator()
    {
        $validator = StaticValidator::create('notEmpty', 'Just a test');
        $validator->isValid('');
        $this->assertContains(
            'Just a test',
            $validator->getMessages()
        );
    }

    public function testUnknownClass()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        StaticValidator::isValid('_unknown_', '');
    }

    public function testInvalidValidatorClass()
    {
        $this->setExpectedException(UnknownValidatorClassException::class);
        StaticValidator::isValid('stdClass', '');
    }
}
