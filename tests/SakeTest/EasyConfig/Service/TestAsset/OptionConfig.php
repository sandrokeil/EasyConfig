<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service\TestAsset;

class OptionConfig
{
    protected $foo;

    protected $bar;

    protected $fooBar;

    protected $barFoo;

    public function __construct($foo = null, $bar = null)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }

    /**
     * @param mixed $barFoo
     */
    public function setBarFoo($barFoo)
    {
        $this->barFoo = $barFoo;
    }

    /**
     * @return mixed
     */
    public function getBarFoo()
    {
        return $this->barFoo;
    }

    /**
     * @param mixed $fooBar
     */
    public function setFooBar($fooBar)
    {
        $this->fooBar = $fooBar;
    }

    /**
     * @return mixed
     */
    public function getFooBar()
    {
        return $this->fooBar;
    }

    /**
     * @return mixed
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @return mixed
     */
    public function getFoo()
    {
        return $this->foo;
    }
}
