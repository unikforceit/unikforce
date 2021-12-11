<?php
/**
 * Unikforce functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Unikforce
 */

if (!defined('UNIKFORCE_VERSION')) {
    // Replace the version number of the theme on each release.
    define('UNIKFORCE_VERSION', '1.0.1');
}

if (!function_exists('unikforce_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function unikforce_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on unikforce, use a find and replace
         * to change 'unikforce' to the name of your theme in all the template files.
         */
        load_theme_textdomain('unikforce', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'unikforce'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'unikforce_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 90,
                'width' => 90,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'unikforce_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function unikforce_content_width()
{
    $GLOBALS['content_width'] = apply_filters('unikforce_content_width', 640);
}

add_action('after_setup_theme', 'unikforce_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function unikforce_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'unikforce'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'unikforce'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );


}

add_action('widgets_init', 'unikforce_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function unikforce_scripts()
{
    wp_enqueue_style('unikforce-style', get_stylesheet_uri(), array(), UNIKFORCE_VERSION);
    wp_style_add_data('unikforce-style', 'rtl', 'replace');

    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome/css/fontawesome-all-v5.3.1.min.css');
    wp_enqueue_style('unikforce-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);

    wp_enqueue_script('unikforce-navigation', get_template_directory_uri() . '/js/navigation.js', array(), UNIKFORCE_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'unikforce_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Breadcbrumbs
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Custom comment walker.
require get_template_directory() . '/inc/class-walker-comment.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-typography.php';


/**
 * Compare page CSS
 */

function unikforce_comparepage_css($hook)
{
    if ('appearance_page_unikforce-info' != $hook) {
        return;
    }
    wp_enqueue_style('unikforce-custom-style', get_template_directory_uri() . '/css/compare.css');
}

add_action('admin_enqueue_scripts', 'unikforce_comparepage_css');
