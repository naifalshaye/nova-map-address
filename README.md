## Nova Map Address Field

A Nova field to place a marker on map to get coordinates then it reverse geocoding the coordinates to get a street address
## Installation

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require naif/map_address
```

## Usage:
Add the below to Nova/User.php resource:

```php

MapAddress::make('address'),

//You can set the initial map location. By default (United States)
 MapAddress::make('address')
    ->initLocation(38.4350,122.6894),


//You can also set the map zoom level. By default (4)
 MapAddress::make('address')
    ->initLocation(38.4350,122.6894)
    ->zoom(12),
    
```

Add the below to nova/resources/views/layout.blade.php
* To display map and get address in specific language add (&language=en) to the below

```php

<script src="https://maps.googleapis.com/maps/api/js?key={{env('ADDRESS_AUTOCOMPLETE_API_KEY')}}"></script>
             
```

Add the below to your .env file

Create an app and enable Places API and create credentials to get your API key
https://console.developers.google.com

```php

ADDRESS_AUTOCOMPLETE_API_KEY=############################

```



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
