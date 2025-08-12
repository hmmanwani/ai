<?php

namespace App\PostType;

/**
 * Example Post Type
 */
class FAQ
{

    protected static $custom_type = 'faq';
    protected static $singular_name = 'FAQ';
    protected static $plural_name = 'FAQs';
    protected static $archive_url = 'faqs';
    protected static $dashboard_icon = 'dashicons-format-chat'; // https://developer.wordpress.org/resource/dashicons/
    protected static $admin_page_option_name = 'faq_archive';

    /**
     * Sets up the post type
     *
     * @return void
     */
    public static function setup()
    {
        self::registerPostType();
        add_action('pre_get_posts', array(__CLASS__, 'queryPosts'));

        add_action('admin_init', array(__CLASS__, 'adminInit'));
        add_filter('display_post_states', array(__CLASS__, 'addCustomPostStates'));
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
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_icon' => self::$dashboard_icon,
            'hierarchical' => false,
            'supports' => ['title', 'editor', 'author', 'thumbnail'],
            'taxonomies' => [],
            'has_archive' => true,
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

    public static function adminInit(){

        // register our setting
        $args = array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
        );
        register_setting(
            'reading', // option group "reading", default WP group
            self::$admin_page_option_name, // option name
            $args
        );

        // add our new setting
        add_settings_field(
            self::$admin_page_option_name, // ID
            __(self::$plural_name.' Listing Page', 'textdomain'), // Title
            array(__CLASS__, 'adminSettingCallbackFunction'), // Callback
            'reading', // page
            'default', // section
            array( 'label_for' => self::$admin_page_option_name )
        );
    }

    /**
     * Custom field callback
     */
    public static function adminSettingCallbackFunction($args){
        // get saved project page ID
        $page_id = get_option(self::$admin_page_option_name);

        // get all pages
        $args = array(
            'posts_per_page'   => -1,
            'orderby'          => 'name',
            'order'            => 'ASC',
            'post_type'        => 'page',
        );
        $items = get_posts( $args );

        echo '<select id="'.self::$admin_page_option_name.'" name="'.self::$admin_page_option_name.'">';
        // empty option as default
        echo '<option value="0">'.__('— Select —', 'wordpress').'</option>';

        // foreach page we create an option element, with the post-ID as value
        foreach($items as $item) {

            // add selected to the option if value is the same as $project_page_id
            $selected = ($page_id == $item->ID) ? 'selected="selected"' : '';

            echo '<option value="'.$item->ID.'" '.$selected.'>'.$item->post_title.'</option>';
        }

        echo '</select>';
    }

    /**
     * Add custom state to post/page list
     */


    public static function addCustomPostStates($states) {
        global $post;

        // get saved project page ID
        $page_id = get_option(self::$admin_page_option_name);

        // add our custom state after the post title only,
        // if post-type is "page",
        // "$post->ID" matches the "$project_page_id",
        // and "$project_page_id" is not "0"
        if (!empty($post->ID)) {
            if ('page' == get_post_type($post->ID) && $post->ID == $page_id && $page_id != '0') {
                $states[] = __(self::$plural_name.' Archive Page');
            }
        }

        return $states;
    }

    public static function getListingPageID(){
        return get_option(self::$admin_page_option_name);
    }

}
