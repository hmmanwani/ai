<?php

namespace App\Service;

/**
 * Customisations of the Wordpress Admin Experience
 */
class Admin
{
    /**
     * ID of the `spindogs` user account
     *
     * @var integer
     */
    protected static $super_admin_id = 1;

    /**
     * The relative path to the site's logo in 
     * `site_id => path` format
     *
     * @var array
     */
    protected static $site_logo = array(
        1 => '/images/smart-energy-homes.svg',
        2 => '/images/smart-energy-homes.svg',
    );
    
    /**
     * The primary colour used on the site in
     * `site_id => hex` format
     *
     * @var array
     */
    protected static $site_primary_colour = array(
        1 => '#120424',
        2 => '#120424',
    );

    /**
     * The text colour used on the site in
     * `site_id => hex` format
     *
     * @var array
     */
    protected static $site_text_colour = array(
        1 => false,  // will default to white/black depending on primary colour
        2 => false,  // will default to white/black depending on primary colour
    ); 

    /**
     * The background colour used on the site in
     * `site_id => hex` format
     *
     * @var array
     */
    protected static $site_background_colour = array(
        1 => "#161616", 
        2 => "#161616", 
    );

    /**
     * The background sub colour used on the site in
     * `site_id => hex` format
     *
     * @var array
     */
    protected static $site_background_sub_colour = array(
        1 => '#363636',
        2 => '#363636',
    );

    /**
     * Removes menu items for admins that aren't us.
     * 
     * @return void
     */
    public static function removeMenuItems()
    {
        if (get_current_user_id() != self::$super_admin_id) {
            //remove_menu_page('index.php');                 //Dashboard
            //remove_menu_page( 'edit.php' );               //Media
            remove_menu_page('themes.php');                 //Appearance
            //remove_menu_page('users.php');                //Users
            // remove_menu_page('tools.php');                  //Tools
            // remove_menu_page('options-general.php');        //Settings
            remove_menu_page('edit.php?post_type=acf-field-group'); // acf
            remove_menu_page('plugins.php');                //Plugins
        }
    }

    /**
     * Gets the primary colour of the site.
     * 
     * Allows this to be overriden if we were to do multisite or something.
     * 
     * @return string
     */
    private static function getPrimaryColour()
    {
        return self::$site_primary_colour[get_current_blog_id()] ?: self::$site_primary_colour[1];
    }

    /**
     * Gets the text colour of the site.
     * 
     * @return string
     */
    private static function getTextColour()
    {
        if (self::$site_text_colour[get_current_blog_id()]) {
            return self::$site_text_colour[get_current_blog_id()];
        }

        return self::colour_is_light(self::getPrimaryColour()) ? '#161616' : '#e9e9e9';
    }

    /**
     * Gets the background colour of the site.
     * 
     * @return string
     */
    private static function getBackgroundColour()
    {
        return self::$site_background_colour[get_current_blog_id()] ?: self::$site_background_colour[1];
    }

    /**
     * Gets the background sub colour of the site.
     * 
     * @return string
     */
    private static function getBackgroundSubColour()
    {
        return self::$site_background_sub_colour[get_current_blog_id()] ?: self::$site_background_sub_colour[1];
    }

    /**
     * Gets the LOGO url of the site.
     *
     * @return string
     */
    private static function getSiteLogo()
    {
        return get_template_directory_uri() . self::$site_logo[get_current_blog_id()] ?: self::$site_logo[1];
    }

    /**
     * Amends the Admin areas with our customisations
     * 
     * @return void
     */
    public static function setup()
    {
        // limits access to features for non-spindogs users.    
        add_action('admin_menu', array(__CLASS__, 'removeMenuItems'));

        // Loads a stylesheet if present
        add_action('admin_enqueue_scripts', array(__CLASS__, 'css'));

        // updates the style
        add_action('admin_enqueue_scripts', array(__CLASS__, 'customDashboardStyle'));
        add_action('login_enqueue_scripts', array(__CLASS__, 'customLoginStyle'));

        // updates the footer text on the dashboard
        add_filter('admin_footer_text', array(__CLASS__, 'updateDashboardFooterText'));

        // Add Filtering by Page Template on the Pages Dashboard
        add_action('restrict_manage_posts', array(__CLASS__, 'pageTemplateFilterDropdown'));
        add_filter('request', array(__CLASS__, 'filterPageList'));

        // Remove Dashboard Meta Boxes
        add_action('admin_init', array(__CLASS__, 'removeDashboardMetaBoxes'));

        // Change the logo on the login screen to redirect to the site url instead of wordpress.org.
        add_filter('login_headerurl', array(__CLASS__, 'loginLogoUrl'));
    }

    /**
     * Removes dashboard meta boxes.
     * 
     * @return void
     */
    public static function removeDashboardMetaBoxes() : void
    {
        // remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Right Now
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Incoming Links
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
        // remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Press
        // remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Recent Drafts
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress blog
        remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // Other WordPress News
        remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Site Health
    }

    /**
     * Outputs the filter-by page-template on page-list views
     * 
     * @return void
     */
    public static function pageTemplateFilterDropdown() : void
    {
        $screen = get_current_screen();
        if ($screen && $screen->id === 'upload') {
            return;
        }

        $template = isset($_GET['page_template_filter']) ? $_GET['page_template_filter'] : "all";
        $default_title = apply_filters('default_page_template_title', __('Default Template'), 'meta-box');
        ?>
        <select name="page_template_filter" id="page_template_filter">
            <option value="">All Page Templates</option>
            <option value="default" <?php selected($template, 'default'); ?>><?php echo esc_html($default_title); ?></option>
            <?php page_template_dropdown($template); ?>
        </select>
        <?php
    }


    /**
     * Setups variables to filter pages by their template
     * 
     * @param array $vars Existing request variables
     * 
     * @return array The new request variables.
     */
    public static function filterPageList($vars)
    {

        if (!isset($_GET['page_template_filter'])) {
            return $vars;
        }

        $template = trim($_GET['page_template_filter']);
        if (empty($template)) {
            return $vars;
        }

        $vars = array_merge(
            $vars,
            array(
                'meta_query' => array(
                    array(
                        'key'     => '_wp_page_template',
                        'value'   => $template,
                        'compare' => '=',
                    ),
                ),
            )
        );
        return $vars;
    }

    /**
     * Adds this content to the foot of the WP-Admin dashboard
     *
     * @return void
     */
    public static function updateDashboardFooterText()
    {
        echo '<span id="footer-thankyou">Developed by <a href="http://www.spindogs.co.uk" target="_blank">Spindogs</a></span>';
    }

    /**
     * Returns current blog URL
     * 
     * @param string $url The URL
     * 
     * @return string
     */
    public static function loginLogoUrl($url)
    {
        return get_bloginfo('url');
    }

    /**
     * Outputs the style for the login screen
     *
     * @return void
     */
    public static function customLoginStyle()
    {

        $site_logo = self::getSiteLogo();
        $colour = self::getPrimaryColour();

        $style = '
            #login h1 a {
                background-image: url(' . $site_logo . ') !important;
                height:120px !important;
                width: 160px !important;
                background-size: 150px !important;
            }

            body.login {
                background-color: ' . $colour . ';
            }

            body.login #backtoblog,
            body.login #nav {
                display: block;
                background-color: #fff;
                margin: 0;
                text-align: left;
            }

            body.login #backtoblog {
                padding-bottom: 20px;
            }

            body.login #backtoblog a:hover, 
            body.login #nav a:hover {
                color: ' . $colour . ';
            }
            body.login .message {
                border-left: none;
                margin-bttom: none;
            }
            body.login form {
                padding: 24px;
                border: 2px solid #FFFFFF;
                box-shadow: none;
            }
            #wp-submit {
                background-color: ' . $colour . ';
                border-color: ' . $colour . ';
                box-shadow: none;
            }
            
        }';
        wp_add_inline_style('login', $style);
    }



    /**
     * Outputs the style on the dashboard screen
     *
     * @return void
     */
    public static function customDashboardStyle()
    {
        $colour = self::getPrimaryColour();
        $contrast = self::getTextColour();
        $background_colour = self::getBackgroundColour();
        $backgorund_sub_colour = self::getBackgroundSubColour();

        $style = '
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                content: "\f533";
            }       
            
            #adminmenuback,
            #adminmenuwrap,
            #adminmenu,
            #wpadminbar {
                background: ' . $background_colour . ';
            }
            
            #adminmenu .wp-submenu,
            #wpadminbar .menupop .ab-sub-wrapper,
            #wpadminbar .quicklinks .menupop ul.ab-sub-secondary,
            #wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu {
                background-color: ' . $backgorund_sub_colour . ' !important;
            }

            #wpadminbar .ab-top-menu > li.hover > .ab-item, 
            #wpadminbar .ab-top-menu > li.menupop.hover > .ab-item, 
            #wpadminbar .ab-top-menu > li:hover > .ab-item, 
            #wpadminbar .ab-top-menu > li > .ab-item:focus, 
            #wpadminbar-nojs .ab-top-menu > li.menupop:hover > .ab-item, 
            #wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus,
            #wpadminbar .quicklinks ul li a:hover,
            #adminmenu li.wp-menu-open .wp-has-current-submenu,
            #adminmenu li.current a,
            #adminmenu li.menu-top a:hover,
            #adminmenu li.opensub > a,
            #adminmenu li a:hover,
            #adminmenu li a:focus,
            #collapse-button:hover,
            #collapse-button:focus {
                background-color: ' . $colour . ' !important;
                color: ' . $contrast . ' !important;
            }

            #adminmenu li.opensub .wp-menu-image::before,
            #adminmenu li:hover .wp-menu-image::before,
            #adminmenu li:focus .wp-menu-image::before,
            #adminmenu li.wp-menu-open:hover .wp-menu-image::before,
            #adminmenu li.wp-menu-open:focus .wp-menu-image::before,
            #adminmenu li.current:hover .wp-menu-image::before,
            #adminmenu li.current:focus .wp-menu-image::before,
            #adminmenu li.wp-menu-open a:hover,
            #adminmenu li.wp-menu-open a:focus,
            #adminmenu li.current a:hover,
            #adminmenu li.current a:focus,
            #adminmenu a,
            #wpadminbar .ab-empty-item, 
            #wpadminbar a.ab-item, 
            #wpadminbar > #wp-toolbar span.ab-label, 
            #wpadminbar > #wp-toolbar span.noticon,
            #wpadminbar .menupop .menupop > .ab-item:hover:before, 
            #wpadminbar .quicklinks .menupop ul li a:focus,
            #wpadminbar .ab-submenu .ab-item,
            #wpadminbar .quicklinks .menupop ul li a,
            #wpadminbar .quicklinks .menupop.hover ul li a,
            #wpadminbar-nojs .quicklinks .menupop:hover ul li a 
            #wpadminbar .quicklinks .menupop ul li a:focus strong,
            #wpadminbar .quicklinks .menupop ul li a:hover,
            #wpadminbar .quicklinks .menupop ul li a:hover strong,
            #wpadminbar .quicklinks .menupop.hover ul li a:focus,
            #wpadminbar .quicklinks .menupop.hover ul li a:hover,
            #wpadminbar .quicklinks li a:hover .blavatar,
            #wpadminbar li .ab-item:focus:before,
            #wpadminbar li a:focus .ab-icon:before,
            #wpadminbar li.hover .ab-icon:before,
            #wpadminbar li.hover .ab-item:after,
            #wpadminbar li.hover .ab-item:before,
            #wpadminbar li:hover #adminbarsearch:before,
            #wpadminbar li:hover .ab-icon:before,
            #wpadminbar li:hover .ab-item:after,
            #wpadminbar li:hover .ab-item:before,
            #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus,
            #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
                color: ' . $contrast . ' !important;
            }
        ';

        wp_add_inline_style('dashboard', $style);
    }

    /**
     * Enqueue admin style
     * 
     * @return void
     */
    public static function css()
    {
        $admin_css = '/admin/css/admin.css';
        if (file_exists(get_stylesheet_directory() . $admin_css)) {
            wp_enqueue_style(
                'spindogs-admin',
                get_template_directory_uri() . $admin_css,
                array(),
                filemtime(get_stylesheet_directory() . $admin_css),
                'all'
            );
        }
    }

    /**
     * Detects if a colour is dark or light
     * 
     * @param string $colour The colour to check ie. '#ffffff'
     * 
     * @return bool
     */
    private static function colour_is_light(string $color): bool
    {
        $hex = str_replace('#', '', $color);

        $c_r = hexdec(substr($hex, 0, 2));
        $c_g = hexdec(substr($hex, 2, 2));
        $c_b = hexdec(substr($hex, 4, 2));

        $brightness = (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;

        return $brightness > 155;
    }
}
