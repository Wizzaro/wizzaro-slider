Wizzaro.namespace('Plugins.Slider');

Wizzaro.Plugins.Slider.SliderAnimator = function( slider, $ ) {
    var _duration_speed = 10;

    var _$slider = $( slider );

    var _$elems_container = _$slider.find( Wizzaro.Plugins.Slider.Config.elements_container );

    var _transition_speed = getSliderAttr( 'data-transition-speed', Wizzaro.Plugins.Slider.Config.transition_speed ),
        _pause_betwen_transition = parseInt( getSliderAttr( 'data-pause-betwen-transition', Wizzaro.Plugins.Slider.Config.pause_betwen_transition ), 10 ),
        _pause_on_hover = getSliderAttr( 'data-pause-on-hover', Wizzaro.Plugins.Slider.Config.pause_on_hover );

    var _slider_elems_html = _$elems_container.html();

    var _elems = _$elems_container.find( Wizzaro.Plugins.Slider.Config.element_container );

    var _elem_width;
    var _slider_width;
    var _elem_percent;
    var _current_elem = _elems.first();

    var _animation_timeout;
    var _animation_stop = true;

    //start
    calculateVariables();

    if ( _slider_width < ( _elem_width * _elems.length ) ) {
        _animation_stop = false;
        startAnimation();
    }

    if ( _pause_on_hover == '1' ) {
        _$elems_container.hover( hoverHandlerIn, hoverHandlerOut );
    }

    $( window ).resize( windowResize );

    function getSliderAttr( key, default_val ) {
        var val = _$slider.attr( key );

        if ( $.type( val ) === "undefined" ) {
            return default_val;
        }

        return val;
    }

    function calculateVariables() {
        _elem_width = _elems.first().outerWidth( true );
        _slider_width = _$slider.width();
        _elem_percent = ( _elem_width * 100 ) / _slider_width;
    }

    function startAnimation() {
        if ( ! _animation_stop ) {
            _$elems_container.animate({
                left: '-' + _elem_percent + '%'
            }, _transition_speed, 'linear', animate );
        }
    }

    function stopAnimation() {
        clearTimeout( _animation_timeout );
        //_$elems_container.stop();
    }

    function animate() {
        if( ! _animation_stop ) {
            _current_elem.clone().appendTo( _$elems_container );
            var next = _current_elem.next( Wizzaro.Plugins.Slider.Config.element_container );
            _current_elem.remove();
            _current_elem = next;

            _$elems_container.css( 'left', 0 );

            if ( _pause_betwen_transition > 0 ) {
                _animation_timeout = setTimeout( startAnimation, _pause_betwen_transition );
            } else {
                startAnimation();
            }
        }
    }

    function animateNext() {

    }

    function hoverHandlerIn() {
        stopAnimation();
        _animation_stop = true;
    }

    function hoverHandlerOut() {
        _animation_stop = false;
        startAnimation();
    }

    function windowResize() {
        _elems = _$elems_container.find( Wizzaro.Plugins.Slider.Config.element_container );
        calculateVariables();

        if ( _slider_width < ( _elem_width * _elems.length ) ) {
            if ( _animation_stop ) {
                _animation_stop = false;
                startAnimation();
            }
        } else {
            _animation_stop = true;
            _$elems_container.stop( true, true );
            clearTimeout( _animation_timeout );
            _$elems_container.html( _slider_elems_html );
            _elems = _$elems_container.find( Wizzaro.Plugins.Slider.Config.element_container );
            _current_elem = _elems.first();
        }
    }
};
