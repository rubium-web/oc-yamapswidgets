<?php

namespace Rubium\YaMapsWidgets\FormWidgets;

use Request;
use Backend\Classes\FormWidgetBase;
use Rubium\YaMapsWidgets\Models\Settings;

/**
 * Backend Yandex Maps
 * Usage:
 *   address_map:
 *       label: Address
 *       type: yaddress
 *       target: User[location] #Field with type YaMaps
 */
class YAddress extends FormWidgetBase
{

    private $apikey = '';

    private $lang = '';

    private $latitude;

    private $longitude;

    protected $fieldPosition;

    public $defaultAlias = 'yaddress';

    public function init()
    {
        /*[* - *]*/
        parent::init();
    }

    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['field'] = $this->formField;
        $this->vars['target'] = $this->getConfig('target', "");
    }

    public function loadAssets()
    {
        $this->setFromSettings();
        $this->addJs("//api-maps.yandex.ru/2.1/?apikey={$this->apikey}&lang={$this->lang}");
    }

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('yamaps');
    }

    public function onGetYAdress()
    {
        $query = Request::get('q');
        if (empty($query)) {
            return [];
        }

        $url = "https://geocode-maps.yandex.ru/1.x/?apikey={$this->apikey}&format=json&geocode=";

        $finded = file_get_contents($url . $query);
        $options = [];

        try {
            $optionsArray = json_decode($finded);
            $i = 0;
            if ($optionsArray->response) {
                foreach ($optionsArray->response->GeoObjectCollection->featureMember as $area) {
                    $dots = explode(" ", $area->GeoObject->Point->pos);
                    $dots = array_reverse($dots);
                    $dots = implode(",", $dots);
                    $title = $area->GeoObject->metaDataProperty->GeocoderMetaData->text;

                    $options[] = [
                        'title' => $title,
                        'text' => $title,
                        'value' => $dots,
                        'id' => $dots,
                        'disabled' => false
                    ];
                    $i++;
                }
            }
        }catch (Exeption $e) {
            return ['results' => $options];
        }

        return \Response::make(['results' => $options]);
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
