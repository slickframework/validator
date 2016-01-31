<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * Number validator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class Number extends AbstractValidator implements ValidatorInterface
{

    /**
     * @readwrite
     * @var array Message templates
     */
    protected $_messageTemplates = [
        'number' => 'The value is not a number.'
    ];

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $result = filter_var($value, FILTER_VALIDATE_INT);
        if (!$result) {
            $this->addMessage('number');
        }
        return ($result === false) ? false : true;
    }
}
