<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * AlphaNumeric validator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class AlphaNumeric extends AbstractValidator implements ValidatorInterface
{

    /**
     * @readwrite
     * @var array Message templates
     */
    protected $messageTemplate =
        'The value can only contain alpha numeric characters.';


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
        $result = (boolean) preg_match('/^([0-9a-zA-Z\-]+)$/i', $value);
        if (!$result) {
            $this->addMessage($this->messageTemplate, $value);
        }
        return $result;
    }
}