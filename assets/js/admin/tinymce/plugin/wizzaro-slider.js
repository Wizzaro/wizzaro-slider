!function(){tinymce.PluginManager.add("wizzaro_sliders",function(e,a){var i=wpWizzaroSliders.shordcode_name,s=[];jQuery.each(wpWizzaroSliders.lists,function(e,a){s.push({text:a,value:e})}),e.addButton("wizzaro_sliders_add",{icon:"wizzaro-sliders-add",tooltip:e.getLang("wizzaro_sliders.add_button_title"),onclick:function(){e.execCommand("wizzaro_sliders_add_popup")}}),e.addCommand("wizzaro_sliders_add_popup",function(a,d){e.windowManager.open({title:e.getLang("wizzaro_sliders.add_button_title"),body:[{type:"listbox",name:"slider_id",label:e.getLang("wizzaro_sliders.slider_id"),values:s},{type:"checkbox",name:"use_arrows",label:e.getLang("wizzaro_sliders.use_arrows")},{type:"checkbox",name:"use_bullets",label:e.getLang("wizzaro_sliders.use_bullets")}],onsubmit:function(a){var s="["+i+' id="'+a.data.slider_id+'" use_arrows="';!0===a.data.use_arrows?s+="1":s+="0",s+='" use_bullets="',!0===a.data.use_bullets?s+="1":s+="0",s+='"]',e.insertContent(s)}})})})}();