<?php

namespace Yac;

abstract class YacTest extends \PHPUnit_Framework_TestCase
{
    protected $yac;

    public function setUp()
    {
        $this->yac = new Yac();
    }

    /**
     * @test
     */
    public function it_sets_a_value()
    {
        $this->yac['foo'] = 'bar';
        $this->assertEquals('bar', $this->get('foo'));
    }

    /**
     * @test
     */
    public function it_creates_a_service_by_calling_the_callable()
    {
        $service = new \stdClass();

        $this->yac['foo'] = function() use ($service) { return $service; };

        $this->assertSame($service, $this->get('foo'));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Identifier "foo" is not defined.
     */
    public function it_throws_an_exception_if_identifier_is_not_set()
    {
        $this->get('foo');
    }

    /**
     * @test
     */
    public function it_exposes_whether_an_identifier_is_set()
    {
        $this->yac['foo'] = 'bar';
        $this->assertTrue($this->doIsset('foo'));
        $this->assertFalse($this->doIsset('bar'));
    }

    /**
     * @test
     */
    public function it_unsets_an_existing_identifier()
    {
        $this->yac['foo'] = 'bar';
        $this->doUnset('foo');
        $this->assertFalse($this->doIsset('foo'));
    }

    /**
     * @test
     */
    public function it_unsets_a_non_existing_identifier()
    {
        $this->doUnset('foo');
        $this->assertFalse($this->doIsset('foo'));
    }

    /**
     * @test
     */
    public function it_passes_the_container_on_calling()
    {
        $service = new \stdClass();

        $this->yac['foo'] = function() use ($service) { return $service; };
        $this->yac['bar'] = function($c) { $x = new \stdClass(); $x->foo = $c->foo; return $x; };

        $bar = $this->get('bar');

        $this->assertSame($service, $bar->foo);
    }

    /**
     * @test
     */
    public function it_returns_the_same_service_instance_each_call()
    {
        $called           = 0;
        $this->yac['foo'] = function() use (&$called) { $called++; return new \stdClass(); };

        $first = $this->get('foo');

        $this->assertSame($first, $this->get('foo'));
        $this->assertEquals(1, $called);
    }

    abstract protected function get($name);
    abstract protected function doIsset($name);
    abstract protected function doUnset($name);
}
