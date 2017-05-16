<?php
namespace Wizzaro\Slider\Controller;

use Wizzaro\WPFramework\v1\Controller\AbstractPluginController;
use Wizzaro\Slider\Component\Metabox\Shortcode as ShortcodeMetabox;

class Shortcode extends AbstractPluginController {

    public function init_front() {
        add_action( 'wizzaro_gallery_after_register_post_types', array( $this, 'action_init_shordcode' ), 10, 1 );
        add_action( 'init', array( $this, 'action_register_style' ) );
    }

    public function init_admin() {
        add_action( 'wizzaro_slider_after_register_post_type', array( $this, 'action_admin_init_shordcodes' ), 10, 1 );
    }

    //----------------------------------------------------------------------------------------------------
    // Functions for front

    public function action_register_style() {
        wp_register_style( 'wizzaro-slider', $this->_config->get_css_url() . 'slider.css', array(), '1.0.0' );
    }

    public function action_init_shordcode( $post_types_settings ) {
        add_shortcode( $this->_config->get( 'shortcode', 'name' ), array( $this, 'render_shordcode') );
    }

    public function render_shordcode( $attrs ) {
        $view = '';

        if ( isset( $attrs['id'] ) ) {
            $post = get_post( $attrs['id'] );

            if ( $post  && $post->post_type && $post->post_type ===  $this->_config->get( 'post_type', 'type' ) ) {
                wp_enqueue_style( 'wizzaro-slider' );
                wp_enqueue_script( 'wizzaro-slider', $this->_config->get_js_url() . 'slider.js', array( 'jquery' ), '1.0.0' , true );

                $settings = $this->_config->get( 'carousel', 'default_settings' );
                $saved_settings = get_post_meta( $post->ID, '_wizzaro_slider_settings', true );

                if ( is_array( $saved_settings ) ) {
                    $settings = array_merge( $settings, $saved_settings );
                }

                $view_data = array (
                    'unique_id' => $this->_config->generateSliderUniqueId(),
                    'languages_domain' => $this->_config->get( 'languages', 'domain' ),
                    'settings' => $settings,
                    'slides' => get_post_meta( $post->ID, '_wizzaro_slider_slides', true ),
                    'attrs' => $attrs
                );

                if ( $this->is_themes_view_exist( 'shordcode' ) ) {
                    $view = $this->get_themes_view( 'shordcode', $view_data );
                } else {
                    $view = $this->get_view( 'shordcode', $view_data );
                }
            }
        }

        return $view;
    }

    //----------------------------------------------------------------------------------------------------
    // Functions for admin

    public function action_admin_init_shordcodes() {
        $post_type = $this->_config->get( 'post_type', 'type' );
        add_filter( 'manage_' . $post_type . '_posts_columns', array( $this, 'filter_reservation_data_columns' ) );
        add_action( 'manage_' . $post_type . '_posts_custom_column', array( $this, 'action_render_columns' ), 2 );
        ShortcodeMetabox::create();
    }

    public function filter_reservation_data_columns( $existing_columns ) {
        $date_column = $existing_columns['date'];
        unset( $existing_columns['date'] );


        return array_merge( $existing_columns, array(
            'shortcode' => __( 'Shortcode', $this->_config->get( 'languages', 'domain' ) ),
            'date' => $date_column
        ));
    }

    public function action_render_columns( $column ) {
        global $post;

        if ( ! strcasecmp( $column, 'shortcode' ) && ! wp_is_post_revision( $post->ID ) ) {
            ?>
            <code>[<?php echo $this->_config->get( 'shortcode', 'name' ); ?> id="<?php echo $post->ID; ?>"]</code>
            <?php
        }
    }
}
