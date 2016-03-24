<?php

namespace Hellodev\InventoryManager;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

class JSAutoloader {
  /**
  * Path to the includes directory
  * @var string
  */
  private $include_path = '';

  /**
  * The Constructor
  */
  public function __construct() {
    $this->include_path = '/assets/js';
    add_action('admin_enqueue_scripts', array($this, 'autoload_backend'));
    add_action('wp_enqueue_scripts', array($this, 'autoload_frontend'));
  }


  /**
  * Include a javascript file into wordpress
  * @param  string $path
  * @return bool successful or not
  */
  private function load_file( $path ) {
    wp_register_script(basename($path), plugins_url( $path, IM_PLUGIN_FILE), array('jquery'),'20150810', true);
    wp_enqueue_script(basename($path));
  }

  /**
  * Auto-load javascript files
  */
  public function autoload_backend() {
    $plugins_path = untrailingslashit( plugin_dir_path( IM_PLUGIN_FILE ) );
    $path = $plugins_path . $this->include_path . '/*-backend.{js}';
    $files = glob( $path, GLOB_BRACE);
    foreach($files as $file) {
      $file = str_replace($plugins_path, "", $file);
      $this->load_file($file);
    }
  }

  /**
  * Auto-load javascript files
  */
  public function autoload_frontend() {
    $plugins_path = untrailingslashit( plugin_dir_path( IM_PLUGIN_FILE ) );
    $path = $plugins_path . $this->include_path . '/*-frontend.{js}';
    $files = glob( $path, GLOB_BRACE);
    foreach($files as $file) {
      $file = str_replace($plugins_path, "", $file);
      $this->load_file($file);
    }
  }
}
