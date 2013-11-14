<?php

namespace YacPerformance;

use Athletic\AthleticEvent;
use Pimple;
use Yac\Yac;

class YacPerformanceEvent extends AthleticEvent
{
    private $pimple;
    private $yac;

    public function setUp()
    {
        $this->pimple = new Pimple();
        $this->pimple['service'] = function ($c) { return new \stdClass(); };
        $this->pimple['initializedService'] = function () { return new \stdClass(); };
        $this->pimple['initializedService'];


        $this->yac = new Yac();
        $this->yac['service'] = function ($c) { return new \stdClass(); };
        $this->yac['initializedService'] = function () { return new \stdClass(); };
        $this->yac->initializedService;
    }

    /**
     * @baseline
     * @iterations 100000
     * @group fetch_service-performance
     */
    public function pimpleFetchService()
    {
        $this->pimple['service'];
    }

    /**
     * @iterations 100000
     * @group fetch_service-performance
     */
    public function yacFetchServicePimpleStyle()
    {
        $this->yac['service'];
    }

    /**
     * @iterations 100000
     * @group fetch_service-performance
     */
    public function yacFetchServiceLazyMapStyle()
    {
        $this->yac->service;
    }

    /**
     * @baseline
     * @iterations 100000
     * @group fetch_initialized_service-performance
     */
    public function pimpleFetchInitializedService()
    {
        $this->pimple['initializedService'];
    }

    /**
     * @iterations 100000
     * @group fetch_initialized_service-performance
     */
    public function yacFetchInitializedServicePimpleStyle()
    {
        $this->yac['initializedService'];
    }

    /**
     * @iterations 100000
     * @group fetch_initialized_service-performance
     */
    public function yacFetchInitializedServiceLazyMapStyle()
    {
        $this->yac->initializedService;
    }
}
