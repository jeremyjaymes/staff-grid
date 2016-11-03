<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
namespace StaffGrid\Admin;

use StaffGrid\Core\WeDevs_Settings_API;
use StaffGrid\Admin\Metaboxes;

if ( !class_exists('Admin' ) ):
    
class Admin 
{

    private $settings_api;

    private $metaboxes;

    function __construct($loader) {
        $this->settings_api = new WeDevs_Settings_API;

        $loader->add_action( 'admin_init', $this, 'admin_init' );
        $loader->add_action( 'admin_menu', $this, 'admin_menu' );

        new Metaboxes();
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_submenu_page( 'edit.php?post_type=staff', 'Settings', 'Settings', 'manage_options', basename(__FILE__), array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'sg_settings',
                'title' => __( 'Plugin Settings', 'staff-grid' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'sg_settings' => array(
                array(
                    'name'              => 'title',
                    'label'             => __( 'Title', 'staff-grid' ),
                    'desc'              => __( 'Title appears above staff grid', 'staff-grid' ),
                    'placeholder'       => __( 'Text Input placeholder', 'staff-grid' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'        => 'description',
                    'label'       => __( 'Intro Text', 'staff-grid' ),
                    'desc'        => __( 'Short staff grid intro paragraph', 'staff-grid' ),
                    'placeholder' => __( '', 'staff-grid' ),
                    'type'        => 'textarea'
                ),
                array(
                    'name'              => 'width_input',
                    'label'             => __( 'Thumbnail Width', 'staff-grid' ),
                    'desc'              => __( 'Enter the width of the headshot thumbnail, default is 250', 'staff-grid' ),
                    'placeholder'       => __( '250', 'staff-grid' ),
                    'type'              => 'number',
                    'default'           => '250',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'              => 'height_input',
                    'label'             => __( 'Thumbnail Height', 'staff-grid' ),
                    'desc'              => __( 'Enter the height of the headshot thumbnail, default is 250', 'staff-grid' ),
                    'placeholder'       => __( '250', 'staff-grid' ),
                    'type'              => 'number',
                    'default'           => '250',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'  => 'script',
                    'label' => __( 'Use Javascript', 'staff-grid' ),
                    'desc'  => __( 'Include javascript, default is not included.', 'staff-grid' ),
                    'type'  => 'checkbox'
                )
            ),
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;