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
 * Interface InjectionMethodInterface
 *
 * Interface to inject option(s) via a method
 */
interface InjectionMethodInterface
{
    /**
     * Return method name which should be called to inject options
     *
     * @return string
     */
    public function getInjectionMethod();
}
