# Laravel Stats Helper

[![Latest Stable Version](https://poser.pugx.org/label84/laravel-stats-helper/v/stable?style=flat-square)](https://packagist.org/packages/label84/laravel-stats-helper)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Quality Score](https://img.shields.io/scrutinizer/g/label84/laravel-stats-helper.svg?style=flat-square)](https://scrutinizer-ci.com/g/label84/laravel-stats-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/label84/laravel-stats-helper.svg?style=flat-square)](https://packagist.org/packages/label84/laravel-stats-helper)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/label84/laravel-stats-helper/run-tests?label=Tests&style=flat-square)

With ``laravel-stats-helper`` you can get the statistics of two values or an array of values. It allows you to get the difference, percentage, change in percentage and an indicator whether the change is positive or negative. This helper could be useful in generating simple graphs or statistics for a dashboard or reporting page.

- [Requirements](#requirements)
- [Laravel support](#laravel-support)
- [Installation](#installation)
- [Usage](#usage)
- [Tests](#tests)
- [License](#license)

## Requirements

- Laravel 8.x

## Laravel support

| Version | Release |
|---------|---------|
| 8.x     | 1.0     |

## Installation

Install the package via composer:

```sh
composer require label84/laravel-stats-helper
```

## Usage

```php
use Label84\StatsHelper\Facades\StatsHelper;

$stats = StatsHelper::init(40, 60);

$stats->getOld();                   // 40
$stats->getNew();                   // 60
$stats->getDifference();            // 20
$stats->getPercentage();            // 150
$stats->getChangeInPercentage();    // 50% (it's a 50% increase)
$stats->isPositive();               // true
$stats->isNegative();               // false
```

You can use the ``StatsArrayHelper`` to get the stats for multiple items.

```php
use Label84\StatsHelper\Facades\StatsArrayHelper;

$colection = StatsArrayHelper::create([
    'January' => 10,
    'February' => 50,
    'March' => 75,
    'April' => 200,
    'May' => 100,
])
->mapWithKeys(fn ($stats, $key) => [$key => $stats->getChangeInPercentage().'%']);

$colection->get('January');         // 0% (no previous value available)
$colection->get('February');        // 400%
$colection->get('March');           // 50%
$colection->get('April');           // 167%
$colection->get('May');             // -50%
```

You can also set new values with the ``setPrev`` and ``setNext`` methods. This could be helpful in a for/foreach loop.

```php
use Label84\StatsHelper\Facades\StatsHelper;

$stats = StatsHelper::init(50, 60);

$stats->getDifference();            // 10

$stats->setNext(100);

$stats->getOld();                   // 60
$stats->getNew();                   // 100
$stats->getDifference();            // 10
```

## Tests

```sh
./vendor/bin/phpstan analyze
./vendor/bin/phpunit
```

## License

[MIT](https://opensource.org/licenses/MIT)
