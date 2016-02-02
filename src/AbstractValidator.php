<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator;

/**
 * AbstractValidator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
abstract class AbstractValidator
{

    /**
     * @var mixed The value to evaluate
     */
    protected $value;

    /**
     * @readwrite
     * @var array
     */
    protected $message = '';

    /**
     * @var array Error messages templates
     */
    protected $messageTemplate = '';

    /**
     * Returns an array of messages that explain why the most recent
     * isValid() call returned false. The array keys are validation failure
     * message identifiers, and the array values are the corresponding
     * human-readable message strings.
     *
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets a custom message for a given identifier
     *
     * @param string $message
     *
     * @return AbstractValidator
     */
    public function setMessage($message)
    {
        $this->messageTemplate = $message;
        return $this;
    }

    /**
     * Adds a message using a template.
     *
     * @param string $template Message template.
     *
     * @return AbstractValidator
     */
    protected function addMessage($template)
    {
        $arguments = func_get_args();
        $template = $arguments[0];

        $arguments[0] = $template;

        $this->message = sizeof($arguments) > 1
            ? call_user_func_array('sprintf', $arguments)
            : $this->message = $template;

        return $this;
    }

}
