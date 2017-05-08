<?php
use Wizzaro\Slider\Config\PluginConfig;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( '_WP_Editors' ) ) {
    require( ABSPATH . WPINC . '/class-wp-editor.php' );
}

function wizzaro_sliders_tinymce_plugin_translation() {
     $languages_domain = PluginConfig::get_instance()->get( 'languages', 'domain' );

     $i18n = array(
         'add_button_title' => __( 'Add slider', $languages_domain ),
         'slider_id' => __( 'Slider', $languages_domain ),
         'use_arrows' => __( 'Use Arrow Navigation', $languages_domain ),
         'use_bullets' => __( 'Use Bullets Navigation', $languages_domain ),
     );

     $editor_locale = _WP_Editors::$mce_locale;
     $translated = 'tinyMCE.addI18n("' . $editor_locale . '.wizzaro_sliders", ' . json_encode( $i18n ) . ");\n";

     return $translated;
}

$strings = wizzaro_sliders_tinymce_plugin_translation();
