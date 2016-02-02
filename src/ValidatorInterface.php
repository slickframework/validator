<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * Validator Interface
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
interface ValidatorInterface
{
    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * The context specified can be used in the validation process so that
     * the same value can be valid or invalid depending on that data.
     *
     * @param mixed $value
     * @param array|mixed $context
     *
     * @return bool
     */
    public function validates($value, $context = []);

    /**
     * Returns an array of messages that explain why the most recent
     * validates() call returned false.
     *
     * @return array
     */
    public function getMessage();

    /**
     * Sets a custom message for a given identifier
     *
     * @param string $message
     *
     * @return ValidatorInterface
     */
    public function setMessage($message);
}
