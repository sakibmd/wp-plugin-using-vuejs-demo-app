window.firstWpPluginUsingVuejsBus = new window.firstWpPluginUsingVuejs.Vue();

window.firstWpPluginUsingVuejs.Vue.mixin({
    methods: {
        applyFilters: window.firstWpPluginUsingVuejs.applyFilters,
        addFilter: window.firstWpPluginUsingVuejs.addFilter,
        addAction: window.firstWpPluginUsingVuejs.addFilter,
        doAction: window.firstWpPluginUsingVuejs.doAction,
        $get: window.firstWpPluginUsingVuejs.$get,
        $adminGet: window.firstWpPluginUsingVuejs.$adminGet,
        $adminPost: window.firstWpPluginUsingVuejs.$adminPost,
        $post: window.firstWpPluginUsingVuejs.$post,
        $publicAssets: window.firstWpPluginUsingVuejs.$publicAssets
    }
});

import {routes} from './routes';

const router = new window.firstWpPluginUsingVuejs.Router({
    routes: window.firstWpPluginUsingVuejs.applyFilters('firstWpPluginUsingVuejs_global_vue_routes', routes),
    linkActiveClass: 'active'
});

import App from './AdminApp';

new window.firstWpPluginUsingVuejs.Vue({
    el: '#first_wp_plugin_using_vuejs_app',
    render: h => h(App),
    router: router
});

