<?php
/**
 * @Author: Jeremy
 * @Date:   2016-11-03 09:39:53
 * @Last Modified by:   Jeremy
 * @Last Modified time: 2016-11-03 10:17:59
 */
namespace StaffGrid\Admin;

class Metaboxes
{

    /*
     * Nonce value
     */
    private $nonce = 'wp_staff_grid_nonce';

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_staff_meta_box'  ) );
        add_action( 'save_post',      array( $this, 'save_staff_meta_box' ) );
    }
    
    /**
     * Add the metabox
     */
    public function add_staff_meta_box() {
        add_meta_box(
            'staff_grid',
            __( 'Staff Info', 'umb' ),
            array( $this, 'display_staff_meta_box' ),
            'staff',
            'side',
            'high'
        );
    }

    /**
     * Display the metabox
     * @param  object $post Post where information is saved.
     * @return [type]       [description]
     */
    public function display_staff_meta_box( $post ) {

        wp_nonce_field( plugin_basename( __FILE__ ), $this->nonce );

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_staff_grid_title_key', true );

        $html = '<label for="staff_grid_title">' . __('Team member title', 'staff-grid' ) . '</label>';
        $html .= '<input type="text" id="staff_grid_title" name="staff_grid_title" value="' . esc_attr( $value ) . '" size="25" />';

        echo $html;

    }

    public function save_staff_meta_box( $post_id ) {

        // First, make sure the user can save the post
        if( $this->user_can_save( $post_id, $this->nonce ) ) { 

            // Sanitize the user input.
            $data = sanitize_text_field( $_POST['staff_grid_title'] );
     
            // Update the meta field.
            update_post_meta( $post_id, '_staff_grid_title_key', $data );
    
        } // end if
    }

    /**
     * Determines whether or not the current user has the ability to save meta data associated with this post.
     *
     * @param       int     $post_id    The ID of the post being save
     * @param       bool                Whether or not the user has the ability to save this post.
     */
    function user_can_save( $post_id, $nonce ) {
        
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], plugin_basename( __FILE__ ) ) );
        
        // Return true if the user is able to save; otherwise, false.
        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
     
    } // end user_can_save
}
