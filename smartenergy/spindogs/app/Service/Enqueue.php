<?php


namespace App\Service;

/**
 * Enqueuing Handler
 */
class Enqueue
{
    /**
     * Static Setup method
     * 
     * @return void
     */
    public static function setup()
    {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue'));
    }

    /**
     * Enqueue callback
     * 
     * @return void
     */
    public static function enqueue()
    {
        $file = '/css/main.css';
        if (file_exists(get_template_directory() . $file)) {
            wp_enqueue_style(
                'spindogs',
                get_template_directory_uri() . $file,
                array(),
                filemtime(get_template_directory() . $file),
                'all'
            );
        }

        $file = '/js/main.js';
        if (file_exists(get_template_directory() . $file)) {
            wp_enqueue_script(
                'spindogs',
                get_template_directory_uri() . $file,
                array(),
                filemtime(get_template_directory() . $file),
                true
            );
        }
    }
}