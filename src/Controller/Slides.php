<?php
namespace Wizzaro\Slider\Controller;

use Wizzaro\WPFramework\v1\Controller\AbstractPluginController;
use Wizzaro\Slider\Component\Metabox\Slides as SlidesMetabox;
use Wizzaro\Slider\Component\Metabox\Settings as SettingsMetabox;

class Slides extends AbstractPluginController {

    public function init_admin() {
        add_action( 'wizzaro_slider_after_register_post_type', array( $this, 'action_admin_init' ), 10, 1 );
    }

    //----------------------------------------------------------------------------------------------------
    // Functions for admin

    public function action_admin_init() {
        SlidesMetabox::create();
        SettingsMetabox::create();
    }
}
