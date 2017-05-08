<?php
$totalSlides = count( $view_data['slides'] );
if ( $totalSlides > 0 ) {
    $slider_id = 'wizzaro-slider-' . $view_data['unique_id'];
    ?>
    <div id="<?php echo $slider_id; ?>" class="wizzaro-slider slide" data-ride="wizzaro-slider" data-interval="<?php echo esc_attr( $view_data['settings']['interval'] ); ?>" data-pause="<?php echo $view_data['settings']['pause_on_hover'] == 1 ? 'hover' : 'false' ?>">
        <?php
        if ( ! isset( $view_data['attrs']['use_bullets'] ) || $view_data['attrs']['use_bullets'] == '1' ) {
            ?>
            <ol class="ws-indicators">
                <?php
                for ( $i = 0; $i < $totalSlides; $i++ ) {
                    ?>
                    <li data-target="#<?php echo $slider_id; ?>" data-slide-to="<?php echo $i; ?>"<?php echo $i === 0 ? ' class="active"' : ''; ?>></li>
                    <?php
                }
                ?>
            </ol>
            <?php
        }
        ?>
        <div class="ws-inner" role="listbox">
            <?php
            $first = true;
            foreach ( $view_data['slides'] as $slide ) {
                ?>
                <div class="ws-item<?php echo $first ? ' active': ''; ?>">
                    <img src="<?php echo wp_get_attachment_url( $slide['image_id'], 'wizzaro-slider-image-size' ); ?>" alt="" />
                    <?php
                    if ( mb_strlen( $slide['content'] ) > 0 ) {
                        ?>
                        <div class="ws-caption">
                            <?php echo esc_attr( $slide['content'] ); ?>
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
        if ( ! isset( $view_data['attrs']['use_arrows'] ) || $view_data['attrs']['use_arrows'] == '1' ) {
            ?>
            <a class="ws-control-prev" href="#<?php echo $slider_id; ?>" role="button" data-slide="prev">
                <?php _e( 'Prev', $view_data['languages_domain'] ); ?>
            </a>
            <a class="ws-control-next" href="#<?php echo $slider_id; ?>" role="button" data-slide="next">
                <?php _e( 'Next', $view_data['languages_domain'] ); ?>
            </a>
            <?php
        }
        ?>
    </div>
    <?php
}
