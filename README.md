## Nova Map Address Field

A Nova field to place a marker on map to get coordinates then it reverse geocoding the coordinates to get a street address
## Installation

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require naif/map_address
```

## Configuration
Publish the package config file:
```bash
php artisan vendor:publish --provider="Naif\MapAddress\FieldServiceProvider"
```

This is the contents of the file which will be published at [config/map-address.php](config/map-address.php).

Add the following keys to your `.env` and `.env.example`:

```
MAP_ADDRESS_API_KEY=

Optional: Set map and address language
MAP_ADDRESS_LANGUAGE=ar
```

_If you need a Google Maps API key, you can create an app and enable Places API and create credentials to get your API key https://console.developers.google.com._

## Usage:
Add the below to Nova/User.php resource:

```php

MapAddress::make('address'),

//You can set the initial map location. By default (United States)
 MapAddress::make('address')
    ->initLocation(40.730610,-98.935242),

//You can also set the map zoom level. By default (4)
 MapAddress::make('address')
    ->initLocation(40.730610,-98.935242)
    ->zoom(12),

```

![Package screenshot](https://pbs.twimg.com/media/DlyEKmaWsAIiUdZ.jpg)

![Package screenshot](https://pbs.twimg.com/media/DlyEL0AW0AU0UQL.jpg)

## Support:
naif@naif.io

https://www.linkedin.com/in/naif

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
