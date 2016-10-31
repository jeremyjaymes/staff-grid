<?php
/**
 * Shortcodes
 * 
 * @package    StaffGrid
 * @subpackage Includes
 * @author     Jeremy Vossman <jeremy@papertreedesign.com>
 * @copyright  Copyright (c) 2015, Jeremy Vossman
 * @link       https://github.com/jeremyjaymes/staff-grid
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Staff Grid Shortcode
 *
 * @since 0.1.0
 */
 function staff_grid_shortcode( $args = array() ) {
   
    //wp_enqueue_script( 'staff-grid-js', STAFFGRID_PLUGIN_DIR . '/assets/js/staff-grid.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style( 'staff-grid-css', STAFFGRID_PLUGIN_DIR . '/assets/css/staff-grid.min.css', '1.0.0', true);

        $args = array(
                    'post_type'      => 'staff',
                    'posts_per_page' => 99,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                );

        $team = new WP_Query($args);

        if( $team->have_posts() ) :
            $output = '<div class="staff-grid clearfix">';
            $output .= '<h2>' . apply_filters( 'staff_grid_section_title', __( 'Team', 'staff-grid' ) ) . '</h2>';

            while( $team->have_posts() ) : $team->the_post();

                $output .= '<div class="grid-two staff-person">';
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                    $output .= '<div class="staff-headshot">' . get_the_post_thumbnail( get_the_ID(), 'staff-grid' ) . '</div>';
                }

                $output .= '<h4 class="staff-name">'.
                            get_the_title().
                            '<!--i class="dashicons plus">&plus;</i--></h4>
                            <div class="staff-bio">'.
                            get_the_excerpt().
                            '</div></div>';
        endwhile;
        //wp_reset_postdata();
            $output .= '</div>';
        endif;

        return $output;
 }
//add_shortcode( 'staff_grid', 'staff_grid_shortchode' );