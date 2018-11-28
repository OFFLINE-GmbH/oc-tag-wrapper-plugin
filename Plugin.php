<?php namespace OFFLINE\TagWrapper;

use Backend;
use System\Classes\PluginBase;

/**
 * TagWrapper Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->pushMiddleware('OFFLINE\TagWrapper\Classes\TagWrapperMiddleware');
    }

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'offline.tagwrapper::lang.plugin.name',
            'description' => 'offline.tagwrapper::lang.plugin.description',
            'author'      => 'OFFLINE',
            'icon'        => 'icon-leaf',
        ];
    }


    /**
     * Registers any back-end permissions.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'offline.tagwrapper.manage_settings' => [
                'tab'   => 'offline.tagwrapper::lang.plugin.name',
                'label' => 'offline.tagwrapper::lang.plugin.manage_settings_permission',
            ],
        ];
    }

    /**
     * Registers any back-end settings.
     *
     * @return array
     */

    public function registerSettings()
    {
        return [
            'config' => [
                'label'       => 'offline.tagwrapper::lang.plugin.name',
                'category'    => 'system::lang.system.categories.cms',
                'description' => 'offline.tagwrapper::lang.plugin.description',
                'icon'        => 'icon-code',
                'class'       => 'OFFLINE\TagWrapper\Models\Settings',
                'order'       => 500,
                'keywords'    => 'wrapper tag',
            ],
        ];
    }
}
