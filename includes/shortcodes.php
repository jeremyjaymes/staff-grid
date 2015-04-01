<?php
/**
 * Shortcodes
 */

 add_shortcode( 'team_grid', 'team_grid_shortchode' );
 function team_grid_shortchode( $atts ) {
   
    ob_start();

    wp_enqueue_script( 'team-grid-js', TEAMGRID_PLUGIN_DIR . '/js/team-grid.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style( 'team-grid-css', TEAMGRID_PLUGIN_DIR . '/css/team-grid.min.css', '1.0.0', true);

    $args = array(
                'post_type'      => 'team_member',
                'posts_per_page' => 99
            );

    $team = new WP_Query($args);

    if( $team->have_posts() ) :
        echo '<div class="team-grid clearfix">';
        echo '<h2 id="team">Team</h2>';

        while( $team->have_posts() ) : $team->the_post(); ?>

            <div class="grid-two employee">
                <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        echo '<div class="employee-headshot">';
                            the_post_thumbnail();
                        echo '</div>';
                    }
                ?>

                <h4 class="employee-name"><i class="plus">&plus;</i> <?php the_title(); ?></h4>
                <div class="employee-bio">
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