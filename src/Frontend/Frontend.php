<?php
/**
 * @Author: Jeremy
 * @Date:   2016-10-26 15:10:50
 * @Last Modified by:   Jeremy
 * @Last Modified time: 2016-10-31 12:07:33
 * <!--p><a href="<?php //the_permalink(); ?>" title="<?php //the_title(); ?>"><?php //apply_filters( 'staff_grid_bio_more_link', _e( 'Read More', 'staff-grid' ) ) ?></a></p-->
 */

namespace StaffGrid\Frontend;

class Frontend
{
    /**
     * If you should add the script or not
     *
     * @var bool
     */

    public function __construct( $loader ) {
        $loader->add_action( 'wp_enqueue_scripts', $this, 'register_styles'   );
        $loader->add_action( 'wp_enqueue_scripts', $this, 'register_scripts'  );

        add_shortcode( 'staff_grid',    array( $this, 'render_shortcode' ) );
    }

    public function register_styles() {
        wp_register_style( 'staff-grid-css', STAFFGRID_PLUGIN_DIR . '/assets/css/staff-grid.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style( 'staff-grid-css');
    }

    public function register_scripts() {
        wp_register_script( 'staff-grid-js', STAFFGRID_PLUGIN_DIR . '/assets/js/staff-grid.min.js', array('jquery'), '1.0.0', true);
    }

    public function render_shortcode( $atts ) {
        global $post;
        $post_id = is_object( $post ) ? $post->ID : 0;

        $atts = shortcode_atts( array(
            'title' => __( 'Team', 'staff-grid' ),
            'desc'  => __( '', 'staff-grid' )
        ),
        $atts, 'staff_grid' ); 

        return $this->shortcode_content( $atts );
    }

    public function shortcode_content( $args = array() ) {

        $staff = $this->get_staff();
        if( $staff->have_posts() ) {
                $i = 0;
                $output = '<div class="staff-grid clearfix">';
                $output .= '<h2>' . apply_filters( 'staff_grid_section_title', __( 'Team', 'staff-grid' ) ) . '</h2>';

            while( $staff->have_posts() ) : $staff->the_post(); 
                $first = ($i % 3 == 0) ? 'first' : '';
                $output .= '<div class="grid-two staff-person ' . $first . '">';
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                    $output .= '<div class="staff-headshot">' . get_the_post_thumbnail( get_the_ID(), 'staff-grid' ) . '</div>';
                }

                $output .= '<h4 class="staff-name">'.
                            get_the_title().
                            '<!--i class="dashicons plus">&plus;</i--></h4>
                            <div class="staff-bio">'.
                            get_the_excerpt().
                            '</div></div>';

                $i++;
            endwhile;
                wp_reset_postdata();
                $output .= '</div>';
        }
        return $output;
    }

    public function get_staff() {
        $options = array(
                'post_type'      => 'staff',
                'posts_per_page' => 99,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
        );

        return new \WP_Query( $options );
    }

}
