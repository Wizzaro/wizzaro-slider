<?php
namespace Wizzaro\Slider\Component\Metabox;

use Wizzaro\WPFramework\v1\Component\Metabox\AbstractMetabox;
use Wizzaro\WPFramework\v1\Helper\Filter;
use Wizzaro\WPFramework\v1\Helper\View;

use Wizzaro\Slider\Config\PluginConfig;

class Slides extends AbstractMetabox {

    protected function __construct() {
        parent::__construct();
        add_action( 'admin_footer', array( $this, 'insert_js_templates' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'action_enqueue_style' ) );
    }

    protected function _get_metabox_config() {
        return array(
            'id' => 'wizzaro-slider-slides',
            'title' => __( 'Slider Slids', PluginConfig::get_instance()->get( 'languages', 'domain' ) ),
            'screen' => array( PluginConfig::get_instance()->get( 'post_type', 'type' ) ),
            'context' => 'normal',
            'priority' => 'core'
        );
    }

    public function render( $post ) {
        $languages_domain = PluginConfig::get_instance()->get( 'languages', 'domain' );
        wp_enqueue_media();
        wp_register_script( 'wizzaro-slider-metabox-slides', PluginConfig::get_instance()->get_js_admin_url() . 'metabox-slides.js', array( 'jquery', 'jquery-ui-selectable', 'backbone', 'underscore' ), '1.0.0' , true );

        $js_config = array(
            'l10n' => array(
                'delete_elements' => __( 'Are you sure you want to delete these elements?', $languages_domain ),
                'delete_element' => __( 'Are you sure you want to delete this element?', $languages_domain )
            )
        );

        wp_localize_script( 'wizzaro-slider-metabox-slides', 'wpWizzaroSliderMetaboxSlidesConfig', $js_config );
        wp_enqueue_script( 'wizzaro-slider-metabox-slides' );

        View::get_instance()->render_view_for_instance( PluginConfig::get_instance()->get_view_templates_path(), $this, 'metabox', array(
            'languages_domain' => $languages_domain,
            'slides' => get_post_meta( $post->ID, '_wizzaro_slider_slides', true )
        ) );
    }

    public function insert_js_templates() {
        global $post;

        if ( $post->post_type && $post->post_type ===  PluginConfig::get_instance()->get( 'post_type', 'type' ) ) {
            View::get_instance()->render_view_for_instance( PluginConfig::get_instance()->get_view_templates_path(), $this, 'js-templates', array(
                'languages_domain' => PluginConfig::get_instance()->get( 'languages', 'domain' )
            ));
        }
    }

    public function action_enqueue_style() {
        global $post;

        if ( $post->post_type && $post->post_type ===  PluginConfig::get_instance()->get( 'post_type', 'type' ) ) {
            wp_enqueue_style( 'wizzaro-slider-metabox-slides', PluginConfig::get_instance()->get_css_admin_url() . 'metabox-slides.css' );
        }
    }

    public function save( $post_id, $post ) {
        if(
            ! is_admin()
            || wp_is_post_revision( $post_id )
            || ! isset ( $_POST['wizzaro_slider_slides_edit'] )
            || ! wp_verify_nonce( $_POST['wizzaro_slider_slides_edit'], 'wizzaro_slider_slides_edit_nounce' )
            || ! ( $post->post_type && $post->post_type ===  PluginConfig::get_instance()->get( 'post_type', 'type' ) )
        ) {
            return;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post->ID;
        }

        $new_slides = array();

        if ( isset ( $_POST['wizzaro-slider-slides'] ) && is_array( $_POST['wizzaro-slider-slides'] ) ) {
            $filter_instance = Filter::get_instance();

            foreach( $_POST['wizzaro-slider-slides'] as $slide ) {
                if ( is_array( $slide ) && isset( $slide['image_id'] ) && is_string( $slide['image_id'] ) && isset( $slide['content'] ) && is_string( $slide['content'] ) ) {
                    $slide = array(
                        'image_id' => $filter_instance->filter_int( $slide['image_id'] ),
                        'content' => nl2br( strip_tags( $slide['content'] ) )
                    );

                    if ( $slide['image_id'] > 0 && wp_attachment_is_image( $slide['image_id'] ) ) {
                        array_push($new_slides, $slide);
                    }
                }
            }

            if ( ! update_post_meta( $post->ID, '_wizzaro_slider_slides',  $new_slides ) ) {
                add_post_meta( $post->ID, '_wizzaro_slider_slides',  $new_slides, true);
            }
        }
    }
}
