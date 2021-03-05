<?php

namespace firstWpPluginUsingVuejs\Classes;

class AccessControl
{
    public static function hasTopLevelMenuPermission()
    {
        $menuPermissions = array(
            'manage_options',
            'first_wp_plugin_using_vuejs_full_access',
            'first_wp_plugin_using_vuejs_can_view_menus'
        );
        foreach ($menuPermissions as $menuPermission) {
            if (current_user_can($menuPermission)) {
                return $menuPermission;
            }
        }
        return false;
    }
}
