<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

/**
 * Interface OptionClassInterface
 *
 * Interface for option class configuration
 */
interface OptionsClassInterface
{
    /**
     * Return the option class name (fcqn) where options are injected via constructor
     *
     * @return string
     */
    public function getOptionsClass();
}
