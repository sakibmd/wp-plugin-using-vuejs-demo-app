import Vue from './elements';
import Router from 'vue-router';
Vue.use(Router);

import { applyFilters, addFilter, addAction, doAction } from '@wordpress/hooks';

export default class firstWpPluginUsingVuejs {
    constructor() {
        this.applyFilters = applyFilters;
        this.addFilter = addFilter;
        this.addAction = addAction;
        this.doAction = doAction;
        this.Vue = Vue;
        this.Router = Router;
    }

    $publicAssets(path){
        return (window.firstWpPluginUsingVuejsAdmin.assets_url + path);
    }

    $get(options) {
        return window.jQuery.get(window.firstWpPluginUsingVuejsAdmin.ajaxurl, options);
    }

    $adminGet(options) {
        options.action = 'first_wp_plugin_using_vuejs_admin_ajax';
        return window.jQuery.get(window.firstWpPluginUsingVuejsAdmin.ajaxurl, options);
    }

    $post(options) {
        return window.jQuery.post(window.firstWpPluginUsingVuejsAdmin.ajaxurl, options);
    }

    $adminPost(options) {
        options.action = 'first_wp_plugin_using_vuejs_admin_ajax';
        return window.jQuery.post(window.firstWpPluginUsingVuejsAdmin.ajaxurl, options);
    }

    $getJSON(options) {
        return window.jQuery.getJSON(window.firstWpPluginUsingVuejsAdmin.ajaxurl, options);
    }
}
