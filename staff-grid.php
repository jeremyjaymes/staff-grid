<?php
/**
 * Plugin Name: Staff Grid
 * Plugin URI: http://jeremyjaymes.com
 * Description: Grid based staff member page layout.
 * Version: 0.5.0
 * Author: jeremyjaymes
 * Author URI: http://jeremyjaymes.com
 * Text Domain: staff-grid
 * Domain Path: /languages
 * License: A short license name. Example: GPL2
 */

defined( 'WPINC' ) or die;

require_once __DIR__.'/autoloader.php';

if ( !defined('STAFFGRID_PLUGIN_DIR')) {
    define('STAFFGRID_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}

include( dirname( __FILE__ ) . '/includes/general.php');
include( dirname( __FILE__ ) . '/includes/post-type.php');
include( dirname( __FILE__ ) . '/includes/shortcodes.php');

new StaffGrid\Admin\Admin();