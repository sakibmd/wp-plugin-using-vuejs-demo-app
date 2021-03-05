<?php

namespace firstWpPluginUsingVuejs\Classes;

class Menu
{
    public function register()
    {
        add_action('admin_menu', array($this, 'addMenus'));
    }

    public function addMenus()
    {
        $menuPermission = AccessControl::hasTopLevelMenuPermission();
        if (!$menuPermission) {
            return;
        }

        $title = __('first_wp_plugin_using_vuejs', 'textdomain');
        global $submenu;
        add_menu_page(
            $title,
            $title,
            $menuPermission,
            'first_wp_plugin_using_vuejs.php',
            array($this, 'enqueueAssets'),
            'dashicons-admin-site',
            25
        );

        $submenu['first_wp_plugin_using_vuejs.php']['my_profile'] = array(
            __('Plugin Dashboard', 'textdomain'),
            $menuPermission,
            'admin.php?page=first_wp_plugin_using_vuejs.php#/',
        );
        $submenu['first_wp_plugin_using_vuejs.php']['settings'] = array(
            __('Settings', 'textdomain'),
            $menuPermission,
            'admin.php?page=first_wp_plugin_using_vuejs.php#/settings',
        );
        $submenu['first_wp_plugin_using_vuejs.php']['supports'] = array(
            __('Supports', 'textdomain'),
            $menuPermission,
            'admin.php?page=first_wp_plugin_using_vuejs.php#/supports',
        );
    }

    public function enqueueAssets()
    {
        do_action('first_wp_plugin_using_vuejs/render_admin_app');
        wp_enqueue_script(
            'first_wp_plugin_using_vuejs_boot',
            FIRST_WP_PLUGIN_USING_VUEJS_URL.'assets/js/boot.js',
            array('jquery'),
            FIRST_WP_PLUGIN_USING_VUEJS_VERSION,
            true
        );
       
        // 3rd party developers can now add their scripts here
        do_action('first_wp_plugin_using_vuejs/booting_admin_app');
        wp_enqueue_script(
            'first_wp_plugin_using_vuejs_js',
            FIRST_WP_PLUGIN_USING_VUEJS_URL . 'assets/js/plugin-main-js-file.js',
            array( 'first_wp_plugin_using_vuejs_boot' ),
            FIRST_WP_PLUGIN_USING_VUEJS_VERSION,
            true
        );
       
        //enque css file
        wp_enqueue_style('first_wp_plugin_using_vuejs_admin_css', FIRST_WP_PLUGIN_USING_VUEJS_URL.'assets/css/element.css');

        $firstWpPluginUsingVuejsAdminVars = apply_filters('first_wp_plugin_using_vuejs/admin_app_vars', array(
            //'image_upload_url' => admin_url('admin-ajax.php?action=wpf_global_settings_handler&route=wpf_upload_image'),
            'assets_url' => FIRST_WP_PLUGIN_USING_VUEJS_URL.'assets/',
            'ajaxurl' => admin_url('admin-ajax.php')
        ));

        wp_localize_script('first_wp_plugin_using_vuejs_boot', 'firstWpPluginUsingVuejsAdmin', $firstWpPluginUsingVuejsAdminVars);
    }
}
