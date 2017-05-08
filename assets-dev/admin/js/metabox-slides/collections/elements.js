Wizzaro.namespace('Plugins.Slider.MetaboxSlides.Collection');
Wizzaro.Plugins.Slider.MetaboxSlides.Collection.Elements = Backbone.Collection.extend({
    model: Wizzaro.Plugins.Slider.MetaboxSlides.Entity.Element,

    getSelectedElements: function() {
        return this.where( { select: true } );
    }
});
