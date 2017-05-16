<?php
$totalSlides = count( $view_data['slides'] );
if ( $totalSlides > 0 ) {
    $slider_id = 'wizzaro-slider-' . $view_data['unique_id'];
    $use_arrows = ( ! isset( $view_data['attrs']['use_arrows'] ) || $view_data['attrs']['use_arrows'] == '1' );
    $use_bullets = ( ! isset( $view_data['attrs']['use_bullets'] ) || $view_data['attrs']['use_bullets'] == '1' );
    ?>
    <div id="<?php echo $slider_id; ?>" class="wizzaro-slider slide" role="listbox" data-ride="wizzaro-slider" data-interval="<?php echo esc_attr( $view_data['settings']['interval'] ); ?>" data-pause-on-hover="<?php echo $view_data['settings']['pause_on_hover'] == 1 ? 'hover' : 'false' ?>" data-use-arrows="<?php echo $use_arrows ? '1' : '0'; ?>" data-use-bullets="<?php echo $use_bullets ? '1' : '0'; ?>">
        <?php
        $first = true;
        foreach ( $view_data['slides'] as $slide ) {
            ?>
            <div class="ws-item<?php echo $first ? ' first': ''; ?>">
                <img src="<?php echo wp_get_attachment_url( $slide['image_id'], 'wizzaro-slider-image-size' ); ?>" alt="" />
                <?php
                if ( mb_strlen( $slide['content'] ) > 0 ) {
                    ?>
                    <div class="ws-caption">
                        <?php echo $slide['content']; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            $first = false;
        }
        ?>
    </div>
    <?php
}
