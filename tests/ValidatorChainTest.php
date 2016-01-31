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
use Slick\Validator\Url;
use Slick\Validator\ValidatorChain;
use Slick\Validator\ValidatorInterface;

/**
 * Validator Chain Test case
 *
 * @package Slick\Tests\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class ValidatorChainTest extends TestCase
{

    /**
     * @var ValidatorChain
     */
    public $validator;

    /**
     * Sets the SUT chain validation object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new ValidatorChain();
        $this->validator->add(new NotEmpty())
            ->add(new Url());
    }

    /**
     * Should add the validator and return a self instance
     * @test
     */
    public function addValidator()
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->getMock(ValidatorInterface::class);
        $chain = $this->validator->add($validator);
        $this->assertSame($this->validator, $chain);
    }

    public function data()
    {
        return [
            'notEmpty' => ['', false, 'The value cannot be empty.'],
            'validUrl' => ['http://www.example.com', true, ''],
            'invalidUrl' => ['.example.com', false, 'The value is not a valid URL.'],
        ];
    }

    /**
     * @param $value
     * @param $valid
     * @param $message
     *
     * @test
     * @dataProvider data
     */
    public function chainValidation($value, $valid, $message)
    {
        $this->assertEquals($valid, $this->validator->isValid($value));
        if (!$valid) {
            $this->assertContains($message, $this->validator->getMessages());
        }
    }
}
