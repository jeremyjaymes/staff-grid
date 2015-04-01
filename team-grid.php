<?php
/**
 * Plugin Name: Team Grid
 * Plugin URI: http://jeremyjaymes.com
 * Description: 
 * Version: 1.0.0
 * Author: jeremyjaymes
 * Author URI: http://jeremyjaymes.com
 * License: A short license name. Example: GPL2
 */

defined( 'WPINC' ) or die;


if ( !defined('TEAMGRID_PLUGIN_DIR')) {
    define('TEAMGRID_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}

include( dirname( __FILE__ ) . '/includes/general.php');
include( dirname( __FILE__ ) . '/includes/post-type.php');
include( dirname( __FILE__ ) . '/includes/shortcodes.php');