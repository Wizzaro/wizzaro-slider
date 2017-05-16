<?php
   /*
   Plugin Name: Wizzaro Slider
   Description: This is plugin for create slider post type
   Version: 1.0
   Author: Przemysław Dziadek
   Author URI: http://www.wizzaro.com
   License: GPL-2.0+
   Text Domain: wizzaro-slider
   Domain Path: /languages
   */

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

load_plugin_textdomain( 'wizzaro-slider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

require_once 'vendor/autoload.php';
Wizzaro\Slider\Plugin::create();
