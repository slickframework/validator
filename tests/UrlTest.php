<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Validator\Url;

/**
 * Url Validator test case
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class UrlTest extends TestCase
{

    /**
     * @var Url
     */
    protected $validator;

    /**
     * Sets the SUT URL validator object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Url();
    }

    public function data()
    {
        return [
            'valid' => ['http://www.example.com', true],
            'invalid' => ['example.com', false],
        ];
    }

    /**
     * @param string $url
     * @param bool $result
     *
     * @test
     * @dataProvider data
     */
    public function validateUrl($url, $result)
    {
        $this->assertEquals($result, $this->validator->isValid($url));
    }
}
