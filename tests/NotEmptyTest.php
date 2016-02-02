<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\NotEmpty;

/**
 * NotEmpty Validator Test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class NotEmptyTest extends TestCase
{

    /**
     * @var NotEmpty
     */
    protected $validator;

    /**
     * Set the SUT NotEmpty validator object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new NotEmpty();
    }

    /**
     * Should be valid
     * @test
     */
    public function validNotEmpty()
    {
        $this->assertTrue($this->validator->validates(12));
    }

    /**
     * Should return false
     * @test
     */
    public function invalidNotEmpty()
    {
        $this->assertFalse($this->validator->validates(''));
    }
}
