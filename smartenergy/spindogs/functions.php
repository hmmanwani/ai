<?php
/**
 * Spindogs Functions.php
 */

// check for Platform
if (!class_exists('Spindogs\Platform\Setup')) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Spindogs Platform not found. Please install via composer.</p></div>';
        }
    );
    return;
}
// check for Timber
if (!class_exists('Timber\Timber')) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Timber not activated. Please visit <a href="/wp/wp-admin/plugins.php?plugin_status=mustuse">Plugins</a> and check it\'s installed.</p></div>';
        }
    );
    return;
}

add_filter('spindogs_disable_language_switcher', '__return_true');
add_filter('spindogs_enable_translation', '__return_false');

// Setup Platform
Timber\Timber::init();
Spindogs\Platform\Setup::setup();
Spindogs\Platform\Comments::disable(); 
Spindogs\Platform\Form::setup(); 

// Setup Timber
add_filter('timber/twig/environment/options', function($options) {

    $options['debug'] = WP_DEBUG;
    $options['autoescape'] = false;
    $options['cache'] = false;

    return $options;

});

// Add Menus
Spindogs\Platform\Menus::setup(
    array(
        'main_menu' => 'Main Menu',
        'footer_menu' => 'Footer Menu',
        'quick_links' => 'Quick Links'
    )
);
//Spindogs\Platform\Menus::setupDepths(
//    array(
//        'main_menu' => 2,
//        'footer_menu' => 0,
//        'mobile_menu' => 3,
//    )
//);

// Add Options Pages
Spindogs\Platform\OptionsPage::add('Header Section');
Spindogs\Platform\OptionsPage::add('Footer Section');
Spindogs\Platform\OptionsPage::add('Contact Details');
Spindogs\Platform\OptionsPage::add('Social Media');
Spindogs\Platform\OptionsPage::add('Theming');

// Setup PostTypes
App\PostType\Service::setup();
App\PostType\FAQ::setup();
App\PostType\CaseStudy::setup();
App\PostType\Post::setup();
App\PostType\Reviews::setup();
App\PostType\Authors::setup();

// Setup Services
App\Service\Enqueue::setup();
App\Service\Admin::setup();
App\Service\Search::setup();
App\Service\ACFFlexibleContent::setup();
App\Service\MultisiteNews::setup();

App\Taxonomy\FAQTaxonomy::setup();
App\Taxonomy\ServiceTaxonomy::setup();
App\Taxonomy\CaseStudyTaxonomy::setup();

// Add to Global Context for Twig
add_filter(
    'timber/context', 
    function ($context) {
       // add data to the global timber context here. 
       // $context['example'] = 'example';
        $context['theme'] = get_field('site_theme', 'option');
        if (!empty($context['theme']) && $context['theme'] == '__default'){
            $context['lines_background'] = 'home-lines-full.svg';
            $context['span_start'] = 'span-start.svg';
            $context['span_end'] = 'span-end.svg';
            $context['gradient_background'] = 'home-gradient.svg';
        } elseif (!empty($context['theme']) && $context['theme'] == '__theme-business'){
            $context['lines_background'] = 'business-lines-full.svg';
            $context['span_start'] = 'span-start-business.svg';
            $context['span_end'] = 'span-end-business.svg';
            $context['gradient_background'] = 'business-gradient.svg';
        } else {
            $context['lines_background'] = 'home-lines-full.svg';
            $context['span_start'] = 'span-start.svg';
            $context['span_end'] = 'span-end.svg';
            $context['gradient_background'] = 'home-gradient.svg';
        }

        return $context;
    }
);

function getPostsByCategory($category_id, $taxonomy = 'category')
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => array($category_id)
            )
        )
    );

    return get_posts($args);
}

// Enqueue Reviews Slider Styles
function enqueue_reviews_slider_styles() {
    wp_enqueue_style(
        'reviews-slider-css',
        get_template_directory_uri() . '/css/reviews-slider.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/reviews-slider.css'),
        'all'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_reviews_slider_styles');

// ACF Debug - Add this temporarily
add_action('admin_notices', function() {
    if (current_user_can('manage_options')) {
        echo '<div class="notice notice-info">';
        echo '<p><strong>ACF Debug Info:</strong></p>';
        echo '<p>ACF Function exists: ' . (function_exists('acf_get_field_groups') ? 'Yes' : 'No') . '</p>';
        echo '<p>ACF Version: ' . (defined('ACF_VERSION') ? ACF_VERSION : 'Not defined') . '</p>';
        echo '<p>ACF Pro: ' . (defined('ACF_PRO') ? 'Yes' : 'No') . '</p>';
        echo '<p>User Role: ' . wp_get_current_user()->roles[0] . '</p>';
        echo '<p>Can manage options: ' . (current_user_can('manage_options') ? 'Yes' : 'No') . '</p>';
        echo '<p>Can edit posts: ' . (current_user_can('edit_posts') ? 'Yes' : 'No') . '</p>';
        echo '<p>Is multisite: ' . (is_multisite() ? 'Yes' : 'No') . '</p>';
        echo '</div>';
    }
});

// Force ACF menu to show
add_action('admin_menu', function() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Custom Fields',
            'menu_title' => 'Custom Fields',
            'menu_slug' => 'edit.php?post_type=acf-field-group',
            'capability' => 'manage_options',
            'redirect' => false
        ));
    }
}, 99);



