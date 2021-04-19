<?php
/**
 * Plugin Name: Lost and Found
 * Version: 1.2
 * Description: Creates a shortcode to display a form which allows users to submit to a Lost and Found custom post type with custom fields and a custom Taxonomy. Use <strong>[lostfound_form]</strong> to display the form.
 * Plugin URI: https://github.com/omfgtora/lostfound
 * Author: Ethan Roberts
 * License: GPL v3 or later
 * Licence URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: lostfound
 */

if( !defined( 'ABSPATH' ) || !class_exists('LostFound') ) return;

register_deactivation_hook( __FILE__, ['LostFound', 'deactivate'] );

Class LostFound {

  private static $instance = null;

  public function __construct() {
    // Define path and URL to the ACF plugin.
    define( 'LOSTFOUND_ACF_PATH', plugin_dir_path(__FILE__) . 'includes/acf/' );
    define( 'LOSTFOUND_ACF_URL', plugin_dir_url(__FILE__) . 'includes/acf/' );

    add_action( 'init', [$this, 'initialize'], 0, 0 );
    add_action( 'get_header', [$this, 'load_acf_form_head'], 0, 0 );
    add_shortcode( 'lostfound_form', [$this, 'register_form_shorcode'] );
    //add_action( 'wp_head', [$this, 'zerospam_load_key']);
  }

  public static function instance() {
    if( isset(self::$instance) ) return self::$instance;

    return self::$instance = new LostFound();
  }

  public function initialize() {
    // Bail early if called directly from functions.php or plugin file.
    if( !did_action('plugins_loaded') ) return;

    $this->include_acf();
    $this->register_cpt_tax();
    $this->create_default_terms();
    require_once('acf_fields.php');
  }

  public static function deactivate() {
    delete_option('lostfound_terms_created');
    // delete_option('lostfound_zerospam_key');
  }

  // Register Post type and Taxonomy
  private function register_cpt_tax() {
    register_post_type( 'lostfound', [
      'labels' => [
        'name' => __( 'Lost and Found Pets', 'lostfound' ),
        'singular_name' => __( 'Lost and Found Pet', 'lostfound' ),
      ],
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-pets',
      'rewrite' => ['slug' => 'lostfound'],
      'supports' => [
        'title',
        'editor',
        'author',
        'thumbnail',
        'custom-fields',
        'pet-types',
        'comments',
      ],
      'taxonomies' => ['pet-types', 'post_tag'],
    ]);

    register_taxonomy( 'pet-type', 'lostfound', [
      'labels' => [
        'name' => __( 'Pet type', 'lostfound' ),
        'singular_name' => __( 'Pet type', 'lostfound' ),
      ],
      'rewrite' => ['slug' => 'pet-type'],
      'show_admin_column' => true,
      'supports' => [
        'title',
        'editor',
        'author',
      ]
    ]);
  }

  private function create_default_terms() {
    if ( get_option('lostfound_terms_created') ) return;

    wp_insert_term('Cat', 'pet-type');
    wp_insert_term('Dog', 'pet-type');
    wp_insert_term('Other', 'pet-type');

    update_option( 'lostfound_terms_created', true );
  }

  private function include_acf() {
    // Include the ACF plugin.
    include_once( LOSTFOUND_ACF_PATH . 'acf.php' );

    // Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', function($url) {
      return LOSTFOUND_ACF_URL;
    });

    // Hide the ACF admin menu item.
    add_filter( 'acf/settings/show_admin', '__return_false' );
  }

  public function load_acf_form_head() {    
    if( !has_shortcode( get_post(get_the_ID())->post_content, "lostfound_form" ) ) return;

    acf_form_head();
  }

  public function register_form_shorcode($atts) {
    // wp_enqueue_script( 'lostfound_zerospam', plugin_dir_url(__FILE__) . 'includes/js/zerospam.js', [], NULL, true );
    // add_action( 'wp_enqueue_scripts', 'lostfound_zerospam' );

    $atts = shortcode_atts( [], $atts, 'lostfound_form' );

    $settings = [
      'id' => 'lostfound-form',
      'post_id' => 'new_post',
      'new_post' => [
        'post_type'   => 'lostfound',
        'post_status' => 'pending'
      ],
      'field_groups' => ['lostfound-form-groups'],
      'form' => true,
      'updated_message' => __( "Thank you for your submission!", 'acf' ),
      'honeypot' => true,
      'submit_value' => __( "Submit", 'acf' ),
    ];

    return acf_form($settings);
  }

  // Temporarily unused
  private function zerospam_get_key() {
    $key = get_option('lostfound_zerospam_key');
    if ( !empty($key) ) return $key;

    $key = wp_generate_password( 64, false, false );
    update_option( 'lostfound_zerospam_key', $key, FALSE );
  }

  // Temporarily unused
  // Should be replace with acf/render_field hook
  public function zerospam_load_key() {
    $key = $this->zerospam_get_key();
    $sanitized_key = esc_js($key);
    echo "<script> const lfzs_key = ${sanitized_key};</script>";
  }

} // End LostFound class

// Instantiate.
LostFound::instance();