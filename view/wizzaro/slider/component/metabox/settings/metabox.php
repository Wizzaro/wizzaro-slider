<?php
wp_nonce_field('wizzaro_slider_settings_edit_nounce', 'wizzaro_slider_settings_edit');
?>
<div class="panel-wrap">
    <div class="panel">
        <ul>
            <li>
                <strong><?php _e( 'Autoplay', $view_data['languages_domain'] ); ?>:</strong>
            </li>
            <li>
                <input type="radio" name="wizzaro_slider_settings[autoplay]" value="1" <?php checked( $view_data['slider_settings']['autoplay'], 1 ); ?>>
                <?php _e( 'Yes' ); ?>
            </li>
            <li>
                <input type="radio" name="wizzaro_slider_settings[autoplay]" value="0" <?php checked( $view_data['slider_settings']['autoplay'], 0 ); ?>>
                <?php _e( 'No' ); ?>
            </li>
        </ul>
        <?php
        //--------------------------------------------------------------------------------------------------------------
        ?>
        <ul>
            <li>
                <strong><?php _e( 'Interval (ms)', $view_data['languages_domain'] ); ?>:</strong>
            </li>
            <li>
                <input class="large-text" name="wizzaro_slider_settings[interval]" type="number" min="0" value="<?php echo esc_attr( $view_data['slider_settings']['interval'] ); ?>" placeholder="4000">
            </li>
        </ul>
        <?php
        //--------------------------------------------------------------------------------------------------------------
        ?>
        <ul>
            <li>
                <strong><?php _e( 'Animation Speed (ms)', $view_data['languages_domain'] ); ?>:</strong>
            </li>
            <li>
                <input class="large-text" name="wizzaro_slider_settings[animation_speed]" type="number" min="0" value="<?php echo esc_attr( $view_data['slider_settings']['animation_speed'] ); ?>" placeholder="300">
            </li>
        </ul>
        <?php
        //--------------------------------------------------------------------------------------------------------------
        ?>
        <ul>
            <li>
                <strong><?php _e( 'Pause on hover slider', $view_data['languages_domain'] ); ?>:</strong>
            </li>
            <li>
                <input type="radio" name="wizzaro_slider_settings[pause_on_hover]" value="1" <?php checked( $view_data['slider_settings']['pause_on_hover'], 1 ); ?>>
                <?php _e( 'Yes' ); ?>
            </li>
            <li>
                <input type="radio" name="wizzaro_slider_settings[pause_on_hover]" value="0" <?php checked( $view_data['slider_settings']['pause_on_hover'], 0 ); ?>>
                <?php _e( 'No' ); ?>
            </li>
        </ul>
    </div>
</div>
