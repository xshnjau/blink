<?php

namespace blink\testing;

use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package blink\testing
 */
abstract class TestCase extends PHPUnit_Framework_TestCase
{
    use AuthTrait;

    protected $app;

    abstract public function createApplication();

    public function setUp()
    {
        if (!$this->app) {
            $this->app = $this->createApplication()->bootstrap();
        }
    }

    /**
     * Returns a new request actor for testing.
     *
     * @return RequestActor
     * @since 0.3.0
     */
    public function request()
    {
        return new RequestActor($this, $this->createApplication()->bootstrap());
    }

    public function tearDown()
    {
        if ($this->app) {
            $this->app->shutdown();
            $this->app = null;
        }
    }
}
