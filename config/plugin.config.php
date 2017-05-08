<?php
namespace Wizzaro\Slider;

return array(
    'controllers' => array(
        'Wizzaro\Slider\Controller\PostType',
        'Wizzaro\Slider\Controller\Slides',
        'Wizzaro\Slider\Controller\Shortcode',
        'Wizzaro\Slider\Controller\EditorPlugin'
    ),
    'configuration' => array(
        'path' => array(
            'main_file' => realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'wizzaro-slider.php' )
        ),
        'view' => array(
            'templates_path' => 'view'
        ),
        'languages' => array(
            'domain' => 'wizzaro-slider'
        ),
        'shortcode' => array(
            'name' => 'wizzaro-slider'
        ),
        'carousel' => array(
            'default_settings' => array(
                'interval' => 4000,
                'pause_on_hover' => 0
            )
        ),
        'post_type' => array(
            'type' => 'wizzaro-slider',
            'args' => array(
                'public' => true,
                'labels'=> array(
                    'name'                  => __( 'Sliders', 'wizzaro-slider' ),
                    'singular_name'         => __( 'Slider', 'wizzaro-slider' ),
                    'menu_name'             => __( 'Sliders', 'wizzaro-slider' ),
                    'add_new'               => __( 'Add Slider', 'wizzaro-slider' ),
                    'add_new_item'          => __( 'Add New Slider', 'wizzaro-slider' ),
                    'edit'                  => __( 'Edit Slider', 'wizzaro-slider' ),
                    'edit_item'             => __( 'Edit Slider', 'wizzaro-slider' ),
                    'new_item'              => __( 'New Slider', 'wizzaro-slider' ),
                    'not_found'             => __( 'No Sliders found', 'wizzaro-slider' ),
                    'not_found_in_trash'    => __( 'No Sliders found in trash', 'wizzaro-slider' ),
                ),
                'menu_icon' => 'dashicons-images-alt2',
            )
        )
    )
);
