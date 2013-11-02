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
 * Interface ConfigInterface
 *
 * Interface to retrieve config options.
 */
interface ConfigInterface
{
    /**
     * Module name
     *
     * @return string
     */
    public function getModule();

    /**
     * Config scope
     *
     * @return string
     */
    public function getScope();

    /**
     * Config name
     *
     * @return string
     */
    public function getName();
}
