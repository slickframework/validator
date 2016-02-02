<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\AlphaNumeric;

/**
 * AlphaNumeric validator test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class AlphaNumericTest extends TestCase
{

    /**
     * Validate alpha numeric value
     * @test
     */
    public function validateAlphaNumericValue()
    {
        $validator = new AlphaNumeric();
        $value = "Test123";
        $this->assertTrue($validator->validates($value));
        $this->assertFalse($validator->validates(''));
    }
}
