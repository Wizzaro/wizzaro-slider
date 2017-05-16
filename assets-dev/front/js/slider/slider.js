jQuery( document ).ready( function( $ ) {
    $('.wizzaro-slider').each(function() {
        var slider = $(this);
        var interval = slider.attr('data-interval'),
            pauseOnHover = slider.attr('data-pause-on-hover'),
            useArrows = slider.attr('data-use-arrows'),
            useBullets = slider.attr('data-use-bullets');

        if ( ! interval ) {
            interval = 4000;
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
            autoplay: false,//true,
            arrows: useArrows,
            dots: useBullets,
            pauseOnHover: pauseOnHover,
            autoplaySpeed: interval,
        });
    });
});
