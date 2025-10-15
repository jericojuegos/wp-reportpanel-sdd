<?php
/**
 * Plugin Name: Report Panel
 * Plugin URI: https://tangibleplugins.com/wp-reportpanel-sdd
 * Description: 
 * Version: 0.1.1
 * Author: Team Tangible
 * Author URI: https://teamtangible.com
 * License: GPLv2 or later
 */
use tangible\framework;
use tangible\updater;

define( 'WP_REPORTPANEL_SDD_VERSION', '0.1.1' );

require __DIR__ . '/vendor/tangible/framework/index.php';
require __DIR__ . '/vendor/tangible/updater/index.php';

/**
 * Get plugin instance
 */
function wp_reportpanel_sdd($instance = false) {
  static $plugin;
  return $plugin ? $plugin : ($plugin = $instance);
}

add_action('plugins_loaded', function() {

  // See https://github.com/TangibleInc/framework/#note-on-plugin-activation
  if (defined('WP_SANDBOX_SCRAPING')) return;

  $plugin    = framework\register_plugin([
    'name'           => 'wp-reportpanel-sdd',
    'title'          => 'Report Panel',
    'setting_prefix' => 'wp_reportpanel_sdd',
    'version'        => WP_REPORTPANEL_SDD_VERSION,
    'file_path' => __FILE__,
    'base_path' => plugin_basename( __FILE__ ),
    'dir_path' => plugin_dir_path( __FILE__ ),
    'url' => plugins_url( '/', __FILE__ ),
    'assets_url' => plugins_url( '/assets', __FILE__ ),
  ]);

  updater\register_plugin([
    'name' => $plugin->name,
    'file' => __FILE__,    
  ]);

  wp_reportpanel_sdd( $plugin );

  require_once __DIR__.'/includes/index.php';

}, 10);
