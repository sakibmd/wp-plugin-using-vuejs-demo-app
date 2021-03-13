<?php

namespace firstWpPluginUsingVuejs\Classes;

class AdminAjaxHandler
{
    public function registerEndpoints()
    {
        add_action('wp_ajax_add_todos_data', array($this, 'handleEndPoint'));
        //add_action('wp_ajax_search_result_position_wise', array($this, 'handleEndPoint'));

    }
    public function handleEndPoint()
    {
        $route = sanitize_text_field($_REQUEST['route']);

        $validRoutes = array(
            'get-todos' => 'getTodos',
            'add-todo' => 'addTodo',
            'delete-todo' => 'deleteTodo',
            //'search-result-position-wise' => 'search_result_position_wise'
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

        global $wpdb;
        $table_name = $wpdb->prefix . 'todos';
        // var_dump($table_name);
        $results = $wpdb->get_results("SELECT * FROM ${table_name}");
        wp_send_json_success(array(
            'todos' => $results,
        ));

    }

    protected function addTodo()
    {
        //$taskInfo = $_REQUEST['myNewTask'];

        $taskInfo = wp_unslash($_REQUEST['myNewTask']);
        $taskInfoConfig = json_decode(trim(stripslashes($taskInfo)), true);

        $taskname = $taskInfoConfig['taskname'];
        $taskdate = $taskInfoConfig['taskdate'];
        $createdAt = $taskInfoConfig['createdAt'];
        $editedId = $taskInfoConfig['editedId'];

        //var_dump($taskname);

        //update_option('__todosapp', $myNewTask);

        global $wpdb;
        $table_name = $wpdb->prefix . 'todos';

        if ($editedId) {
            $wpdb->update(
                $table_name,
                array(
                    'taskname' => $taskname,
                    'taskdate' => $taskdate,
                    'createdAt' => $createdAt,
                ),
                ['id' => $editedId], //where reference

            );
        } else {
            $wpdb->insert(
                $table_name,
                array(
                    'taskname' => $taskname,
                    'taskdate' => $taskdate,
                    'createdAt' => $createdAt,
                ),
            );
        }

        wp_send_json_success(array(
            'message' => __('Successfully updated', 'texthomain'),
        ));

    }

    protected function deleteTodo()
    {
        $taskInfo = wp_unslash($_REQUEST['id']);
        $taskInfoConfig = json_decode(trim(stripslashes($taskInfo)), true);

        $deletedId = $taskInfoConfig['deletedId'];
        //dd($deletedId);

        global $wpdb;
        $table_name = $wpdb->prefix . 'todos';

        //$wpdb->delete( $table_name, array( 'id' => $deletedId ) );
        $sql = "DELETE FROM `$table_name` WHERE id=$deletedId";
        $wpdb->query($sql);

        wp_send_json_success(array(
            'message' => __('Successfully deleted', 'texthomain'),
        ));
    }
}
