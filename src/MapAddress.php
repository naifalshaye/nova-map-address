<?php

namespace Naif\MapAddress;

use Laravel\Nova\Fields\Field;

class MapAddress extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'map_address';

    public function initLocation($latitude, $longitude){
        return $this->withMeta([
            'lat' => $latitude,
            'lng' => $longitude,
        ]);
    }

    public function zoom($zoom)
    {
        return $this->withMeta([
            'zoom' => $zoom
        ]);
    }
}
