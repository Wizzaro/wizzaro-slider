<?php
wp_nonce_field('wizzaro_slider_slides_edit_nounce', 'wizzaro_slider_slides_edit');
?>
<div class="panel-wrap">
    <div class="panel">
        <div id="wizzaro-slider-metabox-added-slides" class="wizzaro-slider-metabox-slides">
            <div>
                <button type="button" class="wsms-add-bt button button-primary button-large"><?php _e( 'Add Slide', $view_data['languages_domain'] ); ?></button>
                <button type="button" class="wsms-remove-selected-bt button button-delete button-large" disabled="disabled"><?php _e( 'Remove selected slides', $view_data['languages_domain'] ); ?></button>
            </div>
            <div class="wsms-menu">
                <a href="#" class="wsms-select-all">
                    <?php _e( 'Select all', $view_data['languages_domain'] ); ?>
                </a>
                &nbsp;|&nbsp;
                <a href="#" class="wsms-unselect-all">
                    <?php _e( 'Unselect all', $view_data['languages_domain'] ); ?>
                </a>
            </div>
            <div class="wsms-list">
                <?php
                if ( ! is_array( $view_data['slides'] ) || count( $view_data['slides'] ) <= 0 ) {
                    ?>
                    <div class="wsms-no-elements">
                        <?php _e( 'No slides to display', $view_data['languages_domain'] ); ?>
                    </div>
                    <?php
                } else {
                    $unique_id = 0;
                    foreach( $view_data['slides'] as $element ) {
                        $unique_id++;
                        ?>
                        <div class="wsms-l-elem">
                            <div class="wsms-l-elem-wrapper">
                                <div class="wsms-l-e-select">
                                    <a href="#">
                                        <span class="dashicons dashicons-yes"></span>
                                    </a>
                                </div>
                                <div class="wsms-l-e-image">
                                    <img src="<?php echo wp_get_attachment_url( $element['image_id'], 'thumbnail' ); ?>" alt="" />
                                    <a href="#" class="wsms-action-set-image">
                                        <?php _e( 'Set image', $view_data['languages_domain'] ); ?>
                                    </a>
                                    <input type="hidden" name="wizzaro-slider-slides[<?php echo $unique_id; ?>][image_id]" value="<?php echo esc_attr( $element['image_id'] ); ?>">
                                </div>
                                <div class="wsms-l-e-content">
                                    <textarea name="wizzaro-slider-slides[<?php echo $unique_id; ?>][content]"><?php echo str_ireplace(array("<br />","<br>","<br/>"), "", $element['content']); ?></textarea>
                                </div>
                                <div class="wsms-l-e-actions">
                                    <a href="#" href="#" class="wsms-action-delete">
                                        <span class="dashicons dashicons-trash"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="wsms-menu">
                <a href="#" class="wsms-select-all">
                    <?php _e( 'Select all', $view_data['languages_domain'] ); ?>
                </a>
                &nbsp;|&nbsp;
                <a href="#" class="wsms-unselect-all">
                    <?php _e( 'Unselect all', $view_data['languages_domain'] ); ?>
                </a>
            </div>
            <div>
                <button type="button" class="wsms-add-bt button button-primary button-large"><?php _e( 'Add Slide', $view_data['languages_domain'] ); ?></button>
                <button type="button" class="wsms-remove-selected-bt button button-delete button-large" disabled="disabled"><?php _e( 'Remove selected slides', $view_data['languages_domain'] ); ?></button>
            </div>
        </div>
    </div>
</div>
