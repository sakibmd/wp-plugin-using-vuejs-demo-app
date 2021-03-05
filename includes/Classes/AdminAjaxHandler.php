<?php

namespace firstWpPluginUsingVuejs\Classes;

class AdminAjaxHandler
{
    public function registerEndpoints()
    {
        add_action('wp_ajax_first_wp_plugin_using_vuejs_admin_ajax', array($this, 'handleEndPoint'));
    }
    public function handleEndPoint()
    {
        $route = sanitize_text_field($_REQUEST['route']);  

        $validRoutes = array(
            'get-todos' => 'getTodos',
            'add-todo' => 'addTodo'
        );

        if (isset($validRoutes[$route])) {
            // AccessControl::checkAndPresponseError($route, 'forms');
            do_action('first_wp_plugin_using_vuejs/doing_ajax_forms_' . $route);
            return $this->{$validRoutes[$route]}();
        }
        do_action('first_wp_plugin_using_vuejs/admin_ajax_handler_catch', $route);
    }

    protected function getTodos()
    {
        $todos = get_option( '__todosapp' );

        wp_send_json_success($todos);
    }

    protected function addTodo()
    {
        $myNewTask = $_REQUEST['myNewTask'];
        // $taskName = $myNewTask['taskname'];
        // $taskDate = $myNewTask['taskdate'];
        // $createdAt = $myNewTask['createdAt'];

        update_option('__todosapp', $myNewTask);


        wp_send_json_success(
            [
                'message' => __('Successfully Added', 'textdomain')
            ]
        );

    }
}
