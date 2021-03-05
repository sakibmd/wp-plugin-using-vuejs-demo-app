<?php

namespace firstWpPluginUsingVuejs\Classes;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register and initialize custom post type for first_wp_plugin_using_vuejs
 * @since 1.0.0
 */

class PostType
{
    public function __construct()
    {
        add_action('init', array( $this , 'register'));
    }

    public function register()
    {
        $args = array(
            'capability_type' => 'post',
            'public'          => false,
            'show_ui'         => false,
        );
        register_post_type('first_wp_plugin_using_vuejs', $args);
    }
}
