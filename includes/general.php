<?php
/**
 * Helper Functions
 * 
 * @package    StaffGrid
 * @subpackage Includes
 * @author     Jeremy Vossman <jeremy@papertreedesign.com>
 * @copyright  Copyright (c) 2015, Jeremy Vossman
 * @link       https://github.com/jeremyjaymes/staff-grid
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Don't Update Plugin
 * @since 1.0.0
 * 
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function staff_grid_functionality_hidden( $r, $url ) {
    
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
        return $r; // Not a plugin update request. Bail immediately.
    $plugins = unserialize( $r['body']['plugins'] );
    
    unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
    unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
    $r['body']['plugins'] = serialize( $plugins );

    return $r;
}
add_filter( 'http_request_args', 'staff_grid_functionality_hidden', 5, 2 );