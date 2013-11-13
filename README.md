# yac

> Just remembered this gem from @crell at #tnphp: "Invent yet another container? You could call YAC, and shave it!" - [igorwesome](https://twitter.com/igorwesome/status/400716438841098240)

Yet another container is yet another di container for PHP, inspired by [Pimple] and [LazyMap]. Basically blending the two together.

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

## Known limitations

- No paramter/service called `__yac`
- All services are "shared", "prototype" services are not supported
- ...
