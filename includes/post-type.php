<?php
/**
 * Register Custom Post Types
 * 
 * @package    StaffGrid
 * @subpackage Includes
 * @author     Jeremy Vossman <jeremy@papertreedesign.com>
 * @copyright  Copyright (c) 2015, Jeremy Vossman
 * @link       https://github.com/jeremyjaymes/staff-grid
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

//* Add team section
add_action( 'init', 'sg_register_cpt_staff' );

function sg_register_cpt_staff() {

    $labels = array( 
        'name' => _x( 'Staff Members', 'staff-grid' ),
        'singular_name' => _x( 'Staff Member', 'staff-grid' ),
        'add_new' => _x( 'Add New', 'staff-grid' ),
        'add_new_item' => _x( 'Add New Staff Member', 'staff-grid' ),
        'edit_item' => _x( 'Edit Staff Member', 'staff-grid' ),
        'new_item' => _x( 'New Staff Member', 'staff-grid' ),
        'view_item' => _x( 'View Staff Member', 'staff-grid' ),
        'search_items' => _x( 'Search Staff Members', 'staff-grid' ),
        'not_found' => _x( 'No staff members found', 'staff-grid' ),
        'not_found_in_trash' => _x( 'No Staff members found in Trash', 'staff-grid' ),
        'parent_item_colon' => _x( 'Parent Team Member:', 'staff-grid' ),
        'menu_name' => _x( 'Staff Members', 'staff-grid' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'staff', $args );
}