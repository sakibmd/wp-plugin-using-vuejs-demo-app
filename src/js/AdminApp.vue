<template>
    <div id="first_wp_plugin_using_vuejs_app">
        <div class="first_wp_plugin_using_vuejs_main_nav">
            <div class="topnav">
                <router-link v-for="menuItem in topMenus" :key="menuItem.route" active-class="ninja-tab-active" exact :class="['ninja-tab']" :to="{ name: menuItem.route }">
                    {{ menuItem.title }}
                </router-link>
            </div>

        </div>
       <router-view></router-view>
    </div>
</template>

<script>
  export default {
      name: 'AdminApp',
      data() {
          return {
              topMenus: []
          }
      },
      methods: {
          setTopmenu() {
              this.topMenus = this.applyFilters('first_wp_plugin_using_vuejs_top_level_menu', [
                  {
                      route: 'dashboard',
                      title: 'Dashboard'
                  },
                  {
                      route: 'settings',
                      title: 'Settings'
                  },
                  {
                      route: 'supports',
                      title: 'Supports'
                  },
                  {
                      route: 'fetchdata',
                      title: 'Fetchdata'
                  },
                  {
                      route: 'todos',
                      title: 'Todos'
                  }
              ])
          }
      },
      mounted() {
          this.setTopmenu();
      }
  }
</script>
