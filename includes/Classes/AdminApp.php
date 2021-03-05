<?php

namespace firstWpPluginUsingVuejs\Classes;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin App Renderer and Handler
 * @since 1.0.0
 */
class AdminApp
{
    public function bootView()
    {
        echo "<div id='first_wp_plugin_using_vuejs_app'></div>";
    }
}
