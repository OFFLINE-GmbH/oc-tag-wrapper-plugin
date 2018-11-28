<?php namespace OFFLINE\TagWrapper\Models;

use Model;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'offline_tagwrapper_settings';

    public $settingsFields = 'fields.yaml';

    public $rules = [
        'wrappers.*.target_tag'       => 'required',
        'wrappers.*.tag_wrapper_type' => 'required',
    ];
}
