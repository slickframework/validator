<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * Validation Chain Interface
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
interface ValidationChainInterface extends ValidatorInterface
{

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
     * Adds a validator to the chain
     *
     * @param ValidatorInterface $validator
     *
     * @return ValidatorChain
     */
    public function add(ValidatorInterface $validator);
}
