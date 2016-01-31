<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\Number as NumberValidator;

/**
 * Number Validator Test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class NumberTest extends TestCase
{

    /**
     * @var NumberValidator
     */
    protected $validator;

    /**
     * Set the SUT number validator object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new NumberValidator();
    }

    public function data()
    {
        return [
            'valid' => [123, true],
            'invalid' => ['test', false],
            'not integer' => [3.45, false]
        ];
    }

    /**
     * @param string $value
     * @param bool $result
     * @test
     * @dataProvider data
     */
    public function validate($value, $result)
    {
        $this->assertEquals($result, $this->validator->isValid($value));
    }
}
