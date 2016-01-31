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
    protected $_messageTemplates = [
        'alphaNumeric' => 'The value can only contain alpha numeric characters.'
    ];

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $result = (boolean) preg_match('/^([0-9a-zA-Z\-]+)$/i', $value);
        if (!$result) {
            $this->addMessage('alphaNumeric');
        }
        return $result;
    }
}