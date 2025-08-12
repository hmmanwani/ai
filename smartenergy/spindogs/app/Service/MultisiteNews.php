<?php

namespace App\Service;


class MultisiteNews
{

    /**
     * Default post types.
     */
    public static $post_types = ['post'];
    public static $main_site = 1;

    /**
     * Adds language switcher to the page
     *
     * @return void
     */
    public static function setup()
    {
        if (is_multisite()) {
            if (get_current_blog_ID() == self::$main_site) {
                add_action('add_meta_boxes', array(__CLASS__, 'meta_box'));
            }
            add_action('save_post', array(__CLASS__, 'save_multisite_post'));
            add_action('admin_notices', array(__CLASS__, 'admin_notice'));
        }
    }

    public static function admin_notice() {

        if (get_current_blog_ID() == self::$main_site){
            return;
        }

        if (!isset($_GET['post'])){
            return;
        }

        $id = get_the_ID();
        $duplicated_from_id = get_post_meta($id, 'duplicated_from_id', true);

        if (!empty($duplicated_from_id) && $duplicated_from_id > 0) {
            switch_to_blog(self::$main_site);
            $original_url = get_edit_post_link($duplicated_from_id);
            restore_current_blog();
            echo '<div class="error"><p>This post cannot be updated here. Please visit <a href="'.$original_url.'">here</a> to update the content</p></div>';
            echo '<style>#acf-group_66a26f71db67b {display: none !important;}</style>';
            echo '<style>#acf-group_66968bd93edb4 {display: none !important;}</style>';
        }
    }

    /**
     * Adds meta box to the editor
     *
     * @return void
     */
    public static function meta_box()
    {
        add_meta_box(
            'multisite_meta_box',          // ID
            'Duplicate to Multisites',     // Title
            array(__CLASS__, 'multisite_meta_box_callback'), // Callback function
            self::$post_types,                        // Screen (Post type)
            'side'                         // Context (Location)
        );
    }

    public static function multisite_meta_box_callback($post) {

        $sites = get_sites();
        $current_blog_id = get_current_blog_id();
        $selected_sites = get_post_meta($post->ID, '_selected_sites', true) ?: [];
        $network_related_posts = get_post_meta($post->ID, '_network_related_posts', true) ?: [];

        foreach ($sites as $site) {
            $site_id = $site->blog_id;
            $site_name = $site->blogname;
            $checked = in_array($site_id, $selected_sites) ? 'checked' : '';
            if ($current_blog_id != $site_id) {
                echo '<label><input type="checkbox" name="multisite_sites[]" value="' . esc_attr($site_id) . '" ' . esc_attr($checked) . '> ' . esc_html($site_name) . '</label><br>';
            }
        }

        echo "<br><br>";

        foreach ($network_related_posts as $site_key => $post_key) {
            switch_to_blog($site_key);
            $site_info = get_site($site_key);
            $duplicated_post = get_post($post_key);
            if (post_exists($duplicated_post->post_title)) {
                echo 'View Post on ' . $site_info->blogname . ' <a href="' . get_permalink($duplicated_post->ID) . '">' . $duplicated_post->post_title . '</a>';
            }

            restore_current_blog();

        }

    }

    public static function save_multisite_post($post_id) {

        // Check for autosave, nonce, and user capabilities
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if (!isset($_POST['multisite_sites'])){
            return;
        }
        if (!current_user_can('edit_post', $post_id)){
            return;
        }

        // Save the selected multisite IDs
        $selected_sites = array_map('intval', $_POST['multisite_sites']);
        update_post_meta($post_id, '_selected_sites', $selected_sites);

        // Get the current post data
        $post = get_post($post_id);
        $post_data = array(
            'post_content' => $post->post_content,
            'post_title' => $post->post_title,
            'post_excerpt' => $post->post_excerpt,
            'post_status' => $post->post_status,
            'post_author' => $post->post_author,
            'post_category' => wp_get_post_categories($post_id),
            'tags_input' => wp_get_post_tags($post_id, array('fields' => 'names')),
            'comment_status' => $post->comment_status,
            'ping_status' => $post->ping_status,
        );

        $network_related_posts = [];

        $featured_image_id = get_post_thumbnail_id($post_id);
        $featured_image_url = null;

        // Check if the post has a featured image
        if ($featured_image_id) {
            $featured_image_url = wp_get_attachment_url($featured_image_id);
        }

        remove_action('save_post', array(__CLASS__, 'save_multisite_post'));

        if (!empty($selected_sites)) {

            $duplicate_post_data = $post_data;

            //Duplicate the post to the selected multisites
            foreach ($selected_sites as $site_id) {
                switch_to_blog($site_id);

                // Update an existing post if it exists
                $new_post_id = self::get_existing_post_id($post_id, $duplicate_post_data['post_type'] ?? 'post');
                $duplicate_post_data['ID'] = $new_post_id;

                $new_post_id = wp_insert_post($duplicate_post_data);

                if (empty($new_post_id) || !is_int($new_post_id)) {
                    restore_current_blog();
                    return;
                }

                $image_id = 0;

                if (!empty($featured_image_url)) {
                    
                    $do_clone_thumbnail = true;
                    
                    // Don't clone the thumbnail again if we already have it
                    $check_featured_image_id = get_post_thumbnail_id($new_post_id);

                    if (!empty($check_featured_image_id)) {
                        $check_featured_image_source_url = get_post_meta($check_featured_image_id, 'duplicated_from_url', true);

                        if (!empty($check_featured_image_source_url) && $featured_image_url == $check_featured_image_source_url) {
                            $do_clone_thumbnail = false;
                        }
                    }

                    if ($do_clone_thumbnail) {
                        // Import the featured image to the target site
                        $image_id = self::import_image_from_url($featured_image_url);
    
                        // Set the image as featured
                        if (!empty($image_id) && is_int($image_id)) {
                            set_post_thumbnail($new_post_id, $image_id);
                        }
                    }

                } else {
                    delete_post_thumbnail($new_post_id);
                }


                update_post_meta($new_post_id, 'duplicated_from', 1);
                update_post_meta($new_post_id, 'duplicated_from_id', $post_id);

                $network_related_posts[$site_id] = $new_post_id;

                restore_current_blog();
            }

            update_post_meta($post_id, '_network_related_posts', $network_related_posts);

        }

        add_action('save_post', array(__CLASS__, 'save_multisite_post'));
    }

    // Helper function to import image from URL
    public static function import_image_from_url($image_url) {

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Check if we already have the attachment
        $args = [
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'fields' => 'ids',
            'meta_query' => [
                [
                    'key' => 'duplicated_from_url',
                    'value' => $image_url,
                ],
            ],
        ];

        $existing_attachments = get_posts($args);

        if (!empty($existing_attachments[0]) && is_int($existing_attachments[0])) {
            return $existing_attachments[0];
        }

        // Download the image
        $temp_file = download_url($image_url);

        if (is_wp_error($temp_file)) {
            return null;
        }

        // Upload the file to the media library
        $file = array(
            'name'     => basename($image_url),
            'type'     => mime_content_type($temp_file),
            'tmp_name' => $temp_file,
            'error'    => 0,
            'size'     => filesize($temp_file),
        );

        $image_id = media_handle_sideload($file, 0);

        // Delete the temporary file
        @unlink($temp_file);

        if (is_wp_error($image_id)) {
            return null;
        }

        update_post_meta($image_id, 'duplicated_from_url', $image_url);

        return $image_id;
    }

    /**
     * Check if a duplicated post already exists and return its ID if so. Return 0 otherwise.
     */
    public static function get_existing_post_id(int $post_id, string $post_type = 'post'): int
    {
        $existing_post = get_posts(array(
            'post_type' => $post_type,
            'post_status' => 'any',

            'meta_query' => [
                [
                    'key' => 'duplicated_from_id',
                    'value' => $post_id,
                    'compare' => '=',
                    'type' => 'numeric',
                ],
            ],

            'fields' => 'ids',
            'posts_per_page' => 1,
        ));

        if (!empty($existing_post[0]) && is_int($existing_post[0])) {
            return $existing_post[0];
        }

        return 0;
    }

}
