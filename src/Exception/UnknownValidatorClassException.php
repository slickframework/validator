<?php

/**
 * This file is part of slick/validator package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Validator\Exception;

use RuntimeException;
use Slick\Validator\Exception;

/**
 * Unknown Validator Class Exception
 *
 * @package Slick\Validator\Exception
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class UnknownValidatorClassException extends RuntimeException implements
    Exception
{

}
