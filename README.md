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

Yac is much faster than Pimple!

```bash
 $ php -n ./vendor/bin/athletic -p ./tests/YacPerformance/ -b ./tests/bootstrap.php -f GroupedFormatter
YacPerformance\YacPerformanceEvent
  fetch_service-performance
    Method Name                                 Iterations    Average Time      Ops/s    Relative
    ------------------------------  ----------  ------------ --------------   ---------  ---------
    pimpleFetchService            : [Baseline] [100,000   ] [0.0000042015409] [238,007.91486]
    yacFetchServicePimpleStyle    :            [100,000   ] [0.0000032225394] [310,314.27956] [76.70%]
    yacFetchServiceLazyMapStyle   :            [100,000   ] [0.0000027879906] [358,681.27057] [66.36%]

  fetch_initialized_service-performance
    Method Name                                 Iterations    Average Time      Ops/s    Relative
    ------------------------------  ----------  ------------ --------------   ---------  ---------
    pimpleFetchInitializedService : [Baseline] [100,000   ] [0.0000010025978] [997,408.92228]
    yacFetchInitializedServicePimpleStyle:            [100,000   ] [0.0000007377648] [1,355,445.46456] [73.59%]
    yacFetchInitializedServiceLazyMapStyle:            [100,000 ] [0.0000002871366] [3,482,663.50475] [28.64%]
```

## Known limitations

- No parameter/service called `__yac`
- All services are "shared", "prototype" services are not yet supported
- ...
