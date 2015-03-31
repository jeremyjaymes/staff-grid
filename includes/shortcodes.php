<?php
/**
 * Shortcodes
 */

 add_shortcode( 'team', 'intactic_team_post_shortchode' );
 function intactic_team_post_shortchode( $atts ) {
    ob_start();

    $args = array(
                'post_type'      => 'team_member',
                'posts_per_page' => 99
            );

    $team = new WP_Query($args);

    if( $team->have_posts() ) :
        echo '<div class="employee-team clearfix">';
        echo '<h2 id="team">Team</h2>';

        while( $team->have_posts() ) : $team->the_post(); ?>

            <div class="one-third employee">
                <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        echo '<div class="employee-headshot">';
                            the_post_thumbnail();
                        echo '</div>';
                    }
                ?>

                <h4 class="employee-name"><i class="plus dashicons dashicons-plus"></i> <?php the_title(); ?></h4>
                <div class="employee-bio">
                    <?php the_content(); ?>
                </div>
                <hr>
            </div>

    <?php
    endwhile;
        echo '</div>';

        $myvariable = ob_get_clean();
        return $myvariable;
    
    endif;
 }