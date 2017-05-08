Wizzaro.namespace('Plugins.Slider.MetaboxSlides');
Wizzaro.Plugins.Slider.MetaboxSlides.Config = Wizzaro.Plugins.Slider.MetaboxSlides.Config || {
    added_elements_list: {
        view_no_elements_template: '#wizzaro-slider-metabox-slides-no-elements',
        container: '#wizzaro-slider-metabox-added-slides',
        elems_list: '.wsms-list',
        add_new_elem_button: '.wsms-add-bt',
        remove_elems_button: '.wsms-remove-selected-bt',
        select_all_elems_button: '.wsms-select-all',
        unselect_all_elems_button: '.wsms-unselect-all',
        element: {
            view_template: '#wizzaro-slider-metabox-slides-element',
            container: '.wsms-l-elem',
            container_class: 'wsms-l-elem',
            image_elem: '.wsms-l-e-image img',
            image_id_input: '.wsms-l-e-image input',
            image_set_button: '.wsms-l-e-image .wsms-action-set-image',
            select_elem_button: '.wsms-l-e-select a',
            delete_elem_button: '.wsms-action-delete',
            selected_class: 'wsms-l-elem-selected',
            placeholder_class: 'wsms-l-elem-placeholder',
            sortable_opatity: 0.7
        }
    }
};
