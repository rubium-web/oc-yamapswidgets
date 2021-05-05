<?php

namespace Rubium\YaMapsWidgets\Models;

use Model;

class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'rubium.yamapswidgets_settings';

    public $settingsFields = 'fields.yaml';
}
