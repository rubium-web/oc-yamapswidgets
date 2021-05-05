<?php

namespace Rubium\YaMapsWidgets\Components;

use Cms\Classes\ComponentBase;
use Rubium\YaMapsWidgets\Models\Settings;

class YaMapDemo extends ComponentBase
{
    public $apikey;
    public $lang;
    public $js;
    public $longitude;
    public $latitude;
    public $location;

    public function componentDetails()
    {
        return [
            'name' => 'rubium.yamapswidgets::lang.component.name',
            'description' => 'rubium.yamapswidgets::lang.component.description'
        ];
    }

    public function defineProperties()
    {

        return [
            'width' => [
                'title'             => 'rubium.yamapswidgets::lang.component.width',
                'default'           => '100%',
                'description'       => 'rubium.yamapswidgets::lang.component.width_description',
                'type'              => 'string',
            ],
            'height' => [
                'title'             => 'rubium.yamapswidgets::lang.component.height',
                'default'           => '350px',
                'description'       => 'rubium.yamapswidgets::lang.component.height_description',
                'type'              => 'string',
            ],
            'mapTypeId' => [
                'title'             => 'rubium.yamapswidgets::lang.component.mapType',
                'default'           => 'yandex#map',
                'type'              => 'dropdown',
                'options'           => [
                                        'yandex#map' => 'Sheme',
                                        'yandex#satellite' => 'Sputnik',
                                        'yandex#hybrid' => 'Hybrid'
                                    ]
            ],
            'zoom' => [
                'title'             => 'rubium.yamapswidgets::lang.component.zoom',
                'default'           => 12,
                'type'              => 'string',
            ],
            'latitude' => [
                'title'             => 'rubium.yamapswidgets::lang.component.latitude',
                'default'           => 0,
                'type'              => 'integer',
            ],
            'longitude' => [
                'title'             => 'rubium.yamapswidgets::lang.component.longitude',
                'default'           => 0,
                'type'              => 'integer',
            ],
            'showMarker' => [
                'title'             => 'rubium.yamapswidgets::lang.component.showMarker',
                'default'           => 'true',
                'type'              => 'checkbox',
            ],
        ];
    }

    public function onRun()
    {
        $settings = Settings::instance();

        $address_map = @json_decode($settings->latlng, true)['position'];

        if (empty($address_map) || count($address_map) != 2) {
            $address_map = ["55.75417429118003","37.62009153512286"];
        }

        $this->location = $settings;

        $this->apikey = $settings->apikey ?: '';
        $this->lang = $settings->lang ?: '';

        $this->js = "//api-maps.yandex.ru/2.1/?apikey={$this->apikey}&lang={$this->lang}";

        $this->addJs($this->js);

        $this->addJs('/plugins/rubium/yamapswidgets/assets/js/script.js');
        $this->addCss('/plugins/rubium/yamapswidgets/assets/css/style.css');

        $this->latitude = $this->property('latitude') ?  $this->property('latitude') : $address_map[0];
        $this->longitude = $this->property('latitude') ?  $this->property('longitude') : $address_map[1];
    }
}
