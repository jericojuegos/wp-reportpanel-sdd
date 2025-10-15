<?php
namespace tests\wp_reportpanel_sdd;

class Basic_TestCase extends \WP_UnitTestCase {
  function test_plugin_function() {
    $this->assertTrue( function_exists( 'wp_reportpanel_sdd' ) );
  }
}
