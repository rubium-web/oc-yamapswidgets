<?php

namespace Rubium\YaMapsWidgets\FormWidgets;

use Html;
use Backend\Classes\FormWidgetBase;
use Rubium\YaMapsWidgets\Models\Settings;

/**
 * Backend Yandex Maps
 * Usage:
 * map:
 *     label: 'Yandex Maps'
 *     type: yamaps
 *     fieldPosition:
 *         latitude: '55.75417429118003'
 *         longitude: '37.62009153512286'
 *     height: "380px"
 *     editable: false
 *     markers: locations
 */
class YaMaps extends FormWidgetBase
{

    private $apikey = '';

    private $lang = '';

    private $latitude;

    private $longitude;

    protected $fieldPosition;

    public $defaultAlias = 'yamaps';

    public function init()
    {
        $this->fieldPosition = $this->getConfig('fieldPosition', []);
    }

    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['field'] = $this->formField;

        // User can edit placemarks
        $this->vars['editable'] = $this->getConfig('editable', true);
        $this->vars['height'] = $this->getConfig('height', '400px');
        $this->vars['zoom'] = $this->getConfig('zoom', 15);

        // Add markers array
        $this->vars['markers'] = "[]";
        $markersKey = $this->getConfig('markers');
        if (!empty($markersKey)) {
            $this->vars['markers'] = $this->model->{$markersKey};
        }

        if (empty($this->vars['value'])) {
            $this->fieldPosition['latitude'] = !empty($this->fieldPosition['latitude']) ?: $this->latitude;
            $this->fieldPosition['longitude'] = !empty($this->fieldPosition['longitude']) ?: $this->longitude;

            $value = [
                $this->fieldPosition['latitude'],
                $this->fieldPosition['longitude']
            ];

            $this->vars['value'] = json_encode([
                "position" => $value
            ]);
        }
    }

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('yamaps');
    }

    public function getFieldMapAttributes()
    {
        $result = [];

        return Html::attributes($result);
    }

    public function getFieldPositionAttributes()
    {
        $result = [];

        return Html::attributes($result);
    }

    public function loadAssets()
    {
        $this->setFromSettings();
        $this->addJs("//api-maps.yandex.ru/2.1/?apikey={$this->apikey}&lang={$this->lang}");
        $this->addJs('js/main.js', 'core');
    }

    private function setFromSettings()
    {
        $settingsInstance = Settings::instance();

        if (isset($settingsInstance->attributes['address_map'])) {
            $latLong = explode(',', $settingsInstance->attributes['address_map']);
        }

        $this->latitude = $latLong[0] ?? '55.75417429118003';
        $this->longitude = $latLong[1] ?? '37.62009153512286';
        $this->apikey = isset($settingsInstance->attributes['apikey']) ? $settingsInstance->attributes['apikey'] : '';
        $this->lang = isset($settingsInstance->attributes['lang']) ? $settingsInstance->attributes['lang'] : '';
    }
}
