(function() {
    tinymce.PluginManager.add( 'wizzaro_sliders', function( editor, url ) {
        var shortcode_tag = wpWizzaroSliders.shordcode_name;
        var lists_values = [];

        jQuery.each( wpWizzaroSliders.lists , function( id, title ) {
            lists_values.push({
                text: title,
                value: id
            });
        });

        //Editor functions

		editor.addButton( 'wizzaro_sliders_add', {
			icon: 'wizzaro-sliders-add',
			tooltip: editor.getLang( 'wizzaro_sliders.add_button_title' ),
			onclick: function() {
				editor.execCommand( 'wizzaro_sliders_add_popup' );
			}
		});

        editor.addCommand( 'wizzaro_sliders_add_popup', function( ui, v ) {
            editor.windowManager.open({
                title: editor.getLang('wizzaro_sliders.add_button_title'),
                body: [
                    {
                        type: 'listbox',
                        name: 'slider_id',
                        label: editor.getLang( 'wizzaro_sliders.slider_id' ),
                        values: lists_values
                    },
                    {
                        type: 'checkbox',
                        name: 'use_arrows',
                        label: editor.getLang( 'wizzaro_sliders.use_arrows' )
                    },
                    {
                        type: 'checkbox',
                        name: 'use_bullets',
                        label: editor.getLang( 'wizzaro_sliders.use_bullets' )
                    }
                ],
                onsubmit: function( e ) {
                    var content = '[' + shortcode_tag + ' id="' + e.data.slider_id + '" use_arrows="';

                    if ( e.data.use_arrows === true ) {
                        content += '1';
                    } else {
                        content += '0';
                    }

                    content += '" use_bullets="';

                    if ( e.data.use_bullets === true ) {
                        content += '1';
                    } else {
                        content += '0';
                    }

                    content += '"]';


                    editor.insertContent( content );
                }
            });
        });
    });
})();
