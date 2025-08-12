<?php

namespace App\Service;

/**
 * Customisations of the Wordpress Flexible Content Experience
 */
class ACFFlexibleContent
{

    public static function setup()
    {
        // Loads a stylesheet if present
        add_action('admin_enqueue_scripts', array(__CLASS__, 'css'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'js'));


        add_filter('acf/fields/flexible_content/layout_title', function ($title, $field, $layout, $i) {

            $templateDirectoryUri = get_template_directory_uri();
            $componentScreenshotUrl = "{$templateDirectoryUri}/images/flex-previews/".$layout['name'].".png";
            $newTitle = '<span class="spindogs-component-screenshot">';
            $newTitle .= '<img class="spindogs-component-screenshot-preview-image-small" width="100px" height="100px" src="' . $componentScreenshotUrl . '" loading="lazy">';
            $newTitle .= '<span class="spindogs-component-screenshot-label">' . $title . '</span>';
            $newTitle .= '</span>';
            $title = $newTitle;

            return $title;
        }, 11, 4);

    }


    /**
     * Enqueue admin style
     *
     * @return void
     */
    public static function css()
    {
        $admin_css = '/admin/css/admin.css';
        wp_enqueue_style(
            'spindogs-admin-css',
            get_template_directory_uri() . $admin_css,
            array(),
            filemtime(get_stylesheet_directory() . $admin_css),
            'all'
        );
    }

    /**
     * Enqueue admin style
     *
     * @return void
     */
    public static function js()
    {
        $admin_js = '/admin/js/admin.js';
        wp_enqueue_script(
            'spindogs-admin-js',
            get_template_directory_uri() . $admin_js,
            array('jquery-core'),
            filemtime(get_stylesheet_directory() . $admin_js),
            true
        );


    }

}
