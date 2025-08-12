<?php

namespace App\PostType;

/**
 * Example Post Type
 */
class Reviews
{

    protected static $custom_type = 'review';
    protected static $singular_name = 'Review';
    protected static $plural_name = 'Reviews';
    protected static $archive_url = 'reviews';
    protected static $dashboard_icon = 'dashicons-format-status'; // https://developer.wordpress.org/resource/dashicons/

    /**
     * Sets up the post type
     *
     * @return void
     */
    public static function setup()
    {
        self::registerPostType();
        add_action('pre_get_posts', array(__CLASS__, 'queryPosts'));
    }

    /**
     * Registers the post Type
     *
     * @return void
     */
    public static function registerPostType()
    {
        $labels = array(
            'name' => self::$plural_name,
            'singular_name' => self::$singular_name,
            'add_new' => 'Add ' . self::$singular_name,
            'add_new_item' => 'Add ' . self::$singular_name,
            'edit_item' => 'Edit ' . self::$singular_name,
            'new_item' => 'New ' . self::$singular_name,
            'view_item' => 'View ' . self::$singular_name,
            'search_items' => 'Search ' . self::$plural_name,
            'not_found' => 'No ' . self::$plural_name .' found',
            'all_items' => 'List ' . self::$plural_name,
            'menu_name' => self::$plural_name,
            'name_admin_bar' => self::$singular_name
        );
        $args = array(
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_icon' => self::$dashboard_icon,
            'hierarchical' => false,
            'supports' => ['title', 'editor', 'author', 'thumbnail'],
            'taxonomies' => [],
            'has_archive' => false,
            'rewrite' => ['slug' => self::$archive_url, 'with_front' => false]
        );

        register_post_type(self::$custom_type, $args);
    }

    /**
     * Filters the query for this post
     *
     * @param WP_Query $wp_query The query
     *
     * @return void
     */
    public static function queryPosts($wp_query)
    {
        //check the current WP_Query is actually querying this post_type, otherwise skip
        if ($wp_query->get('post_type') != self::$custom_type) {
            return;
        }

        //filter the WP_Query in the back office
        if (is_admin()) {
            return;
        }
    }

}
