<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

use Slick\Common\Utils\Collection\AbstractCollection;
use Slick\Common\Utils\CollectionInterface;

/**
 * Validation Chain
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmal.com>
 */
class ValidationChain extends AbstractCollection implements
    ValidationChainInterface,
    CollectionInterface
{

    /**
     * @var array List of validation messages
     */
    protected $messages = [];

    /**
     * @var string Custom message for all chain
     */
    protected $message;

    /**
     * @var string
     */
    protected $messageTemplate;

    /**
     * Returns an array of messages that explain why the most recent
     * validates() call returned false.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
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
        $this->data[] = $validator;
        return $this;
    }

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
    public function validates($value, $context = [])
    {
        $valid = true;
        foreach ($this->getIterator() as $validator) {
            if (!$validator->validates($value, $context)) {
                $valid = false;
                $this->messages[] = $validator->getMessage();
            }
        }
        $this->message = $valid ? '' : $this->messageTemplate;
        return $valid;
    }

    /**
     * Returns a message that explain why the most recent
     * isValid() call returned false.
     *
     * @return array
     */
    public function getMessage()
    {
        $last = (null === $this->message)
            ? end($this->messages)
            : $this->message;
        return $last;
    }

    /**
     * Sets a custom message for the chain in case of fail
     *
     * @param string $message
     *
     * @return ValidatorInterface
     */
    public function setMessage($message)
    {
        $this->messageTemplate = $message;
    }

    /**
     * Retrieve an external iterator
     *
     * @return \Traversable|ValidatorInterface[]
     *      A list of ValidatorInterface objects
     */
    public function getIterator()
    {
        return parent::getIterator();
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set.
     */
    public function offsetSet($offset, $value)
    {
        $this->add($value);
    }
}