<?php

namespace Helsingborg\Theme;

class Support
{
    public function __construct()
    {
        self::removeActions();
        self::addActions();
        self::addFilters();
        self::removeTheGenerator();

        add_filter('srm_max_redirects', array($this, 'srmMaxRedirects'));
        add_action('template_redirect', array($this, 'blockAuthorPages'), 5);
        add_action('init', array($this, 'removePostPostType'), 11);
    }

    /**
     * Removes the post type "post"
     * @return boolean
     */
    public function removePostPostType()
    {
        global $wp_post_types;

        if (isset($wp_post_types['post'])) {
            if (!defined("WP_ENABLE_POSTS") || (defined("WP_ENABLE_POSTS") && WP_ENABLE_POSTS !== true)) {
                unset($wp_post_types['post']);
                add_action('admin_menu', function () {
                    remove_menu_page('edit.php');
                });
            }

            return true;
        }

        return false;
    }

    /**
     * Removes unwanted actions.
     */
    private static function removeActions()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }

    /**
     * Add actions.
     */
    private static function addActions()
    {
        add_action('after_setup_theme', '\Helsingborg\Theme\Support::themeSupport');
    }

    /**
     * Add filters.
     */
    private static function addFilters()
    {
        add_filter('intermediate_image_sizes_advanced', '\Helsingborg\Theme\Support::filterThumbnailSizes');
        add_filter('gettext', '\Helsingborg\Theme\Support::changeDefaultTemplateName', 10, 3);
    }

    /**
     * Add theme support.
     */
    public static function themeSupport()
    {
        add_theme_support('menus');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'gallery',
                'link',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat'
            )
        );
    }

    /**
     * Remove medium thumbnail size for all uploaded images.
     * @param array $sizes Default sizes
     * @return array New sizes
     */
    public static function filterThumbnailSizes($sizes)
    {
        unset($sizes['medium']);

        return $sizes;
    }

    /**
     * Change "Default template" to "Article".
     */
    public static function changeDefaultTemplateName($translation, $text, $domain)
    {
        if ($text == 'Default Template') {
            return _('Artikel');
        }

        return $translation;
    }

    /**
     * Removes the generator meta tag from <head>.
     */
    public static function removeTheGenerator()
    {
        add_filter('the_generator', create_function('', 'return "";'));
    }

    /**
     * Blocks request to the author pages (?author=<ID>).
     * @return void
     */
    public function blockAuthorPages()
    {
        global $wp_query;

        if (is_author() || is_attachment()) {
            $wp_query->set_404();
        }

        if (is_feed()) {
            $author = get_query_var('author_name');
            $attachment = get_query_var('attachment');
            $attachment = (empty($attachment)) ? get_query_var('attachment_id') : $attachment;

            if (!empty($author) || !empty($attachment)) {
                $wp_query->set_404();
                $wp_query->is_feed = false;
            }
        }
    }

    /**
     * Update the default maximum number of redirects to 400.
     */
    public function srmMaxRedirects()
    {
        return 400;
    }
}
