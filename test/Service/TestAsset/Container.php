<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013-2014 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service\TestAsset;

class Container
{
    protected $services = array();

    public function add($service)
    {
        $this->services[] = $service;
    }

    public function getServices()
    {
        return $this->services;
    }
}
