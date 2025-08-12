<?php
namespace App\Taxonomy;
/**
 * App Taxonomy Class
 */
class FAQTaxonomy
{
    protected static $taxonomy = 'faq_category';
    protected static $associated_post_types = ['faq']; //['example', 'example2']
    protected static $taxonomy_name = 'FAQ Categories';
    protected static $taxonomy_url = 'faq_categories';

    /**
     * Registers the Taxonomy in WP
     *
     * @return void
     */
    public static function setup()
    {
        $args = array(
            'label' => self::$taxonomy_name,
            'public' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            'rewrite' => ['slug' => self::$taxonomy_url, 'with_front' => false]
        );

        register_taxonomy(self::$taxonomy, self::$associated_post_types, $args);
    }
}
