<?php
/**
 * Plugin Name: Report Panel
 * Description: 
 * Version: 0.1.1
 * Author: Jerico Juegos
 * License: GPLv2 or later
 */

namespace Jay\WpReportpanelSdd;

if ( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access

use tangible\framework;
use tangible\updater;

define( 'WP_REPORTPANEL_SDD_VERSION', '0.1.1' );

require __DIR__ . '/vendor/tangible/framework/index.php';
require __DIR__ . '/vendor/tangible/updater/index.php';
require __DIR__ . '/vendor/tangible/fields/index.php';

class Plugin {
    public static $plugin;
    public $settings;

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init_framework' ] );
        add_action( 'plugins_loaded', [ $this, 'init_updater' ], 11 );
        add_action( 'plugins_loaded', [ $this, 'load_includes' ], 12 );
    }
 
    public function init_framework() {
        if ( defined( 'WP_SANDBOX_SCRAPING' ) ) return;

        self::$plugin = framework\register_plugin([
            'name'           => 'wp-reportpanel-sdd',
            'title'          => 'Report Panel',
            'setting_prefix' => 'wp_reportpanel_sdd',
            'version'        => '0.1.1',
            'file_path'      => __FILE__,
            'base_path'      => plugin_basename( __FILE__ ),
            'dir_path'       => plugin_dir_path( __FILE__ ),
            'url'            => plugins_url( '/', __FILE__ ),
            'assets_url'     => plugins_url( '/assets', __FILE__ ),
        ]);
    }

    public function init_updater() {
        updater\register_plugin([
            'name' => self::$plugin->name ?? 'wp-reportpanel-sdd',
            'file' => __FILE__,
        ]);
    }

    public function load_includes() {
        require_once __DIR__ . '/includes/admin/settings.php';

        $this->settings = new \Jay\WpReportpanelSdd\Admin\Settings( self::$plugin );
    }

}

// Initialize the plugin
new Plugin();