<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service\Exception;

/**
 * Runtime exception
 *
 * Use this exception if the code has not the capacity to handle the request.
 */
class RuntimeException extends \RuntimeException implements ExceptionInterface
{
}
