<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

use Slick\Validator\Exception\InvalidArgumentException;

/**
 * Static Validator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
final class StaticValidator
{

    /**
     * @var array List of available validators
     */
    public static $validators = [
        'notEmpty'     => 'Slick\Validator\NotEmpty',
        'email'        => 'Slick\Validator\Email',
        'alphaNumeric' => 'Slick\Validator\AlphaNumeric',
        'number'       => 'Slick\Validator\Number',
        'url'          => 'Slick\Validator\Url'
    ];

    /**
     * @var array The error messages from last validation
     */
    protected static $messages = [];

    /**
     * @var string
     */
    protected static $message = '';

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * @param string $validator The validator name
     * @param mixed $value
     *
     * @throws Exception\UnknownValidatorClassException
     * @return bool
     *
     * @deprecated Should use the validates instead
     *
     * @see Slick\Validator\StaticValidator::$validators
     */
    public static function isValid($validator, $value)
    {
        /** @var ValidatorInterface $validator */
        $validator = static::create($validator);
        $result = $validator->validates($value);
        static::$messages[] = $validator->getMessage();
        return $result;
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * The context specified can be used in the validation process so that
     * the same value can be valid or invalid depending on that data.
     *
     * @param string $validator
     * @param mixed $value
     * @param array|mixed $context
     *
     * @return bool
     */
    public static function validates($validator, $value, $context = [])
    {
        /** @var ValidatorInterface $validator */
        $validator = static::create($validator);
        $result = $validator->validates($value, $context);
        static::$message = $validator->getMessage();
        return $result;
    }

    /**
     * Creates a validator object
     *
     * @param string $validator The validator class name or alias
     *
     * @param null $message
     * @throws Exception\UnknownValidatorClassException
     *
     * @return ValidatorInterface
     *
     */
    public static function create($validator, $message = null)
    {
        $class = self::checkValidator($validator);

        /** @var ValidatorInterface $object */
        $object = new $class;
        if (!is_null($message)) {
            $object->setMessage($message);
        }
        return $object;
    }

    /**
     * Returns an array of messages that explain why the most recent
     * isValid() call returned false. The array keys are validation failure
     * message identifiers, and the array values are the corresponding
     * human-readable message strings.
     *
     * @deprecated  You should use instead the StaticValidator::getMessage()
     *
     * @return array
     */
    public static function geMessages()
    {
        return static::$messages;
    }

    /**
     * Returns the message that explain why the most recent
     * validates() call returned false.
     *
     * @return array
     */
    public static function geMessage()
    {
        return static::$message;
    }

    /**
     * Check if the provided validator is a known alias or a valid validator
     * interface class
     *
     * @param string $validator Alias or FQ class name of the validator
     *
     * @return string
     */
    private static function checkValidator($validator)
    {
        if (!array_key_exists($validator, self::$validators)) {
            return self::checkClass($validator);
        }
        return self::$validators[$validator];
    }

    /**
     * Check if is a valid validator class
     *
     * @param string $validator FQ class name of validator
     *
     * @return string
     */
    private static function checkClass($validator)
    {
        if (! class_exists($validator)) {
            throw new InvalidArgumentException(
                "Class {$validator} does not exists."
            );
        }

        if (! is_subclass_of($validator, ValidatorInterface::class)) {
            throw new Exception\UnknownValidatorClassException(
                "The validator '{$validator}' is not defined or does not " .
                "implements the Slick\\Validator\\ValidatorInterface interface"
            );
        }

        return $validator;
    }

}
