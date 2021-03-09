<?php

/*
Plugin Name: First wp plugin using vuejs
Plugin URI: https:sakibmd.xyz/
Description: A WordPress boilerplate plugin with Vue js.
Version: 1.0.0
Author: Sakib Mohammed
Author URI: https:sakibmd.xyz/
License:  GPL2
Text Domain: textdomain
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 *
 * Copyright 2019 Plugin Name LLC. All rights reserved.
 */

function todos_database()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "todos";
    $sql = "CREATE TABLE {$table_name} (
                        id INT NOT NULL AUTO_INCREMENT,
                        taskname VARCHAR(250),
                        taskdate VARCHAR(250),
                        createdAt VARCHAR(250),
                        PRIMARY KEY  (id)
                    );";
    require_once ABSPATH . "wp-admin/includes/upgrade.php";
    dbDelta($sql);

}
register_activation_hook(__FILE__, 'todos_database');





if (!defined('ABSPATH')) {
    exit;
}
if (!defined('FIRST_WP_PLUGIN_USING_VUEJS_VERSION')) {

    define('FIRST_WP_PLUGIN_USING_VUEJS_VERSION_LITE', true);
    define('FIRST_WP_PLUGIN_USING_VUEJS_VERSION', time());
    define('FIRST_WP_PLUGIN_USING_VUEJS_MAIN_FILE', __FILE__);
    define('FIRST_WP_PLUGIN_USING_VUEJS_URL', plugin_dir_url(__FILE__));
    define('FIRST_WP_PLUGIN_USING_VUEJS_DIR', plugin_dir_path(__FILE__));
    define('FIRST_WP_PLUGIN_USING_VUEJS_UPLOAD_DIR', '/first_wp_plugin_using_vuejs');

    class firstWpPluginUsingVuejs
    {
        public function boot()
        {
            if (is_admin()) {
                $this->loadCSS();
                $this->adminHooks();
            }
        }

        public function loadCSS()
        {
            function textdomain_load_css()
            {
                wp_enqueue_style('dbdemo-main', "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css");
            }
            add_action('admin_enqueue_scripts', 'textdomain_load_css');
        }

        public function adminHooks()
        {
            require FIRST_WP_PLUGIN_USING_VUEJS_DIR . 'includes/autoload.php';

            //Register Admin menu
            $menu = new \firstWpPluginUsingVuejs\Classes\Menu();
            $menu->register();

            // Top Level Ajax Handlers
            $ajaxHandler = new \firstWpPluginUsingVuejs\Classes\AdminAjaxHandler();
            $ajaxHandler->registerEndpoints();

            add_action('first_wp_plugin_using_vuejs/render_admin_app', function () {
                $adminApp = new \firstWpPluginUsingVuejs\Classes\AdminApp();
                $adminApp->bootView();
            });
        }

        public function textDomain()
        {
            load_plugin_textdomain('first_wp_plugin_using_vuejs', false, basename(dirname(__FILE__)) . '/languages');
        }
    }

    add_action('plugins_loaded', function () {
        (new firstWpPluginUsingVuejs())->boot();
    });

    register_activation_hook(__FILE__, function ($newWorkWide) {
        require_once (FIRST_WP_PLUGIN_USING_VUEJS_DIR . 'includes/Classes/Activator.php');
        $activator = new \firstWpPluginUsingVuejs\Classes\Activator();
        $activator->migrateDatabases($newWorkWide);
    });

    // disabled admin-notice on dashboard
    add_action('admin_init', function () {
        $disablePages = [
            'first_wp_plugin_using_vuejs.php',
        ];
        if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
            remove_all_actions('admin_notices');
        }
    });
} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}
