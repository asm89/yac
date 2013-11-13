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
        $this->pimple['service'] = $this->pimple->share(function ($c) { return new \stdClass(); });

        $this->yac = new Pimple();
        $this->yac['service'] = function ($c) { return new \stdClass(); };
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
}
