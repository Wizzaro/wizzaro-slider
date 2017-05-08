<script type="text/template" id="wizzaro-slider-metabox-slides-element">
    <div class="wsms-l-elem-wrapper">
        <div class="wsms-l-e-select">
            <a href="#">
                <span class="dashicons dashicons-yes"></span>
            </a>
        </div>
        <div class="wsms-l-e-image">
            <img src="" style="display: none" alt=""/>
            <a href="#" class="wsms-action-set-image">
                <?php _e( 'Set image', $view_data['languages_domain'] ); ?>
            </a>
            <input type="hidden" name="wizzaro-slider-slides[<%= unique_id %>][image_id]" value="">
        </div>
        <div class="wsms-l-e-content">
            <textarea name="wizzaro-slider-slides[<%= unique_id %>][content]"></textarea>
        </div>
        <div class="wsms-l-e-actions">
            <a href="#" href="#" class="wsms-action-delete">
                <span class="dashicons dashicons-trash"></span>
            </a>
        </div>
    </div>
</script>
<?php
    //----------------------------------------------------------------------------------------------------
?>
<script type="text/template" id="wizzaro-slider-metabox-slides-no-elements">
    <div class="wsms-no-elements">
        <?php _e( 'No slides to display', $view_data['languages_domain'] ); ?>
    </div>
</script>
