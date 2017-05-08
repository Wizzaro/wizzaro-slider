<?php
namespace Wizzaro\Slider\Component\Metabox;

use Wizzaro\WPFramework\v1\Component\Metabox\AbstractMetabox;
use Wizzaro\WPFramework\v1\Helper\Filter;
use Wizzaro\WPFramework\v1\Helper\View;

use Wizzaro\Slider\Config\PluginConfig;

class Settings extends AbstractMetabox {

    protected function _get_metabox_config() {
        return array(
            'id' => 'wizzaro-slider-settings',
            'title' => __( 'Settings', PluginConfig::get_instance()->get( 'languages', 'domain' ) ),
            'screen' => array( PluginConfig::get_instance()->get( 'post_type', 'type' ) ),
            'context' => 'side',
            'priority' => 'default'
        );
    }

    public function render( $post ) {
        $settings = PluginConfig::get_instance()->get( 'carousel', 'default_settings' );
        $saved_settings = get_post_meta( $post->ID, '_wizzaro_slider_settings', true );

        if ( is_array( $saved_settings ) ) {
            $settings = array_merge( $settings, $saved_settings );
        }

        View::get_instance()->render_view_for_instance( PluginConfig::get_instance()->get_view_templates_path(), $this, 'metabox', array(
            'languages_domain' => PluginConfig::get_instance()->get( 'languages', 'domain' ),
            'slider_settings' => $settings
        ) );
    }

    public function save( $post_id, $post ) {

        if(
            ! is_admin()
            || wp_is_post_revision( $post_id )
            || ! isset ( $_POST['wizzaro_slider_settings'] )
            || ! isset ( $_POST['wizzaro_slider_settings_edit'] )
            || ! wp_verify_nonce( $_POST['wizzaro_slider_settings_edit'], 'wizzaro_slider_settings_edit_nounce' )
            || ! ( $post->post_type && $post->post_type ===  PluginConfig::get_instance()->get( 'post_type', 'type' ) )
        ) {
            return;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post->ID;
        }

        $settings = array();

        if ( isset( $_POST['wizzaro_slider_settings'] ) && is_array( $_POST['wizzaro_slider_settings'] ) ) {
            $filter_instance = Filter::get_instance();
            $new_settings = $_POST['wizzaro_slider_settings'];

            if ( isset( $new_settings['interval'] ) ) {
                $pause_betwen_transition = $filter_instance->filter_int( $new_settings['interval'] );

                if (is_int( $pause_betwen_transition ) && $pause_betwen_transition >= 0 ) {
                    $settings['interval'] = $pause_betwen_transition;
                } else {
                    $settings['interval'] = 4000;
                }
            }

            if ( isset( $new_settings['pause_on_hover'] ) ) {
                if ( ! strcasecmp( $new_settings['pause_on_hover'], '1' ) ) {
                    $settings['pause_on_hover'] = 1;
                } else {
                    $settings['pause_on_hover'] = 0;
                }
            }
        }

        if ( ! update_post_meta( $post->ID, '_wizzaro_slider_settings',  $settings ) ) {
            add_post_meta( $post->ID, '_wizzaro_slider_settings',  $settings, true);
        }
    }
}
