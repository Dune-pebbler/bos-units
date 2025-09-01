<?php
defined("ABSPATH") || die("-1");

# DEFINES
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_TD', sanitize_title(get_bloginfo("title")));

# REQUIRES
include("shortcodes/shortcodes.php");

# ACTIONS
add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
// add_action('wp_ajax_filter_projects', 'filter_projects');
// add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

# FILTERS
add_filter('wp_page_menu_args', 'home_page_menu_args');
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'add_image_responsive_class');
add_filter('upload_mimes', 'cc_mime_types');
add_filter('use_block_editor_for_post', '__return_false');
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

# THEME SUPPORTS
add_theme_support('menus');
add_theme_support('post-thumbnails'); // array for post-thumbnail support on certain post-types.
add_theme_support('woocommerce'); // array for post-thumbnail support on certain post-types.

# IMAGE SIZES
add_image_size('default-thumbnail', 128, 128, true); // true: hard crop or empty if soft crop

set_post_thumbnail_size(128, 128, true);

# FUNCTIONS
register_nav_menus(array(
  'primary' => __('Primary Menu', THEME_TD),
  'footer-1' => __('Footer 1 Menu', THEME_TD),
  'footer-2' => __('Footer 2 Menu', THEME_TD),
));


function theme_enqueue_styles()
{
  // wp_enqueue_style('fontawesome.all.min.js', get_template_directory_uri() . "/assets/fontawesome/css/all.min.css");
  // wp_enqueue_style('theme-jquery.fancybox.min.css', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.css");
  wp_enqueue_style('owl.carousel.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.css");
  wp_enqueue_style('owl.carousel.default.theme.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.theme.default.min.css");
  wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . "/stylesheets/bootstrap-grid.css");
  wp_enqueue_style('styles-main', get_template_directory_uri() . "/stylesheets/style.css", [], filemtime(get_template_directory() . "/stylesheets/style.css"));
}
function theme_enqueue_scripts()
{
  wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.js", ['jquery'], '1.0.0', true);
  // wp_enqueue_script('jquery.fancybox.min.js', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.js", ['jquery'],  '1.0.0', true);
  // wp_enqueue_script('js-in-view', get_template_directory_uri() . "/js/lib/in-view.js", ['jquery'], '1.0.0', true);
  // wp_enqueue_script('js-masonry', get_template_directory_uri() . "/js/lib/masonry.js", ['jquery'], '1.0.0', true);

  wp_enqueue_script('js-main', get_template_directory_uri() . "/js/main.js", ['jquery'], filemtime(get_template_directory() . "/js/main.js"), true);
}


function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf';
  return $path;
}
function my_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf';
  return $paths;
}
function home_page_menu_args($args)
{
  $args['show_home'] = true;
  return $args;
}
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}
function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}
function add_image_responsive_class($content)
{
  global $post;
  $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
  $replacement = '<img$1class="$2 img-responsive"$3>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
function ds_admin_theme_style()
{
  if (!current_user_can('manage_options')) {
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
  }
}
// Method 1: Filter.
function my_acf_google_map_api($api)
{
  $api['key'] = '';
  return $api;
}

# Random code
// add editor the privilege to edit theme
// get the the role object
$role_object = get_role('editor');
// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');

if (function_exists('acf_add_options_sub_page')) {
  acf_add_options_page();
  acf_add_options_sub_page('Footer');
  acf_add_options_sub_page('Header');
  // acf_add_options_sub_page('Globale Opties');
  // acf_add_options_sub_page('Socials');
  //     acf_add_options_sub_page( 'Side Menu' );
}

function my_theme_modify_nieuws_archive_query($query)
{
  // Check if we are on the main query in the admin area or not
  if (!is_admin() && $query->is_main_query()) {

    // Check if we are on the 'nieuws-bericht' archive page
    if (is_post_type_archive('nieuws-bericht')) {

      // Set the post type to 'nieuws-bericht'
      $query->set('post_type', 'nieuws-bericht');

      // Set the number of posts to display per page
      $query->set('posts_per_page', 9); // You can change this number
    }
  }
}
add_action('pre_get_posts', 'my_theme_modify_nieuws_archive_query');
?>