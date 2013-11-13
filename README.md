# yac

> Just remembered this gem from @crell at #tnphp: "Invent yet another container? You could call YAC, and shave it!" - [igorwesome](https://twitter.com/igorwesome/status/400716438841098240)

Yet another container is yet another di container for PHP, inspired by [Pimple] and [LazyMap]. Basically blending the two together. When using it the [LazyMap] way it's very performant.

[Pimple]: https://github.com/fabpot/Pimple
[LazyMap]: https://github.com/Ocramius/LazyMap

## Defining parameters

```php
$c = new Yac\Yac();
$c['env'] = 'dev';
```

## Defining services

```php
$c['session'] = function($c) { return new Session($c->env); };
```

## Accessing parameters and services

```php
$std = $c['std']; // pimple compatible
$std = $c->std;   // "fast" LazyMap way
```

## Performance

```bash
 $ php -n ./vendor/bin/athletic -p ./tests/YacPerformance/ -b ./tests/bootstrap.php -f GroupedFormatter
YacPerformance\YacPerformanceEvent
  fetch_service-performance
    Method Name                                 Iterations    Average Time     Ops/s             Relative
    ------------------------------  ----------  ------------ --------------    ---------         ---------
    pimpleFetchService            : [Baseline]  [100,000   ] [0.0000030675197] [325,996.28015]
    yacFetchServicePimpleStyle    :             [100,000   ] [0.0000032290554] [309,688.08976]   [105.27%]
    yacFetchServiceLazyMapStyle   :             [100,000   ] [0.0000007874918] [1,269,854.49503] [25.67%]
```

## Known limitations

- No paramter/service called `__yac`
- All services are "shared", "prototype" services are not supported
- ...
