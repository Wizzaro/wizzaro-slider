<?php
namespace Wizzaro\Slider\Controller;

use Wizzaro\WPFramework\v1\Controller\AbstractPluginController;

class PostType extends AbstractPluginController {

    public function init() {
        add_action( 'init', array( $this, 'action_register_post_types' ), 0 );
        add_action( 'after_setup_theme', array( $this, 'action_add_image_sizes' ) );
    }

    public function init_admin() {
        add_filter( 'image_size_names_choose', array( $this, 'filter_image_size_names_choose' ) );
    }

    //----------------------------------------------------------------------------------------------------
    // Functions for all

    public function action_register_post_types() {
        $languages_domain = $this->_config->get( 'languages', 'domain' );

        $default_args = array(
            'public'              => false,
            'has_archive'         => false,
            'supports'            => array( 'title' ),
            'hierarchical'        => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'menu_position'       => 100,
            'can_export'          => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
            'rewrite'             => false,
            'query_var'           => false,
        );

        do_action( 'wizzaro_slider_before_register_post_type' );
        register_post_type( $this->_config->get( 'post_type', 'type' ), array_merge( $default_args, $this->_config->get( 'post_type', 'args' ) ) );
        do_action( 'wizzaro_slider_after_register_post_type' );
        flush_rewrite_rules();
    }

    public function action_add_image_sizes() {
        add_image_size( 'wizzaro-slider-image-size', 1440, 1440 );
    }

    public function filter_image_size_names_choose( $sizes ) {
        return array_merge( $sizes, array(
            'wizzaro-slider-image-size' => __( 'Slider image size', $this->_config->get( 'languages', 'domain' ) )
        ) );
    }
}
