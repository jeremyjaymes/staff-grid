<?php
/**
 * Register Custom Post Types
 */

//* Add team section
add_action( 'init', 'register_cpt_team_member' );

function register_cpt_team_member() {

    $labels = array( 
        'name' => _x( 'Team Members', 'team_member' ),
        'singular_name' => _x( 'Team Member', 'team_member' ),
        'add_new' => _x( 'Add New', 'team_member' ),
        'add_new_item' => _x( 'Add New Team Member', 'team_member' ),
        'edit_item' => _x( 'Edit Team Member', 'team_member' ),
        'new_item' => _x( 'New Team Member', 'team_member' ),
        'view_item' => _x( 'View Team Member', 'team_member' ),
        'search_items' => _x( 'Search Team Members', 'team_member' ),
        'not_found' => _x( 'No team members found', 'team_member' ),
        'not_found_in_trash' => _x( 'No team members found in Trash', 'team_member' ),
        'parent_item_colon' => _x( 'Parent Team Member:', 'team_member' ),
        'menu_name' => _x( 'Team Members', 'team_member' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        
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

    register_post_type( 'team_member', $args );
}