<?php

namespace App\Service;

/**
 * Platform Search Class
 */
class Search
{
    /**
     * Sets up to apply filters to search query
     * 
     * @return void
     */
    public static function setup()
    {
        add_action('pre_get_posts', array(__CLASS__, 'queryPosts'));
    }

    /**
     * Applys filters to the query
     * 
     * @param WP_Query $wp_query The query
     * 
     * @return void
     */
    public static function queryPosts($wp_query)
    {
        if (!$wp_query->is_search) {
            return;
        }

        if (isset($_GET['s'])) {
            $wp_query->set('s', $_GET['s']);
        }
    }

}
