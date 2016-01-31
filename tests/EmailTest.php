<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\Email;

/**
 * Email Test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class EmailTest extends TestCase
{

    /**
     * @var Email
     */
    protected $email;

    /**
     * Sets the SUT email validator object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->email = new Email();
    }

    /**
     * Should return true
     * @test
     */
    public function validEmail()
    {
        $this->assertTrue($this->email->isValid('name@example.com'));
    }

    /**
     * Should return false
     * @test
     */
    public function invalidEmail()
    {
        $this->assertFalse($this->email->isValid('test'));
    }

    /**
     * The message should be replaced by the provided one
     * @test
     */
    public function setCustomMessage()
    {
        $message = '%s, is not valid!';
        $this->email->setMessage('email', $message);
        $this->email->isValid('test');
        $this->assertEquals(sprintf($message, 'test'), $this->email->getMessages()['email']);
    }
}
