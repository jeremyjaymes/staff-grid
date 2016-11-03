<?php
namespace StaffGrid\Core;

use StaffGrid\Admin\Admin;
use StaffGrid\Frontend\Frontend;

/**
 * The core plugin class.
 */
class Plugin
{
    /**
     * The plugin's unique id.
     *
     * @var string
     */
    private $id;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * set constants
     */
    const POST_TYPE = 'staff';

    public function __construct($id, $version)
    {
        $this->id = $id;
        $this->loader = new Loader();

        $this->loader->add_action( 'init', $this, 'init' );
        $this->loader->add_filter( 'http_request_args', $this, 'staff_grid_functionality_hidden', 5, 2 );

        //$assets = new Assets($id, $version, $this->loader, is_admin());
        //$templating = new Templating();

        if (is_admin()) {
            new Admin($this->loader);
        } else {
            new Frontend($this->loader);
        }
    }

    public function init() 
    {
        $this->loader->add_action( 'plugins_loaded', $this, 'load_plugin_textdomain' );
        $this->reigster_image_size();
     
        // Register post type
        register_post_type( self::POST_TYPE,
            array(
                'hierarchical'        => false,
                'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 20,
                'show_in_nav_menus'   => false,
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'has_archive'         => true,
                'query_var'           => true,
                'can_export'          => true,
                'rewrite'             => true,
                'capability_type'     => 'post',
                'labels' => array (
                    'name'               => _x( 'Staff Members', 'staff-grid' ),
                    'singular_name'      => _x( 'Staff Member', 'staff-grid' ),
                    'add_new'            => _x( 'Add New', 'staff-grid' ),
                    'add_new_item'       => _x( 'Add New Staff Member', 'staff-grid' ),
                    'edit_item'          => _x( 'Edit Staff Member', 'staff-grid' ),
                    'new_item'           => _x( 'New Staff Member', 'staff-grid' ),
                    'view_item'          => _x( 'View Staff Member', 'staff-grid' ),
                    'search_items'       => _x( 'Search Staff Members', 'staff-grid' ),
                    'not_found'          => _x( 'No staff members found', 'staff-grid' ),
                    'not_found_in_trash' => _x( 'No Staff members found in Trash', 'staff-grid' ),
                    'parent_item_colon'  => _x( 'Parent Team Member:', 'staff-grid' ),
                    'menu_name'          => _x( 'Staff Members', 'staff-grid' ),
                )
            )
        );
    }

    public function reigster_image_size() {
        if ( has_image_size( 'staff-grid' ) )
            return false;

        $options = get_option( 'sg_settings' );
        $width   = $options['width_input'];
        $height  = $options['height_input'];

        // Add image sizes
        if ( $options['width_input'] && $options['height_input'] ) {
            add_image_size( 'staff-grid', $width, $height, true);
        } else {
            add_image_size( 'staff-grid', 250, 250, true);
        }
    }

    /**
     * Run the plugin.
     */
    public function run()
    {
        $this->loader->register_hooks();
    }

    /**
     * Load internationalization files.
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            $this->id,
            $deprecated = false,
            dirname( STAFFGRID_PLUGIN_DIR ) . '/languages'
        );
    }

    /**
     * Don't Update
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
    public function staff_grid_functionality_hidden( $r, $url ) {
        
        if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
            return $r; // Not a plugin update request. Bail immediately.
        $plugins = unserialize( $r['body']['plugins'] );
        
        unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
        unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
        $r['body']['plugins'] = serialize( $plugins );

        return $r;
    }
}