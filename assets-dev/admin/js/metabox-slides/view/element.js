Wizzaro.namespace('Plugins.Slider.MetaboxSlides.View');
Wizzaro.Plugins.Slider.MetaboxSlides.View.Element = Backbone.View.extend({
    config: null,
    template: null,

    $imageElem: null,
    $imageIdInputElem: null,

    mediaFrame: null,

    initialize: function( options ) {
        this.config = options.config;
        this.template = _.template( jQuery( this.config.view_template ).html() );

        this.render( options.use_template );

        this.listenTo( this.model, 'change:select', this.markSelected );
        this.listenTo( this.model, 'destroy', this.destroyModel );
    },

    render: function( render_template ) {
        if ( render_template !== false ) {
            this.$el.addClass( this.config.container_class );
            this.$el.html( this.template( this.model.toJSON() ) );
        }

        this.mediaFrame = wp.media({
            title: wp.media.view.l10n.setFeaturedImage,
            multiple: false,  // Set to true to allow multiple files to be selected
            state: 'featured-image',
            states: [ new wp.media.controller.FeaturedImage() ]
        });

        this.mediaFrame.on( 'toolbar:create:featured-image', function( toolbar ) {
            this.createSelectToolbar( toolbar, {
                text: wp.media.view.l10n.setFeaturedImage,
            });
        }, this.mediaFrame );

        this.mediaFrame.on( 'select', this.setImage.bind( this ) );

        this.$imageElem = this.$el.find( this.config.image_elem );
        this.$imageIdInputElem = this.$el.find( this.config.image_id_input );

        this.$el.find( this.config.image_set_button ).on( 'click', this.openMediaFrame.bind( this ) );
        this.$el.find( this.config.select_elem_button ).on( 'click', this.select.bind( this ) );
        this.$el.find( this.config.delete_elem_button ).on( 'click', this.delete.bind( this ) );
    },

    openMediaFrame: function( event ) {
        event.preventDefault();
        event.stopPropagation();

        var featured_img_id = this.$imageIdInputElem.val();

        if ( featured_img_id.length == 0 ) {
            featured_img_id = -1;
        }

        wp.media.view.settings.post.featuredImageId = featured_img_id;

        this.mediaFrame.open();
    },

    setImage: function() {
        var attachment = this.mediaFrame.state().get('selection').first().toJSON();
        this.$imageIdInputElem.val( attachment.id );
        this.$imageElem.attr( 'src', attachment.url );
        this.$imageElem.show();
    },

    select: function( event ) {
        event.preventDefault();
        event.stopPropagation();
        this.model.toggleSelect();
    },

    markSelected: function() {
        if ( this.model.get( 'select' ) === true ) {
            this.$el.addClass( this.config.selected_class );
        } else {
            this.$el.removeClass( this.config.selected_class );
        }
    },

    changeShow: function() {
        if ( this.model.get( 'show' ) === false ) {
            this.remove();
        }
    },

    delete: function( event ) {
        event.preventDefault();
        event.stopPropagation();

        if ( confirm( wpWizzaroSliderMetaboxSlidesConfig.l10n.delete_element ) ) {
            this.model.destroy();
        }
    },

    destroyModel: function() {
        this.remove();
    }
});
