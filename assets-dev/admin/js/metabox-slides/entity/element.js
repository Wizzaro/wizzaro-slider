Wizzaro.namespace('Plugins.Slider.MetaboxSlides.Entity');
Wizzaro.Plugins.Slider.MetaboxSlides.Entity.Element = Backbone.Model.extend({

    defaults: function() {
        return {
            unique_id: 0,
            select: false,
        };
    },

    destroy: function(options) {
        options = options ? _.clone( options ) : {};
        var model = this;
        var success = options.success;
        var wait = options.wait;

        var destroy = function() {
            model.stopListening();
            model.trigger('destroy', model, model.collection, options);
        };

        options.success = function( resp ) {
            if ( wait ) destroy();
            if ( success ) success.call( options.context, model, resp, options );
            if ( ! model.isNew() ) model.trigger( 'sync', model, resp, options );
        };

        var xhr = false;
        _.defer(options.success);
        if ( ! wait ) destroy();
        return xhr;
    },

    select: function() {
        this.set( 'select', true );
    },

    unselect: function() {
        this.set( 'select', false );
    },

    toggleSelect: function() {
        if ( this.get( 'select' ) === true ) {
            this.unselect();
        } else {
            this.select();
        }
    }
});
