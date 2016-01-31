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
 * AbstractValidator
 *
 * @package Slick\Validator
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
abstract class AbstractValidator extends Base
{

    /**
     * @readwrite
     * @var mixed The value to evaluate
     */
    protected $_value;

    /**
     * @readwrite
     * @var array
     */
    protected $_messages = [];

    /**
     * @readwrite
     * @var array Error messages templates
     */
    protected $_messageTemplates = [];

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
     * Sets a custom message for a given identifier
     *
     * @param string $identifier
     * @param string $message
     *
     * @return AbstractValidator
     */
    public function setMessage($identifier, $message)
    {
        $this->_messageTemplates[$identifier] = $message;
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
        $key = null;
        $template = $arguments[0];
        if (array_key_exists($template, $this->_messageTemplates)) {
            $key = $template;
            $template = $this->_messageTemplates[$template];
        }

        $arguments[0] = $template;

        $this->_messages[$key] = sizeof($arguments) > 1
            ? call_user_func_array('sprintf', $arguments)
            : $this->_messages[$key] = $template;

        return $this;
    }

}
