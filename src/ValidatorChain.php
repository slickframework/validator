<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

use Slick\Common\Base;

/**
 * Validator Chain
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class ValidatorChain extends Base implements ChainInterface
{

    /**
     * @readwrite
     * @var ValidatorInterface[]
     */
    protected $_validators = [];

    /**
     * @readwrite
     * @var array
     */
    protected $_messages = [];

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $messages = [];
        $valid = true;
        foreach ($this->_validators as $validator) {
            if (!$validator->isValid($value)) {
                $valid = false;
                $messages = array_merge($messages, $validator->getMessages());
            }
        }
        $this->_messages = $messages;
        return $valid;
    }

    /**
     * Returns an array of messages that explain why the most recent
     * isValid() call returned false. The array keys are validation failure
     * message identifiers, and the array values are the corresponding
     * human-readable message strings.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Adds a validator to the chain
     *
     * @param ValidatorInterface $validator
     *
     * @return ValidatorChain
     */
    public function add(ValidatorInterface $validator)
    {
        $this->_validators[] = $validator;
        return $this;
    }
}