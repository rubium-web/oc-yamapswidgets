<?php namespace Rubium\YaMapsWidgets;

use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Classes\SettingsManager;

/**
 * Backend Yandex Maps Plugin
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'rubium.yamapswidgets::lang.plugin.name',
            'description' => 'rubium.yamapswidgets::lang.plugin.description',
            'author'      => 'RubiumWeb',
            'icon'        => 'icon-search',
            'homepage'    => 'https://www.rubium.ru'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'rubium.yamapswidgets::lang.settings.label',
                'description' => 'rubium.yamapswidgets::lang.settings.description',
                'permissions' => ['rubium.yamapswidgets.manage'],
                'icon'        => 'icon-map-marker',
                'class'       => 'Rubium\YaMapsWidgets\Models\Settings',
                'order'       => 602
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'rubium.yamapswidgets.manage' => [
                'label' => 'rubium.yamapswidgets::lang.permissions.label',
                'tab' => 'rubium.yamapswidgets::lang.permissions.tab'
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Rubium\YaMapsWidgets\Components\YaMapDemo' => 'yaMapDemo'
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Rubium\YaMapsWidgets\FormWidgets\YaMaps' => [
                'label' => 'rubium.yamapswidgets::lang.widget.name',
                'code'  => 'yamaps'
            ],
            'Rubium\YaMapsWidgets\FormWidgets\YAddress' => [
                'label' => 'rubium.yamapswidgets::lang.widget.name',
                'code'  => 'yaddress'
            ]
        ];
    }
}
