<?php
namespace Wizzaro\Slider\Controller;

use Wizzaro\WPFramework\v1\Controller\AbstractPluginController;

class EditorPlugin extends AbstractPluginController {

    public function init_admin() {
        add_action( 'admin_head', array( $this, 'action_admin_head' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'action_enqueue_style' ) );
    }

    public function action_admin_head() {
        if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}

        // check if WYSIWYG is enabled
		if ( true == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( $this ,'filter_mce_external_plugins' ) );
            add_filter( 'mce_external_languages', array( $this ,'filter_mce_external_languages' ) );
			add_filter( 'mce_buttons', array($this, 'filter_mce_buttons' ) );

            $args = array(
                'posts_per_page' => -1,
                'post_type' => $this->_config->get( 'post_type', 'type' ),
                'orderby' => 'title',
                'order' => 'ASC',
                'lang' => ''
            );

            $sliders = get_posts( $args );
            $js_list = array();

            foreach( $sliders as $slider ) {
                $js_list[$slider->ID] = esc_attr( $slider->post_title );
            }

            wp_localize_script('editor', 'wpWizzaroSliders', array(
                'shordcode_name' => $this->_config->get( 'shortcode', 'name' ),
                'lists' => $js_list
            ));
		}
    }

    public function filter_mce_external_plugins( $plugin_array ) {
		$plugin_array['wizzaro_sliders'] = $this->_config->get_js_admin_url() . 'tinymce/plugin/wizzaro-slider.js';
		return $plugin_array;
	}

    public function filter_mce_external_languages( $locales ) {
        $locales['wizzaro_sliders'] = $this->_config->get_dir_path() . 'assets/js/admin/tinymce/langs/wizzaro_sliders.php';
        return $locales;
    }

	public function filter_mce_buttons( $buttons ) {
		array_push( $buttons, 'wizzaro_sliders_add' );
		return $buttons;
	}

    public function action_enqueue_style() {
        wp_enqueue_style( 'wizzaro-slider-editor-plugin', $this->_config->get_css_admin_url() . 'tinymce/plugin/wizzaro-slider.css' );
    }
}
