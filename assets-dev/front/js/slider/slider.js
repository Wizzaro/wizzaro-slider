jQuery( document ).ready( function( $ ) {
    $('.wizzaro-slider').each(function() {
        var slider = $(this);
        var autoplay = slider.attr('data-autoplay'),
            interval = slider.attr('data-interval'),
            animationSpeed = slider.attr('data-animation-speed'),
            pauseOnHover = slider.attr('data-pause-on-hover'),
            useArrows = slider.attr('data-use-arrows'),
            useBullets = slider.attr('data-use-bullets');

        if ( autoplay == '1' ) {
            autoplay = true;
        } else {
            autoplay = false;
        }

        if ( ! interval ) {
            interval = 4000;
        }

        if ( ! animationSpeed ) {
            animationSpeed = 300;
        }

        if ( pauseOnHover == '1' ) {
            pauseOnHover = true;
        } else {
            pauseOnHover = false;
        }

        if ( useArrows == '1' ) {
            useArrows = true;
        } else {
            useArrows = false;
        }

        if ( useBullets == '1' ) {
            useBullets = true;
        } else {
            useBullets = false;
        }


        slider.slick({
            autoplay: autoplay,
            arrows: useArrows,
            dots: useBullets,
            pauseOnHover: pauseOnHover,
            autoplaySpeed: interval,
            speed: animationSpeed
        });
    });
});
