<?php

// Enqueue frontend styles and scripts

add_action('wp_enqueue_scripts', function() use ($plugin) {

  $url = $plugin->url;
  $version = $plugin->version;

  wp_enqueue_style(
    'wp-reportpanel-sdd',
    $url . 'assets/build/wp-reportpanel-sdd.min.css',
    [],
    $version
  );

  wp_enqueue_script(
    'wp-reportpanel-sdd',
    $url . 'assets/build/wp-reportpanel-sdd.min.js',
    ['jquery'],
    $version
  );

});
