<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * NotEmpty validator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class NotEmpty extends AbstractValidator implements ValidatorInterface
{

    /**
     * @readwrite
     * @var array Message templates
     */
    protected $_messageTemplates = [
        'notEmpty' => 'The value cannot be empty.'
    ];

    /**
     * Returns true if and only if $value is not empty
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $result = preg_match('/(.+)/i', $value);
        if (!$result) {
            $this->addMessage('notEmpty');
        }
        return (boolean) $result;
    }
}
