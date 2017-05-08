Wizzaro.namespace('Plugins.Slider.MetaboxSlides.View');
Wizzaro.Plugins.Slider.MetaboxSlides.View.AddedElements = Backbone.View.extend({
    el: Wizzaro.Plugins.Slider.MetaboxSlides.Config.added_elements_list.container,
    config: Wizzaro.Plugins.Slider.MetaboxSlides.Config.added_elements_list,

    no_elements_template: _.template( jQuery( Wizzaro.Plugins.Slider.MetaboxSlides.Config.added_elements_list.view_no_elements_template ).html() ),

    collection: null,

    $remove_elements_button: null,
    $elements_list: null,

    initialize: function() {
        this.$remove_elements_button =  this.$el.find( this.config.remove_elems_button );
        this.$elements_list = this.$el.find( this.config.elems_list );

        this.$elements_list.sortable( {
            items: '> ' + this.config.element.container,
            placeholder: this.config.element.placeholder_class,
            cursor: 'move',
            opacity: this.config.element.sortable_opatity,
        } ).disableSelection();

        this.collection = new Wizzaro.Plugins.Slider.MetaboxSlides.Collection.Elements();

        jQuery.each( this.$el.find( this.config.elems_list ).find( this.config.element.container ), function( index, value ) {
            var elem = jQuery( value );

            var model = new Wizzaro.Plugins.Slider.MetaboxSlides.Entity.Element({});

            this.collection.add( model );

            var view = new Wizzaro.Plugins.Slider.MetaboxSlides.View.Element({
                el: elem,
                model: model,
                config: this.config.element,
                use_template: false
            });

            this.listenTo( model, 'change:select', this.toggleDeleteElemsButtonVisible );
        }.bind( this ) );

        //events
        this.listenTo( this.collection, 'remove', this.checkEmptyInfo );
        this.listenTo( this.collection, 'remove', this.toggleDeleteElemsButtonVisible );

        this.$el.find( this.config.add_new_elem_button ).on( 'click', this.addNewElement.bind( this ) );
        this.$el.find( this.config.select_all_elems_button ).on( 'click', this.selectAllElems.bind( this ) );
        this.$el.find( this.config.unselect_all_elems_button ).on( 'click', this.unSelectAllElems.bind( this ) );

        this.$remove_elements_button.on( 'click', this.removeSelectedElements.bind( this ) );
    },

    filterNoAdedDisplayElement: function( display, model ) {
        if ( ! _.isUndefined( this.collection.findWhere( { id: model.get( 'id' ) } ) ) ) {
            return false;
        }

        return display;
    },

    checkEmptyInfo: function() {
        if ( this.collection.length <= 0 ) {
            this.$elements_list.html( this.no_elements_template() );
        }
    },

    addNewElement: function() {
        if ( this.$elements_list.find( '> ' + this.config.element.container ).length <= 0 ) {
            this.$elements_list.html( '' );
        }

        var model = new Wizzaro.Plugins.Slider.MetaboxSlides.Entity.Element({ unique_id: (this.collection.length + 1) });
        this.collection.add( model );

        var view = new Wizzaro.Plugins.Slider.MetaboxSlides.View.Element({
            model: model,
            config: this.config.element,
        });

        this.listenTo( model, 'change:select', this.toggleDeleteElemsButtonVisible );

        this.$elements_list.append( view.$el );

        this.$elements_list.sortable( 'refresh' );
        this.checkEmptyInfo();
    },

    toggleDeleteElemsButtonVisible: function() {
        if ( this.collection.getSelectedElements().length > 0 ) {
            this.$remove_elements_button.attr( 'disabled', false );
        } else {
            this.$remove_elements_button.attr( 'disabled', true );
        }
    },

    selectAllElems: function( event ) {
        event.preventDefault();
        event.stopPropagation();

        this.collection.invoke( 'select' );
    },

    unSelectAllElems: function( event ) {
        event.preventDefault();
        event.stopPropagation();

        this.collection.invoke( 'unselect' );
    },

    removeSelectedElements: function( event ) {
        event.preventDefault();
        event.stopPropagation();

        var selected_elems = this.collection.getSelectedElements();

        if ( selected_elems.length > 0 && confirm( wpWizzaroSliderMetaboxSlidesConfig.l10n.delete_elements ) ) {
            _.invoke( selected_elems, 'destroy' );
        }
    }
});
