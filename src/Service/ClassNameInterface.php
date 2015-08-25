<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

/**
 * Interface ClassNameInterface
 *
 * Interface to retrieve class name (FCQN).
 */
interface ClassNameInterface
{
    /**
     * FCQN which schould be created
     *
     * @return string
     */
    public function getClassName();
}
