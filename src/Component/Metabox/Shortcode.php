<?php
namespace Wizzaro\Slider\Component\Metabox;

use Wizzaro\WPFramework\v1\Component\Metabox\AbstractMetabox;
use Wizzaro\WPFramework\v1\Helper\View;

use Wizzaro\Slider\Config\PluginConfig;

class Shortcode extends AbstractMetabox {

    protected function _get_metabox_config() {
        return array(
            'id' => 'wizzaro-slider-shortcode',
            'title' => __( 'Slider Shortcode', PluginConfig::get_instance()->get( 'languages', 'domain' ) ),
            'screen' => array( PluginConfig::get_instance()->get( 'post_type', 'type' ) ),
            'context' => 'side',
            'priority' => 'core'
        );
    }

    public function render( $post ) {
        View::get_instance()->render_view_for_instance( PluginConfig::get_instance()->get_view_templates_path(), $this, 'metabox', array(
            'shortcode' => PluginConfig::get_instance()->get( 'shortcode', 'name' ),
            'post_id' => $post->ID
        ) );
    }
}
