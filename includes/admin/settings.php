<?php declare(strict_types=1);

namespace Jay\WpReportPanelSdd\Admin;

if ( ! defined( 'ABSPATH' ) ) exit;

use tangible\framework;
use Jay\WpReportPanelSdd\Plugin;

class Settings {
    
    public function __construct() {
      $this->register_settings();
    }
    
    public function register_settings() {
      \tangible\framework\register_plugin_settings(Plugin::$plugin, [
        'css' => Plugin::$plugin->assets_url . '/build/admin.min.css',
        'title_callback' => function() {
            ?>
            <img class="plugin-logo"
                src="<?= Plugin::$plugin->assets_url ?>/images/tangible-logo.png"
                alt="Test Logo"
                width="40"
            >
            <?= Plugin::$plugin->title ?>
            <?php
        },
        'tabs' => [
            'welcome' => [
                'title' => 'Welcome',
                'callback' => function() {
                  ?>
                    Hello, world.

                    <ul>
                      <li>Plugin: <?php echo Plugin::$plugin->title; ?></li>
                      <li>Version: <?php echo Plugin::$plugin->version; ?></li>
                      <li>Assets URL: <?php echo Plugin::$plugin->assets_url; ?></li>                  
                    </ul>

                  <?php
                }
            ],
            'features' => [
                'title' => 'Features',
                'callback' => function() {
                    framework\render_features_settings_page( Plugin::$plugin );
                }
            ],
        ],
        'features' => [
            [
                'name' => 'example',
                'title' => 'First feature',
                'entry_file' => __DIR__ . '/../features/example.php'
            ],
            [
                'name' => 'example_2',
                'title' => 'Second feature',
                'entry_file' => __DIR__ . '/../features/example-2.php',
            ],
        ],
      ]);
    }
    
    public function register_admin_notice() {
        $welcome_notice_key = Plugin::$plugin->setting_prefix . '_welcome_notice';

        if (framework\is_admin_notice_dismissed($welcome_notice_key)) {
            return;
        }

        if (isset($_GET['dismiss_admin_notice'])) {
            framework\dismiss_admin_notice( $welcome_notice_key );
            return;
        }

        ?>
        <div class="notice notice-info is-dismissible"
            data-tangible-admin-notice="<?php echo $welcome_notice_key; ?>"
        >
            <p>Welcome to <b><?php echo Plugin::$plugin->title; ?></b>. Please see the <a href="<?php
                $url = (is_multisite() ? 'settings.php' : 'options-general.php') . "?page=" . Plugin::$plugin->name . "-settings&dismiss_admin_notice=true";
                echo esc_attr($url);
            ?>">plugin settings page</a> to get started.</p>
        </div>
        <?php
    }
    
}