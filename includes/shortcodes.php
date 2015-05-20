<?php
/**
 * Shortcodes
 */

/**
 * Staff Grid Shortcode
 *
 * @since 0.1.0
 */
 function staff_grid_shortchode( $atts ) {
   
    ob_start();

    wp_enqueue_script( 'staff-grid-js', TEAMGRID_PLUGIN_DIR . '/js/staff-grid.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style( 'staff-grid-css', TEAMGRID_PLUGIN_DIR . '/css/staff-grid.min.css', '1.0.0', true);

    $args = array(
                'post_type'      => 'staff_member',
                'posts_per_page' => 99
            );

    $team = new WP_Query($args);

    if( $team->have_posts() ) :
        echo '<div class="staff-grid clearfix">';
        echo '<h2>' . apply_filters( 'staff_grid_section_title', __( 'Team', 'staff-grid' ) . '</h2>';

        while( $team->have_posts() ) : $team->the_post(); ?>

            <div class="grid-two staff-person">
                <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        echo '<div class="staff-headshot">';
                            the_post_thumbnail();
                        echo '</div>';
                    }
                ?>

                <h4 class="staff-name"><i class="plus">&plus;</i> <?php the_title(); ?></h4>
                <div class="staff-bio">
                    <?php the_content(); ?>
                </div>
                <hr>
            </div>

    <?php
    endwhile;
        echo '</div>';

        $cleanvar = ob_get_clean();
        return $cleanvar;
    
    endif;
 }
add_shortcode( 'staff_grid', 'staff_grid_shortchode' );