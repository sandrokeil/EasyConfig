<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

/**
 * Class MandatoryOptionsInterface
 *
 * Use this interface in a factory which extends from AbstractConfigurableFactory to check for required options
 * automatically.
 */
interface MandatoryOptionsInterface
{
    /**
     * Returns a list of mandatory options which must be available
     *
     * @return array
     */
    public function getMandatoryOptions();
}
