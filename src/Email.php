<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * Email validator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filpe@gmail.com>
 */
class Email extends AbstractValidator implements ValidatorInterface
{

    /**
     * @readwrite
     * @var array Message templates
     */
    protected $_messageTemplates = [
        'email' => 'The value is not a valid e-mail address.'
    ];

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $result = filter_var($value, FILTER_VALIDATE_EMAIL);
        if (!$result) {
            $this->addMessage('email', $value);
        }
        return (boolean) $result;
    }
}
