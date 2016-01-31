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
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);

    /**
     * Returns an array of messages that explain why the most recent
     * isValid() call returned false. The array keys are validation failure
     * message identifiers, and the array values are the corresponding
     * human-readable message strings.
     *
     * @return array
     */
    public function getMessages();

    /**
     * Sets a custom message for a given identifier
     *
     * @param string $identifier
     * @param string $message
     *
     * @return ValidatorInterface
     */
    public function setMessage($identifier, $message);
}
