/*
PAGELAYER
http://pagelayer.com/
(c) Pagelayer Team
*/

pagelayer = {
	$: jQuery,
	$$ : function(select){
		return jQuery(select, window.parent.document);
	},
	gDocument : jQuery(window.parent.document).add(document),
	p : this,
	copy_selected: '',
	mouse: {x: -1, y: -1},
	history_action : true,
	global_render : true,
	history_lastTime : new Date(),
	props_ref : {},
	pro_txt : '',
	loaded : 0,
	post_status : '',
	el: {},// All elements data
}

var pagelayer_history_obj = {}, pagelayer_revision_obj = {};
var pagelayer_add_section_data = {};

// Console error manager
window.onerror = function (msg, url, lineNo, columnNo, error) {

	if (typeof pagelayer_doc_width === 'undefined') {	
		var test_giver = -1;
		
		jQuery.ajax({
			url: pagelayer_url+'/js/givejs.php?test=1',
			type: "GET",
			dataType: "text",
			success: function(data){
			
				if(data != 1){
					return;
				}
				
				test_giver = 1;
			},
			complete: function(data){
				jQuery.ajax({
					type: "POST",
					url: pagelayer_ajax_url+"&action=pagelayer_set_jscss_giver",
					data: { 
						pagelayer_nonce: pagelayer_ajax_nonce,
						set : test_giver
					},
					error: function(errorThrown){
						console.log("Error saving giver data");
						console.log(errorThrown);
					}
				});	
			}
		});
	}
	
	var string = msg.toLowerCase();
	var substring = "script error";
	
	if(pagelayer.loaded > 0){
		return;
	}
	
	if (string.indexOf(substring) > -1){
		return;
	}

	if(url.indexOf('pagelayer')=== -1){
		return;
	}

	var message = [
		"Message: " + msg,
		"\r\n<br>URL: " + url,
		"\r\n<br>Line: " + lineNo,
		"\r\n<br>Column: "+ columnNo,
		"\r\n<br>Error object: " + error
	].join('\n');
	//alert("Script Error: See browser console for details");

	pagelayer.$$('.pagelayer-errorBox-content').html(message);
	pagelayer.$$('.pagelayer-errorBox-close').on('click', function(){	
		pagelayer.$$('.pagelayer-errorBox').fadeOut();
	});
	pagelayer.$$('.pagelayer-errorBox').fadeIn();

	return false;
};

// Lets start
jQuery(document).ready(pagelayer_start);

// Function to load the codes
function pagelayer_start(){
	
	pagelayer.loading = 1;
	console.log('['+pagelayer_brand+'] Starting Pagelayer');
	
	// Prevent the click Insite editor
	pagelayer_prevent_click();
	
	// Set the title of the parent window
	try{ pagelayer.$$('head').append(pagelayer.$('title')[0].outerHTML); }catch(e){};
	
	pagelayer.blank_img = pagelayer_url+'/images/default-image.png';

	pagelayer_shortcodes['pl_inner_row'] = JSON.parse(JSON.stringify(pagelayer_shortcodes['pl_row']));
	pagelayer_shortcodes['pl_inner_row']['name'] = 'Inner Row';
	pagelayer_groups['grid'].push('pl_inner_row');

	// Removing post props options
	pagelayer_setting_post_props();
	
	// Make the Topbar
	pagelayer_bottombar();
	
	// Make the Leftbar
	pagelayer_leftbar();
	
	// Make widget list toolbar
	pagelayer_create_widget_tooltip();
	
	// Add widget section
	pagelayer_add_widget();
	
	// Setup the ELPD
	pagelayer_elpd_setup();
	
	// Dump the data we have
	pagelayer_element_dump_data();
	
	// Setup the properties of the elements
	pagelayer_element_setup();
	
	// An image to show for drag
	jQuery('body').append('<img src="'+pagelayer_url+'/images/drag-ghost.png" class="pagelayer-drag-show" />');
	
	// Setup the grid drag
	pagelayer_setup_drag();
	
	// Set left bar draggable
	pagelayer_make_leftbar_movable();
	
	// Set to desktop
	pagelayer_set_screen_mode('desktop');
	
	// Create list of fonts
	pagelayer_fonts = pagelayer_l('pl_fonts_list');
	
	// Set up right click
	pagelayer_left_click();
	pagelayer_right_click();
	
	// Setup pagelayer history handle
	pagelayer_history_obj['action_data'] = [];
	pagelayer_history_setup(true);
	
	// Make a quick access of the props
	pagelayer_make_props_ref();
	
	// Post props exported defaults need to be updated
	pagelayer_set_exported_defaults();
	
	// Do any actions here
	pagelayer_trigger_action('pagelayer_setup_history');
	
	// Editor Tooltips
	pagelayer_tooltip_setup();
	
	// Load Fonts	
	for(var x in pagelayer_loaded_icons){
		var item = pagelayer_loaded_icons[x];
		jQuery.when(
			pagelayer_get_stored_data(pagelayer_url+'/fonts/'+item+'.json', pagelayer_ver)
		).then(function(){
			pagelayer_icons[item] = JSON.parse(pagelayer_get_stored_data(pagelayer_url+'/fonts/'+item+'.json', pagelayer_ver));
		});
	};

	// Set row-option top zero(0) of the first row
	pagelayer_set_row_option_position();
	
	// Just the txt
	pagelayer.pro_txt = pagelayer_pro_txt;
	
	// Open post props on document load
	pagelayer.$$('.pagelayer-settings').click();
	
	// Open post props and Make elements editable to edit post props data 
	pagelayer_setup_props_editable();
  	
	// Make elements editable
	jQuery(pagelayer_editable+' [pagelayer-editable]').attr('contenteditable', 'true');
	
	// Use text widget for search widget
	pagelayer_search_widgets();
	
	// Hide the loader
	pagelayer_loader_hide();
	
}

// Post props attribute
function pagelayer_post_props_atts(prop, val, temp){
	
	val = val || null;
	temp = temp || false;
		
	var proEle = jQuery(pagelayer_editable+' .pagelayer-post_props.pagelayer-ele').first();
	
	if(!pagelayer_empty(temp)){
		if(val === null){
			return pagelayer_get_tmp_att(proEle, prop);
		}
		
		// Set the temp property as well
		pagelayer_set_tmp_atts(proEle, prop, val);
		return true;
	}
	
	if(val === null){
		return pagelayer_get_att(proEle, prop);
	}
	
	// Set the property as well
	pagelayer_set_atts(proEle, prop, val);
	return true;
}

// Open post props and Make elements editable to edit post props data
function pagelayer_setup_props_editable(){
	
	jQuery('[pagelayer-props-editable]').each(function(){
		var jEle = jQuery(this);
		
		// Skip element under the editable area 
		if (jEle.closest(pagelayer_editable).length > 0) {
			return;
		}
		
		var prop = jEle.attr('pagelayer-props-editable');
		
		// Make editable
		jEle.attr('contenteditable', 'true');
		
		// Reverse setup the event
		jEle.on('focus', function(){
			// Set the property as well
			var data = pagelayer_post_props_atts(prop);
			jEle.html(data);
		});
		
		// Reverse setup the event
		jEle.on('input', function(){
			
			var val = pagelayer_trim(jEle.html());
			
			// Set the property as well
			pagelayer_post_props_atts(prop, val);
			
			// Update the property
			var input = pagelayer.$$('[pagelayer-elp-name='+prop+']').find('input,textarea,.trumbowyg-editor');
			//console.log(input);
			
			if(input.length > 0){
				if(input.hasClass('trumbowyg-editor')){
					input.html(val);
				}else{
					input.val(val);
				}
			}
		
		});
		
	});

}

// Prevent the click Insite editor
function pagelayer_prevent_click(){
	jQuery(document).on('submit', function(event){
		var target = jQuery(event.target);
		if (target.closest(pagelayer_editable).length < 1) {
			event.preventDefault();
		}
	});
	
	jQuery(document).on('click', function(event){
		var target = jQuery(event.target);
		if (target.closest('a').length > 0 && target.closest(pagelayer_editable).length < 1) {
			event.preventDefault()
		}
	});
}

// Removing post props options from the editor
function pagelayer_setting_post_props(){
	
	if(pagelayer_empty(pagelayer_post_categories)){
		delete pagelayer_shortcodes.pl_post_props.postCategory;
	}
	
	if(pagelayer_empty(pagelayer_post_tags)){
		delete pagelayer_shortcodes.pl_post_props.postTags;
	}

	if(pagelayer_empty(pagelayer_shortcodes.pl_post_props.pageParent.post_parent.list)){
		delete pagelayer_shortcodes.pl_post_props.pageParent;
	}
	
	if(pagelayer_post.post_type != 'post'){
		delete pagelayer_shortcodes.pl_post_props.params.post_sticky;
	}
	
	if(pagelayer_empty(pagelayer_post_type_features['comments'])){
		delete pagelayer_shortcodes.pl_post_props.postDiscussion.comment_status;
	}
	
	if(pagelayer_empty(pagelayer_post_type_features['trackbacks'])){
		delete pagelayer_shortcodes.pl_post_props.postDiscussion.ping_status;
	}
	
	if(pagelayer_empty(pagelayer_shortcodes.pl_post_props.postDiscussion)){
		delete pagelayer_shortcodes.pl_post_props.postDiscussion;
	}
	
	if(pagelayer_empty(pagelayer_post_type_features['excerpt'])){
		delete pagelayer_shortcodes.pl_post_props.postExcerpt;
	}
	
	if(pagelayer_empty(pagelayer_post_type_features['thumbnail'])){
		delete pagelayer_shortcodes.pl_post_props.postFeaturedImage;
	}
	
	if(pagelayer_empty(pagelayer_post_type_features['author'])){
		delete pagelayer_shortcodes.pl_post_props.params.post_author;
	}
}

// Set the default values of all default exported codes
function pagelayer_set_exported_defaults(){
	
	// Set defaults for the exported variety
	if(pagelayer_empty(pagelayer_default_params)){
		return;
	}
	
	for(var tag in pagelayer_default_params){
		
		for(var x in pagelayer_default_params[tag]){
			
			if(x in pagelayer.props_ref[tag]){
				pagelayer.props_ref[tag][x]['default'] = pagelayer_default_params[tag][x];
			}
			
		}
		
	}

}

// Do pagelayer Dirty
function pagelayer_do_dirty(jEle){
	
	pagelayer_isDirty = true;
	
	if (!window.onbeforeunload) {
		window.onbeforeunload = function(){
			return true;
		};
	}
	
	pagelayer_trigger_action('pagelayer_do_dirty', [jEle]);
}

function pagelayer_do_undirty(){

	pagelayer_isDirty = false;
	
	if (window.onbeforeunload) {
		window.onbeforeunload = null;
	}
	
}

// Executes when pagelayer is fully loaded
function pagelayer_loader_hide(){
	var inner = pagelayer.$$('.pagelayer-percent');
	inner.attr('loaded', 1);
	var w = parseInt(inner.text());
	var t = setInterval(function() {
		w = w + 1;
		inner.html(w +'<sup>%</sup>');
		if (w >= 100){
			clearInterval(t);
			w = 0;
			var loaderWrapper = pagelayer.$$('#pagelayer-loader-wrapper');	
			loaderWrapper.addClass('pagelayer-loaded');
			loaderWrapper.animate({opacity:0}, function(){
				loaderWrapper.remove();
			});
		}
	}, 1);
	pagelayer.loaded = 1;
}

// Set row-option top zero(0) of the first row
function pagelayer_set_row_option_position(){
	try{
		if(jQuery(pagelayer_editable).offset().top < 20){
			jQuery(pagelayer_editable).addClass('pagelayer-row-option-zero');
		}
	}catch(e){
		console.log(pagelayer_editable+" not found and hence Pagelayer wont work on this page !");
	}
}

// The jQuery Object of the ELPD
var pagelayer_elpd;

// Store data values
function pagelayer_get_stored_data(url, version){
	var name = 'pagelayer_'+url;
	var data = {};
	var force = false;
	
	// Try to parse the data
	try{
		data = JSON.parse(localStorage.getItem(name));
		
		if(data['version'] !== version){
			force = true;
		}
		
	}catch(e){
		force = true;
	}
	
	// Force download
	if(force){
		return jQuery.ajax({
			url: url,
			type: 'GET',
			dataType: 'text',
			success:function(newData){
				var data = {};
				data['version'] = version;				
				data['val'] = newData;
				localStorage.setItem(name, JSON.stringify(data));
			}
		});
	}
	
	return data['val'];
	
}

function pagelayer_closest_corner(jEle){
	var corners = [];
	var w = jEle.outerWidth();
	var h = jEle.outerHeight();	
	var topleft = jEle.offset();
	
	// 0 - Top Left
	corners.push(topleft);
	
	// 1 - Top Right
	corners.push({top: topleft.top, left: topleft.left+w});
	
	// 2 - Bottom Right
	corners.push({top: topleft.top+h, left: topleft.left+w});
	
	// 3 - Bottom Left
	corners.push({top: topleft.top+h, left: topleft.left});
	
	//console.log(corners);
	
	// Calculate the closest to the mouse
	var distances = {};
	for(var c in corners){
		var dist = Math.hypot(pagelayer.mouse.x - corners[c].left, pagelayer.mouse.y - corners[c].top);
		distances[c] = dist;
	}	
	//console.log(distances);
	
	var corner = Object.keys(distances).sort(function(a,b){return distances[a]-distances[b]})[0];
	//console.log(corner);
	
	return corner;
	
};

// Make left bar draggable
function pagelayer_make_leftbar_movable(){
	var pl_iframe = pagelayer.$$('.pagelayer-iframe'),
		pl_leftbar = pagelayer.$$('.pagelayer-leftbar-table');

	// On mouse down in pagelayer-topbar-holder
	pagelayer.$$('.pagelayer-topbar-mover').on('mousedown', function(e){
		e = e || window.event;
		e.preventDefault();
		
		// Get leftbar position
		var orig_eleX = pl_leftbar.offset().left;
		var orig_eleY = pl_leftbar.offset().top;
		
		// Get the mouse cursor position at startup:
		var posX = e.clientX;
		var posY = e.clientY;
		
		// The variable needs to be empty.
		var newMethod = '',
		change = true;
		
		var leftbar_mousemove = function(e){
			e = e || window.event;
			
			if(change){
				// Add class to leftbar
				pl_leftbar.addClass('pagelayer-leftbar-moving');
				
				// Add left-right overlay
				pl_iframe.before('<div class="pagelayer-leftbar-move pagelayer-moveto-left"></div>');
				pl_iframe.after('<div class="pagelayer-leftbar-move pagelayer-moveto-right"></div>');
				pagelayer.$$('body').addClass('pagelayer-overflow-hidden');
				change = false;
			}
					
			// calculate the new cursor position and set the element left-top position
			var top = orig_eleY + (e.clientY - posY);
			var left = orig_eleX + (e.clientX - posX);

			// set the element's new position:
			pl_leftbar.css({'top': top +'px','left': left +'px'});
			pagelayer.$$('.pagelayer-leftbar-toggle').hide();
				
			// Make a copy of new method
			var _newMethod = newMethod;
			newMethod = '';
			
			// Get near by corner
			var offleft = pl_iframe.offset().left;
			
			if(offleft + 100 > e.clientX){
				newMethod =  'before';
			}else if(offleft+pl_iframe.outerWidth()- 100 < e.clientX){
				newMethod =  'after';
			}
			
			if(_newMethod != newMethod){
				pagelayer.$$('.pagelayer-leftbar-move').css({'width' :'', 'opacity': '0.33'});
				
				if(newMethod == 'after'){
					pagelayer.$$('.pagelayer-moveto-right').animate({'width' :'60px', 'opacity': '0.66'}, 200);
					pl_leftbar.addClass('pagelayer-rightbar');
				}else if(newMethod == 'before'){
					pagelayer.$$('.pagelayer-moveto-left').animate({'width' : '60px', 'opacity': '0.66'}, 200);
					pl_leftbar.removeClass('pagelayer-rightbar');
				}
			}
		
		};
		
		var leftbar_mouseup = function(e){
			
			// Remove events
			pagelayer.gDocument.off('mousemove', leftbar_mousemove);
			pagelayer.gDocument.off('mouseup', leftbar_mouseup);
			
			// Remove class to leftbar			
			pagelayer.$$('.pagelayer-leftbar-move').remove();
			
			var windowHeight = jQuery(window).height();
			
			if(pl_leftbar.offset().top < 0){
				pl_leftbar.css({'top': '10px'});
			}else if( (windowHeight - e.clientY) < 10){
				pl_leftbar.css({'top': ''+windowHeight - 40+'px'});
			}
			
			if( !pagelayer_empty(newMethod)){
				pl_leftbar.removeClass('pagelayer-leftbar-moving');
				pl_leftbar.removeAttr('style');
				pagelayer.$$('.pagelayer-leftbar-toggle').show();
				pagelayer.$$('body').removeClass('pagelayer-overflow-hidden');
				pl_iframe[newMethod](pl_leftbar);
			}
			
			// make change true
			change = true;
		};
		
		pagelayer.gDocument.on('mouseup', leftbar_mouseup);
		pagelayer.gDocument.on('mousemove', leftbar_mousemove);

	});
	
}

// Make rows and cols draggable
function pagelayer_setup_drag(){
	
	// The object to show as drag
	var shower = jQuery('.pagelayer-drag-show');
	
	// Delete any prospect
	var clear_prospect = function(){
		jQuery('.pagelayer-drag-prospect').remove();
		
		// Shows the wrap as active
		jQuery('.pagelayer-drag-ele-hover').removeClass('pagelayer-drag-ele-hover');
	}
	
	// Reset the complete drag stuff
	var reset_dragging = function(){
		pagelayer.dragging = false;
		pagelayer.drag_is_new = false;
		pagelayer.drag_mouse = {x: 0, y: 0};
		reset_on_drag();
	}
	
	// Reset the element on you were last
	var reset_on_drag = function(){
		pagelayer.drag_closest = false;
		pagelayer.drag_closest_corner = null;
	}
	
	// Scroll by
	var scrollPx = 7;
	var scrollDist = 30;
	
	// If we are too close too the window edge, then scroll
	var handle_scroll = function(e){
		
		var windowHeight = jQuery(window).height();
		var windowWidth = jQuery(window).width();
	
		// Are we to close to the top or bottom
		if(e.clientY < scrollDist){
			window.scrollBy(0, -scrollPx);
		}else if((windowHeight - e.clientY) < scrollDist){
			window.scrollBy(0, scrollPx);
		}		
		
		// Are we to close to the top or bottom
		if(e.clientX < scrollDist){
			window.scrollBy(-scrollPx, 0);
		}else if((windowWidth - e.clientX) < scrollDist){
			window.scrollBy(scrollPx, 0);
		}
		
	}
	
	// SET the values
	reset_dragging();
	
	var ondragover = function(e) {
		//console.log(e);
		
		pagelayer.mouse.x = parseInt(e.pageX);
		pagelayer.mouse.y = parseInt(e.pageY);
		//console.log(pagelayer.mouse);
		
		// Are we dragging ?
		if(pagelayer.dragging){
			
			//console.log(e);
			
			e.preventDefault();			
			//e.stopPropagation();
			
			// The wrap of the element being dragged
			var wrap = pagelayer.dragging;
			
			// New addition
			var is_new = pagelayer.drag_is_new;
			var ele;
			var tag = pagelayer_tag(wrap);
			var id = pagelayer_id(wrap);
			
			// If existing element then add we are dragging
			if(!is_new){
				
				// Start Dragging
				if(!wrap.hasClass('pagelayer-is-dragging')){
					wrap.addClass('pagelayer-is-dragging');
				}
				
				//shower.hide();
			
				ele = document.elementFromPoint(e.clientX, e.clientY);
				//console.log(ele);
				
				// Drag the show object
				//shower.show();
				//var offset = {top: (e.pageY-10)+'px', left: (e.pageX-10)+'px'}
				//shower.css(offset);
				
			}else{
				ele = document.elementFromPoint(e.clientX, e.clientY);
			}
			//console.log(e);
			
			// Have we moved more than 5px;
			var dist = Math.hypot(pagelayer.mouse.x - pagelayer.drag_mouse.x, pagelayer.mouse.y - pagelayer.drag_mouse.y);
			//console.log(dist);
			/*if(dist && dist < 5){
				return false;
			}*/
			
			// Handle the scroll
			handle_scroll(e);
			
			// Find the closest wrap
			var onWrap;
			
			// If we are a column, we can be over another column or row
			if(tag == 'pl_col'){
				
				// Prevent column in inner-row and it's columns, if the draged column have inner-rows
				if(wrap.find('.pagelayer-wrap-inner-row').length > 0){
					onWrap = jQuery(ele).closest('.pagelayer-wrap-col,.pagelayer-wrap-row');
					
					var innerRow = onWrap.closest(pagelayer_editable +' .pagelayer-wrap-inner-row');
					if( onWrap.length < 1 || innerRow.length > 0){
						onWrap = jQuery(innerRow).closest('.pagelayer-wrap-col,.pagelayer-wrap-row');
					}
					
				}else{
					onWrap = jQuery(ele).closest('.pagelayer-wrap-col,.pagelayer-wrap-row,.pagelayer-wrap-inner-row');
				}
				//console.log(pagelayer_id(onWrap));
				
			// If we are a row, we can be over another row or a column
			}else if(tag == 'pl_row'){
				onWrap = jQuery(ele).closest('.pagelayer-wrap-row');
				//console.log(pagelayer_id(onWrap));
			
			// For inner row we restrict to 1 level only
			}else if(tag == 'pl_inner_row'){
				
				var ele_wrap = jQuery(ele).parents('.pagelayer-wrap-col');
				if(
					(ele_wrap.length == 1 && !jQuery(ele).hasClass('pagelayer-wrap-col')) || 
					(ele_wrap.length == 0 && jQuery(ele).hasClass('pagelayer-wrap-col'))
				){
					onWrap = jQuery(ele).closest('.pagelayer-wrap-ele,.pagelayer-wrap-col,.pagelayer-wrap-inner-row');
				}else{
					onWrap = jQuery(ele).closest('.pagelayer-wrap-inner-row');
				}
			// For every other element, we can be over a col or ele
			}else{
				onWrap = jQuery(ele).closest('.pagelayer-wrap-ele,.pagelayer-wrap-col,.pagelayer-wrap-inner-row');
				
				// If we are inside the same widget tag
				// We are allowing for now, hence the following is commented
				/*var sameTag = onWrap.closest(pagelayer_editable +' [pagelayer-tag="'+tag+'"]');
				if(sameTag.length > 0){
					onWrap = sameTag.closest('.pagelayer-wrap-ele');
				}*/
				
				// Is prevent to go inside any widget?
				if('prevent_inside' in pagelayer_shortcodes[tag] && !pagelayer_empty(pagelayer_shortcodes[tag]['prevent_inside'])){
										
					var preTags = pagelayer_shortcodes[tag]['prevent_inside'];
					var prevent_inside = false;
					var preEle = onWrap;
					
					if(typeof preTags === 'string'){
						preTags = [preTags];
					}
					
					for(var toFind in preTags){
						preEle = onWrap.closest(pagelayer_editable +' [pagelayer-tag="'+preTags[toFind]+'"]');
						if (preEle.length > 0) {
							prevent_inside = true;
							break;
						}
					}
					
					// If we find
					if(prevent_inside){
						onWrap = preEle.closest('.pagelayer-wrap-ele');
					}
				}
					
				var widGroup = onWrap.closest('.pagelayer-ele-widget-group');
				
				// If we are inside the group widget
				if(widGroup.length > 0 && widGroup.closest(pagelayer_editable).length > 0){
					
					var wGroupTag = pagelayer_tag(widGroup);
					var use_inside = false;

					// If defined use inside only
					if('use_inside' in pagelayer_shortcodes[tag] && !pagelayer_empty(pagelayer_shortcodes[tag]['use_inside'])){
											
						var inTags = pagelayer_shortcodes[tag]['use_inside'];
						
						if(typeof inTags === 'string'){
							inTags = [inTags];
						}
						
						for(var toFind in inTags){
							if (wGroupTag == inTags[toFind]) {
								use_inside = true;
							}
						}
					}
					
					// If we find nothing
					if(!use_inside){
						onWrap = widGroup.parent('.pagelayer-wrap-ele');
					}
				}
			}
			//console.log(onWrap);
			
			// If we find nothing
			if(pagelayer_empty(onWrap) || onWrap.length < 1){
				clear_prospect();// Clear existing prospects
				reset_on_drag();// Also reset the last on item
				return false;
			}
			
			/*// If the columns more than 12 inside the row then return - As of now not enabled the below code
			if(tag == 'pl_col'){
				var _onTag = pagelayer_tag(onWrap);
				var colEles;
				
				// Is on col
				if(_onTag == 'pl_col'){
					colEles = onWrap.closest('.pagelayer-row-holder').children('.pagelayer-ele-wrap');
				}else{
					colEles = onWrap.find('.pagelayer-row-holder').first().children('.pagelayer-ele-wrap');
				}
				
				// If the columns more than 12
				if(colEles.length >= 12){
					return false;
				}
			}*/
					
			// Get the ID
			var onId = pagelayer_id(onWrap);
			var onEle = pagelayer_ele_by_id(onId);
			
			// Do we have a parent ?
			var have_parent = function(Ele){
				var pOnId = pagelayer_get_parent(Ele);

				if(pagelayer_empty(pOnId) || tag == 'pl_col'){
					return;
				}
				
				onId = pOnId;
				onEle = pagelayer_ele_by_id(pOnId);
				onWrap = pagelayer_wrap_by_id(pOnId);
				have_parent(onEle);
				
			}
			
			// Do we have a parent ?
			have_parent(onEle);
			
			var changed = false;
			
			// Was it the same ID like the one we were on before
			if(pagelayer.drag_closest != onId){
				pagelayer.drag_closest = onId;
				changed = true;
			}
			//console.log(onId+'  '+pagelayer.drag_closest)
			
			var req_corners = {0: 'top', 1: 'top', 2: 'bottom', 3: 'bottom'};
			
			// For columns we redefine the top and bottom
			if(tag == 'pl_col'){
				req_corners[1] = 'bottom';
				req_corners[3] = 'top';
			}
			
			// Determine the previous and next
			var next = wrap.next('.pagelayer-ele-wrap');
			var prev = wrap.prev('.pagelayer-ele-wrap');
			
			if(next.length == 1 && pagelayer_id(next) == onId){
				req_corners = {0: 'bottom', 1: 'bottom', 2: 'bottom', 3: 'bottom'};
			}
			
			if(prev.length == 1 && pagelayer_id(prev) == onId){
				req_corners = {0: 'top', 1: 'top', 2: 'top', 3: 'top'};
			}
			
			// Which corner are we closest to ?
			var corner_num = pagelayer_closest_corner(onWrap);
			var corner = req_corners[corner_num];
			
			//console.log(corner+' != '+pagelayer.drag_closest_corner)
			if(corner != pagelayer.drag_closest_corner){
				pagelayer.drag_closest_corner = corner;
				changed = true;
			}
			
			//console.log(changed);
			
			// If we are on our self then clear return false and we are on hide active widget
			if(onId == id || onWrap.hasClass('pagelayer-hide-active')){
				clear_prospect();// Clear existing prospects
				reset_on_drag();// Also reset the last on item
				return false;
			}
			
			// Then lets start showing
			if(changed){
				
				// Record the mouse points
				pagelayer.drag_mouse.x = parseInt(e.pageX);
				pagelayer.drag_mouse.y = parseInt(e.pageY);
				
				// Clear any existing prospect
				clear_prospect();
				
				// Add new prospect
				var prospect = '<div class="pagelayer-drag-prospect" pagelayer-corner="'+corner+'"></div>';
				
				if(corner == 'bottom'){
					onWrap.append(prospect);
				}else if(corner == 'top'){
					onWrap.prepend(prospect);
				}
				
				prospect = jQuery('.pagelayer-drag-prospect')
				var animate_props = {height: '5px'};
				
				// For column add a special class
				if(tag == 'pl_col'){
					prospect.addClass('pagelayer-drag-prospect-col');
					animate_props['width'] = '5px';
					
					// Adjust the left and right
					var css = {};
					css[(corner == 'bottom' ? 'right' : 'left')] = '0px';
					prospect.css(css);
				}
				
				// Animate the prospect
				prospect.animate(animate_props, 200);
				
				// Highlight the wrap via overlay
				onWrap.children('.pagelayer-ele-overlay').addClass('pagelayer-drag-ele-hover');
				
			}
			
		}
	}
	
	// When mouse is pressed down
	var ondragstart = function(e){
		
		//console.log(e);
		
		// Target
		var tEle = jQuery(e.target);
		var wrap = tEle.closest('.pagelayer-ele-wrap');
		//console.log(jEle[0]);
		
		// Is it an existing element ?		
		if(wrap.length < 1){
			return false;
		}
		
		// Do we have a parent ?
		var id = pagelayer_id(wrap);
		var jEle = pagelayer_ele_by_id(id);
		var pId = pagelayer_get_parent(jEle);
		
		if(pId){
			wrap = pagelayer_wrap_by_id(pId);
		}
		
		//e.preventDefault();
		
		var tag = pagelayer_tag(wrap);
		
		e.originalEvent.dataTransfer.setData('Text', 1);
		var img = document.createElement('img');
		img.src = shower.attr('src');
		e.originalEvent.dataTransfer.setDragImage(img, 32, 32);
		
		pagelayer.dragging = wrap;
		
	}
	
	// When mouse is pressed down
	var ondrop = function(e){
		
		//console.log(e);
		
		// Stop dragging ?
		if(pagelayer.dragging){
			
			e.preventDefault();
			
			var wrap = pagelayer.dragging;
			var tag = pagelayer_tag(wrap);
			var gId = wrap.attr('pagelayer-global-id');
			var fromEl = wrap.parent();
			var id;
			
			// Global ID is there for sure ?
			if(pagelayer_empty(gId) || pagelayer_empty(pagelayer_global_widgets[gId])){
				gId = 0;
			}
			
			wrap.removeClass('pagelayer-is-dragging');
			
			// Find any prospect
			var prospect = jQuery('.pagelayer-drag-prospect');
			//console.log(prospect[0]);
				
			// It should be exactly 1
			if(prospect.length == 1){
				
				var onWrap = prospect.parent();
				var onId = pagelayer_id(onWrap);
				var onTag = pagelayer_tag(onWrap);
				var dropped;	
				var corner = prospect.attr('pagelayer-corner');
				var method = (corner == 'top') ? 'before' : 'after';
				var before_loc; // Location before the drop
				
				// Create the element if it needs to be created
				if(pagelayer.drag_is_new){
					dropped = jQuery('<div pagelayer-tag="'+tag+'"></div>');
					
					// Is there a global ID
					if(!pagelayer_empty(gId)){
						dropped.attr('pagelayer-global-id', gId);
					}
				
				// Move the object
				}else{
					
					// Get near by element before move
					before_loc = pagelayer_near_by_ele(pagelayer_id(wrap), tag);
					
					dropped = wrap;
					dropped.detach();
				}
				
				// If I am a column or row, then I go only before or after my same type !
				if((onTag == 'pl_col' || onTag == 'pl_row') && onTag == tag){
				
				// If I am a column and I am on a row 
				// OR I am a normal element and I am on column
				}else if((tag == 'pl_col' && (onTag == 'pl_row' || onTag == 'pl_inner_row')) || onTag == 'pl_col'){
					// We need to find the holder and add the prospect there
					var holder = pagelayer_shortcodes[onTag]['holder'];
					onWrap = onWrap.children('.pagelayer-ele').children(holder);
					method = (corner == 'top') ? 'prepend' : 'append';
				}
				
				// Attach or shift the element
				onWrap[method](dropped);
				//console.log(dropped);
				
				// Trigger the onadd
				if(pagelayer.drag_is_new){
					id = pagelayer_onadd(dropped);
					
					// Create Column
					if((tag == 'pl_row' || tag == 'pl_inner_row') && pagelayer_empty( dropped.attr('pagelayer-global-id') )){
						var col = jQuery('<div pagelayer-tag="pl_col"></div>');
						jQuery('[pagelayer-id="'+id+'"]').find('.pagelayer-row-holder').append(col);
						var col_id = pagelayer_onadd(col, false);
					}
				
				// Existing elements
				}else{
					id = pagelayer_id(wrap);
					
					// Save in action history
					pagelayer_history_action_push({
						'title' : pagelayer_shortcodes[tag]['name'],
						'action' : 'Moved',
						'pl_id' : id,
						'before_loc' : before_loc,
						'after_loc' : {'method' : method, 'cEle' : onWrap}
					});
					
					pagelayer_do_dirty(pagelayer_ele_by_id(id));
				}
				
				// Defining the variables as needed
				var jEle = pagelayer_ele_by_id(id);
				wrap = pagelayer_wrap_by_id(id);
				var toEl = wrap.parent();
				
				// Column number handle
				if(tag == 'pl_col'){
					
					var row_holder = jEle.parent().closest('.pagelayer-row-holder');
					
					// Renumber the col where you are going
					pagelayer_renumber_col(row_holder);
					
					// Renumber the old columns as well
					if(!pagelayer.drag_is_new){
						var from_row = fromEl.closest('.pagelayer-row-holder');
						pagelayer_renumber_col(from_row);
					}
				}
				
				// Handle the empty col
				if(tag != 'pl_col'){
					
					pagelayer_empty_col(toEl.closest('.pagelayer-col-holder'));
					
					if(!pagelayer.drag_is_new){
						pagelayer_empty_col(fromEl.closest('.pagelayer-col-holder'));
					}
					
				}
				
			}
			
			// Clear prospect
			clear_prospect();
		}
		
		reset_dragging();
		
	}
	
	// Add the events for inner content - as we are using the drag API	
	jQuery(document).on('dragstart', ondragstart);
	jQuery(document).on('dragover', ondragover);
	jQuery(document).on('drop', ondrop);
	
	// For addition of new elements
	pagelayer.$$('.pagelayer-leftbar').on('dragstart', function(e){
		//console.log(e);
		
		var tEle = jQuery(e.target);
		var jEle = tEle.closest('.pagelayer-shortcode-drag');
		var global_id = jEle.attr('pagelayer-global-id');
		
		// Is it an existing element ?
		if(jEle.length < 1){
			return false;
		}
		
		e.originalEvent.dataTransfer.setData('tag', pagelayer_tag(jEle));
		
		if(!pagelayer_empty(global_id)){
			e.originalEvent.dataTransfer.setData( 'global_id', global_id );
		}
		
		pagelayer.dragging = jEle;
		pagelayer.drag_is_new = true;
		
	});
	
	// Handle editable content by removing drag
	var onmousedown = function(e){
		
		var tEle = jQuery(e.originalEvent.explicitOriginalTarget);
		
		if(tEle.closest('[pagelayer-editable]').length > 0){
			//console.log('Is Editable MouseDown');			
			tEle.parents('[draggable]').attr('draggable', 'false');
		}
	
	}
	
	// Handle editable content by adding drag that was removed
	var onmouseup = function(e){
		jQuery(document).find('[draggable=false]').attr('draggable', 'true');
	}
	
	// Handle editable contents by temprarily removing drag
	jQuery(document).on('mousedown', onmousedown);
	jQuery(document).on('mouseup', onmouseup);

};

// Handle empty col
// selector should be col holder
function pagelayer_empty_col(selector){
	
	// Loop through
	jQuery(selector).each(function(){
		
		var jEle = jQuery(this);// jEle is the COL HOLDER
		
		// Are we a col ?
		if(!jEle.hasClass('pagelayer-col-holder')){
			return;
		}
		
		// Column is becoming blank, so show add ele
		if(jEle.children().length < 1){
			//from.addClass('pagelayer-empty-col');
			jEle.append('<div class="pagelayer-add-ele pagelayer-ele-wrap"><i class="fas fa-plus"></i><br /><span>Empty column please Drag Widgets</span></div>');			
			//var h = jEle.parent().parent().children('.pagelayer-ele-overlay').height();
			//jEle.children('.pagelayer-add-ele').height(h);
			
		// Any add ele sign with non-empty columns here ?
		}else if(jEle.children('.pagelayer-add-ele').length > 0 && jEle.children().length > 1){
			jEle.children('.pagelayer-add-ele').remove();
		}
		
		jEle.find('>.pagelayer-add-ele .fas').unbind('click');
		jEle.find('>.pagelayer-add-ele .fas').on('click', function(event){
			event.stopPropagation();
			pagelayer.$$('.pagelayer-elpd-close').click();
			
			pagelayer_show_widget_list(jQuery(this));
		});
		
	});
	
};

// Reset the column widths
// The selector should be a ROW HOLDER
function pagelayer_renumber_col(selector){
	
	var pEle = jQuery(selector);
	var children = pEle.children('.pagelayer-ele-wrap');
	var cols = Math.floor(12 / (children.length));
	var obj = {col: cols};
	
	// Find out the number of cols of other cols
	children.each(function(){
		
		// This is the wrapper
		var jEle = jQuery(this);
		
		// The real element
		var Ele = jEle.find('>.pagelayer-ele');
		
		for(var x=1; x<=12; x++){
			if(jEle.hasClass('pagelayer-col-'+x)){
				jEle.removeClass('pagelayer-col-'+x);
				Ele.removeClass('pagelayer-col-'+x);
				break;
			}
		}
		jEle.addClass('pagelayer-col-'+cols);
		jEle.css({'width': ''});
			
		// Set the att
		pagelayer_set_atts(Ele, obj);
		pagelayer_set_atts(Ele, 'col_width','');
		pagelayer_sc_render(Ele)
	});
}

// Make column resizable handler
function pagelayer_col_make_resizable(wrap){
		
	// Resize handler element
	var rHandler = jQuery('<div class="pagelayer-resize-handler"><div class="pagelayer-resize-icon"></div></div>');
		
	var pResize = wrap.children('.pagelayer-ele-overlay').find('.pagelayer-resize-handler');
	
	if(pResize.length > 0){
		return;
	}
	
	// Append it
	wrap.children('.pagelayer-ele-overlay').append(rHandler);
	
	// Resize start
	rHandler.on('mousedown', function(e) {
		e.preventDefault();
		
		var next_ele = wrap.next();
		var rHolder_width = wrap.closest('.pagelayer-row-holder').width();
		var new_width, nEle_new_width;
		
		// Original width
		var original_width = parseFloat(window.getComputedStyle(wrap[0]).getPropertyValue('width'));
		var next_ele_width = parseFloat(window.getComputedStyle(next_ele[0]).getPropertyValue('width'));
		var original_mouse_x = e.pageX;
		
		var both_width = parseInt(original_width + next_ele_width);
		
		// Add the element width and next element width
		both_width = ((both_width / rHolder_width) *100);
		
		if(both_width > 100){
			return false;
		}
		
		jQuery('body').css({'cursor': 'ew-resize'});
		rHandler.css({'display': 'block'});
		
		var mousemoved = false;
		
		var r_mousemove = function(e){
			mousemoved = true;
			
			var width = original_width + (e.pageX - original_mouse_x);
			
			// Covert width in percentage
			new_width = (width / rHolder_width *100).toFixed(2);
			
			if(both_width > new_width && new_width > 0){
				nEle_new_width = (both_width - new_width).toFixed(2);
				wrap.css({'width': new_width+'%'});
				next_ele.css({'width': nEle_new_width+'%'});
				
				rHandler.attr({'pre-width': new_width+'%', 'next-width': nEle_new_width+'%'}); 
			}
			
		};
		
		var r_mouseup = function(e){
			
			jQuery(document).off('mousemove', r_mousemove);
			jQuery(document).off('mouseup', r_mouseup);
			jQuery('body').css({'cursor': ''});
			rHandler.removeAttr('style pre-width next-width');
			
			// IF mouseMoved
			if(!mousemoved) return;
			
			// find real element and next real element
			var jEle = wrap.find('>.pagelayer-ele');
			var nEle = next_ele.find('>.pagelayer-ele');
			var mode = pagelayer_get_screen_mode();
			var col_width = 'col_width';
			
			// Do we have screen ?
			if(mode != 'desktop'){
				col_width = col_width +'_'+mode;
			}
			
			// Set the element attrs
			pagelayer_set_atts(jEle, col_width, new_width);
			pagelayer_set_atts(jEle, 'col', '');
			pagelayer_set_atts(nEle, col_width, nEle_new_width);
			pagelayer_set_atts(nEle, 'col', '');
			
		};
		
		// Resize start
		jQuery(document).on('mousemove', r_mousemove);
		jQuery(document).on('mouseup', r_mouseup);
	});
}

// Handle addition of elements from the left
// NOTE : At this point the addition is FINALIZED
// The add element cannot be prevented !
function pagelayer_onadd(jEle, toClick){
	
	toClick = arguments.length == 2 ? toClick : true;
	
	//console.log(jEle);
	var id = pagelayer_element_added(jEle);
	var jEle = jQuery("[pagelayer-id="+id+"]");
	
	if(toClick){
		//console.log('here');
		jEle.click();
	}
	
	return id;
	
};

// Add an element into the POST
function pagelayer_element_added(jEle){
	
	var sc = jEle.attr('pagelayer-tag');
	var id, par_id;
	var gId = jEle.attr('pagelayer-global-id');
	gId = gId && !pagelayer_empty(pagelayer_global_widgets[gId]) ? gId : 0;
	
	// Set Pagelayer History FALSE to prevent saving attributes in action history
	pagelayer.history_action = false;
	pagelayer.global_render = false;
	
	// Is this a global widget ?
	if(!pagelayer_empty(gId)){
	
		html = pagelayer_element_unsetup(pagelayer_global_widgets[gId].$);
	
	// Generate the HTML
	}else{
		html = pagelayer_create_sc(sc);
	}
	
	id = pagelayer_assign_id(html);
	par_id = id;
	
	// Insert the HTML
	jEle[0].outerHTML = html[0].outerHTML;
	
	// Setup the properties of the elements
	pagelayer_element_setup("[pagelayer-id="+par_id+"], [pagelayer-id="+par_id+"] .pagelayer-ele", true);
	
	// Is this a global widget ? Then set this as global element
	if(!pagelayer_empty(gId)){
		html = pagelayer_set_ele_global(jQuery('[pagelayer-id="'+par_id+'"]'), gId);
	}
	
	// Any children to add ?
	if(!('widget' in pagelayer_shortcodes[sc])){
	
		// The element props
		var props = pagelayer_shortcodes[sc];
		
		// Do we have to create children ?
		if('has_group' in props){
			
			// Is this not a global widget ?
			if(pagelayer_empty(gId)){
				var has_group = props['has_group'];
				var gProp = props[has_group['section']][has_group['prop']];
				
				for(var i=0; i < gProp['count']; i++){
					var cid = pagelayer_element_add_child(jQuery("[pagelayer-id="+id+"]"), gProp['sc'], gProp);
					//pagelayer_element_setup('[pagelayer-id='+cid+']', true);
					
					var cEle = pagelayer_ele_by_id(cid);
					
					// Set default
					if( 'item_atts' in gProp && i in gProp['item_atts'] && !pagelayer_empty(gProp['item_atts'][i]) ){
						pagelayer_set_atts(cEle, gProp['item_atts'][i]);
						pagelayer_sc_render(cEle);
					}
				}
			}else{
				pagelayer_sc_render(jQuery('[pagelayer-id="'+par_id+'"]'));
			}
		}
	
	}
	
	// Save in action history 
	var cEle = pagelayer_near_by_ele(id, sc);

	pagelayer_history_action_push({
		'title' : pagelayer_shortcodes[sc]['name'],
		'action' : 'Added',
		'pl_id' : id,
		'html' : jQuery("[pagelayer-id="+id+"]")[0].outerHTML,
		'cEle' : cEle
	});
	
	// Set pagelayer history TRUE
	pagelayer.history_action = true;
	pagelayer.global_render = true;
	
	// To update nav item list
	pagelayer_do_dirty(pagelayer_ele_by_id(id));
	
	return id;
	
};

// Add an element
function pagelayer_element_add_child(pEle, sc, gProp){
	
	gProp = gProp || {};
	var child = pagelayer_create_sc(sc);
	var cid = pagelayer_assign_id(child);
	pagelayer_set_parent(child, pagelayer_assign_id(pEle));
	
	// Does the parent have a holder ?
	var tag = pagelayer_tag(pEle);
	
	// There is a holder
	if('holder' in pagelayer_shortcodes[tag]){
		
		pEle.find(pagelayer_shortcodes[tag]['holder']).append(child);
		
	// No holder, just append
	}else{
		pEle.append(child);
	}
	
	pagelayer_element_setup('[pagelayer-id='+cid+']', true);
	
	// Certain element have editable areas which are inner rows. For UX we need to add columns for the users
	if(sc == 'pl_inner_row'){
		
		var rHolder = pagelayer_ele_by_id(cid).find('.pagelayer-row-holder');
		
		if( !pagelayer_empty(gProp) && 'inner_content' in gProp){
			
			var inner_content = gProp['inner_content'];
			
			// Add default element
			if(!pagelayer_empty(inner_content)){
				
				var add_sc = function(hEle, _tag, content){
					
					var dEle = jQuery('<div pagelayer-tag="'+_tag+'"></div>');
					
					if(_tag == 'pl_col'){
						hEle = hEle.closest('.pagelayer-row-holder');
					}else{
						hEle = hEle.find('.pagelayer-col-holder');
					}
					
					hEle.append(dEle);
					var curID = pagelayer_onadd(dEle, false);
					var curEle = pagelayer_ele_by_id(curID);
					
					// Set default
					if('atts' in content[_tag]){
						pagelayer_set_atts(curEle, content[_tag]['atts']);
						pagelayer_sc_render(curEle);
					}
					
					// Set inner content
					if('inner_content' in content[_tag]){
						for( var key in content[_tag]['inner_content'] ){
							for( var _key in content[_tag]['inner_content'][key] ){
								add_sc(curEle, _key, content[_tag]['inner_content'][key]);
							}
						}
					}
					
					if(_tag == 'pl_col'){
						// TODO: unable to set col width
						pagelayer_renumber_col(hEle);
					}else{
						pagelayer_empty_col(hEle);
					}
				};
				
				for( var key in inner_content ){
					for( var tag in inner_content[key] ){
						add_sc(rHolder, tag, inner_content[key]);
					}
				}
			}
			
			pagelayer_empty_col(jQuery('[pagelayer-id="'+cid+'"]').find('.pagelayer-col-holder'));
			
		}else{
			var col = jQuery('<div pagelayer-tag="pl_col"></div>');
			rHolder.append(col);
			pagelayer_onadd(col, false);		
		}
	}
	
	// Do we have to create children ?
	if('has_group' in pagelayer_shortcodes[sc]){
				
		var has_group = pagelayer_shortcodes[sc]['has_group'];		
		var gProp = pagelayer_shortcodes[sc][has_group['section']][has_group['prop']];
		
		for(var i=0; i < gProp['count']; i++){
			var in_cid = pagelayer_element_add_child(jQuery("[pagelayer-id="+cid+"]"), gProp['sc'], gProp);
		}
		
	}
	
	return cid;
};

// Return an element by ID
function pagelayer_ele_by_id(id){
	return jQuery('[pagelayer-id='+id+']');
};

// Return the wrap by ID
function pagelayer_wrap_by_id(id){
	return jQuery('[pagelayer-wrap-id='+id+']');
};

// Give the Pagelayer ID
function pagelayer_id(jEle){
	
	var id = jEle.attr('pagelayer-wrap-id');
	if(id){
		return id;
	}
	
	id = jEle.attr('pagelayer-id');
	
	return id;
	
}

// Remove Pagelayer ID class
function pagelayer_remove_id_class(jEle){
	var id = jEle.attr('pagelayer-id');
	jEle.removeClass('p-'+id);
}

// Assign the jQuery object an ID
function pagelayer_assign_id(jEle){
	
	// Do you have the pagelayer id
	var id = jEle.attr("pagelayer-id");
	if(!id || id.length < 1){
		id = pagelayer_randstr(3)+pagelayer_randInt(9999).toString();
		id = id.toLowerCase();
		jEle.attr("pagelayer-id", id);
	}
	
	return id;
	
}

// Show the edit options
function pagelayer_element_clicked(selector, e){
	
	var jEle = jQuery(selector);
	e = e || false;
	//console.log(e);	
	
	// You must be a element atleast
	if(!jEle.hasClass('pagelayer-ele')){
		return false;
	}
	
	// Get the parent
	var pId = pagelayer_get_parent(jEle);
	
	// If we found a parent
	if(pId){
		jEle = pagelayer_ele_by_id(pId);	
	}
	
	// Make the editable fields active	
	//pagelayer_clear_editable();// First clear
	jEle.find('[pagelayer-editable]').each(function (){
		pagelayer_make_editable(jQuery(this), e);
	});

	// Show left bar
	if(pagelayer_empty(e)){
		pagelayer.$$('.pagelayer-leftbar-table').removeClass('pagelayer-leftbar-hidden pagelayer-leftbar-minimize');
	}
	
	// Lets not rebuild everything to make it faster
	if(pagelayer_is_active(jEle)){
		return false;
	}
	
	pagelayer_trigger_action('pagelayer_element_clicked', [jEle]);
	
	// Set this as the active element
	pagelayer_set_active(jEle);
	
	// Show the properties
	pagelayer_elpd_open(jEle);
	
}

// Use text widget for search widget
function pagelayer_search_widgets(hEle){
	
	hEle = hEle || jQuery(pagelayer_editable +' [pagelayer-tag="pl_text"], '+pagelayer_editable +' [pagelayer-tag="pl_heading"]');
	
	hEle.each(function(){
		
		var jEle = jQuery(this);
		var tEle = jEle.find('[pagelayer-editable="text"]');
		
		var addPlaceholder = function(ele){
			
			var tVal = ele.text();
			
			if(pagelayer_empty(tVal)){
				ele.attr('data-placeholder-text', 'Type / to open widget list');
			}else if(ele.attr('data-placeholder-text')){
				ele.removeAttr('data-placeholder-text');
			}
		}
		
		// Add placeholder text
		addPlaceholder(tEle);
		
		tEle.off('input.search_widgets');
		tEle.on('input.search_widgets', function(){
			
			var val = tEle.text();
			
			// Add placeholder text
			addPlaceholder(tEle);
			
			if(val.charAt(0) == "/"){
				val = val.replace('/', '');
				pagelayer_show_widget_list(tEle, val);
			}else if(pagelayer.$$('.pagelayer-widget-tooltip').is(':visible')){
				// Hide Widget list
				pagelayer.gDocument.trigger('mousedown.pagelayer_wdlist');
			}
			
		});
	
	});
	
}

// The edit option
function pagelayer_edit_element(selector){
	pagelayer_element_clicked(selector);
}

// Dump the data from the el to the elements
function pagelayer_element_dump_data(){
	for(var x in pagelayer.el){
		var jEle = pagelayer_ele_by_id(x);
		if(jEle.length > 0){
			pagelayer_el_dump_data(jEle);
		}
	}
}

// Setup the properties on a single click
function pagelayer_element_setup(selector, render){
	
	var selector = selector || ".pagelayer-ele";
	render = render || false;
	
	// Loop through
	jQuery(pagelayer_editable+' '+selector).each(function(){
		
		var jEle = jQuery(this);
		
		// Assign an ID if not there
		var id = pagelayer_assign_id(jEle);
		var pId = pagelayer_get_parent(jEle) || '';// Options to show on hover
		var selector = '[pagelayer-id='+id+']';
		
		// Get data part
		pagelayer.el[id] = pagelayer_el_get_data(jEle);
		//console.log(jEle[0].outerHTML);
		//console.log(pagelayer.el[id]);
			
		if(render){
			pagelayer_sc_render(jEle);
		}
		
		// Get the tag
		var tag = pagelayer_tag(jEle);
		var props = pagelayer_get_props(jEle);
		
		// Lets check if we are the child of a parent i.e. element of a group
		if(pagelayer_empty(pId)){
		
			// Get the parent
			var pEle = jEle.parent().closest('.pagelayer-ele');
			
			// If we found a parent
			if(pEle.length > 0){

				var pTag = pagelayer_tag(pEle);
				
				// Is the parent a group of this child ?
				if(!pagelayer_empty(pagelayer_shortcodes[pTag]) && pagelayer_is_group(pTag)){
					
					var has_group = pagelayer_shortcodes[pTag]['has_group'];		
					var child_type = pagelayer_shortcodes[pTag][has_group['section']][has_group['prop']]['sc'];
					
					// If the type is the same as jEle
					if(child_type == pagelayer_tag(jEle)){
						pId = pagelayer_assign_id(pEle);
						pagelayer_set_parent(jEle, pId);
					}
				}
			
			}
		
		}
		
		// If is group of widget?
		if('widget_group' in props && !pagelayer_empty(props['widget_group'])){
			pagelayer_set_widget_group(jEle);
		}
		
		// Make the wraps
		jEle.wrap('<div class="pagelayer-ele-wrap" pagelayer-wrap-id="'+id+'"></div>');
		var wrap = jEle.parent();
		
		// For column we have to do some kidas !
		if(tag == 'pl_col'){
			
			var col;
			for(var x=1; x<=12; x++){
				if(jEle.hasClass('pagelayer-col-'+x)){
					col = 'pagelayer-col-'+x;
					break;
				}
			}
	  
			
			wrap.addClass('pagelayer-col '+col);
			//jEle.removeClass('pagelayer-col '+col);
			wrap.addClass('pagelayer-wrap-col');
			
		}else if(tag == 'pl_row'){
			wrap.addClass('pagelayer-wrap-row');
		}else if(tag == 'pl_inner_row'){
			wrap.addClass('pagelayer-wrap-inner-row');
		}else{
			wrap.addClass('pagelayer-wrap-ele');
		}
		
		// Create the overlay
		wrap.prepend('<div class="pagelayer-ele-overlay"></div>');
			
		var overlay = wrap.children('.pagelayer-ele-overlay');
		var html;
		
		if(tag == 'pl_row' || tag == 'pl_inner_row'){
			
			overlay.addClass('pagelayer-row-hover');
			
			if(jEle.hasClass('pagelayer-row-stretch-full')){
				pagelayer_sc_render(jEle);
			}
			
			html = '<div class="pagelayer-row-option" pagelayer-option-edit pagelayer-option-id="'+id+'">'+
				'<i class="fas fa-caret-up pagelayer-eoi pagelayer-move-up" onclick="pagelayer_move_element_up(\''+selector+'\')" ></i>'+
				'<i class="far fa-clone pagelayer-eoi" onclick="pagelayer_copy_element(\''+selector+'\')" ></i>'+
				'<i class="fas fa-trash pagelayer-eoi" onclick="pagelayer_delete_element(\''+selector+'\')" ></i>'+
				'<i class="fas fa-pencil-alt pagelayer-eoi" onclick="pagelayer_edit_element(\''+selector+'\', event)" ></i>'+
				'<i class="fas fa-caret-down pagelayer-eoi pagelayer-move-down" onclick="pagelayer_move_element_down(\''+selector+'\')" ></i>'+
			'</div>';
		
		}else if(tag == 'pl_col'){
			
			overlay.addClass('pagelayer-col-hover');
			
			html = '<div class="pagelayer-col-option" pagelayer-option-edit pagelayer-option-id="'+id+'">'+
				'<i class="fas fa-columns pagelayer-eoi" onclick="pagelayer_edit_element(\''+selector+'\', event)" ></i>'+
			'</div>';
			
			// Is it an empty col ?
			pagelayer_empty_col(jEle.children('.pagelayer-col-holder'));
			
			// Make col resizable
			pagelayer_col_make_resizable(wrap);
		
		}else{
		
			html = '<div class="pagelayer-ele-option" pagelayer-option-edit pagelayer-option-id="'+id+'">'+
				'<i class="fas fa-caret-up pagelayer-eoi pagelayer-move-up" onclick="pagelayer_move_element_up(\''+selector+'\')" ></i>'+
				'<i class="far fa-clone pagelayer-eoi" onclick="pagelayer_copy_element(\''+selector+'\')" ></i>'+
				'<i class="fas fa-trash pagelayer-eoi" onclick="pagelayer_delete_element(\''+selector+'\')" ></i>'+
				'<i class="fas fa-pencil-alt pagelayer-eoi" onclick="pagelayer_edit_element(\''+selector+'\', event)" ></i>'+
				'<i class="fas fa-caret-down pagelayer-eoi pagelayer-move-down" onclick="pagelayer_move_element_down(\''+selector+'\')" ></i>'+
			'</div>';
		
		}
		
		// Append to the child
		overlay.append(html);
		
		// Add shortcode icon
		if(tag != 'pl_row' && tag != 'pl_col'){
			overlay.append('<span class="pagelayer-shortcode-plus" onclick="event.stopPropagation();pagelayer_show_widget_list(this);"><i class="fas fa-plus"></i></span>');
		}
		
		jQuery('[pagelayer-option-id='+id+']').hide();
		
		// Hide active when not supported by tag
		if(!pagelayer_empty(props['hide_active'])){
			wrap.addClass('pagelayer-hide-active');
		}
		
		// Setup the HOVER events ABD create WRAPS IF we dont have a parent
		if(pId.length > 0){
			return;
		}
		
		// Make the wrap draggable, but only of independent or parent elements
		wrap.attr('draggable', 'true');
		
		wrap.hover(function(){
			
			// Is there an element option shower ?
			var opts = jQuery('[pagelayer-option-id='+id+']');
			
			// Give the overlay the hover class
			opts.parent().addClass('pagelayer-ele-hover');
			
			// Show them
			opts.show();
			
		}, function(){
			
			// Is there an element option shower ?
			var opts = jQuery('[pagelayer-option-id='+id+']');
			
			// Remove hover class
			opts.parent().removeClass('pagelayer-ele-hover');
			
			// Hide opts
			opts.hide();
			
		});
		
	});
}

// Unsetup element for restup
function pagelayer_element_unsetup(selector, id){
	
	id = id || false;
	
	var src = jQuery(selector);
	var html = src[0].outerHTML;
	
	var jEle = jQuery(html);
	pagelayer_remove_id_class(jEle);
	jEle.removeAttr('pagelayer-id');
	jEle.removeAttr('pagelayer-active');
	jEle.find('[pagelayer-id]').each(function(){
		pagelayer_remove_id_class(jQuery(this));
		jQuery(this).removeAttr('pagelayer-id');
	});
	jEle.find('[pagelayer-parent]').removeAttr('pagelayer-parent');// Remove the parent attribute as it will be reset during pagelayer_element_setup
	jEle.find('style').remove();
	jEle.find('.pagelayer-ele-overlay').remove();
	
	// Unwrap the wraps
	jEle.find('.pagelayer-ele').each(function (){
		var ele = jQuery(this);
		if(ele.parent().is('.pagelayer-ele-wrap')){
			ele.unwrap();
		}
	});
	
	// Assign id
	if(!pagelayer_empty(id)){
		jEle.attr('pagelayer-id', id);
	}
	
	return jEle;
}

// Left Click
function pagelayer_left_click(){
	
	jQuery(pagelayer_editable).on('click', function(e){
		
		e.preventDefault();// Added by Jivan in Actions / Revisions version
		
		// Hide the context menu
		jQuery('.pagelayer-right-click-options').hide();
		
		// Target
		var tEle = jQuery(e.target);
		
		// If its an edit option click
		if(tEle.hasClass('pagelayer-eoi')){
			return false;
		}
		
		pagelayer_element_clicked(tEle.closest('.pagelayer-ele'), e);
		
		return false;
		
	});
};

// Right Click Menu
function pagelayer_right_click(){
	
	var html = '<div class="pagelayer-right-click-options" style="display:none;">'+
		'<ul>'+
			'<li><a class="pagelayer-right-edit">Edit</a></li>'+
			'<li><a class="pagelayer-right-duplicate"><i class="far fa-clone" ></i> '+pagelayer_l('Duplicate')+'</a></li>'+
			'<li><a class="pagelayer-right-copy"><i class="far fa-copy" ></i> '+pagelayer_l('Copy')+'</a></li>'+
			'<li><a class="pagelayer-right-paste"><i class="far fa-clipboard" ></i> '+pagelayer_l('Paste')+'</a></li>'+
			'<li><a class="pagelayer-right-delete"><i class="far fa-trash-alt" ></i> '+pagelayer_l('Delete')+'</a></li>'+
			'<li><a class="pagelayer-right-save-global-widget" pro="1"><i class="far fa-save" ></i> '+pagelayer_l('save_global')+'</a></li>'+
			'<li><a class="pagelayer-right-save-section" pro="1"><i class="far fa-heart" ></i> '+pagelayer_l('save_as_section')+'</a></li>'+
			'<li><a class="pagelayer-right-save-global-section" pro="1"><i class="fas fa-globe" ></i> '+pagelayer_l('save_as_global_section')+'</a></li>'+
		'</ul>'+
	'</div>';
	
	jQuery('body').append(html);
	
	var $contextMenu = jQuery('.pagelayer-right-click-options');
	
	jQuery(pagelayer_editable).on('contextmenu', function(e){
		
		var tEle = jQuery(e.target);
		var jEle = tEle.closest('.pagelayer-ele-wrap').children('.pagelayer-ele');
		
		// Get the parent
		var pId = pagelayer_get_parent(jEle);
		
		// If we found a parent
		if(pId){
			jEle = pagelayer_ele_by_id(pId);
		}
		
		// The basics
		var id = pagelayer_assign_id(jEle);		
		var tag = pagelayer_tag(jEle);
		
		$contextMenu.find('.pagelayer-right-edit').attr('onclick', 'pagelayer_edit_element("[pagelayer-id='+id+']")').html('<i class="far fa-edit" ></i> Edit '+pagelayer_shortcodes[tag]['name']);
		$contextMenu.find('.pagelayer-right-duplicate').attr('onclick', 'pagelayer_copy_element("[pagelayer-id='+id+']")');
		$contextMenu.find('.pagelayer-right-copy').attr('onclick', 'pagelayer_copy_select("[pagelayer-id='+id+']")');
		$contextMenu.find('.pagelayer-right-paste').attr('onclick', 'pagelayer_paste_element("[pagelayer-id='+id+']")');
		$contextMenu.find('.pagelayer-right-delete').attr('onclick', 'pagelayer_delete_element("[pagelayer-id='+id+']")');
		
		// If is pagelayer pro
		if(!pagelayer_empty(pagelayer_pro)){
			$contextMenu.find('.pagelayer-right-save-global-widget').attr('onclick', 'pagelayer_save_sections("[pagelayer-id='+id+']", "global_widget")');
			$contextMenu.find('.pagelayer-right-save-section').attr('onclick', 'pagelayer_save_sections("[pagelayer-id='+id+']", "section")');
			$contextMenu.find('.pagelayer-right-save-global-section').attr('onclick', 'pagelayer_save_sections("[pagelayer-id='+id+']", "global_section")');
		}else{
			var pro = $contextMenu.find('[pro="1"]');
			
			if(pro.find('.pagelayer-pro-req').length < 1){
				pro.append('<span class="pagelayer-pro-req">Pro</span>');
			}
			
			pro.css({'color': '#a7a7a7'});
			
			// To stopPropagation
			pro.parent().on('click', function(e){
				e.stopPropagation();
			});
		}
		
		// If copy_selected is empty then copy data from localStorage
		if(pagelayer_empty(pagelayer.copy_selected)){
			pagelayer_copy_from_localStorage();
		}
		
		// Are we to hide the paste ?
		if(!pagelayer_empty(pagelayer.copy_selected) && pagelayer_can_copy_to(jEle)){
			//console.log(pagelayer_can_copy_to(jEle));
			$contextMenu.find('.pagelayer-right-paste').parent().show();
		}else{
			$contextMenu.find('.pagelayer-right-paste').parent().hide();
		}
		
		var gId = pagelayer_get_global_id(jEle);
		
		// Are we to hide the global widget ?
		if(!pagelayer_empty(gId) || tag == 'pl_row' || tag == 'pl_inner_row'|| tag == 'pl_col'){
			$contextMenu.find('.pagelayer-right-save-global-widget').parent().hide();
		}else{
			$contextMenu.find('.pagelayer-right-save-global-widget').parent().show();
		}
		
		var sId = pagelayer_get_att(jEle, 'global-section-id');
		
		// Are we to hide the save as global section ?
		if( tag == 'pl_row' &&  pagelayer_empty(sId)){
			$contextMenu.find('.pagelayer-right-save-global-section').parent().show();
		}else{
			$contextMenu.find('.pagelayer-right-save-global-section').parent().hide();
		}
		
		// Are we to hide the save as section ?
		if( tag == 'pl_row' ){
			$contextMenu.find('.pagelayer-right-save-section').parent().show();
		}else{
			$contextMenu.find('.pagelayer-right-save-section').parent().hide();
		}
			
		var hPosition = (e.pageX+$contextMenu.width()>jQuery(window).width()) ? (e.pageX-$contextMenu.width()) : e.pageX;
		var vPosition = (e.pageY+$contextMenu.height()>jQuery(document).scrollTop()+jQuery(window).height()) ? (e.pageY-$contextMenu.height()) : e.pageY;
		
		$contextMenu.css({
			display: "block",
			left: hPosition,
			top: vPosition
		});
		
		return false;
		 
	});
	
	jQuery('html').on('click', function(e){
		$contextMenu.hide();
	});
}

// Set the parent for the group
function pagelayer_set_parent(jEle, id){
	jEle.attr('pagelayer-parent', id);
};

// Set the widget group
function pagelayer_set_widget_group(jEle){
	jEle.addClass('pagelayer-ele-widget-group');
};

// Get the parent for the group
function pagelayer_get_parent(jEle){
	return jEle.attr('pagelayer-parent');
};

// Sets the screen mode
function pagelayer_set_screen_mode(mode){
	var modes = ['desktop', 'tablet', 'mobile'];
	var body = pagelayer.$$('.pagelayer-iframe-holder iframe');
	var current = '';
	
	for(var x in modes){
		
		if(body.hasClass('pagelayer-screen-'+modes[x]) && modes[x] != mode){
			current = modes[x];
			body.removeClass('pagelayer-screen-'+modes[x]);
		}
	}
	
	// Add the class
	body.addClass('pagelayer-screen-'+mode);
	
	// Add the class to the button
	pagelayer.$$('.pagelayer-mode-button').removeClass('pli-'+current).addClass('pli-'+mode);
	
	// Add the class to the button
	pagelayer.$$('.pagelayer-prop-screen').removeClass('pli-'+current).addClass('pli-'+mode);
	
	// Trigger screen change if any
	pagelayer.$$('.pagelayer-elp-screen').trigger('pagelayer-screen-changed');
	
};

// Get the current screen mode
function pagelayer_get_screen_mode(){
	var modes = ['desktop', 'tablet', 'mobile'];
	var body = pagelayer.$$('.pagelayer-iframe-holder iframe');
	
	for(var x in modes){
		if(body.hasClass('pagelayer-screen-'+modes[x])){
			return modes[x];
		}
	}
}

var pagelayer_keydown_data = {};
pagelayer_add_action('pagelayer_do_dirty', function(){
	pagelayer_keydown_data = {};
});

var pagelayer_active_ele_timmer = {};
// Handle widget selecttion and move cursor in editable areas on key press events
jQuery(document).keydown(function(e){
	//alert(String.fromCharCode(e.which));
	
	var tEle = jQuery(e.target);
	var editable = tEle.closest('[contenteditable="true"]');
	var tooltip = pagelayer.$$('.pagelayer-widget-tooltip');
	
	// If ArrowDown and ArrowUp key not pressed
	if(!(e.key == 'ArrowDown' || e.key == 'ArrowUp') || tooltip.is(':visible')){
		pagelayer_keydown_data = {};
		return;
	}
	
	var findEles = jQuery(pagelayer_editable+' .pagelayer-ele,'+pagelayer_editable+' [contenteditable="true"]');
	var activeEle = findEles.first();
	
	if(editable.length > 0){
		activeEle = editable;
	}else if( '$' in pagelayer_keydown_data ){
		activeEle = pagelayer_keydown_data.$;
	}else if( pagelayer_active.el && 'id' in pagelayer_active.el ){
		activeEle = pagelayer_active.el.$;
	}
	
	if(pagelayer_empty(activeEle) || activeEle.length < 1){
		return;
	}
	
	// Make element active
	var makeEleActive = function(index, next){
		
		next = next || false;
		var cursorPos = 0, focusEle;
		
		// We are editable area
		if(editable.length > 0){
			
			var lines = pagelayer_content_line(editable.get(0));
			var cursorPos = pagelayer_getCaretCharacterOffsetWithin(editable.get(0));

			if((next && lines[lines.length - 1].start > cursorPos) || (!next && lines[0].end < cursorPos)){
				return;
			}
			
			e.preventDefault();
						
			var lastLineStart = lines[lines.length - 1]['start'];
			
			// We are on the last line
			if(next && lastLineStart <= cursorPos){
				cursorPos = cursorPos - lastLineStart;
			}
			
		}
		
		// Search for next/previous element
		var searchEle = function(indexEle){
			
			indexEle = next ? ++indexEle : --indexEle;
			var sIndex = findEles.eq(indexEle);
			
			if(sIndex.length < 1){
				return sIndex;
			}
		
			var sEle = sIndex.closest('.pagelayer-ele');
			var tag = pagelayer_tag(sEle);
			
			if(tag == 'pl_row' || tag == 'pl_inner_row' || tag == 'pl_col' || sEle.parent().hasClass('pagelayer-hide-active') || !pagelayer_empty(sIndex.attr('pagelayer-parent'))){
				sIndex = searchEle(indexEle);
			}
			
			return sIndex;
		}
		
		var ele = searchEle(index);
		
		// If ArrowUp and we are come from editable area and previous element is not editable
		if(ele.length > 0 && !next && ele.attr('contenteditable') != 'true'){
			ele = searchEle(findEles.index( ele ));
		}
		
		if(ele.length < 1){
			return;
		}
		
		// Save in global variable
		pagelayer_keydown_data.$ = ele;
		jQuery(':focus').blur();
		
		var jEle = ele.closest('.pagelayer-ele');
		var tag = pagelayer_tag(jEle);
		
		if(ele.attr('contenteditable') == 'true'){
			focusEle = ele;
		}else if(tag != 'pl_row' && tag != 'pl_inner_row' && tag != 'pl_col'){
			
			var focusAble = ele.find('[contenteditable="true"]');
			var isfocusAble = focusAble.closest('.pagelayer-ele').is(jEle);
		
			if(isfocusAble && next){
				focusEle = focusAble.first();
			}else if(isfocusAble){
				focusEle = focusAble.last();
			}
		}
		
		if(!pagelayer_empty(focusEle) && focusEle.length > 0){
			focusEle.focus();
			
			var focusLine = pagelayer_content_line(focusEle.get(0));
			var fLine = next ? focusLine[0] : focusLine[focusLine.length -1];
			
			cursorPos = (fLine['start'] + cursorPos > fLine['end'] ? fLine['end'] : fLine['start'] + cursorPos);
			
			pagelayer_setCaret(focusEle.get(0), cursorPos);
		}
		
		pagelayer_set_active(jEle);
		ele[0].scrollIntoView({behavior: "smooth", block: "nearest"});
		
		clearTimeout(pagelayer_active_ele_timmer);
		pagelayer_active_ele_timmer = setTimeout(function(){
			pagelayer_keydown_data = {};
			ele.closest('.pagelayer-ele').click();
		}, 1000);
	}
	
	// If cursor on first line & up arrow key
	var currentIndex = findEles.index( activeEle );
	pagelayer_keydown_data.$ = activeEle;
	
	// Move active element and cursor arround editor
	if(e.key == 'ArrowDown'){
		makeEleActive(currentIndex, true);
	}
	
	if(e.key == 'ArrowUp'){		
		makeEleActive(currentIndex, false);
	}
});

// Handle key press events
pagelayer.gDocument.keydown(function(event){
	//alert(String.fromCharCode(event.which));
	
	var tEle = jQuery(event.target);
	var editable = tEle.closest('[contenteditable="true"]');
	var tooltip = pagelayer.$$('.pagelayer-widget-tooltip');

	// Enter handle
	if(event.keyCode == 13){
				
		var jEle = tEle.closest('.pagelayer-ele');
		var tag = pagelayer_tag(jEle);
		
		// Add selected widget from widget list
		if(tooltip.is(':visible')){
			tooltip.find('.pagelayer-list-widget-active:visible').click();
			return;
		}
		
		if( pagelayer_empty(pagelayer_active.el) || !('id' in pagelayer_active.el) ){
			return;
		}
		
		var active_el_par = pagelayer_active.el.$.parent();
		
		// Create and add text widget
		var addTitle = function(insertAfter){
			var ele = jQuery('<div pagelayer-tag="pl_text"></div>');
			insertAfter.after(ele);
			return pagelayer_ele_by_id( pagelayer_onadd(ele) );
		}
		
		// If we have an active element then add text widget
		if(!(tEle.is('input, textarea') || editable.length > 0)){
			
			event.preventDefault();
			
			var activeTag = pagelayer_active.el.tag;
			
			// If is row or column ?
			if(activeTag == 'pl_row' || activeTag == 'pl_col'){
				return;
			}
			
			var hEle = addTitle(active_el_par);
			hEle.click();
			hEle.find('[pagelayer-editable]').focus();
			
			// Ensure the column is not empty
			pagelayer_empty_col(hEle.closest('.pagelayer-col-holder'));
			return;
		}
    
		if( (tag != 'pl_text' && tag != 'pl_heading') || editable.length < 1 || event.shiftKey){
			return;
		}
		
		var selection = window.getSelection();
		var range = selection.getRangeAt(0);
			
		// We are within the list tag
		if(jQuery(range.startContainer).closest('[pagelayer-editable] li').length > 0){
			return;
		}
		
		event.preventDefault();
    			
		var lastChild = editable[0].lastChild;
		var startContainer = range.startContainer;
			
		if(startContainer.nodeType == Node.TEXT_NODE && startContainer.parentNode != editable[0]){
			startContainer = startContainer.parentNode;
		}
			
		range.setEndAfter(lastChild);
			
		var val = range.cloneContents();
		var selfEle = jQuery('<div>').append(val);
		var selContent = selfEle.html();
		var selfFC = selfEle[0].firstChild;
		var emptyContent = false;
		
		if(selfFC == null || pagelayer_empty(selContent)){
			selContent = '<p><br></p>';
			emptyContent = true;
		}else if(selfFC.nodeType == Node.TEXT_NODE){			
			selContent = '<p>'+selContent+'</p>';
		}else if(selfEle.text() == '' && selfEle.find('br').length < 1){
			selContent = '<p><br></p>';
			emptyContent = true;
		}else if(selfEle.text().trim() == ''){
			selContent = selContent.replace(/\s+/, "\u00A0");
			emptyContent = true;
		}

		range.deleteContents();
    
		if( jQuery(startContainer).is(':first-child') && jQuery(startContainer).is(':empty') ){
			jQuery(startContainer).html('<br>');
		}else if( jQuery(startContainer).is(':empty') ){
			jQuery(startContainer).remove();
		}
		
		// If editor is empty
		if( editable.is(':empty') ){
			editable.html('<p><br></p>');
		}
		
		editable.trigger('input');
		editable.blur();
		
		// Create and add text widget
		var ele;
		if(emptyContent){
			ele = addTitle(jEle.parent());
		}else{		
			var id = pagelayer_copy_element(jEle);
			ele = pagelayer_ele_by_id(id);
		}
		
		ele.click();
		var editorArea = ele.find('[pagelayer-editable]');
		editorArea.html(selContent);
		editorArea.find('p:empty').remove();
		editorArea.focus().trigger('input');
	}
	
	// ctrl+s handle
	if(event.keyCode == 83 && event.ctrlKey){
		event.preventDefault();
		pagelayer.$$('.pagelayer-bottombar-holder').find('.pagelayer-update-button').click();
	}
	
	// ctrl+d handle
	if(event.keyCode == 68 && event.ctrlKey){
		
		// If we have an active element
		if( pagelayer_active.el && pagelayer_active.el.id ){
			event.preventDefault();
			pagelayer_copy_element('[pagelayer-id='+pagelayer_active.el.id+']');
		}
		
	}
	
	// Delete handler for text widget
	if(event.keyCode == 46 && editable.length > 0){
		var jEle = tEle.closest('.pagelayer-ele-wrap');
		var tag = pagelayer_tag(jEle);
		var next = jEle.next();
		var pTag = pagelayer_tag(next);
		
		var selection = window.getSelection();		
		var orgRange = selection.getRangeAt(0);
		var cloneRange = orgRange.cloneRange();
		
		if((tag != 'pl_text' && tag != 'pl_heading') || next.length < 1 || pTag != tag || !cloneRange.collapsed ){
			return;
		}
		
		var currentOffset = pagelayer_getCaretCharacterOffsetWithin(editable[0]);
		cloneRange.selectNodeContents(editable[0]);
		var caretOffset = cloneRange.toString().length;
		
		if(currentOffset != caretOffset){
			return;
		}
		
		var nextHtml = next.find('[pagelayer-editable="text"]').html();
		editable.append(nextHtml);
		pagelayer_delete_element(next.children('.pagelayer-ele'));
	}
	
	// Backspace handler
	if(event.keyCode == 8 && editable.length > 0){
		var jEle = tEle.closest('.pagelayer-ele-wrap');
		var tag = pagelayer_tag(jEle);
		var prev = jEle.prev();

		if((tag != 'pl_text' && tag != 'pl_heading') || prev.length < 1){
			return;
		}
				
		var pTag = pagelayer_tag(prev);
		var selection = window.getSelection();
		
		if (selection == null || selection.rangeCount <= 0) return null;
		
		var range1 = selection.getRangeAt(0);
		
		if(pTag != tag || range1.startOffset != 0){
			return;
		}
		
		var prevArea = prev.find('[pagelayer-editable="text"]');
		
		if( pagelayer_getCaretCharacterOffsetWithin(editable[0]) != 0 || prevArea.length < 1){
			return;
		}
		
		//event.preventDefault();
		var html = editable.html();
		editable.blur();
		prev.children('.pagelayer-ele').click();
		prevArea.click();
		
		var newSel = window.getSelection();
		var newRange = newSel.getRangeAt(0);
		var lastChild = jQuery(prevArea[0].lastChild);
		
		prevArea.append(html);
		prevArea.trigger('input');
		
		if(lastChild.length > 0){
			if(lastChild[0].nextSibling != null){
				newRange.setStart(lastChild[0].nextSibling, 0);
			}else{
				newRange.setStartAfter(lastChild[0]);
			}
		}
		
		newRange.collapse(true);
		newSel.removeAllRanges();
		newSel.addRange(newRange);
			
		pagelayer_delete_element(jEle.children('.pagelayer-ele'));
		
	}
  	
	if(tooltip.is(':visible')){
		
		// Select previous widget in widget tooltip
		if(event.key == 'ArrowUp' || event.key == 'ArrowLeft' || (event.key == 'Tab' && event.shiftKey)){
			
			event.preventDefault();
			
			var current = tooltip.find('.pagelayer-list-widget-active:visible'),
			prev = current.prevAll('.pagelayer-shortcode-holder:visible');
				
			if(event.key == 'ArrowUp'){
				var _prev = prev,
				cOffset = current.offset();
				findNext = false;
				
				var searchNext = function(nEle){
					
					var nOffset = nEle.offset();
					var nBottom = nOffset.top + nEle.height();
					
					if(nBottom > cOffset.top){
						return true;
					}
					
					prev = nEle;
					findNext = true;
					
					// Current element left set +20 to manager previous scale (css) element on hover
					if(cOffset.left + 20 >= nOffset.left){
						return false;
					}
					
					return true;
				}
				
				_prev.each(function(){
					return searchNext(jQuery(this));
				});
				
				if(!findNext){
					var gNext = current.parent().prevAll('.pagelayer-widget-group:visible').first();
					_prev = gNext.children('.pagelayer-shortcode-holder:visible');
					
					jQuery(_prev.get().reverse()).each(function(){
						return searchNext(jQuery(this));						
					});
				}
				
			}
			
			if(prev.length < 1){
				prev = current.parent().prevAll('.pagelayer-widget-group:visible').first().find('.pagelayer-shortcode-holder:visible').last();
			}
			
			if(prev.length < 1){
				return;
			}
			
			prev.first().trigger('widget_active');
		}
		
		// Select next widget in widget tooltip 
		if(event.key == 'ArrowDown' || event.key == 'ArrowRight' || (event.key == 'Tab' && !event.shiftKey)){

			event.preventDefault();
			
			var current = tooltip.find('.pagelayer-list-widget-active:visible');
			next = current.nextAll('.pagelayer-shortcode-holder:visible');
				
			if(event.key == 'ArrowDown'){
				
				var _next = next,
				cOffset = current.offset(),
				findNext = false;
				
				var searchNext = function(nEle){
					var nOffset = nEle.offset();
					var cBottom = cOffset.top + current.height();
					
					if(cBottom > nOffset.top){
						return true;
					}
					
					next = nEle;
					findNext = true;
					
					// Current element left set -20 to manager next scale (css) element on hover
					if(cOffset.left - 20 <= nOffset.left){
						return false;
					}
					
					return true;
				}
				
				_next.each(function(){
					return searchNext(jQuery(this));
				});
				
				if(!findNext){
					var gNext = current.parent().nextAll('.pagelayer-widget-group:visible').first();
					_next = gNext.children('.pagelayer-shortcode-holder:visible');
					_next.each(function(){
						return searchNext(jQuery(this));						
					});
				}
				
			}
			
			if(next.length < 1){
				next = current.parent().nextAll('.pagelayer-widget-group:visible').first().find('.pagelayer-shortcode-holder:visible');
			}
			
			if(next.length < 1){
				return;
			}
			
			next.first().trigger('widget_active');

		}
	}

	// Is this in the editable area ?
	if (tEle.is('input, textarea') || editable.length > 0) {
		return;
	}
	
	// Delete
	if(event.keyCode == 46){
		pagelayer_delete_element('[pagelayer-active]');
	}
	
	// ctrl+z handle
	if(event.keyCode == 90 && event.ctrlKey){
		pagelayer_do_history('undo');
	}
	
	// ctrl+y handle
	if(event.keyCode == 89 && event.ctrlKey){
		pagelayer_do_history('redo');
	}
	
});

// Handle Copy of content
jQuery(document).on('copy', function(copyEvent){
		
	// Is Selected string?
	var selectedText = "";
	if (window.getSelection){ // all modern browsers and IE9+
		selectedText = window.getSelection().toString();
	}
	
	if(selectedText.length > 0){
		return;
	}
	
	if(pagelayer_active.el && pagelayer_active.el.id){
		
		// Do empty clipbord data 
		(copyEvent.originalEvent || copyEvent).clipboardData.setData('text/plain', '');
		copyEvent.preventDefault();
		
		// Save the active element id
		pagelayer_copy_select("[pagelayer-id='"+pagelayer_active.el.id+"']");
		
	}
	
});

// Handle Paste in the editor
jQuery(document).on('paste', function(pasteEvent){

	var pEle_target = jQuery((pasteEvent.originalEvent || pasteEvent).target);
	var tag = pagelayer_tag(pEle_target.closest('[pagelayer-id]'));
	var clipboardData = (pasteEvent.originalEvent || pasteEvent).clipboardData;
	var items = clipboardData.items;

	var pagelayer_ajax_func = {};
	var contenteditable = false;
	var pasteWidget = false;

	if( pEle_target.closest('[contenteditable="true"]').length > 0 || pEle_target.is('input, textarea') ){
		pEle_target = pEle_target.closest('[contenteditable="true"], input, textarea');
		contenteditable = true;
	}
	
	if( items.length < 1 || (items.length == 1 && pagelayer_empty(clipboardData.getData(items[0].type))) ){
		pasteWidget = true;
	}
	
	// This function for ajax before send call back
	pagelayer_ajax_func['beforeSend'] = function(xhr){
		
		// If target is not content editable
		if( pagelayer_empty(contenteditable) ){
		
			// If we dont have an active element then return false and stop ajax
			if( !(pagelayer_active.el && pagelayer_active.el.id) ){
				pagelayer_show_msg(pagelayer_l('active_ele_paste_msg'));
				return false;
			}
							
			pagelayer.copy_selected = jQuery('<div pagelayer-tag="pl_image"></div>');
				
			// Is it to be pastable
			if(!pagelayer_can_copy_to('[pagelayer-id="'+pagelayer_active.el.id+'"]')){
				pagelayer.copy_selected = '';
				return false;
			}
		}
		
		pEle_target.css({'opacity': '0.33' , 'transition' : '0.1s'});
	}
	
	// This function for ajax success call back
	pagelayer_ajax_func['success'] = function(obj){
		
		// Successfully Uploaded
		if(obj['success']){
			
			// For content editable e.g. Rich Text
			if( !pagelayer_empty(contenteditable) ){
				document.execCommand('insertImage', false, obj['data']['url']);
			
			// For our widgets
			}else{
				
				if(pagelayer_empty(pagelayer_active.el) || pagelayer_empty(pagelayer_active.el.id)){
					pagelayer_show_msg('active_ele_paste_msg');
					return;
				}
				
				var fTo = pagelayer_can_copy_to('[pagelayer-id="'+pagelayer_active.el.id+'"]');
				// We need to empty pagelayer.copy_selected
				pagelayer.copy_selected = '';
				
				var pasteAfter = function(){
					
					// Prevent to add action history
					pagelayer.history_action = false;
					
					// Create image html
					var html = pagelayer_create_sc('pl_image');
					
					pagelayer_set_atts(html, 'id', obj['data']['id']);
					pagelayer_set_tmp_atts(html, 'id-url', obj['data']['url']);
					
					// Allow to add action history
					pagelayer.history_action = true;
		
					// Copy the element
					var id = pagelayer_copy_element(html, fTo);
					jQuery('[pagelayer-id="'+id+'"]').click();
					
				};
				
				var replaceURL = function(){
					
					// Finding widget image setting using id of jEle. Finding image editor setting from all of the other settings.
					var row = pagelayer.$$('[pagelayer-element-id='+pagelayer_active.el.id+']').find('.pagelayer-elp-image').eq(0).parent().parent();
					
					row.find('.pagelayer-elp-image').css('background-image', 'url(\''+obj['data']['url']+'\')');
					
					// To remove past temp attr so that they are not involve in future temp values
					var cname = row.attr('pagelayer-elp-name');
					var old = _pagelayer_img_tmp_atts(row);
					delete old[cname+'-url'];
					
					for(var x in obj['data']['sizes']){
						_pagelayer_set_tmp_atts(row, x+'-url', obj['data']['sizes'][x]['url']);
						delete old[cname+'-'+x+'-url'];
					}
					
					for(var x in old){
						_pagelayer_set_tmp_atts(row, x+'-url', '');
					}
										
					// Save and render
					_pagelayer_set_tmp_atts(row, 'url', obj['data']['url']);
					_pagelayer_set_atts(row, obj['data']['id']);
				};
				
				// Image paste confirmation.
				if(!pagelayer_empty(pagelayer_active.el.tag) && pagelayer_active.el.tag == 'pl_image'){
					
					pagelayer_confirmation_box(pagelayer_l('img_paste_conf'), replaceURL, pasteAfter, pagelayer_l('replace_img'), pagelayer_l('paste_after'));
					
				}else{
					pasteAfter();
				}
			}
		
		// Some error occured	
		}else{
			pagelayer_show_msg(obj['data']['message'], 'error', 10000);						
		}
	}
	
	// This function for ajax complete call back
	pagelayer_ajax_func['complete'] = function(xhr){
		//console.log(xhr);
		pEle_target.css({'opacity': '1' , 'transition' : '0.1s'});
	}
	
	var findImg = pagelayer_editable_paste_handler(pasteEvent, pagelayer_ajax_func);
	
	if(pagelayer_empty(findImg) && pagelayer_empty(contenteditable) || pasteWidget){
		
		// Check the active element
		if(pagelayer_active.el && pagelayer_active.el.id && pagelayer_active.el.tag != 'pl_post_props'){
			
			var jEle = jQuery("[pagelayer-id='"+pagelayer_active.el.id+"']");
									
			// Check if the any element is copied
			pagelayer_paste_element("[pagelayer-id='"+pagelayer_active.el.id+"']");
			
		}else{
			pagelayer_show_msg(pagelayer_l('no_active_ele_paste'));
		}
	}
});

// Delete an element as per the selector
function pagelayer_delete_element(selector){
	var jEle = jQuery(selector);
	var nearBy = jEle;
	
	// Anything found ?
	if(jEle.length > 0){
		
		var id = pagelayer_assign_id(jEle);
		var sc = pagelayer_tag(jEle);
		
		// Is there a wrap
		var wrap = jQuery('[pagelayer-wrap-id="'+id+'"]');
		
		var par = wrap.parent();
		
		// Save this element in history action
		if(pagelayer.history_action){	
			var cEle = pagelayer_near_by_ele(id, sc);
			
			nearBy = jQuery(cEle.cEle);
			
			// To save in history, we need to save only element not the wraps as we call setup if we redo or undo	
			jEle.find('style').remove();
			jEle.find('.pagelayer-ele-overlay').remove();
			
			// Unwrap the wraps
			jEle.find('.pagelayer-ele').each(function (){
				var ele = jQuery(this);
				if(ele.parent().is('.pagelayer-ele-wrap')){
					ele.unwrap();
				}
			});
						
			pagelayer_history_action_push({
				'title' : pagelayer_shortcodes[sc]['name'],
				'action' : 'Deleted',
				'pl_id' : id,
				'html' : jEle[0].outerHTML,
				'cEle' : cEle
			});
		}
		
		wrap.remove();
		
		pagelayer_empty_col(par);
		
		if( (pagelayer_active.el && pagelayer_active.el.id == id) || 
      (pagelayer_active.el && pagelayer_active.el.id && jQuery('[pagelayer-id="'+pagelayer_active.el.id+'"]').length < 1)){
			pagelayer.$$('.pagelayer-elpd-close').click();
		}
		
	}
	
	// Do Pagelayer dirty
	pagelayer_do_dirty(nearBy);
};

// Select an element
function pagelayer_copy_select(selector){
	
	var eHtml = jQuery(selector)[0].outerHTML;
	
	// Copy data on localStorage
	localStorage.setItem("pagelayer_ele", eHtml);
	
	pagelayer.copy_selected = selector;
	
	pagelayer_show_msg( pagelayer_l('copied_msg'));
}

function pagelayer_can_copy_to(to){
	var jEle = jQuery(pagelayer.copy_selected);
	var tEle = jQuery(to);
	
	var eTag = pagelayer_tag(jEle);
	var tTag = pagelayer_tag(tEle);
	//console.log(eTag+' - '+tTag);
	// Final to
	var fTo;
	
	// Selected element is a Row, can go only after a row
	if(eTag == 'pl_row'){
		fTo = tEle.closest('.pagelayer-ele.pagelayer-row');
		if(fTo.length != 1) return false;
		return fTo;
	}
	
	// Selected element is a Column, can go only after a col
	if(eTag == 'pl_col'){
		fTo = tEle.closest('.pagelayer-ele.pagelayer-col');
		if(fTo.length != 1) return false;
		return fTo;
	}
	
	// Is the TARGET a row or column when the selected item is a element
	if(tTag == 'pl_row' || tTag == 'pl_col'){
		return false;
	}
	
	return tEle;
	
}

// Select an element
function pagelayer_paste_element(to){
	
	// Copy data from localStorage
	pagelayer_copy_from_localStorage();
	
	var fTo = pagelayer_can_copy_to(to);
	
	// Is it a valid to
	if(!fTo){
		return false;
	}
	
	if(!pagelayer_empty(pagelayer.copy_selected)){
		pagelayer_copy_element(pagelayer.copy_selected, fTo);
		return true;
	}
	
	pagelayer_show_msg(pagelayer_l('no_copied'));
	
	return false;
	
}

// If copy_selected is empty then copy data from localStorage
function pagelayer_copy_from_localStorage(){
	if(!pagelayer_empty(localStorage.getItem("pagelayer_ele"))){
		// Set copy data from localStorage
		pagelayer.copy_selected = localStorage.getItem("pagelayer_ele");
	}
}

// Copy an element
// Note : insertAfter should always be an pagelayer-ele
function pagelayer_copy_element(selector, insertAfter){
	var src = jQuery(selector);
	var tag = pagelayer_tag(src);
	insertAfter = insertAfter || src;
	insertAfter = insertAfter.parent();
	
	var jEle = pagelayer_element_unsetup(src);
	
	// Give it an ID
	var id = pagelayer_assign_id(jEle);
	
	jQuery(insertAfter).after(jEle);
	
	pagelayer_element_setup('[pagelayer-id='+id+'], [pagelayer-id='+id+'] .pagelayer-ele', true);
	
	if(pagelayer_is_group(tag)){
		pagelayer_sc_render(jEle);
	}
	
	// Save this element in history action
	if(pagelayer.history_action){
		var cEle = pagelayer_near_by_ele(id, tag);
		pagelayer_history_action_push({
			'title' : pagelayer_shortcodes[tag]['name'],
			'action' : 'Copied',
			'pl_id' : id,
			'html' : jEle[0].outerHTML,
			'cEle' : cEle
		});
	}
	
	//If column then renumber columns
	if(tag == 'pl_col'){
		var row = src.parent().closest('.pagelayer-row');
		pagelayer_renumber_col(row);
	}
	
	pagelayer_do_dirty(jEle);
	
	return id;
};

// Traversing up one step an element
function pagelayer_move_element_up(selector){
	
	var src = jQuery(selector);
	var srcParent = src.parent();
	
	var srcParentPrev = srcParent.prev('.pagelayer-wrap-row, .pagelayer-wrap-inner-row, .pagelayer-wrap-ele');

	if(srcParentPrev.length<=0){
		return;
	}
  
	var srcTopValue = srcParent.offset().top;
	
	if(srcParentPrev.hasClass('pagelayer-wrap-ele')){
	
		var animUpCalc = srcTopValue-srcParentPrev.offset().top;
	
		srcParent.animate({top:-animUpCalc}, 200, function(){
			srcParent.css('top', '');
			srcParentPrev.css('top', '');
			srcParentPrev.before(srcParent.detach());
		});	
		
		srcParentPrev.animate({top:(srcParent.height()+srcParentPrev.height())-animUpCalc}, 200, function(){
			srcParentPrev.css('top', '');
		});		
		
		// Traverse window scroll with the element
		jQuery('html, body').animate({scrollTop:('-='+(srcTopValue-(srcParentPrev.offset().top)))},200);
	}else{
		srcParentPrev.before(srcParent.detach());		
		
		// Traverse window scroll with the element
		jQuery('html, body').animate({scrollTop:('-='+(srcTopValue-(src.parent().offset().top)))},200);
	}
	
	pagelayer_do_dirty(src);
}

// Traversing down one step an element
function pagelayer_move_element_down(selector){
	
	var src = jQuery(selector);
	var srcParent = src.parent();
	
	var srcParentNext = srcParent.next('.pagelayer-wrap-row, .pagelayer-wrap-inner-row, .pagelayer-wrap-ele');
	
	if(srcParentNext.length<=0){		
		return;
	}
  
	var srcTopValue = srcParent.offset().top;
	
	if(srcParentNext.hasClass('pagelayer-wrap-ele')){
		
		var animDownCalc = srcParentNext.offset().top-srcTopValue;
	
		srcParent.animate({top:(animDownCalc-(srcParent.height()-srcParentNext.height()))}, 200, function(){
			srcParent.css('top', '');
			srcParentNext.css('top', '');
			srcParentNext.after(srcParent.detach());
		});
		
		srcParentNext.animate({top:-animDownCalc}, 200, function(){
			srcParentNext.css('top', '');
		});
		
		// Traverse window scroll with the element
		jQuery('html, body').animate({scrollTop:('+='+(animDownCalc-(srcParent.height()-srcParentNext.height())))},200);
	}else{
		srcParentNext.after(srcParent.detach());		
		
		// Traverse window scroll with the element
		jQuery('html, body').animate({scrollTop:('+='+((src.parent().offset().top)-srcTopValue))},200);
	}
	
	pagelayer_do_dirty(src);
}

// Save sections as template
function pagelayer_ajax_save_template(data, ajax_call_back = ''){

	if(pagelayer_empty(data)){
		return;
	}
	
	//save global sections and widgets
	jQuery.ajax({
		type: "POST",
		url: pagelayer_ajax_url+'&action=pagelayer_save_templ_content&postID='+pagelayer_postID,
		data: { 
			pagelayer_nonce: pagelayer_ajax_nonce,
			global_widgets : data
		},
		success: function(response, status, xhr){
			//alert(data);
			var obj = jQuery.parseJSON(response);
			if(!pagelayer_empty(ajax_call_back) || typeof ajax_call_back == 'function'){
				ajax_call_back(obj);
			}
		},
		error: function(errorThrown){
			console.log(errorThrown);
		}
	});
	
}

// Get global id of the element
function pagelayer_get_global_id(jEle){
	return pagelayer_get_att(jEle, 'global_id');
}

// Set element as a global widget
function pagelayer_set_ele_global(jEle, post_id){
	
	// Add attribute for global ID
	jEle.attr('pagelayer-global-id', post_id);
	pagelayer.history_action = false;
	pagelayer_set_atts(jEle, 'global_id', post_id);
	pagelayer.history_action = true;
	
	return jEle;
}

// Save widgets as a global widget
function pagelayer_save_sections(sel, section = 'section'){
	
	var jEle = jQuery(sel);
	
	var  pagelayer_ajax_func = {};
	var label = 'Please enter the title';
	var content = pagelayer_generate_sc(jEle, true);
	var data = {};// create array for template data
	data[0] = {};
	
	switch(section){
		
		case 'global_widget' :
			var title = prompt(label, 'Global Widget');
			if (title == null) return;
			
			// Save the widget data in global widget array 
			if(pagelayer_empty(pagelayer_global_widgets)){
				pagelayer_global_widgets = {};
			}
			
			break;
			
		case'global_section' :
			var title = prompt(label, 'Global Section');
			if (title == null) return;
			
			break;
			
		case 'section':
			var title = prompt(label, 'Section');
			if (title == null) return;
			
			break;
			
	}
	
	// Add Data
	data[0]['title'] = title;
	data[0]['post_type'] = 'pagelayer-template';
	data[0]['type'] = section; 
	data[0]['content'] = content.replace(/pagelayer-id="(.*?)"/g, ""); // Need to remove pagelayer id,
	data[0]['content'] = pagelayer_Base64.encode(data[0]['content']);
	
	// This function for ajax success call back of global widget 
	pagelayer_ajax_func['global_widget'] = function(obj){
		
		if(pagelayer_empty(obj['success'])){
			return;
		}
		
		for(var post_id in obj['success']){
			
			pagelayer_set_ele_global(jEle, post_id);
			
			// Add global
			jData = {};
			jData['post_id'] = post_id;
			jData['title'] = title; // TODO : create modal to input title
			jData['$'] = jEle;
			jData['is_dirty'] = true;
			
			// Add the array in global widgets array
			pagelayer_global_widgets[post_id] = jData;
			
			pagelayer.$$('.pagelayer-elpd-close').click();
			pagelayer.$$('.pagelayer-widget-tab').click();
			break;
		}
		
	}
	
	// This function for ajax success call back of global sections
	pagelayer_ajax_func['global_section'] = function(obj){
		// TODO: For global Sections
		//console.log(obj);
	}
	
	// This function for ajax success call back of section s
	pagelayer_ajax_func['section'] = function(obj){
		//console.log(obj);
	}
	
	pagelayer_ajax_save_template(data, pagelayer_ajax_func[section]);
	
}

// Genrate sc for global widgets
function pagelayer_generate_sc_global_widget(){
	
	var global_widgets = {};

	// Create shortcode for all the global widgets
	for(var y in pagelayer_global_widgets){
		var cWidget = pagelayer_global_widgets[y];
		
		// If is_dirty empty then continue the loop
		if(pagelayer_empty(cWidget['is_dirty'])){
			continue;
		}
		
		global_widgets[y] = {};
		global_widgets[y]['title'] = cWidget['title'];
		global_widgets[y]['post_id'] = pagelayer_empty(cWidget['post_id']) ? 0 : cWidget['post_id'];
		global_widgets[y]['post_type'] = 'pagelayer-template';
		global_widgets[y]['type'] = 'global_widget';
		
		var content = pagelayer_generate_sc(jQuery(cWidget.$), true);
		var tag = pagelayer_tag(jQuery(cWidget.$));
		
		// IF is group then need to remove pagelayer id, 
		if(!pagelayer_empty(tag) && pagelayer_is_group(tag)){
			content = content.replace(/pagelayer-id="(.*?)"/g, "");
		}
		
		global_widgets[y]['content'] = pagelayer_Base64.encode(content);
		pagelayer_global_widgets[y]['is_dirty'] = false;
	}
	
	return global_widgets;
}

var pagelayer_set_global_timmer = {};

// If you edit one Global widget it should be copied to other instances of the same global widget
function pagelayer_setup_global_widgets(id, jEle){
	
	if(pagelayer_empty(id) || pagelayer_empty(pagelayer_global_widgets[id])){
		return;
	}
	
	var elData = pagelayer_global_widgets[id];
	
	clearTimeout(pagelayer_set_global_timmer);
	pagelayer_set_global_timmer = setTimeout(function(){
		// Set attrs for all the global widgets  
		jQuery(pagelayer_editable+' [pagelayer-global-id='+ id +']').each(function(){
			
			var cEle = jQuery(this);
			var cEleID = pagelayer_id(cEle);
	
			if( jEle.length > 0 && jEle.is(cEle)){
				return true;
			}
			
			pagelayer.history_action = false;
			pagelayer.global_render = false;
			
			// Get HTML form global array
			var html = pagelayer_element_unsetup(elData.$, cEleID);
									
			if(cEle.parent().is('.pagelayer-ele-wrap')){
				cEle.parent().children('.pagelayer-ele-overlay').remove();
				cEle.unwrap();
			}
			
			cEle[0].outerHTML = html[0].outerHTML;
			
			pagelayer_element_setup('[pagelayer-id='+cEleID+'], [pagelayer-id='+cEleID+'] .pagelayer-ele');
			pagelayer_sc_render(jQuery('[pagelayer-id="'+cEleID+'"]'));
			
			pagelayer.history_action = true;
			pagelayer.global_render = true;
		});
		
	}, 3000);

}

// Language key
function pagelayer_l(k){
	if(k in pagelayer_lang){
		return pagelayer_lang[k];
	}
	return k;
}

// Get props based on the tag
function pagelayer_get_props(jEle){
	var props = pagelayer_shortcodes[pagelayer_tag(jEle)];
	return props;
}

// Get all props based on the tag but in a single structure
function pagelayer_make_props_ref(){
	
	// Loop through pagelayer_shortcodes
	for(var tag in pagelayer_shortcodes){
		
		var all_props = pagelayer_shortcodes[tag];
		pagelayer.props_ref[tag] = {};
	
		// Loop through all props
		for(var i in pagelayer_tabs){
			
			var tab = pagelayer_tabs[i];

			for(var section in all_props[tab]){
				
				var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
					
				// In case of widgets its possible !
				if(pagelayer_empty(props)){
					continue;
				}
				
				for(var x in props){
					
					// Create an easy REFERENCE for access
					pagelayer.props_ref[tag][x] = props[x];
					
					// Screen option REFERENCE is also needed for lookup
					if('screen' in props[x]){
						pagelayer.props_ref[tag][x+'_tablet'] = props[x];
						pagelayer.props_ref[tag][x+'_mobile'] = props[x];
					}
					
				}
			}
			
		}
		
	}
	
}

// Set the given jELE as active
function pagelayer_set_active(jEle){
	
	// Make all other element as inactive
	jQuery('[pagelayer-active]').each(function(){	
		var $j = jQuery(this);
		$j.removeAttr('pagelayer-active');
	});
	
	jEle.attr('pagelayer-active', 1);
	
	// Add and remove the class
	jQuery('.pagelayer-active').removeClass('pagelayer-active');
	
	jEle.parent().children('.pagelayer-ele-overlay').addClass('pagelayer-active');
	
}

function pagelayer_sc(sc){
	return sc.replace('pl_', '');
};

// Create a HTML dom element of the Short code
// Return the jEle
function pagelayer_create_sc(sc){
	
	var html;
	var _sc = pagelayer_sc(sc);
	var func = window['pagelayer_create_sc_'+sc];
	
	// Generate the HTML
	if(typeof func == 'function'){
		html = window['pagelayer_create_sc_'+sc]();
	}else{
		html = '<div '+pagelayer_sc_atts('pagelayer-'+_sc)+'></div>';
	}
	
	html = jQuery(html);
	
	// Add the tag
	html.attr('pagelayer-tag', sc);
	
	// Give it an ID
	id = pagelayer_assign_id(html);
	
	// Try to set the default values over 5 loops
	pagelayer_set_default_atts(html, 5);
	
	return html;
	
};

// Returns a list of default attributes to set as per the current selection
function pagelayer_set_default_atts(jEle, set){
	
	set = set || 0;
	var hasSet = false;
	
	for(var i = 1; i <= set;i++){
		
		//console.log('[pagelayer_set_default_atts] Loop :'+i);
		//console.log(jEle);
		
		// Get existing data
		var el = pagelayer_data(jEle, true);
		
		// If it is the last loop and we are greater than 1
		if(i > 1 && i == set){
			console.log('[pagelayer_default_atts] Still vars to set. Please check your shortcode params !');
		}
		
		// We are supposed to set !
		if('set' in el && !pagelayer_empty(el.set)){		
			pagelayer_set_atts(jEle, el.set);
			hasSet = true;
		}else{
			break;
		}
	}
	
	return hasSet;
}

// Returns the tag
function pagelayer_tag(jEle){
	
	// It could be the wrap
	if(jEle.hasClass('pagelayer-ele-wrap')){
		return jEle.children('.pagelayer-ele').attr('pagelayer-tag');
	}
	
	// It could be the row or col holder
	if(jEle.hasClass('pagelayer-row-holder') || jEle.hasClass('pagelayer-col-holder')){
		return jEle.parent().attr('pagelayer-tag');
	}
	
	return jEle.attr('pagelayer-tag');
}

function pagelayer_el_data_ref(jEle){
	var id = pagelayer_id(jEle);
	
	if(!(id in pagelayer.el)){
		pagelayer.el[id] = {};
	}
	
	if(typeof pagelayer.el[id] !== 'object'){
		pagelayer.el[id] = {};
	}
	
	if(!('attr' in pagelayer.el[id])){
		pagelayer.el[id]['attr'] = {};
	}
	
	if(Array.isArray(pagelayer.el[id]['attr'])){
		pagelayer.el[id]['attr'] = {};
	}
	
	if(!('tmp' in pagelayer.el[id])){
		pagelayer.el[id]['tmp'] = {};
	}
	
	if(Array.isArray(pagelayer.el[id]['tmp'])){
		pagelayer.el[id]['tmp'] = {};
	}
	
	return pagelayer.el[id];
};

// Gets the data node which can be position 0 or 1
function pagelayer_el_get_data_node(jEle){
	var node = jEle[0].childNodes[0];
	if(node && node.nodeType === 8){
		return node;
	}
	node = jEle[0].childNodes[1];
	if(node && node.nodeType === 8){
		return node;
	}
	return false;
}

// Get the data
function pagelayer_el_get_data(jEle){
	var node = pagelayer_el_get_data_node(jEle);
	if(node){
		return JSON.parse(node.nodeValue);
	}	
	return false;
};

// Add the data back again
function pagelayer_el_dump_data(jEle){
	var node = pagelayer_el_get_data_node(jEle);
	var d = pagelayer_serializeAttributes(pagelayer_el_data_ref(jEle));
	
	if(node){
		node.nodeValue = d;
	}else{
		jEle.prepend('<!-- '+d+' -->');
	}
};

// Gets a single attribute value
function pagelayer_get_att(jEle, att){
	var ref_data = pagelayer_el_data_ref(jEle);
	if(att in ref_data['attr']){
		return ref_data['attr'][att];
	}
	return;
};

// Gets a single attribute value
function pagelayer_get_tmp_att(jEle, att){
	var ref_data = pagelayer_el_data_ref(jEle);
	if(att in ref_data['tmp']){
		return ref_data['tmp'][att];
	}
	return;
};

// This function will just set atts and not do anything else
// Atts can be string or object. If its string, then val is needed
function pagelayer_set_atts(jEle, atts, val){
	
	if(typeof atts == 'string'){
		var tmp = {};
		tmp[atts] = val;
		atts = tmp;
	}
	
	if(typeof atts != 'object'){
		return false;
	}
	
	var tag = pagelayer_tag(jEle);
	var trigger_onchange = 0;
	
	if(pagelayer_empty(tag)){
		console.log('Set atts found no tag');
		console.log(jEle);
		return;
	}
		
	// All props
	var all_props = pagelayer_shortcodes[tag];//console.log(tag);console.log(jEle);
	var trigger_props = {};
	var no_val = {};
	var defaults = {};
	var _props = {};
	
	// Loop through all props
	for(var i in pagelayer_tabs){
		
		var tab = pagelayer_tabs[i];

		for(var section in all_props[tab]){
			
			var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
			
			for(var x in props){
				
				if('default' in props[x]){
					defaults[x] = 1;
				}
				
				// Create an easy REFERENCE for access
				_props[x] = props[x];
				
				// Screen option REFERENCE is also needed for lookup
				if('screen' in _props[x]){
					_props[x+'_tablet'] = props[x];
					_props[x+'_mobile'] = props[x];
				}
				
				// Dont set any val, but we set temp value
				if('no_val' in props[x]){
					no_val[x] = 1;
				}
				
				if('req' in props[x] || 'show' in props[x]){					
					var show = 'req' in props[x] ? props[x]['req'] : props[x]['show'];
					
					// We have both req and show, so lets just combine the values and then show
					// NOTE : We need to make an array and not just merge the 2 as they are references
					if('req' in props[x] && 'show' in props[x]){
						
						// Add the req values
						show = JSON.parse(JSON.stringify(props[x]['req']));
						
						// Now the show values need to be looped
						for(var t in props[x]['show']){
							show[t] = props[x]['show'][t];
						}
						
					}
					
					for(var showParam in show){
						var val = show[showParam];
						var except = showParam.substr(0, 1) == '!' ? true : false;
						showParam = except ? showParam.substr(1) : showParam;
						trigger_props[showParam] = 1;
					}
					
				}
				
			}
			
		}
		
	}
	
	var ref_data = pagelayer_el_data_ref(jEle);
	
	for(var x in atts){
		
		// Are we to trigger change
		if(x in trigger_props){
			trigger_onchange = 1;
		}
		
		//console.log(x+'-'+atts[x]);
		
		// Is this a pro feature and we are not pro ? Then we dont do anything and continue !
		if(!pagelayer_empty(_props[x]) && 'pro' in _props[x] && pagelayer_empty(pagelayer_pro)){
			continue;
		}
		
		if(x in no_val){
			pagelayer_set_tmp_atts(jEle, x, atts[x]);
			continue;
		}
		
		// Record History
		if(pagelayer.history_action){				
			var old_val = pagelayer_get_att(jEle, x) || '';
			var label = x;
			
			if(x in _props && 'label' in _props[x]){
				label = _props[x]['label'];
			}
			
			pagelayer_history_action_push({
				'title' : all_props['name'],
				'subTitle' : label,
				'action' : 'Edited',
				'attrType' : 'a_attr',
				'pl_id' : pagelayer_id(jEle),
				'atts' : x,
				'oldVal' : old_val,
				'newVal' : atts[x]
			});
		}
		
		// Remove the attribute if its BLANK and there is no default for it
		// If there is a default, we set it to blank to keep record of the current val
		if(pagelayer_length(atts[x]) < 1){
			
			// Remove values which are not defaults
			if(!(x in defaults)){
				delete ref_data['attr'][x];
			// Otherwise keep value set for avoiding resetting
			}else{
				ref_data['attr'][x] = atts[x];
			}
			
			// Remove the tmp atts anyway
			pagelayer_clear_tmp_atts(jEle, x);
		
		// Set the value
		}else{
			ref_data['attr'][x] = pagelayer_trim(atts[x]);
		}
		
		// Are you the active element
		if(pagelayer_is_active(jEle)){
			
			// TODO : Record Undo and Redo
			
		}
		
	}
	
	pagelayer_el_dump_data(jEle);
	
	// Trigger the change of the parameter and show the required properties
	if(trigger_onchange){
		pagelayer_elpd_show_rows();
	}
	
	pagelayer_do_dirty(jEle);
  
};

// This function will just set atts and not do anything else
// Atts can be string or object. If its string, then val is needed
function pagelayer_set_tmp_atts(jEle, atts, val){
	
	if(typeof atts == 'string'){
		var tmp = {};
		tmp[atts] = val;
		atts = tmp;
	}
	
	if(typeof atts != 'object'){
		return false;
	}
	
	var ref_data = pagelayer_el_data_ref(jEle);
	
	for(var x in atts){
		
		// Record history
		if(pagelayer.history_action){
				
			var old_val = pagelayer_get_tmp_att(jEle, x) || '';
			pagelayer_history_action_push({
				'title' : pagelayer_shortcodes[pagelayer_tag(jEle)]['name'],
				'subTitle' : x,
				'action' : 'Edited',
				'attrType' : 'tmp_attr',
				'pl_id' : pagelayer_id(jEle),
				'atts' : x,
				'oldVal' : old_val,
				'newVal' : atts[x]
			});
			
		}
		
		ref_data['tmp'][x] = atts[x];
		
	}
	
	pagelayer_el_dump_data(jEle);
	
};

// This function removes the temporary attributes of an ele
function pagelayer_clear_tmp_atts(jEle, attr){
	
	var to_del = new Array();
	var regexp = new RegExp('^'+attr+'\-', 'gi');
	var ref_data = pagelayer_el_data_ref(jEle);
	
	//console.log(to_del);
	for(var n in ref_data['tmp']){
		if(n.match(regexp)){
			delete ref_data['tmp'][n];
		}
	}
}

// This function removes the temporary attributes of an ele
function pagelayer_img_tmp_atts(jEle, attr){
	
	var found = {};
	var regexp = new RegExp('^'+attr+'\-', 'gi');
	var ref_data = pagelayer_el_data_ref(jEle);
	
	for(var n in ref_data['tmp']){
		if(n.match(regexp)){
			found[n] = 1;
		}
	}
	
	return found;
}

// Set the att and classes of an HTML which is not yet created
function pagelayer_sc_atts(classes){	
	var r = new Array();	
	return 'class="'+classes+' pagelayer-ele" '+r.join(' ');
}

// Is the jEle the active element ?
function pagelayer_is_active(jEle){
	
	// Is this the active Element ?
	if(pagelayer_empty(pagelayer_active.el) || jEle.attr('pagelayer-id') != pagelayer_active.el.id){
		return false;
	}
	
	return true;
	
};

// Removes {{}} from the variable name
function pagelayer_var(val){
	return val.substring(2, (val.length - 2));
}

// Take care of the CSS
function pagelayer_css_render(css, val, seperator){
	//console.log('CSS '+css+' | '+val);
	
	// Seperator
	seperator = seperator || ',';
	
	var replaceCss = function(rule, value, toreplace){
		
		value = pagelayer_hex8_to_rgba(value);
		
		// If value has css var then we remove units
		if(value.match(/var\(/)){
			var toreplace = toreplace.replace(/[-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
			toreplace  = new RegExp( toreplace+'?[^\\s|;]+', 'ig');
		}
		
		return rule.split(toreplace).join(value);
	}
	
	// Replace the val
	css = replaceCss(css, val, '{{val}}');
	
	// If there is an array
	if(css.match(/val\[\d/)){
		
		if(typeof val != 'object' || val === null){
			val = String(val).split(seperator);
		}
		
		for(var i in val){
			css = replaceCss(css, val[i], '{{val['+i+']}}');
		}
	}
	
	//console.log('Final CSS '+css);
	
	return css;
	
};

// Handle hexa to rgba and also remove alpha which is ff
function pagelayer_hex8_to_rgba(val){
	
	val = String(val);
	
	// If opacity is ff then discard ff
	if(val.match(/^#([a-f0-9]{6})ff$/)){
		return val.substr(0,7);
	}
	
	// Lets handle the RGB+opacity
	if(val.match(/^#([a-f0-9]{8})$/)){
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(val);
		val = 'rgba('+parseInt(result[1], 16)+', '+parseInt(result[2], 16)+', '+parseInt(result[3], 16)+', '+(parseInt(result[4], 16)/255).toFixed(2)+')';
	}
	
	return val;
	
};

// Replace the variables
function pagelayer_parse_el_vars(str, el){
	
	str = str.split('{{element}}').join(el.CSS.cssSel);
	str = str.split('{{wrap}}').join(el.CSS.wrap);
	str = str.split('{{ele_id}}').join(el.id);
	
	return str;

}

// Replace the variables
function pagelayer_parse_vars(str, el){
	
	for(var x in el.tmp){
		str = str.split('{{{'+x+'}}}').join(el.tmp[x]);
	}
	
	for(var x in el.atts){
		str = str.split('{{'+x+'}}').join(el.atts[x]);
	}
	
	return str;
};

// Render the Element
function pagelayer_sc_render(jEle){
	
	// We render only the active element
	if(!pagelayer_is_active(jEle)){
		//return false;
	}
	
	//console.log('Rendering');
	
	// Handle the CSS part
	// Get the id, tag, atts, data, etc
	var el = pagelayer_data(jEle, true);
	var all_props = pagelayer_shortcodes[el.tag];
	var elCSS = {
		classes: [],
		remove_classes: [],
		attr: [],
		remove_attr: [],
		css: [],
		edit: [],
		cssSel: '.p-'+el.id,
		sel: '[pagelayer-id="'+el.id+'"]',
		wrap: '[pagelayer-wrap-id="'+el.id+'"]'
	};
	
	// Create a reference
	el.CSS = elCSS;
  
  // Make sure if we have the class selector
	el.$.addClass('p-'+el.id);
	
	//console.log(el.atts);
	
	for(var i in pagelayer_tabs){
		var tab = pagelayer_tabs[i];
		for(var section in all_props[tab]){	//console.log(tab+' '+section);
	
			var props = section in pagelayer_shortcodes[el.tag] ? pagelayer_shortcodes[el.tag][section] : pagelayer_styles[section];//console.log(props);
	
			// Loop the props
			for(var x in props){
				
				// pagelayer_data will return attributes even if they are BLANK e.g. attr=""
				// Render doesnt consider BLANK values as values, and we are unsetting them now
				// If in any situation you need to consider blank values, please handle in the JS / PHP function of the Shortcode
				if(x in el.atts && pagelayer_length(el.atts[x]) < 1){
						delete el.atts[x];
				}
				
				// Any editor ?
				if('edit' in props[x]){
					elCSS.edit.push({prop: x, sel: props[x]['edit']});
				}
				
				// Load permalink values
				if(props[x]['type'] == 'link'){

					if('selector' in props[x] && typeof el.atts[x] == 'object'){
						var tmp = {};
						
						// Link is required for check IF and IF-EXT in html
						if(pagelayer_length(el.atts[x]['link'])  < 1){
							delete el.atts[x];
							continue;
						}
						
						if( 'target' in el.atts[x] && !pagelayer_empty(el.atts[x]['target']) ){
							tmp = {'sel': props[x]['selector'], 'val': 'target="_blank"'};
							elCSS['attr'].push(tmp);
						}
						
						if( 'rel' in el.atts[x] && !pagelayer_empty(el.atts[x]['rel']) ){
							tmp = {'sel': props[x]['selector'], 'val': 'rel="nofollow"'};
							elCSS['attr'].push(tmp);
						}

						if( 'attrs' in el.atts[x] && !pagelayer_empty(el.atts[x]['attrs']) ){

							var attrsVal = pagelayer_trim(el.atts[x]['attrs'].split(';'));
			
							attrsVal.forEach(function(item, index){
                  
								var splitValue = item.split(/=(.*)/);
								var attKey = pagelayer_trim(splitValue[0]);
								var setAtt = '';
									
								// Validate the attrs name 
								if(attKey.length < 1 || pagelayer_empty(attKey.match(/^[a-z_]+[\w:.-]*$/i))){
									return;
								}
									
								if(splitValue.length < 2){
									setAtt = attKey+'=""';
								}else{
									setAtt = attKey+'="'+splitValue[1]+'"';
								}
									
								tmp = {'sel': props[x]['selector'], 'val': setAtt};
								elCSS['attr'].push(tmp);
									
							});
						}
					}
				}
				
				// Do we have a addClass ?
				// We are checking before the element has a value so that we can add or remove the class
				if('addClass' in props[x]){
					
					var addClasses;
					
					// Convert the string to an array
					if(typeof props[x]['addClass'] === 'string'){
						addClasses = [props[x]['addClass']];
					}else{
						addClasses = props[x]['addClass'];
					}
					
					for(var c in addClasses){
							
						// The selector
						var tSel = jQuery.isNumeric(c) ? '' : c;
						
						// If there is a VAL
						// NOTE : Only val is allowed when there is a list
						if(addClasses[c].match(/\{\{val\}\}/) && 'list' in props[x]){
							
							for(var l in props[x]['list']){
								
								var tmp = {'sel': tSel, 'val': addClasses[c].replace('{{val}}', l)};
								
								if(el.atts[x] == l){
									elCSS['classes'].push(tmp);
								}else{
									elCSS['remove_classes'].push(tmp);
								}
								
							}
							
						}else{
							
							var tmp = {'sel': tSel, 'val': addClasses[c]};
							
							// If the value is there
							if(x in el.atts){
								elCSS['classes'].push(tmp);
							}else{
								elCSS['remove_classes'].push(tmp);
							}
						
						}
					}
				}
				
				// Do we have a addAttr ? 
				// We are checking before the element has a value so that we can add or remove the attr
				if('addAttr' in props[x]){
					
					var addAttr;
					
					// Convert the string to an array
					if(typeof props[x]['addAttr'] === 'string'){
						addAttr = [props[x]['addAttr']];
					}else{
						addAttr = props[x]['addAttr'];
					}
					
					for(var c in addAttr){
							
						// The selector
						var tSel = jQuery.isNumeric(c) ? '' : c;
						var tmp = {'sel': tSel, 'val': addAttr[c]};
						
						// If the value is there
						if(x in el.atts){
							elCSS['attr'].push(tmp);
						}else{
							elCSS['remove_attr'].push(tmp);
						}
					}
				}
				
				// Do we have a CSS ? 
				if('css' in props[x]){
					
					var css;
	
					// Convert the string to an array
					if(typeof props[x]['css'] === 'string'){
						css = [props[x]['css']];
					}else{
						css = props[x]['css'];
					}
					
					// Screen modes
					var modes = {desktop: '', tablet: '_tablet', mobile: '_mobile'};
					var desk_global = (props[x]['type'] == 'typography') ? pagelayer_is_global_typo(el.atts[x]) : '';
					
					for(var m in modes){
						
						var xm = x+modes[m];
						
						// If the value is there
						if(!(xm in el.atts) && pagelayer_empty(desk_global)){
							continue;
						}
						
						var xm_val = el.atts[xm];
						
						// If is global color
						if(props[x]['type'] == 'color'){
							xm_val = pagelayer_parse_color(el.atts[xm]);
						}
						
						// If is global font
						if(props[x]['type'] == 'typography'){
							xm_val = pagelayer_parse_typo(xm_val, false, desk_global, m);
						}
						
						// If there is global gradient color
						if(props[x]['type'] == 'gradient'){
							
							if(pagelayer_is_string(xm_val)){
								xm_val = xm_val.split(',');
							}
							
							for(key in xm_val){								
								xm_val[key] = pagelayer_parse_color(xm_val[key]);
							}
							
						}
						
						for(var c in css){
								
							// The selector
							var tSel = jQuery.isNumeric(c) ? '{{element}}' : c;
							var tmp = {
								sel: tSel, 
								val: pagelayer_css_render(css[c], xm_val, (props[x].sep || ',')),
							};
							
							// Is this a tablet
							if(m == 'tablet'){
								tmp.sel = '@media (max-width: '+ pagelayer_settings['tablet_breakpoint'] +'px) and (min-width: '+ (pagelayer_settings['mobile_breakpoint'] +1) +'px){'+tmp.sel;
								tmp.val = tmp.val+'}';
							}
							
							// Is this a mobile mode ?
							if(m == 'mobile'){
								tmp.sel = '@media (max-width: '+ pagelayer_settings['mobile_breakpoint'] +'px){'+tmp.sel;
								tmp.val = tmp.val+'}';
							}
							
							// Push to store
							elCSS.css.push(tmp);
						}
					
					}
					
				}
				
			}
			
		}
		
	}
	
	// If there is an HTML, then process it
	if('html' in pagelayer_shortcodes[el.tag]){
	
		// Is there a function to render ?
		var fn = window['pagelayer_render_'+jEle.attr('pagelayer-tag')];
		
		if(typeof fn == 'function'){
			fn(el);
		}
		
		el.iHTML = jQuery('<div>'+pagelayer_shortcodes[el.tag]['html']+'</div>');
		
		// Lets process the 'if-ext'
		el.iHTML.find('[if-ext]').each(function (){
			var $j = jQuery(this);
			var reqvar = pagelayer_var($j.attr('if-ext'));
			$j.removeAttr('if-ext');
			
			// Is the element there ?
			if(!(reqvar in el.atts && !pagelayer_empty(el.atts[reqvar]))){
				//console.log('HERE');
				$j[0].outerHTML = $j.html();
			}
			
		});
		
		// Lets process the 'if'
		el.iHTML.find('[if]').each(function (){
			var $j = jQuery(this);
			var reqvar = pagelayer_var($j.attr('if'));
			$j.removeAttr('if');
			
			// Is the element there ?
			if(!(reqvar in el.atts && !pagelayer_empty(el.atts[reqvar]))){
				//console.log('HERE');
				$j.remove();
			}
			
		});
		
		//console.log(el.atts);
		
		// Parse the variables
		var new_html = pagelayer_parse_vars(el.iHTML.html(), el);
		el.iHTML.html(new_html);
		
		// Do we have to wrap the innerHTML ?
		if('holder' in pagelayer_shortcodes[el.tag]){
			
			var hSel = pagelayer_shortcodes[el.tag]['holder'];
			var holder = jEle.find(hSel).first();
			
			// Detach the holder
			holder.detach();
			
			// Add the new HTML
			el.$.html(el.iHTML.html());
			
			// reAttach the children only
			el.$.find(hSel).html(holder.children());
		
		// No holder
		}else{
		
			//console.log(el.iHTML.html());
			el.$.html(el.iHTML.html());
		
		}
		
	// Rows, Cols and Groups
	}else{
	
		// Is there a function to render ?
		var fn = window['pagelayer_sc_render_'+jEle.attr('pagelayer-tag')];
		
		if(typeof fn == 'function'){
			fn(el);
		}
		
	}
	
	// Is there a function to render after HTML insertion but before CSS and attr ?
	var post = window['pagelayer_render_html_'+jEle.attr('pagelayer-tag')];
	
	if(typeof post == 'function'){
		post(el);
	}
	
	////////////////////////////
	// Are there any edit fields ?
	////////////////////////////
	
	if(elCSS.edit.length > 0){
		
		for(var c in elCSS.edit){
			var prop = elCSS.edit[c]['prop'];
			var tSel = elCSS.edit[c]['sel'];
			var node = tSel.length < 1 ? jEle : jEle.find(tSel);
			node.attr({'pagelayer-editable': prop, 'contenteditable' : 'true'});
		}
		
	}
	
	////////////////////////////
	// Are there any addClass ?
	////////////////////////////
	
	// If we have any classes to add
	if(elCSS.classes.length > 0){
		//console.log(elCSS.classes);
		
		for(var c in elCSS.classes){
			var tSel = elCSS.classes[c]['sel'].replace('{{element}}', '');
			var node = tSel.length < 1 ? jEle : jEle.find(tSel);
			if(!node.hasClass(elCSS.classes[c]['val'])){
				node.addClass(elCSS.classes[c]['val']);
			}
		}
	}
	
	// If we have any classes to remove
	if(elCSS.remove_classes.length > 0){
		//console.log(elCSS.remove_classes);
		
		for(var c in elCSS.remove_classes){
			var tSel = elCSS.remove_classes[c]['sel'].replace('{{element}}', '');
			var node = tSel.length < 1 ? jEle : jEle.find(tSel);
			if(node.hasClass(elCSS.remove_classes[c]['val'])){
				node.removeClass(elCSS.remove_classes[c]['val']);
			}
		}
	}
	
	////////////////////////////
	// Are there any addAttr ?
	////////////////////////////
	
	// If we have any attributes to add
	if(elCSS.attr.length > 0){
		//console.log(elCSS.attr);
		
		for(var c in elCSS.attr){
			var tSel = elCSS.attr[c]['sel'].replace('{{element}}', '');
			var node = tSel.length < 1 ? jEle : jEle.find(tSel);
			var att = elCSS.attr[c]['val'].split(/=(.*)/);
			att[1] = pagelayer_parse_vars(att[1], el);
			att[1] = pagelayer_trim(att[1], '"');
			
			// Is it the same val ?
			if(!node.attr(att[0]) !== att[1]){
				node.attr(att[0], att[1]);
			}
		}
	}
	
	// If we have any attributes to add
	if(elCSS.remove_attr.length > 0){
		//console.log(elCSS.remove_attr);
		
		for(var c in elCSS.remove_attr){
			var tSel = elCSS.remove_attr[c]['sel'].replace('{{element}}', '');
			var node = tSel.length < 1 ? jEle : jEle.find(tSel);
			var att = elCSS.remove_attr[c]['val'].split('=');
			
			if(node.is('['+att[0]+']')){
				node.removeAttr(att[0]);
			}
		}
	}
	
	// The style element
	var style = pagelayer.$('[pagelayer-style-id='+el.id+']');
	
	// If we have any RULES CSS, then handle it
	if(elCSS.css.length > 0){
		
		// Did we find it ?
		if(style.length < 1){
			jEle.prepend('<style pagelayer-style-id="'+el.id+'"></style>');
		}
		
		// Get it again
		style = pagelayer.$('[pagelayer-style-id='+el.id+']');
		
		// Make the rules
		var rules = [];
		
		// Loop
		for(var c in elCSS.css){
			var tSel = pagelayer_parse_el_vars(elCSS.css[c]['sel'], el);
			var rule = elCSS.css[c]['val'];
			if(tSel.length > 0){
				rules.push(tSel+'{'+rule+'}');
			}else{
				rules.push(pagelayer_parse_el_vars(rule, el));
			}
		}
	
		// CSS Selector overide
		if(!pagelayer_empty(all_props['overide_css_selector'])){
			for(var r in rules){
				var overide_css_selector = pagelayer_parse_el_vars(all_props['overide_css_selector'], el);
				rules[r] = rules[r].split(el.CSS.cssSel).join(overide_css_selector);
				rules[r] = rules[r].split(el.CSS.wrap).join(overide_css_selector);
			}
		}
		
		// Set the style
		style.html(pagelayer_parse_vars(rules.join("\n"), el));
		//console.log(style);
	}else{
		style.remove();
	}
	
	// Is there a function to render at the end ?
	var end = window['pagelayer_render_end_'+jEle.attr('pagelayer-tag')];
	
	if(typeof end == 'function'){
		end(el);
	}
	
	// If the element have any parent
	var par = pagelayer_get_parent(jEle);
	var eleId = el.id;

	if(par){
		eleId = par;
		pagelayer_sc_render(pagelayer_ele_by_id(par));
	}
	
	// Render End trigger
	pagelayer_trigger_action('pagelayer_sc_render_end', [el]);
		
	var gEle = pagelayer_ele_by_id(eleId);
	var gId = pagelayer_get_global_id(gEle);
		
	pagelayer_el_dump_data(jEle);

	// If global id exist then update the global array and restup the all global element
	if(!pagelayer_empty(gId) && !pagelayer_empty(pagelayer.global_render)){
		if(!pagelayer_empty(pagelayer_global_widgets[gId])){
			pagelayer_global_widgets[gId].$ = gEle[0].outerHTML;
			pagelayer_global_widgets[gId]['is_dirty'] = true;
			pagelayer_setup_global_widgets(gId, pagelayer_ele_by_id(eleId), true);
		}else{
			pagelayer_set_atts(gEle, 'global_id', '');
		}
	};
		
};

// Is the given global color
function pagelayer_is_global_color(color){
	
	var color_key = color.substr(0, 1) == '$' ? color.substr(1) : '';
	
	// If global color not exist
	if(!pagelayer_empty(color_key)){
		
		if(!(color_key in pagelayer_global_colors)){
			color_key = 'primary';
		}
		
		return color_key;
	}
	
	return false;
	
}

// Is the given global color
function pagelayer_is_global_typo(value){
	
	var typo_key = '';
	
	// Backward compatibility
	if(pagelayer_is_string(value) && value.substr(0, 1) == '$'){
		typo_key = value.substr(1);
	}
	
	if(typeof value == 'object' && 'global-font' in value){
		typo_key = value['global-font'];
	}
		
	// If global color not exist
	if(!pagelayer_empty(typo_key) && !(typo_key in pagelayer_global_fonts)){
		typo_key = 'primary';
	}
	
	return typo_key;
	
}

// Parse typography and handle Backward compatibility
function pagelayer_parse_typo(value, noglobal, desk_global, mode){
	
	noglobal = noglobal || false;
	mode = mode || 'desktop';
	desk_global = desk_global || '';
	
	if(pagelayer_empty(value)){
		value = {};
	}
	
	// Backward compatibility for comma seperated val
	if(pagelayer_is_string(value) && value.substr(0, 1) != '$'){
		return value.split(',');
	}
	
	var val = ['','','','','','','','','','',''];
	var typos = ['font-family', 'font-size', 'font-style', 'font-weight', 'font-variant', 'text-decoration-line', 'text-decoration-style', 'line-height', 'text-transform', 'letter-spacing', 'word-spacing'];
	
	var global_typo = pagelayer_is_global_typo(value);
	var _desk_global = false;
	
	if(pagelayer_empty(global_typo)){
		global_typo = desk_global;
		_desk_global = true;
	}
	
	// Apply global typo
	for(var typo in typos){
		
		var typoKey = typos[typo];
		
		// Backspace compatibility for normal array
		if(typeof value == 'object' && !pagelayer_empty(value[typo])){
			val[typo] = value[typo];
		}
		
		if(!pagelayer_empty(value[typoKey])){
			val[typo] = value[typoKey];
		}
		
		if(pagelayer_empty(global_typo) || !pagelayer_empty(val[typo]) || noglobal){
			continue;
		}
		
		var globalVal = pagelayer_global_fonts[global_typo]['value'];
		
		if( !(typoKey in globalVal) || pagelayer_empty(globalVal[typoKey]) || (typeof globalVal[typoKey] == 'object' && pagelayer_empty(globalVal[typoKey][mode])) || (typeof globalVal[typoKey] != 'object' && !pagelayer_empty(_desk_global) && mode != 'desktop') ){
			continue;
		}
		
		val[typo] = 'var(--pagelayer-font-'+global_typo+'-'+typoKey+')';
	}
	
	return val;
}

// Parse color for global color
function pagelayer_parse_color(value, glob_var = true){
		
	var is_global = pagelayer_is_global_color(value);
	if(pagelayer_empty(is_global)){
		return value;
	}
	
	if(pagelayer_empty(glob_var)){
		return pagelayer_global_colors[is_global]['value'];
	}
	
	return 'var(--pagelayer-color-'+is_global+')';
}

// Is the given tag a group
function pagelayer_is_group(tag){
	
	if('has_group' in pagelayer_shortcodes[tag] && !pagelayer_empty(pagelayer_shortcodes[tag]['has_group'])){
		return true;
	}
	
	return false;
	
}

// Do action / event
function pagelayer_trigger_action(act, param = []){
	jQuery(document).trigger(act, param);
}

// Perform a function on an action / event
function pagelayer_add_action(act, func){
	jQuery(document).on(act, func);
}

// Create array of the contact from template params 
function pagelayer_get_contact_templates(){
	
	var contacts = jQuery(pagelayer_editable+' [pagelayer-tag=pl_contact]');
	var contacts_props = {};
	if(contacts.length > 0){
		
		contacts.each(function(){
			
			var tmp = pagelayer_data(jQuery(this));
			var con_allowed = ['to_email', 'from_email', 'cont_subject', 'cont_header', 'cont_body', 'cont_use_html'];
			
			if(pagelayer_empty(tmp.atts['contact_custom_templ'])) return true;
			
			// Define blank array
			contacts_props[tmp.id] = {};
			
			for(var x in con_allowed){
				var key = con_allowed[x];
				if(!pagelayer_empty(tmp.atts[key])){
					contacts_props[tmp.id][key] = tmp.atts[key];
				}
			}
			
		});
	}
	
	return contacts_props;
}

// Save data or meta of the post
function pagelayer_update_post_data(){
	
	var tag = 'pl_post_props';
	var jEle = jQuery(pagelayer_editable+' [pagelayer-tag="'+tag+'"]');
  
	if(jEle.length < 1){
		return;
	}

	var tmp = pagelayer_data(jEle, true);
	var all_props = pagelayer_shortcodes[tag];
	
	// Loop through all props
	for(var i in pagelayer_tabs){
		
		var tab = pagelayer_tabs[i];

		for(var section in all_props[tab]){
			
			var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
			
			for(var x in props){
				//Set pagelayer POST data to send with save ajax
				if(x in tmp['atts']){
					pagelayer_ajax_post_data[x] = tmp['atts'][x];  
				}else if(x in pagelayer_ajax_post_data){
					delete pagelayer_ajax_post_data[x];
				}
			}
		}
	}
}

// Get the nav menu updated data 
function pagelayer_get_nav_items(jEle, _content){
	
	_content = _content || false;
	
	var pagelayer_nav_items = {};
	
	jEle.find('[pagelayer-tag="pl_nav_menu_item"]').each(function(){
		var cEle = jQuery(this),
		postID = pagelayer_get_att(cEle, 'ID');		
		
		if(!(postID in pagelayer_menus_items_ref)){
			return;
		}
		
		var ref_data = pagelayer_menus_items_ref[postID];
		
		if(!('pagelayer_content' in ref_data) && pagelayer_empty(ref_data['pagelayer_content'])){
			ref_data['pagelayer_content'] = cEle;
		}
		
		if(!('is_dirty' in ref_data) || pagelayer_empty(ref_data['is_dirty'])){
			return;
		}
		
		var content = '',
		tmp = {};
		tmp = Object.assign(tmp, ref_data);
		pagelayer_nav_items[postID] = {};
		
		// Update Mega menu content
		if(!pagelayer_empty(_content)){
			var navItem = jQuery(ref_data['pagelayer_content'])[0].outerHTML;
			var _navItem = jQuery(navItem);
			
			// If is not mega menu
			if('menu_type' in tmp && tmp['menu_type'] != 'mega'){
				_navItem.find('.pagelayer-menu-item-holder').empty();
			}
			
			content = pagelayer_generate_sc(_navItem, true);
			content = pagelayer_Base64.encode(content);
			
			// Send data to save
			var allowed_post = ['title'];
			
			for(var key in allowed_post){
				
				var post_prop = allowed_post[key];
				
				if(!(post_prop in tmp)){
					continue;
				}
				
				pagelayer_nav_items[postID][post_prop] = tmp[post_prop]
			}
			
		}else{
			pagelayer_nav_items[postID] = tmp;
		}
		
		// Delete the html content
		delete tmp['pagelayer_content'];
		
		pagelayer_nav_items[postID]['_pagelayer_content'] = content;
		
	});
	
	return pagelayer_nav_items;
}

// Save data or meta of the nav post
function pagelayer_update_nav_menu_data(){
	
	var tag = 'pl_wp_menu';
	
	pagelayer_ajax_post_data['pagelayer_nav_items'] = {};
	
	jQuery(pagelayer_editable+' [pagelayer-tag="'+tag+'"]').each(function(){
		
		var jEle = jQuery(this);
		var menu_ID = pagelayer_get_att(jEle, 'nav_list');		
		
		if(!pagelayer_empty(pagelayer_ajax_post_data['pagelayer_nav_items'][menu_ID])){
			return;
		}
		
		// Get the Current menu items
		var items = pagelayer_get_nav_items(jEle, true);
		
		if(pagelayer_empty(items)){
			return;
		}
		
		pagelayer_ajax_post_data['pagelayer_nav_items'][menu_ID] = items;  
			
	});
}

// Save the customizer settings
function pagelayer_update_customizer_settings(){
	
	var tag = 'pl_customizer';
	var jEle = jQuery(pagelayer_editable+' [pagelayer-tag="'+tag+'"]');
  
	if(jEle.length < 1){
		return;
	}

	var tmp = pagelayer_data(jEle, true);
	pagelayer_ajax_post_data['pagelayer_customizer_options'] = JSON.stringify(tmp['atts']);

}

// Save the post
function pagelayer_save(){
	
	// hiding and showing loading animation	
	pagelayer.$$('.pagelayer-update-text').hide();
	pagelayer.$$('.pagelayer-update-loader').show();
	
	pagelayer_trigger_action('pagelayer_save');
	
	var pagelayerajaxurl = pagelayer_ajax_url+'&action=pagelayer_save_content&postID='+pagelayer_postID;
	var post = pagelayer_generate_sc(pagelayer_editable);//alert(post);return;
	
	// Update data or meta of the post
	pagelayer_update_post_data();
  
	// Update Customizer Settings
	pagelayer_update_customizer_settings();

	// Update nav menu
	pagelayer_update_nav_menu_data();

	if(pagelayer_empty(pagelayer.post_status) && !pagelayer_empty(pagelayer_ajax_post_data['post_status'])){
		pagelayer.post_status = pagelayer_ajax_post_data['post_status'];
	}
  
	// Do we have contact templates ?
	var contacts_props = pagelayer_get_contact_templates();
	
	// Do we have any global widget to save ?
	var global_data  = {};
	
	if(!pagelayer_empty(pagelayer_global_widgets)){
		global_data = pagelayer_generate_sc_global_widget();
	}
	
	var cancel =  function(){
		pagelayer.$$('.pagelayer-update-text').show();
		pagelayer.$$('.pagelayer-update-loader').hide();
	}
	
	var save = function(){
		var post_data = {
			pagelayer_update_content : pagelayer_Base64.encode(post),
			pagelayer_nonce: pagelayer_ajax_nonce,
			global_widgets: global_data,
			contacts: contacts_props,
			post_status: pagelayer.post_status,
			copyright: pagelayer_copyright
		}
		
		post_data = Object.assign(pagelayer_ajax_post_data, post_data);
		
		jQuery.ajax({
			type: "POST",
			url: pagelayerajaxurl,
			data: post_data,
			success: function(response, status, xhr){
				//alert(data);
				var obj = jQuery.parseJSON(response);
				//alert(obj);
				if(obj['error']){
					pagelayer_show_msg(obj['error'], 'error', 10000);
				}else{
					pagelayer_show_msg(obj['success'], 'success', 10000);
					pagelayer_get_revision();
					
					// Update the post status in the post_props, but first find if its actually there !
					var jEle = jQuery(pagelayer_editable).find("[pagelayer-tag=pl_post_props]");
					if(jEle.length > 0){
						var id = pagelayer_id(jEle);
						pagelayer_set_atts(jEle, 'post_status', obj['post_status']);
						pagelayer_trigger_action('pagelayer_save_success', obj['post_status']);
					}
					
					pagelayer_do_undirty();					
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(errorThrown);
				pagelayer_show_msg('An error occured while saving ! Status : '+textStatus+' and Error : '+errorThrown, 'error', 10000);
			},
			complete: function(xhr,status){
				pagelayer.$$('.pagelayer-update-text').show();
				pagelayer.$$('.pagelayer-update-loader').hide();
				
				if(!pagelayer_empty(pagelayer.post_status)){
					pagelayer.$$('.pagelayer-props-modal .pagelayer-meta-iframe').attr('src', pagelayer_post_props );
					pagelayer.post_status = '';
				}
			}
		});
	}
	
	// If the content is empty
	if(pagelayer_empty(post)){
		pagelayer_confirmation_box(pagelayer_l('empty_post_content'), save, cancel);
		return;
	}
	
	save();
};

//Close the Editor
function pagelayer_close(){
	if(pagelayer_isDirty == true){
		var r =	confirm('Your Data has not been Saved yet! \n Press OK to stay on the Page.'+
		'\n Press Cancel to Close Editor. ');
		if(r == false){
			window.top.location.href = pagelayer_returnURL;
		}
	}else{
		window.top.location.href = pagelayer_returnURL;
	}
};
	
function pagelayer_htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function pagelayer_serializeAttributes(attributes) {
  return JSON.stringify(attributes) // Don't break HTML comments.
  .replace(/--/g, "\\u002d\\u002d") // Don't break non-standard-compliant tools.
  .replace(/</g, "\\u003c").replace(/>/g, "\\u003e").replace(/&/g, "\\u0026") // Bypass server stripslashes behavior which would unescape stringify's
  // escaping of quotation mark.
  // See: https://developer.wordpress.org/reference/functions/wp_kses_stripslashes/
  .replace(/\\"/g, "\\u0022");
}

// Generate blocks Post to save
function pagelayer_generate_sc(selector, selfEle){
	
	selfEle = selfEle || false;
	var txt = '';
	
	var generate_sc_single = function(jEle){
		
		// The ID
		var id = jEle.attr('pagelayer-id');
		
		// If there is an Add element wrapper
		if(pagelayer_empty(id)){
			return;
		}
		
		// Find the type of tag
		var tag = jEle.attr('pagelayer-tag');
		var final_tag = tag;
		var closestEle = jEle.closest('.pagelayer-col-holder');
		
		// Skip to create shortcode to prevent save, allowed by tag
		if('skip_save' in pagelayer_shortcodes[tag] && !pagelayer_empty(pagelayer_shortcodes[tag]['skip_save'])){
			return;
		}
		
		// Define inner row | Note : Commented as we now have a new widget of type inner_row
		/*if(tag == 'pl_row' && closestEle.length > 0 && closestEle.closest(pagelayer_editable).length > 0){
			final_tag = 'pl_inner_row';
		}*/
		
		if(pagelayer_empty(tag)){
			var err = 'Found an error in the content as the TAG was missing. The console will have more details.';
			pagelayer_show_msg(err, 'error');
			console.log(err);
			console.log(jEle);
		}

		// Define inner column
		if(tag == 'pl_col' && closestEle.length > 0 && closestEle.closest(pagelayer_editable).length > 0){
			final_tag = 'pl_inner_col';
		}
		//console.log(tag);
		
		// Is there an innerHTML ele
		var inner = '';
		if('innerHTML' in pagelayer_shortcodes[tag]){
			inner = pagelayer_shortcodes[tag]['innerHTML'];
		}
		
		// Data reference
		var ref_data = pagelayer_el_data_ref(jEle);
		
		// Create the tag
		var data = JSON.parse(JSON.stringify(ref_data['attr']));
		
		data['pagelayer-id'] = id;
		data = pagelayer_serializeAttributes(data);
				
		var content = '';
		
		// Any internal function to handle the save ?
		var func = window['pagelayer_tag_'+tag];
		if(typeof func == 'function'){
			
			content = func(jEle);
			
		// If its a Row or Column or Group then it will have children
		}else if(jEle.hasClass('pagelayer-row') || jEle.hasClass('pagelayer-col') || jEle.hasClass('pagelayer-inner_row') || pagelayer_is_group(tag)){
			
			var sel = jEle;
			
			// Any holder which holds children ?
			if('holder' in pagelayer_shortcodes[tag]){
				sel = jEle.find(pagelayer_shortcodes[tag]['holder']);
			}
			
			// Select the top-most element
			sel = jQuery(sel).first();
			
			// Any child selector - Majorly for owl carousel
			// NOTE : Child selector should be very specific with immediate child selection at all levels
			var child_selector = false;			
			if('child_selector' in pagelayer_shortcodes[tag]){
				sel = sel.find(pagelayer_shortcodes[tag]['child_selector']);
			}
						
			if(jQuery(sel).children(".pagelayer-ele-wrap").length < 1){
				content = jQuery(sel).html(); // Backward Compatibility
			}else{
				content = pagelayer_generate_sc(sel);
				content = "\n"+content;
			}
		
		// Its a normal element so we might need to handle the content
		}else{
			
			if(inner.length > 0){
				content = pagelayer_get_att(jEle, inner);
				if(!content){
					content = '';
				}
			}else{
				content = '';//jEle.html();
			}
			
		}
		
		if (pagelayer_empty(content)) {
			txt +=  "<!-- ".concat(pagelayer_block_prefix, ":pagelayer/").concat(final_tag, " ").concat(data, " /-->\n");
		}else{
			txt +=  "<!-- ".concat(pagelayer_block_prefix, ":pagelayer/").concat(final_tag, " ").concat(data, " -->").concat(content, "<!-- /").concat(pagelayer_block_prefix, ":pagelayer/").concat(final_tag, " -->\n");
		}

	};
	
	// Are you an element for which to generate the codes ?
	if(jQuery(selector).hasClass('pagelayer-ele') && selfEle){
  
		generate_sc_single(jQuery(selector));
  
	// The selector is the holder, so loop thru
	}else{
	
		jQuery(selector).children(".pagelayer-ele-wrap").each(function(){
			
			var jEle = jQuery(this).children('.pagelayer-ele');
			generate_sc_single(jEle);
			
		});
	
	}
	
	return txt;
	
};

// Show the required leftbar tab
function pagelayer_leftbar_tab(tab){	
	pagelayer.$$('.pagelayer-leftbar-tab').hide();
	pagelayer.$$('#'+tab).show();	
}

// Sets up the leftbar
function pagelayer_leftbar(){
	
	// Toggle the holder
	pagelayer.$$('.pagelayer-leftbar-toggle').on('click', function(){
		pagelayer.$$('.pagelayer-leftbar-table').toggleClass('pagelayer-leftbar-hidden');
		pagelayer_trigger_action('pagelayer-leftbar-toggle');
	});
	
	// Close leftbar
	pagelayer.$$('.pagelayer-leftbar-close').on('click', function(){
		pagelayer.$$('.pagelayer-leftbar-toggle').click();
	});
	
	// Minimize leftbar
	pagelayer.$$('.pagelayer-leftbar-minimize').on('click', function(){
		pagelayer.$$('.pagelayer-leftbar-table').toggleClass('pagelayer-leftbar-minimize');
	});
	
	var html = '<div class="pagelayer-leftbar">'+
	'<div class="pagelayer-leftbar-scroll">'+
		'<div id="pagelayer-shortcodes" class="pagelayer-leftbar-tab pagelayer-shortcodes">'+
			'<div class="pagelayer-widget-tabs">'+
				'<div class="pagelayer-widget-tab pagelayer-settings" pagelayer-widget-tab="settings">Settings</div>'+
				'<div class="pagelayer-widget-tab" pagelayer-widget-tab="widgets" pagelayer-elpd-active-tab=1>Widgets</div>'+
				'<div class="pagelayer-widget-tab" pagelayer-widget-tab="global">Global</div>'+
			'</div>'+
			'<div class="pagelayer-shortcodes-widget">'+
				'<div class="pagelayer-leftbar-search">'+
					'<i class="pli pli-search" ></i><input class="pagelayer-search-field" /><span class="pagelayer-sf-empty pli">&times;</span>'+
				'</div>';
		
	for(var x in pagelayer_groups){
		
		// Title
		html += '<div class="pagelayer-leftbar-group pagelayer-group-name-'+x+'"><h5>'+x+'</h5>';
		
		// Indivdual icon
		for(var y in pagelayer_groups[x]){
			
			var sc = pagelayer_groups[x][y];
			
			if(!(sc in pagelayer_shortcodes) || 'not_visible' in pagelayer_shortcodes[sc]){
				continue;
			}
			
			html += '<div class="pagelayer-shortcode-drag" draggable="true" pagelayer-tag="'+sc+'">'+
				'<div class="pagelayer-sc">'+
					'<center class="pagelayer-shortcode-inner">';
					
					if('icon' in pagelayer_shortcodes[sc]){
						html += '<i class="pagelayer-shortcode '+pagelayer_shortcodes[sc]['icon']+'"></i>';
					}else{
						html += '<i class="pagelayer-shortcode pli pagelayer-'+sc+'"></i>';
					}
					
					html += '</center>'+
					'<span class="pagelayer-shortcode-text">'+pagelayer_shortcodes[sc]['name']+'</span>'+
				'</div>'+
			'</div>';
			
		}
		
		html += '</div>';
		
	}
	
	html += '</div>'+
		'<div id="pagelayer-global-widget" class="pagelayer-hidden pagelayer-global-widget"></div>'+
		'</div>'+
		'<div id="pagelayer-elpd" class="pagelayer-leftbar-tab pagelayer-elpd"></div>'+
		'<div id="pagelayer-options" class="pagelayer-leftbar-tab pagelayer-options"></div>'+
		'<div id="pagelayer-history" class="pagelayer-leftbar-tab pagelayer-history"></div>'+
		'<div id="pagelayer-post-settings" class="pagelayer-leftbar-tab pagelayer-post-settings"></div>'+
		'<div id="pagelayer-navigator" class="pagelayer-leftbar-tab pagelayer-navigator"></div>'+
		'<div id="pagelayer-general-options" class="pagelayer-leftbar-tab pagelayer-general-options"></div>'+
	'</div>'+
'</div>';

	pagelayer.$$('.pagelayer-leftbar-holder').prepend(html);
	pagelayer_leftbar_tab('pagelayer-shortcodes');
	
	pagelayer.$$('.pagelayer-leftbar-scroll').slimScroll({
		height: '100%',
		railVisible: false,
		alwaysVisible: true,
		color: '#000',
		size: '5px',
	});
	
	// Hide the ones which are not supposed to be shown
	pagelayer.$$('.pagelayer-search-field').on('input', function(){
		
		var val = jQuery(this).val();
		var re = new RegExp(val, 'i');
		
		// Show only the required tags
		pagelayer.$$('.pagelayer-leftbar-group').each(function(){
			
			var group = jQuery(this);
			var res = group.find('[pagelayer-tag]');
			var hidden = 0;
			
			res.each(function(){
				
				var tEle = jQuery(this);
				if(tEle.find('.pagelayer-shortcode-text').html().match(re)){
					tEle.show();
				}else{
					hidden += 1;
					tEle.hide();
				}
				
			});
			
			// Hide the whole group
			if(hidden == res.length){
				group.hide();
			}else{
				group.show();
			}
				
		});
	});
	
	// On click Pagelayer setting icon
	pagelayer.$$('.pagelayer-settings-icon, .pagelayer-settings').click(function(event){
		pagelayer_active = {};
		
		var pl_tag = jQuery(this).attr('pagelayer-tag') || 'pl_post_props';
		var nModal = jQuery(this).attr('pagelayer-modal-none');
		
		pagelayer_post_settings(pl_tag);
		
	});
	
	// Pagelayer post advance setting modal handler
	var propsModal = pagelayer.$$('.pagelayer-props-modal');
	propsModal.find('.pagelayer-props-modal-close').on('click', function(event){
		propsModal.hide();
	});
		
	propsModal.on('click', function(event){
		var target = jQuery(event.target);
		
		if(target.closest('.pagelayer-props-modal-wrap').length > 0){
			return;
		}
		
		propsModal.hide();
	});
		
	
	// On click Pagelayer setting icon
	var global_widget_list = function(){
		
		var gHtml = '';
		
		if(pagelayer_empty(pagelayer_pro)){
			gHtml += '<div class="pagelayer-global-widget-pro">'+pagelayer.pro_txt+
			'<p>Using this feature, you can save the widgets globally and use them on the entire site. The global widget will be editable from one place.</p>'+
			'</div>';
			
			pagelayer.$$('#pagelayer-global-widget').html(gHtml);
			return;
		}
		
		gHtml += '<div class="pagelayer-global-widget-shortcodes">'+
			'<div class="pagelayer-leftbar-search">'+
				'<i class="pli pli-search" ></i><input class="pagelayer-search-field" /><i class="pagelayer-sf-empty pli">&times;</i>'+
			'</div>'+
			'<div class="pagelayer-leftbar-group"><h5>'+pagelayer_l('global_widgets')+'</h5></div>'+
		'</div>';
		
		if(pagelayer_empty(pagelayer_global_widgets)){
			pagelayer_global_widgets = [];
			gHtml += '<div class="pagelayer-leftbar-group"><h5>No global widgets found</h5></div>';
		}

		// Indivdual icon
		for(var y in pagelayer_global_widgets){
			var wEle = jQuery(pagelayer_global_widgets[y]['$']);
			var sc = pagelayer_tag( wEle );
			
			if(!(sc in pagelayer_shortcodes) || 'not_visible' in pagelayer_shortcodes[sc]){
				continue;
			}
			
			gHtml += '<div class="pagelayer-shortcode-drag" draggable="true" pagelayer-tag="'+sc+'" pagelayer-global-id="'+y+'">'+
				'<div class="pagelayer-sc">'+
					'<center class="pagelayer-shortcode-inner">';
					
					if('icon' in pagelayer_shortcodes[sc]){
						gHtml += '<i class="pagelayer-shortcode '+pagelayer_shortcodes[sc]['icon']+'"></i>';
					}else{
						gHtml += '<i class="pagelayer-shortcode pli pagelayer-'+sc+'"></i>';
					}
					
					gHtml += '</center>'+
					'<span class="pagelayer-shortcode-text">'+pagelayer_global_widgets[y]['title']+'</span>'+
				'</div>'+
			'</div>';
			
		}
	
		pagelayer.$$('#pagelayer-global-widget').html(gHtml);
	};
	
	// The widget tabs
	pagelayer.$$('.pagelayer-widget-tab').on('click', function(){	
		var attr = 'pagelayer-elpd-active-tab';
		pagelayer.$$('.pagelayer-widget-tab').each(function(){
			jQuery(this).removeAttr(attr);
		});
		var cEle = jQuery(this);
		cEle.attr(attr, 1);
		
		if(cEle.attr('pagelayer-widget-tab') == 'global'){
			cEle.closest('#pagelayer-shortcodes').find('.pagelayer-shortcodes-widget').addClass('pagelayer-hidden');
			cEle.closest('#pagelayer-shortcodes').find('.pagelayer-global-widget').removeClass('pagelayer-hidden');
			// Trigger create global widgets
			global_widget_list();
		}else{
			cEle.closest('#pagelayer-shortcodes').find('.pagelayer-shortcodes-widget').removeClass('pagelayer-hidden');
			cEle.closest('#pagelayer-shortcodes').find('.pagelayer-global-widget').addClass('pagelayer-hidden');
		}
	});
	
	// On click search empty
	pagelayer.$$('.pagelayer-leftbar-search>.pagelayer-sf-empty').click(function(){
		pagelayer.$$('.pagelayer-search-field').val('').trigger('input');
	});
	
	// Pagelayer General options
	pagelayer.$$('.pagelayer-options-icon ').click(function(){
		pagelayer.$$('.pagelayer-elpd-header').show().find('.pagelayer-elpd-title').text(pagelayer_l('general_options'));
		pagelayer.$$('.pagelayer-logo').hide();
		
		// Setup General options
		pagelayer_setup_general_options();
		
		pagelayer_leftbar_tab('pagelayer-general-options');
		pagelayer_active = {};
	});
	
	// Hide color and typography global list
	pagelayer.$$('.pagelayer-leftbar-table').on('click', function(e){

		var closest = jQuery(e.target).closest('.pagelayer-elp-color-global, .pagelayer-elp-global-icon, .pagelayer-global-color-list, .pagelayer-global-font-list');
		var list = pagelayer.$$('.pagelayer-global-color-list, .pagelayer-global-font-list');

		if(closest.length > 0 ){
			var lEle = closest.closest('.pagelayer-elp-color-div-holder').find('.pagelayer-global-color-list');
			var lFont = closest.closest('.pagelayer-form-item').find('.pagelayer-global-font-list');
			
			list = list.not(lFont);
			list = list.not(lEle);
		}

		list.not(closest).slideUp();
		
	});
};

// Post setting holder
function pagelayer_post_settings(pl_tag, to_click){
	
	to_click = to_click == -1 ? false : true;
	
	// Is there a post settings ?
	var jEle = jQuery(pagelayer_editable+' [pagelayer-tag="'+ pl_tag +'"]');
	
	// Could not find
	if(jEle.length < 1){
		jEle = pagelayer_create_sc(pl_tag);
		var id = pagelayer_id(jEle);
		jQuery(pagelayer_editable).prepend(jEle);
		pagelayer_element_setup('[pagelayer-id='+id+']', true);
		
		// Dont mark as dirty as post_props is not editing anything
		pagelayer_do_undirty();
	}
	
	if(to_click){
		jEle.click();
	}
	
	return jEle;
}

// Get the closest element and method
function pagelayer_near_by_ele(id, sc){
	
	// Get the previous element of the id element
	var prevEle_id = jQuery('[pagelayer-wrap-id="'+id+'"]').prev().attr('pagelayer-wrap-id') || '';
	var method, cEle, args = {};

	if(prevEle_id.length > 0){
		
		// If have previous element of the id element
		// Set the method and previous element selector
		args = {'method' : 'after', 'cEle' : '[pagelayer-wrap-id="'+prevEle_id+'"]'};
		
	}else{
		
		// If don't have previous element of the id element then get parent element
		if(sc == "pl_row"){
			args = {'method' : 'prepend', 'cEle' : pagelayer_editable};
		}else{
			
			// Get the parent element 
			var pEle_id = pagelayer_id(jQuery('[pagelayer-wrap-id="'+id+'"]').closest('.pagelayer-ele'));
			
			// Get the parent element tag
			var pEle_tag = pagelayer_tag(jQuery('[pagelayer-id="'+pEle_id+'"]'));
			var holder = '>'+ pagelayer_shortcodes[pEle_tag]['holder'] || '';
			args = {'method' : 'prepend', 'cEle' : '[pagelayer-id="'+pEle_id+'"] '+ holder+' '};
			
		}
		
	}
	
	return args;
	
};

// Push the action data in the pagelayer_history_obj object
function pagelayer_history_action_push(args){
	
	var currentTime = new Date();
	var history_obj_len = pagelayer_history_obj['action_data'].length;
	
	// If the history_obj_len is less then 1 then set the data in array 0 position 
	if(history_obj_len < 1){
		pagelayer_history_obj['action_data'][0] = {'title' : 'Start Editing', 'action' : 'Start' };
		pagelayer_history_obj['current_active_item_id'] = 0;
	}
	
	// Remove the second array element if the history_obj_len greater then 100
	if(history_obj_len > 100){
		pagelayer_history_obj['action_data'].splice(1, 1);
		pagelayer_history_obj['current_active_item_id'] = pagelayer_history_obj['action_data'].length - 1;
	}
	
	// Get current active history action id 
	var action_id = parseInt(pagelayer_history_obj['current_active_item_id']) || 0;
	
	// Remove the all array element after the active array element  
	var del_ele = history_obj_len - action_id - 1;
	pagelayer_history_obj['action_data'].splice(action_id + 1, del_ele);
	
	// Check if the same attr set as current active history
	if(args.action == "Edited" && history_obj_len > 1 && currentTime - pagelayer.history_lastTime < 1000){
		var atts = pagelayer_history_obj['action_data'][action_id] || '';
		if(atts['atts'] == args['atts'] && atts['pl_id'] == args['pl_id'] && pagelayer_empty(atts['sub_actions_group']) ){
			args['oldVal'] = atts['oldVal'];
			pagelayer_history_obj['action_data'][action_id] = args;
			pagelayer_history_setup();
			
			// Set the last history time
			pagelayer.history_lastTime = currentTime;
			return true;
		}	
	}
	
	// If the action time within 200 millisecond then it count as sub-actions
	if(currentTime - pagelayer.history_lastTime < 200 && history_obj_len > 1){
		
		var cur_action_data = pagelayer_history_obj['action_data'][action_id];
		var sub_actions_len = cur_action_data['sub_actions_group'] || '';
		
		if( !('attrType' in cur_action_data && cur_action_data['attrType'] == 'tmp_attr' && 'attrType' in args && args['attrType'] == 'a_attr') ) {		
			// If the sub_actions_len is less then 1 then set the data in array 0 position 
			if(sub_actions_len.length < 1){
				pagelayer_history_obj['action_data'][action_id]['sub_actions_group'] = [args];
			}else{
				pagelayer_history_obj['action_data'][action_id]['sub_actions_group'].push(args);
			}
		
			return true;
		}
	}
	
	pagelayer_history_obj['action_data'].push(args);
	pagelayer_history_obj['current_active_item_id'] = pagelayer_history_obj['action_data'].length - 1;
	pagelayer_history_setup();
	
	// Set the last history time
	pagelayer.history_lastTime = currentTime;
}

// Setup pagelayer history
function pagelayer_history_setup(force){
	
	var force = force || false;
	
	// If the history tab is visible, only then setup
	if(!pagelayer.$$('#pagelayer-history').is(':visible') && !force){
		return;
	}
	
	// The current active action id
	var current_id = pagelayer_history_obj['current_active_item_id'];
	
	// pagelayer-HISTORY - Element Properties Dialog
	var pagelayer_history_html = '<div class="pagelayer-history-tabs">'+
			'<div class="pagelayer-history-tab" pagelayer-history-tab="actions" pagelayer-history-active-tab="1">Actions</div>'+
			'<div class="pagelayer-history-tab" pagelayer-history-tab="revisions">Revisions</div>'+
		'</div>'+
		'<div class="pagelayer-history-body">'+
			'<div class="pagelayer-history-section active" pagelayer-show-tab="actions">';
	
	// Any actions	
	if(pagelayer_history_obj['action_data'].length > 0){
		
		for(var x in pagelayer_history_obj['action_data']){
			
			if(pagelayer_empty(pagelayer_history_obj['action_data'][x])){continue;}
			
			var title = pagelayer_history_obj['action_data'][x]['title'] || '';
			var subTitle = pagelayer_history_obj['action_data'][x]['subTitle'] || '';
			var action = pagelayer_history_obj['action_data'][x]['action'] || '';
			var tmp_attr = pagelayer_history_obj['action_data'][x]['attrType'] || '';
			var eAttr = '';
			
			if(!pagelayer_empty(tmp_attr) && tmp_attr == "tmp_attr"){
				eAttr = "pagelayer-history-hidden";
			}
			
			pagelayer_history_html += '<div class="pagelayer-history-holder '+((current_id == x) ? 'current_active_item' : '' )+' '+eAttr+'" history-action-id="'+x+'" >'+
				'<div class="pagelayer-history-detail-holder">'+
					'<span class="pagelayer-history-title"><b> '+title+' </b></span>'+
					'<span class="pagelayer-history-subtitle"> '+subTitle+' </span>'+
					'<span class="pagelayer-history-action"><i> '+action+' </i></span>'+
				'</div>'+
				'<div class="pagelayer-history-icon">'+
					'<span class="pagelayer-history-check pli pli-checkmark" aria-hidden="true"></span>'+
				'</div>'+
			'</div>';
		}
		
	}else{
		pagelayer_history_html += 'No Actions history available yet';
	}

	pagelayer_history_html += '</div>'+
	'<div class="pagelayer-history-section" pagelayer-show-tab="revisions">';
	
	// Any revisions ?
	if(pagelayer_revision_obj){
		for(var x in pagelayer_revision_obj){
			pagelayer_history_html += '<div class="pagelayer-revision-holder" revision-id="'+pagelayer_revision_obj[x]['ID']+'">'+
				'<div class="pagelayer-revision-img-holder">'+
					'<img src="'+pagelayer_revision_obj[x]['post_author_url']+'" />'+ 
				'</div>'+
				'<div class="pagelayer-revision-detail-holder">'+
					'<div class="pagelayer-revision-date">'+
						pagelayer_revision_obj[x]['post_date_ago']+
						'('+pagelayer_revision_obj[x]['post_date']+')'+
					'</div>'+
					'<div class="pagelayer-revision-author">'+
						pagelayer_revision_obj[x]['post_type'] +' by '+
						pagelayer_revision_obj[x]['post_author_name']+
					'</div>'+
				'</div>'+
				'<div class="pagelayer-revision-icon-holder">'+
					'<i class="pagelayer-revision-delete pli pli-cross"></i>'+ 
				'</div>'+
			'</div>';
		}
			
	}else{
		pagelayer_history_html += 'No Revisions history available';
	}
		
	pagelayer_history_html += '</div>'+
		'</div>';
	
	// Create the dialog box
	pagelayer.$$('#pagelayer-history').html(pagelayer_history_html);
	var holder = pagelayer.$$('#pagelayer-history');
	
	// Set active history holder
	holder.find('.pagelayer-history-holder').on('click', function(){
		var hEle = jQuery(this);
		var prev_item_id = pagelayer_history_obj['current_active_item_id'];
		hEle.parent().children().removeClass('current_active_item');
		hEle.addClass('current_active_item');
		var do_item_id = parseInt(hEle.attr('history-action-id'));
		pagelayer_history_action_setup(do_item_id, prev_item_id);
	});
	
	// Apply revision
	holder.find('.pagelayer-revision-holder').on('click', function(){
		var revision_id = jQuery(this).attr('revision-id');
		
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_apply_revision&revisionID='+revision_id,
			type: 'post',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				'pagelayer-live' : 1,
			},
			success: function(response, status, xhr){
			
				var obj = jQuery.parseJSON(response);
				if(obj['error']){
					pagelayer_show_msg(obj['error'] , 'error');
				}else{
					
					// Get the current post_name and post_status
					var props = jQuery(pagelayer_editable).find('.pagelayer-post_props');
					var post_name = '', post_status = '';
					
					if(props.length > 0){
						post_name = pagelayer_get_att(props, 'post_name');
						post_status = pagelayer_get_att(props, 'post_status');
					}
					
					// Set content
					jQuery(pagelayer_editable).html(obj['content']);
					
					// Add previous post_name and post_status
					var props_new = jQuery(pagelayer_editable).find('.pagelayer-post_props');
					if(props_new.length > 0){
						
						if(pagelayer_empty(post_name)){
							post_name = pagelayer_default_params.pl_post_props.post_name;
						}
						
						if(pagelayer_empty(post_status)){
							post_status = pagelayer_default_params.pl_post_props.post_status;
						}
						
						var tmp = {};
						tmp['post_name'] = post_name;
						tmp['post_status'] = post_status;
						pagelayer_set_atts(props_new, tmp);
					}
					
					// Need to pass true to render table
					pagelayer_element_setup('.pagelayer-ele', true);
					pagelayer_add_widget();
					pagelayer_show_msg(obj['success'], 'success');
				}
			}
		});
	});
	
	// Delete the revision
	holder.find('.pagelayer-revision-delete').click(function(e){
		
		e.stopPropagation();
		var rEle = jQuery(this).closest('.pagelayer-revision-holder');
		var revision_id = rEle.attr('revision-id');
		
		if(confirm("Are you sure you want to delete the revision ?")){
			jQuery.ajax({
				url: pagelayer_ajax_url+'&action=pagelayer_delete_revision&revisionID='+revision_id,
				type: 'post',
				data: {pagelayer_nonce: pagelayer_ajax_nonce},
				success: function(response, status, xhr){
				
					var obj = jQuery.parseJSON(response);
					if(obj['error']){
						pagelayer_show_msg(obj['error'], 'error');
					}else{
						pagelayer_show_msg(obj['success'], 'success');
						rEle.hide();
					}
					
				}
			});
		}

	});
	
	// The tabs
	holder.find('.pagelayer-history-tab').on('click', function(){	
		var attr = 'pagelayer-history-active-tab';
		holder.find('.pagelayer-history-tab').each(function(){
			jQuery(this).removeAttr(attr);
		});
		jQuery(this).attr(attr, 1);
		
		// Get the active tab
		var active_tab = holder.find('[pagelayer-history-active-tab]').attr('pagelayer-history-tab');
		
		// Trigger the showing of rows
		holder.find('[pagelayer-show-tab]').each(function(){
			var sec = jQuery(this);
			
			// Is it the active tab ? 
			if(sec.attr('pagelayer-show-tab') != active_tab){
				sec.hide();
			}else{
				sec.show();
			}
		});
	});
}

// Get revisions Handler
function pagelayer_get_revision(){

	jQuery.ajax({
		url: pagelayer_ajax_url+'&action=pagelayer_get_revision&postID='+pagelayer_postID,
		type: 'post',
		data: {
			pagelayer_nonce: pagelayer_ajax_nonce,
		},
		//async:false,
		success: function(response, status, xhr){
			var obj = jQuery.parseJSON(response);
			
			if(!pagelayer_empty(obj['error'])){
				pagelayer_show_msg(obj['error'], 'error');
			}else{
				pagelayer_revision_obj = obj;
				pagelayer_history_setup(true);
			}
		}
	});
};

// Do the history action - use for ctrl-z and ctrl-y 
function pagelayer_do_history(action){
	
	var cur_id = pagelayer_history_obj['current_active_item_id'];
	var new_id = cur_id; 
	var action_data_len = pagelayer_history_obj['action_data'].length;
	
	
	if(action == 'undo'){
		
		// You cannot undo from the first movement
		if(cur_id == 0){
			return true;
		}
		
		for(var i = (cur_id - 1); i => 0; i--){
		
			var action = pagelayer_history_obj['action_data'][i];
			
			if('attrType' in action && action['attrType'] == 'tmp_attr'){
				continue;
			}
			
			new_id = i;
			break;
			
		}
		
	}else if(action == 'redo'){
		for(var i = cur_id + 1; i < action_data_len; i++){
			
			var action = pagelayer_history_obj['action_data'][i];
			
			if('attrType' in action && action['attrType'] == 'tmp_attr'){
				continue;
			}
			
			new_id = i;
			break;
			
		}
	}
	
	// Do the action
	pagelayer_history_action_setup(new_id, cur_id);
	pagelayer_history_setup();
	
};

// Action setup handle on ctrl-z and ctrl-y 
function pagelayer_history_action_setup(current_item_id, prev_item_id){
	
	// Set this as the current active
	pagelayer_history_obj['current_active_item_id'] = current_item_id;

	// Delete the element
	var delete_ele = function(id){
		
		// Set Pagelayer History FALSE to prevent saving delete action in action history
		pagelayer.history_action = false;
		
		pagelayer_delete_element('[pagelayer-id='+id+']');
		
		// Set Pagelayer History TRUE
		pagelayer.history_action = true;
		
	};
	
	// Re-setup the element
	var resetup_ele = function(history_array){
		jQuery(history_array.cEle.cEle)[history_array.cEle.method](history_array.html);
		pagelayer_element_setup('[pagelayer-id='+history_array.pl_id+'], [pagelayer-id='+history_array.pl_id+'] .pagelayer-ele', true);
		
		var rEle = jQuery('[pagelayer-id="'+history_array.pl_id+'"]');
		pagelayer_empty_col(rEle.closest('.pagelayer-col-holder'));
		
		pagelayer_do_dirty(rEle);
	};
	
	// Re-setup the element attr
	var reset_ele_attr = function(hEle, atts, val, attrType){
		
		// Set Pagelayer History FALSE to prevent saving attributes in action history
		pagelayer.history_action = false;
		if(attrType == "tmp_attr"){
			pagelayer_set_tmp_atts(hEle, atts, val);
		}else{		
			pagelayer_set_atts(hEle, atts, val);
		}
		
		// The property holder
		var holder = pagelayer.$$('.pagelayer-elpd-body');
		holder.html(' ');
		pagelayer_sc_render(hEle);
		pagelayer_elpd_generate(hEle, holder);
		pagelayer.history_action = true;
		
	};
	
	// Move element
	var pagelayer_move_ele = function(id, move_loc){
		var eWrap = pagelayer_wrap_by_id(id);
		var pCol = eWrap.closest('.pagelayer-col-holder') || '';
		
		jQuery(move_loc.cEle)[move_loc.method](eWrap);
		
		// Ensure the column is not empty
		if(!pagelayer_empty(pCol)){
			pagelayer_empty_col(pCol);
			pagelayer_empty_col(pagelayer_wrap_by_id(id).closest('.pagelayer-col-holder'));
		}

		pagelayer_do_dirty(eWrap);
	};
	
	// Undo actions
	var pagelayer_undo_action = function(history_array){
		var action = history_array.action;
		var id = history_array.pl_id;
		
		if(action == "Edited"){
			hEle = jQuery('[pagelayer-id="'+id+'"]');
			reset_ele_attr(hEle, history_array.atts, history_array.oldVal, history_array.attrType);
		}else if(action == "Added"){
			delete_ele(id);
		}else if(action == "Deleted"){
			resetup_ele(history_array);
		}else if(action == "Copied"){
			delete_ele(id);
		}else if(action == "Moved"){
			pagelayer_move_ele(id, history_array.before_loc);
		}
	};
	
	// Redo actions
	var pagelayer_redo_action = function(history_array){
		var action = history_array.action;
		var id = history_array.pl_id;
		
		if(action == "Edited"){
			hEle = jQuery('[pagelayer-id="'+id+'"]');
			reset_ele_attr(hEle, history_array.atts, history_array.newVal, history_array.attrType);
		}else if(action == "Added"){
			resetup_ele(history_array);
			
			if(history_array.tag != "pl_row" && history_array.tag != "pl_col" ){
				// Ensure the column is not empty
				pagelayer_empty_col(history_array.cEle.cEle);
			}
		}else if(action == "Deleted"){
			delete_ele(id);
		}else if(action == "Copied"){
			resetup_ele(history_array);
		}else if(action == "Moved"){
			pagelayer_move_ele(id, history_array.after_loc);
		}
	};
	
	if(prev_item_id > current_item_id){
			
		// All Actions for undo here
		var i = parseInt(prev_item_id);
		
		for(i; i > current_item_id; i--){
			
			var history_array = pagelayer_history_obj['action_data'][i];
			var sub_actions_group = history_array['sub_actions_group'] || '';
			
			// If it has sub-actions
			if(!pagelayer_empty(sub_actions_group)){
				var j = sub_actions_group.length;
				for(j--; j >= 0; j--){
					pagelayer_undo_action(sub_actions_group[j]);
				}
			}
			
			// Main action
			pagelayer_undo_action(history_array);
			
			// Activate the current element and scroll it into viewport
			var jEle = jQuery('[pagelayer-id="'+history_array.pl_id+'"]');
			if(jEle.length > 0){
				pagelayer_set_active(jEle);
				pagelayer_scroll_to_viewport(jEle, 0);
			}
		}
		
	}else{
				
		// All Actions for redo here
		var i = parseInt(prev_item_id)+1;
		
		for(i; i <= current_item_id; i++){
			
			var history_array = pagelayer_history_obj['action_data'][i];
			var sub_actions_group = history_array['sub_actions_group'] || '';
			// Main action
			pagelayer_redo_action(history_array);
			
			// If it has sub-actions
			if(!pagelayer_empty(sub_actions_group)){
				for(var x in sub_actions_group){
					pagelayer_redo_action(sub_actions_group[x]);
				}
			}
			
			// Activate the current element and scroll it into viewport
			var jEle = jQuery('[pagelayer-id="'+history_array.pl_id+'"]');
			if(jEle.length > 0){
				pagelayer_set_active(jEle);
				pagelayer_scroll_to_viewport(jEle, 0);
			}
		}
	}
	
};

// Report an error
function pagelayer_error(error, func){
	var prefix = func || '';
	alert(prefix+error);
};

function pagelayer_bottombar(){
	var holder = pagelayer.$$('.pagelayer-bottombar-holder');
	var html = '<div class="pagelayer-bottombar">'+
		'<div class="pagelayer-bottombar-rightbuttons">'+
			'<button data-tlite="Save Changes" class="pagelayer-update-button pagelayer-success-btn">'+
				'<span class="pagelayer-update-loader">'+
					'<span></span>'+
					'<span></span>'+
					'<span></span>'+
				'</span>'+
				'<span class="pagelayer-update-text">Update</span>'+
			'</button>'+
			'<button data-tlite="Close and Return to Admin Panel" class="pagelayer-close-button">Close</button>'+
			'<div class="pagelayer-mode-wrapper">'+
				'<div class="pagelayer-mode-buttons-wrapper">'+
					'<i class="screen-mode pli pli-desktop" pagelayer-mode-data="desktop"></i>'+
					'<i class="screen-mode pli pli-tablet" pagelayer-mode-data="tablet"></i>'+
					'<i class="screen-mode pli pli-mobile" pagelayer-mode-data="mobile"></i>'+
				'</div>'+
			'</div>'+
			'<i class="pagelayer-mode-button pli pli-desktop"></i>'+
			'<span data-tlite="'+pagelayer_l('preview_changes')+'"><i class="pagelayer-preview pli pli-eye"></i></span>'+
			'<span data-tlite="'+pagelayer_l('historyand_revisions')+'"><i class="pagelayer-history-icon pli pli-history"></i></span>'+
			'<span data-tlite="'+pagelayer_l('navigator')+'"><i class="pagelayer-navigator-icon pli pli-tree"></i></span>'+
			//'<span data-tlite="Close and Return to Admin Panel"><i class="pagelayer-close-button fa fa-close"></i></span>'+
		'</div>'+
	'</div>';
	
	holder.html(html);
	holder.find('.pagelayer-update-button').on('click', function(){
		pagelayer_save();
		pagelayer_history_setup();// Setup history tab after update
	});
	
	holder.find('.pagelayer-close-button').on('click', function(){
		pagelayer_close();
	});
	holder.find('.screen-mode').on('click', function(){
		var screen_mode = jQuery(this).attr('pagelayer-mode-data');
		pagelayer_set_screen_mode(screen_mode);
		holder.find('.pagelayer-mode-buttons-wrapper').toggle();
	});
	
	holder.find('.pagelayer-mode-button').on('click', function(){
		holder.find('.pagelayer-mode-buttons-wrapper').toggle();
	});
	
	holder.find('.pagelayer-history-icon').click(function(){
		pagelayer.$$('.pagelayer-elpd-header').show().find('.pagelayer-elpd-title').text(pagelayer_l('pagelayer_history'));
		pagelayer.$$('.pagelayer-logo').hide();
		pagelayer_leftbar_tab('pagelayer-history');
		pagelayer_active = {};
		pagelayer_history_setup();	
	});
	
	holder.find('.pagelayer-navigator-icon').click(function(){
		pagelayer.$$('.pagelayer-elpd-header').show().find('.pagelayer-elpd-title').text(pagelayer_l('pagelayer_navigator'));
		pagelayer.$$('.pagelayer-logo').hide();
		
		// If the navigator tab visible, then don't setup 
		if(!pagelayer.$$('#pagelayer-navigator').is(':visible')){
			pagelayer_navigator_setup();
		}
		
		pagelayer_leftbar_tab('pagelayer-navigator');
		pagelayer_active = {};
	});
	
	holder.find('.pagelayer-preview').click(function(){
		
		// If the page is not dirty
		if(!pagelayer_isDirty){
			
			// Open in new tab the existing page itself
			window.open(pagelayer_post_permalink, '_blank');
			return;
			
		}
		
		// Get post content
		var post = pagelayer_generate_sc(pagelayer_editable);//alert(post);return;
		
		pagelayer.$$('.pagelayer-body').css({'opacity' : '0.33'});
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_create_post_autosave&postID='+pagelayer_postID,
			type: 'POST',
			data: {
				'pagelayer_nonce': pagelayer_ajax_nonce,
				'pagelayer_post_content': pagelayer_Base64.encode(post)
			},
			success: function(data) {
				var data = JSON.parse(data);
				
				// If there is some error
				if(!pagelayer_empty(data['error']) || pagelayer_empty(data['id'])){
					pagelayer_show_msg('Unable to set preview for some reason', 'error');
					return;
				}
				
				var url = data['url']+'&preview_id='+pagelayer_postID+'&preview_nonce='+
				pagelayer_preview_nonce;
				
				// Open in new tab
				window.open(url, '_blank');
			},
			complete: function(){
				pagelayer.$$('.pagelayer-body').css({'opacity' : '1'});
			}
		});
	});
};


///////////////////////////////
// Miscellaneuos Functions
///////////////////////////////

// Setup General options
function pagelayer_setup_general_options(){
	
	var holder = pagelayer.$$('.pagelayer-general-options');
  
	if(holder.children().length > 0){
		return;
	}
  
	// TODO: To create this HTML get Array form php
	var html = '<div class="pagelayer-options-sections">'+
		'<h5>'+ pagelayer_l('general_options') +'</h5>'+
		'<div class="pagelayer-option-holder pagelayer-open-customizer">'+
			'<i class="fas fa-paint-brush"></i>'+
			'<span>'+ pagelayer_l('customize') +'</span>'+
		'</div>'+
	'</div>'+
	'<div class="pagelayer-options-sections">'+
		'<h5>'+ pagelayer_l('navigator_options') +'</h5>'+
		'<div class="pagelayer-option-holder pagelayer-options-history-icon">'+
			'<i class="pli pli-history"></i>'+
			'<span>'+ pagelayer_l('historyand_revisions') +'</span>'+
		'</div>'+
		'<div class="pagelayer-option-holder pagelayer-options-navigator-icon">'+
			'<i class="pli pli-tree"></i>'+
			'<span>'+ pagelayer_l('navigator') +'</span>'+
		'</div>'+
		'<div class="pagelayer-option-holder pagelayer-options-preview">'+
			'<i class="pli pli-eye"></i>'+
			'<span>'+ pagelayer_l('preview_changes') +'</span>'+
		'</div>'+
	'</div>'+
	'<div class="pagelayer-options-sections">'+
		'<h5>'+ pagelayer_l('tools') +'</h5>'+
		'<div class="pagelayer-option-holder pagelayer-open-help">'+
			'<i class="fas fa-question"></i>'+
			'<span>'+ pagelayer_l('help') +'</span>'+
		'</div>'+
		'<div class="pagelayer-option-holder pagelayer-open-keyboard-shortcuts">'+
			'<i class="far fa-keyboard"></i>'+
			'<span>'+ pagelayer_l('keyboard_shortcuts') +'</span>'+
		'</div>'+
	'</div>';
	
	holder.html(html);
	
	// Open customizer settings
	holder.find('.pagelayer-open-customizer').click(function(){
		window.open(pagelayer_customizer_url+'&autofocus%5Bpanel%5D=pagelayer_settings', '_blank');
	});
	
	// Open help / support link
	holder.find('.pagelayer-open-help').click(function(){
		 window.open(pagelayer_support_url, '_blank');
	});
	
	// Show Pagelayer History
	holder.find('.pagelayer-options-history-icon').click(function(){
		pagelayer.$$('.pagelayer-bottombar-holder .pagelayer-history-icon').click();
	});
	
	// Show Pagelayer Navigator
	holder.find('.pagelayer-options-navigator-icon').click(function(){
		pagelayer.$$('.pagelayer-bottombar-holder .pagelayer-navigator-icon').click();
	});
	
	// Show Pagelayer Preview
	holder.find('.pagelayer-options-preview').click(function(){
		pagelayer.$$('.pagelayer-bottombar-holder .pagelayer-preview').click();
	});
	
	// Show keyboard shortcut modal
	holder.find('.pagelayer-open-keyboard-shortcuts').click(function() {
		
		var modal = pagelayer.$$('.pagelayer-shortcuts-modal');
		modal.css('display','flex');
		
		modal.find('.pagelayer-editor-modal-close-icon').unbind('click');
		modal.find('.pagelayer-editor-modal-close-icon').click(function(){
			modal.hide();
		});

		modal.unbind('click');
		modal.on('click', function(e){
			
			if(e.target != this) {
				return;
			}
      
			modal.hide();
		});
	});
}

// Setup navigator
function pagelayer_navigator_setup(){
	
	var navigator_ele = pagelayer.$$('#pagelayer-navigator'),
	navigator_padding = 10,
	navigator_html = '';
		
	// Get the child elements list
	var pagelayer_create_navi_list = function(selector){
		
		var navigator_list = '';
		
		selector.children('.pagelayer-ele-wrap, .pagelayer-ele').each(function(){
			
			var cEle = jQuery(this),
			tag = pagelayer_tag(cEle),
			id = pagelayer_id(cEle),
			child_ele = false,
			ele_class = '';
			
			// If tag is not found then return
			if(pagelayer_empty(tag)){
				return;
			}
			
			// if is row or  col or inner-row
			if(tag == 'pl_row' || tag == 'pl_col' || tag == 'pl_inner_row'){
				ele_class = 'pagelayer-navigator-toggle';
				child_ele = true;
			}
			
			navigator_list += '<div class="pagelayer-navigetor-ele" pagelayer-id="'+id+'">'+
				'<div class="pagelayer-ele-name '+ ele_class +'" pagelayer-tag="'+tag+'" style="padding-left:'+navigator_padding+'px">'+
					'<i class="fa pagalayer-arrow"></i><i class="fa pagelayer-'+tag+'"></i>'+
					pagelayer_shortcodes[tag]['name']+
					'<span class="pagelayer-navigator-options"><i class="pli pli-pencil" data-action="edit"></i><i class="pli pli-trashcan" data-action="delete"></i></span>'+
				'</div>';
			
			// Create the list of child element 
			if(child_ele){
				navigator_padding += 15; // Increment padding left for widget
				navigator_list += pagelayer_create_navi_list( cEle.find(pagelayer_shortcodes[tag]['holder']).first() );
				navigator_padding -= 15; // Decrement padding left for widget
			}
			
			navigator_list += '</div>';
		});
		
		return navigator_list;
	}
	
	// Create list of all rows and their child widgets 
	jQuery(pagelayer_editable).children('.pagelayer-wrap-row').each(function(){
		navigator_html += pagelayer_create_navi_list(jQuery(this));
	});
		
	// Put the navigator list
	navigator_ele.html('<div class="pagelayer-leftbar-prop-body">'+navigator_html+'</div>');
	
	// edit and delete element click handler
	navigator_ele.find('.pagelayer-navigator-options .pli').on('click', function(event){
		
		var sEle = jQuery(this).closest('.pagelayer-navigetor-ele');
		var sId = sEle.attr('pagelayer-id');
		var action = jQuery(this).data('action');
		if( action == 'edit'){
			pagelayer_edit_element('[pagelayer-id = '+sId+']', event);
		}else if(action == 'delete'){
			sEle.find('.pagelayer-ele-name').css({'background':'rgb(255, 114, 114)','opacity':'0.5'});
			pagelayer_delete_element('[pagelayer-id = '+sId+']');
		}
		
	});
	
	// On click toggle the element
	navigator_ele.find('.pagelayer-ele-name').on('click', function(){
		
		var tEle = jQuery(this);
		var pl_id = tEle.parent().attr('pagelayer-id'); // Get Pagelayer id
		var jEle = pagelayer_ele_by_id(pl_id);
		
		// If the class "pagelayer-navigator-toggle" exist then toggle
		if(tEle.hasClass('pagelayer-navigator-toggle')){
			tEle.parent().toggleClass('pagelayer-navigator-open');
		}
		
		// Also open all parents 
		tEle.parent().parents('.pagelayer-navigetor-ele').addClass('pagelayer-navigator-open');
			
		// Set the click element active
		navigator_ele.find('.pagelayer-ele-name').removeClass('pagelayer-navi-active');
		tEle.addClass('pagelayer-navi-active')
		
		// Set the element active
		if(jEle.length > 0){
			//pagelayer_active.el = pagelayer_data(jEle);
			pagelayer_set_active(jEle);
			pagelayer_scroll_to_viewport(jEle);
		}
		
	});
	
	// Do active ele tab open
	if( pagelayer_active.el && pagelayer_active.el.id ){
		navigator_ele.find('[pagelayer-id="'+pagelayer_active.el.id+'"]').children('.pagelayer-ele-name').click();
	}
	
	/* var posY = 0, orig_eleY= 0;
	
	// On mouse down in pagelayer-ele-name
	navigator_ele.find('.pagelayer-ele-name').on('mousedown', function(e){
		e = e || window.event;
		e.preventDefault();
		
		// Get ele position
		orig_eleY = jQuery(this).offset().top;
		
		// Get the mouse cursor  at startup:
		posY = e.clientY;
		
		// The variable needs to be empty.
		newMethod = '';
		
		// Mouse up handler
		var ele_mousemove = function(){
			
		}
		
		// Mouse move handler
		var ele_mouseup = function(){
			pagelayer.$$(document).off('mouseup', ele_mouseup);
			pagelayer.$$(document).off('mousemove', ele_mousemove);
		}
		
		pagelayer.$$(document).on('mouseup', ele_mouseup);
		pagelayer.$$(document).on('mousemove', ele_mousemove);

	}); */
	
	
}

// Scroll page to element view port
function pagelayer_scroll_to_viewport(jEle, timeout, parentEle){
	
	var scrolled = parentEle || jQuery('html, body');
	timeout = timeout || 500;
	parentEle = parentEle || jQuery(window);
	
	setTimeout(function(){
		var parentHeight = parentEle.height(),
		parentScrollTop = parentEle.scrollTop(),
		elementTop = jEle.offset().top,
		topToCheck = elementTop - parentScrollTop;
		  
		if (topToCheck > 0 && topToCheck < parentHeight) {
			return;
		}

		var scrolling = elementTop - parentHeight / 2;
		scrolled.stop(true).animate({
			scrollTop: scrolling
		}, 1000);
	}, timeout);
}

// Generates a random string of "n" characters
function pagelayer_randstr(n, special){
	var text = '';
	var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	special = special || 0;
	if(special){
		possible = possible + '&#$%@';
	}
	
	for(var i=0; i < n; i++){
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	}

	return text;
};

function pagelayer_randInt(max) {
	return Math.floor(Math.random() * Math.floor(max));
}

// Convert the regular URL of a Video to a Embed URL
function pagelayer_video_url(src, no_url){
  
	no_url = no_url || false;
	var youtubeRegExp = /youtube\.com|youtu\.be/;
	var vimeoRegExp = /vimeo\.com/;
	var match = '';
	var videoId = '';
	var vid_params = {};
		
	if (youtubeRegExp.exec(src)) {
		match = 'youtube';
	} else if (vimeoRegExp.exec(src)) {
		match = 'vimeo';
	}
	
	switch(match){
		case 'youtube':
				
			var youtubeRegExp1 = /youtube\.com/;
			var youtubewatch = /watch/;
			var youtubeembed = /embed/;
			var youtube = /youtu\.be/;

			if (youtubeRegExp1.exec(src)) {
				
				if (youtubewatch.exec(src)) {
					 videoId = src.split('?v=');
										
				} else if (youtubewatch.exec(src)) {
					videoId = src.split('embed/');
				}
				
			} else if (youtube.exec(src)) {
				videoId = src.split('.be/');
			}
			
			vid_params = {
				type : 'youtube',
				src : '//youtube.com/embed/'+videoId[1],
				id : videoId[1]
			};

			pagelayer_yt_api_register();
			
			break;
			
		case 'vimeo':
		
			var vimeoplayer = /player\.vimeo\.com/;
			var vimeovideo = /video/;
			
			if (vimeoplayer.exec(src) && vimeovideo.exec(src)) {
				videoId = src.split('video/');
			} else if (vimeoRegExp.exec(src)) {
				videoId = src.split('.com/');
			}
			
			vid_params = {
				type : 'vimeo',
				src : '//player.vimeo.com/video/'+videoId[1],
				id : videoId[1]
			};
			
			break;
		default:
			vid_params = {
				type : 'local',
				src : src
			};
			
	}
  
	if(!no_url){
		return vid_params.src;
	}
  
	return vid_params;
};

// Youtube API Register
function pagelayer_yt_api_register(){

	if(jQuery('#pagelayer-youtube-script-js').length > 0){
		return;
	}

	jQuery('body').append('<script src="https://www.youtube.com/iframe_api" id="pagelayer-youtube-script-js"></script>');

}

// Add widget section
function pagelayer_add_widget(){
	
	html='<div class="pagelayer-add-widget-area">'+
		'<button class="pagelayer-add-button pagelayer-add-section"><i class="pagelayer-add-row fas fa-file-alt"></i> &nbsp;Add New Section</button>'+
		'<button class="pagelayer-add-button pagelayer-add-row"><i class="pagelayer-add-row fas fa-plus-circle"></i> &nbsp;Add New Row</button>'+
		'<p>Click here to add new row OR drag widgets</p>'+
	'</div>';
	
	jQuery(pagelayer_editable).append(html);
	
	var add_area = jQuery('.pagelayer-add-widget-area');
	
	// Add a code before this
	var add_sc = function(tag, global_id = ''){
		
		var attr = '';
		if(!pagelayer_empty(global_id)){
			attr = ' pagelayer-global-id="'+global_id+'" ';
		}
		
		// Create Row		
		var row = jQuery('<div pagelayer-tag="pl_row" '+((tag == 'pl_row') ? attr : '') +'></div>');
		add_area.before(row);
		var row_id = pagelayer_onadd(row, false);
		var rEle = pagelayer_ele_by_id(row_id);
		
		if(tag == 'pl_row' && !pagelayer_empty(global_id)){
			rEle.click();
			return row_id;
		}
		
		// Create Column
		var col = jQuery('<div pagelayer-tag="pl_col" '+((tag == 'pl_col') ? attr : '') +'></div>');
		rEle.find('.pagelayer-row-holder').append(col);
		var col_id = pagelayer_onadd(col, false);
		var cEle = pagelayer_ele_by_id(col_id);
		
		
		if(tag == 'pl_row'){
			rEle.click();
			return row_id;
		}
		
		if(tag == 'pl_col'){
			cEle.click();
			return col_id;
		}
		
		// Create element
		var ele = jQuery('<div pagelayer-tag="'+tag+'" '+attr+'></div>');
		cEle.find('.pagelayer-col-holder').append(ele);
		//console.log(ele);
		var id = pagelayer_onadd(ele);
		//console.log(id);
		//console.log(col_id);
		var eEle = pagelayer_ele_by_id(col_id);
		//console.log(eEle);
		// Ensure the column is not empty
		pagelayer_empty_col(cEle.find('.pagelayer-col-holder'));
		
		if(tag == 'pl_inner_row' && pagelayer_empty(global_id)){
			// Create Column
			var in_col = jQuery('<div pagelayer-tag="pl_col"></div>');
			eEle.find('.pagelayer-row-holder').append(in_col);
			var in_col_id = pagelayer_onadd(in_col, false);
		}
		
		return id;
		
	}
	
	// Handle Click
	add_area.on('click', function(e){
		e.stopPropagation();
		add_sc('pl_col');
	});
	
	// Handle Click
	add_area.find('.pagelayer-add-section').on('click', function(e){
		e.stopPropagation();
		pagelayer_add_section_area();// Setup and show sections modal
	});
	
	// Handle Drag over
	add_area.on('dragover', function(e){
		//console.log(e)
		add_area.addClass('pagelayer-add-widget-drag');
	});
	
	// Handle Drag Leave
	add_area.on('dragleave', function(e){
		//console.log(e)
		add_area.removeClass('pagelayer-add-widget-drag');
	});
	
	// Handle On Drop
	add_area.on('drop', function(e){
		
		//console.log(e);
		//console.log(e.originalEvent.dataTransfer.getData('tag'));
		add_area.removeClass('pagelayer-add-widget-drag');
		jQuery('.pagelayer-is-dragging').removeClass('pagelayer-is-dragging');
		
		var tag = e.originalEvent.dataTransfer.getData('tag');
		var global_id = e.originalEvent.dataTransfer.getData('global_id');
		
		// Is it an existing element ?
		if(tag.length < 1){
			return false;
		}
		
		e.preventDefault();
		
		//console.log(tag);
		
		add_sc(tag, global_id);
	});
};

// Is the element in view while scrolling
function pagelayer_isElementInView(elem, holder, partial) {
	partial = partial || true;
	var container = jQuery(holder);
	var contHeight = container.height();
	var contTop = container.scrollTop();
	var contBottom = contTop + contHeight ;

	var elemTop = jQuery(elem).offset().top - container.offset().top;
	var elemBottom = elemTop + jQuery(elem).height();

	var isTotal = (elemTop >= 0 && elemBottom <=contHeight);
	var isPart = ((elemTop < 0 && elemBottom > 0 ) || (elemTop > 0 && elemTop <= container.height())) && partial;

	return isTotal || isPart ;
}

// Append section modal into body
function pagelayer_add_section_area(){
	
	var body = pagelayer.$$('body');
	var mEle = body.find('.pagelayer-add-section-modal-container');
	
	if(mEle.length > 0){
		mEle.show();
		return;
	}
	
	var section_modal = '<div class="pagelayer-add-section-modal-container">'+
		'<div class="pagelayer-add-section-modal-holder">'+
			'<div class="pagelayer-add-section-modal">'+
				'<div class="pagelayer-add-section-modal-header">'+
					'<div>Add Sections</div>'+
					'<div class="pagelayer-section-type-div">Type : '+
						'<select name="type" id="pagelayer-section-type">'+
							'<option value="section">Sections</option>'+
							'<option value="header">Headers</option>'+
							'<option value="footer">Footers</option>'+
							'<option value="page">Pages</option>'+
						'</select>'+
					'</div>'+
					'<div class="pagelayer-add-section-modal-close">&times;</div>'+
				'</div>'+
				'<div class="pagelayer-add-section-modal-row">'+
					'<div class="pagelayer-add-section-modal-left">'+
						'<div class="pagelayer-section-search-div">'+
							'<i class="pli pli-search" ></i><input class="pagelayer-section-search" /><span class="pagelayer-sf-empty pli">&times;</span>'+
						'</div>'+
						'<div class="pagelayer-section-tags-holder"></div>'+
					'</div>'+
					'<div class="pagelayer-section-modal-body-holder">'+
						'<div class="pagelayer-add-section-modal-body"></div>'+
					'</div>'+
				'</div>'+
				'<div class="pagelayer-add-section-modal-overlay" style="display:none;">'+
					'<div class="pagelayer-section-wait">'+
						'<div class="pagelayer-loader">'+
							'<div class="pagelayer-percent-parent"></div>'+
						'</div><br/>'+
						'<span>Please wait a moment</span>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	
	mEle = jQuery(section_modal);
	
	// Append the element in the body
	body.append(mEle);
	
	// On click close modal 
	mEle.find('.pagelayer-add-section-modal-close').on('click', function(){
		mEle.hide();
	});
	
	// Search Empty
	mEle.find('.pagelayer-sf-empty').on('click', function(){
		mEle.find('.pagelayer-section-search').val('');
	});
	
	// On select section type 
	mEle.find('#pagelayer-section-type').on('change', function(){
		var val = jQuery(this).val();
		pagelayer_add_sections_list_setup(val);
	});
	
	// Append the list items into modal body
	pagelayer_add_sections_list_setup();
	
	mEle.show();// Show the modal
	
};

// Append section list into modal body
function pagelayer_add_sections_list_setup(type){
	
	var mEle = pagelayer.$$('.pagelayer-add-section-modal-container');
	var body = mEle.find('.pagelayer-add-section-modal-body');
	var add_area = jQuery('.pagelayer-add-widget-area');
	type = type || 'section';
	
	// Find the number of cols
	var body_width = jQuery(window.parent).width();
	var num_cols = 3;
	if(body_width >= 1500){
		num_cols = 4;
	}else if(body_width >= 992){
		num_cols = 3;
	}else if(body_width >= 768){
		num_cols = 2;
	}else if(body_width >= 360){
		num_cols = 1;
	}
	//console.log(num_cols+' - '+body_width);
	
	var viewer = '<div class="pagelayer-section-is-visible"></div>';
	var selected_tags = {};
	var result_set = {};
	
	// Setup the scroll
	mEle.find('.pagelayer-section-tags-holder').slimScroll({
		height: 'calc(100vh - 150px)',
		railVisible: false,
		alwaysVisible: true,
		color: '#000',
		size: '5px',
	});
	
	// Create list of items
	var pagelayer_section_list = function(){
		
		// List the tags
		if(!pagelayer_empty(pagelayer_add_section_data[type]['tags'])){
			var tags_html = '';
			var tags = pagelayer_add_section_data[type]['tags'];
			for(var k in tags){
				tags_html += '<span class="pagelayer-section-tags" tag="'+k+'">'+k+' ('+tags[k].length+')</span>';				
			}
			mEle.find('.pagelayer-section-tags-holder').html(tags_html);
			
			// Handle tag click
			mEle.find('.pagelayer-section-tags').unbind('click');
			mEle.find('.pagelayer-section-tags').on('click', function(e){
				
				var search = mEle.find('.pagelayer-section-search');
				
				// Blank the search
				if(search.val().length > 0){
					search.val('');
					selected_tags = {};
				}
				
				// Fill the selected_tags
				tEle = jQuery(this);
				var tag = tEle.attr('tag')
				
				if(tEle.attr('on') == '1'){
					delete selected_tags[tag];
					tEle.removeAttr('on');
				}else{
					tEle.attr('on', 1);
					selected_tags[tag] = 1;
				}
				
				// Filter
				pagelayer_section_filter(false, 1);
				
			});
		}
		
		// Fill in the result
		result_set = { ...pagelayer_add_section_data[type]['list']};
		
		show_result();
		
	};
	
	// How the result and setup scroll
	var show_result = function(){
		
		var html = '';
		for(var i = 0; i < num_cols; i++){
			html += '<div class="pagelayer-section-holder" pagelayer-section-type="'+type+'" num="'+i+'"></div>';
		}
		
		// Blank the body
		body.html(html+viewer);
		
		mEle.find('.pagelayer-section-modal-body-holder').unbind('scroll');
		mEle.find('.pagelayer-section-modal-body-holder').on('scroll', pagelayer_section_body_scroll);
		pagelayer_section_body_scroll();
	}
	
	var scroll_accessed = false;
	
	// Section body ON scroll
	var pagelayer_section_body_scroll = function(){
		
		// Check if there is anything to display in the first place, as we do delete pagelayer_add_section_data
		if(pagelayer_empty(result_set)){
			return;
		}
		
		var tester = mEle.find('.pagelayer-section-is-visible');
		var modal = mEle.find('.pagelayer-section-modal-body-holder');
		
		// If we have scroll
		if(!pagelayer_isElementInView(tester, modal) || scroll_accessed){
			return;
		}
		
		scroll_accessed = true;
		
		var html = '';
		var i = 0;
		
		// Loop result_set
		for(var id in result_set){
			
			if(i >= (num_cols * 5)){
				break;
			}
			
			var col = i % num_cols;
			//console.log(col);
			
			i++;
			
			var pro = 0;
			
			// Is it pro ?
			if(!pagelayer_empty(result_set[id]) && pagelayer_empty(pagelayer_pro)){
				pro = 1;
			}
			
			html = '<div class="pagelayer-section-item" pagelayer-section-type="'+type+'" pagelayer-add-section-id="'+id+'">'+
			'<img src="'+ pagelayer_add_section_data[type]['image_url'] + id +'/screenshot.jpg" alt="Pagelayer code screenshot" />'+
			(pro ? '<div class="pagelayer-section-pro-req">Pro</div><div class="pagelayer-section-pro-txt">'+pagelayer.pro_txt+'</div>' : '')+
			'</div>';
			
			body.find('.pagelayer-section-holder[num='+col+']').append(html);
			
			delete result_set[id];
			
		}
		
		//console.log(result_set);
		
		mEle.find('.pagelayer-section-item').unbind('click');
		mEle.find('.pagelayer-section-item').on('click', function(e){
			pagelayer_section_item_clickable(jQuery(this));
		});
		
		scroll_accessed = false;
		
	}
	
	// If we have searched something / or clicked tags
	var pagelayer_section_filter = function(event, not_input){
				
		var txt = mEle.find('.pagelayer-section-search').val();
		var tags = pagelayer_add_section_data[type]['tags'];
		
		// Searched anything
		if(!pagelayer_empty(txt) || pagelayer_empty(not_input)){
		
			// Blank the tags
			selected_tags = {};
			
			mEle.find('.pagelayer-section-tags').removeAttr('on');
			
			for(var k in tags){
				if(k.search(txt) >= 0){
					selected_tags[k] = 1;
					mEle.find('.pagelayer-section-tags[tag="'+k+'"]').attr('on', 1);
				}
			}
			
		}
		
		var new_result = {};
		var new_length = 0;
		
		// Filter the content
		for(var t in selected_tags){
			
			for(var i in tags[t]){
				new_length++;
				new_result[tags[t][i]] = tags[t][i];
			}
			
		}
		
		// Copy the result
		result_set = {...new_result};
		//console.log(type);console.log(selected_tags);console.log(result_set);
		
		show_result();
		
	}
	
	// On search change
	mEle.find('.pagelayer-section-search').unbind('input');
	mEle.find('.pagelayer-section-search').on('input', pagelayer_section_filter);
	
	// On click items
	var pagelayer_section_item_clickable = function(jEle){
		
		var section_id = jEle.attr('pagelayer-add-section-id');
		
		// IF section id not found
		if(pagelayer_empty(section_id)){
			return false;
		}
		
		if(jEle.find('.pagelayer-section-pro-req').length > 0){
			return false;
		}
		
		// Show the overlay
		mEle.find('.pagelayer-add-section-modal-overlay').show();
		
		// Do shortcode the content
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_get_section_shortcodes&postID='+pagelayer_postID,
			type: 'POST',
			data: {
				'pagelayer_nonce': pagelayer_ajax_nonce,
				'pagelayer_section_id': section_id,
				'pagelayer-live': 1
			},
			success: function(data) {
				
				try{
					
					var data = JSON.parse(data);
					
					if(!pagelayer_empty(data['error'])){
						pagelayer_show_msg('Error getting the section', 'error');						
						mEle.find('.pagelayer-add-section-modal-overlay').hide();
						mEle.hide();
						return;
					}
					
					var cEle = jQuery(data['code']);
					
					// Add section before add widget area
					add_area.before(cEle);
					
					// We need to it setup
					cEle.each(function(){
						var pl_id = pagelayer_id(jQuery(this));
						
						if(!pagelayer_empty(pl_id)){
							pagelayer_element_setup('[pagelayer-id="'+pl_id+'"], [pagelayer-id='+pl_id+'] .pagelayer-ele', true);
						}
					});
				
				}catch(e){
					pagelayer_show_msg('Error getting the section', 'error');						
					mEle.find('.pagelayer-add-section-modal-overlay').hide();
					mEle.hide();
					return;
				}
				
			},
			complete: function(){
				mEle.find('.pagelayer-add-section-modal-overlay').hide();
				mEle.hide();
			}
		});	
	}
	
	// Load the data if not there
	if(!(type in pagelayer_add_section_data)){
		
		// Show the loading
		mEle.find('.pagelayer-add-section-modal-overlay').show();
		
		// Get the sections list data and append it
		jQuery.ajax({
			url: pagelayer_api_url+'/library.php?give='+type,
			type: 'post',
			success: function(response){
				var tmp = JSON.parse(response);
				
				// Is the list there ?
				if( !('list' in tmp && !pagelayer_empty(tmp['list'])) ){
					return;
				}
				
				pagelayer_add_section_data[type] = tmp;
				
				// Create the Type
				pagelayer_section_list(type);
				
				// Hide the loading
				mEle.find('.pagelayer-add-section-modal-overlay').hide();
				
			},
			complete: function(){
				mEle.find('.pagelayer-add-section-modal-overlay').hide();
			}
		});
	
	// We have the data, so show it
	}else{
		pagelayer_section_list(type);
	}
}

// Upload an image
function pagelayer_upload_image(fileName, blob, pagelayer_ajax_func){
	
	var formData = new FormData();
	formData.append('action', 'upload-attachment');
	formData.append('_ajax_nonce', pagelayer_media_ajax_nonce);
	formData.append('async-upload', blob, fileName);
	
	jQuery.ajax({
		url:pagelayer_ajax_url,
		data: formData,// the formData function is available in almost all new browsers.
		type:"post",
		contentType:false,
		processData:false,
		cache:false,
		beforeSend: function( xhr ) {
			if(typeof pagelayer_ajax_func.beforeSend == 'function'){
				pagelayer_ajax_func.beforeSend(xhr);						
			}
		},		
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			if(typeof pagelayer_ajax_func.uploadProgress == 'function'){
				xhr = pagelayer_ajax_func.uploadProgress(xhr);						
			}
		  return xhr;
		},		
		error:function(err){
			//console.error(err);
			pagelayer_show_msg('Unable to upload image for some reason.', 'error');						
		},
		success:function(response){
			var obj = jQuery.parseJSON(response);
			if(typeof pagelayer_ajax_func.success == 'function'){
				pagelayer_ajax_func.success(obj);						
			}
		},
		complete:function(xhr){
			if(typeof pagelayer_ajax_func.complete == 'function'){
				pagelayer_ajax_func.complete(xhr);						
			}
		}
	});
};

// On editable area image paste handler
function pagelayer_editable_paste_handler(pasteEvent, pagelayer_ajax_func){
	var items,
	is_Paste = (pasteEvent.type == 'paste' ? true : false),
	mustPreventDefault = false,
	reader;

	try {
		if(is_Paste){
			items = (pasteEvent.originalEvent || pasteEvent).clipboardData.items;			
		}else{
			items = [pasteEvent];
		}
		
		for (var i = items.length - 1; i >= 0; i -= 1) {

			if (items[i].type.match(/^image\//)) {
				
				reader = new FileReader();
				/* jshint -W083 */
				reader.onloadend = function(event) {
					
					var src = event.target.result;		
					
					if(src.indexOf('data:image') === 0 ) {
						
						var block = src.split(";");
						var contentType = block[0].split(":")[1];
						var realData = block[1].split(",")[1];
						if(is_Paste){
							var fileName = "image."+contentType.split("/")[1];					
						}else{
							var fileName = items[0]['name'];
						}
						
						// Convert it to a blob to upload
						var blob = pagelayer_b64toBlob(realData, contentType);
						
						pagelayer_upload_image(fileName, blob, pagelayer_ajax_func);
						
					}
				   
				};
				/* jshint +W083 */
				if(is_Paste){
					reader.readAsDataURL(items[i].getAsFile());	
				}else{
					reader.readAsDataURL(items[i]);					
				}
				mustPreventDefault = true;
			}
		}
		
		if(mustPreventDefault && is_Paste){
			pasteEvent.stopPropagation();
			pasteEvent.preventDefault();
		}
		
	}catch(err){
		console.log(err);
	}
	
	return mustPreventDefault;
	
}

// Convert base64 to Blob 
function pagelayer_b64toBlob(b64Data, contentType, sliceSize) {
	contentType = contentType || '';
	sliceSize = sliceSize || 512;

	var byteCharacters = atob(b64Data);
	var byteArrays = [];

	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
		var slice = byteCharacters.slice(offset, offset + sliceSize);

		var byteNumbers = new Array(slice.length);
		for (var i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
		}

		var byteArray = new Uint8Array(byteNumbers);

		byteArrays.push(byteArray);
	}

	var blob = new Blob(byteArrays, {type: contentType});
	return blob;
}

// Function to check if the URL is external
function pagelayer_parse_theme_vars(img_url){
	
	for(x in pagelayer_theme_vars){
		img_url = img_url.replace(x, pagelayer_theme_vars[x]);
	}
	
	return img_url;
};

// Tooltip Setup for Editor
function pagelayer_tooltip_setup(){	
	//pagelayer.$$('[data-tlite]').each(function(){pagelayer_tlite.show(jQuery(this).get(0));});return;
	pagelayer.$$('[data-tlite]').hover(function(){
		pagelayer_tlite.show(jQuery(this).get(0));
	}, function(){
		pagelayer_tlite.hide(jQuery(this).get(0));
	});
	
};

// Pagelayer Messages
function pagelayer_show_msg(msg, state, time){
	
	time = time || 5000;
	state = !pagelayer_empty(state) ? 'pagelayer-editor-msg-state-'+state : '';
	var nholder = pagelayer.$$('.pagelayer-editor-notice');
	var mEle = jQuery('<div class="pagelayer-editor-msg '+state+'">'+msg+' <span class="pli pli-cross pagelayer-notice-x"></span></div>');
	
	nholder.append(mEle);
	
	mEle.find('.pagelayer-notice-x').on('click', function(){
		mEle.css({opacity: 0});
		setTimeout(function(){
			mEle.css({transition: 'none'});
			mEle.slideUp(function(){
				mEle.remove();
			});
		}, 900);
	});
	
	setTimeout(function(){
		mEle.find('.pagelayer-notice-x').click();
	}, time);
	
}

// Pagelayer confirmation box
function pagelayer_confirmation_box(message, yesCallback, noCallback, yesText, noText) {
	
    yesText = yesText || pagelayer_l('Yes');
    noText = noText || pagelayer_l('No');
	
	var dialog = jQuery('<div class="pagelayer-confirm-box-holder">'+
		'<div class="pagelayer-confirm-box" style="border-radius:5px">'+
			'<div class="pagelayer-confirmation-msg">'+ message +'</div>'+
			'<center>'+
				'<span class="pagelayer-btnyes button button-pagelayer">'+ yesText +'</span>&nbsp;&nbsp;&nbsp;'+
				'<span class="pagelayer-btnno button button-pagelayer">'+ noText +'</span>'+
			'</center>'+
		'</div>'+
	'</div>');
	
	pagelayer.$$('body').append(dialog);

	dialog.find('.pagelayer-btnyes').on('click', function() {
		dialog.remove();
		if(typeof yesCallback == 'function'){
			yesCallback();
		}
	});
	dialog.find('.pagelayer-btnno').on('click', function() {
		dialog.remove();
		if(typeof noCallback == 'function'){
			noCallback();
		}
	});
	dialog.show();
}

function pagelayer_trim(str, charlist){
	//  discuss at: http://locutus.io/php/trim/
	
	if(typeof str != 'string'){
		return str;
	}
	
	var whitespace = [' ', '\n', '\r', '\t', '\f', '\x0b', '\xa0', '\u2000', '\u2001', '\u2002', '\u2003', '\u2004', '\u2005', '\u2006', '\u2007', '\u2008', '\u2009', '\u200a', '\u200b', '\u2028', '\u2029', '\u3000' ].join('');
	var l = 0;
	var i = 0;
	str += '';

	if (charlist) {
		whitespace = (charlist + '').replace(/([[\]().?/*{}+$^:])/g, '$1');
	}

	l = str.length;
	for (i = 0; i < l; i++) {
		if (whitespace.indexOf(str.charAt(i)) === -1) {
			str = str.substring(i);
			break;
		}
	}

	l = str.length;
	for (i = l - 1; i >= 0; i--) {
		if (whitespace.indexOf(str.charAt(i)) === -1) {
			str = str.substring(0, i + 1);
			break;
		}
	}

	return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
};

function pagelayer_ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

// Check length for string and object
function pagelayer_length(mixed_var) {
	
	var length = 0;
	var undef, key, i, len;
	var emptyValues = [undef, null, false];

	for(i = 0, len = emptyValues.length; i < len; i++) {
		if (mixed_var === emptyValues[i]) {
			return length;
		}
	}
	
	// Is array, object or jQuery object?
	if(typeof mixed_var === 'object'){
		
		// If is jQuery object
		if( mixed_var.hasOwnProperty('length')){
			return mixed_var.length;
		}
		
		for (key in mixed_var) {
			// TODO: should we check for own properties only?
			//if (	.hasOwnProperty(key)) {
			length++;
			//}
		}
		
		return length;
	}
	
	length = String(mixed_var).length;

	return length;
};

// Create Widget list dropdown
function pagelayer_create_widget_tooltip(){

	var html = '<div class="pagelayer-widget-tooltip">'+
			'<div class="pagelayer-widget-search-holder">'+
				'<div class="pagelayer-widget-search">'+
					'<i class="pli pli-search" ></i><input class="pagelayer-search-field" /><span class="pagelayer-sf-empty pli">&times;</span>'+
				'</div>'+
			'</div>';
	
	for(var x in pagelayer_groups){
		
		// Title
		html += '<div class="pagelayer-widget-group pagelayer-group-name-'+x+'"><h5>'+x+'</h5>';
		
		// Indivdual icon
		for(var y in pagelayer_groups[x]){
			
			var sc = pagelayer_groups[x][y];
			
			if(!(sc in pagelayer_shortcodes) || 'not_visible' in pagelayer_shortcodes[sc]){
				continue;
			}
			
			html += '<div class="pagelayer-shortcode-holder" pagelayer-tag="'+sc+'">'+
				'<div class="pagelayer-pointer pagelayer-sc">'+
					'<center class="pagelayer-shortcode-inner">';
					
					if('icon' in pagelayer_shortcodes[sc]){
						html += '<i class="pagelayer-shortcode '+pagelayer_shortcodes[sc]['icon']+'"></i>';
					}else{
						html += '<i class="pagelayer-shortcode pli pagelayer-'+sc+'"></i>';
					}
					
					html += '</center>'+
					'<span class="pagelayer-pointer pagelayer-shortcode-text">'+pagelayer_shortcodes[sc]['name']+'</span>'+
				'</div>'+
			'</div>';
			
		}
		
		html += '</div>';
		
	}
	
	html += '</div>';
		
	pagelayer.$$('body').append(html);
	
	var wdHolder = pagelayer.$$('.pagelayer-widget-tooltip');
	
	// Hide the ones which are not supposed to be shown
	wdHolder.find('.pagelayer-search-field').on('input', function(){
		
		var val = jQuery(this).val();
		var re = new RegExp(val, 'i');
		
		// Show only the required tags
		wdHolder.find('.pagelayer-widget-group').each(function(){
			
			var group = jQuery(this);
			var res = group.find('[pagelayer-tag]');
			var hidden = 0;
			
			res.each(function(){
				
				var tEle = jQuery(this);
				if(tEle.find('.pagelayer-shortcode-text').html().match(re)){
					tEle.show();
				}else{
					hidden += 1;
					tEle.hide();
				}
				
			});
			
			// Hide the whole group
			if(hidden == res.length){
				group.hide();
			}else{
				group.show();
			}
				
		});

		wdHolder.find('.pagelayer-shortcode-holder:visible').first().trigger('widget_active');
		
	});
	
	// On click search empty
	wdHolder.find('.pagelayer-widget-search>.pagelayer-sf-empty').click(function(){
		wdHolder.find('.pagelayer-search-field').val('').trigger('input');
	});
	
	// Register widget active event
	wdHolder.find('.pagelayer-shortcode-holder').on('widget_active', function(){
		var activeEle = jQuery(this);
		wdHolder.find('.pagelayer-list-widget-active').removeClass('pagelayer-list-widget-active');
		
		if(!activeEle.hasClass('pagelayer-list-widget-active')){
			activeEle.addClass('pagelayer-list-widget-active');
		}
		
		activeEle[0].scrollIntoView({behavior: "smooth", block: "end"});
	});
	
	pagelayer.gDocument.on('mousedown.pagelayer_wdlist', function(e){
		var target = jQuery(e.target);
		
		if(target.closest('.pagelayer-widget-tooltip').is(wdHolder)){
			return;
		}
    
		wdHolder.find('.pagelayer-shortcode-holder:visible').first().trigger('widget_active');
    
		wdHolder.hide();
		jQuery('.pagelayer-show-wiget-list').removeClass('pagelayer-show-wiget-list');
		jQuery(window).off('scroll.pagelayer_wdlist resize.pagelayer_wdlist');
	});
  
}

// Show Widget list dropdown
function pagelayer_show_widget_list(jEle, val){
	
	val = val || '';
	jEle = jQuery(jEle);
		
	var wEle = pagelayer.$$('.pagelayer-widget-tooltip'),
	winH = jQuery(window).height(),
	iframe = pagelayer.$$('#pagelayer-iframe'),
	iframeTop = iframe.offset().top,
	iframeLeft = iframe.offset().left,
	style = {},
	wTop = 'auto',
	wBottom = 'auto',
	wLeft = '';
	wHeight = '';
  
	searchField = wEle.find('.pagelayer-search-field');
	searchField.val(val);
	searchField.trigger('input');
	
	// Add widget show class
	if(jEle.hasClass('pagelayer-shortcode-plus')){
		jEle.parent('.pagelayer-ele-overlay').addClass('pagelayer-show-wiget-list');
	}
	
	var bounds = jEle[0].getBoundingClientRect();
  
	wEle.removeClass('pagelayer-widget-list-tooltip');
	wLeft = (bounds.left + iframeLeft) - wEle.width() / 2;
  
	// In list view?
	if(jEle.closest('[pagelayer-editable]').length > 0){
		wEle.addClass('pagelayer-widget-list-tooltip');
		var selection = window.getSelection();
		var range = selection.getRangeAt(0);
		wLeft = (range.getBoundingClientRect().left + iframeLeft) - wEle.width() / 2;
	}
	
	wEle.closest('.pagelayer-widget-tooltip').show();
	wEle.find('.pagelayer-shortcode-holder:visible').first().trigger('widget_active');
	
	// Hide Widget list
	if(jEle.closest('[pagelayer-editable]').length > 0 && wEle.find('.pagelayer-widget-group:visible').length < 1){
		pagelayer.gDocument.trigger('mousedown.pagelayer_wdlist');
		return;		
	}else{
		searchField.focus().select();
	}
	
	var docW = iframeLeft + iframe.width() - 30;
	
	// Prevent to hide on left or right
	if(docW < wLeft + wEle.width()){
		wLeft = docW - wEle.width();
	}else if(iframeLeft > wLeft){
		wLeft = iframeLeft;
	}
	
	if(winH / 2 < bounds.top + 10){
		wBottom = winH - bounds.top + 10;
		wHeight = bounds.top - 10;
	}else{
		wTop = bounds.bottom + iframeTop + 10;
		wHeight = winH - bounds.bottom - 10;
	}
	
	style['left'] = wLeft;
	style['top'] = wTop;
	style['bottom'] = wBottom;
	style['max-height'] = '';
	
	if(wHeight < 350){
		style['max-height'] = wHeight;
	}
	
	wEle.css(style);
	
	jQuery(window).off('scroll.pagelayer_wdlist resize.pagelayer_wdlist');
	jQuery(window).on('scroll.pagelayer_wdlist resize.pagelayer_wdlist', function(){
		var _val = wEle.find('.pagelayer-search-field').val();
		pagelayer_show_widget_list(jEle, _val);
	});
				
	wEle.find('.pagelayer-shortcode-holder').off('click');
	wEle.find('.pagelayer-shortcode-holder').on('click', function(e){
				
		var tag = jQuery(this).attr('pagelayer-tag');
		var mWrap = jEle.closest('.pagelayer-ele-wrap[pagelayer-wrap-id]');
		var mTag = pagelayer_tag(mWrap);
		
		var ele = jQuery('<div pagelayer-tag="'+tag+'"></div>');
		
		// Is col?
		if(mTag == 'pl_col'){
			var colHolder = mWrap.find('>.pagelayer-col > .pagelayer-col-holder');
			colHolder.append(ele);
			pagelayer_empty_col(colHolder);
		}else{
			mWrap.after(ele);
		}
		
		// Replace widget
		if(jEle.closest('[pagelayer-editable]').length > 0){
			pagelayer_delete_element(mWrap.find('>.pagelayer-ele'));
		}
		
		var eleId = pagelayer_onadd(ele, false);
		var eEle = pagelayer_ele_by_id(eleId);
		
		// Create Column
		if( tag == 'pl_inner_row' ){
			var in_col = jQuery('<div pagelayer-tag="pl_col"></div>');
			eEle.find('>.pagelayer-row-holder').append(in_col);
			var in_col_id = pagelayer_onadd(in_col, false);
		}
		
		eEle.click();
		
		// Hide Widget list
		pagelayer.gDocument.trigger('mousedown.pagelayer_wdlist');
	});
  
}

// Set Selection By Character Offsets
function pagelayer_setCaret(containerEl, start, end){
	
	end = end || start;
	
	// Refered from http://jsfiddle.net/zQUhV/47/
	if(window.getSelection && document.createRange){
		
		var charIndex = 0, range = document.createRange();
		range.setStart(containerEl, 0);
		range.collapse(true);
		var nodeStack = [containerEl], node, foundStart = false, stop = false;

		while (!stop && (node = nodeStack.pop())) {
			if (node.nodeType == 3) {
				var nextCharIndex = charIndex + node.length;
				if (!foundStart && start >= charIndex && start <= nextCharIndex) {
					range.setStart(node, start - charIndex);
					foundStart = true;
				}
				if (foundStart && end >= charIndex && end <= nextCharIndex) {
					range.setEnd(node, end - charIndex);
					stop = true;
				}
				charIndex = nextCharIndex;
			} else {
				var i = node.childNodes.length;
				while (i--) {
					nodeStack.push(node.childNodes[i]);
				}
			}
		}

		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
		
	} else if (document.selection) {
		var textRange = document.body.createTextRange();
		textRange.moveToElementText(containerEl);
		textRange.collapse(true);
		textRange.moveEnd("character", end);
		textRange.moveStart("character", start);
		textRange.select();
	}
}

// Set Selection By Character Offsets
function pagelayer_content_line(containerEl){
	
	var lines = [], charIndex = 0, range = document.createRange();
	range.setStart(containerEl, 0);
	range.collapse(true);
	var bounding = range.getBoundingClientRect();
	var nodeStack = [containerEl], node, prevX = bounding.x, nextStart = 0;
	
	while(node = nodeStack.pop()){
		if (node.nodeType == 3) {
			for(var i = 1; i <= node.length; i++){
				range.setStart(node, i);
				range.setEnd(node, i);
				bounding = range.getBoundingClientRect();
				charIndex ++;

				if(prevX > bounding.x){
					lines.push({start:nextStart, end:charIndex - 1});
					nextStart = charIndex;
				}
				prevX = bounding.x;
			}
		} else {
			var i = node.childNodes.length;
			while(i--){
				nodeStack.push(node.childNodes[i]);
			}
		}
	}
	
	// Push last line
	if(nextStart != charIndex || nextStart == 0){
		lines.push({start:nextStart, end:charIndex});
	}
	
	return lines;
}

//http://jsfiddle.net/TjXEG/900/
function pagelayer_getCaretCharacterOffsetWithin(element){
	var caretOffset = 0;
	var doc = element.ownerDocument || element.document;
	var win = doc.defaultView || doc.parentWindow;
	var sel;
	if( typeof win.getSelection != "undefined" ){
		sel = win.getSelection();
		if (sel.rangeCount > 0) {
			var range = win.getSelection().getRangeAt(0);
			var preCaretRange = range.cloneRange();
			preCaretRange.selectNodeContents(element);
			preCaretRange.setEnd(range.endContainer, range.endOffset);
			caretOffset = preCaretRange.toString().length;
		}
	}else if( (sel = doc.selection) && sel.type != "Control" ){
		var textRange = sel.createRange();
		var preCaretTextRange = doc.body.createTextRange();
		preCaretTextRange.moveToElementText(element);
		preCaretTextRange.setEndPoint("EndToEnd", textRange);
		caretOffset = preCaretTextRange.text.length;
	}
	return caretOffset;
}


pagelayer_svg_cache = {};
var pagelayer_document_width;

// For automatic row parent change
jQuery(window).resize(function(){
		
	var new_vw = jQuery(document).width();
	
	if(new_vw == pagelayer_document_width){
		return false;
	}
	
	pagelayer_document_width = new_vw;
	
	// Set a timeout to prevent bubbling
	setTimeout(function(){

		jQuery(pagelayer_editable+' .pagelayer-row-stretch-full').each(function(){
			var par = jQuery(this).parent();
			pagelayer_pl_row_parent_full(par);
		});
	
	}, 200);
	
});

// Render for row
function pagelayer_render_pl_row(el){
	
	var img_urls = !pagelayer_empty(el.tmp['bg_slider-urls']) ? JSON.parse(el.tmp['bg_slider-urls']) : [];
	el.atts['slider'] = '';
	if(!pagelayer_empty(img_urls)){
		for(var x in img_urls){
			el.atts['slider'] += '<div class="pagelayer-bgimg-slide" style="background-image:url('+img_urls[x]+')"></div>'; 
		}
	}
	
	// Row background parallax image.
	if(!pagelayer_empty(el.atts['parallax_img'])){
		el.atts['parallax_img_src'] = el.tmp['parallax_img-'+el.atts['parallax_id_size']+'-url'] || el.tmp['parallax_img-url'];
		el.atts['parallax_img_src'] = el.atts['parallax_img_src'] || el.atts['parallax_img'];
	}
	
	pagelayer_bg_video(el);
}

// Render for inner row
function pagelayer_render_pl_inner_row(el){
	pagelayer_render_pl_row(el);
}

// Render for col
function pagelayer_render_pl_col(el){
	
	var img_urls = !pagelayer_empty(el.tmp['bg_slider-urls']) ? JSON.parse(el.tmp['bg_slider-urls']) : [];
	el.atts['slider'] = '';
	if(!pagelayer_empty(img_urls)){
		for(var x in img_urls){
			el.atts['slider'] += '<div class="pagelayer-bgimg-slide" style="background-image:url('+img_urls[x]+')"></div>'; 
		}
	}
	
	// We need the parent of type pagelayer-wrap-col
	var par = el.$.parent('.pagelayer-wrap-col');
	
	// Apply to wrapper
	if(!pagelayer_empty(el.atts['col'])){
		
		for(var x=1; x<=12; x++){
			if(par.hasClass('pagelayer-col-'+x)){
				par.removeClass('pagelayer-col-'+x);
				break;
			}
		}

		par.addClass('pagelayer-col-'+el.atts['col']);
		par.css('width', '');
	}
	
	if(el.atts['col_width']){
		par.css('width', '');
	}
	
	// Col background parallax image.
	if(!pagelayer_empty(el.atts['parallax_img'])){
		el.atts['parallax_img_src'] = el.tmp['parallax_img-'+el.atts['parallax_id_size']+'-url'] || el.tmp['parallax_img-url'];
		el.atts['parallax_img_src'] = el.atts['parallax_img_src'] || el.atts['parallax_img'];
	}
	
	pagelayer_bg_video(el);
}	
	
function pagelayer_bg_video(el){
	
	el.tmp['bg_video_src-url'] = el.tmp['bg_video_src-url'] || el.atts['bg_video_src'];
	
	var src = el.tmp['bg_video_src-url'];
	
	var iframe_atts = pagelayer_video_url(el.tmp['bg_video_src-url'], true);
  // Adding mute and loop option in row or col	
	if(el.atts['mute'] == "true"){
		iframe_atts['src'] +="?&mute=1";
		el.atts['mute'] = " muted ";
	}else{
		iframe_atts['src'] +="?&mute=0";
		el.atts['mute'] = "";
	}

	if(el.atts['stop_loop'] != "true"){
		iframe_atts['src'] +="&loop=1";	
		el.atts['stop_loop'] = " loop ";
	}else{
		iframe_atts['src'] +="&loop=0";	
		el.atts['stop_loop'] ="";
	}
  
	if (iframe_atts['type'] == 'youtube') {
		
		var settings = 'data-loop="'+(!pagelayer_empty(el['atts']['stop_loop']) ? 1 : 0)+'" data-mute="'+ (!pagelayer_empty(el['atts']['mute']) ? 1 : 0)+'" data-videoid="'+(iframe_atts['id'].split('&')[0])+'"';
		
		el.atts['vid_src'] =  '<div class = "pagelayer-youtube-video" '+ settings +'></div>';

	} else if (iframe_atts['type'] == 'vimeo') {
		
		el.atts['vid_src'] = '<iframe src="'+iframe_atts['src']+'&background=1&autoplay=1&byline=0&title=0" allowfullscreen="1" webkitallowfullscreen="1" mozallowfullscreen="1" frameborder="0"></iframe>';
		
	}else{
		
		el.atts['vid_src'] = '<video autoplay playsinline '+el.atts['mute']+el.atts['stop_loop']+'>'+
				'<source src="'+iframe_atts['src']+'" type="video/mp4">'+
			'</video>';
			
	}
	
}

// Load the full width row
function pagelayer_render_end_pl_row(el){
		
	// The parent
	var par = el.$.parent();
	
	// Any class with full width
	if(el.$.hasClass('pagelayer-row-stretch-full')){
		
		// Give it the full width
		pagelayer_pl_row_full(el.$);
		
		// Give full width to the parent
		pagelayer_pl_row_parent_full(par);
		
		// Also add that we had a full width
		el.$.addClass('pagelayer-row-stretch-had-full');
	
	// Did this row have full width ?
	}else if(el.$.hasClass('pagelayer-row-stretch-had-full')){
		
		// Remove style
		el.$.removeAttr('style');
		par.removeAttr('style');
		par.children('.pagelayer-ele-overlay').removeAttr('style');
		
		// Remove HAD class
		el.$.removeClass('pagelayer-row-stretch-had-full');
		
	}
	
	pagelayer_pl_row_video(el.$);
	
	el.$.find('.pagelayer-parallax-window img').each(function(){
		pagelayer_pl_row_parallax(jQuery(this));
	});
	
	el.$.find('.pagelayer-bgimg-slider').each(function(){
		pagelayer_pl_row_slider(jQuery(this));
	});
	
	// Row shape
	if('row_shape_type_top' in el.atts){
		pagelayer_render_row_shape(el, 'top')
	}
	
	if('row_shape_type_bottom' in el.atts){
		pagelayer_render_row_shape(el, 'bottom')
	}
}

// Render for inner row
function pagelayer_render_end_pl_inner_row(el){
	pagelayer_render_end_pl_row(el);
}

// Set Row parent width
function pagelayer_pl_row_parent_full(par){
	var vw = jQuery('html').width();
	par.css({'width': vw,'max-width': '100vw'});
	par.offset({left: 0});
	par.children('.pagelayer-row').css({left: 0});
}

// Row shape render
function pagelayer_render_row_shape(el, shape_pos){
		
	var name = el.atts['row_shape_type_'+shape_pos]+'-'+shape_pos+'.svg';

	// DO we have in cache
	if(!(name in pagelayer_svg_cache)){
		// Make url and fetch
		var url = pagelayer_url+'/images/shapes/'+name;
		jQuery.get(url, function(data){
			el.$.find('.pagelayer-svg-'+shape_pos).html(data);
			pagelayer_svg_cache[name] = data;
		}, 'html');
	
	// Fill with cache
	}else{
		el.$.find('.pagelayer-svg-'+shape_pos).html(pagelayer_svg_cache[name]);
	}

}

// Load the col
function pagelayer_render_end_pl_col(el){
	
	pagelayer_pl_row_video(el.$);
	
	el.$.find('.pagelayer-parallax-window img').each(function(){
		pagelayer_pl_row_parallax(jQuery(this));
	});
	
	el.$.find('.pagelayer-bgimg-slider').each(function(){
		pagelayer_pl_row_slider(jQuery(this));
	});
	
}

// Render the image object
function pagelayer_render_pl_image(el){
	
	// Decide the image URL
	el.atts['func_id'] = el.tmp['id-'+el.atts['id-size']+'-url'] || el.tmp['id-url'];
	el.atts['func_id'] = el.atts['func_id'] || el.atts['id'];
	el.atts['pagelayer-srcset'] = el.atts['func_id']+', '+el.atts['func_id']+' 1x, ';
	
	var image_atts = {
		name : 'id',
		size : 'id-size'
	};
	
	pagelayer_get_img_src(el, image_atts);
	
	// What is the link ?
	if('link_type' in el.atts){
		
		// Custom url
		if(el.atts['link_type'] == 'custom_url'){
			el.atts['func_link'] = el.tmp['link'] || '';
		}
		
		// Link to the media file itself
		if(el.atts['link_type'] == 'media_file'){
			el.atts['func_link'] = el.tmp['id-url'] || el.atts['id'];
		}
		
		// Lightbox
		if(el.atts['link_type'] == 'lightbox'){
			el.atts['func_link'] = el.tmp['id-url'] || el.atts['id'];
		}
	}
}

// Incase if there is a lightbox
function pagelayer_render_end_pl_image(el){
	pagelayer_pl_image(el.$);
}

// Pre DragAndDrop function 
function pagelayer_preDAndD_image(jEle){
	
	dropzoneParent = jEle.find('.pagelayer-img').parent();
	
	// Check if drop zone is already there then return
	if(dropzoneParent.find('.pagelayer-image-drop-zone').length > 0){
		return;
	}
	
	var dropDiv = '<div class="pagelayer-image-drop-zone">'+
					'<div>'+
						'<i class="fas fa-upload"></i>'+
						'<h4>'+pagelayer_l('drop_file')+'</h4>'+
						'<div class="pagelayer-img-up-progress">'+
							'<div class="pagelayer-img-up-bar"></div>'+
						'</div>'+
					'</div>'+
				   '</div>';
				   
	dropzoneParent.prepend(dropDiv);		
	
	dropZone = dropzoneParent.find('.pagelayer-image-drop-zone');
	
	// Inserting values in image drag and drop function
	pagelayer_img_dragAndDrop(dropzoneParent, dropZone, jEle, '');	
	
}

// Render for video
function pagelayer_render_pl_video(el){	
	el.atts['video_overlay_image-url'] = el.tmp['video_overlay_image-'+el.atts['custom_size']+'-url'] || el.tmp['video_overlay_image-url'];
	el.atts['video_overlay_image-url'] = el.atts['video_overlay_image-url'] || el.atts['video_overlay_image'];	
	el.tmp['src-url'] = el.tmp['src-url'] || el.atts['src'];
	el.tmp['ele_id'] = el['id'];
	var vid_atts = pagelayer_video_url(el.tmp['src-url'], true);	

  vid_atts['src'] += el.atts['autoplay'] == 'true' ? '?&autoplay=1' : '?&autoplay=0' ;

  var mute = el.atts['mute'] == 'true' ? 1 : 0;
  vid_atts['src'] +='&'+(vid_atts['type'] == 'vimeo' ? 'muted' : 'mute')+'='+mute;
  
	vid_atts['src'] += el.atts['loop'] == 'true' ? '&loop=1' : '&loop=0' ;
	
	el.atts['vid_src'] = vid_atts['src']+(vid_atts['type'] == 'youtube' ? '&playlist='+vid_atts['id'] : '');
}

// Incase if there is a lightbox
function pagelayer_render_end_pl_video(el){
	pagelayer_pl_video(el.$);
}

// Render the testimonial
function pagelayer_render_pl_testimonial(el){
	
	if(!pagelayer_empty(el.tmp['avatar-no-image-set'])){
		el.atts['avatar'] = '';
		return;
	}
	
	//console.log(el);
	
	// Decide the image URL
	el.atts['func_image'] = el.tmp['avatar-'+el.atts['custom_size']+'-url'] || el.tmp['avatar-url'];
	el.atts['func_image'] = el.atts['func_image'] || el.atts['avatar'];
	
}

// Render the stars
function pagelayer_render_end_pl_stars(el){
	var jEle = el.$.find('.pagelayer-stars-container');
	pagelayer_stars(jEle);
};
 

// Render the service box
function pagelayer_render_pl_service(el){
	
	// Decide the image URL
	el.atts['func_image'] = el.tmp['service_image-'+el.atts['service_image_size']+'-url'] || el.tmp['service_image-url'];
	el.atts['func_image'] = el.atts['func_image'] || el.atts['service_image'];
	el.atts['pagelayer-srcset'] = el.atts['func_image']+', '+el.atts['func_image']+' 1x, ';
	
	var image_atts = {
		name : 'service_image',
		size : 'service_image_size'
	};
	
	pagelayer_get_img_src(el, image_atts);
	
}

function pagelayer_render_end_pl_service(el){
	// Drag and Drop function for image
	if (typeof pagelayer_preDAndD_image !== "undefined") { 
		pagelayer_preDAndD_image(el.$);
	}
}

function pagelayer_social(jEle,sel){
	var holder = jEle.find(sel);
	var icon = holder.data('icon');
	//alert(icon);
	var icon_splited = icon.split(' fa-');
	//console.log(icon_splited);
	holder.addClass('pagelayer-'+icon_splited[1]);
	
}

function pagelayer_social_icon_onchange(jEle, row, val){
	
	var url = '';
	
	// Lets get the value of the nearest social icon
	for(var k in pagelayer_social_urls){
		var patt = new RegExp(k, 'i');
		if(patt.test(val)){
			url = pagelayer_social_urls[k];
		}
	}
	
	if(url.length > 0){
		var social_url_row = row.parent().find('[pagelayer-elp-name="social_url"]');
		//console.log(social_url_row);
		social_url_row.find('.pagelayer-elp-link').val(url).trigger('change');
	}
}

// Render the social icon
function pagelayer_render_end_pl_social(el){
	pagelayer_social(el.$, '.pagelayer-icon-holder');
}

// Render the social profile group
function pagelayer_render_end_pl_social_grp(el){
	
	// Removing extra animation classes
	el.$.find('.pagelayer-icon-holder').removeClass (function (index, className) {
		return (className.match (/(^|\s)pagelayer-animation-\S+/g) || []).join(' ');
	});
	
	pagelayer_pl_social_profile(el.$);
}

// Render the counter
function pagelayer_render_end_pl_counter(el){
	pagelayer_counter();
};

// Render the progress
function pagelayer_render_end_pl_progress(el){
	pagelayer_progress();
};
 
// Render the image slider
function pagelayer_render_pl_image_slider(el){
	
	// The URLs
	var img_urls = !pagelayer_empty(el.tmp['ids-urls']) ? JSON.parse(el.tmp['ids-urls']) : [];
	var all_urls = !pagelayer_empty(el.tmp['ids-all-urls']) ? JSON.parse(el.tmp['ids-all-urls']) : [];
	var img_title = !pagelayer_empty(el.tmp['ids-all-titles']) ? JSON.parse(el.tmp['ids-all-titles']) : [];
	//console.log(img_urls);
		
	var ul = '';
	var is_link = 'link_type' in el.atts && !pagelayer_empty(el.atts['link_type']) ? true : false;
	
	// Create figure HTML
	for (var x in img_urls){
		
		// Use the default URL first
		var url = img_urls[x];
		
		// But if we have a custom size, use that
		if(el.atts['size'] != 'custom' && x in all_urls && el.atts['size'] in all_urls[x]){
			url = all_urls[x][el.atts['size']];
		}
		
		ul += '<li class="pagelayer-slider-item">';
		
		if(is_link){
			var link = (el.atts['link_type'] == 'media_file' ? (!pagelayer_empty(img_urls[x]) ? img_urls[x] : url) : (el.tmp['link'] || ''))
			ul += '<a href="'+link+'" class="pagelayer-link-sel">';
		}
		
		ul += '<img class="pagelayer-img" src="'+url+'" title="'+img_title[x]+'" alt="'+img_title[x]+'">';
		
		if(is_link){
			ul += '</a>';
		}
		
		ul += '</li>';
	}
	
	if(pagelayer_empty(ul)){
		ul = '<h4 style="text-align:center;">'+ pagelayer_l('Please select Images from left side Widget properties.')+'</h4>';
	}
	
	el.atts['ul'] = ul;
	
	// Which arrows to show
	if('controls' in el.atts && (el.atts['controls'] == 'arrows' || el.atts['controls'] == 'none')){
		el.CSS.attr.push({'sel': '.pagelayer-image-slider-ul', 'val': 'data-pager="false"'});
	}
	
	if('controls' in el.atts && (el.atts['controls'] == 'pager' || el.atts['controls'] == 'none')){
		el.CSS.attr.push({'sel': '.pagelayer-image-slider-ul', 'val': 'data-controls="false"'});
	}
	
};

// Render the image slider
function pagelayer_render_end_pl_image_slider(el){
	pagelayer_owl_destroy(el.$, '.pagelayer-image-slider-ul');
	pagelayer_pl_image_slider(el.$);
}

// Render the grid gallery
function pagelayer_render_pl_grid_gallery(el){
	// The URLs
	var img_urls = !pagelayer_empty(el.tmp['ids-urls']) ? JSON.parse(el.tmp['ids-urls']) : [];
	var all_urls = !pagelayer_empty(el.tmp['ids-all-urls']) ? JSON.parse(el.tmp['ids-all-urls']) : [];
	var img_title = !pagelayer_empty(el.tmp['ids-all-titles']) ? JSON.parse(el.tmp['ids-all-titles']) : [];
	var img_links = !pagelayer_empty(el.tmp['ids-all-links']) ? JSON.parse(el.tmp['ids-all-links']) : [];
	var img_captions = !pagelayer_empty(el.tmp['ids-all-captions']) ? JSON.parse(el.tmp['ids-all-captions']) : [];
	//console.log(img_urls);
		
	var ul = '';
	var	pagin = '<li class="pagelayer-grid-page-item active">1</li>';
	var is_link = 'link_to' in el.atts && !pagelayer_empty(el.atts['link_to']) ? true : false;
	
	var i = 0;
	var j = 1;
	if(pagelayer_empty(el.tmp)){
		ul = '<h4 style="text-align:center;">'+ pagelayer_l('select_images')+'</h4>';
		el.atts['ul'] = ul;
		el.atts['pagin'] = '';
		return;
	}
  
	ul += '<ul class="pagelayer-grid-gallery-ul">';
	var gallery_rand = 'gallery-id-'+Math.floor((Math.random() * 100) + 1);
	var imgInPage = el.atts['images_no'];
	
	// Create figure HTML
	for (var x in img_urls){
		
		if(imgInPage != 0 && (i % imgInPage) == 0 && i != 0){
			ul += '</ul><ul class="pagelayer-grid-gallery-ul">';
			j++;
			pagin += '<li class="pagelayer-grid-page-item">'+j+'</li>';			
		}
		
		// Use the default URL first
		var url = img_urls[x];
		
		// But if we have a custom size, use that
		if(el.atts['size'] != 'custom' && x in all_urls && el.atts['size'] in all_urls[x]){
			url = all_urls[x][el.atts['size']];
		}

		
		ul += '<li class="pagelayer-gallery-item" >';
		
		if(!is_link){
			ul += '<div>';
		}
		
		if(is_link && el.atts['link_to'] == 'media_file'){
			var link = (el.atts['link_to'] == 'media_file' ? url : (el.atts['link'] || ''));
			ul += '<a href="'+link+'" class="pagelayer-ele-link">';
		}
		
		if(is_link && el.atts['link_to'] == 'attachment'){
			var link = img_links[x];
			ul += '<a href="'+link+'" class="pagelayer-ele-link">';
		}
		
		if(is_link && el.atts['link_to'] == 'lightbox'){			
			ul += '<a href="'+img_urls[x]+'" class="pagelayer-ele-link" data-lightbox-gallery="'+gallery_rand+'" alt="'+img_title[x]+'" pagelayer-grid-gallery-type="'+el.atts['link_to']+'">';
		}
		
		ul += '<img class="pagelayer-img" src="'+url+'" title="'+img_title[x]+'" alt="'+img_title[x]+'">';
		
		if(el.atts['caption'] == 'true'){
			ul += '<span class="pagelayer-grid-gallery-caption">'+img_captions[x]+'</span>';
		}
		
		if(is_link){
			ul += '</a>';
		}
		
		if(!is_link){
			ul += '</div>';
		}
		
		ul += '</li>';
		i++;
	}
	ul += '</ul>';
	
	el.atts['pagin'] = (j > 1) ? '<div class="pagelayer-grid-gallery-pagination"><ul class="pagelayer-grid-page-ul">'+'<li class="pagelayer-grid-page-item">&laquo;</li>'+
						pagin+
						'<li class="pagelayer-grid-page-item">&raquo;</li>'+'</ul></div>' : '';
	
	el.tmp['gallery-random-id'] = gallery_rand;
	
	el.atts['ul'] = ul;

}

function pagelayer_render_end_pl_grid_gallery(el){
	pagelayer_pl_grid_lightbox(el.$);
}

// Render for tabs
function pagelayer_render_html_pl_tabs(el){
	el.CSS.attr.push({'sel': '{{element}}', 'val': 'pagelayer-tabs-rotate="'+el.atts["rotate"]+'"'});
};

// Render the tab item
function pagelayer_render_end_pl_tabs(el){
	pagelayer_pl_tabs(el.$);
}

// Render the accordion item
function pagelayer_render_end_pl_accordion(el){
	pagelayer_pl_accordion(el.$);
};

// Render the collapse item
function pagelayer_render_end_pl_collapse(el){
	pagelayer_pl_collapse(el.$);	
};

// Shortcode Handler
var pagelayer_shortcodes_timer;
function pagelayer_render_pl_shortcodes(el){
			
	// Clear any previous timeout
	clearTimeout(pagelayer_shortcodes_timer);
	
	// Set a timer for constant change
	pagelayer_shortcodes_timer = setTimeout(function(){
		
		// Make the call
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_do_shortcodes',
			type: 'POST',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				shortcode_data: el.atts['data']
			},
			success:function(data) {
				el.$.find('.pagelayer-shortcodes-container').html(data);
			}
		});
	
	}, 500);
	
};

// Render the widget area i.e. Sidebars
function pagelayer_render_pl_wp_widgets(el){
			
	// Clear any previous timeout
	clearTimeout(pagelayer_shortcodes_timer);
	
	// Set a timer for constant change
	pagelayer_shortcodes_timer = setTimeout(function(){
	
		// Make the call
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_fetch_sidebar',
			type: 'POST',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				sidebar: el.atts['sidebar']
			},
			success:function(data) {
				el.$.find('.pagelayer-wp-sidebar-holder').html(data);
			}
		});
	
	}, 500);

};

function pagelayer_owl_destroy(jEle, slides_class){
	
	var ul = jEle.find(slides_class);
	var setup = jEle.attr('pagelayer-setup');
	
	// Already setup ?
	if(setup && setup.length > 0){
		if(ul.children('.pagelayer-ele-wrap')){
			ul.pagelayerOwlCarousel('destroy');
			ul.find('[class^="pagelayer-owl-"]').remove();
			jEle.removeAttr('pagelayer-setup');
		}
	}
}


// Render the google maps v3
function pagelayer_render_pl_google_maps(el){
	
	el.atts['show_v2'] = true;
    
	if(pagelayer_empty(el.atts['api_version'])){		
		el.atts['src_code'] = '';
		return;
	}
	
	el.atts['show_v2'] = false;
	
	var gmaps_key = (pagelayer_empty(pagelayer_gmaps_key) ? '' : pagelayer_gmaps_key);
	
	var api_key = (pagelayer_empty(el.atts['api_key']) ? gmaps_key : el.atts['api_key']);
	
	if(el.atts['map_modes'] == 'view'){
		el.atts['center'] = pagelayer_empty(el.atts['center']) ? '-33.8569,151.2152' : el.atts['center'];
	}
		
	var src_code = (pagelayer_empty(el.atts['center']) ? '' : '&center='+el.atts['center'])+(el.atts['map_modes'] == 'streetview' ? '' : '&maptype='+el.atts['map_type']+'&zoom='+el.atts['zoom']);
	
	switch(el.atts['map_modes']){
		case 'place':
			src_code += encodeURI('&q='+(pagelayer_empty(el.atts['address']) ? 'New York, New York, USA' : el.atts['address'] ));
			break;
			
		case 'directions':
			src_code += encodeURI('&origin='+(pagelayer_empty(el.atts['direction_origin']) ? 'Oslow Norway' : el.atts['direction_origin'] ));
			src_code += encodeURI('&destination='+(pagelayer_empty(el.atts['direction_destination']) ? 'Telemark Norway' : el.atts['direction_destination'] ));
			src_code += (pagelayer_empty(el.atts['direction_waypoints']) ? '' : '&waypoints='+(el.atts['direction_waypoints'].trim()).split(' ').join('|') );
			src_code += (pagelayer_empty(el.atts['direction_modes']) ? '' : '&mode='+el.atts['direction_modes'] );
			src_code += (pagelayer_empty(el.atts['direction_avoid']) ? '' : '&avoid='+el.atts['direction_avoid'].split(',').join('|') );
			src_code += (pagelayer_empty(el.atts['direction_units']) ? '' : '&units='+el.atts['direction_units'] );
			break;
			
		case 'streetview':
			src_code += '&pano='+(pagelayer_empty(el.atts['streetview_pano']) ? 'eTnPNGoy4bxR9LpjjfFuOw' : el.atts['streetview_pano'] );
			src_code += '&location='+(pagelayer_empty(el.atts['streetview_location']) ? '46.414382,10.013988' : el.atts['streetview_location'] );
			src_code += (pagelayer_empty(el.atts['streetview_heading']) ? '' : '&heading='+el.atts['streetview_heading'] );
			src_code += (pagelayer_empty(el.atts['streetview_pitch']) ? '' : '&pitch='+el.atts['streetview_pitch'] );
			src_code += (pagelayer_empty(el.atts['streetview_fov']) ? '' : '&fov='+el.atts['streetview_fov'] );
			break;
			
		case 'search':
			src_code += encodeURI('&q='+(pagelayer_empty(el.atts['search_term']) ? 'Record stores in Seattle' : el.atts['search_term'] ));
			break;
			
	}
	
	var src_code_url = 'https://www.google.com/maps/embed/v1/'+el.atts['map_modes']+'?key='+api_key+src_code;
	
	el.atts['src_code'] = '<iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen src="'+src_code_url+'"></iframe>';
	
}

////////////
// Freemium
////////////

// Render the excerpt
function pagelayer_render_html_pl_post_excerpt(el){
	el.$.find('.pagelayer-post-excerpt').addClass('pagelayer-empty-widget');
}

// Render the featured image
function pagelayer_render_html_pl_featured_img(el){
	
	var param = {};
	
	param['pagelayer_nonce'] = pagelayer_ajax_nonce;
	
	// Post Id
	param['post_id'] = pagelayer_postID;
	
	// Image size
	if('size' in el.atts){
		param['size'] = el.atts['size'];
	}
	
	jQuery.ajax({
		url: pagelayer_ajax_url+'action=pagelayer_fetch_featured_img',
		type: 'post',
		data: param,
		dataType: 'json',
		success: function(data){
			
			var src = '';
			var title = '';
			var alt = '';
			if(pagelayer_empty(data)){
				src = el.tmp['img-'+el.atts['size']+'-url'] || el.tmp['img-url'];
				src = src || el.atts['img'];
			}else{
				src = data['url'];
				alt = data['alt'];
				title = data['title'];
				if(el.atts['size']+'-url' in data){
					src = data[el.atts['size']+'-url'];
				}
			}
			
			var img_html = '<img class="pagelayer-img" src="'+pagelayer.blank_img+'" />';
			if(src){
				img_html = '<img class="pagelayer-img" src="' + src + '" title="' + title + '" alt="' + alt + '"/>';
			}
			
			el.$.find('.pagelayer-featured-img').html(img_html);
			
			if('link_type' in el.atts){
		
				// Custom url
				if(el.atts['link_type'] == 'custom_url'){
					el.$.find('a').attr('href', el.tmp['link']);
				}
				
				// Link to the media file itself
				if(el.atts['link_type'] == 'media_file' || el.atts['link_type'] == 'lightbox'){
					el.$.find('a').attr('href', src);
				}
			}
			
			pagelayer_pl_image(el.$);
		}
	});
}

// Retina image setting attribute.
function pagelayer_get_img_src(el, image_atts){
	
	// Check if retina images is set
	if(!pagelayer_empty(el.tmp[image_atts.name+'-retina-url']) && el.tmp[image_atts.name+'-retina-url'].includes('default-image') == false){
		var retina_image = el.tmp[image_atts.name+'-retina-'+el.atts[image_atts.size]+'-url'];
		retina_image = pagelayer_empty(retina_image) ? el.tmp[image_atts.name+'-retina-url'] : retina_image;
		el.atts['pagelayer-srcset'] += retina_image +' 2x, ';			
	}
	
	// Check if retina mobile images is set
	if(!pagelayer_empty(el.tmp[image_atts.name+'-retina-mobile-url']) && el.tmp[image_atts.name+'-retina-mobile-url'].includes('default-image') == false){			
		var retina_image_mobile = el.tmp[image_atts.name+'-retina-mobile-'+el.atts[image_atts.size]+'-url'];
		retina_image_mobile = pagelayer_empty(retina_image_mobile) ? el.tmp[image_atts.name+'-retina-mobile-url'] : retina_image_mobile;		
		el.atts['pagelayer-srcset'] += retina_image_mobile +' 3x';
	}
}

/////////////////
// Freemium
/////////////////

// If you want to store ajax data then you can use this variable
var pagelayer_ajax_data = {};

var pagelayer_posts_data = {};

// Compare two objects
function pagelayer_compare_object(obj1, obj2){
   var objectsAreSame = true;
   for(var propertyName in obj1){
	  if(obj1[propertyName] !== obj2[propertyName]){
		 objectsAreSame = false;
		 break;
	  }
   }
   for(var propertyName in obj2){
	  if(obj1[propertyName] !== obj2[propertyName]){
		 objectsAreSame = false;
		 break;
	  }
   }
   return objectsAreSame;
}

// Incase if there is a lightbox
function pagelayer_render_end_pl_featured_img(el){
	pagelayer_pl_image(el.$);
}

// Render the archive Posts
function pagelayer_render_pl_archive_posts(el){
	
	// Need to do empty
	el.atts['pagelayer_pagination_top'] = '';
	el.atts['pagelayer_pagination_bottom'] = '';
	
}

// Render the archive Posts
function pagelayer_render_end_pl_archive_posts(el){
	var post = {};
	
	// All atts
	post['atts'] = JSON.parse(JSON.stringify(el.atts));
	post['atts']['pagelayer-id'] = el['id'];
	
	// The nonce
	post['pagelayer_nonce'] = pagelayer_ajax_nonce;
	
	var data_handle = function(data){
		//console.log(data);
		var d = jQuery(data);
		el.$.children(':not(style)').remove();
		var child = el.$.append(d.children(':not(style)'));
		pagelayer_ajax_data[el['id']] = data;
	}
	
	if(pagelayer_empty(pagelayer_posts_data) || !pagelayer_compare_object(pagelayer_posts_data, post) || pagelayer_empty(pagelayer_ajax_data[el['id']])){
		
		pagelayer_posts_data = post;
	
		jQuery.ajax({
			url: pagelayer_ajax_url+'action=pagelayer_archive_posts_data',
			type: 'post',
			data: post,
			success: data_handle
		});
	}else{
		data_handle(pagelayer_ajax_data[el['id']]);
	}
}

function pagelayer_apply_megamenu_items(html, menuID, menuEle, eleActive){
	
	if(pagelayer_empty(pagelayer_menus_items_list[menuID])){
		return html;
	}
	
	var menu_data = jQuery('<div>').html(html);	
	var $elements = pagelayer_menus_items_list[menuID];
	var unset_ele = function(navItem){
		var src = jQuery(navItem);
		var nhtml = src[0].outerHTML;
		
		var nEle = jQuery(nhtml);		
		nEle.removeAttr('pagelayer-parent');
		nEle.find('[pagelayer-parent]').removeAttr('pagelayer-parent');
		nEle.find('style').remove();
		nEle.find('.pagelayer-ele-overlay').remove();
		
		// Unwrap the wraps
		nEle.find('.pagelayer-ele').each(function (){
			var ele = jQuery(this);
			if(ele.parent().is('.pagelayer-ele-wrap')){
				ele.unwrap();
			}
		});
		
		return nEle;
	}
	
	for($e in $elements){
		var savedHTML = '';
		
		if(pagelayer_empty($elements[$e]['pagelayer_content'])){
			 continue;
		}
		
		var mID = $elements[$e]['ID'];
		var navItem = menuEle.find('.pagelayer-mega-editor-'+mID).find('.pagelayer-nav_menu_item').first();
		var id = pagelayer_id(menuEle);

		if(navItem.length > 0 && eleActive){		
			savedHTML = unset_ele(navItem);
		}else{
			savedHTML = pagelayer_element_unsetup($elements[$e]['pagelayer_content']);
		}
		
		menu_data.find('.pagelayer-mega-editor-'+mID).html(savedHTML[0].outerHTML);
	}
		
	return menu_data.html();
}

var pagelayer_nav = {};
var pagelayer_wp_menu_timer;
var pagelayer_nav_force_refresh = {};

// Render the Primary menu
function pagelayer_render_pl_wp_menu(el){
	
	var jEle = el.$;
	var menuID = el.atts['nav_list'];
	var parMenu = jEle.parent().closest('.pagelayer-wp_menu');
	var inside_mega = '';
	var menu_error = '';
	
	// If we are inside primary menu and have a same menu ID
	if(parMenu.length > 0){
		
		var parMenuID = pagelayer_get_att(parMenu, 'nav_list');
		
		if(menuID == parMenuID){
			pagelayer_show_msg('Not allowed same Menu inside the Primary menu widget!', 'warning');
			inside_mega = true;
		
		// If parent menu menuID is empty then we prevent menu inside menu
		}else if(pagelayer_empty(menuID) || pagelayer_empty(parMenuID) ){
			menu_error = 'Primary Menu Holder. Please select the correct menu or parent menu.';
			inside_mega = true;
		}
    
	}
	
	// Set atts for easy rendering in PHP
	pagelayer_set_atts(jEle, 'inside_mega', inside_mega);
	
	if(!pagelayer_empty(inside_mega)){
		
		if(pagelayer_empty(menu_error)){
			menu_error = 'Primary Menu Holder. Please select the correct menu.';
		}
		
		el.atts['nav_menu'] = menu_error;
		return;
	}
	
	// Setting default toggle icon. If the icon is empty.
	if(pagelayer_empty(el.atts['menu_toggle_icon'])){
		el.atts['menu_toggle_icon'] = 'fas fa-bars';
	}
	
	// To avoid remove pagelayer id of mega menu item
	var eleActive = !pagelayer_empty(pagelayer_active.el) && (el.id == pagelayer_active.el.id || jEle.find(pagelayer_active.el.$).length > 0);
	
	if(pagelayer_empty(pagelayer_nav[menuID]) || !pagelayer_empty(pagelayer_nav_force_refresh[el.id])){
		
		var pagelayer_nav_items_list = pagelayer_get_nav_items(jEle);
		var findPar = jEle.find('.pagelayer-wp_menu-ul').parent();
		el.atts['nav_menu'] = '';
		
		// Get menu container for the hold place of the menu
		if(findPar.length > 0){
			el.atts['nav_menu'] = findPar[0].outerHTML;
		}
		
		// Clear any previous timeout
		clearTimeout(pagelayer_wp_menu_timer);
		
		// Set a timer for constant change
		pagelayer_wp_menu_timer = setTimeout(function(){
			
			jQuery.ajax({
				url: pagelayer_ajax_url+'&action=pagelayer_fetch_primary_menu&postID='+pagelayer_postID, // Send post id to on live mode
				type: 'post',
				data: {
					pagelayer_nonce: pagelayer_ajax_nonce,
					nav_list: menuID,
					pagelayer_nav_items: pagelayer_nav_items_list,
					'pagelayer-live': 1
				},
				success: function(data) {
					//console.log(data);
					data = pagelayer_apply_megamenu_items(data, menuID, jEle, eleActive);
					pagelayer_nav[menuID] = data;
				},
				complete: function() {
					//console.log(data);
					
					// Is element html rendered ?
					var findCont = setInterval( function(){
						
						var container = jEle.find('.pagelayer-wp-menu-container');
						
						if(container.length < 1){
							return;
						}
						
						clearInterval(findCont);

						// Replace the menu HTML
						container.find('.pagelayer-wp_menu-ul').parent().remove();
						container.append(pagelayer_nav[menuID]);
						
						var render_ref = pagelayer_render_menu_par;
						pagelayer_render_menu_par = false;
						
						container.find('.pagelayer-ele').each(function(){
							var iEle = jQuery(this);
							
							if(iEle.parent('.pagelayer-ele-wrap').length > 0){
								return;
							}
							
							var id = pagelayer_assign_id(iEle);
							pagelayer_element_setup('[pagelayer-id="'+id+'"]', true);
						});
						
						pagelayer_render_menu_par = render_ref;
						
						pagelayer_primary_menu(jEle);
												
					}, 100);
					
				}
			});
		}, 500);
		
	}else{
		el.atts['nav_menu'] = pagelayer_apply_megamenu_items(pagelayer_nav[menuID], menuID, jEle, eleActive);
	}
	
	pagelayer_nav_force_refresh[el.id] = false;
}

// Render end the Primary menu
function pagelayer_render_end_pl_wp_menu(el){
	
	var jEle = el.$;
	var render_ref = pagelayer_render_menu_par;
	
	pagelayer_render_menu_par = false;
	
	// Re-setup the element
	jEle.find('.pagelayer-ele').each(function(){
		var ele = jQuery(this);
		
		if(ele.parent('.pagelayer-ele-wrap').length > 0){
			return;
		}
		
		var id = pagelayer_assign_id(ele);
		
		pagelayer_element_setup('[pagelayer-id="'+id+'"]', true);
	});
	
	pagelayer_render_menu_par = render_ref;
	
	pagelayer_primary_menu(el.$);
}

// The Primary menu handler on live
pagelayer_add_action('pagelayer_primary_menu_setup_end', function(e, jEle){
	jEle.find('li.pagelayer-mega-menu-item a > .after-icon').unbind('click');
	jEle.unbind('click.mega_menu');
	jEle.on('click.mega_menu', 'li.pagelayer-mega-menu-item', function(e){
							
		var target = jQuery(e.target);
		var mEle = jQuery(this);
		
		if(target.closest('.pagelayer-mega-menu').length > 0 || target.closest(mEle).length < 1){
			return;
		}
		
		jQuery('.pagelayer-active-mega-menu').each(function(){
			var oEle = jQuery(this);
			
			if(mEle.is(oEle)){
				return;
			}
			
			oEle.removeClass('pagelayer-active-mega-menu');
		});
		
		mEle.toggleClass('pagelayer-active-mega-menu');
	});
});

var pagelayer_render_menu = {};
var pagelayer_render_menu_par = true;

// Render end the Primary menu
function pagelayer_render_end_pl_nav_menu_item(el){
	
	if(pagelayer_empty(pagelayer_menus_items_ref[el.atts['ID']])){
		return;
	}
	
	var jEle = el.$;
	
	if(pagelayer_render_menu_par){
		
		// Render parent
		clearTimeout(pagelayer_render_menu);
		pagelayer_render_menu = setTimeout(function(){
			var par = jEle.closest('.pagelayer-wp_menu');
			var plID = pagelayer_id(par);
			
			if(par.length < 1) return;
			
			pagelayer_nav_force_refresh[plID] = true;

			pagelayer_render_menu_par = false;
			pagelayer_sc_render(par);
			pagelayer_render_menu_par = true;
		}, 500);
	}
}

var pagelayer_nav_menu_timmer = {}

// On nav dirty handler
pagelayer_add_action('pagelayer_do_dirty', function(e, jEle){		
		
	var navEle = jEle.closest('[pagelayer-tag="pl_nav_menu_item"]');
	
	if(navEle.length < 1){
		return;
	}
	
	var itemData = pagelayer_data(navEle);
	var atts = itemData.atts;
	var itemID = atts['ID'];
	
	if( !(itemID in pagelayer_menus_items_ref) ){
		pagelayer_menus_items_ref[itemID] = {};
	}
	
	var props = pagelayer_get_props(navEle);
	var menuEle = jEle.closest('.pagelayer-wp_menu');
	var plID = pagelayer_id(menuEle);
	
	for(var prop in props['settings']){
		for(var section in props[prop]){
			
			if(section in atts){
				pagelayer_menus_items_ref[itemID][section] = atts[section];
				continue;
			}
			
			pagelayer_menus_items_ref[itemID][section] = '';
		}
	}
   
	pagelayer_menus_items_ref[itemID]['pagelayer_content'] = navEle;
	pagelayer_menus_items_ref[itemID]['is_dirty'] = true;
	
	var currentID = pagelayer_get_att(menuEle, 'nav_list');
	
	// Prevent unnecessary render
	jQuery(pagelayer_editable).find('.pagelayer-wp_menu').each(function(){
		var mEle = jQuery(this);
		var mID = pagelayer_get_att(mEle, 'nav_list');
		
		if(currentID != mID){
			return;
		}
		
		mEle.attr('pagelayer-click-render', 1);
	});

	menuEle.removeAttr('pagelayer-click-render');
	
});

// We need to render the original content before we can start editing
pagelayer_add_action('pagelayer_element_clicked', function(e, jEle){
	
	var menus = jQuery(pagelayer_editable).find('.pagelayer-wp_menu');
	
	// Prevent unnecessary render
	if(!jEle.hasClass('pagelayer-wp_menu') || menus.length < 2 || pagelayer_empty(jEle.attr('pagelayer-click-render'))){
		return;
	}

	jEle.find('[pagelayer-tag="pl_nav_menu_item"]').each(function(){
		var cEle = jQuery(this),
		postID = pagelayer_get_att(cEle, 'ID');		

		if(!(postID in pagelayer_menus_items_ref)){
			return;
		}
		
		var ref_data = pagelayer_menus_items_ref[postID];
		
		if(!('is_dirty' in ref_data) || pagelayer_empty(ref_data['is_dirty'])){
			return;
		}
		
		pagelayer_sc_render(jEle);
		
		return false; // Break the loop

	});
	
});

// Render the post navigation
function pagelayer_render_end_pl_post_nav(el){

	jQuery.ajax({
		url: pagelayer_ajax_url+'&action=pagelayer_post_nav&postID='+pagelayer_postID,
		type: 'post',
		data: {
			pagelayer_nonce: pagelayer_ajax_nonce,
			data: el['atts'],
		},
		async:false,
		success: function(response){
			//console.log(response);
			var obj = jQuery.parseJSON(response);
			el.$.find('.pagelayer-prev-post').html(obj['atts']['prev_link']);
			el.$.find('.pagelayer-next-post').html(obj['atts']['next_link']);
		}
	});
	
}

// Render the site title
function pagelayer_render_pl_wp_title(el){	
	//console.log(el.tmp);

	// Use default logo
	if(pagelayer_empty(el.atts['logo_img_type'])){
		
		// But is there a default logo
		if(!pagelayer_empty(pagelayer_site_logo)){		
			el.atts['func_image'] = pagelayer_site_logo[el.atts['logo_img_size']+'-url'] || pagelayer_site_logo['url'];
			
			el.atts['logo_img-title'] = pagelayer_empty(pagelayer_site_logo.title) ? '' : pagelayer_site_logo.title;
			el.atts['logo_img-alt'] = pagelayer_empty(pagelayer_site_logo.alt) ? '' : pagelayer_site_logo.alt;
		}
	
	// Custom logo
	}else{
		el.atts['func_image'] = el.tmp['logo_img-'+el.atts['logo_img_size']+'-url'] || el.tmp['logo_img-url'];
		el.atts['func_image'] = pagelayer_empty(el.atts['func_image']) ? el.atts['logo_img'] : el.atts['func_image'];
	}
}

// Render the Post comment
function pagelayer_render_end_pl_post_comment(el){
	
	var postID = pagelayer_postID;
		
	if(el['atts']['post_type'] == 'custom' && el['atts']['post_id']){
		postID = el['atts']['post_id'];
	}
	
	jQuery.ajax({
		url: pagelayer_ajax_url+'&action=pagelayer_post_comment&postID='+postID,
		type: 'post',
		data: {
			pagelayer_nonce: pagelayer_ajax_nonce,
		},
		success: function(response){
			el.$.find('.pagelayer-post-comment-container').html(response);
		}
	});

}

var pagelayer_post_info_timer = {};

// Render the Post info list
function pagelayer_render_pl_post_info_list(el){
	
	el.atts['post_info_content'] = 1;
	
	// Clear any previous timeout
	clearTimeout(pagelayer_post_info_timer[el.id]);
	
	// Set a timer for constant change
	pagelayer_post_info_timer[el.id] = setTimeout(function(){
	
		// Make the call
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_post_info&postID='+pagelayer_postID,
			type: 'post',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				el: el.atts,
			},
			success: function(response){
				var obj = jQuery.parseJSON(response);
				//console.log(obj);el['atts'] = obj;
				
				if( pagelayer_empty(obj['post_info_content']) ){
					el.$.find('.pagelayer-post-info-list-container').remove();
					return;
				}
				
				el.$.find('.pagelayer-post-info-list-container').show();
				el.$.find('.pagelayer-post-info-label').html(obj['post_info_content']);
				el.$.find('.pagelayer-post-info-icon img').attr('src', obj['avatar_url']);
				el.$.find('.pagelayer-post-info-list-container > a').attr('href', obj['link']);
			}
		});
		
	}, 500);
	
}

// Render the Post info list
function pagelayer_render_html_pl_post_info_list(el){
	el.$.find('.pagelayer-post-info-list-container').hide();
}

// Render the contact form
function pagelayer_render_pl_contact(el){
	
	// Set post id in atts 
	el.atts['con_post_id'] = pagelayer_postID;
	el.atts['grecaptcha'] = pagelayer_recaptch_site_key;	
}

// Render the contact form
function pagelayer_render_end_pl_contact(el){
	
	jQuery(el.$).find('.pagelayer-recaptcha').each(function(){
		var recaptcha = jQuery(this);
		var widgetID = recaptcha.attr('recaptcha-widget-id');
		
		if( !pagelayer_empty(window.grecaptcha) && (!pagelayer_empty(widgetID) || widgetID == 0) ){
			grecaptcha.reset(widgetID);
		}else{
			pagelayer_recaptcha_loader(recaptcha, true);
		}
	});
	
	// Showing contact form message in the editor only.
	if(el.atts['show_msg_box']){
		var msgBox = el.$.find('.pagelayer-message-box');
		if(el.$.find('.pagelayer-message-box').length==2){
			msgBox.eq(0).text('Demo success box');
			msgBox.eq(0).addClass('pagelayer-cf-msg-suc');
			msgBox.eq(1).text('Demo failed box');
			msgBox.eq(1).addClass('pagelayer-cf-msg-err');
		}
	}
	
	pagelayer_set_atts(el.$, 'con_post_id', pagelayer_postID);	
	
}

function pagelayer_render_end_pl_heading(el) {
	pagelayer_search_widgets(el.$);
}

function pagelayer_render_end_pl_text(el) {
	pagelayer_search_widgets(el.$);
}

// Render the contact form
function pagelayer_render_pl_contact_item(el){ 
	var html = '';
	var options = '';
	var placeholder = '';
	var required = '';
	
	if(!pagelayer_empty(el.atts['required'])){
		required = 'required';
	}

	if(!pagelayer_empty(el.atts['label_name']) && pagelayer_empty(el.atts['label_as_holder'])){
		html = '<label for="'+el.atts['field_name']+'">'+
				'<span class="pagelayer-form-label">'+el.atts['label_name']+'</span>';
				
		if(!pagelayer_empty(required)){
			html += ' *';
		}
		
		html += '</label>';
	}
		
	if(!pagelayer_empty(el.atts['label_as_holder'])){
		placeholder = el.atts['label_name'];
	}else{
		if(!pagelayer_empty(el.atts['placeholder'])) placeholder = el.atts['placeholder'];
	}
	
	// File accept
	var file_accept = '.jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.ppt,.pptx,.odt,.avi,.ogg,.m4a,.mov,.mp3,.mp4,.mpg,.wav,.wmv';
	
	if(!pagelayer_empty(el.atts['accept_file'])){
		file_accept = el.atts['accept_file'];
	}
	
	if(el.atts['field_type'] == 'select'){
	html += '<select name="'+el.atts['field_name']+'" '+required+'>'
		if(!pagelayer_empty(el.atts['label_name']) && !pagelayer_empty(el.atts['label_as_holder'])){
		   html += '<option value="" disabled selected>'+el.atts['label_name']+'</option>';
		}else{
			html += '<option value="" disabled selected>---</option>';
		}
		
		if(!pagelayer_empty(el.atts['values'])){
			options = el.atts['values'].split("\n");
			for(var x in options){
				html += '<option value="'+options[x].trim()+'">'+options[x].trim()+'</option>';
			}
		}
		html += '</select>';
	}else if(el.atts['field_type'] == 'checkbox'){
		if(!pagelayer_empty(el.atts['values'])){
			options = el.atts['values'].split("\n");
			html += '<div class="pagelayer-radcheck-holder pagelayer-contact-checkbox" '+required+'>';
			for(var x in options){
				html += '<div><input type="checkbox" id="'+el.id+options[x].trim()+'" name="'+el.atts['field_name']+'[]" '+
				'value="'+options[x].trim()+'" /><label for="'+el.id+options[x].trim()+'" class="pagelayer-form-label">'+options[x].trim()+'</label></div>';
			}
			html += '</div>';
		}
	}else if(el.atts['field_type'] == 'radio'){
		if(!pagelayer_empty(el.atts['values'])){
			options = el.atts['values'].split("\n");
			html += '<div class="pagelayer-radcheck-holder">';
			for(var x in options){
				html += '<div><input type="radio" name="'+el.atts['field_name']+'" '+
				'value="'+options[x].trim()+'" '+required+'/><span>'+options[x].trim()+'</span></div>';
			}
			html += '</div>';
		}
	}else if(el.atts['field_type'] == 'textarea'){
		html += '<textarea name="'+el.atts['field_name']+'" rows="'+el.atts['textarea_rows']+'" placeholder="'+placeholder+'" '+
				''+required+'></textarea>';
	}else if(el.atts['field_type'] == 'file'){
		html += '<input type="'+el.atts['field_type']+'" '+
				'name="'+el.atts['field_name']+'" placeholder="'+placeholder+'" accept="'+file_accept+'" '+required+' />';
	}else if(el.atts['field_type'] == 'label'){
		html += '';
	}else{
		html += '<input type="'+el.atts['field_type']+'" '+
				'name="'+el.atts['field_name']+'" placeholder="'+placeholder+'" '+required+'/>';
	}
	
	el.atts['fieldhtml'] = html;
	
}

// Render the post content
function pagelayer_render_pl_post_content(el){
	el.atts['post_content'] = 'Post Content Holder';
	el.CSS.css.push({'sel': '{{element}} .entry-content', 'val': 'min-height:20px;background-color:#e3e3e3;'});
}

// Render the post excertp
function pagelayer_render_pl_post_excerpt(el){
	el.tmp['post_excerpt'] = '<div class="pagelayer-post-excerpt pagelayer-empty-widget"></div>';
}

// Render the flipbox
function pagelayer_render_pl_flipbox(el){
	var jEle = el.$;
	el.atts['func_image'] = el.tmp['heading_image-'+el.atts['heading_image_size']+'-url'] || el.tmp['heading_image-url'];
	el.atts['func_image'] = el.atts['func_image'] || el.atts['heading_image'];
	
	var back = pagelayer_get_att(jEle, 'back_section');
	if(back){
		jEle.attr('back_section', back);
	}else{
		jEle.removeAttr('back_section', back);
	}
}

// Render the Testimonial Slider
function pagelayer_render_end_pl_testimonial_slider(el){
	pagelayer_owl_destroy(el.$, '.pagelayer-testimonials-holder');
	pagelayer_pl_testimonial_slider(el.$);
}

// Render the countdown
function pagelayer_render_pl_countdown(el){
	if(pagelayer_empty(el.atts['custom_label_text'])){
		el.atts['days_label_text'] = 'Days';
		el.atts['hours_label_text'] = 'Hours';
		el.atts['minutes_label_text'] = 'Minutes';
		el.atts['seconds_label_text'] = 'Seconds';
	}	
}	

// Render the countdown
function pagelayer_render_end_pl_countdown(el){ 
	var jEle = el.$;
	var exp = pagelayer_get_att(jEle, 'display_expired_text');
	if(exp){
		jEle.attr('display_expired_text', exp);
	}else{
		jEle.removeAttr('display_expired_text', exp);
	}
	
	pagelayer_countdown(jEle);
	
	if(pagelayer_empty(el['atts']['days']) && pagelayer_empty(el['atts']['hours']) && pagelayer_empty(el['atts']['minutes']) && pagelayer_empty(el['atts']['seconds']) ){
		jEle.find('.pagelayer-countdown-counter').html('<h2>Countdown Timer Holder</h2>');
	}
  
}

// Render the share
function pagelayer_render_pl_share(el){
	
	var icon_splited = el.atts['icon'].split(' fa-');
	
	var icon = icon_splited[1];
	
	if('text' in el.atts){
		el.atts['icon_label'] = el.atts['text'];
	}else{
		var labelList = { 'Facebook' : ['facebook', 'facebook-official', 'facebook-f', 'facebook-messenger', 'facebook-square'],
			'Twitter' : ['twitter', 'twitter-square'],
			'Google+' : ['google-plus', 'google-plus-square', 'google-plus-g'],
			'Instagram' : ['instagram'],
			'Linkedin' : ['linkedin', 'linkedin-square', 'linkedin-in'],
			'Pinterest' : ['pinterest', 'pinterest-p', 'pinterest-square'],
			'Reddit' : ['reddit-alien', 'reddit-square', 'reddit'],
			'Skype' : ['skype'],
			'Stumbleupon' : ['stumbleupon', 'stumbleupon-circle'],
			'Telegram' : ['telegram', 'telegram-plane'],
			'Tumblr' : ['tumblr', 'tumblr-square'],
			'VK' : ['vk'],
			'Weibo' : ['weibo'],
			'WhatsApp' : ['whatsapp', 'whatsapp-square'],
			'WordPress' : ['wordpress', 'wordpress-simple'],
			'Xing' : ['xing', 'xing-square'],
			'Delicious' : ['delicious'],
			'Dribbble' : ['dribbble', 'dribbble-square'],
			'Snapchat' : ['snapchat-ghost']
		}
		
		jQuery.each(labelList, function(key, value){
			if(jQuery.inArray(icon, value) != -1){
				el.atts['icon_label'] = key;
			}
		});
	}
}

// Render the share icon
function pagelayer_render_end_pl_share(el){
	pagelayer_social(el.$, '.pagelayer-share-content');
}

// copyright rendering function
var pagelayer_copyright;
function pagelayer_render_pl_copyright(el){
	if(pagelayer_empty(el.atts['copyright_text'])){
		return;
	}
	pagelayer_copyright = el.atts['copyright_text'];
	
}

// Render the animated heading
function pagelayer_render_pl_anim_heading(el){
	
	el.atts['rotate_html'] = '';
	
	// Creates html for rotating text
	if(!pagelayer_empty(el.atts['rotate_text'])){
		
		var rotate_text = '';
		rotate_text = el.atts['rotate_text'].split(',');
		
		el.atts['rotate_html'] += '<div class="pagelayer-animated-heading pagelayer-rotating-text pagelayer-words-wrapper">';
		
		jQuery.each(rotate_text, function(i){
			el.atts['rotate_html'] += '<span';
			if(i == 0){
				el.atts['rotate_html'] += ' class="pagelayer-is-visible"';
			}
			el.atts['rotate_html'] += '>' + rotate_text[i] + '</span>';
		});
		
		el.atts['rotate_html'] += '</div>';
	   
	}
	
	// Required classes for particular rotate
	el.atts['rotate_req'] = '';
	var letters = ['pagelayer-aheading-rotate2','pagelayer-aheading-rotate3','type','pagelayer-aheading-scale'];
	
	if(jQuery.inArray(el.atts['animations'], letters) != -1){
		el.atts['rotate_req'] = 'letters ';
	}
	
	if(el.atts['animations'] == 'pagelayer-aheading-clip'){
		el.atts['rotate_req'] = 'is-full-width ';
	}
	
}

// Render animated heading
function pagelayer_render_end_pl_anim_heading(el){
	var jEle = el.$;
	pagelayer_anim_heading(jEle);	
}

function pagelayer_render_pl_post_title(el){
	el['atts']['open_html_tag'] = !pagelayer_empty(el['atts']['html_tag']) ? '<'+el['atts']['html_tag']+'>' : '';
	el['atts']['close_html_tag'] = !pagelayer_empty(el['atts']['html_tag']) ? '</'+el['atts']['html_tag']+'>' : '';
}
////////////////
// Freemium End
////////////////





// The active pagelayer element
var pagelayer_active = {};

// List of pagelayer icons
var pagelayer_icons = {};

// The inline editor
var pagelayer_editor = {};

// The active pagelayer element
var pagelayer_active_tab = {};

// The menu items refrence
var pagelayer_menus_items_ref = {};

// Loads the Data
function pagelayer_data(jEle, clean){
	
	var ret = new Object();
	
	// Get the data
	ret.tag = pagelayer_tag(jEle);
	ret.id = pagelayer_id(jEle);
	ret.$ = jEle;
	
	var ref_data = pagelayer_el_data_ref(jEle);
	
	// Parse the attributes
	ret.atts = JSON.parse(JSON.stringify(ref_data['attr']));
	ret.tmp = JSON.parse(JSON.stringify(ref_data['tmp']));
	
	//console.log(ret.atts);
	//console.log(ret.tmp);
	
	clean = clean || false;
	
	// Remove values which have 'req'. NOTE : 'show' ones will be allowed
	if(clean){
		
		var tag = ret.tag;
		
		// Anything to set ?
		ret.set = {};
		
		// Function to clear any att data
		var pagelayer_delete_atts = function(x){
			delete ret.atts[x];
			delete ret.atts[x+'_tablet'];// Any tablet and mobile values as well
			delete ret.atts[x+'_mobile'];
			delete ret.set[x];		
		}
		
		// All props
		var all_props = pagelayer_shortcodes[tag];
		
		// Loop through all props
		for(var i in pagelayer_tabs){
			
			var tab = pagelayer_tabs[i];
			
			section_loop1:
			for(var section in all_props[tab]){
				
				// Any section to skip by post type ?
				if(!pagelayer_empty(all_props['post_type_cats'])){					
					for(var post_type in all_props['post_type_cats']){
						if(pagelayer_post.post_type != post_type && jQuery.inArray(section, all_props['post_type_cats'][post_type]) > -1){
							continue section_loop1;
						}
					}
				}
        
				var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
				
				// In case of widgets its possible !
				if(pagelayer_empty(props)){
					continue;
				}
				
				for(var x in props){
					
					var prop = props[x];
				
					// Any prop to skip ?
					if(!pagelayer_empty(all_props['skip_props']) && jQuery.inArray(x, all_props['skip_props']) > -1){
						pagelayer_delete_atts(x);
						continue;
					}
					
					// Are we to set this value ?
					if(!(x in ret.atts) && 'default' in prop && !pagelayer_empty(prop['default'])){
				
						// We need to make sure its not a PRO value
						if(!('pro' in prop && pagelayer_empty(pagelayer_pro))){
							
							var tmp_val = prop['default'];
							
							// If there is a unit and there is no unit suffix in atts value
							if('units' in prop){
								if(jQuery.isNumeric(tmp_val)){
									tmp_val = tmp_val+prop['units'][0];
								}else{
									var sep = 'sep' in prop ? prop['sep'] : ',';
									var tmp2 = tmp_val.split(sep);
									for(var k in tmp2){
										if(jQuery.isNumeric(tmp2[k])){
											tmp2[k] = tmp2[k]+prop['units'][0];
										}
									}
									tmp_val = tmp2.join(sep);
								}
							}
							
							//console.log(x+' - '+tmp_val);
							ret.set[x] = tmp_val;
							
						}
					}
					
					if(!('req' in prop)){
						continue;
					}
					
					//console.log('[pagelayer_data] Cleaning :'+x);
					
					// List of considerations
					var show = prop['req'];
					
					// We will hide by default
					var toShow = true;
					
					for(var showParam in show){
						var reqval = show[showParam];
						var except = showParam.substr(0, 1) == '!' ? true : false;
						showParam = except ? showParam.substr(1) : showParam;
						var val = ret.atts[showParam] || '';
						
						//console.log('Show '+x+' '+showParam+' '+reqval+' '+val);
						
						// Is the value not the same, then we can show
						if(except){
							
							if(typeof reqval == 'string' && reqval == val){
								toShow = false;
								break;
							}
							
							// Its an array and a value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) > -1){
								toShow = false;
								break;
							}
							
						// The value must be equal
						}else{
							
							 if(typeof reqval == 'string' && reqval != val){
								toShow = false;
								break;
							 }
							
							// Its an array and no value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) === -1){
								toShow = false;
								break;
							}
						}
						
					}
					
					// Are we to show ?
					if(!toShow){
						//console.log('Delete : '+x);
						pagelayer_delete_atts(x);
					}
				}
			}
		}
		
	}
	
	return ret;
	
};

// Setup the properties
function pagelayer_elpd_setup(){

	// The Dialag box of the element properties
	// pagelayer-ELPD - Element Properties Dialog
	pagelayer_elpd_html = '<div class="pagelayer-elpd-tabs">'+
			'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="settings" pagelayer-elpd-active-tab=1>Settings</div>'+
			//'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="styles">Style</div>'+
			'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="options">Options</div>'+
			'<div class="pagelayer-advanced-props pagelayer-elpd-tab pagelayer-hidden" pagelayer-elpd-tab="advanced">Advanced</div>'+
			'<div class="pagelayer-elpd-options">'+
				'<i class="pli pli-clone" ></i>'+
				'<i class="pli pli-trashcan" ></i>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elpd-body"></div>'+
		'<div class="pagelayer-elpd-holder"></div>';
	
	// Create the dialog box
	pagelayer.$$('#pagelayer-elpd').append(pagelayer_elpd_html);
	pagelayer_elpd = pagelayer.$$('#pagelayer-elpd');
	
	pagelayer.$$('.pagelayer-elpd-close').on('click', function(){
		pagelayer_leftbar_tab('pagelayer-shortcodes');
		pagelayer.$$('[pagelayer-widget-tab="widgets"]').click();
		pagelayer.$$('.pagelayer-elpd-header').hide();
		pagelayer.$$('.pagelayer-logo').show();
		pagelayer.$$('.pagelayer-elpd-body').removeAttr('pagelayer-element-id').empty();
		pagelayer_active = {};
	});
	
	// Copy
	pagelayer.$$('.pagelayer-elpd-options>.pli-clone').on('click', function(){
		pagelayer_copy_element(pagelayer_active.el.$);
	});
	
	// Delete
	pagelayer.$$('.pagelayer-elpd-options>.pli-trashcan').on('click', function(){
		pagelayer_delete_element(pagelayer_active.el.$);
		//pagelayer.$$('.pagelayer-elpd-close').click();
	});
	
	// The advanced props
	pagelayer_elpd.find('.pagelayer-advanced-props').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		var propsModal = pagelayer.$$('.pagelayer-props-modal');
		if(propsModal.find('.pagelayer-meta-iframe').length < 1){
			propsModal.find('.pagelayer-props-wrap').append('<iframe class="pagelayer-meta-iframe" src="'+ pagelayer_post_props +'" style="display:none"></iframe>');
			propsModal.find('.pagelayer-meta-iframe').load(function(){
				propsModal.find('.pagelayer-props-loading-screen').hide();				
				propsModal.find('.pagelayer-props-modal-close').css('visibility','visible');
				jQuery(this).show();
			});
		}
		
		propsModal.show();
		pagelayer.$$('.pagelayer-meta-iframe').contents().find('.pagelayer-tab-items[data-tab="post_props"]').click();
	});
		
	// The tabs
	pagelayer_elpd.find('.pagelayer-elpd-tab').on('click', function(){

		var jEle = jQuery(this);
		var attr = 'pagelayer-elpd-active-tab';
		var tab = jEle.attr('pagelayer-elpd-tab');
		
		if(tab == 'advanced'){
			return;
		}
		
		pagelayer_elpd.find('.pagelayer-elpd-tab').each(function(){
			jQuery(this).removeAttr(attr);
		});
		
		jEle.attr(attr, 1);
		
		// Trigger the showing of rows
		pagelayer_elpd_show_rows();
	});
	
};

// Open the properties
function pagelayer_elpd_open(jEle){
	
	// Set pagelayer history FALSE
	pagelayer.history_action = false;
	
	// Set the position of the element and show
	//pagelayer_elpd.css('left', pagelayer_elpd_pos[0]);
	//pagelayer_elpd.css('top', pagelayer_elpd_pos[1]);
	pagelayer_leftbar_tab('pagelayer-elpd');
	pagelayer.$$('[pagelayer-elpd-tab=settings]').show();
	pagelayer.$$('.pagelayer-elpd-header').show();
	pagelayer.$$('.pagelayer-logo').hide();
	
	// The property holder
	var holder = pagelayer.$$('.pagelayer-elpd-body');
	holder.html(' ');
	
	var el = pagelayer_elpd_generate(jEle, holder);
	
	// Set the active element
	pagelayer_active.el = el;
	
	// Set the header
	pagelayer.$$('.pagelayer-elpd-title').html('Edit '+pagelayer_shortcodes[el.tag]['name']);
	
	// Set pagelayer history TRUE
	pagelayer.history_action = true;
	
	// Render tooltips for the ELPD
	pagelayer_tooltip_setup();
	
};

// Show the properties window
function pagelayer_elpd_generate(jEle, holder){
	
	// Get the id, tag, atts, data, etc
	var el = pagelayer_data(jEle);
	//console.log(el);
	
	// Is it a valid type ?
	if(pagelayer_empty(pagelayer_shortcodes[el.tag])){
		pagelayer_error('Could not find this shortcode : '+el.tag);
		return;
	}
	
	// Set the holder
	holder.attr('pagelayer-element-id', el.id);
	//console.log(el.id);
	
	var all_props = pagelayer_shortcodes[el.tag];
	
	var sec_open_class = 'pagelayer-elpd-section-open';
	
	for(var i in pagelayer_tabs){
		var tab = pagelayer_tabs[i];
		var section_close = false;// First section always open
		
		section_loop2:
		for(var section in all_props[tab]){
			//console.log(tab+' '+section);
				
			// Any section to skip by post type ?
			if(!pagelayer_empty(all_props['post_type_cats'])){					
				for(var post_type in all_props['post_type_cats']){
					if(pagelayer_post.post_type != post_type && jQuery.inArray(section, all_props['post_type_cats'][post_type]) > -1){
						continue section_loop2;
					}
				}
			}
				
			var props = section in pagelayer_shortcodes[el.tag] ? pagelayer_shortcodes[el.tag][section] : pagelayer_styles[section];
			//console.log(props);
			
			
			var sec = jQuery('<div class="pagelayer-elpd-section" section="'+section+'" pagelayer-show-tab="'+tab+'">'+
					'<div class="pagelayer-elpd-section-name '+sec_open_class+'"><i class="pli"></i>'+all_props[tab][section]+'</div>'+
					'<div class="pagelayer-elpd-section-rows"></div>'+
					'</div>');
			holder.append(sec);
			
			// The row holder
			sec = sec.find('.pagelayer-elpd-section-rows');
			
			// Close all except the first section
			if(section_close){
				sec.hide().prev().removeClass(sec_open_class);
			}
			section_close = true;
			
			if('widget' in all_props && section == 'params'){
				pagelayer_elpd_widget_settings(el, sec, true);
				continue;
			}
			
			var mode = pagelayer_get_screen_mode();
	
			// Reset / Create the cache
			for(var x in props){
				
				props[x]['c'] = new Object();
				props[x]['c']['val'] = '';// Blank Val		
				props[x]['c']['name'] = x;// Add the Name of the row i.e. attribute of the element
				var prop_name = x;
				
				// Do we have screen ?
				if('screen' in props[x] && mode != 'desktop'){
					prop_name = x +'_'+mode;
				}
				
				// Set default to value of attribute if any
				if(prop_name in el.atts){
					props[x]['c']['val'] = el.atts[prop_name];
				}
				
				// Set element
				props[x]['el'] = el;
				
				// Any prop to skip ?
				if(!pagelayer_empty(all_props['skip_props']) && jQuery.inArray(x, all_props['skip_props']) > -1){
					continue;
				}
		
				// Add the row
				pagelayer_elpd_row(sec, tab, section, props, x);
				
			}
			
			// Hide empty sections
			if(sec.html().length < 1){
				//console.log(section+' - '+sec.html().length);
				sec.parent().remove();
			}
		}
	}
	
	/*// Set the default values in the PROPERTIES
	var fn_load = window['pagelayer_load_elp_'+el.tag];
	
	if(typeof fn_load == 'function'){
		fn_load(el, props);
	}*/
	
	// Hide clone and delete options
	if(!pagelayer_empty(all_props['hide_active']) && (pagelayer_empty(pagelayer_active.el) || pagelayer_active.el.id == el.id)){
		pagelayer.$$('.pagelayer-elpd-options').addClass('pagelayer-hidden');
	}else{
		pagelayer.$$('.pagelayer-elpd-options').removeClass('pagelayer-hidden');
	}
	
	// Add Advanced settings options for the props
	if(el.tag == 'pl_post_props'){
		pagelayer.$$('.pagelayer-elpd-tab[pagelayer-elpd-tab="advanced"]').removeClass('pagelayer-hidden');
	}else{
		pagelayer.$$('.pagelayer-elpd-tab[pagelayer-elpd-tab="advanced"]').addClass('pagelayer-hidden');
	}
	
	// Section open close
	holder.find('>.pagelayer-elpd-section>.pagelayer-elpd-section-name').on('click', function(){
		var _sec = jQuery(this);
		var par = _sec.parent();
		
		pagelayer_active_tab.id = el.id;
		pagelayer_active_tab.section = par.attr('section');
		
		// Get the active tab
		var active_tab = pagelayer_elpd.find('[pagelayer-elpd-active-tab]').attr('pagelayer-elpd-tab');
		
		// Close all but dont touch yourself
		holder.children().each(function (){
			var curSec = jQuery(this);
			if(par.is(curSec)) return;// Skip the current option
			if(curSec.attr('pagelayer-show-tab') != active_tab) return;// Skip the non active tabs as is
			curSec.find('.pagelayer-elpd-section-rows').hide().prev().removeClass(sec_open_class);
		});
		
		// Now toggle your self
		par.find('.pagelayer-elpd-section-rows').toggle();
		
		if(_sec.next().is(':visible')){
			_sec.addClass(sec_open_class);
		}else{
			_sec.removeClass(sec_open_class);
		}
		
	});
	
	if(!pagelayer_empty(pagelayer_active_tab) && pagelayer_active_tab.id == el.id){
		holder.find('>[section='+pagelayer_active_tab.section+']>.pagelayer-elpd-section-name').click();
	}
	
	// Handle the showing of rows
	pagelayer_elpd_show_rows();
	
	return el;
	
};

// Show a row
function pagelayer_elpd_row(holder, tab, section, props, name){

	// The Prop
	var prop = props[name];
	//console.log(tab+' '+name+' '+prop.el.tag);
	
	var fn = window['pagelayer_elp_'+prop['type']];
	
	if(typeof fn == 'function'){
		
		var row = jQuery('<div class="pagelayer-form-item" pagelayer-elp-name="'+name+'" />');
		
		// Append the row
		holder.append(row);
		
		return pagelayer_elpd_render_row(row, prop);
		
	}
	
};

// Render a row
function pagelayer_elpd_render_row(row, prop){
	
	var fn = window['pagelayer_elp_'+prop['type']];
		
	if('group' in prop){
		row.attr('pagelayer-access-item', prop.group);
	}
	
	var fn_ui = window['pagelayer_elp_'+prop['type']+'_ui'];
	
	// Is there a UI Handler ?
	if(typeof fn_ui == 'function'){
		
		fn_ui(row, prop);
		
	// Use the default mechanism
	}else{
			
		// The label
		pagelayer_elp_label(row, prop);
		
		// The main property
		fn(row, prop);
		
		// Showing default button or not
		if(pagelayer_properties_filter(prop['type']) && pagelayer_empty(row.find('.pagelayer-pro-req').length)){
			pagelayer_show_default_button(row, prop, prop.c['val']);		
		}
		
		// Is there a description ?
		if(!pagelayer_empty(prop['desc'])){
			pagelayer_elp_desc(row, prop['desc']);
		}
		
	}
	
	if('script' in prop){
		row.append('<script>'+prop.script+'</script>');
	}
	
	return row;
}

// Show the rows as per the active tab and also handle the rows that are supposed to be shown or not
function pagelayer_elpd_show_rows(){
	
	//console.log('Called');
	
	// Get the active tab
	var active_tab = pagelayer_elpd.find('[pagelayer-elpd-active-tab]').attr('pagelayer-elpd-tab');
	
	pagelayer_elpd.find('[pagelayer-show-tab]').each(function(){
		var sec = jQuery(this);
		
		// Is it the active tab ? 
		if(sec.attr('pagelayer-show-tab') != active_tab){
			sec.hide();
		}else{
			sec.show();
		}
	});
	
	// Find all Elements in the Property dialog and loop
	pagelayer_elpd.find('[pagelayer-element-id]').each(function(){
		
		var holder = jQuery(this);
		var id = holder.attr('pagelayer-element-id');
		var jEle = pagelayer_ele_by_id(id);
		var tag = pagelayer_tag(jEle);
		//console.log('Main : '+id+' - '+tag);
		//console.log(pagelayer_active);
		
		// All props
		var all_props = pagelayer_shortcodes[tag];
		
		// Loop through all props
		for(var i in pagelayer_tabs){
			
			var tab = pagelayer_tabs[i];

			for(var section in all_props[tab]){
				
				var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
				
				for(var x in props){
					
					var prop = props[x];
					
					// If the prop is a group, we continue
					if(prop['type'] == 'group'){
						continue;
					}
					
					// Find the row
					var row = false;
					
					holder.find('[pagelayer-elp-name="'+x+'"]').each(function(){
						var j = jQuery(this);
						var _id = j.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
						//console.log(_id+' = '+id);
						
						// Is the parent the same ?
						if(_id == id){
							row = j;
						}
					});
					
					// Do you have a show or hide ?
					if(!row){
						//console.log('Not Found : '+x+' - '+id);
						continue;
					}
					
					// Is the row visible ?
					if(row.closest('[pagelayer-show-tab]').attr('pagelayer-show-tab') != active_tab){
						row.hide();
						continue;
					}
					
					// Now lets show or hide the element
					if(!('req' in prop || 'show' in prop)){
						row.show();
						continue;
					}
					
					// List of considerations
					var show = {};
					
					// We have both req and show, so lets just combine the values and then show
					// NOTE : We need to make an array and not just merge the 2 as they are references
					if('req' in prop && 'show' in prop){
						
						// Add the req values
						show = JSON.parse(JSON.stringify(prop['req']));
						
						// Now the show values need to be looped
						for(var t in prop['show']){
							show[t] = prop['show'][t];
						}
						
					}else{
						show = 'req' in prop ? prop['req'] : prop['show'];
					}
					
					// We will hide by default
					var toShow = true;
					
					for(var showParam in show){
						var reqval = show[showParam];
						var except = showParam.substr(0, 1) == '!' ? true : false;
						showParam = except ? showParam.substr(1) : showParam;
						var val = pagelayer_get_att(jEle, showParam) || '';
						
						//console.log('Show '+x+' '+showParam+' '+reqval+' '+val);
						
						// Is the value not the same, then we can show
						if(except){
							
							if(typeof reqval == 'string' && reqval == val){
								toShow = false;
								break;
							}
							
							// Its an array and a value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) > -1){
								toShow = false;
								break;
							}
							
						// The value must be equal
						}else{
							
							 if(typeof reqval == 'string' && reqval != val){
								toShow = false;
								break;
							 }
							
							// Its an array and no value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) === -1){
								toShow = false;
								break;
							}
						}
					}
					
					// Are we to show ?
					if(toShow){
						row.show();
					}else{
						row.hide();
					}
					
				}
				
			}
		}
	
	});
	
}; 

var pagelayer_widget_timer;
var pagelayer_widget_cache = {};

// Load the widget settings
function pagelayer_elpd_widget_settings(el, sec, onfocus){
	
	var show_form = function(html){
				
		sec.html('<form class="pagelayer-widgets-form">'+html+'</form>');
		
		// Handle on form data change
		sec.find('form :input').on('change', function(){					
			//console.log('Changed !');
			
			// Clear any previous timeout
			clearTimeout(pagelayer_widget_timer);
			
			// Set a timer for constant change
			pagelayer_widget_timer = setTimeout(function(){ 
				pagelayer_elpd_widget_settings(el, sec);
				//console.log('Calling');
			}, 500);
			
		});
	}
	
	// Is it onfocus ?
	onfocus = onfocus || false;
	
	// Its an onfocus
	if(onfocus && el.id in pagelayer_widget_cache){
		show_form(pagelayer_widget_cache[el.id]);
		return true;
	}
	
	var post = {};
	post['action'] = 'pagelayer_wp_widget';
	post['pagelayer_nonce']	= pagelayer_ajax_nonce;
	post['tag'] = el.tag;
	post['pagelayer-id'] = el.id;
	
	// Any atts ?
	if('widget_data' in el.atts){
		post['widget_data'] = el.atts['widget_data'];
	}
	
	// Post any existing data
	var form = sec.find('form');
  // Archive widget checkbox fix
	var inputCheckbox = form.find('input[type=checkbox]');
	for(var i=0; i<inputCheckbox.length; i++){
		if(inputCheckbox[i].value == 'on'){
			form.find('input[type=checkbox]')[i].value = 1;
		}
	}
	
	if(form.length > 0){
		//console.log(form.serialize());
		post['values'] = form.serialize();
	}
	
	jQuery.ajax({
		url: pagelayer_ajax_url,
		type: 'post',
		data: post,
		success: function(data) {
			//console.log('Widget Data');console.log(data);
			
			// Show the form
			if('form' in data){
				show_form(data['form']);
				
				// Store in cache
				pagelayer_widget_cache[el.id] = data['form'];
			}
			
			// Show the content
			if('html' in data){
				el.$.html(data['html']);
				pagelayer_sc_render(el.$);// Re-Render the CSS
			}
			
			// Any set attributes ?
			if('widget_data' in data){
				pagelayer_set_atts(el.$, 'widget_data', JSON.stringify(data['widget_data']));
			}
			
		},
		fail: function(data) {
			pagelayer_show_msg('Some error occured in getting the widget data', 'error');						
		}
	});
	
}

// Will set the attribute and also render
function _pagelayer_set_atts(row, val, no_default){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	var tag = pagelayer_tag(jEle);
	var prop_name = row.attr('pagelayer-elp-name');	
	var prop = pagelayer.props_ref[tag][prop_name];
	
	// Is there a unit ?
	var uEle = row.find('.pagelayer-elp-units');
	if(uEle.length > 0 && !pagelayer_empty(val)){
		var unit = uEle.find('[selected]').html();
		if(Array.isArray(val)){
			for(var i in val){
				if(val[i].length < 1){
					continue;
				}
				val[i] = val[i]+unit;
			}
		}else{
			val = val+unit;
		}
	}
	
	// Are we in another mode ?
	var mode = ('screen' in prop && pagelayer_get_screen_mode() != 'desktop') ? '_'+pagelayer_get_screen_mode() : '';
	
	pagelayer_set_atts(jEle, prop_name+mode, val);
	
	// Are we to skip setting defaults ?
	no_default = no_default || false;
	if(!no_default){
		
		// We need to set defaults for dependents
		var hasSet = pagelayer_set_default_atts(jEle, 5);
		
		// We need to reopen the left panel
		// Note : If two simultaneous calls are made, then this will cause problems
		// Also after this is called, ROW is destroyed and no other row related stuff will work i.e. set_atts in the same calls will fail
		if(hasSet){
			pagelayer_elpd_open(jEle);
		}
	}
	//console.trace();console.log('Setting Attr');
	
	// Render
	pagelayer_sc_render(jEle);
  
	// Show default button or not
	if(pagelayer_properties_filter(prop) && pagelayer_empty(row.find('.pagelayer-pro-req').length)){
			pagelayer_show_default_button(row, prop, val);      
	}
	
	if('onchange' in prop){
		var fn = window[prop['onchange']];
		if(typeof fn === 'function'){
			fn(jEle, row, val);
		}
	}
};

// Will set the attribute but not render
function _pagelayer_set_tmp_atts(row, suffix, val){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	pagelayer_set_tmp_atts(jEle, row.attr('pagelayer-elp-name')+(suffix.length > 0 ? '-'+suffix : ''), val);
};

// Will clear the attribute but not render
function _pagelayer_clear_tmp_atts(row){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	pagelayer_clear_tmp_atts(jEle, row.attr('pagelayer-elp-name'));
};

// Get the attribute of images only
function _pagelayer_img_tmp_atts(row){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	return pagelayer_img_tmp_atts(jEle, row.attr('pagelayer-elp-name'));
};

// Get the tmp att
function _pagelayer_get_tmp_att(row, suffix){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	return pagelayer_get_tmp_att(jEle, row.attr('pagelayer-elp-name')+'-'+suffix);
};

// Create the Label
function pagelayer_elp_label(row, prop){
	row.append('<div class="pagelayer-elp-label-div" type="'+prop['type']+'"><label class="pagelayer-elp-label">'+prop['label']+'</label></div>');
	
	var label = row.children('.pagelayer-elp-label-div');
	
	// Do we have screen ?
	if('screen' in prop){
		var mode = pagelayer_get_screen_mode();
		var screen = '<div class="pagelayer-elp-screen">'+
			'<i class="pli pli-desktop" ></i>'+
			'<i class="pli pli-tablet" ></i>'+
			'<i class="pli pli-mobile" ></i>'+
			'<i class="pagelayer-prop-screen pli pli-'+mode+'" ></i>'+
		'</div>';
		label.append(screen);
		
		// Set screen mode on change
		label.find('.pli:not(.pagelayer-prop-screen)').on('click', function(){
			var mode = 'desktop';
			var jEle = jQuery(this);
			
			// Tablet ?
			if(jEle.hasClass('pli-tablet')){
				mode = 'tablet';
			}
			
			// Mobile ?
			if(jEle.hasClass('pli-mobile')){
				mode = 'mobile';
			}
			
			pagelayer_set_screen_mode(mode);
			label.find('.pagelayer-elp-screen .pli').removeClass('open');
			
		});
		
		// On change of screen handle the values
		label.find('.pagelayer-elp-screen').on('pagelayer-screen-changed', function(e){
			
			label.find('.pagelayer-elp-screen .pli').removeClass('open');
			var mode = pagelayer_get_screen_mode();
			var modes = {desktop: '', tablet: '_tablet', mobile: '_mobile'};
			
			// Get the current current new val
			prop.c['val'] = pagelayer_get_att(prop.el.$, prop.c['name']+modes[mode]);
			
			// Handle the amount
			if(pagelayer_empty(prop.c['val'])){
				prop.c['val'] = '';
			}
			
			// Remove the siblings
			label.siblings().each(function(){
				var j = jQuery(this);
				
				if(j.hasClass('pagelayer-elp-desc')){
					return;
				}
				
				j.remove();
			});
			
			// Create the vals again
			var fn = window['pagelayer_elp_'+prop['type']];
			
			// The main property
			fn(row, prop);
			
		});
		
		label.find('.pagelayer-elp-screen .pagelayer-prop-screen').on('click', function(e){
			jQuery(this).siblings().toggleClass('open');
		})
		
	}
	
	// Do we have pro version requirement ?
	if('pro' in prop && pagelayer_empty(pagelayer_pro)){
		var txt = prop['pro'].length > 1 ? prop['pro'] : pagelayer.pro_txt;
		var pro = jQuery('<div class="pagelayer-pro-req">Pro</div>');
		pro.attr('data-tlite', txt);
		label.append(pro);
	}
	
	// Do we have units ?
	if('units' in prop){
		
		var units = '';	
		var tmp_val = prop.c['val'];
		var default_unit = 0;
		
		// Get unit from value
		if(!(pagelayer_empty(tmp_val))){
			
			for(var i in prop['units']){
				if(pagelayer_is_string(tmp_val) && tmp_val.search(prop['units'][i]) != -1){
					default_unit = i;
				}else if(tmp_val[0].search(prop['units'][i]) != -1 ){
					default_unit = i;
				}
			}
		}
		
		for(var i in prop['units']){
			units += '<span '+(i == default_unit ? 'selected' : '')+'>'+prop['units'][i]+'</span>';
		}
		
		label.append('<div class="pagelayer-elp-units">'+units+'</div>');
		
		// Set unit on change
		label.find('.pagelayer-elp-units span').on('click', function(){
			
			label.find('.pagelayer-elp-units span').each(function(){
				jQuery(this).removeAttr('selected');
			});
			
			jQuery(this).attr('selected', 1);
			
		});
		
	}
	
	// Include default button
	if(pagelayer_properties_filter(prop['type']) && pagelayer_empty(row.find('.pagelayer-pro-req').length)){
		
		var defaultButton = '<span class="pagelayer-elp-default" title="'+pagelayer_l('back_to_default')+'" ><i class="fas fa-undo"></i></span>';		
		label.append(defaultButton);
		
		label.find('.pagelayer-elp-default').on('click', function(){

			prop.c['val'] = ('default' in prop) ? prop.default : '';
			_pagelayer_set_atts(row, prop.c['val']);			
			
			jQuery(this).attr('data_show',false);
      
			// Empty the row
			row.html('');
			
			// Re-render the row
			pagelayer_elpd_render_row(row, prop);
			
		});	
	}
};

// Create the Description
function pagelayer_elp_desc(row, label){
	row.append('<div class="pagelayer-elp-desc">'+label+'</div>');
};

// The Text property
function pagelayer_elp_text(row, prop){
	
	var div = '<div class="pagelayer-elp-text-div">'+
				'<input type="text" class="pagelayer-elp-text" name="'+prop.c['name']+'" value="'+pagelayer_htmlEntities(prop.c['val'])+'"></input>'+
			'</div>';
	
	row.append(div);
	
	row.find('input').on('input', function(){
		_pagelayer_set_atts(row, jQuery(this).val());// Save and Render
	});
	
};

// The Select property
function pagelayer_elp_select(row, prop){
	
	var options = '';
	var option = function(val, lang){
		var selected = (val != prop.c['val']) ? '' : 'selected="selected"';
		return '<option class="pagelayer-elp-select-option" value="'+val+'" '+selected+'>'+lang+'</option>';
	}
	
	for (x in prop['list']){
		
		// Single item
		if(typeof prop['list'][x] == 'string'){
			options += option(x, prop['list'][x]);
		
		// Groups
		}else{
			options += '<optgroup label="'+x+'">';
			
			for(var y in prop['list'][x]){
				options += option(y, prop['list'][x][y]);
			}
			
			options += '</optgroup>';
		}
	}
	
	var div = '<div class="pagelayer-elp-select-div pagelayer-elp-pos-rel">'+
				'<select class="pagelayer-elp-select pagelayer-select" name="'+prop.c['name']+'">'+options+'</select>'+
  '</div>';
			
	row.append(div);
	
	row.find('select').on('change', function(){
		
		var sEle = jQuery(this);
		
		if(sEle.attr('name') == "animation"){
			_pagelayer_trigger_anim(row, sEle.val());
		}
		
		_pagelayer_set_atts(row, sEle.val());// Save and Render		
	
	});
	
}

// The MultiSelect property
function pagelayer_elp_multiselect(row, prop){
	
	var selection = [];
	if(!pagelayer_empty(prop.c['val'])){
		//selection = JSON.parse(prop.c['val']);
		selection = prop.c['val'].split(',');
	}
	
	var options = '';
	var option = function(val, lang){
		var selected = (jQuery.inArray(val,selection) == -1 ? '' : 'selected="selected"');
		return '<li class="pagelayer-elp-multiselect-option" data-val="'+val+'" '+selected+'>'+lang+'</li>';
	}
	
	var show_sel = function(val){
		var sel_html = '';
		jQuery.each(val, function(index, value){
			sel_html += '<span class="pagelayer-elp-multiselect-selected" data-val="'+value+'">'+prop['list'][value]+' <span class="pagelayer-elp-multiselect-remove">x</span></span>';
		});
		return sel_html;
	}
	
	var setup_remove = function(){
		row.find('.pagelayer-elp-multiselect-remove').on('click', function(){
			var sVal = jQuery(this).parent().attr('data-val');
			row.find('.pagelayer-elp-multiselect-option[data-val='+sVal+']').click();
		});
	}
	
	for (x in prop['list']){
		options += option(x, prop['list'][x]);
	}
	
	var div = '<div class="pagelayer-elp-multiselect-div pagelayer-elp-pos-rel">'+
				'<div class="pagelayer-elp-multiselect">'+show_sel(selection)+'</div>'+
				'<ul class="pagelayer-elp-multiselect-ul" name="'+prop.c['name']+'">'+options+'</ul>'+
			'</div>';
  
	row.append(div);
	setup_remove();
	
	row.find('.pagelayer-elp-multiselect-option').on('click', function(){
		
		var sVal = jQuery(this).attr('data-val');
		
		if(jQuery.inArray(sVal,selection) == -1){
			selection.push(sVal);
			row.find('[data-val="'+sVal+'"]').attr('selected','selected');
		}else{
			selection.splice(jQuery.inArray(sVal,selection),1);
			row.find('[data-val="'+sVal+'"]').removeAttr('selected');
		}
		
		//_pagelayer_set_atts(row,JSON.stringify(selection));// Save and Render
		_pagelayer_set_atts(row, selection.join(','));// Save and Render
		
		row.find('.pagelayer-elp-multiselect').html(show_sel(selection));		
		setup_remove();
		
	});
	
	// Open the selector
	row.find('.pagelayer-elp-multiselect').on('click', function(){
		row.find('.pagelayer-elp-multiselect-ul').slideToggle(100);
	});
	
}

function _pagelayer_trigger_anim(row, anim){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var classList = jQuery('[pagelayer-id='+id+']').attr('class');
	classList = classList.split(/\s+/);
	//console.log(classList);
	var options = [];
	row.find('option').each(function(){
		var found = jQuery.inArray( jQuery(this).val(), classList );
		if( found != -1){
			//var found = jQuery(this).val();
			jQuery('[pagelayer-id='+id+']').removeClass(jQuery(this).val());
			//break;
		}
		//options.push(jQuery(this).val());
	});
	jQuery('[pagelayer-id='+id+']').removeClass('pagelayer-wow').addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		jQuery(this).removeClass(anim+ ' animated');
	});
}

// The Checkbox property
function pagelayer_elp_checkbox(row, prop){
	
	var div = '<div class="pagelayer-elp-checkbox-div">'+
				'<input type="checkbox" name="'+prop.c['name']+'" class="pagelayer-elp-checkbox" />'+
			'</div>';
	
	row.append(div);

	if(prop.c['val'].length > 0){
		row.find('input').attr('checked', 'checked');
	}else{
		row.find('input').removeAttr('checked');
	}
	
	// When the change is called
	row.find('input').on('change', function(){
		
		// We set to string true or false
		var val = jQuery(this).is(':checked') ? 'true' : '';
		
		_pagelayer_set_atts(row, val);// Save and Render
	});
	
}

// The Radio property
function pagelayer_elp_radio(row, prop){
	
	var active = 'pagelayer-elp-radio-active';
	var div = '<div class="pagelayer-elp-radio-div">';
	
	for(var x in prop.list){		
		var addclass = (prop.c['val'] == x) ? active : '';
		div += '<a class="pagelayer-elp-radio '+addclass+'" val="'+x+'">'+prop.list[x]+'</a>';
	}
	
	div += '</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-radio').each(function(){
		
		jQuery(this).on('click', function (){
			
			// Remove existing active class
			jQuery(this).parent().find('.'+active).removeClass(active);
			
			// Set active
			jQuery(this).addClass(active);
			
			_pagelayer_set_atts(row, jQuery(this).attr('val'));// Save and Render
			
		});
		
	});
	
}

// The Image Property
function pagelayer_elp_image(row, prop){
	
	var imgObj = {};
	var isRetina = false;
	
	// Is retina images options?
	if('retina' in prop && !pagelayer_empty(prop['retina'])){
		isRetina = true;
	}
	
	// Previously saved values
	if(typeof prop.c['val'] === 'object'){
		imgObj = prop.c['val'];
	}else{
		imgObj['img'] = prop.c['val'];
	}
  
	var tmp = prop.c['name']+'-url';
	var def = pagelayer.blank_img;
		
	// Background image URls
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : ((!pagelayer_empty(imgObj['img']) && String(imgObj['img']).search(/http(|s):\/\//i) == 0) ? imgObj['img'] : def );
	
	// Do we have a URL set ?
	var style = 'style="background-image:url(\''+src+'\')"';
	
	var div = '<div class="pagelayer-elp-image-div">'+
		'<div class="pagelayer-elp-drop-zone">'+
			'<div>'+
				'<i class="fas fa-upload"></i>'+
				'<h4>'+pagelayer_l('drop_file')+'</h4>'+
				'<div class="pagelayer-elp-img-up-progress">'+
					'<div class="pagelayer-elp-img-up-bar"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-image" '+style+'></div>'+
		'<div class="pagelayer-elp-image-delete"><i class="pli pli-trashcan" ></i></div>';
		
		// Retina image icon
		if(isRetina){
			div +=	'<div class="pagelayer-elp-image-retina"><i class="pli pli-eye" ></i></div>';
		}

	div +='</div>';

	// Add retina images option
	if(isRetina){
		
		var tmp_retina = prop.c['name']+'-retina-url';
		var tmp_retina_mobile = prop.c['name']+'-retina-mobile-url';
		
		var srcRetina = (tmp_retina in prop.el.tmp) ? prop.el.tmp[tmp_retina] : (('retina' in imgObj && !pagelayer_empty(imgObj['retina']) && String(imgObj['retina']).search(/http(|s):\/\//i) == 0) ? imgObj['retina'] : def );
	
		var srcRetinaMobile = (tmp_retina_mobile in prop.el.tmp) ? prop.el.tmp[tmp_retina_mobile] : (('retina_mobile' in imgObj && !pagelayer_empty(imgObj['retina_mobile']) && String(imgObj['retina_mobile']).search(/http(|s):\/\//i) == 0) ? imgObj['retina_mobile'] : def );
	
		var style_retina = 'style="background-image:url(\''+srcRetina+'\')"';
		var style_retina_mobile = 'style="background-image:url(\''+srcRetinaMobile+'\')"';
		
		div +='<div class="pagelayer-elp-label-div pagelayer-retina-label" type="image" style="display:none;">'+
			'<label class="pagelayer-elp-label">Select Retina Image</label>'+
		'</div>'+
		'<div class="pagelayer-elp-retina-image-div" style="display:none;">'+
			'<div class="pagelayer-elp-drop-zone">'+
				'<div>'+
					'<i class="fas fa-upload"></i>'+
					'<h4>'+pagelayer_l('drop_file')+'</h4>'+
					'<div class="pagelayer-elp-img-up-progress">'+
						'<div class="pagelayer-elp-img-up-bar"></div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="pagelayer-elp-image pagelayer-retina" '+style_retina+'></div>'+
			'<div class="pagelayer-elp-retina-delete"><i class="pli pli-trashcan" ></i></div>'+				
		'</div>'+
		'<div class="pagelayer-form-item">'+
			'<div class="pagelayer-elp-label-div pagelayer-retina-label" type="image" style="display:none;">'+
				'<label class="pagelayer-elp-label">Select Retina Image For Mobile</label>'+
			'</div>'+
			'<div class="pagelayer-elp-checkbox-div pagelayer-retina-label" style="display:none;">'+
				'<input type="checkbox" name="overlay" class="pagelayer-elp-checkbox pagelayer-retina-checkbox">'+
			'</div>'+
		'</div>'+
		
		'<div class="pagelayer-elp-retina-mobile-image-div" style="display:none;">'+
			'<div class="pagelayer-elp-drop-zone">'+
				'<div>'+
					'<i class="fas fa-upload"></i>'+
					'<h4>'+pagelayer_l('drop_file')+'</h4>'+
					'<div class="pagelayer-elp-img-up-progress">'+
						'<div class="pagelayer-elp-img-up-bar"></div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="pagelayer-elp-image pagelayer-retina-mobile" '+style_retina_mobile+'></div>'+
			'<div class="pagelayer-elp-retina-mobile-delete"><i class="pli pli-trashcan" ></i></div>'+
		'</div>';
	}
	
	row.append(div);
	
	if(def == src && jQuery.isNumeric(imgObj['img'])){
		wp.media.attachment(imgObj['img']).fetch().then(function (data){
			var fetch_url = wp.media.attachment(imgObj['img']).get('url')
			row.find('.pagelayer-elp-image-div .pagelayer-elp-image').css('background-image', 'url(\''+fetch_url+'\')');
			_pagelayer_set_tmp_atts(row, 'url', fetch_url);
		}).fail(function(){
			row.find('.pagelayer-elp-image-div .pagelayer-elp-image').css('background-image', 'url(\''+src+'\')')
		});
	}
	
	if(isRetina){
		if(def == srcRetina && 'retina' in imgObj && jQuery.isNumeric(imgObj['retina'])){
			wp.media.attachment(imgObj['retina']).fetch().then(function (data){
				var fetch_url = wp.media.attachment(imgObj['retina']).get('url')
				row.find('.pagelayer-retina').css('background-image', 'url(\''+fetch_url+'\')');
				_pagelayer_set_tmp_atts(row, 'retina-url', fetch_url);
			}).fail(function(){
				row.find('.pagelayer-retina').css('background-image', 'url(\''+srcRetina+'\')')
			});
		}
		
		if(def == srcRetinaMobile && 'retina_mobile' in imgObj && jQuery.isNumeric(imgObj['retina_mobile'])){
			wp.media.attachment(imgObj['retina_mobile']).fetch().then(function (data){
				var fetch_url = wp.media.attachment(imgObj['retina_mobile']).get('url')
				row.find('.pagelayer-retina-mobile').css('background-image', 'url(\''+fetch_url+'\')');
				_pagelayer_set_tmp_atts(row, 'retina-mobile-url', fetch_url);
			}).fail(function(){
				row.find('.pagelayer-retina-mobile').css('background-image', 'url(\''+srcRetinaMobile+'\')')
			});
		}
	}
	
	var getImgVal = function(val){
		
		if(typeof val === 'object' && pagelayer_length(val) == 1 && 'img' in val){
			return val['img'];
		}
		
		return val;
	}
	
	// Set an Image
	row.find('.pagelayer-elp-image').on('click', function(){
	
		var button = jQuery(this);
		var inRetina = button.hasClass('pagelayer-retina');
		var inRetinaM = button.hasClass('pagelayer-retina-mobile');
		
		// Load the frame
		var frame = pagelayer_select_frame('image');
		
		// On select update the stuff
		frame.on({
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					
					// Set the new ID and URL
					id = attachment.id;
					url = attachment.url;			
					var old = _pagelayer_img_tmp_atts(row);
					
					//console.log(attachment);
					if(inRetina){
						// To remove past temp attr so that they are not involve in future temp values						
						delete old[prop.c['name']+'-retina-url'];
						
						// Keep a list of all sizes
						for(var x in attachment.sizes){
							_pagelayer_set_tmp_atts(row, 'retina-'+x+'-url', attachment.sizes[x].url);
							delete old[prop.c['name']+'-retina-'+x+'-url'];
						}					
						
						for(var x in old){
							
							// Skip for retina and with url atts
							if(! x.endsWith('-url') || !x.startsWith(prop.c['name']+'-retina') || x.startsWith(prop.c['name']+'-retina-mobile')){
								continue;
							}
							
							_pagelayer_set_tmp_atts(row, x, '');
						}	
						
					}else if(inRetinaM){
						
						// To remove past temp attr so that they are not involve in future temp values	
						delete old[prop.c['name']+'-retina-mobile-url'];
						
						// Keep a list of all sizes
						for(var x in attachment.sizes){
							_pagelayer_set_tmp_atts(row, 'retina-mobile-'+x+'-url', attachment.sizes[x].url);
							delete old[prop.c['name']+'-retina-mobile-'+x+'-url'];
						}

						for(var x in old){
							
							// Skip for retina and with url atts
							if(! x.endsWith('-url') || ! x.startsWith(prop.c['name']+'-retina-mobile')){
								continue;
							}
							
							_pagelayer_set_tmp_atts(row, x, '');
						}						
						
					}else{
					
						// To remove past temp attr so that they are not involve in future temp values
						delete old[prop.c['name']+'-url'];
						
						// Keep a list of all sizes
						for(var x in attachment.sizes){
							_pagelayer_set_tmp_atts(row, x+'-url', attachment.sizes[x].url);
							delete old[prop.c['name']+'-'+x+'-url'];
						}
						
						for(var x in old){
							
							// Skip for retina and with url atts
							if(! x.endsWith('-url') || x.startsWith(prop.c['name']+'-retina')){
								continue;
							}
							
							_pagelayer_set_tmp_atts(row, x, '');
						}
					}	
				}
				
				// Update thumbnail
				button.css('background-image', 'url(\''+url+'\')');
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'no-image-set', '');
				
				if(inRetina){
					_pagelayer_set_tmp_atts(row, 'retina-url', url);
					imgObj['retina'] = id;
				}else if(inRetinaM){
					_pagelayer_set_tmp_atts(row, 'retina-mobile-url', url);
					imgObj['retina_mobile'] = id;
				}else{
					_pagelayer_set_tmp_atts(row, 'url', url);
					imgObj['img'] = id;
				}
				
				_pagelayer_set_atts(row, getImgVal(imgObj));
				
			},
			// On open select the appropriate images in the media manager
			'open': function() {			
				var selection =  frame.state().get('selection');
				var wp_id = pagelayer_get_att(prop.el.$, prop.c['name']);
				
				if(typeof wp_id === 'object'){
					if(inRetina){
						wp_id = ('retina' in wp_id && !pagelayer_empty(wp_id['retina']) ? wp_id['retina'] : 0 );
					}else if(inRetinaM){
						wp_id = ('retina_mobile' in wp_id && !pagelayer_empty(wp_id['retina_mobile']) ? wp_id['retina_mobile'] : 0 );
					}else{
						wp_id = (!pagelayer_empty(wp_id['img']) ? wp_id['img'] : 0 );
					}
				}
				
				selection.reset( wp_id ? [ wp.media.attachment( wp_id ) ] : [] );
			}
		});

		frame.open(button);
		
		return false;
		
	});
	
	// Finding and assigning values in the variables
	var dropzoneParent = row.find('.pagelayer-elp-image-div');
	var dropZone = row.find('.pagelayer-elp-drop-zone');
	
	// Inserting values in image drag and drop function
	pagelayer_img_dragAndDrop(dropzoneParent, dropZone, '', row);	
	
	row.find('.pagelayer-elp-image-retina').click(function(){
		row.find('.pagelayer-retina-label').toggle();
		row.find('.pagelayer-elp-retina-image-div').toggle();
		var checkval = row.find('.pagelayer-retina-checkbox').is(":checked");
		
		if(checkval == true){
			row.find('.pagelayer-retina-checkbox').trigger("click");
		}
	});
	
	row.find('.pagelayer-retina-checkbox').click(function(){
		row.find('.pagelayer-elp-retina-mobile-image-div').toggle();
	});
		
	// Delete this
	row.find('.pagelayer-elp-image-delete').on('click', function(){
		
		// Update thumbnail
		jQuery(this).parent().find('.pagelayer-elp-image').css('background-image', 'url(\''+def+'\')');
		
		// Set to blank and render
		_pagelayer_set_atts(row, '', true);
				
		imgObj['img'] = def;
		
		_pagelayer_set_tmp_atts(row, 'no-image-set', 1);
		_pagelayer_set_tmp_atts(row, 'url', def);
		_pagelayer_set_atts(row, getImgVal(imgObj));
	});
	
	row.find('.pagelayer-elp-retina-delete').on('click', function(){
		// Update thumbnail
		jQuery(this).parent().find('.pagelayer-elp-image').css('background-image', 'url(\''+def+'\')');
		delete imgObj['retina'];
    
		_pagelayer_set_tmp_atts(row, 'retina-url', def);
		_pagelayer_set_atts(row, getImgVal(imgObj));
		
	});
	
	row.find('.pagelayer-elp-retina-mobile-delete').on('click', function(){
		
		// Update thumbnail
		jQuery(this).parent().find('.pagelayer-elp-image').css('background-image', 'url(\''+def+'\')');
		delete imgObj['retina_mobile'];
		
		// Set to blank and render
		_pagelayer_set_tmp_atts(row, 'retina-mobile-url', def);
		_pagelayer_set_atts(row, getImgVal(imgObj));
		
	});
}

// Main image drag and drop function
function pagelayer_img_dragAndDrop(dropzoneParent, dropZone, jEle, row){
	
	var reset_dragging = false;
	
	dropzoneParent.on('dragover', function(e){
		e.preventDefault();
		// Checking that the dragged element is a file or not
		var dt = e.originalEvent.dataTransfer;
		if(dt.types && (dt.types.indexOf ? dt.types.indexOf('Files') != -1 : dt.types.contains('Files'))){
			if(e.originalEvent.dataTransfer.items[0].type.search('image/')!=-1){
				dropZone.show();
				reset_dragging = true;				
			}
		}
	});
	
	dropzoneParent.on('dragleave', function(e){
		var rect = this.getBoundingClientRect();
		// Checking that the cursor is in the drag area or not
		if (e.clientX >= (rect.left + rect.width) || e.clientX <= rect.left || e.clientY >= (rect.top + rect.height) || e.clientY <= rect.top) {
			dropZone.hide();
			reset_dragging = false;
        }
	});
	
	dropzoneParent.on('drop', function(e){
		
		// Is not dropable?
		if(!reset_dragging){
			return;
		}
		
		e.preventDefault();
		var pagelayer_ajax_func = {};
		
		// This function for ajax success call back
		pagelayer_ajax_func['success'] = function(obj){
			
			if(obj['success']){
					
				// Set the new ID and URL
				id = obj['data']['id'];
				url = obj['data']['url'];
				
				if(row == ''){
					// Getting Id of jEle 
					var widgetid = jEle.closest('[pagelayer-id]').attr('pagelayer-id');
					
					// Finding widget image setting using id of jEle. Finding image editor setting from all of the other settings.
					row = pagelayer.$$('[pagelayer-element-id='+widgetid+']').find('.pagelayer-elp-image').eq(0).parent().parent();
				}
				
				row.find('.pagelayer-elp-image').css('background-image', 'url(\''+url+'\')');
							
				// To remove past temp attr so that they are not involve in future temp values
				var cname = row.attr('pagelayer-elp-name');
				var old = _pagelayer_img_tmp_atts(row);
				delete old[cname+'-url'];
				
				for(var x in obj['data']['sizes']){
					_pagelayer_set_tmp_atts(row, x+'-url', obj['data']['sizes'][x]['url']);
					delete old[cname+'-'+x+'-url'];
				}
				
				for(var x in old){
					_pagelayer_set_tmp_atts(row, x+'-url', '');
				}
				
				dropZone.find('.pagelayer-elp-img-up-bar').css('width', '3%');
				dropZone.hide();
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}else{
				alert(obj['data']['message']);								
			}
		}
		
		// This function for ajax before send call back
		pagelayer_ajax_func['beforeSend'] = function(xhr){
			// It activate the image widget
			if(row == ''){
				jEle.click();							
			}
		}
		
		// This function for how much file is uploaded or for progress bar
		pagelayer_ajax_func['uploadProgress'] = function(xhr){
			xhr.upload.addEventListener("progress", function(evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					
					if(row == ''){
						dropZone.find('.pagelayer-img-up-bar').css('width', percentComplete+'%');					
					}else{
						dropZone.find('.pagelayer-elp-img-up-bar').css('width', percentComplete+'%');											
					}
				}
			}, false);
			return xhr;
		}
		
		// Uploading image to the media library
		pagelayer_editable_paste_handler(e.originalEvent.dataTransfer.files[0], pagelayer_ajax_func);
		
		reset_dragging = false;
		
	});
}	

// The Multi Image Property
function pagelayer_elp_multi_image(row, prop){
	
	var div = '<div class="pagelayer-elp-multi_image-div">'+
				'<center><button class="pagelayer-elp-button">'+pagelayer_l('Add Images')+'</button></center>'+
				'<div class="pagelayer-elp-multi_image-thumbs"></div>'+
			'</div>';
			
	row.append(div);
	
	var tmp = prop.c['name']+'-urls';
	var ids = new Array();
	
	// Any IDs ?
	if(!pagelayer_empty(prop.c['val'])){
		ids = prop.c['val']
		if(pagelayer_is_string(ids)){
			ids = prop.c['val'].split(',');
		}
		//console.log(ids);
	}
	
	// Do we have a URL set ?
	if(!pagelayer_empty(ids)){
		if(tmp in prop.el.tmp){
			var images = JSON.parse(prop.el.tmp[tmp]);
			//console.log(images);
			
			for(var x in ids){
				row.find('.pagelayer-elp-multi_image-thumbs').append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+images['i'+ids[x]]+'\');"></div>');
			}
		}else{
			wp.media.query({ post__in: ids }).more().then(function(){
				// You attachments here normally
				// You can safely use any of them here
				// TODO: Set tmp here
				for(var x in ids){
					var fetch_url = wp.media.attachment(ids[x]).get('url');
					if(!pagelayer_empty(fetch_url)){
						row.find('.pagelayer-elp-multi_image-thumbs').append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+fetch_url+'\');"></div>');
					}
				}
			});
		}
	}
	
	var pagelayer_init_frame = function(state){
	
		var button = row.find('.pagelayer-elp-multi_image-thumbs');
		//console.log(ids);
		
		// Load the frame
		var frame = pagelayer_select_frame('multi_image', state);
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				var urls = {};
				
				// External URL
				if('props' in state){
					//console.log(state);
					var urls_str = state.props.attributes.url;
					
					var urls_arr = urls_str.split(',');
					//console.log(urls_arr);
					
					button.empty();
					
					// Add to current selection
					for(var i = 0; i < urls_arr.length; i++){
						var single_url = pagelayer_parse_theme_vars(urls_arr[i]);
						urls['i'+i] = single_url;
						
						// Create thumbnails
						button.append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+single_url+'\');"></div>');
					}
					urls_arr = Object.values(urls);
					
					_pagelayer_set_tmp_atts(row, 'urls', JSON.stringify(urls));
					_pagelayer_set_atts(row, urls_arr.join());
					
				}
			},
			
			// Set the current selection if any
			'open': function(){

				// Do we have anything
				if(!pagelayer_empty(ids)){
					
					var selection = '';
					
					if(state == 'gallery-edit'){
						selection = frame.state().get('library');
					}else if(state == 'gallery-library'){
						selection = frame.state().get('selection');
					}
					
					// Add to current selection
					if(!pagelayer_empty(selection)){
						for(var x in ids){
							attachment = wp.media.attachment(ids[x]);
							attachment.fetch();
							selection.add(attachment ? [ attachment ] : [] );
						}
					}
				}
			},
			
			// When images are selected
			'update': function(selection){
				
				//console.log(selection);
				
				// Remove thumbnails
				row.find('.pagelayer-elp-multi_image-thumb').remove();
				
				//Fetch selected images
				var attachments = selection.map(function(attachment){
					attachment.toJSON();
					return attachment;
				});
				
				//console.log(attachments);
				
				var img_ids = [];
				var urls = {};
				var img_urls = {};
				var titles = {};
				var links = {};
				var captions = {};
				
				for(var i = 0; i < attachments.length; ++i){
					
					// Add Id and urls to array
					var id = attachments[i].id;
					var _id = 'i'+id;
					img_ids.push(id);
					urls[_id] = attachments[i].attributes.url;
					
					// Create thumbnails
					button.append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+attachments[i].attributes.url+'\');"></div>');
					
					//get title
					titles[_id] = attachments[i].attributes.title;
					links[_id] = attachments[i].attributes.link;
					captions[_id] = attachments[i].attributes.caption;
					
					// Create a URL
					img_urls[_id] = {}
					
					for(var x in attachments[i].attributes.sizes){
						img_urls[_id][x] = attachments[i].attributes.sizes[x].url;
					}
					
				}
				
				//console.log(img_urls);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'urls', JSON.stringify(urls));
				_pagelayer_set_tmp_atts(row, 'all-urls', JSON.stringify(img_urls));
				_pagelayer_set_tmp_atts(row, 'all-titles', JSON.stringify(titles));
				_pagelayer_set_tmp_atts(row, 'all-links', JSON.stringify(links));
				_pagelayer_set_tmp_atts(row, 'all-captions', JSON.stringify(captions));
				_pagelayer_set_atts(row, img_ids);
				
				// Update the IDs incase the user clicks on it again
				ids = img_ids;
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	};
	
	row.find('.pagelayer-elp-multi_image-thumbs').on('click', function(){
		pagelayer_init_frame('gallery-edit');
	});
	
	row.find('.pagelayer-elp-button').on('click', function(){
		
		if(!pagelayer_empty(ids)){
			if(isNaN(ids[0])){
				pagelayer_init_frame('embed');
			}else{
				pagelayer_init_frame('gallery-library');
			}
		}else{
			pagelayer_init_frame('gallery');
		}		
	});
	
}

// The Video Property
function pagelayer_elp_video(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-video-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-video" name="'+prop.c['name']+'" type="text" value="'+src+'">'+
				'<i class="pli pli-folder-open" ></i>'+
			'</input></div>';
			
	row.append(div);
	
	row.find('.pagelayer-elp-video-div .pli').on('click', function(){
	
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('video');
		
		// On select update the stuff
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});

		frame.open(button);
		
		return false;
		
	});
	
	// Edited the video URL directly
	row.find('.pagelayer-elp-video').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}


// The Audio Property
function pagelayer_elp_audio(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-audio-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-audio" name="'+prop.c['name']+'" type="text" value="'+src+'" />'+
				'<i class="pli pli-menu" ></i>'+
			'</div>';
	
	row.append(div);
	
	// Choose from media
	row.find('.pagelayer-elp-audio-div .pli').on('click', function(){
		
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('audio');
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	});
	
	// Edited the media URL directly
	row.find('.pagelayer-elp-audio').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}

// The Media Property
function pagelayer_elp_media(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-media-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-media" value="'+src+'" type="text" />'+
				'<i class="pli pli-menu" ></i>'+
			'</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-media-div .pli-menu').on('click', function(){
		
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('media');
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	});
	
	// Edited the media URL directly
	row.find('.pagelayer-elp-media').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}

// The Slider Property
function pagelayer_elp_slider(row, prop){
	
	var div = '<div class="pagelayer-elp-slider-div">'+
				  '<input type="range" class="pagelayer-elp-slider" value="'+parseFloat(prop.c['val'])+'" min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'"/>'+
				  '<input type="number" class="pagelayer-elp-slider-value" value="'+parseFloat(prop.c['val'])+'" min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'"/>'+
				'</div>'+
			'</div>';
	
	row.append(div);
	
	// Set an value in span
	row.find('.pagelayer-elp-slider-div input').on('input', function(){
		var value = parseFloat(this.value);
		var max = parseFloat(this.max);
		
		if(!pagelayer_empty(max) && value > max){
			value = max;
		}
		row.find('.pagelayer-elp-slider-div input').val(value);
		
		_pagelayer_set_atts(row, value);// Save and Render
		
	});
	
}

// The Editor proprety
function pagelayer_elp_editor(row, prop){
	
	var rows = prop.rows ? prop.rows : '8';
	
	var div = '<div class="pagelayer-elp-editor-div">'+
				'<textarea rows="'+rows+'" class="pagelayer-elp-editor" ></textarea>'+
			'</div>';
			
	row.append(div);
	
	var editor = row.find('.pagelayer-elp-editor');
	editor.val(prop.c['val']);
	
	// Handle on change
	editor.on('input', function(){
		_pagelayer_set_atts(row, pagelayer_trim(jQuery(this).val()));// Save and Render
	});
	
	return;
	// No SVG Icons for now
	jQuery.trumbowyg.svgPath = false;
	
	// Initiate the editor
	editor.trumbowyg({
		autogrow: false,
		hideButtonTexts: true,
		btns:[
			['viewHTML'],
			['wpmedia'],
			['fontfamily'],
			['formatting'],
			['undo', 'redo'], // Only supported in Blink browsers
			['fontsize'],
			['lineheight'],
			['foreColor', 'backColor',],
			['strong', 'em', 'del'],
			['horizontalRule'],
			['superscript', 'subscript'],
			['link'],
			['unorderedList', 'orderedList'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['removeformat'],
			['fullscreen']
		],
		plugins: {
			fontsize: {
				sizeList: ['12px','13px','14px','15px','16px','17px','18px','19px','20px','21px','22px','23px','24px','25px']
			}
		},
		imageWidthModalEdit: true,
		
	// Handle the changes made in the editor
	}).on('tbwchange', function(){
		_pagelayer_set_atts(row, editor.trumbowyg('html'));// Save and Render
	});
	
}

// The Link proprety
function pagelayer_elp_link(row, prop){

	var values = {};
	var settingOpt = false;
	
	// Show link options?
	if('selector' in prop){
		settingOpt = true;
	}
  
	// Previously saved values
	if(typeof prop.c['val'] === 'object'){
		values = prop.c['val'];
	}else{
		values['link'] = prop.c['val'];
	}
	  
	var tmp = prop.c['name'];
	var link = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : values['link'];
	var jEle = jQuery('[pagelayer-id='+prop.el.id+']');
	
	var div = '<div class="pagelayer-elp-link-div pagelayer-elp-input-icon '+(settingOpt ? '' : 'pagelayer-elp-link-no-addons')+'">'+
		'<input class="pagelayer-elp-link" type="text" value="'+link+'" />'+
		'<i class="pli pli-service pagelayer-elp-link-icon" title="'+pagelayer_l('link_options')+'" ></i>'+
		'<div class="pagelayer-elp-link-list">'+
		'</div>';
		
		if(settingOpt){
			div += '<div class="pagelayer-elp-link-addons">'+
				'<div  class="pagelayer-elp-link-cb-div">'+
					'<div class="pagelayer-elp-link-label-div" type="'+prop['type']+'">'+
						'<label class="pagelayer-elp-link-label">'+pagelayer_l('open_link_in_new_window')+'</label>'+
					'</div>'+
					'<div>'+
						'<input type="checkbox" name="link_new_tab" class="pagelayer-elp-checkbox" '+(!pagelayer_empty(values['target']) ? 'checked="checked"' : '')+' />'+
					'</div>'+
				'</div>'+
				'<div class="pagelayer-elp-link-cb-div" >'+
					'<div class="pagelayer-elp-link-label-div" type="'+prop['type']+'">'+
						'<label class="pagelayer-elp-link-label">'+pagelayer_l('add_nofollow')+'</label>'+
					'</div>'+
					'<div>'+
						'<input type="checkbox" name="link_no_follow" class="pagelayer-elp-checkbox" '+(!pagelayer_empty(values['rel']) ? 'checked="checked"' : '')+'/>'+
					'</div>'+
				'</div>'+
				'<div class="pagelayer-elp-link-ca" >'+
					'<div class="pagelayer-elp-link-label-div" type="'+prop['type']+'">'+
						'<label class="pagelayer-elp-link-label">'+pagelayer_l('custom_attributes')+'</label>'+
					'</div>'+
					'<div>'+
						'<input type="text" class="pagelayer-elp-text" placeholder="key = value" name="'+prop.c['name']+'" value="'+(pagelayer_empty(values['attrs']) ? '' : values['attrs'])+'"/>'+
						'<p class="pagelayer-elp-link-desc">'+pagelayer_l('link_custom_attr_desc')+'</p>'+
					'</div>'+
				'</div>'+
			'</div>';
		}
		
	div += '</div>';
	
	row.append(div);
	
	var listWrap = row.find('.pagelayer-elp-link-list');
	var time = null;
		
	//Add ID
	var addID = function(permaID){
		permaID = permaID || false;
		
		var lDiv = row.closest('[pagelayer-elp-name]').find('.pagelayer-elp-label-div');
		if(permaID){
			lDiv = lDiv.find('.pagelayer-elp-label');
			lDiv.after('<span class="pagelayer-elp-link-id">ID : '+permaID+'</span>');
		}else{
			lDiv.find('.pagelayer-elp-link-id').remove();
		}
	};
	
	if(!isNaN(values['link'])){
		addID(values['link']);
	}
	
	var getLinkVal = function(val){
		
		if(typeof val === 'object' && pagelayer_length(val) == 1 && 'link' in val){
			return val['link'];
		}
		
		return val;
	}
	
	var setTmpEmpty = function(){
		
		if( 'link' in values && !pagelayer_empty(values['link']) ){
			return;
		}
		
		_pagelayer_set_tmp_atts(row, '', '');
	}
	
	// Set a Link
	row.find('.pagelayer-elp-link').on('change', function(){
		
		var linkVal = jQuery(this).val();
		values['link'] = linkVal;
    
		// Save and Render
		_pagelayer_set_tmp_atts(row, '', linkVal);
		_pagelayer_set_atts(row, getLinkVal(values));
		
		// Remove ID Holder
		addID();

	});
	
	// Set a Link
	row.find('.pagelayer-elp-link').on('input click', function(e){
		e.stopPropagation();
		
		if(!listWrap.is(':visible')){
			listWrap.show();
		}
		
		var val = jQuery(this).val();
		
		clearTimeout(time);
		time = setTimeout(function(){

			jQuery.ajax({
				url: pagelayer_ajax_url,
				type: 'post',
				data:{
					'action' : 'wp-link-ajax',
					'_ajax_linking_nonce' : pagelayer_internal_linking_nonce,
					'search' : val,
				},
				success: function(response) {
					
					var data = jQuery.parseJSON(response);
					var html = '';
					//console.log('Link Data');console.log(response);
					
					if(pagelayer_empty(data)){
						html = pagelayer_l('custom_url');
						// Remove ID Holder
						addID();
					}else if(typeof data === 'object'){
						
						for(var key in data){
							var vals = data[key];
							html += '<div class="pagelayer-elp-link-item"  data-id="'+vals['ID']+'" data-permalink="'+vals['permalink']+'">'+
								'<div class="pagelayer-elp-link-title">'+
									'<span class="pagelayer-elp-link-item-title" title="'+vals['title']+'">'+vals['title']+'</span>'+
									'<span class="pagelayer-elp-link-item-perma" title="'+vals['permalink']+'">'+vals['permalink']+'</span>'+
								'</div>'+
								'<div class="pagelayer-elp-link-info">'+
									'<span title="'+vals['info']+'">'+vals['info']+'</span>'+
								'</div>'+
							'</div>';
						}
					}
					
					listWrap.html(html);
				},
				fail: function(data) {
					listWrap.html('Some error occured in getting the link data');
				}
			});
			
		}, 200);
		
	});
	
	listWrap.on('click', function(e){
		e.stopPropagation();
		
		var lEle = jQuery(e.target).closest('.pagelayer-elp-link-item');
		
		// IF item not found
		if(lEle.length < 1){
			return;
		}
		
		var perma = lEle.attr('data-permalink');
		var ID = lEle.attr('data-id');
		values['link'] = ID;
		
		// Save and Render
		row.find('.pagelayer-elp-link').val(perma);
		_pagelayer_set_tmp_atts(row, '', perma);
		_pagelayer_set_atts(row, getLinkVal(values));
		
		listWrap.hide();
		
		// Show ID
		addID(ID);
	});
	
	pagelayer.gDocument.on('click', function(e){
		listWrap.hide();
	});
	
	row.find('.pagelayer-elp-checkbox').on('change', function(event){
		
		var cEle = jQuery(this);
		
		// Save or delete the value
		var saveVal = function(key){
			if(cEle.is(':checked')){
				values[key] = true;
				return;
			}
			
			delete values[key];
		}
				
		switch(cEle.attr('name')){
			case 'link_new_tab':
				saveVal('target');
				break;
			case 'link_no_follow':
				saveVal('rel');
				break;
		}
		
		setTmpEmpty();
		_pagelayer_set_atts(row, getLinkVal(values));
		
	});
	
	var linkTime = '';
	row.find('.pagelayer-elp-text').on('input', function(event){
		var cEle = jQuery(this);
		
		clearTimeout(linkTime);
		linkTime = setTimeout(function(){
			values['attrs'] = cEle.val();
			
			if(pagelayer_empty(values['attrs'])){
				delete values['attrs'];
			}
			
			setTmpEmpty();
			_pagelayer_set_atts(row, getLinkVal(values));
			
		}, 500);
	});
	
	row.find('.pagelayer-elp-link-icon').on('click', function(){
		row.find('.pagelayer-elp-link-addons').slideToggle('slow');
	});
  
}

// The Textarea property
function pagelayer_elp_textarea(row, prop){
	
	var rows = prop.rows ? 'rows="'+prop.rows+' "' : '';
	
	var div = '<div class="pagelayer-elp-textarea-div">'+
				'<textarea '+rows+'class="pagelayer-elp-textarea"></textarea>'+
			'</div>';
			
	row.append(div);
	row.find('.pagelayer-elp-textarea').val(prop.c['val']);
  
	// Handle on change
	row.find('.pagelayer-elp-textarea').on('input', function(){
		_pagelayer_set_atts(row, pagelayer_trim(jQuery(this).val()));// Save and Render
	});
};

// Clear all editable
function pagelayer_clear_editable(dontDestroy){
	
	// Destroy all
	for(var x in pagelayer_editor){
		if(dontDestroy == x){
			console.log('Skipping '+dontDestroy);
			continue;
		}
		pagelayer_editor[x].pen.destroy();
	}
	
};

// Makes a field editable in the DOM
function pagelayer_make_editable(jEle, e){
	
	// The parent element
	var pEle = jEle.closest('.pagelayer-ele, [pagelayer-ref-id]');
	
	// Mainly for editing table cells as pagelayer-ref-id is used by them
	if(!pEle.hasClass('pagelayer-ele')){
		var refID = pEle.attr('pagelayer-ref-id');
		pEle = jQuery('[pagelayer-id="'+refID+'"]');
	}
	
	var prop = jEle.attr('pagelayer-editable');
	var eId = pagelayer_id(pEle)+'|'+jEle.attr('pagelayer-editable');// Editing ID
	
	// Is it already setup ?
	if(jEle.hasClass('pagelayer-pen')){
		//console.log('Already Penned');
		//pagelayer_focus_editable(jEle, e, eId);
		return true;
	}
	
	var tag = pagelayer_tag(pEle);
	var all_props = pagelayer_shortcodes[tag];
	var edit_opts;
	var fullEdit = false;
	
	for(var i in pagelayer_tabs){
		var tab = pagelayer_tabs[i];
		for(var section in all_props[tab]){	//console.log(tab+' '+section);
	
			var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];//console.log(props);
	
			// Any editor options?
			if(prop in props){
				
				if('e' in props[prop]){
					edit_opts = props[prop].e;
				}
				
				if(props[prop]['type'] == 'editor'){
					fullEdit = true;
				}
			}
		}
	}
	
	var pen_tools = {
		'inline': [ 'viewHTML',
			{'formating' : ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p']},
			'bold', 'italic', 'underline', 'strike',
			{ 'color': [] }, { 'background': [] },
			'removeformat'
		],
		'h': ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
		'headers': [{'formating' : ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']}],
		'c': [{ 'color': [] }, { 'background': [] }],
		'f': ['bold', 'italic', 'underline', 'strike'],
		'a': [{ 'align': ['left', 'center', 'right', 'justify'] }],
		'r': ['removeformat'],
		'v': ['viewHTML'],
	};
	
	// Create Toolbar Groups
	if(!('pen_tools' in pagelayer_editor)){
		pagelayer_editor['pen_tools'] = {};
	}
	
	pagelayer_editor['pen_tools'] = Object.assign(pagelayer_editor['pen_tools'], pen_tools);
	
	var toolbar_options = [];
	
	if( pagelayer_empty(edit_opts) ){
		
		if(fullEdit){
			toolbar_options = [
				[ 'viewHTML' ],
				[ 'bold', 'italic', 'underline', 'strike' ],
				[ 'sub', 'super' ],
				//[ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'blockquote'],
				[ {'formating' : ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'blockquote']}],
				[ {'align': ['left', 'center', 'right', 'justify']} ],
				[ 'image', 'link'],
				[ 'unorderedlist', 'orderedlist'],
				[ {'size': []}, {'lineheight': []}, {'font': []}],
				[ {'color': [] }, {'background': []}],
				[ 'removeformat' ]
			];
		}else{
			toolbar_options = pagelayer_editor.pen_tools['inline'];
		}
	}else{
		var options = [];
		
		if(! Array.isArray(edit_opts) ){
			edit_opts = [edit_opts];
		}
		
		for( var tt in edit_opts){
			
			var tool = edit_opts[tt];
			
			if(pagelayer_is_string(tool)){
				if(tool in pagelayer_editor['pen_tools']){
					tool = pagelayer_editor['pen_tools'][tool]
				}else{
					tool = [tool];
				}
			}
			
			options.push(tool);
		}
		
		toolbar_options = options;
	}
	
	var options = {
		class: 'pagelayer-pen',
		editor: jEle,
		toolbar: toolbar_options
	}
	
	// Setup the editor	
	pagelayer_editor[eId] = {};
	pagelayer_editor[eId].pen = new PagelayerPen(jEle, options);
	pagelayer_editor[eId].$ = jEle;
	
	// Are we the clicked object, then set the focus
	if(e){
		var target = jQuery(e.target);
		if(target.is(jEle) || jEle.find(target).length > 0){
			jEle.focus();
		}
	}
	
	// Reverse setup the event
	jEle.on('blur', function(){
		
		//pagelayer_editor[eId].pen.destroy();
		if(jEle.hasClass('pagelayer-pen-focused')){
			return;
		}
		
		var cEle = pEle;
		
		// Do we have a parent ?
		var have_parent = function(Ele){
			var pId = pagelayer_get_parent(Ele);
					
			if(pagelayer_empty(pId)){
				return;
			}
			
			cEle = pagelayer_ele_by_id(pId);
			have_parent(cEle);
		}
		
		have_parent(cEle);
		
		var is_global = pagelayer_get_global_id(cEle);
				
		if(pagelayer_empty(is_global)){
			return;
		}
    
		pagelayer_sc_render(pEle);
		
	});
	
	/*// Reverse setup the event
	jEle.on('focus', function(){
		//pagelayer_clear_editable(eId);
	});*/
	
	// Reverse setup the event
	jEle.on('input', function(){
		
		var val = pagelayer_trim(jEle.html());
		
		// Set the property as well
		pagelayer_set_atts(pEle, prop, val);
		
		// Update the property
		var input = pagelayer.$$('[pagelayer-element-id='+pagelayer_id(pEle)+']').find('[pagelayer-elp-name='+prop+']').find('input,textarea,.trumbowyg-editor');
		//console.log(input);
		
		if(input.length > 0){
			if(input.hasClass('trumbowyg-editor')){
				input.html(val);
			}else{
				input.val(val);
			}
		}
	
	});
	
}

// The Icon Property
function pagelayer_elp_icon(row, prop){
	
	var $ = jQuery;
	var sets_html = '';
	
	pagelayer_loaded_icons.forEach(function(item){
		sets_html += '<option name="'+item+'" value="'+item+'">'+item+'</option>';
	});
	
	var icons = {};
	var cur_icon_set = pagelayer_loaded_icons[0];
	var sel_icon = prop.c['val'];
	var sel_name = prop.c['val'];
	var icon_type = '';
	var sorted_icons = {};
	
	// Handle the icon name 
	var icon_name = sel_icon.split(' fa-');
	sel_name = icon_name[1];
	
	// Is there a specific list
	if('list' in prop && prop.list.length > 0){
		
		for(var i in pagelayer_icons){
			
			icons[i] = {};
			
			for(var j in pagelayer_icons[i]){
				
				icons[i][j] = {};
				var list_icons = [];
				prop.list.forEach(function(item){
					if(pagelayer_icons[i][j]['icons'].includes(item)){
						list_icons.push(item);
					}
					
				});
				icons[i][j]['icons'] = list_icons;
				icons[i][j]['pre'] = j;
			}
			
		}
	
	}else{
		icons = pagelayer_icons;
	}
	
	// Icon function
	var icon_html = function(name, cat){
		return '<span class="pagelayer-elp-icon-span">'+
			'<i class="'+cat+' fa-'+name+'" icon="'+name+'" ></i> '+name+
		'</span>';
	}
	
	var div = '<div class="pagelayer-elp-icon-div">'+
		'<div class="pagelayer-elp-icon-preview">'+
			'<i class="'+sel_icon+'"></i>'+
			'<span class="pagelayer-elp-icon-name">'+
			(pagelayer_empty(sel_name)?'Choose icon':sel_name)+
			'</span>'+
		'</div>'+
		'<span class="pagelayer-elp-icon-open">▼</span>'+
		'<span class="pagelayer-elp-icon-close" '+(pagelayer_empty(sel_name)? 'style="display:none"': '')+'><b>&times;&nbsp;</b></span>'+
	'</div>';
	
	row.append(div);
	
	// Make all icons list
	var html = '<div class="pagelayer-elp-icon-selector">';
	
	if(pagelayer_loaded_icons.length > 1){
		html += '<select class="pagelayer-elp-icon-sets">'+sets_html+'</select>';
	}
	
	html += '<span class="pagelayer-elp-icon-type">'+
		'<p data-tab="fas" class="active">'+pagelayer_l('Solid')+'</p>'+
		'<p data-tab="far">'+pagelayer_l('Regular')+'</p>'+
		'<p data-tab="fab">'+pagelayer_l('Brand')+'</p>'+
	'</span>'+
	'<input type="text" class="pagelayer-elp-search-icon" name="search-icon" placeholder="'+pagelayer_l('search')+'">'+
	'<div class="pagelayer-elp-icon-list">';

	for(var y in icons[cur_icon_set]){
		//console.log(icons[x][y])
		for(var z in icons[cur_icon_set][y]['icons']){
			html += icon_html(icons[cur_icon_set][y]['icons'][z], y);
		}
	}
	
	html += '</div>'+
	'</div>';
	
	row.append(html);
	
	// Open the selector
	row.find('.pagelayer-elp-icon-div').on('click', function(){
		row.find('.pagelayer-elp-icon-selector').slideToggle();
	});
	
	/*// When the set changes
	row.find('.pagelayer-elp-icon-sets').on('change', function(){
		var v = cur_icon_set = jQuery(this).val();
		var span = '';
		
		for(var x in icons[v]){
		
			for(var z in icons[v][x]['icons']){
				span += icon_html(icons[v][x]['icons'][z], x);
			}
			
		}
		
		if(cur_icon_set == 'font-awesome5'){
			row.find('.pagelayer-elp-icon-type').show();
			sorted_icons = icons[cur_icon_set]['fas'];
			row.find('.pagelayer-elp-icon-type [data-tab="fas"]').click();
		}else{
			row.find('.pagelayer-elp-icon-type').hide();
		}
		
		row.find('.pagelayer-elp-icon-list').empty().html(span);
		
		if(row.find('.pagelayer-elp-search-icon').val() != ''){
			row.find('.pagelayer-elp-search-icon').keyup();
		}
		
	});*/
	
	// Handle type of icon
	row.find('.pagelayer-elp-icon-type p').on('click', function(){		
		jQuery(this).toggleClass('active');
		row.find('.pagelayer-elp-search-icon').keyup();
	});
	
	// Handle search of icon
	row.find('.pagelayer-elp-search-icon').on('keyup', function(){
	
		var v = this.value;
		var span = '';
		v = v.toLowerCase();
		v = v.replace(/\s+/g, '-');
		//console.log(sorted_icons);
		
		row.find('.pagelayer-elp-icon-type p.active').each(function(){				
			var tab = jQuery(this).data('tab');
			tab = tab.toLowerCase();
			
			var cat = icons['font-awesome5'][tab]['icons'];
			
			for(var x in cat){
				if(cat[x].includes(v) || v.length < 1){
					span += icon_html(cat[x], tab);
				}
			}
		});
		
		row.find('.pagelayer-elp-icon-list').empty().html(span);
		
	});
	
	// Handle click within the icon selector
	row.find('.pagelayer-elp-icon-list').on('click', function(e){
		
		var jEle = jQuery(e.target);
		var i = jEle.children().attr('class');
		var name = jEle.children().attr('icon');
		
		if(pagelayer_empty(name)){
			return false;
		}
		
		// Set the icon in this list
		row.find('.pagelayer-elp-icon-preview').html('<i class="'+i+'"></i><span class="pagelayer-elp-icon-name">'+name+'</span>');
		row.find('.pagelayer-elp-icon-selector').slideUp();
		
		_pagelayer_set_atts(row, i);// Save and Render
		
		row.find('.pagelayer-elp-icon-close').show();
		return false;
		
	});
	
	// Delete the icon
	row.find('.pagelayer-elp-icon-close').on('click', function(){
		
		// Set the icon in this list
		row.find('.pagelayer-elp-icon-preview').html('<i class=""></i><span class="pagelayer-elp-icon-name">'+pagelayer_l('choose_icon')+'</span>');
		
		// Save and Render
		_pagelayer_set_atts(row, '');
		jQuery(this).hide();
		return false;
	});
	
}

// The Access Property
function pagelayer_elp_access(row, prop){
	
	var div = '<div class="pagelayer-elp-access-div">'+
		'<span class="pagelayer-elp-access"><i class="pli pli-caret-right" ></i></span>'+
		'<div class="pagelayer-elp-access-holder"></div>'+
	'</div>';
	
	row.append(div);
	
	var holder = row.find('.pagelayer-elp-access-holder');
	
	row.find('.pagelayer-elp-access').on('click', function(){
		
		// Setup first
		if(holder.children().length < 1){
			var p = row.parent().find('[pagelayer-access-item='+prop.show_group+']').detach();
			p.appendTo(holder);
			p.addClass('pagelayer-access-item-visible');
		}
		
		// Show and hide
		if(holder.is(':visible')){
			holder.hide();
			row.find('.pli-caret-right').removeClass('pli-caret-open');
		}else{
			holder.show();
			row.find('.pli-caret-right').addClass('pli-caret-open');
		}
	});
	
};

// The Modal Property
function pagelayer_elp_modal(row, prop){
	
	var style = pagelayer_empty(prop.width) ? '' : 'style="width:'+prop.width+'"';
	
	var div = '<div class="pagelayer-elp-modal-div">'+
		'<span class="pagelayer-elp-modal"><i class="pli pli-window" ></i></span>'+
		'<div class="pagelayer-elp-modal-wrapper">'+
			'<div class="pagelayer-elp-modal-wrap" '+style+'>'+
				'<div class="pagelayer-elp-modal-header">'+
					prop.label +'<i class="pagelayer-elp-modal-close pli pli-cross" aria-hidden="true"></i>'+
				'</div><hr>'+
				'<div class="pagelayer-elp-modal-holder"></div>'+
			'</div>'+
		'</div>'+
	'</div>';
	
	row.append(div);
	
	var wrapper = row.find('.pagelayer-elp-modal-wrapper');
	var holder = row.find('.pagelayer-elp-modal-holder');
	
	row.find('.pagelayer-elp-modal').on('click', function(){
		
		// Setup first
		if(holder.children().length < 1){
			
			var p = row.parent().find('[pagelayer-access-item='+prop.show_group+']').detach();
			p.appendTo(holder);
			p.addClass('pagelayer-access-item-visible');
		}
		
		// Show and hide
		wrapper.show();
		
	});
	
	// Close Modal Property
	row.find('.pagelayer-elp-modal-close').on('click', function(){
		wrapper.hide();
	});
	
	// On click Pagelayer setting icon
	wrapper.on('click', function(event){
		var target = jQuery(event.target);
		
		if(target.closest('.pagelayer-elp-modal-wrap').length > 0){
			return;
		}
		
		wrapper.hide();
	});
  
};

// The Color Property
function pagelayer_elp_color(row, prop){
	
	var val = prop.c['val'];
	var is_global = pagelayer_is_global_color(val);
	var global_active = '';
	
	// If global color not exist
	if(!pagelayer_empty(is_global)){
		val = pagelayer_global_colors[is_global]['value'];
		global_active = 'pagelayer-active-global';
	}
	
	var div = '<div class="pagelayer-elp-color-div-holder">'+
		'<div class="pagelayer-elp-color-global '+global_active+'"></div>'+
		'<div class="pagelayer-elp-color-div">'+
			'<div class="pagelayer-elp-color-preview"></div>'+
			'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
		'</div>'+
		'<div class="pagelayer-global-color-list">'+
			'<div class="pagelayer-global-setting-color">'+
				'<b>Global Colors</b><span class="pli pli-service"></span>'+
			'</div>';
			
			for( cid in pagelayer_global_colors ){
				
				var color = pagelayer_global_colors[cid];
				var active_class = '';
				
				if(cid == is_global){
					active_class = 'pagelayer-global-selected';
				}

				div += '<div class="pagelayer-global-color-list-item '+ active_class +'" data-global-id="'+ cid +'">'+
					'<span class="pagelayer-global-color-pre" style="background:'+ color['value'] +'"></span>'+
					'<span class="pagelayer-global-color-title">'+ color['title'] +'</span>'+
					'<span class="pagelayer-global-color-code">'+  color['value'] +'</span>'+
				'</div>';
			}
	 div += '</div></div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-color-preview').css('background', val);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : val,
		doc: window.parent.document
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');
	
	// If no val, then set blank
	if(pagelayer_empty(val)){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(val);
	
	// Handle selected color
	picker.onChange = function(color) {		
		preview.removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		_pagelayer_set_atts(row, color.hex);// Save and Render
		
		// Remove global
		row.find('.pagelayer-elp-color-global').removeClass('pagelayer-active-global');
		row.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
		row.find('.pagelayer-global-color-list').hide();
	};
	
	picker.onOpen = picker.onChange;
	
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		_pagelayer_set_atts(row, ' ');// Save and Render
	});
	
	// Handle for global color
	row.find('.pagelayer-elp-color-global').on('click', function(e){
		row.find('.pagelayer-global-color-list').slideToggle();
	});

	row.find('.pagelayer-global-setting-color').on('click', function(e){
		e.stopPropagation();

		if(jQuery(e.target).closest('.pli-service').length < 1){
			return;
		}
		window.open(pagelayer_customizer_url+'&autofocus%5Bsection%5D=pagelayer_global_colors_sec', '_blank');
	});
		
	// Handle for global color
	row.find('.pagelayer-global-color-list-item ').on('click', function(e){
		e.stopPropagation();
		
		var listItem = jQuery(this);
		var globalID = listItem.data('global-id');
		var listHolder = row.find('.pagelayer-global-color-list');
		
		// Remove previous selecttion
		listHolder.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
		listItem.addClass('pagelayer-global-selected');
		row.find('.pagelayer-elp-color-global').addClass('pagelayer-active-global');
		listHolder.slideUp();
				
		var color = pagelayer_global_colors[globalID]['value'];
		preview.removeClass('pagelayer-blank-preview').css('background', color);
		handle_white(color);
		_pagelayer_set_atts(row, '$'+globalID);// Save and Render
		
	});
}

// The Spinner property
function pagelayer_elp_spinner(row, prop){
	
	var div = '<div class="pagelayer-elp-spinner-div">'+
				'<input type="number" class="pagelayer-elp-spinner" name="'+prop.c['name']+'"'+
				' min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'" value="'+parseFloat(prop.c['val'])+'"/>'+
			'</div>';
			
	row.append(div);
	
	row.find('input').on('input', function(){
		var value = parseFloat(this.value);
		var max = parseFloat(this.max);
		
		if(!pagelayer_empty(max) && value > max){
			value = max;
		}
		_pagelayer_set_atts(row, value);// Save and Render
	});
	
}

// The Group Property
function pagelayer_elp_group(row, prop){
	
	var btnHidden = '';
	
	// Hide button, clone and delete
	if(!pagelayer_empty(prop['hide'])){
		btnHidden = 'pagelayer-hidden';
	}
	
	// Remove the pagelayer-show-tab
	row.removeAttr('pagelayer-show-tab');
	
	var div = '<div class="pagelayer-elp-group-div"></div>'+
			'<center><button class="pagelayer-elp-button '+btnHidden+'">'+prop['text']+'</button></center>';
	
	row.append(div);
	
	// Add button
	var add_item = function(row){
		
		var ele_id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id') || '';
		var pEle = jQuery('[pagelayer-id="'+ele_id+'"]');
		
		// First add the element inside the group element
		var id = pagelayer_element_add_child(pEle, prop['sc'], prop);
		//pagelayer_element_setup('[pagelayer-id='+id+']', true);
		
		show_item(id);
	
	};
	
	// Show the properties of the existing things
	var show_item = function(id, sel){
		
		// To append after an existing item
		sel = sel || false;
		
		// If pagelayer id empty then return
		if(pagelayer_empty(id)){
			return false;
		}
		
		// Since the element is added very fast, we reselect via jQuery for it to re-access the dom
		jEle = jQuery('[pagelayer-id="'+id+'"]');
		
		var label_param = prop['item_label']['param'] || '';
		var title = pagelayer_get_att(jEle, label_param) || prop['item_label']['default'];
		
		// We need to get the correct value for select based params which are the label
		var child_props = pagelayer_shortcodes[prop.sc];
		for(var section in child_props){
			for(var _param in child_props[section]){
				if(child_props[section][_param]['type'] == 'select'){
					if(title in child_props[section][_param]['list']){
						title = child_props[section][_param]['list'][title];
					}
				}
			}
		}
		
		// Create the HTML
		var holder = jQuery('<div class="pagelayer-elp-group-item" pagelayer-group-item-id="'+id+'">'+
				'<div class="pagelayer-elp-group-item-head">'+
					'<span class="pagelayer-elp-group-item-drag"><i class="pli pli-menu" ></i></span>'+
					'<span class="pagelayer-elp-group-item-title">'+title+'</span>'+
					'<span class="pagelayer-elp-group-item-clone '+btnHidden+'"><i class="pli pli-clone" ></i></span>'+
					'<span class="pagelayer-elp-group-item-del '+btnHidden+'"><i class="pli pli-trashcan" ></i></span>'+
				'</div>'+
				'<div class="pagelayer-elp-group-item-body"></div>'+
			'</div>');
		
		// Append to the row
		if(sel){
			row.find(sel).after(holder);
		}else{
			row.find('.pagelayer-elp-group-div').first().append(holder);
		}
		
		// Setup the toggle
		holder.find('.pagelayer-elp-group-item-title').first().on('click', function(){
			var rEle = holder.find('.pagelayer-elp-group-item-body').first();
			var r_id = holder.attr('pagelayer-group-item-id');
			
			// If the props are not already setup
			if(rEle.html().length < 1){
			
				pagelayer_elpd_generate(jQuery('[pagelayer-id="'+r_id+'"]'), rEle);
				
				// Change the group item title
				var tmp_title = holder.find('[pagelayer-elp-name="'+label_param+'"] [name="'+label_param+'"]');
		
				if(tmp_title.length > 0){
					jQuery(tmp_title).on('input', function(){						
						holder.find('.pagelayer-elp-group-item-title').html(tmp_title.val());
					});
				}
				
			}
			
			rEle.toggle();
		});
		
		// Clone the item
		holder.find('.pagelayer-elp-group-item-head .pli-clone').on('click', function(){
			
			// If the element have any parent
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			var par = pagelayer_get_parent(jEle);
			var clone_ele = pagelayer_copy_element(jEle);
			//console.log(clone_ele);console.log('[pagelayer-group-item-id="'+id+'"]');
			show_item(clone_ele, '[pagelayer-group-item-id="'+id+'"]');
			
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		});
		
		// Delete the item
		holder.find('.pagelayer-elp-group-item-head .pli-trashcan').on('click', function(){
			
			// If the element have any parent
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			var par = pagelayer_get_parent(jEle);
			holder.remove();
			pagelayer_delete_element(jEle);
			
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		});
		
	};
		
	// Setup the drag
	pagelayer.$$(".pagelayer-elp-group-div").sortable({
		axis: 'y',
		nested : false,
		vertical : true,
		handle : ".pagelayer-elp-group-item-drag",
		placeholder: "pagelayer-drag-highlight",
		start : function(event, ui) {
			var start_pos = ui.item.index();
			ui.item.data('start_pos', start_pos);
		},
		stop : function(event, ui){
			var end_pos = ui.item.index();
			var id = jQuery(ui.item).closest('[pagelayer-group-item-id]').attr('pagelayer-group-item-id');
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			pagelayer_moving_element(jEle, ui.item.data('start_pos'), end_pos);
			var par = pagelayer_get_parent(jEle);				
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		}
	});
	
	// Handle click of the group
	row.find('.pagelayer-elp-button').on('click', function(){
		if('pro' in prop && pagelayer_empty(pagelayer_pro)){
			pagelayer_pro_notice();
			return;
		}
		add_item(row);
	});
	
	// Find the existing items
	prop.el.$.find('[pagelayer-parent="'+prop.el['id']+'"]').each(function(){
		var jEle = jQuery(this);
		var id = pagelayer_assign_id(jEle);
		show_item(id);
	});
};

function pagelayer_pro_notice(){
	var div = pagelayer.$$('.pagelayer-pro-notice');
	
	div.find('.pagelayer-pro-x').click(function(){
		div.hide();
	});
	
	div.show();
}

// Moving an element
function pagelayer_moving_element(jEle, start_pos, end_pos){	
	if(start_pos==end_pos){
		return;
	}
	
	var id = pagelayer_assign_id(jEle);

	// Is there a wrap
	var wrap = pagelayer_wrap_by_id(id);

	var par = wrap.parent();
	var children = par.children("div");	
	
  // This is required for Owl Carousel
	if(children.length==1){
		par = par.parent();
		children = par.children("div");
	}
	
	var element = children.eq(start_pos).detach();
	if(end_pos < start_pos){
		children.eq(end_pos).before(element);
	}else{
		children.eq(end_pos).after(element);
	}		
}

// The Datetime Property
function pagelayer_elp_datetime(row, prop){
		
	var div = '<div class="pagelayer-elp-datetime-div">'+
				'<input type="date" class="pagelayer-elp-datetime" name="'+prop.c['name']+'" value="'+prop.c['val']+'" />'+
        '</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-datetime').on('change', function(){
		_pagelayer_set_atts(row, jQuery(this).val());// Save and Render
	});
	
};

// The padding property
function pagelayer_elp_padding(row, prop){
	var val = ['', '', '', ''];
	
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
		}
	}
	
	var div = '<div class="pagelayer-elp-padding-div">'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[0])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[1])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[2])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[3])+'"></input>'+
				'<i class="pli pli-link" ></i>'+
			'</div>';
	
	row.append(div);
	
	// Is the value linked ?
	var link = row.find('.pagelayer-elp-padding-div i');
	var isLinked = 1;
	//isLinked = isLinked == 2 ? false : true;
	//console.log(isLinked);
	var tmp_val = val[0];
	
	for(var p_val in val){

		// Check if unlinked
		if(tmp_val != val[p_val] ){
			isLinked = 0;
		}
		tmp_val = val[p_val];
	}
	
	if(isLinked){
		link.addClass('pagelayer-elp-padding-linked');
	}else{
		link.removeClass('pagelayer-elp-padding-linked');
	}
	
	// Handle link on click
	link.on('click', function(){
		
		var linked = link.hasClass('pagelayer-elp-padding-linked');
		
		if(linked){
			link.removeClass('pagelayer-elp-padding-linked');
		}else{
			link.addClass('pagelayer-elp-padding-linked');
		}
		
	});
	
	row.find('input').on('input', function(){
		
		// Are the values linked
		var linked = row.find('.pagelayer-elp-padding-div .pli').hasClass('pagelayer-elp-padding-linked');
		
		if(linked){
			var val = jQuery(this).val();
			row.find('input').each(function(){
				jQuery(this).val(val);
			});
		}
		
		var vals = [];
		
		// Get all values
		row.find('input').each(function(){
			var val = jQuery(this).val();
			vals.push(val ? val : 0);
		});
		
		_pagelayer_set_atts(row, vals);// Save and Render
	});
	
};

// The shadow property
function pagelayer_elp_shadow(row, prop){
	
	var val =['','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
		}
	}
	
	//var val = {color: '', blur: '', horizontal: '', vertical: ''};
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-shadow-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-horizontal">'+
			'<label class="pagelayer-elp-label">Horizontal</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-vertical">'+
			'<label class="pagelayer-elp-label">Vertical</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" value="'+val[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-blur">'+
			'<label class="pagelayer-elp-label">Blur</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-blur" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-color">'+
			'<label class="pagelayer-elp-label">Color</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-color-preview"></div>'+
				'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
			'</div>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-shadow-div').toggleClass('pagelayer-prop-show');
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');	
	preview.css('background', val[3]);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : val[3],
		doc: window.parent.document
	});
	
	// If no val, then set blank
	if(pagelayer_empty(val[3])){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(val[3]);
	
	// Handle selected color
	picker.onChange = function(color) {
		preview.removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	// Remove Color
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		val[3] = '';
		_pagelayer_set_atts(row, val);
	});
	
	row.find('input').on('input', function(){
		var i = 0;
		row.find('.pagelayer-elp-shadow-input').each(function(){
			var value = jQuery(this).val();
			val[i] = (value ? value : '');
			i++;
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The box shadow property
function pagelayer_elp_box_shadow(row, prop){
	
	var val = ['','','','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
		}
	}
	
	var val_pos = ['horizontal','vertical','blur','color','spread','inset'];
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-shadow-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-horizontal">'+
			'<label class="pagelayer-elp-label">Horizontal</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" name="horizontal" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-vertical">'+
			'<label class="pagelayer-elp-label">Vertical</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" name="vertical" value="'+val[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-blur">'+
			'<label class="pagelayer-elp-label">Blur</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-blur" name="blur" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-spread">'+
			'<label class="pagelayer-elp-label">Spread</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-spread" name="spread" value="'+(val[4] ? val[4] : 0 )+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-color">'+
			'<label class="pagelayer-elp-label">Color</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-color-preview"></div>'+
				'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-inset">'+
			'<label class="pagelayer-elp-label">Shadow</label>'+
			'<select class="pagelayer-elp-shadow-input pagelayer-elp-select" name="inset" type="checkbox" class="pagelayer-elp-shadow-inset">'+
				'<option value="">Outset</option>'+
				'<option value="inset"'+(pagelayer_empty(val[5]) ? '' : ' selected' )+'>Inset</option>'+
			'</select>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-shadow-div').toggleClass('pagelayer-prop-show');
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');	
	preview.css('background', val[3]);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : val[3],
		doc: window.parent.document
	});
	
	// If no val, then set blank
	if(pagelayer_empty(val[3])){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(val[3]);
	
	// Handle selected color
	picker.onChange = function(color) {
		row.find('.pagelayer-elp-color-preview').removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	// Remove Color
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		val[3] = '';
		_pagelayer_set_atts(row, val);
	});
	
	// Onchange set props
	row.find('.pagelayer-elp-shadow-input').on('input change', function(){
		//var i = 0;
		row.find('.pagelayer-elp-shadow-input').each(function(){
			var value = jQuery(this).val();
			var name = jQuery(this).attr('name');
			val[val_pos.indexOf(name)] = (value ? value : '');
			//i++;
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The filter property
function pagelayer_elp_filter(row, prop){
	
	var val = [0,100,100,0,0,100,100];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
		}
	}
	
	var filters = [['blur','10','0.1'],['brightness','200','1'],['contrast','200','1'],['grayscale','200','1'],['hue','360','1'],['opacity','100','1'],['saturate','200','1']];
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-filter-div">';
		
		jQuery.each(val,function(key, value){
			div += '<div class="pagelayer-elp-prop-grp pagelayer-elp-filter-'+filters[key][0]+'">'+
				'<label class="pagelayer-elp-label">'+filters[key][0]+'</label>'+
				'<input class="pagelayer-elp-slider pagelayer-elp-filter-input" type="range" max="'+filters[key][1]+'" min="0" step="'+filters[key][2]+'" class="pagelayer-elp-filter-'+filters[key][0]+'" value="'+value+'"></input>'+
				'<span class="pagelayer-elp-filter-val">'+value+'</span>'+
			'</div>';
		});
		
	div += '</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-filter-div').toggleClass('pagelayer-prop-show');
	});
	
	row.find('input').on('input', function(){
		var val = [];
		jQuery(this).parent().find('span').html(this.value);
		row.find('.pagelayer-elp-filter-input').each(function(){
			var value = jQuery(this).val();
			val.push(value ? value : 'none');
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The gradient property
function pagelayer_elp_gradient(row, prop){
	
	var val = ['','','','','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
		}
	}
	
	var setColor = [val[1], val[3], val[5]];
	
	//var val = {color: '', blur: '', horizontal: '', vertical: ''};
	var getColorList = function(num){
  
		var is_global = pagelayer_is_global_color(setColor[num]);
		var global_list = '<div class="pagelayer-global-color-list">'+
		'<div class="pagelayer-global-setting-color">'+
			'<b>Global Colors</b><span class="pli pli-service"></span>'+
		'</div>';
    
		for( cid in pagelayer_global_colors ){
			
			var color = pagelayer_global_colors[cid];
			var active_class = '';
			
			if(cid == is_global){
				active_class = 'pagelayer-global-selected';
			}
			
			// If global color not exist
			if(!pagelayer_empty(is_global)){
				setColor[num] = pagelayer_global_colors[is_global]['value'];
			}
			
			global_list += '<div class="pagelayer-global-color-list-item '+ active_class +'" data-global-id="'+ cid +'">'+
				'<span class="pagelayer-global-color-pre" style="background:'+ color['value'] +'"></span>'+
				'<span class="pagelayer-global-color-title">'+ color['title'] +'</span>'+
				'<span class="pagelayer-global-color-code">'+  color['value'] +'</span>'+
			'</div>';
		}
		global_list += '</div>';
		
		return global_list;
	}
	
	var div = '<div class="pagelayer-elp-gradient-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-angle">'+
			'<label class="pagelayer-elp-label">Angle</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="360" min="0" step="1" class="pagelayer-elp-gradient-angle" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 1</label>'+
			'<div class="pagelayer-elp-color-div-holder">'+
				'<div class="pagelayer-elp-color-global"></div>'+
				'<div class="pagelayer-elp-color-div">'+
					'<div class="pagelayer-elp-gradient-color1 pagelayer-elp-color-preview"></div>'+
				'</div>'+
				getColorList(0)+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per1">'+
			'<label class="pagelayer-elp-label">Percentage 1</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-gradient-per1" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 2</label>'+
			'<div class="pagelayer-elp-color-div-holder">'+
				'<div class="pagelayer-elp-color-global"></div>'+
				'<div class="pagelayer-elp-color-div">'+
					'<div class="pagelayer-elp-gradient-color2 pagelayer-elp-color-preview"></div>'+
				'</div>'+
				getColorList(1)+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per2">'+
			'<label class="pagelayer-elp-label">Percentage 2</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-gradient-per2" value="'+val[4]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 3</label>'+
			'<div class="pagelayer-elp-color-div-holder">'+
				'<div class="pagelayer-elp-color-global"></div>'+
				'<div class="pagelayer-elp-color-div">'+
					'<div class="pagelayer-elp-gradient-color3 pagelayer-elp-color-preview"></div>'+
				'</div>'+
				getColorList(2)+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per3">'+
			'<label class="pagelayer-elp-label">Percentage 3</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-gradient-per3" value="'+val[6]+'"></input>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	var i = 0;
	row.find('.pagelayer-elp-color-preview').each(function(){
		jQuery(this).css('background', setColor[i]);
		i++;
	});
	
	// Remove global
	var removeGlobal = function(holder){
		holder.find('.pagelayer-elp-color-global').removeClass('pagelayer-active-global');
		holder.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
		holder.find('.pagelayer-global-color-list').hide();
	}
	
	var picker1 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color1')[0],
		popup : 'left',
		color : setColor[0],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker1.onChange = function(color) {
		var cPreview = row.find('.pagelayer-elp-gradient-color1')
		cPreview.css('background', color.rgbaString);
		val[1] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
		
		removeGlobal(cPreview.closest('.pagelayer-elp-color-div-holder'));
	};
	
	var picker2 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color2')[0],
		popup : 'left',
		color : setColor[1],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker2.onChange = function(color) {
		var cPreview = row.find('.pagelayer-elp-gradient-color2');
		cPreview.css('background', color.rgbaString);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
		
		removeGlobal(cPreview.closest('.pagelayer-elp-color-div-holder'));
	};
	
	var picker3 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color3')[0],
		popup : 'left',
		color : setColor[2],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker3.onChange = function(color) {
		var cPreview = row.find('.pagelayer-elp-gradient-color3');
		cPreview.css('background', color.rgbaString);
		val[5] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
		
		removeGlobal(cPreview.closest('.pagelayer-elp-color-div-holder'));
	};
	
	row.find('input').on('input', function(){
		var i = 0;
		row.find('.pagelayer-elp-gradient-input').each(function(){
			var value = jQuery(this).val();
			val[i] = (value ? value : '');
			i = i+2;
		});
		_pagelayer_set_atts(row, val);
	});
	
	row.find('.pagelayer-global-selected').each(function(){
		jQuery(this).closest('.pagelayer-elp-color-div-holder').find('.pagelayer-elp-color-global').addClass('pagelayer-active-global');
	});
	
	// Handle for global color
	row.find('.pagelayer-elp-color-global').on('click', function(e){
		jQuery(this).closest('.pagelayer-elp-color-div-holder').find('.pagelayer-global-color-list').slideToggle();
	});

	row.find('.pagelayer-global-setting-color').on('click', function(e){
		e.stopPropagation();

		if(jQuery(e.target).closest('.pli-service').length < 1){
			return;
		}
		
		window.open( pagelayer_customizer_url + '&autofocus%5Bsection%5D=pagelayer_global_colors_sec', '_blank' );
	});
		
	// Handle for global color
	row.find('.pagelayer-global-color-list-item ').on('click', function(e){
		e.stopPropagation();
		
		var listItem = jQuery(this);
		var globalID = listItem.data('global-id');
		var listHolder = listItem.closest('.pagelayer-global-color-list');
		var colorHolder = listItem.closest('.pagelayer-elp-color-div-holder');
		var colorPreview = colorHolder.find('.pagelayer-elp-color-preview');
		
		// Remove previous selecttion
		listHolder.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
		listItem.addClass('pagelayer-global-selected');
		colorHolder.find('.pagelayer-elp-color-global').addClass('pagelayer-active-global');
		listHolder.slideUp();
				
		var color = pagelayer_global_colors[globalID]['value'];
		colorPreview.removeClass('pagelayer-blank-preview').css('background', color);
		
		var i = 1;
		
		if(colorPreview.hasClass('pagelayer-elp-gradient-color2')){
			i = 3;
		}
		
		if(colorPreview.hasClass('pagelayer-elp-gradient-color3')){
			i = 5;
		}
		
		val[i] = '$'+globalID;
		_pagelayer_set_atts(row, val);// Save and Render
		
	});
	
}

function pagelayer_elp_font_family(row, prop){
	
	var options = '';
	var option = function(val, lang, type){
		var selected = (val != prop.c['val']) ? '' : 'selected="selected"';
		var lang = pagelayer_empty(lang) ? 'Default' : lang;
		return '<option class="pagelayer-elp-select-option" value="'+val+'" type="'+type+'" '+selected+'>'+lang+'</option>';
	}

	for(y in pagelayer_fonts){
		if(y != 'default'){
			options += '<optgroup label="'+pagelayer_ucwords(y)+'">';
		}
		for (x in pagelayer_fonts[y]){
			options += option((jQuery.isNumeric(x) ? pagelayer_fonts[y][x] : x), pagelayer_fonts[y][x], y);
		}		
	}
	
	var div = '<div class="pagelayer-elp-select-div pagelayer-elp-pos-rel">'+
				'<select class="pagelayer-elp-select pagelayer-select" name="'+prop.c['name']+'">'+options+'</select>'+
  '</div>';
			
	row.append(div);
	
	row.find('select').on('change', function(){
		
		var sEle = jQuery(this);
		
		pagelayer_link_font_family(sEle);
		_pagelayer_set_atts(row, sEle.val());// Save and Render		
	
	});
	
}

// The typography property
function pagelayer_elp_typography(row, prop){
	
	var val = pagelayer_parse_typo(prop.c['val'], true);
	var is_typo = pagelayer_is_global_typo(prop.c['val']);
	var global_active = '';
	var save_timer = {};
	
	// Load value of tablet and mobile
	var val_tablet = pagelayer_get_att(prop.el.$, prop.c['name']+'_tablet');
	var val_mobile = pagelayer_get_att(prop.el.$, prop.c['name']+'_mobile');
	
	val_tablet = pagelayer_parse_typo(val_tablet);
	val_mobile = pagelayer_parse_typo(val_mobile);
	
	
	// If global color not exist
	if(!pagelayer_empty(is_typo)){
		global_active = 'pagelayer-active-global';
	}
	
	var select = {
		'style' : {'' : 'Default', 'normal' : 'Normal', 'italic' : 'Italic', 'oblique' : 'Oblique'},
		'weight' : {'' : 'Default', '100' : '100', '200' : '200', '300' : '300', '400' : '400', '500' : '500', '600' : '600', '700' : '700', '800' : '800', '900' : '900', 'normal' : 'Normal', 'lighter' : 'Lighter', 'bold' : 'Bold', 'bolder' :'Bolder', 'unset' : 'Unset'},
		'variant' : {'' : 'Default', 'normal' : 'Normal', 'small-caps' : 'Small Caps'},
		'deco-line' : {'' : 'Default', 'none' : 'None', 'overline' : 'Overline', 'line-through' : 'Line Through', 'underline' : 'Underline', 'underline overline' : 'Underline Overline'},
		'deco-style' : {'' : 'Default', 'solid' : 'Solid', 'double' : 'Double', 'dotted' : 'Dotted', 'dashed' : 'Dashed', 'wavy' : 'Wavy'},
		'transform' : {'' : 'Default', 'capitalize' : 'Capitalize', 'uppercase' : 'Uppercase', 'lowercase' : 'Lowercase'},
		'fonts' : pagelayer_fonts,
	}
	
	var option = function(val, lang, setVal){
		var selected = (val.toLowerCase() != setVal.toLowerCase()) ? '' : 'selected="selected"';

		var lang = pagelayer_empty(lang) ? 'Default' : lang;
		return '<option value="'+val+'" '+selected+'>'+ lang +'</option>';
	}
	
	var font_options = '';
	var font_option = function(val, lang, type, setVal){
		var selected = (val != setVal) ? '' : 'selected="selected"';
		var lang = pagelayer_empty(lang) ? 'Default' : lang;
		return '<option class="pagelayer-elp-typo-sele-op" value="'+val+'" type="'+type+'" '+selected+'>'+lang+'</option>';
	}

	for(y in select['fonts']){
		if(y != 'default'){
			font_options += '<optgroup label="'+pagelayer_ucwords(y)+'">';
		}
		for (x in select['fonts'][y]){
			font_options += font_option((jQuery.isNumeric(x) ? select['fonts'][y][x] : x), select['fonts'][y][x], y, val[0]);
		}		
	}
	
	var modes = {desktop: '', tablet: '_tablet', mobile: '_mobile'};
	var mode = pagelayer_get_screen_mode();
	var screen = '<div class="pagelayer-elp-screen">'+
		'<i class="pli pli-desktop" ></i>'+
		'<i class="pli pli-tablet" ></i>'+
		'<i class="pli pli-mobile" ></i>'+
		'<i class="pagelayer-prop-screen pli pli-'+mode+'" ></i>'+
	'</div>';
	
	var div = '<span class="pagelayer-elp-typo-edit-div">'+
			'<i class="pli pli-pencil"></i>'+
		'</span>'+
		'<div class="pagelayer-elp-typo-div" pagelayer-screen-mode="'+mode+'">'+
		'<div class="pagelayer-elp-typo-fonts">'+
			'<div class="pagelayer-elp-global-typo">'+
				'<label class="pagelayer-elp-label">'+pagelayer_l('global_fonts')+'</label>'+
				'<span class="pagelayer-elp-typo-icons">'+
					'<span class="pagelayer-elp-global-icon '+global_active+'"></span>'+
					'<span class="pli pli-service"></span>'+
				'</span>'+
				'<div class="pagelayer-global-font-list">';

						for( cid in pagelayer_global_fonts ){
							
							var font = pagelayer_global_fonts[cid];

							div += '<div class="pagelayer-global-font-list-item" data-global-id="'+ cid +'">'+
								'<span class="pagelayer-global-font-title">'+font['title']+'</span>'+
							'</div>';
						}
				 div += '</div>'+
			'</div>'+
			'<div class="pagelayer-elp-typo pagelayer-elp-typo-family">'+
				'<label class="pagelayer-elp-label">'+pagelayer_l('font_family')+'</label>'+
				'<select class="pagelayer-elp-typo-input pagelayer-elp-select" name="font-family">'+font_options+'</select>'+
			'</div>';
	
	div += '<div class="pagelayer-elp-typo pagelayer-elp-typo-size">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_size')+' '+screen+'</label>'+
			'<input name="font-size"  pagelayer-show-device="desktop" class="pagelayer-elp-typo-input" type="number" max="200" min="0" step="1" value="'+val[1]+'"></input>'+
			'<input name="font-size_tablet"  pagelayer-show-device="tablet" class="pagelayer-elp-typo-input" type="number" max="200" min="0" step="1" value="'+val_tablet[1]+'"></input>'+
			'<input name="font-size_mobile" pagelayer-show-device="mobile" class="pagelayer-elp-typo-input" type="number" max="200" min="0" step="1" value="'+val_mobile[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-style">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_style')+'</label>'+
			'<select name="font-style" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	
	jQuery.each(select['style'],function(key, value){
		div += option(key, value, val[2]);
	});
			div +='</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-weight">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_weight')+' '+screen+'</label>'+
			'<select name="font-weight" pagelayer-show-device="desktop" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['weight'],function(key, value){
		div += option(key, value, val[3]);
	});
			
			div += '</select>'+
			'<select name="font-weight_tablet" pagelayer-show-device="tablet" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['weight'],function(key, value){
		div += option(key, value, val_tablet[3]);
	});
			
			div += '</select>'+
			'<select name="font-weight_mobile" pagelayer-show-device="mobile" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['weight'],function(key, value){
		div += option(key, value, val_mobile[3]);
	});
			
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-variant">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_variant')+'</label>'+
			'<select name="font-variant" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['variant'],function(key, value){
		div += option(key, value, val[4]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-deco-line">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('decoration_line')+'</label>'+
			'<select name="text-decoration-line" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['deco-line'],function(key, value){
		div += option(key, value, val[5]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-deco-style">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('decoration_style')+'</label>'+
			'<select name="text-decoration-style" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['deco-style'],function(key, value){
		div += option(key, value, val[6]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-height">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('line_height')+' '+screen+'</label>'+
			'<input name="line-height" class="pagelayer-elp-typo-input" pagelayer-show-device="desktop" type="number" max="15" min="0" step="0.1" value="'+val[7]+'"></input>'+
			'<input name="line-height_tablet" pagelayer-show-device="tablet" class="pagelayer-elp-typo-input" type="number" max="15" min="0" step="0.1" value="'+val_tablet[7]+'"</input>'+
			'<input name="line-height_mobile" class="pagelayer-elp-typo-input" pagelayer-show-device="mobile" type="number" max="15" min="0" step="0.1" value="'+val_mobile[7]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-transform">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('text_transform')+'</label>'+
			'<select name="text-transform" class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['transform'],function(key, value){
		div += option(key, value, val[8]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-lspacing">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('text_spacing')+' '+screen+'</label>'+
			'<input name="letter-spacing" pagelayer-show-device="desktop" class="pagelayer-elp-typo-input" type="number" max="10" min="-10" step="0.1" value="'+val[9]+'"></input>'+
			'<input name="letter-spacing_tablet" pagelayer-show-device="tablet" class="pagelayer-elp-typo-input" type="number" max="10" min="-10" step="0.1" value="'+val_tablet[9]+'"></input>'+
			'<input name="letter-spacing_mobile" pagelayer-show-device="mobile" class="pagelayer-elp-typo-input" type="number" max="10" min="-10" step="0.1" value="'+val_mobile[9]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-wspacing">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('word_spacing')+' '+screen+'</label>'+
			'<input name="word-spacing" pagelayer-show-device="desktop" class="pagelayer-elp-typo-input" type="number" max="50" min="0" step="1" value="'+val[10]+'"></input>'+
			'<input name="word-spacing_tablet" pagelayer-show-device="tablet" class="pagelayer-elp-typo-input" type="number" max="50" min="0" step="1" value="'+val_tablet[10]+'"></input>'+
			'<input name="word-spacing_mobile" pagelayer-show-device="mobile" class="pagelayer-elp-typo-input" type="number" max="50" min="0" step="1" value="'+val_mobile[10]+'"></input>'+
		'</div>'+
	'</div>'+
	'</div>';
			
	row.append(div);
	
	if(pagelayer_empty(val[5]) || val[5]=='none'){
		row.find('.pagelayer-elp-typo-deco-style').hide();
	}
	
	row.find('.pagelayer-elp-typo-edit-div .pli-pencil').on('click', function(){
		row.find('.pagelayer-elp-typo-div').toggleClass('pagelayer-prop-show');				
	});
	
	var save_typography = function(){
		var globalEle = row.find('.pagelayer-global-selected');
		var atts = {};
    
		atts[prop.c['name']] = {};
		atts[prop.c['name']+'_tablet'] = {};
		atts[prop.c['name']+'_mobile'] = {};
				
		
		if(globalEle.length > 0){
			atts[prop.c['name']]['global-font'] = globalEle.attr('data-global-id');
		}
		
		row.find('.pagelayer-elp-typo-input').each(function(){
			
			var iEle = jQuery(this);
			var name = iEle.attr('name');
			var value = iEle.val();
			var isGlobal = iEle.closest('[pagelayer-set-global]');
			
			if((value == '' && isGlobal.length < 1 && globalEle.length < 1) || isGlobal.length > 0){
				return;
			}
			
			if(name.indexOf('_tablet') > -1){
				name = name.replace('_tablet', '');
				atts[prop.c['name']+'_tablet'][name] = value;
				return;
			}
			
			if(name.indexOf('_mobile') > -1){
				name = name.replace('_mobile', '');
				atts[prop.c['name']+'_mobile'][name] = value;
				return;
			}
			
			atts[prop.c['name']][name] = value;
		});
				
		pagelayer_set_atts(prop.el.$, atts);
		pagelayer_sc_render(prop.el.$); // Render
	}
	
	row.find('.pagelayer-elp-typo-input').on('change', function(e){
		
		var jEle = jQuery(e.target);
		
		pagelayer_link_font_family(jEle);
		jEle.closest('[pagelayer-set-global]').removeAttr('pagelayer-set-global');
		
		// Save value
		save_typography();
	});
	
	row.find('.pagelayer-elp-typo-deco-line select').on('change', function(){
		var value = jQuery(this).val();
		if(pagelayer_empty(value) || value=='none'){
			row.find('.pagelayer-elp-typo-deco-style').hide();
		}else{
			row.find('.pagelayer-elp-typo-deco-style').show();
		}
	});
		
	// Handle for global font
	row.find('.pagelayer-elp-global-typo .pagelayer-elp-global-icon').on('click', function(e){
		e.stopPropagation();
		row.find('.pagelayer-global-font-list').slideToggle();
		
	});
	
	row.find('.pagelayer-elp-global-typo .pli-service').on('click', function(e){
		e.stopPropagation();
		window.open(pagelayer_customizer_url+'&autofocus%5Bsection%5D=pagelayer_global_fonts_sec', '_blank');
	});
	
	// Added restore global val
	row.find('.pagelayer-elp-typo > .pagelayer-elp-label').each(function(){
		var label = jQuery(this);
		var defaultButton = '<span class="pagelayer-typo-default" title="'+pagelayer_l('restore_global')+'" ><i class="fas fa-undo"></i></span>';		
		label.append(defaultButton);
		
		label.find('.pagelayer-typo-default').on('click', function(e, skip_save){
			
			skip_save = skip_save || false;
			
			var globalID = row.find('.pagelayer-global-selected').data('global-id');
			
			if(pagelayer_empty(globalID) || pagelayer_empty(pagelayer_global_fonts[globalID])){
				return;
			}
			
			var setFonts = pagelayer_global_fonts[globalID]['value'];
			var holder = label.closest('.pagelayer-elp-typo');
			var inputs = holder.find('.pagelayer-elp-typo-input');
			var name = inputs.first().attr('name');
			var val = '';
			
			holder.attr('pagelayer-set-global', 1);
			
			if(name in setFonts){
				val = setFonts[name];
			}
			
			if(typeof val == 'object'){
				for(var mode in modes){
					var _val = '';
					if(mode in val){
						_val = val[mode];
					}
					
					holder.find('.pagelayer-elp-typo-input[name="'+name+modes[mode]+'"]').val(_val);
				}
			}else{
				
				if(inputs.length > 1){
					inputs.val('');
				}
				
				inputs.first().val(val);
			}
			
			if(skip_save){
				return;
			}
			
			// save value
			clearTimeout(save_timer);
			save_timer = setTimeout(save_typography, 200);
			
		});	
	});
	
	// Handle for global font
	row.find('.pagelayer-global-font-list-item').on('click', function(e){
		e.stopPropagation();
		
		var listItem = jQuery(this);
		var fontSelect = row.find('.pagelayer-elp-typo-family .pagelayer-elp-typo-input');
		
		// Remove global typo 
		if(listItem.hasClass('pagelayer-global-selected')){
			row.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
			row.find('.pagelayer-elp-global-icon').removeClass('pagelayer-active-global');
			row.find('[pagelayer-set-global]').removeAttr('pagelayer-set-global');
			row.find('.pagelayer-global-on').removeClass('pagelayer-global-on');
			
			// To save and render the typo 
			fontSelect.trigger('change');
			return;
		}
		
		var globalID = listItem.data('global-id');
		var listHolder = row.find('.pagelayer-global-font-list');
		
		// Remove previous selecttion
		listHolder.find('.pagelayer-global-selected').removeClass('pagelayer-global-selected');
		listItem.addClass('pagelayer-global-selected');
		row.find('.pagelayer-elp-global-icon').addClass('pagelayer-active-global');
		row.find('.pagelayer-elp-typo-fonts').addClass('pagelayer-global-on');
		listHolder.slideUp();
		
		pagelayer_link_font_family(fontSelect); // Apply google fonts
		
		// Set global value to all fields and save
		row.find('.pagelayer-elp-label .pagelayer-typo-default').click();
	});
	
	// Active global typography
	if(!pagelayer_empty(is_typo)){
		row.find('[data-global-id="'+is_typo+'"]').addClass('pagelayer-global-selected');
		row.find('.pagelayer-elp-global-icon').addClass('pagelayer-active-global');
		row.find('.pagelayer-elp-typo-fonts').addClass('pagelayer-global-on');
		
		// Show the global values if is not customize
		row.find('.pagelayer-elp-typo').attr('pagelayer-set-global', 1);
		row.find('.pagelayer-elp-typo').find('select, input').each(function(){
			var sEle = jQuery(this);
			var val = sEle.val();
			
			if(pagelayer_empty(val)){
				return true;
			}
			
			sEle.closest('.pagelayer-elp-typo').removeAttr('pagelayer-set-global');
		});
		
		row.find('[pagelayer-set-global="1"] .pagelayer-typo-default').trigger('click', [true]);
	}
	
	// Set screen mode on change
	row.find('.pagelayer-elp-screen .pli:not(.pagelayer-prop-screen)').on('click', function(){
		var mode = 'desktop';
		var jEle = jQuery(this);
		
		// Tablet ?
		if(jEle.hasClass('pli-tablet')){
			mode = 'tablet';
		}
		
		// Mobile ?
		if(jEle.hasClass('pli-mobile')){
			mode = 'mobile';
		}
		
		pagelayer_set_screen_mode(mode);
		row.find('.pagelayer-elp-screen .pli').removeClass('open');
	});
	
	row.find('.pagelayer-elp-screen').on('pagelayer-screen-changed', function(e){
		var mode = pagelayer_get_screen_mode();
		row.find('[pagelayer-screen-mode]').attr('pagelayer-screen-mode', mode);
	});
	
	row.find('.pagelayer-elp-screen .pagelayer-prop-screen').on('click', function(e){
		jQuery(this).siblings().toggleClass('open');
	});
	
}

// The dimension property
function pagelayer_elp_dimension(row, prop){
	
	var val = ['', ''];
	
	if(!pagelayer_empty(prop.c['val'])){
		
		val = prop.c['val'];
		if(pagelayer_is_string(val)){
			val = val.split(',');
			//console.log(val);
		}
		
	}
	
	var div = '<div class="pagelayer-elp-dimension-div">'+
		'<input type="number" class="pagelayer-elp-dimension" value="'+parseFloat(val[0])+'"></input>'+
		'<input type="number" class="pagelayer-elp-dimension" value="'+parseFloat(val[1])+'"></input>'+
		'<i class="pli pli-link" ></i>'+
	'</div>';
	
	row.append(div);
	
	// Is the value linked ?
	var link = row.find('.pagelayer-elp-dimension-div .pli');
	var isLinked = 1;
	var tmp_val = val[0];
	
	for(var p_val in val){

		// Check if unlinked
		if(tmp_val != val[p_val] ){
			isLinked = 0;
		}
		tmp_val = val[p_val];
	}
	
	if(isLinked){
		link.addClass('pagelayer-elp-dimension-linked');
	}else{
		link.removeClass('pagelayer-elp-dimension-linked');
	}
	
	// Handle link on click
	link.on('click', function(){
		
		var linked = link.hasClass('pagelayer-elp-dimension-linked');
		
		if(linked){
			link.removeClass('pagelayer-elp-dimension-linked');
		}else{
			link.addClass('pagelayer-elp-dimension-linked');
		}
				
	});
	
	row.find('input').on('input', function(){
		
		// Are the values linked
		var linked = row.find('.pagelayer-elp-dimension-div .pli').hasClass('pagelayer-elp-dimension-linked');
		
		if(linked){
			var val = jQuery(this).val();
			row.find('input').each(function(){
				jQuery(this).val(val);
			});
		}
		
		var vals = [];
		
		// Get all values
		row.find('input').each(function(){
			var val = jQuery(this).val();
			vals.push(val ? val : 0);
		});
		
		_pagelayer_set_atts(row, vals);// Save and Render
	});
	
};

var first_time_cat = true;
// Post Category property
function pagelayer_elp_postCategory(row, prop){

	if(pagelayer_empty(pagelayer_post_categories)){
		return;
	}
  
	// Placing the checked categories on the top.
	var checked_on_top = function(with_checkbox){
		var checked_list = '';
		var unchecked_list = '';
		
		for(var list of jQuery(with_checkbox).children()){			
			var temp = jQuery(list).find('input[checked=checked]');
			if(!pagelayer_empty(temp.length)){
				checked_list += list.outerHTML;
			}else{
				unchecked_list += list.outerHTML;
			}
		}
    
		return ('<div class="pagelayer-post-cat-div" ><ul class="pagelayer-post-category" >'+checked_list+unchecked_list+'</ul></div>');
	}
	
	// Getting checked and unchecked categories on opening of page props settings.
	if(first_time_cat == false){
	
		var $div = jQuery('<div>').html(pagelayer_post_categories.with_checkbox);
		$div.find('input[type=checkbox]').attr('checked', false);		
		
		if(!pagelayer_empty(prop.c['val'])){
			
			var check_val = prop.c['val'];
			if(pagelayer_is_string(check_val)){
				check_val = check_val.split(',');
			}
			
			for(var no in check_val){
				$div.find('input[type=checkbox][value='+check_val[no]+']').attr('checked', true);
			}			
		}
		
		pagelayer_post_categories.with_checkbox = $div.html();
    
	}
	
	first_time_cat = false;
	
	// For making insert new categories functionality.				
	row.append(checked_on_top(pagelayer_post_categories.with_checkbox));
	
	var div = '<div class="pagelayer-elp-postCategory">'+
		'<span class="pagelayer-add-cat-btn">Add New Category</span>'+
		'<form style="display:none;">'+
			'<div>'+
			'<label>New Category Name</label>'+
			'<input type="text" name="category_name" required>'+					
			'</div>'+
			'<div>'+
			'<label>Parent Category</label>'+
			'<div class="pagelayer-parent-category"></div>'+
			'</div>'+
			'<button type="submit" class="pagelayer-cat-submit" >Add New Category</button>'+
		'</form>'+
	  '</div>';
	  
	row.append(div);
	
	// For making categories drop down options and adding an empty option.
	if(!pagelayer_empty(pagelayer_post_categories.without_checkbox)){			
		var options = pagelayer_post_categories.without_checkbox.replace('>', '><option class="level-0" value="0">--No Parent--</option>');
		var options = jQuery(options);	
		row.find('.pagelayer-parent-category').append(options);
	}
	
	// For initiating ajax call when user create new category
	row.find('form').on('submit', function(e){
		e.preventDefault();
		jQuery.ajax({
			type: 'post',
			url: pagelayer_ajax_url+'&action=pagelayer_get_cat_checkboxes',
			dataType: 'json',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				'postid': pagelayer_postID,
				'new_cat': row.find('form').serialize()
			},
			success: function(obj){
				
				if(pagelayer_empty(obj)){
					return;
				}	
				
				if('error' in obj){
					alert(obj.error);
				}
				
				if(!pagelayer_empty(obj.new_cat_id)){						
					obj.with_checkbox = obj.with_checkbox.replace('value="'+obj.new_cat_id+'"', 'value="'+obj.new_cat_id+'" checked="checked"'); 						
				}	
				
				var new_cat_elem = jQuery(obj.with_checkbox).find('input[value='+obj.new_cat_id+']').closest('li');
				var post_cat = row.find('.pagelayer-post-category');
        
				// Does the new element have no parents ? Then prepend the <LI> to the existing list shown
				if(!pagelayer_empty(new_cat_elem.parent('.pagelayer-post-category').length)){
					post_cat.prepend(new_cat_elem);
				}else{
          
					// Siblings are already there ?
					if(!pagelayer_empty(new_cat_elem.siblings().length)){
						post_cat.find('#'+new_cat_elem.parent().parent('li').attr('id')).children('ul').append(new_cat_elem);
					// No siblings, hence append
					}else{
						new_cat_elem = new_cat_elem.parent();
						post_cat.find('#'+new_cat_elem.closest('li').attr('id')).append(new_cat_elem);
					}
					
					post_cat.prepend(new_cat_elem.parentsUntil('.pagelayer-post-category').last());
				}				
				
				row.find('#pagelayer_cat_parent').replaceWith(obj.without_checkbox.replace('>', '><option class="level-0" value="0">--No Parent--</option>'));
				
				row.find('input[name="category_name"]').val('');
				row.find('#pagelayer_cat_parent option[value="0"]').attr('selected', true);
				checked_cat(row.find('.pagelayer-post-cat-div'));
				event_function();
				pagelayer_post_categories = obj;
			}
		});
	});
	
	// Show and hide 'Add new Category' button.
	row.find('.pagelayer-add-cat-btn').on('click', function(){
		row.find('form').toggle('fast');
	});
	
	var checked_cat = function(elem){
		var jEle = elem.find('input:checked');
		var cat_array = [];
		for(var checked_input of jEle){
			cat_array.push(jQuery(checked_input).attr('value'));
		}
		_pagelayer_set_atts(row, cat_array);
	};
	
	var event_function = function(){row.find('.pagelayer-post-cat-div').on('change', function(){
			checked_cat(jQuery(this));
		});
	};
	event_function();
}

var first_time_tag = true;
// Post tags property
function pagelayer_elp_postTags(row, prop){

	if(pagelayer_empty(pagelayer_post_tags)){
		return;
	}
	
	var div = '<div class="pagelayer-elp-postTags" >'+
				'<div class="pagelayer-post-tags" >'+
					'<input type="text" autocomplete="off" class="pagelayer-elp-postTags-inp" autofocus="autofocus"/>'+
					'<ul class="pagelayer-postTags-list" >'+
					'</ul>'+
				'</div>'+
			'</div>';
	
	row.append(div);
	
	// Single tag html
	var singleTag = function(tags){
		var html = '';
		jQuery.each(tags, function(index, value){
			if(pagelayer_empty(value['term_id'])){
				return;
			}
			html += '<span class="pagelayer-elp-tags-ele" data-val="'+value['term_id']+'"><span class="pagelayer-tags-label" >'+value['name']+'</span><span class="pagelayer-elp-tags-remove"><i class="fas fa-times"></i></span></span>';
		});
		return html;
	}
	
	// Single list item html
	var singleLi= function(tags){
		var html = '';
		jQuery.each(tags, function(index, value){
			html += '<li data-val="'+value['term_id']+'">'+value['name']+'</li>';
		});
		return html;
	}	
	
	// For making new tags as well as removing using keyboard inputs.
	var keypresses = function(obj){
		row.find('.pagelayer-elp-postTags-inp').on('keydown', function(e){
			var val = e.target.value.trim();
			var keycode = (event.keyCode ? event.keyCode : event.which);
			
			if(keycode == '13' || keycode == '188'){
				
				for(var tag of obj.allTags){
					if(tag['name']==val){
						insertTags(val, tag['term_id']);
						return false;
					}
				}
				
				jQuery.ajax({
					url: pagelayer_ajax_url+'&action=pagelayer_get_post_tags',
					type: 'post',
					dataType: 'json',
					data: {
						pagelayer_nonce: pagelayer_ajax_nonce,
						'postid': pagelayer_postID,
						'new_tag': val
					},
					success: function(resp){
						if(pagelayer_empty(resp)){
							return;
						}	
						if('error' in resp){
							alert(resp.error);
						}
						if(!pagelayer_empty(resp.tag_id)){
							insertTags(val, resp.tag_id);
							tagSearching(resp);
							pagelayer_post_tags = resp;
						}
					}
				});
				
				return false;
			}else if(keycode == '8'){
				if(!pagelayer_empty(val)){
					return true;
				}
				row.find('.pagelayer-post-tags').children('span').last().remove();
				selected_tags();
			}
			return true;
		});
	}
	
	// Inserting tags in the Metabox.
	var insertTags = function(name, tag_id){
		var newItem = [];
		newItem[0] = {	
			name:name, 
			term_id:tag_id 
		};
		row.find('.pagelayer-post-tags').children('input').before(singleTag(newItem));
		row.find('.pagelayer-elp-postTags .pagelayer-elp-postTags-inp').val('').focus();
		tag_remove();
		selected_tags();
	}
	
	// Removing tags by clicking on the x button.
	var tag_remove = function(){
		row.find('.pagelayer-elp-tags-remove').each(function(){
			jQuery(this).on('click',function(){
				jQuery(this).parent().remove();
				selected_tags();
			});
		});
	}	
	
	// For searching tag name in the list of the fetched tags
	var tagSearching = function(obj){
		row.find('.pagelayer-elp-postTags-inp').off('keyup');
		row.find('.pagelayer-elp-postTags-inp').on("keyup", function() {
			var value = jQuery(this).val().toLowerCase();
			
			var listUl = row.find('.pagelayer-postTags-list');
			listUl.empty();
			
			if(value.length<2){
				return;
			}
			
			var listValues = obj.allTags.filter(function(currentValue){
				if(currentValue.name.indexOf(this)>-1){
					var temp = false;
					var tags = row.find('.pagelayer-post-tags').children('span');
					for(var indi of tags){
						if(jQuery(indi).attr('data-val')==currentValue.term_id){
							temp = true;
						}
					}
					if(temp==false){
						return currentValue;
					}
				}
			}, value);
			
			if(!pagelayer_empty(listValues.length)){
				listUl.append(singleLi(listValues));
				listUl.children().each(function(index, value){
					var ele = jQuery(this);
					ele.off('click');
					ele.on('click', function(){
						insertTags(ele.text(), ele.attr('data-val'));
						listUl.empty();
					});
				});
			}
			
			
		});
	}
	  
  var tagsArray = pagelayer_post_tags.postTags;
  
	// Getting tags on opening of page props settings.
	if( first_time_tag == false ){
  
		var i=0;
		var tags_array = [];
    
		// Create array for needed term_id with corresponding to the name.
		if(!pagelayer_empty(prop.c['val'])){
			
			var tags_val = prop.c['val'];
			if(pagelayer_is_string(tags_val)){
				tags_val = tags_val.split(',');
			}
			
			for(var name in tags_val){
				tags_array[i] = pagelayer_post_tags.allTags.find(function(val){return val['name'] == tags_val[name]});
				i++;
			}			
		}
		
		tagsArray = tags_array;		
	}
  
	row.find('.pagelayer-post-tags').prepend(singleTag(tagsArray));		
  
	first_time_tag = false;
			
	tagSearching(pagelayer_post_tags);
	
	keypresses(pagelayer_post_tags);
	
	tag_remove();
	
	var selected_tags = function(){
		var jEle = row.find('.pagelayer-elp-postTags .pagelayer-elp-tags-ele');
		var tag_array = [];
		for(var selec_tag of jEle){
			tag_array.push(jQuery(selec_tag).text());
		}
		_pagelayer_set_atts(row, tag_array);
	};
}

function pagelayer_elp_permalink(row, prop){
	
	var tmp = '';
	var link = '';
	
	if(!pagelayer_empty(pagelayer_permalink_structure)){
		tmp = pagelayer_post_permalink.replace(/\/$/,'');
		link = tmp.substring(0, tmp.lastIndexOf('/'));
				
		var new_link = link+'/'+prop.c['val'];
		prop.default = pagelayer_post.post_name;
		
		var div = '<div class="pagelayer-elp-text-div">'+
					'<input type="text" class="pagelayer-elp-text" name="'+prop.c['name']+'" value="'+pagelayer_htmlEntities(prop.c['val'])+'"></input>'+
					'<a href="'+pagelayer_post_permalink+'" class="pagelayer-elp-permalink-a" target="_blank" >'+new_link+'</a></p>'+
				'</div>';		
	}else{
		var div = '<div class="pagelayer-elp-text-div">'+
					'<a href="'+pagelayer_post.guid+'" class="pagelayer-elp-permalink-a" target="_blank" >'+pagelayer_post.guid+'</a></p>'+
				'</div>';
	}
	
	row.append(div);
	
	setTimeout(function(){
		row.find(".pagelayer-post-type").html(pagelayer_post.post_type);
	}, 1000);
	
	var string_to_slug = function (str){
		str = str.replace(/^\s+|\s+$/g, ''); // trim
		str = str.toLowerCase();
      
		// remove accents, swap ñ for n, etc
		var char_map = {
			// Latin
			'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C', 
			'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I', 
			'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O', 
			'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH', 
			'ß': 'ss', 
			'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c', 
			'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 
			'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o', 
			'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th', 
			'ÿ': 'y',

			// Latin symbols
			'©': '(c)',

			// Greek
			'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
			'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
			'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
			'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
			'Ϋ': 'Y',
			'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
			'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
			'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
			'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
			'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

			// Turkish
			'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
			'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g', 

			// Russian
			'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
			'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
			'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
			'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
			'Я': 'Ya',
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
			'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
			'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
			'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
			'я': 'ya',

			// Ukrainian
			'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
			'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

			// Czech
			'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U', 
			'Ž': 'Z', 
			'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
			'ž': 'z', 

			// Polish
			'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z', 
			'Ż': 'Z', 
			'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
			'ż': 'z',

			// Latvian
			'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N', 
			'Š': 'S', 'Ū': 'u', 'Ž': 'Z', 
			'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
			'š': 's', 'ū': 'u', 'ž': 'z'
		};
		
		for(var k in char_map) {
			str = str.replace(new RegExp(k, 'g'), char_map[k]);
		}
		
		str = str.replace('.', '-')// replace a dot by a dash
			.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
			.replace(/\s+/g, '-') // collapse whitespace and replace by a dash
			.replace(/-+/g, '-') // collapse dashes
			.replace( /\//g, '' ); // collapse all forward-slashes

		return str;
	}
	
	var editSlug = function(jEle, val){
		
		// Convert to slug
		val = string_to_slug(val);
		
		var new_link = link+'/'+val;
		var a = row.find('a');
		a.html(new_link);
		jEle.val(val);
    
		return val;
	}
	
	var input = row.find('input');
	
	if(pagelayer_empty(prop.c['val'])){
		editSlug(input, pagelayer_post.post_title);
		
		input.on('focusin', function(){
			if(!pagelayer_empty(pagelayer_get_att(prop.el.$, prop.c['name']))){
				return;
			}
			
			editSlug(input, pagelayer_get_att(prop.el.$, 'post_title'));
		});
	}
	
	input.on('focusout', function(){
		var val = jQuery(this).val();
		val = editSlug(jQuery(this), val);
		
		if(pagelayer_empty(pagelayer_get_att(prop.el.$, prop.c['name']))){
			return;
		}
		_pagelayer_set_atts(row, val);// Save and Render
	});
	
	input.on('input', function(){
		var new_link = link+'/'+jQuery(this).val();
		var a = row.find('a');
		a.html(new_link);
		_pagelayer_set_atts(row, jQuery(this).val());// Save and Render
	});	
}

// The Datetime Property
function pagelayer_elp_postDate(row, prop){
	
	var date_array = prop.c['val'].split(" ");
	
	var div = '<div class="pagelayer-elp-postdate-div">'+
				'<input type="date" class="pagelayer-elp-postdate" name="'+prop.c['name']+'" value="'+date_array[0]+'" />'+
				'<input type="time" class="pagelayer-elp-postdate" name="'+prop.c['name']+'" value="'+date_array[1]+'" />'+
			'</div>';
	
	row.append(div);
		
	row.find('.pagelayer-elp-postdate-div').on('change', function(){
		var date_string = jQuery(this).children().eq(0).val() +' '+ jQuery(this).children().eq(1).val();
		_pagelayer_set_atts(row, date_string);// Save and Render
	});
	
};

// The button Property
function pagelayer_elp_trashButton(row, prop){
		
	var div = '<div class="pagelayer-elp-trash-button-div">'+
				'<button class="pagelayer-elp-trash-button">Move to trash</button>'+
			'</div>';
	
	row.append(div);
		
	row.find('.pagelayer-elp-trash-button').on('click', function(event){
		event.preventDefault();
		if(!confirm(pagelayer_l('delete_post_conf'))){
			return;
		}
		//console.log(pagelayer_postID);
		jQuery.ajax({
			url: pagelayer_ajax_url+'&action=pagelayer_trash_post',
			type: 'post',
			dataType: 'json',
			data: {
				pagelayer_nonce: pagelayer_ajax_nonce,
				'postid': pagelayer_postID
			},
			success: function(resp){
					
				if('error' in resp){
					alert(resp.error);
				}
				
				if('url' in resp){
					window.top.location.href = resp.url;
				}
			}
		});
	});
	
};

// The Menus list property
function pagelayer_elp_menus(row, prop){
	
	var jEle = prop.el.$;
	var options = '';
	var option = function(val, lang){
		var selected = (val != prop.c['val']) ? '' : 'selected="selected"';
		return '<option class="pagelayer-elp-select-option" value="'+val+'" '+selected+'>'+lang+'</option>';
	}
	
	for(x in prop['list']){
		
		// Single item
		if(typeof prop['list'][x] == 'string'){
			options += option(x, prop['list'][x]);
		
		// Groups
		}else{
			options += '<optgroup label="'+x+'">';
			
			for(var y in prop['list'][x]){
				options += option(y, prop['list'][x][y]);
			}
			
			options += '</optgroup>';
		}
	}
	
	var div = '<div class="pagelayer-elp-select-div pagelayer-elp-pos-rel">'+
			'<select class="pagelayer-elp-select pagelayer-elp-select-menus" name="'+prop.c['name']+'">'+options+'</select>'+
	'</div>'+
	'<div class="pagelayer-elp-menu-items-holder pagelayer-elp-pos-rel"></div>';
			
	row.append(div);
		
	// Show the properties of the existing things
	var show_item = function(item, child_elements, depth){
		
		depth = depth || 0;
		
		var title = item['title'] || '';
		
		// Create the HTML
		var holder = jQuery('<div class="pagelayer-elp-group-item pagelayer-menu-depth-'+depth+'" pagelayer-menu-item="'+item['ID']+'">'+
			'<div class="pagelayer-elp-group-item-head">'+
				'<span class="pagelayer-elp-group-item-drag"><i class="pli pli-menu" ></i></span>'+
				'<span class="pagelayer-elp-group-item-title">'+title+'</span>'+
			'</div>'+
			'<div class="pagelayer-elp-group-item-body"></div>'+
			'<div class="menu-item-transport"></div>'+
		'</div>');
		
		// Append to the row
		row.find('.pagelayer-elp-menu-items-holder').append(holder);
		
		// Setup the toggle
		holder.find('.pagelayer-elp-group-item-title').first().on('click', function(){
			
			var editArea = jEle.find('.pagelayer-mega-editor-'+item['ID']);
			var child = editArea.find('[pagelayer-tag="pl_nav_menu_item"]');
			var cid;
			
			if(child.length < 1){
				
				// First add the element inside the group element
				var _child = jQuery('<div pagelayer-tag="pl_nav_menu_item"></div>');
				
				editArea.append(_child);
				
				cid = pagelayer_onadd(_child, false);
				
				child = jQuery('[pagelayer-id='+cid+']');
				
				// Set Attributes
				pagelayer_set_atts(child, item);
			}else{
				cid = pagelayer_id(child);
			}
      			
			var rEle = holder.find('.pagelayer-elp-group-item-body').first();
			
			holder.attr('pagelayer-group-item-id', cid);
			
			// If the props are not already setup
			if(rEle.html().length < 1){
				pagelayer_elpd_generate(jQuery('[pagelayer-id="'+cid+'"]'), rEle);
				
				// Change the group item title
				var tmp_title = holder.find('[pagelayer-elp-name="'+item['title']+'"] [name="'+item['title']+'"]');
		
				if(tmp_title.length > 0){
					jQuery(tmp_title).on('input', function(){						
						holder.find('.pagelayer-elp-group-item-title').html(tmp_title.val());
					});
				}
			}
			
			if(!rEle.is(':visible')){
				jQuery('.pagelayer-active-mega-menu').removeClass('pagelayer-active-mega-menu');
				jEle.find('.pagelayer-mega-menu-item.menu-item-'+item['ID']).addClass('pagelayer-active-mega-menu');
			}
			
			rEle.slideToggle();
		});
		
		// Add child elements
		if(!pagelayer_empty(child_elements[item['ID']])){
			
			depth++;
			
			for(var i in child_elements[item['ID']]){
				show_item(child_elements[item['ID']][i], child_elements, depth);
			}
		}
		
		holder.on('change', 'select[name="menu_type"]', function(){
			var mType = jQuery(this).val();
			var rowGroup = holder.find('[pagelayer-elp-name="element"]');

			if(mType != 'mega' || rowGroup.find('.pagelayer-elp-group-div .pagelayer-elp-group-item').length > 0){
				return;
			}
			
			rowGroup.find('.pagelayer-elp-button').click();
			
		});
	};
  
	var createItemsList = function(menuID){
		
		// Remove previous items
		row.find('.pagelayer-elp-menu-items-holder').empty();
		
		if(!(menuID in pagelayer_menus_items_list)){
			return;
		}
		
		var $elements = pagelayer_menus_items_list[menuID];
		var top_level_elements = [];
		var children_elements  = [];
		
		for($e in $elements){
			
			// Make a referrer of each menu 
			pagelayer_menus_items_ref[$elements[$e]['ID']] = $elements[$e];
			
			if ( pagelayer_empty( $elements[$e]['menu_item_parent'] ) ) {
				top_level_elements.push($elements[$e]);
			} else {
				if(pagelayer_empty(children_elements[ $elements[$e]['menu_item_parent'] ])){
					children_elements[ $elements[$e]['menu_item_parent'] ] = [];
				}
				children_elements[ $elements[$e]['menu_item_parent'] ].push($elements[$e]);
			}
		}
		
		for(var i in top_level_elements){
			show_item(top_level_elements[i], children_elements, 0);
		}
		
	}
	
	createItemsList(prop.c['val']);
  
	row.find('select.pagelayer-elp-select-menus').on('change', function(){
		
		var ID = jQuery(this).val();
		
		// Load Menu list
		createItemsList(ID);
		
		_pagelayer_set_atts(row, ID);// Save and Render		
	
	});
	
}

// Select frame to upload media
function pagelayer_select_frame(tag, state){
	
	var state = state || '';
	//console.log(state);
	
	var frame;
	
	switch(tag){
		
		// Multi image selection frame
		case 'multi_image':
		
			frame = wp.media({
				
				id: 'pagelayer-wp-multi-image-library',
				frame: 'post',
				state: state,
				title: pagelayer_l('frame_multi_image'),
				multiple: true,
				library: wp.media.query({type: 'image'}),
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
		
		// Media selection frame
		case 'media':
		
			frame = wp.media({
				
				id: 'pagelayer-wp-media-library',
				frame: 'post',
				state: 'pagelayer-media',
				title: pagelayer_l('frame_media'),
				multiple: false,
				states: [
					new wp.media.controller.Library({
						id: 'pagelayer-media',
						title: pagelayer_l('frame_media'),
						multiple: false,
						date: true
					})
				],
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
		
		//Default frame(for image, video, audio)
		default:
		
			frame = wp.media({
				
				id: 'pagelayer-wp-'+tag+'-library',
				frame: 'post',
				state: 'pagelayer-'+tag,
				title: pagelayer_l('frame_media'),
				multiple: false,
				library: wp.media.query({type: tag}),
				states: [
					new wp.media.controller.Library({
						id: 'pagelayer-'+tag,
						title: pagelayer_l('frame_media'),
						library: wp.media.query( { type: tag } ),
						multiple: false,
						date: true
					})
				],
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
	}
	
	frame.on({
		'menu:render:default': function(view){
			view.unset('insert');
			view.unset('gallery');
			view.unset('featured-image');
			view.unset('playlist');
			view.unset('video-playlist');
		},
	}, this);
	
	return frame;
	
}

// function to show default button
function pagelayer_show_default_button(row, prop, value){
	
	// Default button is visible or not
	if(row.find('.pagelayer-elp-default').attr('data_show')){
		return;
	}
	
	// value is an object or not
	if(typeof value == 'object'){
		// Checking value for NaN, empty and default.
		
		for(var i = 0; i < pagelayer_length(value); i++){
			if(value[i]!= prop.default && value[i] == value[i] && value[i] != ''){
				row.find('.pagelayer-elp-default').attr('data_show',true);			
				break;
			}		
		}		
	}else{
		if('default' in prop && value!=prop.default){
			row.find('.pagelayer-elp-default').attr('data_show',true);			
		}else if(value!=prop.default && value==value && value!=''){
			row.find('.pagelayer-elp-default').attr('data_show',true);			
		}
	}
}

// Function which checks the properties to not to show default button
function pagelayer_properties_filter(property){
	var propTypeDefault = ['image', 'text', 'editor', 'textarea', 'checkbox', 'access', 'modal', 'group', 'radio', 'postCategory', 'postTags', 'postDate', 'gradient'];
	
	return (jQuery.inArray(property, propTypeDefault) == -1)
}

// Link font family
function pagelayer_link_font_family(sEle){
	
	var value = sEle.val();
	
	if(sEle.val() == 'Default'){
		return;
	}
	
	value = value.replace(' ', '+');
	var t = sEle.find("option:selected").attr('type');
	switch(t){
		case 'google':
			if(jQuery('#pagelayer-google-fonts').length == 0){
				if(value==''){
					return;
				}
				jQuery('head').append('<link id="pagelayer-google-fonts" href="https://fonts.googleapis.com/css?family='+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">');
				
			}else{
				var url = jQuery('#pagelayer-google-fonts').attr('href');
				if(url.indexOf(value) == -1){
					url = url+'|'+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
					jQuery('#pagelayer-google-fonts').attr('href', url);
				}
			}
			break;
			
		case 'custom':
			if(!pagelayer_empty(jQuery('style[id='+value+'_plf]').length)){
				break;
			}
			jQuery.ajax({
				url: pagelayer_ajax_url+'&action=pagelayer_custom_font',
				type: 'POST',
				dataType: 'json',
				data: {
					'pagelayer_nonce': pagelayer_ajax_nonce,
					'font_name': value
				},
				success: function(data) {					
					if('style' in data){
						jQuery('body').append(data['style']);
					}
				}
			});
			break;
	}
}

/*
 * [hi-base64]{@link https://github.com/emn178/hi-base64}
 *
 * @version 0.2.1
 * @author Chen, Yi-Cyuan [emn178@gmail.com]
 * @copyright Chen, Yi-Cyuan 2014-2017
 * @license MIT
 */
/*jslint bitwise: true */
/*Modified by Pagelayer*/
!function(){"use strict";var r="object"==typeof window?window:{};!r.HI_BASE64_NO_COMMON_JS&&"object"==typeof module&&module.exports,"function"==typeof define&&define.amd;var t,o,e="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".split(""),n={A:0,B:1,C:2,D:3,E:4,F:5,G:6,H:7,I:8,J:9,K:10,L:11,M:12,N:13,O:14,P:15,Q:16,R:17,S:18,T:19,U:20,V:21,W:22,X:23,Y:24,Z:25,a:26,b:27,c:28,d:29,e:30,f:31,g:32,h:33,i:34,j:35,k:36,l:37,m:38,n:39,o:40,p:41,q:42,r:43,s:44,t:45,u:46,v:47,w:48,x:49,y:50,z:51,0:52,1:53,2:54,3:55,4:56,5:57,6:58,7:59,8:60,9:61,"+":62,"/":63,"-":62,_:63},a=function(r){var t,o,e,a,h=[],f=0,i=r.length;"="===r.charAt(i-2)?i-=2:"="===r.charAt(i-1)&&(i-=1);for(var C=0,c=i>>2<<2;C<c;)t=n[r.charAt(C++)],o=n[r.charAt(C++)],e=n[r.charAt(C++)],a=n[r.charAt(C++)],h[f++]=255&(t<<2|o>>>4),h[f++]=255&(o<<4|e>>>2),h[f++]=255&(e<<6|a);var g=i-c;return 2===g?(t=n[r.charAt(C++)],o=n[r.charAt(C++)],h[f++]=255&(t<<2|o>>>4)):3===g&&(t=n[r.charAt(C++)],o=n[r.charAt(C++)],e=n[r.charAt(C++)],h[f++]=255&(t<<2|o>>>4),h[f++]=255&(o<<4|e>>>2)),h},h=r.btoa,f=r.atob;h?(t=function(r){for(var t="",o=0;o<r.length;o++){var e=r.charCodeAt(o);e<128?t+=String.fromCharCode(e):e<2048?t+=String.fromCharCode(192|e>>6)+String.fromCharCode(128|63&e):e<55296||e>=57344?t+=String.fromCharCode(224|e>>12)+String.fromCharCode(128|e>>6&63)+String.fromCharCode(128|63&e):(e=65536+((1023&e)<<10|1023&r.charCodeAt(++o)),t+=String.fromCharCode(240|e>>18)+String.fromCharCode(128|e>>12&63)+String.fromCharCode(128|e>>6&63)+String.fromCharCode(128|63&e))}return h(t)},o=function(r){var t=f(r.trim("=").replace(/-/g,"+").replace(/_/g,"/"));if(!/[^\x00-\x7F]/.test(t))return t;for(var o,e,n="",a=0,h=t.length,i=0;a<h;)if((o=t.charCodeAt(a++))<=127)n+=String.fromCharCode(o);else{if(o>191&&o<=223)e=31&o,i=1;else if(o<=239)e=15&o,i=2;else{if(!(o<=247))throw"not a UTF-8 string";e=7&o,i=3}for(var C=0;C<i;++C){if((o=t.charCodeAt(a++))<128||o>191)throw"not a UTF-8 string";e<<=6,e+=63&o}if(e>=55296&&e<=57343)throw"not a UTF-8 string";if(e>1114111)throw"not a UTF-8 string";e<=65535?n+=String.fromCharCode(e):(e-=65536,n+=String.fromCharCode(55296+(e>>10)),n+=String.fromCharCode(56320+(1023&e)))}return n}):(h=function(r){for(var t,o,n,a="",h=r.length,f=0,i=3*parseInt(h/3);f<i;)t=r.charCodeAt(f++),o=r.charCodeAt(f++),n=r.charCodeAt(f++),a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[63&(o<<2|n>>>6)]+e[63&n];var C=h-i;return 1===C?(t=r.charCodeAt(f),a+=e[t>>>2]+e[t<<4&63]+"=="):2===C&&(t=r.charCodeAt(f++),o=r.charCodeAt(f),a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[o<<2&63]+"="),a},t=function(r){for(var t,o,n,a="",h=function(r){for(var t=[],o=0;o<r.length;o++){var e=r.charCodeAt(o);e<128?t[t.length]=e:e<2048?(t[t.length]=192|e>>6,t[t.length]=128|63&e):e<55296||e>=57344?(t[t.length]=224|e>>12,t[t.length]=128|e>>6&63,t[t.length]=128|63&e):(e=65536+((1023&e)<<10|1023&r.charCodeAt(++o)),t[t.length]=240|e>>18,t[t.length]=128|e>>12&63,t[t.length]=128|e>>6&63,t[t.length]=128|63&e)}return t}(r),f=h.length,i=0,C=3*parseInt(f/3);i<C;)t=h[i++],o=h[i++],n=h[i++],a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[63&(o<<2|n>>>6)]+e[63&n];var c=f-C;return 1===c?(t=h[i],a+=e[t>>>2]+e[t<<4&63]+"=="):2===c&&(t=h[i++],o=h[i],a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[o<<2&63]+"="),a},f=function(r){var t,o,e,a,h="",f=r.length;"="===r.charAt(f-2)?f-=2:"="===r.charAt(f-1)&&(f-=1);for(var i=0,C=f>>2<<2;i<C;)t=n[r.charAt(i++)],o=n[r.charAt(i++)],e=n[r.charAt(i++)],a=n[r.charAt(i++)],h+=String.fromCharCode(255&(t<<2|o>>>4))+String.fromCharCode(255&(o<<4|e>>>2))+String.fromCharCode(255&(e<<6|a));var c=f-C;return 2===c?(t=n[r.charAt(i++)],o=n[r.charAt(i++)],h+=String.fromCharCode(255&(t<<2|o>>>4))):3===c&&(t=n[r.charAt(i++)],o=n[r.charAt(i++)],e=n[r.charAt(i++)],h+=String.fromCharCode(255&(t<<2|o>>>4))+String.fromCharCode(255&(o<<4|e>>>2))),h},o=function(r){for(var t,o,e="",n=a(r),h=n.length,f=0,i=0;f<h;)if((t=n[f++])<=127)e+=String.fromCharCode(t);else{if(t>191&&t<=223)o=31&t,i=1;else if(t<=239)o=15&t,i=2;else{if(!(t<=247))throw"not a UTF-8 string";o=7&t,i=3}for(var C=0;C<i;++C){if((t=n[f++])<128||t>191)throw"not a UTF-8 string";o<<=6,o+=63&t}if(o>=55296&&o<=57343)throw"not a UTF-8 string";if(o>1114111)throw"not a UTF-8 string";o<=65535?e+=String.fromCharCode(o):(o-=65536,e+=String.fromCharCode(55296+(o>>10)),e+=String.fromCharCode(56320+(1023&o)))}return e});var i=function(r,t){return t?f(r):o(r)},C={encode:function(o,n){var a="string"!=typeof o;return a&&o.constructor===r.ArrayBuffer&&(o=new Uint8Array(o)),a?function(r){for(var t,o,n,a="",h=r.length,f=0,i=3*parseInt(h/3);f<i;)t=r[f++],o=r[f++],n=r[f++],a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[63&(o<<2|n>>>6)]+e[63&n];var C=h-i;return 1===C?(t=r[f],a+=e[t>>>2]+e[t<<4&63]+"=="):2===C&&(t=r[f++],o=r[f],a+=e[t>>>2]+e[63&(t<<4|o>>>4)]+e[o<<2&63]+"="),a}(o):!n&&/[^\x00-\x7F]/.test(o)?t(o):h(o)},decode:i,atob:f,btoa:h};i.bytes=a,i.string=i,r.pagelayer_Base64=C}();

/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.8
 *
 */
(function(e){e.fn.extend({slimScroll:function(f){var a=e.extend({width:"auto",height:"250px",size:"7px",color:"#000",position:"right",distance:"1px",start:"top",opacity:.4,alwaysVisible:!1,disableFadeOut:!1,railVisible:!1,railColor:"#333",railOpacity:.2,railDraggable:!0,railClass:"slimScrollRail",barClass:"slimScrollBar",wrapperClass:"slimScrollDiv",allowPageScroll:!1,wheelStep:20,touchScrollStep:200,borderRadius:"7px",railBorderRadius:"7px"},f);this.each(function(){function v(d){if(r){d=d||window.event;
var c=0;d.wheelDelta&&(c=-d.wheelDelta/120);d.detail&&(c=d.detail/3);e(d.target||d.srcTarget||d.srcElement).closest("."+a.wrapperClass).is(b.parent())&&n(c,!0);d.preventDefault&&!k&&d.preventDefault();k||(d.returnValue=!1)}}function n(d,g,e){k=!1;var f=b.outerHeight()-c.outerHeight();g&&(g=parseInt(c.css("top"))+d*parseInt(a.wheelStep)/100*c.outerHeight(),g=Math.min(Math.max(g,0),f),g=0<d?Math.ceil(g):Math.floor(g),c.css({top:g+"px"}));l=parseInt(c.css("top"))/(b.outerHeight()-c.outerHeight());g=
l*(b[0].scrollHeight-b.outerHeight());e&&(g=d,d=g/b[0].scrollHeight*b.outerHeight(),d=Math.min(Math.max(d,0),f),c.css({top:d+"px"}));b.scrollTop(g);b.trigger("slimscrolling",~~g);w();p()}function x(){u=Math.max(b.outerHeight()/b[0].scrollHeight*b.outerHeight(),30);c.css({height:u+"px"});var a=u==b.outerHeight()?"none":"block";c.css({display:a})}function w(){x();clearTimeout(B);l==~~l?(k=a.allowPageScroll,C!=l&&b.trigger("slimscroll",0==~~l?"top":"bottom")):k=!1;C=l;u>=b.outerHeight()?k=!0:(c.stop(!0,
!0).fadeIn("fast"),a.railVisible&&m.stop(!0,!0).fadeIn("fast"))}function p(){a.alwaysVisible||(B=setTimeout(function(){a.disableFadeOut&&r||y||z||(c.fadeOut("slow"),m.fadeOut("slow"))},1E3))}var r,y,z,B,A,u,l,C,k=!1,b=e(this);if(b.parent().hasClass(a.wrapperClass)){var q=b.scrollTop(),c=b.siblings("."+a.barClass),m=b.siblings("."+a.railClass);x();if(e.isPlainObject(f)){if("height"in f&&"auto"==f.height){b.parent().css("height","auto");b.css("height","auto");var h=b.parent().parent().height();b.parent().css("height",
h);b.css("height",h)}else"height"in f&&(h=f.height,b.parent().css("height",h),b.css("height",h));if("scrollTo"in f)q=parseInt(a.scrollTo);else if("scrollBy"in f)q+=parseInt(a.scrollBy);else if("destroy"in f){c.remove();m.remove();b.unwrap();return}n(q,!1,!0)}}else if(!(e.isPlainObject(f)&&"destroy"in f)){a.height="auto"==a.height?b.parent().height():a.height;q=e("<div></div>").addClass(a.wrapperClass).css({position:"relative",overflow:"hidden",width:a.width,height:a.height});b.css({overflow:"hidden",
width:a.width,height:a.height});var m=e("<div></div>").addClass(a.railClass).css({width:a.size,height:"100%",position:"absolute",top:0,display:a.alwaysVisible&&a.railVisible?"block":"none","border-radius":a.railBorderRadius,background:a.railColor,opacity:a.railOpacity,zIndex:90}),c=e("<div></div>").addClass(a.barClass).css({background:a.color,width:a.size,position:"absolute",top:0,opacity:a.opacity,display:a.alwaysVisible?"block":"none","border-radius":a.borderRadius,BorderRadius:a.borderRadius,MozBorderRadius:a.borderRadius,
WebkitBorderRadius:a.borderRadius,zIndex:99}),h="right"==a.position?{right:a.distance}:{left:a.distance};m.css(h);c.css(h);b.wrap(q);b.parent().append(c);b.parent().append(m);a.railDraggable&&c.bind("mousedown",function(a){var b=c.parent();z=!0;t=parseFloat(c.css("top"));pageY=a.pageY;b.bind("mousemove.slimscroll",function(a){currTop=t+a.pageY-pageY;c.css("top",currTop);n(0,c.position().top,!1)});b.bind("mouseup.slimscroll",function(a){z=!1;p();b.unbind(".slimscroll")});return!1}).bind("selectstart.slimscroll",
function(a){a.stopPropagation();a.preventDefault();return!1});m.hover(function(){w()},function(){p()});c.hover(function(){y=!0},function(){y=!1});b.hover(function(){r=!0;w();p()},function(){r=!1;p()});b.bind("touchstart",function(a,b){a.originalEvent.touches.length&&(A=a.originalEvent.touches[0].pageY)});b.bind("touchmove",function(b){k||b.originalEvent.preventDefault();b.originalEvent.touches.length&&(n((A-b.originalEvent.touches[0].pageY)/a.touchScrollStep,!0),A=b.originalEvent.touches[0].pageY)});
x();"bottom"===a.start?(c.css({top:b.outerHeight()-c.outerHeight()}),n(0,!0)):"top"!==a.start&&(n(e(a.start).position().top,null,!0),a.alwaysVisible||c.hide());window.addEventListener?(this.addEventListener("DOMMouseScroll",v,!1),this.addEventListener("mousewheel",v,!1)):document.attachEvent("onmousewheel",v)}});return this}});e.fn.extend({slimscroll:e.fn.slimScroll})})(jQuery);


/*!
 * vanilla-picker v2.7.2 (MODIFIED by Pagelayer)
 * https://vanilla-picker.js.org
 *
 * Copyright 2017-2019 Andreas Borgen (https://github.com/Sphinxxxx), Adam Brooks (https://github.com/dissimulate)
 * Released under the ISC license.
 */

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.pagelayer_Picker=t()}(this,function(){"use strict";var n=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")},e=function(){function i(e,t){for(var r=0;r<t.length;r++){var i=t[r];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,r){return t&&i(e.prototype,t),r&&i(e,r),e}}(),g=function(e,t){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return function(e,t){var r=[],i=!0,o=!1,n=void 0;try{for(var a,s=e[Symbol.iterator]();!(i=(a=s.next()).done)&&(r.push(a.value),!t||r.length!==t);i=!0);}catch(e){o=!0,n=e}finally{try{!i&&s.return&&s.return()}finally{if(o)throw n}}return r}(e,t);throw new TypeError("Invalid attempt to destructure non-iterable instance")};String.prototype.startsWith=String.prototype.startsWith||function(e){return 0===this.indexOf(e)},String.prototype.padStart=String.prototype.padStart||function(e,t){for(var r=this;r.length<e;)r=t+r;return r};var r={aliceblue:"#f0f8ff",antiquewhite:"#faebd7",aqua:"#00ffff",aquamarine:"#7fffd4",azure:"#f0ffff",beige:"#f5f5dc",bisque:"#ffe4c4",black:"#000000",blanchedalmond:"#ffebcd",blue:"#0000ff",blueviolet:"#8a2be2",brown:"#a52a2a",burlywood:"#deb887",cadetblue:"#5f9ea0",chartreuse:"#7fff00",chocolate:"#d2691e",coral:"#ff7f50",cornflowerblue:"#6495ed",cornsilk:"#fff8dc",crimson:"#dc143c",cyan:"#00ffff",darkblue:"#00008b",darkcyan:"#008b8b",darkgoldenrod:"#b8860b",darkgray:"#a9a9a9",darkgreen:"#006400",darkgrey:"#a9a9a9",darkkhaki:"#bdb76b",darkmagenta:"#8b008b",darkolivegreen:"#556b2f",darkorange:"#ff8c00",darkorchid:"#9932cc",darkred:"#8b0000",darksalmon:"#e9967a",darkseagreen:"#8fbc8f",darkslateblue:"#483d8b",darkslategray:"#2f4f4f",darkslategrey:"#2f4f4f",darkturquoise:"#00ced1",darkviolet:"#9400d3",deeppink:"#ff1493",deepskyblue:"#00bfff",dimgray:"#696969",dimgrey:"#696969",dodgerblue:"#1e90ff",firebrick:"#b22222",floralwhite:"#fffaf0",forestgreen:"#228b22",fuchsia:"#ff00ff",gainsboro:"#dcdcdc",ghostwhite:"#f8f8ff",gold:"#ffd700",goldenrod:"#daa520",gray:"#808080",green:"#008000",greenyellow:"#adff2f",grey:"#808080",honeydew:"#f0fff0",hotpink:"#ff69b4",indianred:"#cd5c5c",indigo:"#4b0082",ivory:"#fffff0",khaki:"#f0e68c",lavender:"#e6e6fa",lavenderblush:"#fff0f5",lawngreen:"#7cfc00",lemonchiffon:"#fffacd",lightblue:"#add8e6",lightcoral:"#f08080",lightcyan:"#e0ffff",lightgoldenrodyellow:"#fafad2",lightgray:"#d3d3d3",lightgreen:"#90ee90",lightgrey:"#d3d3d3",lightpink:"#ffb6c1",lightsalmon:"#ffa07a",lightseagreen:"#20b2aa",lightskyblue:"#87cefa",lightslategray:"#778899",lightslategrey:"#778899",lightsteelblue:"#b0c4de",lightyellow:"#ffffe0",lime:"#00ff00",limegreen:"#32cd32",linen:"#faf0e6",magenta:"#ff00ff",maroon:"#800000",mediumaquamarine:"#66cdaa",mediumblue:"#0000cd",mediumorchid:"#ba55d3",mediumpurple:"#9370db",mediumseagreen:"#3cb371",mediumslateblue:"#7b68ee",mediumspringgreen:"#00fa9a",mediumturquoise:"#48d1cc",mediumvioletred:"#c71585",midnightblue:"#191970",mintcream:"#f5fffa",mistyrose:"#ffe4e1",moccasin:"#ffe4b5",navajowhite:"#ffdead",navy:"#000080",oldlace:"#fdf5e6",olive:"#808000",olivedrab:"#6b8e23",orange:"#ffa500",orangered:"#ff4500",orchid:"#da70d6",palegoldenrod:"#eee8aa",palegreen:"#98fb98",paleturquoise:"#afeeee",palevioletred:"#db7093",papayawhip:"#ffefd5",peachpuff:"#ffdab9",peru:"#cd853f",pink:"#ffc0cb",plum:"#dda0dd",powderblue:"#b0e0e6",purple:"#800080",rebeccapurple:"#663399",red:"#ff0000",rosybrown:"#bc8f8f",royalblue:"#4169e1",saddlebrown:"#8b4513",salmon:"#fa8072",sandybrown:"#f4a460",seagreen:"#2e8b57",seashell:"#fff5ee",sienna:"#a0522d",silver:"#c0c0c0",skyblue:"#87ceeb",slateblue:"#6a5acd",slategray:"#708090",slategrey:"#708090",snow:"#fffafa",springgreen:"#00ff7f",steelblue:"#4682b4",tan:"#d2b48c",teal:"#008080",thistle:"#d8bfd8",tomato:"#ff6347",turquoise:"#40e0d0",violet:"#ee82ee",wheat:"#f5deb3",white:"#ffffff",whitesmoke:"#f5f5f5",yellow:"#ffff00",yellowgreen:"#9acd32"};function o(e){var t=1<arguments.length&&void 0!==arguments[1]?arguments[1]:1;return(0<t?e.toFixed(t).replace(/0+$/,"").replace(/\.$/,""):e.toString())||"0"}var a=function(){function h(e,t,r,i){n(this,h);var d=this;if(void 0===e);else if(Array.isArray(e))this.rgba=e;else if(void 0===r){var o=e&&""+e;o&&function(e){if(e.startsWith("hsl")){var t=e.match(/([\-\d\.e]+)/g).map(Number),r=g(t,4),i=r[0],o=r[1],n=r[2],a=r[3];void 0===a&&(a=1),i/=360,o/=100,n/=100,d.hsla=[i,o,n,a]}else if(e.startsWith("rgb")){var s=e.match(/([\-\d\.e]+)/g).map(Number),l=g(s,4),p=l[0],c=l[1],f=l[2],u=l[3];void 0===u&&(u=1),d.rgba=[p,c,f,u]}else e.startsWith("#")?d.rgba=h.hexToRgb(e):d.rgba=h.nameToRgb(e)||h.hexToRgb(e)}(o.toLowerCase())}else this.rgba=[e,t,r,void 0===i?1:i]}return e(h,[{key:"printRGB",value:function(e){var t=(e?this.rgba:this.rgba.slice(0,3)).map(function(e,t){return o(e,3===t?3:0)});return e?"rgba("+t+")":"rgb("+t+")"}},{key:"printHSL",value:function(e){var r=[360,100,100,1],i=["","%","%",""],t=(e?this.hsla:this.hsla.slice(0,3)).map(function(e,t){return o(e*r[t],3===t?3:1)+i[t]});return e?"hsla("+t+")":"hsl("+t+")"}},{key:"printHex",value:function(e){var t=this.hex;return e?t:t.substring(0,7)}},{key:"rgba",get:function(){if(this._rgba)return this._rgba;if(!this._hsla)throw new Error("No color is set");return this._rgba=h.hslToRgb(this._hsla)},set:function(e){3===e.length&&(e[3]=1),this._rgba=e,this._hsla=null}},{key:"rgbString",get:function(){return this.printRGB()}},{key:"rgbaString",get:function(){return this.printRGB(!0)}},{key:"hsla",get:function(){if(this._hsla)return this._hsla;if(!this._rgba)throw new Error("No color is set");return this._hsla=h.rgbToHsl(this._rgba)},set:function(e){3===e.length&&(e[3]=1),this._hsla=e,this._rgba=null}},{key:"hslString",get:function(){return this.printHSL()}},{key:"hslaString",get:function(){return this.printHSL(!0)}},{key:"hex",get:function(){return"#"+this.rgba.map(function(e,t){return t<3?e.toString(16):Math.round(255*e).toString(16)}).map(function(e){return e.padStart(2,"0")}).join("")},set:function(e){this.rgba=h.hexToRgb(e)}}],[{key:"hexToRgb",value:function(e){var t=(e.startsWith("#")?e.slice(1):e).replace(/^(\w{3})$/,"$1F").replace(/^(\w)(\w)(\w)(\w)$/,"$1$1$2$2$3$3$4$4").replace(/^(\w{6})$/,"$1FF");if(!t.match(/^([0-9a-fA-F]{8})$/))throw new Error("Unknown hex color; "+e);var r=t.match(/^(\w\w)(\w\w)(\w\w)(\w\w)$/).slice(1).map(function(e){return parseInt(e,16)});return r[3]=r[3]/255,r}},{key:"nameToRgb",value:function(e){var t=r[e];if(t)return h.hexToRgb(t)}},{key:"rgbToHsl",value:function(e){var t=g(e,4),r=t[0],i=t[1],o=t[2],n=t[3];r/=255,i/=255,o/=255;var a=Math.max(r,i,o),s=Math.min(r,i,o),l=void 0,p=void 0,c=(a+s)/2;if(a===s)l=p=0;else{var f=a-s;switch(p=.5<c?f/(2-a-s):f/(a+s),a){case r:l=(i-o)/f+(i<o?6:0);break;case i:l=(o-r)/f+2;break;case o:l=(r-i)/f+4}l/=6}return[l,p,c,n]}},{key:"hslToRgb",value:function(e){var t=g(e,4),r=t[0],i=t[1],o=t[2],n=t[3],a=void 0,s=void 0,l=void 0;if(0===i)a=s=l=o;else{var p=function(e,t,r){return r<0&&(r+=1),1<r&&(r-=1),r<1/6?e+6*(t-e)*r:r<.5?t:r<2/3?e+(t-e)*(2/3-r)*6:e},c=o<.5?o*(1+i):o+i-o*i,f=2*o-c;a=p(f,c,r+1/3),s=p(f,c,r),l=p(f,c,r-1/3)}var u=[255*a,255*s,255*l].map(Math.round);return u[3]=n,u}}]),h}();window;function s(e){var t=Element.prototype;t.matches||(t.matches=t.msMatchesSelector||t.webkitMatchesSelector),t.closest||(t.closest=function(e){var t=this;do{if(t.matches(e))return t;t="svg"===t.tagName?t.parentNode:t.parentElement}while(t);return null});var l=(e=e||{}).container||e.doc.documentElement,o=e.selector,i=e.callback||console.log,n=e.callbackDragStart,a=e.callbackDragEnd,s=e.callbackClick,r=e.propagateEvents,p=!1!==e.roundCoords,c=!1!==e.dragOutside,f=e.handleOffset||!1!==e.handleOffset,u=null;switch(f){case"center":u=!0;break;case"topleft":case"top-left":u=!1}var d=void 0;function h(e,t,r,i){var o=e.clientX,n=e.clientY;function a(e,t,r){return Math.max(t,Math.min(e,r))}if(t){var s=t.getBoundingClientRect();if(o-=s.left,n-=s.top,r&&(o-=r[0],n-=r[1]),i&&(o=a(o,0,s.width),n=a(n,0,s.height)),t!==l)(null!==u?u:"circle"===t.nodeName||"ellipse"===t.nodeName)&&(o-=s.width/2,n-=s.height/2)}return p?[Math.round(o),Math.round(n)]:[o,n]}function g(e){e.preventDefault(),r||e.stopPropagation()}function b(e){var t=void 0;if(t=o?o instanceof Element?o.contains(e.target)?o:null:e.target.closest(o):{}){g(e);var r=o&&f?h(e,t):[0,0],i=h(e,l,r);d={target:t,mouseOffset:r,startPos:i,actuallyDragged:!1},n&&n(t,i)}}function m(e){if(d){g(e);var t=d.startPos,r=h(e,l,d.mouseOffset,!c);d.actuallyDragged=d.actuallyDragged||t[0]!==r[0]||t[1]!==r[1],i(d.target,r,t)}}function k(e,t){if(d){if(a||s){var r=!d.actuallyDragged,i=r?d.startPos:h(e,l,d.mouseOffset,!c);s&&r&&!t&&s(d.target,i),a&&a(d.target,i,d.startPos,t||r&&s)}d=null}}function v(e,t){k(x(e),t)}function w(e,t,r){e.addEventListener(t,r)}function _(e){return void 0!==e.buttons?1===e.buttons:1===e.which}function y(e,t){1===e.touches.length?t(x(e)):k(e,!0)}function x(e){var t=e.targetTouches[0];return t||(t=e.changedTouches[0]),t.preventDefault=e.preventDefault.bind(e),t.stopPropagation=e.stopPropagation.bind(e),t}w(l,"mousedown",function(e){_(e)?b(e):k(e,!0)}),w(l,"touchstart",function(e){return y(e,b)}),w(l,"mousemove",function(e){d&&(_(e)?m(e):k(e))}),w(l,"touchmove",function(e){return y(e,m)}),w(l,"mouseup",function(e){d&&!_(e)&&k(e)}),w(l,"touchend",function(e){return v(e)}),w(l,"touchcancel",function(e){return v(e,!0)})}var l="keydown",p="mousedown",c="focusin";function w(e,t){return(t||document).querySelector(e)}function f(e,t,r){e.addEventListener(t,r,!1)}function u(e){e.preventDefault(),e.stopPropagation()}function d(e,t,r,i){f(e,l,function(e){0<=t.indexOf(e.key)&&(i&&u(e),r(e))})}return function(){function r(e){var t=this;n(this,r),this.settings={popup:"right",layout:"default",alpha:!0,editor:!0,editorFormat:"hex"},this._openProxy=function(e){return t.openHandler(e)},this.onChange=null,this.onDone=null,this.onOpen=null,this.onClose=null,function(e){if(!e.querySelector("#vanilla-picker-style")){var t=document.createElement("style");t.id="vanilla-picker-style",e.documentElement.firstElementChild.appendChild(t).textContent=".picker_wrapper.no_alpha .picker_alpha{display:none}.picker_wrapper.no_editor .picker_editor{position:absolute;z-index:-1;opacity:0}.layout_default.picker_wrapper{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:stretch;-ms-flex-align:stretch;align-items:stretch;font-size:10px;width:25em;padding:.5em}.layout_default.picker_wrapper input,.layout_default.picker_wrapper button{font-size:1rem}.layout_default.picker_wrapper>*{margin:.5em}.layout_default.picker_wrapper::before{content:'';display:block;width:100%;height:0;-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.layout_default .picker_slider,.layout_default .picker_selector{padding:1em}.layout_default .picker_hue{width:100%}.layout_default .picker_sl{-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto}.layout_default .picker_sl::before{content:'';display:block;padding-bottom:100%}.layout_default .picker_editor{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1;width:6rem}.layout_default .picker_editor input{width:calc(100% + 2px);height:calc(100% + 2px)}.layout_default .picker_sample{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1;-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto}.layout_default .picker_done{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.picker_wrapper{-webkit-box-sizing:border-box;box-sizing:border-box;background:#f2f2f2;-webkit-box-shadow:0 0 0 1px silver;box-shadow:0 0 0 1px silver;cursor:default;font-family:sans-serif;color:#444;pointer-events:auto}.picker_wrapper:focus{outline:none}.picker_wrapper button,.picker_wrapper input{margin:-1px}.picker_selector{position:absolute;z-index:1;display:block;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%);border:2px solid white;border-radius:100%;-webkit-box-shadow:0 0 3px 1px #67b9ff;box-shadow:0 0 3px 1px #67b9ff;background:currentColor;cursor:pointer}.picker_slider .picker_selector{border-radius:2px}.picker_hue{position:relative;background-image:-webkit-gradient(linear, left top, right top, from(red), color-stop(yellow), color-stop(lime), color-stop(cyan), color-stop(blue), color-stop(magenta), to(red));background-image:linear-gradient(90deg, red, yellow, lime, cyan, blue, magenta, red);-webkit-box-shadow:0 0 0 1px silver;box-shadow:0 0 0 1px silver}.picker_sl{position:relative;-webkit-box-shadow:0 0 0 1px silver;box-shadow:0 0 0 1px silver;background-image:-webkit-gradient(linear, left top, left bottom, from(white), color-stop(50%, rgba(255,255,255,0))),-webkit-gradient(linear, left bottom, left top, from(black), color-stop(50%, rgba(0,0,0,0))),-webkit-gradient(linear, left top, right top, from(gray), to(rgba(128,128,128,0)));background-image:linear-gradient(180deg, white, rgba(255,255,255,0) 50%),linear-gradient(0deg, black, rgba(0,0,0,0) 50%),linear-gradient(90deg, gray, rgba(128,128,128,0))}.picker_alpha,.picker_sample{position:relative;background:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='2' height='2'%3E%3Cpath d='M1,0H0V1H2V2H1' fill='lightgrey'/%3E%3C/svg%3E\") left top/contain white;-webkit-box-shadow:0 0 0 1px silver;box-shadow:0 0 0 1px silver}.picker_alpha .picker_selector,.picker_sample .picker_selector{background:none}.picker_editor input{-webkit-box-sizing:border-box;box-sizing:border-box;font-family:monospace;padding:.1em .2em}.picker_sample::before{content:'';position:absolute;display:block;width:100%;height:100%;background:currentColor}.picker_done button{-webkit-box-sizing:border-box;box-sizing:border-box;padding:.2em .5em;cursor:pointer}.picker_arrow{position:absolute;z-index:-1}.picker_wrapper.popup{position:absolute;z-index:2;margin:1.5em}.picker_wrapper.popup,.picker_wrapper.popup .picker_arrow::before,.picker_wrapper.popup .picker_arrow::after{background:#f2f2f2;-webkit-box-shadow:0 0 10px 1px rgba(0,0,0,0.4);box-shadow:0 0 10px 1px rgba(0,0,0,0.4)}.picker_wrapper.popup .picker_arrow{width:3em;height:3em;margin:0}.picker_wrapper.popup .picker_arrow::before,.picker_wrapper.popup .picker_arrow::after{content:\"\";display:block;position:absolute;top:0;left:0;z-index:-99}.picker_wrapper.popup .picker_arrow::before{width:100%;height:100%;-webkit-transform:skew(45deg);transform:skew(45deg);-webkit-transform-origin:0 100%;transform-origin:0 100%}.picker_wrapper.popup .picker_arrow::after{width:150%;height:150%;-webkit-box-shadow:none;box-shadow:none}.popup.popup_top{bottom:100%;left:0}.popup.popup_top .picker_arrow{bottom:0;left:0;-webkit-transform:rotate(-90deg);transform:rotate(-90deg)}.popup.popup_bottom{top:100%;left:0}.popup.popup_bottom .picker_arrow{top:0;left:0;-webkit-transform:rotate(90deg) scale(1, -1);transform:rotate(90deg) scale(1, -1)}.popup.popup_left{top:0;right:100%}.popup.popup_left .picker_arrow{top:0;right:0;-webkit-transform:scale(-1, 1);transform:scale(-1, 1)}.popup.popup_right{top:0;left:100%}.popup.popup_right .picker_arrow{top:0;left:0}"}}(e.doc),this.setOptions(e)}return e(r,[{key:"setOptions",value:function(e){if(e){var t=this.settings;if(e instanceof HTMLElement)t.parent=e;else{t.parent&&e.parent&&t.parent!==e.parent&&(t.parent.removeEventListener("click",this._openProxy,!1),this._popupInited=!1),function(e,t,r){for(var i in e)r&&0<=r.indexOf(i)||(t[i]=e[i])}(e,t),e.onChange&&(this.onChange=e.onChange),e.onDone&&(this.onDone=e.onDone),e.onOpen&&(this.onOpen=e.onOpen),e.onClose&&(this.onClose=e.onClose);var r=e.color||e.colour;r&&this._setColor(r)}var i=t.parent;i&&t.popup&&!this._popupInited?(f(i,"click",this._openProxy),d(i,[" ","Spacebar","Enter"],this._openProxy),this._popupInited=!0):e.parent&&!t.popup&&this.show()}}},{key:"openHandler",value:function(e){if(this.show()){e&&e.preventDefault(),this.settings.parent.style.pointerEvents="none";var t=e&&e.type===l?this._domEdit:this.domElement;setTimeout(function(){return t.focus()},100),this.onOpen&&this.onOpen(this.colour)}}},{key:"closeHandler",value:function(e){var t=e&&e.type,r=!1;e?t===p||t===c?this.domElement.contains(e.target)||(r=!0):(u(e),r=!0):r=!0,r&&this.hide()&&(this.settings.parent.style.pointerEvents="",t!==p&&this.settings.parent.focus(),this.onClose&&this.onClose(this.colour))}},{key:"movePopup",value:function(e,t){this.closeHandler(),this.setOptions(e),t&&this.openHandler()}},{key:"setColor",value:function(e,t){this._setColor(e,{silent:t})}},{key:"_setColor",value:function(e,t){if("string"==typeof e&&(e=e.trim()),e){t=t||{};var r=void 0;try{r=new a(e)}catch(e){if(t.failSilently)return;throw e}if(!this.settings.alpha){var i=r.hsla;i[3]=1,r.hsla=i}this.colour=this.color=r,this._setHSLA(null,null,null,null,t)}}},{key:"setColour",value:function(e,t){this.setColor(e,t)}},{key:"show",value:function(){if(!this.settings.parent)return!1;if(this.domElement){var e=this._toggleDOM(!0);return this._setPosition(),e}var t,r,i,o=this.settings.template||'<div class="picker_wrapper" tabindex="-1"><div class="picker_arrow"></div><div class="picker_hue picker_slider"><div class="picker_selector"></div></div><div class="picker_sl"><div class="picker_selector"></div></div><div class="picker_alpha picker_slider"><div class="picker_selector"></div></div><div class="picker_editor"><input aria-label="Type a color name or hex value"/></div><div class="picker_sample"></div><div class="picker_done"><button>Ok</button></div></div>',n=(t=o,r=this.settings.doc,(i=r.createElement("div")).innerHTML=t,i.firstElementChild);return this.domElement=n,this._domH=w(".picker_hue",n),this._domSL=w(".picker_sl",n),this._domA=w(".picker_alpha",n),this._domEdit=w(".picker_editor input",n),this._domSample=w(".picker_sample",n),this._domOkay=w(".picker_done button",n),n.classList.add("layout_"+this.settings.layout),this.settings.alpha||n.classList.add("no_alpha"),this.settings.editor||n.classList.add("no_editor"),this._ifPopup(function(){return n.classList.add("popup")}),this._setPosition(),this.colour?this._updateUI():this._setColor("#0cf"),this._bindEvents(),!0}},{key:"hide",value:function(){return this._toggleDOM(!1)}},{key:"_bindEvents",value:function(){var t=this,r=this,e=this.domElement;function i(o,n){function e(e,t){var r=t[0]/o.clientWidth,i=t[1]/o.clientHeight;n(r,i)}return{container:o,dragOutside:!1,callback:e,callbackDragStart:e,propagateEvents:!0}}f(e,"click",function(e){return e.preventDefault()}),s(i(this._domH,function(e,t){return r._setHSLA(e)})),s(i(this._domSL,function(e,t){return r._setHSLA(null,e,1-t)})),this.settings.alpha&&s(i(this._domA,function(e,t){return r._setHSLA(null,null,null,1-t)}));var o=this._domEdit;f(o,"input",function(e){r._setColor(this.value,{fromEditor:!0,failSilently:!0})}),f(o,"focus",function(e){this.selectionStart===this.selectionEnd&&this.select()});var n=function(e){t._ifPopup(function(){return t.closeHandler(e)})},a=function(e){t._ifPopup(function(){return t.closeHandler(e)}),t.onDone&&t.onDone(t.colour)};f(this.settings.doc,p,n),f(this.settings.doc,c,n),d(e,["Esc","Escape"],n),f(this._domOkay,"click",a),d(e,["Enter"],a)}},{key:"_setPosition",value:function(){var r=this.settings.parent,i=this.domElement;r!==i.parentNode&&r.appendChild(i),this._ifPopup(function(e){"static"===getComputedStyle(r).position&&(r.style.position="relative");var t=!0===e?"popup_right":"popup_"+e;["popup_top","popup_bottom","popup_left","popup_right"].forEach(function(e){e===t?i.classList.add(e):i.classList.remove(e)}),i.classList.add(t)})}},{key:"_setHSLA",value:function(e,t,r,i,o){o=o||{};var n=this.colour,a=n.hsla;[e,t,r,i].forEach(function(e,t){(e||0===e)&&(a[t]=e)}),n.hsla=a,this._updateUI(o),this.onChange&&!o.silent&&this.onChange(n)}},{key:"_updateUI",value:function(e){if(this.domElement){e=e||{};var t=this.colour,r=t.hsla,i="hsl("+360*r[0]+", 100%, 50%)",o=t.hslString,n=t.hslaString,a=this._domH,s=this._domSL,l=this._domA,p=w(".picker_selector",a),c=w(".picker_selector",s),f=w(".picker_selector",l);k(0,p,r[0]),this._domSL.style.backgroundColor=this._domH.style.color=i,k(0,c,r[1]),v(0,c,1-r[2]),s.style.color=o,v(0,f,1-r[3]);var u=o,d=u.replace("hsl","hsla").replace(")",", 0)"),h="linear-gradient("+[u,d]+")";if(this._domA.style.backgroundImage=h+", url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='2' height='2'%3E%3Cpath d='M1,0H0V1H2V2H1' fill='lightgrey'/%3E%3C/svg%3E\")",!e.fromEditor){var g=this.settings.editorFormat,b=this.settings.alpha,m=void 0;switch(g){case"rgb":m=t.printRGB(b);break;case"hsl":m=t.printHSL(b);break;default:m=t.printHex(b)}this._domEdit.value=m}this._domSample.style.color=n}function k(e,t,r){t.style.left=100*r+"%"}function v(e,t,r){t.style.top=100*r+"%"}}},{key:"_ifPopup",value:function(e,t){this.settings.parent&&this.settings.popup?e&&e(this.settings.popup):t&&t()}},{key:"_toggleDOM",value:function(e){var t=this.domElement;if(!t)return!1;var r=e?"":"none",i=t.style.display!==r;return i&&(t.style.display=r),i}}]),r}()});

function pagelayer_tlite(getTooltipOpts) {
  document.addEventListener('mouseover', function (e) {
    var el = e.target;
    var opts = getTooltipOpts(el);

    if (!opts) {
      el = el.parentElement;
      opts = el && getTooltipOpts(el);
    }

    opts && pagelayer_tlite.show(el, opts, true);
  });
}

pagelayer_tlite.show = function (el, opts, isAuto) {
  var fallbackAttrib = 'data-tlite';
  opts = opts || {};

  (el.tooltip || Tooltip(el, opts)).show();

  function Tooltip(el, opts) {
    var tooltipEl;
    var showTimer;
    var text;

    el.addEventListener('mousedown', autoHide);
    el.addEventListener('mouseleave', autoHide);

    function show() {
      text = el.title || el.getAttribute(fallbackAttrib) || text;
      el.title = '';
      el.setAttribute(fallbackAttrib, '');
      text && !showTimer && (showTimer = setTimeout(fadeIn, isAuto ? 150 : 1))
    }

    function autoHide() {
      pagelayer_tlite.hide(el, true);
    }

    function hide(isAutoHiding) {
      if (isAuto === isAutoHiding) {
        showTimer = clearTimeout(showTimer);
        var parent = tooltipEl && tooltipEl.parentNode;
        parent && parent.removeChild(tooltipEl);
        tooltipEl = undefined;
      }
    }

    function fadeIn() {
      if (!tooltipEl) {
        tooltipEl = createTooltip(el, text, opts);
      }
    }

    return el.tooltip = {
      show: show,
      hide: hide
    };
  }

  function createTooltip(el, text, opts) {
    var tooltipEl = document.createElement('span');
    var grav = opts.grav || el.getAttribute('data-tlite') || 'n';

    tooltipEl.innerHTML = text;

    el.appendChild(tooltipEl);

    var vertGrav = grav[0] || '';
    var horzGrav = grav[1] || '';
		
    var windowInnerWidth = window.parent.innerWidth - 15;
    var windowInnerHeight = window.parent.innerHeight;

    function positionTooltip() {
      tooltipEl.className = 'pagelayer-tlite ' + 'pagelayer-tlite-' + vertGrav + horzGrav;
	  
      var arrowSize = 10;
      var top = el.offsetTop;
      var left = el.offsetLeft;

      if (tooltipEl.offsetParent === el) {
        top = left = 0;
      }

      var width = el.offsetWidth;
      var height = el.offsetHeight;
      var tooltipHeight = tooltipEl.offsetHeight;
      var tooltipWidth = tooltipEl.offsetWidth;
      var centerEl = left + (width / 2);

      tooltipEl.style.top = (
        vertGrav === 's' ? (top - tooltipHeight - arrowSize) :
        vertGrav === 'n' ? (top + height + arrowSize) :
        (top + (height / 2) - (tooltipHeight / 2))
      ) + 'px';

      tooltipEl.style.left = (
        horzGrav === 'w' ? left :
        horzGrav === 'e' ? left + width - tooltipWidth :
        vertGrav === 'w' ? (left + width + arrowSize) :
        vertGrav === 'e' ? (left - tooltipWidth - arrowSize) :
        (centerEl - tooltipWidth / 2)
      ) + 'px';
    }

    positionTooltip();

    var rect = tooltipEl.getBoundingClientRect();

    if (vertGrav === 's' && rect.top < 0) {
      vertGrav = 'n';
      positionTooltip();
    } else if (vertGrav === 'n' && rect.bottom > windowInnerHeight) {
      vertGrav = 's';
      positionTooltip();
    } else if (vertGrav === 'e' && rect.left < 0) {
      vertGrav = 'w';
      positionTooltip();
    } else if (vertGrav === 'w' && rect.right > windowInnerWidth) {
      vertGrav = 'e';
      positionTooltip();
    }
	
	positionTooltip();
	
	// Additional handling
	if(rect.left < 0) {
      horzGrav = 'w';
      positionTooltip();
    } else if (rect.right > windowInnerWidth) {
      horzGrav = 'e';
      positionTooltip();
    }

    tooltipEl.className += ' pagelayer-tlite-visible';

    return tooltipEl;
  }
};

pagelayer_tlite.hide = function (el, isAuto) {
  el.tooltip && el.tooltip.hide(isAuto);
};

if (typeof module !== 'undefined' && module.exports) {
  module.exports = tlite;
}


/* Pagelayer Pen editor */
var pagelayer_customColor = ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466"];

var pagelayer_pen_sizeList = ['normal', 'x-small', 'small', 'medium', 'large', 'x-large'];
var pagelayer_pen_lineHeight = ['0.9', '1', '1.5', '2.0', '2.5','3.0', '3.5', '4.0', '4.5', '5.0'];

class PagelayerPen{

	constructor(jEle, options) {
		var t = this;
		
		t.editor = jQuery(jEle);
		t.options = options;
		
		// Get the document of the element. It use to makes the plugin
        // compatible on iframes.
		t.doc = jEle.ownerDocument || document;
		t.tagToButton = {};
		t.optionsCounter = 0;
		t.destroyEd = true;
		t.semantic = null;
		t.DEFAULT_SEMANTIC_MAP = {
			'b': 'strong',
			'i': 'em',
			's': 'strike',
			//'strike': 'del',
			'div': 'p'
		};

		// Init editor
		t.addHandlers();
		t.init();
		
	}
	
	init(){
		var t = this;
		// Init Editor
		t.editor.addClass('pagelayer-pen');
		t.penHolder = t.addContainer();
		t.addEvents();
	}
	
	addHandlers(){
		// TODO : Add for custom plugins
		// TODO remove all execCommands
		this.handlers = {
			bold:{
				tag: 'STRONG',
				icon: '<strong><i class="fas fa-bold"></i></strong>'
			},
			italic:{
				tag: 'EM',
				icon: '<strong><i class="fas fa-italic"></i></strong>'
			},
			underline:{
				tag: 'U',
				icon: '<strong><i class="fas fa-underline"></i></strong>'
			},
			strike:{
				tag: 'strike',
				fn: 'strikethrough',
				icon: '<strong><i class="fas fa-strikethrough"></i></strong>'
			},
			h1:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>1</sub></strong>'
			},
			h2:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>2</sub></strong>'
			},
			h3:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>3</sub></strong>'
			},
			h4:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>4</sub></strong>'
			},
			h5:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>5</sub></strong>'
			},
			h6:{
				fn: 'formatBlock',
				icon: '<strong>H<sub>6</sub></strong>'
			},
			p:{
				fn: 'formatBlock',
				icon: '<strong><i class="fas fa-paragraph"></i></strong>'
			},
			blockquote:{
				fn: 'formatBlock',
				icon: '<strong><i class="fas fa-quote-right"></i></strong>'
			},
			formating:{
				fn: 'formatBlock',
				fixIcon: '<strong><i class="fas fa-paragraph"></i></strong>'
			},
			unorderedlist:{
				tag: 'UL',
				fn: 'insertUnorderedList',
				icon: '<strong><i class="fas fa-list-ul"></i></i></strong>'
			},
			orderedlist:{
				tag: 'OL',
				fn: 'insertOrderedList',
				icon: '<strong><i class="fas fa-list-ol"></i></i></strong>'
			},
			sub:{
				tag: 'sub',
				fn: 'subscript',
				icon: '<strong><i class="fas fa-subscript"></i></strong>'
			},
			super:{
				tag: 'sup',
				fn: 'superscript',
				icon: '<strong><i class="fas fa-superscript"></i></strong>'
			},
			link:{
				fn: 'setLinkHandler',
				tag: 'a',
				icon: '<strong><i class="fas fa-link"></i></strong>',
			},
			image:{
				fn: 'imageBtnHandler',
				icon: '<i class="far fa-image"></i>'
			},
			align:{
				style: 'text-align',
				fn: 'formatBlock',
				icon: {
					'left': '<i class="fas fa-align-left"></i>',
					'center': '<i class="fas fa-align-center"></i>',
					'right': '<i class="fas fa-align-right"></i>',
					'justify': '<i class="fas fa-align-justify"></i>',
				}
			},
			color:{
				class: 'pagelayer-pen-color-picker',
				style: 'color',
				fn: 'commandHandler',
				fixIcon: '<svg viewbox=\"0 0 18 18\"> <line class=\"pagelayer-pen-color-label pagelayer-pen-stroke pagelayer-pen-transparent\" x1=3 x2=15 y1=15 y2=15></line> <polyline class=pagelayer-pen-stroke points=\"5.5 11 9 3 12.5 11\"></polyline> <line class=pagelayer-pen-stroke x1=11.63 x2=6.38 y1=9 y2=9></line> </svg>',
				buildBtn : 'buildColorBtnHandler',
				default : pagelayer_customColor,
				customInpute: true
			},
			background:{
				class: 'pagelayer-pen-color-picker',
				style: 'background-color',
				fn: 'commandHandler',
				fixIcon: '<svg viewbox=\"0 0 18 18\"> <g class=\"pagelayer-pen-fill pagelayer-pen-color-label\"> <polygon points=\"6 6.868 6 6 5 6 5 7 5.942 7 6 6.868\"></polygon> <rect height=1 width=1 x=4 y=4></rect> <polygon points=\"6.817 5 6 5 6 6 6.38 6 6.817 5\"></polygon> <rect height=1 width=1 x=2 y=6></rect> <rect height=1 width=1 x=3 y=5></rect> <rect height=1 width=1 x=4 y=7></rect> <polygon points=\"4 11.439 4 11 3 11 3 12 3.755 12 4 11.439\"></polygon> <rect height=1 width=1 x=2 y=12></rect> <rect height=1 width=1 x=2 y=9></rect> <rect height=1 width=1 x=2 y=15></rect> <polygon points=\"4.63 10 4 10 4 11 4.192 11 4.63 10\"></polygon> <rect height=1 width=1 x=3 y=8></rect> <path d=M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z></path> <path d=M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z></path> <path d=M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z></path> <rect height=1 width=1 x=12 y=2></rect> <rect height=1 width=1 x=11 y=3></rect> <path d=M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z></path> <rect height=1 width=1 x=2 y=3></rect> <rect height=1 width=1 x=6 y=2></rect> <rect height=1 width=1 x=3 y=2></rect> <rect height=1 width=1 x=5 y=3></rect> <rect height=1 width=1 x=9 y=2></rect> <rect height=1 width=1 x=15 y=14></rect> <polygon points=\"13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174\"></polygon> <rect height=1 width=1 x=13 y=7></rect> <rect height=1 width=1 x=15 y=5></rect> <rect height=1 width=1 x=14 y=6></rect> <rect height=1 width=1 x=15 y=8></rect> <rect height=1 width=1 x=14 y=9></rect> <path d=M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z></path> <rect height=1 width=1 x=14 y=3></rect> <polygon points=\"12 6.868 12 6 11.62 6 12 6.868\"></polygon> <rect height=1 width=1 x=15 y=2></rect> <rect height=1 width=1 x=12 y=5></rect> <rect height=1 width=1 x=13 y=4></rect> <polygon points=\"12.933 9 13 9 13 8 12.495 8 12.933 9\"></polygon> <rect height=1 width=1 x=9 y=14></rect> <rect height=1 width=1 x=8 y=15></rect> <path d=M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z></path> <rect height=1 width=1 x=5 y=15></rect> <path d=M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z></path> <rect height=1 width=1 x=11 y=15></rect> <path d=M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z></path> <rect height=1 width=1 x=14 y=15></rect> <rect height=1 width=1 x=15 y=11></rect> </g> <polyline class=pagelayer-pen-stroke points=\"5.5 13 9 5 12.5 13\"></polyline> <line class=pagelayer-pen-stroke x1=11.63 x2=6.38 y1=11 y2=11></line> </svg>',
				buildBtn: 'buildColorBtnHandler',
				default : pagelayer_customColor,
				customInpute: true
			},
			size:{
				class: 'pagelayer-pen-size-picker',
				style: 'font-size',
				fn: 'commandHandler',
				default : pagelayer_pen_sizeList,
				customInpute: true
			},
			lineheight:{
				style: 'line-height',
				fn: 'commandHandler',
				fixIcon: '<svg viewBox="0 0 22 18" version="1.1"><g><path class="pagelayer-pen-fill" d="M 21.527344 7.875 L 9.269531 7.875 C 9.011719 7.875 8.800781 8.125 8.800781 8.4375 L 8.800781 9.5625 C 8.800781 9.875 9.011719 10.125 9.269531 10.125 L 21.527344 10.125 C 21.789062 10.125 22 9.875 22 9.5625 L 22 8.4375 C 22 8.125 21.789062 7.875 21.527344 7.875 Z M 21.527344 13.5 L 9.269531 13.5 C 9.011719 13.5 8.800781 13.75 8.800781 14.0625 L 8.800781 15.1875 C 8.800781 15.5 9.011719 15.75 9.269531 15.75 L 21.527344 15.75 C 21.789062 15.75 22 15.5 22 15.1875 L 22 14.0625 C 22 13.75 21.789062 13.5 21.527344 13.5 Z M 21.527344 2.25 L 9.269531 2.25 C 9.011719 2.25 8.800781 2.5 8.800781 2.8125 L 8.800781 3.9375 C 8.800781 4.25 9.011719 4.5 9.269531 4.5 L 21.527344 4.5 C 21.789062 4.5 22 4.25 22 3.9375 L 22 2.8125 C 22 2.5 21.789062 2.25 21.527344 2.25 Z M 6.050781 5.0625 C 6.542969 5.0625 6.785156 4.453125 6.4375 4.101562 L 3.6875 1.289062 C 3.472656 1.070312 3.125 1.070312 2.910156 1.289062 L 0.160156 4.101562 C -0.160156 4.429688 0.0117188 5.0625 0.550781 5.0625 L 2.199219 5.0625 L 2.199219 12.9375 L 0.550781 12.9375 C 0.0585938 12.9375 -0.183594 13.546875 0.160156 13.898438 L 2.910156 16.710938 C 3.125 16.929688 3.476562 16.929688 3.691406 16.710938 L 6.441406 13.898438 C 6.757812 13.570312 6.585938 12.9375 6.050781 12.9375 L 4.398438 12.9375 L 4.398438 5.0625 Z M 6.050781 5.0625 "/></g></svg>',
				default : pagelayer_pen_lineHeight,
				customInpute: true
			},
			font:{
				style: 'font-family',
				fn: 'commandHandler',
				fixIcon: '<i class="fas fa-font"></i>',
				default : pagelayer_fonts,
				buildBtn : 'buildfontBtnHandler',
			},
			viewHTML:{
				fn: 'viewHTMLBtnHandler',
				icon: '<i class="fas fa-code"></i>'
			},
			removeformat:{
				icon: '<i class="fas fa-remove-format"></i>'
			}
		}
	}
	
	addContainer(className){
		
		className = className || false;
		
		// Add Container
		var container = jQuery('.pagelayer-pen-holder');
		
		if(container.length < 1){
			jQuery('body').append('<div class="pagelayer-pen-holder"></div>');
			container = jQuery('.pagelayer-pen-holder');
		}
		
		if(!className){
			return container;
		}
		
		if(container.find('.'+className).length < 1){
			container.append('<div class="'+className+'"></div>');
		}
		
		return container.find('.'+className);
		
	}
	
	addToolbar(){
		
		// Add Toolbar
		var t = this;
		var groups = t.options.toolbar;    
		var toolbar = t.toolbar = t.addContainer('pagelayer-pen-toolbar');
		
		// Make it empty
		toolbar.empty();
		
		if (!Array.isArray(groups[0])) {
			groups = [groups];
		}
		
		var addButton = function(container, format, value){
			
			var btn = t.handlers[format];
			var icon = '';
			
			if('icon' in btn){
				var _icon = btn['icon'];
				
				if(typeof _icon == 'object' && !pagelayer_empty(_icon[value])){
					icon = _icon[value];
				}else if(typeof icon == 'string'){
					icon = _icon;
				}
			}
			
			var input = document.createElement('button');
			input.setAttribute('type', 'button');
			input.setAttribute('data-format', format);
			input.classList.add('pagelayer-pen-' + format);
			
			if('class' in btn){
				input.classList.add(btn['class']);
			}
			
			if( pagelayer_empty(value) && 'default' in btn ){
				value = btn['default'];
			}
			
			input.innerHTML = icon;
			if(value != null) {
				input.value = value;
			}
			container.appendChild(input);
		}
		
		var createoption = function(val, lang, type){
			type = type || '';
			var lang = pagelayer_empty(lang) ? 'Default' : lang;
			return '<option  value="'+val+'" type="'+type+'">'+lang+'</option>';
		}
		
		var addSelect = function(container, format, values) {
			
			var input = document.createElement('select');
			input.classList.add('pagelayer-pen-' + format);
			
			if('class' in t.handlers[format]){
				input.classList.add(t.handlers[format]['class']);
			}
			
			input.setAttribute('data-format', format);
			
			if( pagelayer_empty(values) && 'default' in t.handlers[format] ){
				values = t.handlers[format]['default'];
			}
			
			for(var kk in values){
				var options = '';
				var value = values[kk];
				
				if(typeof value == 'object') {
					if(kk != 'default'){
						options += '<optgroup label="'+pagelayer_ucwords(kk)+'">';
					}
					for(y in value){
						options += createoption((jQuery.isNumeric(y) ? value[y] : x), value[y], kk);
					}		
				}else if(value !== false) {
					options += createoption(value, value);
				} else {
					options += createoption('', '');
				}

				jQuery(input).append(options);
			}

			container.appendChild(input);
		}
		
		groups.forEach(function(controls){
			var group = document.createElement('span');
			group.classList.add('pagelayer-pen-formats');

			controls.forEach(function (control){
				var format = control;
				
				if(typeof control === 'object'){
					format = Object.keys(control)[0];
				}
				
				if( pagelayer_empty(t.handlers[format]) ){
					return;
				}

				if( typeof control === 'string' ){
					addButton(group, control);
				} else {
					var value = control[format];
					if (Array.isArray(value)) {
						addSelect(group, format, value);
					} else {
						addButton(group, format, value);
					}
				}
				
				var btn = t.handlers[format];
				t.tagToButton[(btn.tag || btn.style || format).toLowerCase()] = format;
			});
			
			// TODO skip if format is not exist
			toolbar[0].appendChild(group);
		});
		
		toolbar.find('button').on('click', function(){
			var bEle = jQuery(this);
			var format = bEle.data('format');
			
			if(! format in t.handlers){
				return;
			}
			
			var btn = t.handlers[format];
			t.currentFormat = format;
			t.execCmd(btn.fn || format, btn.param || format, btn.forceCss);
		});
		
		toolbar.find('select').on('change', function(e){
			var bEle = jQuery(this);
			var format = bEle.data('format');
			var val = bEle.val();
			
			if(! format in t.handlers){
				return;
			}
			
			var btn = t.handlers[format];
			t.currentFormat = format;
			t.execCmd(btn.fn || format, val, btn.forceCss);
		});
		
		toolbar.find('select').each(function(){
			var format = jQuery(this).data('format');
			
			if('buildBtn' in t.handlers[format]){
					
				try{
					t[t.handlers[format]['buildBtn']](this);
				}catch(e){
					try{
						t.handlers[format]['buildBtn'](this);
					}catch(e2){
						t.buildDropdown(this);
					}
				}
				
				return true;
			}
			
			t.buildDropdown(this);
		});
		
		// Add close button
		toolbar.append('<span class="pagelayer-pen-formats"><button class="pagelayer-pen-close"><i class="fas fa-times"></i></button></span>');
		
		// Hide editor on click close tool handler
		toolbar.find('.pagelayer-pen-close').on('mousedown', function(e){
			//e.preventDefault();
			t.destroyEd = true;
			t.editor.trigger('blur');
		});
				
	}
	
	execCmd(cmd, param, forceCss, skipPen){
		var t = this;
		skipPen = !!skipPen || '';

		if(cmd !== 'dropdown'){
			t.focus();
			t.restoreRange();
		}

		try{
			document.execCommand('styleWithCSS', false, forceCss || false);
		}catch(c){}

		try{
			t[cmd + skipPen](param);
		}catch(c){
			try{
				cmd(param);
			}catch(e2){
				if(cmd === 'insertHorizontalRule'){
					param = undefined;
				}else if (cmd === 'formatBlock'){ // TODO: check for && t.isIE
					param = '<' + param + '>';
				}				
			
				document.execCommand(cmd, false, param);
				t.semanticCode();
				t.restoreRange();
			}
		}
					
		if(cmd !== 'dropdown'){
			t.updateButtonStatus();
			t.editor.trigger('input');
		}
		
	}
	
	commandHandler(value){
		var t = this;
		var format = t.currentFormat;
		
		if( pagelayer_empty(format) ){
			return;
		}
		
		var btn = t.handlers[format];
		var sel = window.getSelection();
		var text = t.range.commonAncestorContainer;
		var selectedText = t.range.cloneContents();
		selectedText = jQuery('<div>').append(selectedText).html();
		
		// Also select the tag
		if(text.nodeType === Node.TEXT_NODE){
			text = text.parentNode;
		}
		
		if (text.innerHTML === selectedText && text != t.editor[0]) {
			var ele = jQuery(text);
			if('tag' in btn){
				// Replace tag
			}else if('style' in btn){
				var style = {};
				style[btn.style] = value;

				ele.css(style);
			}else if('atts' in btn){
				// Add attribute or toggle the element
			}
		} else {
			
			// TODO for toggle tags and add tags
			var html = jQuery('<span style="'+btn.style+':' + value + ';">' + selectedText + '</span>');
			
			// Remove style from all childrend
			var style = {};
			style[btn.style] = '';
			html.find('[style]').css(style);
			// TODO: remove span element that have no atts
			var node = html[0];
			var firstInsertedNode = node.firstChild;
			var lastInsertedNode = node.lastChild;
			t.range.deleteContents();
			t.range.insertNode(node);

			if(firstInsertedNode) {
				t.range.setStartBefore(firstInsertedNode);
				t.range.setEndAfter(lastInsertedNode);
			}
			
			// Is previous element empty?
			var prev = jQuery(node).prev();
			
			if( prev.length > 0 && prev.is(':empty') ){
				prev.remove();
			}
		}
		
		sel.removeAllRanges();
		sel.addRange(t.range);
		
	}
	
	formatBlock(value){
		
		var t = this,
			format = t.currentFormat,
			btn = t.handlers[format],
			startNode = t.range.startContainer,
			endNode = t.range.endContainer;
		
		if( startNode.nodeType == Node.TEXT_NODE && startNode.parentNode != t.editor[0] ){
			startNode = startNode.parentNode;
		}
		
		if( endNode.nodeType == Node.TEXT_NODE && endNode.parentNode != t.editor[0] ){
			endNode = endNode.parentNode;
		}
		
		// TODO: only for seleced content
		// Wrap text nodes in span for easier processing
		t.editor.contents().filter(function () {
			return this.nodeType === 3 && this.nodeValue.trim().length > 0;
		}).wrap('<span data-pts/>');
		
		var isLineEnd = function(lEle){
			return lEle == null || lEle.nodeName == 'BR' || t.isline(lEle);
		}

		var wrapLine = function(pLine){
			
			var pLine = jQuery(pLine),
				lineFele,
				lineEele,
				finalP;
			
			// Get Parent Element
			if(pLine.parentsUntil(t.editor).length > 0){
				pLine = pLine.parentsUntil(t.editor).last();
			}
			
			if(t.isline(pLine)){
				return pLine;
			}
			
			// Get line first element
			if(isLineEnd(pLine[0].previousSibling)){
				lineFele = pLine;
			}else{
				lineFele = pLine.prevAll().filter(function(){
					return isLineEnd(this.previousSibling);
				}).first();
			}
			
			// Get line last element
			if(isLineEnd(lineFele[0].nextSibling)){
				lineEele = lineFele;
			}else{
				lineEele = lineFele.nextAll().filter(function(){
					return isLineEnd(this.nextSibling);
				}).first();
			}
			
			// Wrap all with p tag			
			if(lineFele.is(lineEele)){
				finalP = lineFele.wrap('<p/>').parent()
			}else{
				finalP = lineFele.nextUntil(lineEele.next()).addBack().wrapAll('<p/>').parent();
			}
			
			finalP.next('br').remove();
			return finalP;
		}
		
		// Get start block lavel elements
		var $sNode = jQuery(t.blockNode(startNode));
		if($sNode.is(t.editor)){
			$sNode = wrapLine(startNode);
		}
		
		var $eNode = jQuery(t.blockNode(endNode));
		if($eNode.is(t.editor)){
			$eNode = wrapLine(endNode);
		}
		
		var $oldEle = $sNode;
		
		if(! $sNode.is($eNode) ){
			
			var findEnd = false;
      
			var addElement = function(addEle){
				if(addEle[0].nodeName == 'UL' || addEle[0].nodeName == 'OL') {
					addEle.children().each(function(){
						$oldEle = $oldEle.add(jQuery(this));
					});
					return;
				}
				$oldEle = $oldEle.add(addEle);
			}
			
			var wrapAllEle = function(nextEle){
				
				if(nextEle.is($eNode) || nextEle.find($eNode).length > 0){
					findEnd = true;
					return;
				}
				
				if(nextEle.length < 1){
					return;
				}
				
				if(!t.isline(nextEle[0])){
					nextEle = wrapLine(nextEle);
				}
				
				addElement(nextEle);				
				wrapAllEle( nextEle.next() );
			}
			
			wrapAllEle($sNode.next());
			
			// Is start Element have a another parent
			var pars = $sNode.parentsUntil(t.editor);
			
			pars.each(function(){
				var $par = jQuery(this);
				wrapAllEle($par.next());
			});
			
			if( pars.length > 0 ){
				$sNode = pars.last();
			}
			
			var nextEnd = $sNode.nextAll().filter(function(){
				return jQuery(this).is($eNode) || jQuery(this).find($eNode).length > 0;
			}).first();
      
			// Add elements
			if( nextEnd.length > 0 ){
				var $nextEle = $sNode.nextUntil(nextEnd);
				$nextEle.each(function(){
					var ulEle = jQuery(this);
					if($oldEle.has(ulEle)) return;
					addElement(ulEle);
				});
			}
			
			// Add end element
			if(nextEnd.length > 0 && !nextEnd.is($eNode) && (nextEnd[0].nodeName == 'UL' || nextEnd[0].nodeName == 'OL')){
				nextEnd.children().each(function(){
					var li = jQuery(this);
					$oldEle = $oldEle.add(li);
					if(li.is($eNode) || li.find($eNode).length > 0) return false;
				});
			}else{
				$oldEle = $oldEle.add($eNode);
			}
		}
		
		if('style' in btn){
			var style = {};
			style[btn.style] = value;

			$oldEle.css(style);
		}else if('atts' in btn){
			// Add attribute or toggle the element
			var attr = {};
			attr[btn.atts] = value;
			
			$oldEle.attr(attr);
		}else{
			// Replace tag
			var tag = value.toLowerCase();
			
			// need to find all block ele and replace this
			$oldEle.each( function(){
				
				var $cEle = jQuery(this);
				
				if($cEle.is(t.editor)){
					return;
				}
				
				// Is List element
				if($cEle.css('display') == 'list-item'){
					if( t.isline($cEle[0].firstChild)){
						$cEle.children().each(function(){
							var liChild = jQuery(this);
							
							if(t.isline(liChild[0])){
								t.replaceTag(liChild, tag, true);
								return;
							}
							// TODO: Check and need to correct
							liChild.wrap('<' + tag + '/>');
							liChild.next('br').remove();
							
						});
						return
					}
						
					$cEle.contents().wrapAll('<' + tag + '/>');
					return;
				}
				
				t.replaceTag($cEle, tag, true);
			});
		}
		
		// Get rid of pen temporary span's
		jQuery('[data-pts]', t.editor).contents().unwrap();
		t.semanticCode();
		t.restoreRange();
	}
	
	blockNode( node ){
		var t = this;
		while( !t.isline(node) && node != t.editor[0] ) {
			node = node.parentNode;
		}
		return node;
	}
	
	isline(node){
		if (node.nodeType !== Node.ELEMENT_NODE) return false;
		if (node.childNodes.length === 0) return false; // Exclude embed blocks
		var style = window.getComputedStyle(node);
		return ['block', 'list-item'].indexOf(style.display) > -1;
	}
	
	replaceTag(ele, tag, copyAttr){
		ele.wrap('<' + tag + '/>');
		
		var par = ele.parent();
		
		if(copyAttr){
			jQuery.each(ele.prop('attributes'), function () {
				par.attr(this.name, this.value);
			});
		}
    
		ele.contents().unwrap();
    
		return par;
	}
	
	semanticCode(){
		var t = this;
		t.semanticTag('b');
		t.semanticTag('i');
		t.semanticTag('s');
		t.semanticTag('strike');
		t.semanticTag('div', true);
	}
	
	semanticTag(oldTag, copyAttributes){
		var t = this;
		var newTag;

		if(t.semantic != null && typeof t.semantic === 'object' && t.semantic.hasOwnProperty(oldTag)){
			newTag = t.semantic[oldTag];
		} else if (t.DEFAULT_SEMANTIC_MAP.hasOwnProperty(oldTag)) {
			newTag = t.DEFAULT_SEMANTIC_MAP[oldTag];
		} else {
			return;
		}

		jQuery(oldTag, t.editor).each(function () {
			var $oldTag = jQuery(this);
			if($oldTag.contents().length === 0) {
				return false;
			}
			
			t.replaceTag($oldTag, newTag, copyAttributes);
		});
	}
	
	addEvents(){
		// Add Events
		var t = this,
		editor = t.editor,
		ctrl = false,
		debounceButtonStatus;
		
		var showToolBar = function(){
			
			var jEle = t.penHolder.children(':visible');
			
			if(jEle.length < 1){
				jEle = t.toolbar;
			}
			
			t.showPen(jEle);
		};
		
		// Save rage
		editor.on('focusout', function(e){
			
			if(t.destroyEd){
				t.editor.removeClass('pagelayer-pen-focused');
				t.range = null;
				return;
			}
			
			t.saveRange();

		});
		
		// Prevent to hide toolbar
		t.penHolder.on('mousedown', function(e){
			// TODO: taget only require Element
			t.destroyEd = false;
		});
		
		// On editor blur
		editor.on('blur', function(){
			
			if(!t.destroyEd){
				return;
			}
			
			t.destroy();
		});
		
		editor.on('keydown', function(){
			t.penHolder.hide();
		});
		
		editor.on('mousedown', function(){
			if(t.editor.attr('contenteditable') == 'true'){
				t.showPen();
			}
		});
		
		editor.on('mouseup keyup keydown', function(e){
			if ((!e.ctrlKey && !e.metaKey) || e.altKey) {
				setTimeout(function () { // "hold on" to the ctrl key for 50ms
					ctrl = false;
				}, 50);
			}

			clearTimeout(debounceButtonStatus);
			debounceButtonStatus = setTimeout(function () {
				t.updateButtonStatus();
			}, 50);
			
		});
		
		// Set focus on editor
		editor.on('click', function(e){
			
			if(t.editor.hasClass('pagelayer-pen-focused')){
				return;
			}
			
			t.editor.attr('contenteditable', 'true');
			t.editor.focus();
		});
		
		// Set focus on editor
		editor.on('focus', function(){
			t.destroyEd = true;
			t.addToolbar();
			t.showPen();
			t.editor.addClass('pagelayer-pen-focused');
			jQuery(window).unbind('scroll.penToobar');
			jQuery(window).on('scroll.penToobar', showToolBar);
			jQuery(document).unbind('mousemove.penToobar');
			jQuery(document).on('mousemove.penToobar', showToolBar);
		});
		
		t.semanticCode();
	}
	
	destroy(){
		var t = this;
		//t.editor.attr('contenteditable', '');
		t.penHolder.hide();
		// Removing event listeners
		jQuery(document).unbind('mousemove.penToobar');
		jQuery(window).unbind('scroll.penToobar');
	}
	
	hasFocus(){
		var t = this;
		return (
		t.doc.activeElement === t.editor ||
		t.contains( t.editor[0], t.doc.activeElement)
		);
	}
	
	contains(parent, descendant) {
		try {
			// Firefox inserts inaccessible nodes around video elements
			descendant.parentNode; // eslint-disable-line no-unused-expressions
		} catch (e) {
			return false;
		}
		return parent.contains(descendant);
	}
	
	saveRange(){
		var t = this,
		selection = t.doc.getSelection();

		t.range = null;

		if (!selection || !selection.rangeCount) {
			return;
		}

		var savedRange = t.range = selection.getRangeAt(0),
			range = t.doc.createRange(),
			rangeStart;
		range.selectNodeContents(t.editor[0]);
		range.setEnd(savedRange.startContainer, savedRange.startOffset);
		rangeStart = (range + '').length;
		t.metaRange = {
			start: rangeStart,
			end: rangeStart + (savedRange + '').length
		};
	}
	
	restoreRange(){
		var t = this,
			metaRange = t.metaRange,
			savedRange = t.range,
			selection = t.doc.getSelection(),
			range;

		if(!savedRange){
			return;
		}

		if(metaRange && metaRange.start !== metaRange.end){ // Algorithm from http://jsfiddle.net/WeWy7/3/
			var charIndex = 0,
				nodeStack = [t.editor[0]],
				node,
				foundStart = false,
				stop = false;

			range = t.doc.createRange();

			while(!stop && (node = nodeStack.pop())){
				if (node.nodeType === 3){
					var nextCharIndex = charIndex + node.length;
					if (!foundStart && metaRange.start >= charIndex && metaRange.start <= nextCharIndex) {
						range.setStart(node, metaRange.start - charIndex);
						foundStart = true;
					}
					if (foundStart && metaRange.end >= charIndex && metaRange.end <= nextCharIndex) {
						range.setEnd(node, metaRange.end - charIndex);
						stop = true;
					}
					charIndex = nextCharIndex;
				} else {
					var cn = node.childNodes,
					i = cn.length;

					while (i > 0) {
						i -= 1;
						nodeStack.push(cn[i]);
					}
				}
			}
		}

		selection.removeAllRanges();
		selection.addRange(range || savedRange);
	}
	
	getRange(){
		var t = this;
		var selection = t.doc.getSelection();
		if (selection == null || selection.rangeCount <= 0) return null;
		var range = selection.getRangeAt(0);
		if(range == null) return null;
		
		return range;
	}
	
	getRangeText(range){
		return range + '';
	}
	
	focus(){
		var t = this;
		if(t.hasFocus()) return;
		t.editor.click();
		t.editor.focus();
		t.restoreRange();
	}
	
	getBounds(range){
		var rect = range.getBoundingClientRect();
		return {
			bottom: rect.top + rect.height,
			height: rect.height,
			left: rect.left,
			right: rect.right,
			top: rect.top,
			width: 0
		};
	}
	
	showPen(jEle){
		var t = this;
		jEle = jEle || jQuery(t.toolbar);
		
		var toolBar = jQuery(t.penHolder);
		var tooltipHeight = parseInt(toolBar.css('height'));
		var range = null;
		
		if(! t.hasFocus() && t.range != null){
			range = t.range;
		}else{
			range = t.getRange();
		}
		
		if(range == null){
			toolBar.hide();
			return;
		}
		
		// Set left of toolbar
		var editorOffset = t.editor[0].getBoundingClientRect();
		var editorTop = editorOffset.top;
		var editorLeft = editorOffset.left;
		var editorbottom = editorTop + editorOffset.height - tooltipHeight;
		var toolBarTop = editorTop - 10;
		var bound = t.getBounds(range);
		
		if(bound.height == 0 && bound.top == 0 && bound.left == 0){
			toolBar.hide();
			return;
		}
		
		var boundTop = bound.top - 15;
    	
		// Set top of toolbar
		if( boundTop - tooltipHeight < 0 && bound.bottom > -5){
			toolBarTop = bound.bottom + tooltipHeight + 15;
		}else if( editorbottom - 30 < 0 ){
			toolBarTop =  editorbottom + 20;
		}else if( toolBarTop - tooltipHeight < 0 ){
			toolBarTop = tooltipHeight + 10;
		}
		
		// Show Toolbar
		toolBar.children().hide();
		toolBar.show();
		jEle.show();
		
		// Set top of toolbar
		toolBar.css('top', toolBarTop);
		
		// Set left of toobar
		var docW = jQuery(window).width() - 10;
		var toolW = toolBar.width();
		var edW = t.editor.width();
		
		if(toolW > edW){
			editorLeft = editorLeft - (toolW - edW) / 2
		}
				
		toolBar.css('left', editorLeft+'px');
		
		var tooltipLeft = toolBar.offset().left;
				
		if(tooltipLeft < 0){
			toolBar.css('left', '1px');
		}
		
		var toolRight = tooltipLeft + toolW;
		if(docW < toolRight){
			toolBar.css('left', tooltipLeft - (toolRight - docW)+'px');
		}
		
	}
	
	getContent(){
		var editor = this.editor;
		var html = editor.html();
		
		return html;
	}
	
	setContent(html){
		var t = this;
		html = html || '';
		t.editor.html(html);
		t.editor.trigger('input');
	}
	
	updateButtonStatus(){
		var t = this,
		toolbar = jQuery(t.toolbar),
		tags = t.getTagsRecursive(t.doc.getSelection().focusNode),
		activeClasses = 'pagelayer-pen-active';
		
		jQuery('.' + activeClasses, toolbar).removeClass(activeClasses);
		jQuery.each(tags, function (i, tag){
			var btnName;
			
			if(pagelayer_is_string(tag)){
				btnName = t.tagToButton[tag.toLowerCase()];
			}else{
				btnName = t.tagToButton[Object.keys(tag)[0].toLowerCase()]
			}
			
			var $btn = jQuery('[data-format="'+btnName+'"]', toolbar);
	
			if($btn.length < 1){
				return;
			}
			
			if($btn.find('.pagelayer-pen-picker-label').length > 0){
				$btn.find('.pagelayer-pen-picker-label').addClass(activeClasses);
				return;
			}
			
			$btn.addClass(activeClasses);
		});
	}
	
	getTagsRecursive(element, tags) {
		var t = this;
		var jEle = jQuery(element);
		tags = tags || (element && element.tagName ? [element.tagName] : []);

		if (element && element.parentNode) {
			element = element.parentNode;
		} else {
			return tags;
		}

		var tag = element.tagName;
		// Is this editor
		if (tag === 'DIV') {
			return tags;
		}
		
		// TODO: for all block element
		if (tag === 'P' && element.style.textAlign !== '') {
			tags.push(element.style.textAlign);
		}

		jQuery.each(t.tagHandlers, function (i, tagHandler) {
			tags = tags.concat(tagHandler(element, t));
		});
		
		tags.push(tag);
		var styles = jEle.attr('style');
		
		if(!pagelayer_empty(styles)){
			var styles = styles.split(';');

			jQuery.each(styles, function(i, style){
				style = style.split(':');
				var ss = String(style[0]).trim();
				var vv = String(style[1]).trim();

				if(pagelayer_empty(ss) || ss in tags && !pagelayer_empty(tags[ss])){
					return;
				}
				
				var obj = {};
				obj[ss] = vv;
				
				tags.push(obj);
			});
		}

		return t.getTagsRecursive(element, tags).filter(function (tag) {
			return tag != null;
		});
	}
	
	buildDropdown(select){
		
		var t = this;
		var fixIcon = '';
		
		select = jQuery(select);		
		var format = select.data('format');
		
		var selAtts = '';
		var options = '';
		var optId = `pagelayer-pen-picker-options-${t.optionsCounter}`;
		t.optionsCounter += 1;
		
		Array.from(select[0].attributes).forEach(item => {
			selAtts += ' '+item.name+'="'+ item.value +'"';
		});
		
		Array.from(select[0].options).forEach(option => {
			
			var attrs = '';
			var val = '';
			var itemInner = '';
			
			if(option.hasAttribute('value')){
				val = option.getAttribute('value');
				attrs += ' data-value="'+val+'"';
			}
			
			if(option.textContent){
				attrs += ' data-label="'+option.textContent+'"';
			}
			
			// Set icon
			if('icon' in t.handlers[format] && typeof t.handlers[format]['icon'] == 'object' && !pagelayer_empty(t.handlers[format]['icon'][val])){
				itemInner = t.handlers[format]['icon'][val];
			}
			
			options += `<span class="pagelayer-pen-picker-item" tabindex="0" role="button" ${attrs}>${itemInner}</span>`;
		});
		
		if('fixIcon' in t.handlers[format]){
			fixIcon = t.handlers[format]['fixIcon'];
		}
		
		var customInpute = '';
		
		if('customInpute' in t.handlers[format] && !pagelayer_empty(t.handlers[format]['customInpute'])){
			customInpute = '<input type="text" class="pagelayer-pen-custom-input" placeholder="Custom value">';
		}
		
		var container = jQuery(`<span ${selAtts}>
			<span class="pagelayer-pen-picker-label" tabindex="0" role="button" aria-expanded="false">${fixIcon}</span>
			<span class="pagelayer-pen-picker-options" aria-hidden="true" tabindex="-1" id="${optId}" aria-controls="${optId}">
				${options}
				${customInpute}
			</span>
		</span>`);
		
		container.addClass('pagelayer-pen-picker');
		
		select.before(container);
		select.hide();
		
		var close = function(cEle){
			cEle.removeClass('pagelayer-pen-expanded');
			cEle.find('.pagelayer-pen-picker-label').attr('aria-expanded', 'false');
			cEle.find('.pagelayer-pen-picker-options').attr('aria-hidden', 'true');
		}
		
		var selectItem = function(item, trigger = false){
			var selected = container.find('.pagelayer-pen-selected');
			var label = container.find('.pagelayer-pen-picker-label');
			var val = '';
			
			if (item === selected) return;
			if (selected != null) {
				selected.removeClass('pagelayer-pen-selected');
			}
			if(item == null) return;
			item.classList.add('pagelayer-pen-selected');
			select.selectedIndex = Array.from(item.parentNode.children).indexOf(
			item,
			);
			if (item.hasAttribute('data-value')) {
				val = item.getAttribute('data-value');
				label.attr('data-value', val);
			} else {
				label.attr('data-value', val);
			}
			if (item.hasAttribute('data-label')) {
				label.attr('data-label', item.getAttribute('data-label'));
			} else {
				label.attr('data-label', '');
			}
			
			if(!fixIcon){
				label.html(item.innerHTML);
			}
			
			if(trigger) {
				select.val(val);
				select.trigger('change');
				close(container);
			}
		}
		
		var toggleAriaAttribute = function(element, attribute) {
			element.setAttribute(
			attribute,
			!(element.getAttribute(attribute) === 'true'),
		);
}
		var togglePicker = function() {
			container.toggleClass('pagelayer-pen-expanded');
			// Toggle aria-expanded and aria-hidden to make the picker accessible
			toggleAriaAttribute(container.find('.pagelayer-pen-picker-label')[0], 'aria-expanded');
			toggleAriaAttribute(container.find('.pagelayer-pen-picker-options')[0], 'aria-hidden');
		}
		
		container.find('.pagelayer-pen-picker-item').on('click', function(){
			selectItem(this, true);
			close(container);
		});
		
		container.find('.pagelayer-pen-picker-label').on('click', function(){
			togglePicker();
		});
		
		container.find('.pagelayer-pen-custom-input').on('focusout keydown', function(e){
			
			if(e.type == 'keydown' && e.keyCode != 13){
				return;
			}
			
			e.preventDefault();
			
			var val = jQuery(this).val();
			
			if(pagelayer_empty(val)){
				return;
			}
			
			var opt = select.find('option.pagelayer-pen-custom-value');
			
			if(opt.length < 1){
				select.append('<option class="pagelayer-pen-custom-value"></option>');
				opt = select.find('option.pagelayer-pen-custom-value');
			}
			
			opt.val(val);
			select.val(val);
			select.trigger('change');
			close(container);
		});
		
		jQuery(t.toolbar).on('mousedown', function(e){
			var tEle = jQuery(this);
			var target = jQuery(e.target);
			var tPicker = target.closest('.pagelayer-pen-picker');
			
			if(target.closest('.pagelayer-pen-picker-item').length > 0) return;
			
			tEle.find('.pagelayer-pen-picker.pagelayer-pen-expanded').each(function(){
				var picker = jQuery(this);
				if(tPicker.length > 0 && tPicker.is(picker))return;
				close(picker);
			});
			
		});
		
		// TODO need to correct this function update the select
		container.on('update', function(){
			var item = container.find('.pagelayer-pen-selected');
			
			if(item.length < 1){
				item = container.find('.pagelayer-pen-picker-item').first();
			}
			
			selectItem(item[0]);
		});
		
		container.trigger('update');
		
		return container;
	}
	
	buildColorBtnHandler(item){
		var t = this;
		var select = t.buildDropdown(item);
		var format = select.data('format');
		
		// Set color
		select.find('.pagelayer-pen-picker-item').each(function(){
			var opt = jQuery(this);
			var color = opt.data('value');
			
			opt.css({'background': color});
			
			// TODO remove this and add on selecttion
			opt.on('click', function(){
				if(format == 'color'){
					opt.closest('.pagelayer-pen-picker-label').css({'text-color': color});
				}else{
					opt.closest('.pagelayer-pen-picker-label').css({'background-color': color});
				}
			});
		});
		
	}
	
	buildfontBtnHandler(item){
		var t = this;
		
		var select = t.buildDropdown(item);
		
		jQuery(item).on('change', function(){
			pagelayer_link_font_family(jQuery(this));	
		});
		
	}
	
	setLinkHandler(){
		var t = this,
			documentSelection = t.doc.getSelection(),
			node = documentSelection.focusNode,
			text = new XMLSerializer().serializeToString(documentSelection.getRangeAt(0).cloneContents()),
			url = '',
			linkBtn = 'Link',
			unlinkBtn = 'Cancel';

		while (['A', 'DIV'].indexOf(node.nodeName) < 0) {
			node = node.parentNode;
		}
		
		if(node && node.nodeName === 'A'){
			var $a = jQuery(node);
			url = $a.attr('href');
		}
		
		if(!pagelayer_empty(url)){
			linkBtn = 'Update';
			unlinkBtn = 'Unlink';
		}
    
		t.saveRange();
			
		var tooltip = this.addContainer('pagelayer-pen-link-tooltip');
		t.linkTooltip = tooltip;
		
		var html = '<input type="text" name="url" placeholder="https://example.com" value="'+url+'" autocomplete="off"><span class="pagelayer-pen-link-btn pagelayer-btn-success">'+linkBtn+'</span><span class="pagelayer-pen-unlink-btn pagelayer-btn-primary">'+unlinkBtn+'</span>';
		tooltip.html(html);
		
		var input = tooltip.find('input[name="url"]');
		
		// Keep saving old range
		var metaRange = t.metaRange;
		var savedRange = t.range;
		var restoreRange = function(){
			t.metaRange = metaRange;
			t.range = savedRange;
			t.restoreRange();
		}
		
		t.linkTooltip.find('.pagelayer-pen-link-btn').on('click', function(){
			var url = input.val();
			
			restoreRange();
			t.execCmd('createLink', url, true );
			t.editor.trigger('input');
			t.showPen();
		});
		
		t.linkTooltip.find('.pagelayer-pen-unlink-btn').on('click', function(){
			restoreRange();
			if(unlinkBtn == 'Unlink'){
				t.execCmd('unlink', undefined, undefined, true);
			}
			t.showPen();
		});
	
		t.showPen(t.linkTooltip);
	}
	
	imageBtnHandler(){
		var t = this;
		t.destroyEd = false;
		t.destroy();
		
		var frame = pagelayer_select_frame('image');
		
		// On select update the stuff
		frame.on({'select': function(){
				var state = frame.state();
				var url = '', alt = '', id = '';
				
				// External URL
				if('props' in state){
					
					url = state.props.attributes.url;
					alt = state.props.attributes.alt;
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					// Set the new and URL
					url = attachment.url;
					alt = attachment.alt;
					id = attachment.id;
					
				}
				t.editor.click();
				t.restoreRange();
				t.execCmd('insertImage', url, false, true);
				var $img = jQuery('img[src="' + url + '"]:not([alt])', t.editor);
				
				$img.attr('alt', alt);
				$img.attr('pl-media-id', id);
			}
		});

		frame.open();
	}
	
	viewHTMLBtnHandler(param){
		var t = this;
		var html = t.getContent();
		t.destroyEd = false;
		t.destroy();

		// Add Container
		var HTMLviewer = jQuery('.pagelayer-pen-html-viewer');
		
		if(HTMLviewer.length < 1){
			jQuery('body').append('<div class="pagelayer-pen-html-viewer">'+
				'<div class="pagelayer-pen-html-holder">'+
					'<textarea class="pagelayer-pen-html-area"></textarea>'+
					'<div class="pagelayer-pen-html-btn">'+
						'<button class="pagelayer-pen-html-btn-update pagelayer-btn-success">Update</button>'+
						'<button class="pagelayer-pen-html-btn-cancel pagelayer-btn-secondary">Cancel</button>'+
					'</div>'+
				'</div>'+
			'</div>');
			
			HTMLviewer = jQuery('.pagelayer-pen-html-viewer');
		}
		
		HTMLviewer.find('.pagelayer-pen-html-area').val(html);
		HTMLviewer.show();
		
		HTMLviewer.find('.pagelayer-pen-html-btn-update').unbind('click');
		HTMLviewer.find('.pagelayer-pen-html-btn-update').on('click', function(){
			var html = HTMLviewer.find('.pagelayer-pen-html-area').val();
			t.range = null;
			t.editor.click();
			t.setContent(html);
			t.editor.trigger('focus');
			HTMLviewer.hide();
		});
		
		HTMLviewer.find('.pagelayer-pen-html-btn-cancel').unbind('click');
		HTMLviewer.find('.pagelayer-pen-html-btn-cancel').on('click', function(){
			t.editor.click();
			t.focus();
			HTMLviewer.hide();
		});
		
	}
}


/*!
 * imagesLoaded PACKAGED v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(e,t){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",t):"object"==typeof module&&module.exports?module.exports=t():e.EvEmitter=t()}("undefined"!=typeof window?window:this,function(){function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return n.indexOf(t)==-1&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{},n=i[e]=i[e]||{};return n[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return n!=-1&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){i=i.slice(0),t=t||[];for(var n=this._onceEvents&&this._onceEvents[e],o=0;o<i.length;o++){var r=i[o],s=n&&n[r];s&&(this.off(e,r),delete n[r]),r.apply(this,t)}return this}},t.allOff=function(){delete this._events,delete this._onceEvents},e}),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return t(e,i)}):"object"==typeof module&&module.exports?module.exports=t(e,require("ev-emitter")):e.imagesLoaded=t(e,e.EvEmitter)}("undefined"!=typeof window?window:this,function(e,t){function i(e,t){for(var i in t)e[i]=t[i];return e}function n(e){if(Array.isArray(e))return e;var t="object"==typeof e&&"number"==typeof e.length;return t?d.call(e):[e]}function o(e,t,r){if(!(this instanceof o))return new o(e,t,r);var s=e;return"string"==typeof e&&(s=document.querySelectorAll(e)),s?(this.elements=n(s),this.options=i({},this.options),"function"==typeof t?r=t:i(this.options,t),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(this.check.bind(this))):void a.error("Bad element for imagesLoaded "+(s||e))}function r(e){this.img=e}function s(e,t){this.url=e,this.element=t,this.img=new Image}var h=e.jQuery,a=e.console,d=Array.prototype.slice;o.prototype=Object.create(t.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),this.options.background===!0&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&u[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var u={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},o.prototype.addImage=function(e){var t=new r(e);this.images.push(t)},o.prototype.addBackground=function(e,t){var i=new s(e,t);this.images.push(i)},o.prototype.check=function(){function e(e,i,n){setTimeout(function(){t.progress(e,i,n)})}var t=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(t){t.once("progress",e),t.check()}):void this.complete()},o.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,e,t)},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},r.prototype=Object.create(t.prototype),r.prototype.check=function(){var e=this.getIsImageComplete();return e?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},r.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},r.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var e=this.getIsImageComplete();e&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},o.makeJQueryPlugin=function(t){t=t||e.jQuery,t&&(h=t,h.fn.imagesLoaded=function(e,t){var i=new o(this,e,t);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

/*
 * Nivo Lightbox v1.3.1
 * http://dev7studios.com/nivo-lightbox
 *
 * Copyright 2013, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
!function(t,i,o,e){function n(i,o){this.el=i,this.$el=t(this.el),this.options=t.extend({},l,o),this._defaults=l,this._name=a,this.init()}var a="nivoLightbox",l={effect:"fade",theme:"default",keyboardNav:!0,clickImgToClose:!1,clickOverlayToClose:!0,onInit:function(){},beforeShowLightbox:function(){},afterShowLightbox:function(t){},beforeHideLightbox:function(){},afterHideLightbox:function(){},beforePrev:function(t){},onPrev:function(t){},beforeNext:function(t){},onNext:function(t){},errorMessage:"The requested content cannot be loaded. Please try again later."};n.prototype={init:function(){var i=this;t("html").hasClass("nivo-lightbox-notouch")||t("html").addClass("nivo-lightbox-notouch"),"ontouchstart"in o&&t("html").removeClass("nivo-lightbox-notouch"),this.$el.on("click",function(t){i.showLightbox(t)}),this.options.keyboardNav&&t("body").off("keyup").on("keyup",function(o){var e=o.keyCode?o.keyCode:o.which;27==e&&i.destructLightbox(),37==e&&t(".nivo-lightbox-prev").trigger("click"),39==e&&t(".nivo-lightbox-next").trigger("click")}),this.options.onInit.call(this)},showLightbox:function(i){var o=this,e=this.$el,n=this.checkContent(e);if(n){i.preventDefault(),this.options.beforeShowLightbox.call(this);var a=this.constructLightbox();if(a){var l=a.find(".nivo-lightbox-content");if(l){if(t("body").addClass("nivo-lightbox-body-effect-"+this.options.effect),this.processContent(l,e),this.$el.attr("data-lightbox-gallery")){var h=t('[data-lightbox-gallery="'+this.$el.attr("data-lightbox-gallery")+'"]');t(".nivo-lightbox-nav").show(),t(".nivo-lightbox-prev").off("click").on("click",function(i){i.preventDefault();var n=h.index(e);e=h.eq(n-1),t(e).length||(e=h.last()),t.when(o.options.beforePrev.call(this,[e])).done(function(){o.processContent(l,e),o.options.onPrev.call(this,[e])})}),t(".nivo-lightbox-next").off("click").on("click",function(i){i.preventDefault();var n=h.index(e);e=h.eq(n+1),t(e).length||(e=h.first()),t.when(o.options.beforeNext.call(this,[e])).done(function(){o.processContent(l,e),o.options.onNext.call(this,[e])})})}setTimeout(function(){a.addClass("nivo-lightbox-open"),o.options.afterShowLightbox.call(this,[a])},1)}}}},checkContent:function(t){var i=t.attr("href"),o=i.match(/(youtube|youtube-nocookie|youtu|vimeo)\.(com|be)\/(watch\?v=([\w-]+)|([\w-]+))/);return null!==i.match(/\.(jpeg|jpg|gif|png)$/i)||(!!o||("ajax"==t.attr("data-lightbox-type")||("#"==i.substring(0,1)&&"inline"==t.attr("data-lightbox-type")||"iframe"==t.attr("data-lightbox-type"))))},processContent:function(o,e){var n=this,a=e.attr("href"),l=a.match(/(youtube|youtube-nocookie|youtu|vimeo)\.(com|be)\/(watch\?v=([\w-]+)|([\w-]+))/);if(o.html("").addClass("nivo-lightbox-loading"),this.isHidpi()&&e.attr("data-lightbox-hidpi")&&(a=e.attr("data-lightbox-hidpi")),null!==a.match(/\.(jpeg|jpg|gif|png)$/i)){var h=t("<img>",{src:a,class:"nivo-lightbox-image-display"});h.one("load",function(){var e=t('<div class="nivo-lightbox-image" />');e.append(h),o.html(e).removeClass("nivo-lightbox-loading"),e.css({"line-height":t(".nivo-lightbox-content").height()+"px",height:t(".nivo-lightbox-content").height()+"px"}),t(i).resize(function(){e.css({"line-height":t(".nivo-lightbox-content").height()+"px",height:t(".nivo-lightbox-content").height()+"px"})})}).each(function(){this.complete&&t(this).load()}),h.error(function(){var i=t('<div class="nivo-lightbox-error"><p>'+n.options.errorMessage+"</p></div>");o.html(i).removeClass("nivo-lightbox-loading")})}else if(l){var s="",r="nivo-lightbox-video";if("youtube"==l[1]&&(s="//www.youtube.com/embed/"+l[4],r="nivo-lightbox-youtube"),"youtube-nocookie"==l[1]&&(s=a,r="nivo-lightbox-youtube"),"youtu"==l[1]&&(s="//www.youtube.com/embed/"+l[3],r="nivo-lightbox-youtube"),"vimeo"==l[1]&&(s="//player.vimeo.com/video/"+l[3],r="nivo-lightbox-vimeo"),s){var c=t("<iframe>",{src:s,class:r,frameborder:0,vspace:0,hspace:0,scrolling:"auto"});o.html(c),c.load(function(){o.removeClass("nivo-lightbox-loading")})}}else if("ajax"==e.attr("data-lightbox-type"))t.ajax({url:a,cache:!1,success:function(e){var n=t('<div class="nivo-lightbox-ajax" />');n.append(e),o.html(n).removeClass("nivo-lightbox-loading"),n.outerHeight()<o.height()&&n.css({position:"relative",top:"50%","margin-top":-(n.outerHeight()/2)+"px"}),t(i).resize(function(){n.outerHeight()<o.height()&&n.css({position:"relative",top:"50%","margin-top":-(n.outerHeight()/2)+"px"})})},error:function(){var i=t('<div class="nivo-lightbox-error"><p>'+n.options.errorMessage+"</p></div>");o.html(i).removeClass("nivo-lightbox-loading")}});else if("#"==a.substring(0,1)&&"inline"==e.attr("data-lightbox-type"))if(t(a).length){var g=t('<div class="nivo-lightbox-inline" />');g.append(t(a).clone().show()),o.html(g).removeClass("nivo-lightbox-loading"),g.outerHeight()<o.height()&&g.css({position:"relative",top:"50%","margin-top":-(g.outerHeight()/2)+"px"}),t(i).resize(function(){g.outerHeight()<o.height()&&g.css({position:"relative",top:"50%","margin-top":-(g.outerHeight()/2)+"px"})})}else{var v=t('<div class="nivo-lightbox-error"><p>'+n.options.errorMessage+"</p></div>");o.html(v).removeClass("nivo-lightbox-loading")}else{if("iframe"!=e.attr("data-lightbox-type"))return!1;var b=t("<iframe>",{src:a,class:"nivo-lightbox-item",frameborder:0,vspace:0,hspace:0,scrolling:"auto"});o.html(b),b.load(function(){o.removeClass("nivo-lightbox-loading")})}if(e.attr("title")){var x=t("<span>",{class:"nivo-lightbox-title"});x.text(e.attr("title")),t(".nivo-lightbox-title-wrap").html(x)}else t(".nivo-lightbox-title-wrap").html("")},constructLightbox:function(){if(t(".nivo-lightbox-overlay").length)return t(".nivo-lightbox-overlay");var i=t("<div>",{class:"nivo-lightbox-overlay nivo-lightbox-theme-"+this.options.theme+" nivo-lightbox-effect-"+this.options.effect}),o=t("<div>",{class:"nivo-lightbox-wrap"}),e=t("<div>",{class:"nivo-lightbox-content"}),n=t('<a href="#" class="nivo-lightbox-nav nivo-lightbox-prev">Previous</a><a href="#" class="nivo-lightbox-nav nivo-lightbox-next">Next</a>'),a=t('<a href="#" class="nivo-lightbox-close" title="Close">Close</a>'),l=t("<div>",{class:"nivo-lightbox-title-wrap"}),h=/*@cc_on!@*/0;h&&i.addClass("nivo-lightbox-ie"),o.append(e),o.append(l),i.append(o),i.append(n),i.append(a),t("body").append(i);var s=this;return s.options.clickOverlayToClose&&i.on("click",function(i){(i.target===this||t(i.target).hasClass("nivo-lightbox-content")||t(i.target).hasClass("nivo-lightbox-image"))&&s.destructLightbox()}),s.options.clickImgToClose&&i.on("click",function(i){(i.target===this||t(i.target).hasClass("nivo-lightbox-image-display"))&&s.destructLightbox()}),a.on("click",function(t){t.preventDefault(),s.destructLightbox()}),i},destructLightbox:function(){var i=this;this.options.beforeHideLightbox.call(this),t(".nivo-lightbox-overlay").removeClass("nivo-lightbox-open"),t(".nivo-lightbox-nav").hide(),t("body").removeClass("nivo-lightbox-body-effect-"+i.options.effect);var o=/*@cc_on!@*/0;o&&(t(".nivo-lightbox-overlay iframe").attr("src"," "),t(".nivo-lightbox-overlay iframe").remove()),t(".nivo-lightbox-prev").off("click"),t(".nivo-lightbox-next").off("click"),t(".nivo-lightbox-content").empty(),this.options.afterHideLightbox.call(this)},isHidpi:function(){var t="(-webkit-min-device-pixel-ratio: 1.5),                              (min--moz-device-pixel-ratio: 1.5),                              (-o-min-device-pixel-ratio: 3/2),                              (min-resolution: 1.5dppx)";return i.devicePixelRatio>1||!(!i.matchMedia||!i.matchMedia(t).matches)}},t.fn[a]=function(i){return this.each(function(){t.data(this,a)||t.data(this,a,new n(this,i))})}}(jQuery,window,document);

/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
!function(a,b,c,d){function e(b,c){this.settings=null,this.options=a.extend({},e.Defaults,c),this.$element=a(b),this._handlers={},this._plugins={},this._supress={},this._current=null,this._speed=null,this._coordinates=[],this._breakpoint=null,this._width=null,this._items=[],this._clones=[],this._mergers=[],this._widths=[],this._invalidated={},this._pipe=[],this._drag={time:null,target:null,pointer:null,stage:{start:null,current:null},direction:null},this._states={current:{},tags:{initializing:["busy"],animating:["busy"],dragging:["interacting"]}},a.each(["onResize","onThrottledResize"],a.proxy(function(b,c){this._handlers[c]=a.proxy(this[c],this)},this)),a.each(e.Plugins,a.proxy(function(a,b){this._plugins[a.charAt(0).toLowerCase()+a.slice(1)]=new b(this)},this)),a.each(e.Workers,a.proxy(function(b,c){this._pipe.push({filter:c.filter,run:a.proxy(c.run,this)})},this)),this.setup(),this.initialize()}e.Defaults={items:3,loop:!1,center:!1,rewind:!1,checkVisibility:!0,mouseDrag:!0,touchDrag:!0,pullDrag:!0,freeDrag:!1,margin:0,stagePadding:0,merge:!1,mergeFit:!0,autoWidth:!1,startPosition:0,rtl:!1,smartSpeed:250,fluidSpeed:!1,dragEndSpeed:!1,responsive:{},responsiveRefreshRate:200,responsiveBaseElement:b,fallbackEasing:"swing",slideTransition:"",info:!1,nestedItemSelector:!1,itemElement:"div",stageElement:"div",refreshClass:"pagelayer-owl-refresh",loadedClass:"pagelayer-owl-loaded",loadingClass:"pagelayer-owl-loading",rtlClass:"pagelayer-owl-rtl",responsiveClass:"pagelayer-owl-responsive",dragClass:"pagelayer-owl-drag",itemClass:"pagelayer-owl-item",stageClass:"pagelayer-owl-stage",stageOuterClass:"pagelayer-owl-stage-outer",grabClass:"pagelayer-owl-grab"},e.Width={Default:"default",Inner:"inner",Outer:"outer"},e.Type={Event:"event",State:"state"},e.Plugins={},e.Workers=[{filter:["width","settings"],run:function(){this._width=this.$element.width()}},{filter:["width","items","settings"],run:function(a){a.current=this._items&&this._items[this.relative(this._current)]}},{filter:["items","settings"],run:function(){this.$stage.children(".cloned").remove()}},{filter:["width","items","settings"],run:function(a){var b=this.settings.margin||"",c=!this.settings.autoWidth,d=this.settings.rtl,e={width:"auto","margin-left":d?b:"","margin-right":d?"":b};!c&&this.$stage.children().css(e),a.css=e}},{filter:["width","items","settings"],run:function(a){var b=(this.width()/this.settings.items).toFixed(3)-this.settings.margin,c=null,d=this._items.length,e=!this.settings.autoWidth,f=[];for(a.items={merge:!1,width:b};d--;)c=this._mergers[d],c=this.settings.mergeFit&&Math.min(c,this.settings.items)||c,a.items.merge=c>1||a.items.merge,f[d]=e?b*c:this._items[d].width();this._widths=f}},{filter:["items","settings"],run:function(){var b=[],c=this._items,d=this.settings,e=Math.max(2*d.items,4),f=2*Math.ceil(c.length/2),g=d.loop&&c.length?d.rewind?e:Math.max(e,f):0,h="",i="";for(g/=2;g>0;)b.push(this.normalize(b.length/2,!0)),h+=c[b[b.length-1]][0].outerHTML,b.push(this.normalize(c.length-1-(b.length-1)/2,!0)),i=c[b[b.length-1]][0].outerHTML+i,g-=1;this._clones=b,a(h).addClass("cloned").appendTo(this.$stage),a(i).addClass("cloned").prependTo(this.$stage)}},{filter:["width","items","settings"],run:function(){for(var a=this.settings.rtl?1:-1,b=this._clones.length+this._items.length,c=-1,d=0,e=0,f=[];++c<b;)d=f[c-1]||0,e=this._widths[this.relative(c)]+this.settings.margin,f.push(d+e*a);this._coordinates=f}},{filter:["width","items","settings"],run:function(){var a=this.settings.stagePadding,b=this._coordinates,c={width:Math.ceil(Math.abs(b[b.length-1]))+2*a,"padding-left":a||"","padding-right":a||""};this.$stage.css(c)}},{filter:["width","items","settings"],run:function(a){var b=this._coordinates.length,c=!this.settings.autoWidth,d=this.$stage.children();if(c&&a.items.merge)for(;b--;)a.css.width=this._widths[this.relative(b)],d.eq(b).css(a.css);else c&&(a.css.width=a.items.width,d.css(a.css))}},{filter:["items"],run:function(){this._coordinates.length<1&&this.$stage.removeAttr("style")}},{filter:["width","items","settings"],run:function(a){a.current=a.current?this.$stage.children().index(a.current):0,a.current=Math.max(this.minimum(),Math.min(this.maximum(),a.current)),this.reset(a.current)}},{filter:["position"],run:function(){this.animate(this.coordinates(this._current))}},{filter:["width","position","items","settings"],run:function(){var a,b,c,d,e=this.settings.rtl?1:-1,f=2*this.settings.stagePadding,g=this.coordinates(this.current())+f,h=g+this.width()*e,i=[];for(c=0,d=this._coordinates.length;c<d;c++)a=this._coordinates[c-1]||0,b=Math.abs(this._coordinates[c])+f*e,(this.op(a,"<=",g)&&this.op(a,">",h)||this.op(b,"<",g)&&this.op(b,">",h))&&i.push(c);this.$stage.children(".active").removeClass("active"),this.$stage.children(":eq("+i.join("), :eq(")+")").addClass("active"),this.$stage.children(".center").removeClass("center"),this.settings.center&&this.$stage.children().eq(this.current()).addClass("center")}}],e.prototype.initializeStage=function(){this.$stage=this.$element.find("."+this.settings.stageClass),this.$stage.length||(this.$element.addClass(this.options.loadingClass),this.$stage=a("<"+this.settings.stageElement+">",{class:this.settings.stageClass}).wrap(a("<div/>",{class:this.settings.stageOuterClass})),this.$element.append(this.$stage.parent()))},e.prototype.initializeItems=function(){var b=this.$element.find(".pagelayer-owl-item");if(b.length)return this._items=b.get().map(function(b){return a(b)}),this._mergers=this._items.map(function(){return 1}),void this.refresh();this.replace(this.$element.children().not(this.$stage.parent())),this.isVisible()?this.refresh():this.invalidate("width"),this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass)},e.prototype.initialize=function(){if(this.enter("initializing"),this.trigger("initialize"),this.$element.toggleClass(this.settings.rtlClass,this.settings.rtl),this.settings.autoWidth&&!this.is("pre-loading")){var a,b,c;a=this.$element.find("img"),b=this.settings.nestedItemSelector?"."+this.settings.nestedItemSelector:d,c=this.$element.children(b).width(),a.length&&c<=0&&this.preloadAutoWidthImages(a)}this.initializeStage(),this.initializeItems(),this.registerEventHandlers(),this.leave("initializing"),this.trigger("initialized")},e.prototype.isVisible=function(){return!this.settings.checkVisibility||this.$element.is(":visible")},e.prototype.setup=function(){var b=this.viewport(),c=this.options.responsive,d=-1,e=null;c?(a.each(c,function(a){a<=b&&a>d&&(d=Number(a))}),e=a.extend({},this.options,c[d]),"function"==typeof e.stagePadding&&(e.stagePadding=e.stagePadding()),delete e.responsive,e.responsiveClass&&this.$element.attr("class",this.$element.attr("class").replace(new RegExp("("+this.options.responsiveClass+"-)\\S+\\s","g"),"$1"+d))):e=a.extend({},this.options),this.trigger("change",{property:{name:"settings",value:e}}),this._breakpoint=d,this.settings=e,this.invalidate("settings"),this.trigger("changed",{property:{name:"settings",value:this.settings}})},e.prototype.optionsLogic=function(){this.settings.autoWidth&&(this.settings.stagePadding=!1,this.settings.merge=!1)},e.prototype.prepare=function(b){var c=this.trigger("prepare",{content:b});return c.data||(c.data=a("<"+this.settings.itemElement+"/>").addClass(this.options.itemClass).append(b)),this.trigger("prepared",{content:c.data}),c.data},e.prototype.update=function(){for(var b=0,c=this._pipe.length,d=a.proxy(function(a){return this[a]},this._invalidated),e={};b<c;)(this._invalidated.all||a.grep(this._pipe[b].filter,d).length>0)&&this._pipe[b].run(e),b++;this._invalidated={},!this.is("valid")&&this.enter("valid")},e.prototype.width=function(a){switch(a=a||e.Width.Default){case e.Width.Inner:case e.Width.Outer:return this._width;default:return this._width-2*this.settings.stagePadding+this.settings.margin}},e.prototype.refresh=function(){this.enter("refreshing"),this.trigger("refresh"),this.setup(),this.optionsLogic(),this.$element.addClass(this.options.refreshClass),this.update(),this.$element.removeClass(this.options.refreshClass),this.leave("refreshing"),this.trigger("refreshed")},e.prototype.onThrottledResize=function(){b.clearTimeout(this.resizeTimer),this.resizeTimer=b.setTimeout(this._handlers.onResize,this.settings.responsiveRefreshRate)},e.prototype.onResize=function(){return!!this._items.length&&(this._width!==this.$element.width()&&(!!this.isVisible()&&(this.enter("resizing"),this.trigger("resize").isDefaultPrevented()?(this.leave("resizing"),!1):(this.invalidate("width"),this.refresh(),this.leave("resizing"),void this.trigger("resized")))))},e.prototype.registerEventHandlers=function(){a.support.transition&&this.$stage.on(a.support.transition.end+".owl.core",a.proxy(this.onTransitionEnd,this)),!1!==this.settings.responsive&&this.on(b,"resize",this._handlers.onThrottledResize),this.settings.mouseDrag&&(this.$element.addClass(this.options.dragClass),this.$stage.on("mousedown.owl.core",a.proxy(this.onDragStart,this)),this.$stage.on("dragstart.owl.core selectstart.owl.core",function(){return!1})),this.settings.touchDrag&&(this.$stage.on("touchstart.owl.core",a.proxy(this.onDragStart,this)),this.$stage.on("touchcancel.owl.core",a.proxy(this.onDragEnd,this)))},e.prototype.onDragStart=function(b){var d=null;3!==b.which&&(a.support.transform?(d=this.$stage.css("transform").replace(/.*\(|\)| /g,"").split(","),d={x:d[16===d.length?12:4],y:d[16===d.length?13:5]}):(d=this.$stage.position(),d={x:this.settings.rtl?d.left+this.$stage.width()-this.width()+this.settings.margin:d.left,y:d.top}),this.is("animating")&&(a.support.transform?this.animate(d.x):this.$stage.stop(),this.invalidate("position")),this.$element.toggleClass(this.options.grabClass,"mousedown"===b.type),this.speed(0),this._drag.time=(new Date).getTime(),this._drag.target=a(b.target),this._drag.stage.start=d,this._drag.stage.current=d,this._drag.pointer=this.pointer(b),a(c).on("mouseup.owl.core touchend.owl.core",a.proxy(this.onDragEnd,this)),a(c).one("mousemove.owl.core touchmove.owl.core",a.proxy(function(b){var d=this.difference(this._drag.pointer,this.pointer(b));a(c).on("mousemove.owl.core touchmove.owl.core",a.proxy(this.onDragMove,this)),Math.abs(d.x)<Math.abs(d.y)&&this.is("valid")||(b.preventDefault(),this.enter("dragging"),this.trigger("drag"))},this)))},e.prototype.onDragMove=function(a){var b=null,c=null,d=null,e=this.difference(this._drag.pointer,this.pointer(a)),f=this.difference(this._drag.stage.start,e);this.is("dragging")&&(a.preventDefault(),this.settings.loop?(b=this.coordinates(this.minimum()),c=this.coordinates(this.maximum()+1)-b,f.x=((f.x-b)%c+c)%c+b):(b=this.settings.rtl?this.coordinates(this.maximum()):this.coordinates(this.minimum()),c=this.settings.rtl?this.coordinates(this.minimum()):this.coordinates(this.maximum()),d=this.settings.pullDrag?-1*e.x/5:0,f.x=Math.max(Math.min(f.x,b+d),c+d)),this._drag.stage.current=f,this.animate(f.x))},e.prototype.onDragEnd=function(b){var d=this.difference(this._drag.pointer,this.pointer(b)),e=this._drag.stage.current,f=d.x>0^this.settings.rtl?"left":"right";a(c).off(".owl.core"),this.$element.removeClass(this.options.grabClass),(0!==d.x&&this.is("dragging")||!this.is("valid"))&&(this.speed(this.settings.dragEndSpeed||this.settings.smartSpeed),this.current(this.closest(e.x,0!==d.x?f:this._drag.direction)),this.invalidate("position"),this.update(),this._drag.direction=f,(Math.abs(d.x)>3||(new Date).getTime()-this._drag.time>300)&&this._drag.target.one("click.owl.core",function(){return!1})),this.is("dragging")&&(this.leave("dragging"),this.trigger("dragged"))},e.prototype.closest=function(b,c){var e=-1,f=30,g=this.width(),h=this.coordinates();return this.settings.freeDrag||a.each(h,a.proxy(function(a,i){return"left"===c&&b>i-f&&b<i+f?e=a:"right"===c&&b>i-g-f&&b<i-g+f?e=a+1:this.op(b,"<",i)&&this.op(b,">",h[a+1]!==d?h[a+1]:i-g)&&(e="left"===c?a+1:a),-1===e},this)),this.settings.loop||(this.op(b,">",h[this.minimum()])?e=b=this.minimum():this.op(b,"<",h[this.maximum()])&&(e=b=this.maximum())),e},e.prototype.animate=function(b){var c=this.speed()>0;this.is("animating")&&this.onTransitionEnd(),c&&(this.enter("animating"),this.trigger("translate")),a.support.transform3d&&a.support.transition?this.$stage.css({transform:"translate3d("+b+"px,0px,0px)",transition:this.speed()/1e3+"s"+(this.settings.slideTransition?" "+this.settings.slideTransition:"")}):c?this.$stage.animate({left:b+"px"},this.speed(),this.settings.fallbackEasing,a.proxy(this.onTransitionEnd,this)):this.$stage.css({left:b+"px"})},e.prototype.is=function(a){return this._states.current[a]&&this._states.current[a]>0},e.prototype.current=function(a){if(a===d)return this._current;if(0===this._items.length)return d;if(a=this.normalize(a),this._current!==a){var b=this.trigger("change",{property:{name:"position",value:a}});b.data!==d&&(a=this.normalize(b.data)),this._current=a,this.invalidate("position"),this.trigger("changed",{property:{name:"position",value:this._current}})}return this._current},e.prototype.invalidate=function(b){return"string"===a.type(b)&&(this._invalidated[b]=!0,this.is("valid")&&this.leave("valid")),a.map(this._invalidated,function(a,b){return b})},e.prototype.reset=function(a){(a=this.normalize(a))!==d&&(this._speed=0,this._current=a,this.suppress(["translate","translated"]),this.animate(this.coordinates(a)),this.release(["translate","translated"]))},e.prototype.normalize=function(a,b){var c=this._items.length,e=b?0:this._clones.length;return!this.isNumeric(a)||c<1?a=d:(a<0||a>=c+e)&&(a=((a-e/2)%c+c)%c+e/2),a},e.prototype.relative=function(a){return a-=this._clones.length/2,this.normalize(a,!0)},e.prototype.maximum=function(a){var b,c,d,e=this.settings,f=this._coordinates.length;if(e.loop)f=this._clones.length/2+this._items.length-1;else if(e.autoWidth||e.merge){if(b=this._items.length)for(c=this._items[--b].width(),d=this.$element.width();b--&&!((c+=this._items[b].width()+this.settings.margin)>d););f=b+1}else f=e.center?this._items.length-1:this._items.length-e.items;return a&&(f-=this._clones.length/2),Math.max(f,0)},e.prototype.minimum=function(a){return a?0:this._clones.length/2},e.prototype.items=function(a){return a===d?this._items.slice():(a=this.normalize(a,!0),this._items[a])},e.prototype.mergers=function(a){return a===d?this._mergers.slice():(a=this.normalize(a,!0),this._mergers[a])},e.prototype.clones=function(b){var c=this._clones.length/2,e=c+this._items.length,f=function(a){return a%2==0?e+a/2:c-(a+1)/2};return b===d?a.map(this._clones,function(a,b){return f(b)}):a.map(this._clones,function(a,c){return a===b?f(c):null})},e.prototype.speed=function(a){return a!==d&&(this._speed=a),this._speed},e.prototype.coordinates=function(b){var c,e=1,f=b-1;return b===d?a.map(this._coordinates,a.proxy(function(a,b){return this.coordinates(b)},this)):(this.settings.center?(this.settings.rtl&&(e=-1,f=b+1),c=this._coordinates[b],c+=(this.width()-c+(this._coordinates[f]||0))/2*e):c=this._coordinates[f]||0,c=Math.ceil(c))},e.prototype.duration=function(a,b,c){return 0===c?0:Math.min(Math.max(Math.abs(b-a),1),6)*Math.abs(c||this.settings.smartSpeed)},e.prototype.to=function(a,b){var c=this.current(),d=null,e=a-this.relative(c),f=(e>0)-(e<0),g=this._items.length,h=this.minimum(),i=this.maximum();this.settings.loop?(!this.settings.rewind&&Math.abs(e)>g/2&&(e+=-1*f*g),a=c+e,(d=((a-h)%g+g)%g+h)!==a&&d-e<=i&&d-e>0&&(c=d-e,a=d,this.reset(c))):this.settings.rewind?(i+=1,a=(a%i+i)%i):a=Math.max(h,Math.min(i,a)),this.speed(this.duration(c,a,b)),this.current(a),this.isVisible()&&this.update()},e.prototype.next=function(a){a=a||!1,this.to(this.relative(this.current())+1,a)},e.prototype.prev=function(a){a=a||!1,this.to(this.relative(this.current())-1,a)},e.prototype.onTransitionEnd=function(a){if(a!==d&&(a.stopPropagation(),(a.target||a.srcElement||a.originalTarget)!==this.$stage.get(0)))return!1;this.leave("animating"),this.trigger("translated")},e.prototype.viewport=function(){var d;return this.options.responsiveBaseElement!==b?d=a(this.options.responsiveBaseElement).width():b.innerWidth?d=b.innerWidth:c.documentElement&&c.documentElement.clientWidth?d=c.documentElement.clientWidth:console.warn("Can not detect viewport width."),d},e.prototype.replace=function(b){this.$stage.empty(),this._items=[],b&&(b=b instanceof jQuery?b:a(b)),this.settings.nestedItemSelector&&(b=b.find("."+this.settings.nestedItemSelector)),b.filter(function(){return 1===this.nodeType}).each(a.proxy(function(a,b){b=this.prepare(b),this.$stage.append(b),this._items.push(b),this._mergers.push(1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)},this)),this.reset(this.isNumeric(this.settings.startPosition)?this.settings.startPosition:0),this.invalidate("items")},e.prototype.add=function(b,c){var e=this.relative(this._current);c=c===d?this._items.length:this.normalize(c,!0),b=b instanceof jQuery?b:a(b),this.trigger("add",{content:b,position:c}),b=this.prepare(b),0===this._items.length||c===this._items.length?(0===this._items.length&&this.$stage.append(b),0!==this._items.length&&this._items[c-1].after(b),this._items.push(b),this._mergers.push(1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)):(this._items[c].before(b),this._items.splice(c,0,b),this._mergers.splice(c,0,1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)),this._items[e]&&this.reset(this._items[e].index()),this.invalidate("items"),this.trigger("added",{content:b,position:c})},e.prototype.remove=function(a){(a=this.normalize(a,!0))!==d&&(this.trigger("remove",{content:this._items[a],position:a}),this._items[a].remove(),this._items.splice(a,1),this._mergers.splice(a,1),this.invalidate("items"),this.trigger("removed",{content:null,position:a}))},e.prototype.preloadAutoWidthImages=function(b){b.each(a.proxy(function(b,c){this.enter("pre-loading"),c=a(c),a(new Image).one("load",a.proxy(function(a){c.attr("src",a.target.src),c.css("opacity",1),this.leave("pre-loading"),!this.is("pre-loading")&&!this.is("initializing")&&this.refresh()},this)).attr("src",c.attr("src")||c.attr("data-src")||c.attr("data-src-retina"))},this))},e.prototype.destroy=function(){this.$element.off(".owl.core"),this.$stage.off(".owl.core"),a(c).off(".owl.core"),!1!==this.settings.responsive&&(b.clearTimeout(this.resizeTimer),this.off(b,"resize",this._handlers.onThrottledResize));for(var d in this._plugins)this._plugins[d].destroy();this.$stage.children(".cloned").remove(),this.$stage.unwrap(),this.$stage.children().contents().unwrap(),this.$stage.children().unwrap(),this.$stage.remove(),this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class",this.$element.attr("class").replace(new RegExp(this.options.responsiveClass+"-\\S+\\s","g"),"")).removeData("owl.carousel")},e.prototype.op=function(a,b,c){var d=this.settings.rtl;switch(b){case"<":return d?a>c:a<c;case">":return d?a<c:a>c;case">=":return d?a<=c:a>=c;case"<=":return d?a>=c:a<=c}},e.prototype.on=function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d):a.attachEvent&&a.attachEvent("on"+b,c)},e.prototype.off=function(a,b,c,d){a.removeEventListener?a.removeEventListener(b,c,d):a.detachEvent&&a.detachEvent("on"+b,c)},e.prototype.trigger=function(b,c,d,f,g){var h={item:{count:this._items.length,index:this.current()}},i=a.camelCase(a.grep(["on",b,d],function(a){return a}).join("-").toLowerCase()),j=a.Event([b,"owl",d||"carousel"].join(".").toLowerCase(),a.extend({relatedTarget:this},h,c));return this._supress[b]||(a.each(this._plugins,function(a,b){b.onTrigger&&b.onTrigger(j)}),this.register({type:e.Type.Event,name:b}),this.$element.trigger(j),this.settings&&"function"==typeof this.settings[i]&&this.settings[i].call(this,j)),j},e.prototype.enter=function(b){a.each([b].concat(this._states.tags[b]||[]),a.proxy(function(a,b){this._states.current[b]===d&&(this._states.current[b]=0),this._states.current[b]++},this))},e.prototype.leave=function(b){a.each([b].concat(this._states.tags[b]||[]),a.proxy(function(a,b){this._states.current[b]--},this))},e.prototype.register=function(b){if(b.type===e.Type.Event){if(a.event.special[b.name]||(a.event.special[b.name]={}),!a.event.special[b.name].owl){var c=a.event.special[b.name]._default;a.event.special[b.name]._default=function(a){return!c||!c.apply||a.namespace&&-1!==a.namespace.indexOf("owl")?a.namespace&&a.namespace.indexOf("owl")>-1:c.apply(this,arguments)},a.event.special[b.name].owl=!0}}else b.type===e.Type.State&&(this._states.tags[b.name]?this._states.tags[b.name]=this._states.tags[b.name].concat(b.tags):this._states.tags[b.name]=b.tags,this._states.tags[b.name]=a.grep(this._states.tags[b.name],a.proxy(function(c,d){return a.inArray(c,this._states.tags[b.name])===d},this)))},e.prototype.suppress=function(b){a.each(b,a.proxy(function(a,b){this._supress[b]=!0},this))},e.prototype.release=function(b){a.each(b,a.proxy(function(a,b){delete this._supress[b]},this))},e.prototype.pointer=function(a){var c={x:null,y:null};return a=a.originalEvent||a||b.event,a=a.touches&&a.touches.length?a.touches[0]:a.changedTouches&&a.changedTouches.length?a.changedTouches[0]:a,a.pageX?(c.x=a.pageX,c.y=a.pageY):(c.x=a.clientX,c.y=a.clientY),c},e.prototype.isNumeric=function(a){return!isNaN(parseFloat(a))},e.prototype.difference=function(a,b){return{x:a.x-b.x,y:a.y-b.y}},a.fn.pagelayerOwlCarousel=function(b){var c=Array.prototype.slice.call(arguments,1);return this.each(function(){var d=a(this),f=d.data("owl.carousel");f||(f=new e(this,"object"==typeof b&&b),d.data("owl.carousel",f),a.each(["next","prev","to","destroy","refresh","replace","add","remove"],function(b,c){f.register({type:e.Type.Event,name:c}),f.$element.on(c+".owl.carousel.core",a.proxy(function(a){a.namespace&&a.relatedTarget!==this&&(this.suppress([c]),f[c].apply(this,[].slice.call(arguments,1)),this.release([c]))},f))})),"string"==typeof b&&"_"!==b.charAt(0)&&f[b].apply(f,c)})},a.fn.pagelayerOwlCarousel.Constructor=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._interval=null,this._visible=null,this._handlers={"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoRefresh&&this.watch()},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers)};e.Defaults={autoRefresh:!0,autoRefreshInterval:500},e.prototype.watch=function(){this._interval||(this._visible=this._core.isVisible(),this._interval=b.setInterval(a.proxy(this.refresh,this),this._core.settings.autoRefreshInterval))},e.prototype.refresh=function(){this._core.isVisible()!==this._visible&&(this._visible=!this._visible,this._core.$element.toggleClass("pagelayer-owl-hidden",!this._visible),this._visible&&this._core.invalidate("width")&&this._core.refresh())},e.prototype.destroy=function(){var a,c;b.clearInterval(this._interval);for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.AutoRefresh=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._loaded=[],this._handlers={"initialized.owl.carousel change.owl.carousel resized.owl.carousel":a.proxy(function(b){if(b.namespace&&this._core.settings&&this._core.settings.lazyLoad&&(b.property&&"position"==b.property.name||"initialized"==b.type)){var c=this._core.settings,e=c.center&&Math.ceil(c.items/2)||c.items,f=c.center&&-1*e||0,g=(b.property&&b.property.value!==d?b.property.value:this._core.current())+f,h=this._core.clones().length,i=a.proxy(function(a,b){this.load(b)},this);for(c.lazyLoadEager>0&&(e+=c.lazyLoadEager,c.loop&&(g-=c.lazyLoadEager,e++));f++<e;)this.load(h/2+this._core.relative(g)),h&&a.each(this._core.clones(this._core.relative(g)),i),g++}},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers)};e.Defaults={lazyLoad:!1,lazyLoadEager:0},e.prototype.load=function(c){var d=this._core.$stage.children().eq(c),e=d&&d.find(".pagelayer-owl-lazy");!e||a.inArray(d.get(0),this._loaded)>-1||(e.each(a.proxy(function(c,d){var e,f=a(d),g=b.devicePixelRatio>1&&f.attr("data-src-retina")||f.attr("data-src")||f.attr("data-srcset");this._core.trigger("load",{element:f,url:g},"lazy"),f.is("img")?f.one("load.owl.lazy",a.proxy(function(){f.css("opacity",1),this._core.trigger("loaded",{element:f,url:g},"lazy")},this)).attr("src",g):f.is("source")?f.one("load.owl.lazy",a.proxy(function(){this._core.trigger("loaded",{element:f,url:g},"lazy")},this)).attr("srcset",g):(e=new Image,e.onload=a.proxy(function(){f.css({"background-image":'url("'+g+'")',opacity:"1"}),this._core.trigger("loaded",{element:f,url:g},"lazy")},this),e.src=g)},this)),this._loaded.push(d.get(0)))},e.prototype.destroy=function(){var a,b;for(a in this.handlers)this._core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.Lazy=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(c){this._core=c,this._previousHeight=null,this._handlers={"initialized.owl.carousel refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&this.update()},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&"position"===a.property.name&&this.update()},this),"loaded.owl.lazy":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&a.element.closest("."+this._core.settings.itemClass).index()===this._core.current()&&this.update()},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers),this._intervalId=null;var d=this;a(b).on("load",function(){d._core.settings.autoHeight&&d.update()}),a(b).resize(function(){d._core.settings.autoHeight&&(null!=d._intervalId&&clearTimeout(d._intervalId),d._intervalId=setTimeout(function(){d.update()},250))})};e.Defaults={autoHeight:!1,autoHeightClass:"pagelayer-owl-height"},e.prototype.update=function(){var b=this._core._current,c=b+this._core.settings.items,d=this._core.settings.lazyLoad,e=this._core.$stage.children().toArray().slice(b,c),f=[],g=0;a.each(e,function(b,c){f.push(a(c).height())}),g=Math.max.apply(null,f),g<=1&&d&&this._previousHeight&&(g=this._previousHeight),this._previousHeight=g,this._core.$stage.parent().height(g).addClass(this._core.settings.autoHeightClass)},e.prototype.destroy=function(){var a,b;for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.AutoHeight=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._videos={},this._playing=null,this._handlers={"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.register({type:"state",name:"playing",tags:["interacting"]})},this),"resize.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.video&&this.isInFullScreen()&&a.preventDefault()},this),"refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.is("resizing")&&this._core.$stage.find(".cloned .pagelayer-owl-video-frame").remove()},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&"position"===a.property.name&&this._playing&&this.stop()},this),"prepared.owl.carousel":a.proxy(function(b){if(b.namespace){var c=a(b.content).find(".pagelayer-owl-video");c.length&&(c.css("display","none"),this.fetch(c,a(b.content)))}},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers),this._core.$element.on("click.owl.video",".pagelayer-owl-video-play-icon",a.proxy(function(a){this.play(a)},this))};e.Defaults={video:!1,videoHeight:!1,videoWidth:!1},e.prototype.fetch=function(a,b){var c=function(){return a.attr("data-vimeo-id")?"vimeo":a.attr("data-vzaar-id")?"vzaar":"youtube"}(),d=a.attr("data-vimeo-id")||a.attr("data-youtube-id")||a.attr("data-vzaar-id"),e=a.attr("data-width")||this._core.settings.videoWidth,f=a.attr("data-height")||this._core.settings.videoHeight,g=a.attr("href");if(!g)throw new Error("Missing video URL.");if(d=g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/),d[3].indexOf("youtu")>-1)c="youtube";else if(d[3].indexOf("vimeo")>-1)c="vimeo";else{if(!(d[3].indexOf("vzaar")>-1))throw new Error("Video URL not supported.");c="vzaar"}d=d[6],this._videos[g]={type:c,id:d,width:e,height:f},b.attr("data-video",g),this.thumbnail(a,this._videos[g])},e.prototype.thumbnail=function(b,c){var d,e,f,g=c.width&&c.height?"width:"+c.width+"px;height:"+c.height+"px;":"",h=b.find("img"),i="src",j="",k=this._core.settings,l=function(c){e='<div class="pagelayer-owl-video-play-icon"></div>',d=k.lazyLoad?a("<div/>",{class:"pagelayer-owl-video-tn "+j,srcType:c}):a("<div/>",{class:"pagelayer-owl-video-tn",style:"opacity:1;background-image:url("+c+")"}),b.after(d),b.after(e)};if(b.wrap(a("<div/>",{class:"pagelayer-owl-video-wrapper",style:g})),this._core.settings.lazyLoad&&(i="data-src",j="pagelayer-owl-lazy"),h.length)return l(h.attr(i)),h.remove(),!1;"youtube"===c.type?(f="//img.youtube.com/vi/"+c.id+"/hqdefault.jpg",l(f)):"vimeo"===c.type?a.ajax({type:"GET",url:"//vimeo.com/api/v2/video/"+c.id+".json",jsonp:"callback",dataType:"jsonp",success:function(a){f=a[0].thumbnail_large,l(f)}}):"vzaar"===c.type&&a.ajax({type:"GET",url:"//vzaar.com/api/videos/"+c.id+".json",jsonp:"callback",dataType:"jsonp",success:function(a){f=a.framegrab_url,l(f)}})},e.prototype.stop=function(){this._core.trigger("stop",null,"video"),this._playing.find(".pagelayer-owl-video-frame").remove(),this._playing.removeClass("pagelayer-owl-video-playing"),this._playing=null,this._core.leave("playing"),this._core.trigger("stopped",null,"video")},e.prototype.play=function(b){var c,d=a(b.target),e=d.closest("."+this._core.settings.itemClass),f=this._videos[e.attr("data-video")],g=f.width||"100%",h=f.height||this._core.$stage.height();this._playing||(this._core.enter("playing"),this._core.trigger("play",null,"video"),e=this._core.items(this._core.relative(e.index())),this._core.reset(e.index()),c=a('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>'),c.attr("height",h),c.attr("width",g),"youtube"===f.type?c.attr("src","//www.youtube.com/embed/"+f.id+"?autoplay=1&rel=0&v="+f.id):"vimeo"===f.type?c.attr("src","//player.vimeo.com/video/"+f.id+"?autoplay=1"):"vzaar"===f.type&&c.attr("src","//view.vzaar.com/"+f.id+"/player?autoplay=true"),a(c).wrap('<div class="pagelayer-owl-video-frame" />').insertAfter(e.find(".pagelayer-owl-video")),this._playing=e.addClass("pagelayer-owl-video-playing"))},e.prototype.isInFullScreen=function(){var b=c.fullscreenElement||c.mozFullScreenElement||c.webkitFullscreenElement;return b&&a(b).parent().hasClass("pagelayer-owl-video-frame")},e.prototype.destroy=function(){var a,b;this._core.$element.off("click.owl.video");for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.Video=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this.core=b,this.core.options=a.extend({},e.Defaults,this.core.options),this.swapping=!0,this.previous=d,this.next=d,this.handlers={"change.owl.carousel":a.proxy(function(a){a.namespace&&"position"==a.property.name&&(this.previous=this.core.current(),this.next=a.property.value)},this),"drag.owl.carousel dragged.owl.carousel translated.owl.carousel":a.proxy(function(a){a.namespace&&(this.swapping="translated"==a.type)},this),"translate.owl.carousel":a.proxy(function(a){a.namespace&&this.swapping&&(this.core.options.animateOut||this.core.options.animateIn)&&this.swap()},this)},this.core.$element.on(this.handlers)};e.Defaults={animateOut:!1,
animateIn:!1},e.prototype.swap=function(){if(1===this.core.settings.items&&a.support.animation&&a.support.transition){this.core.speed(0);var b,c=a.proxy(this.clear,this),d=this.core.$stage.children().eq(this.previous),e=this.core.$stage.children().eq(this.next),f=this.core.settings.animateIn,g=this.core.settings.animateOut;this.core.current()!==this.previous&&(g&&(b=this.core.coordinates(this.previous)-this.core.coordinates(this.next),d.one(a.support.animation.end,c).css({left:b+"px"}).addClass("animated pagelayer-owl-animated-out").addClass(g)),f&&e.one(a.support.animation.end,c).addClass("animated pagelayer-owl-animated-in").addClass(f))}},e.prototype.clear=function(b){a(b.target).css({left:""}).removeClass("animated pagelayer-owl-animated-out pagelayer-owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut),this.core.onTransitionEnd()},e.prototype.destroy=function(){var a,b;for(a in this.handlers)this.core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.Animate=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._call=null,this._time=0,this._timeout=0,this._paused=!0,this._handlers={"changed.owl.carousel":a.proxy(function(a){a.namespace&&"settings"===a.property.name?this._core.settings.autoplay?this.play():this.stop():a.namespace&&"position"===a.property.name&&this._paused&&(this._time=0)},this),"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoplay&&this.play()},this),"play.owl.autoplay":a.proxy(function(a,b,c){a.namespace&&this.play(b,c)},this),"stop.owl.autoplay":a.proxy(function(a){a.namespace&&this.stop()},this),"mouseover.owl.autoplay":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.pause()},this),"mouseleave.owl.autoplay":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.play()},this),"touchstart.owl.core":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.pause()},this),"touchend.owl.core":a.proxy(function(){this._core.settings.autoplayHoverPause&&this.play()},this)},this._core.$element.on(this._handlers),this._core.options=a.extend({},e.Defaults,this._core.options)};e.Defaults={autoplay:!1,autoplayTimeout:5e3,autoplayHoverPause:!1,autoplaySpeed:!1},e.prototype._next=function(d){this._call=b.setTimeout(a.proxy(this._next,this,d),this._timeout*(Math.round(this.read()/this._timeout)+1)-this.read()),this._core.is("interacting")||c.hidden||this._core.next(d||this._core.settings.autoplaySpeed)},e.prototype.read=function(){return(new Date).getTime()-this._time},e.prototype.play=function(c,d){var e;this._core.is("rotating")||this._core.enter("rotating"),c=c||this._core.settings.autoplayTimeout,e=Math.min(this._time%(this._timeout||c),c),this._paused?(this._time=this.read(),this._paused=!1):b.clearTimeout(this._call),this._time+=this.read()%c-e,this._timeout=c,this._call=b.setTimeout(a.proxy(this._next,this,d),c-e)},e.prototype.stop=function(){this._core.is("rotating")&&(this._time=0,this._paused=!0,b.clearTimeout(this._call),this._core.leave("rotating"))},e.prototype.pause=function(){this._core.is("rotating")&&!this._paused&&(this._time=this.read(),this._paused=!0,b.clearTimeout(this._call))},e.prototype.destroy=function(){var a,b;this.stop();for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.autoplay=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){"use strict";var e=function(b){this._core=b,this._initialized=!1,this._pages=[],this._controls={},this._templates=[],this.$element=this._core.$element,this._overrides={next:this._core.next,prev:this._core.prev,to:this._core.to},this._handlers={"prepared.owl.carousel":a.proxy(function(b){b.namespace&&this._core.settings.dotsData&&this._templates.push('<div class="'+this._core.settings.dotClass+'">'+a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot")+"</div>")},this),"added.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.dotsData&&this._templates.splice(a.position,0,this._templates.pop())},this),"remove.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.dotsData&&this._templates.splice(a.position,1)},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&"position"==a.property.name&&this.draw()},this),"initialized.owl.carousel":a.proxy(function(a){a.namespace&&!this._initialized&&(this._core.trigger("initialize",null,"navigation"),this.initialize(),this.update(),this.draw(),this._initialized=!0,this._core.trigger("initialized",null,"navigation"))},this),"refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._initialized&&(this._core.trigger("refresh",null,"navigation"),this.update(),this.draw(),this._core.trigger("refreshed",null,"navigation"))},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this.$element.on(this._handlers)};e.Defaults={nav:!1,navText:['<span aria-label="Previous">&#x2039;</span>','<span aria-label="Next">&#x203a;</span>'],navSpeed:!1,navElement:'button type="button" role="presentation"',navContainer:!1,navContainerClass:"pagelayer-owl-nav",navClass:["pagelayer-owl-prev","pagelayer-owl-next"],slideBy:1,dotClass:"pagelayer-owl-dot",dotsClass:"pagelayer-owl-dots",dots:!0,dotsEach:!1,dotsData:!1,dotsSpeed:!1,dotsContainer:!1},e.prototype.initialize=function(){var b,c=this._core.settings;this._controls.$relative=(c.navContainer?a(c.navContainer):a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"),this._controls.$previous=a("<"+c.navElement+">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click",a.proxy(function(a){this.prev(c.navSpeed)},this)),this._controls.$next=a("<"+c.navElement+">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click",a.proxy(function(a){this.next(c.navSpeed)},this)),c.dotsData||(this._templates=[a('<button role="button">').addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]),this._controls.$absolute=(c.dotsContainer?a(c.dotsContainer):a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"),this._controls.$absolute.on("click","button",a.proxy(function(b){var d=a(b.target).parent().is(this._controls.$absolute)?a(b.target).index():a(b.target).parent().index();b.preventDefault(),this.to(d,c.dotsSpeed)},this));for(b in this._overrides)this._core[b]=a.proxy(this[b],this)},e.prototype.destroy=function(){var a,b,c,d,e;e=this._core.settings;for(a in this._handlers)this.$element.off(a,this._handlers[a]);for(b in this._controls)"$relative"===b&&e.navContainer?this._controls[b].html(""):this._controls[b].remove();for(d in this.overides)this._core[d]=this._overrides[d];for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},e.prototype.update=function(){var a,b,c,d=this._core.clones().length/2,e=d+this._core.items().length,f=this._core.maximum(!0),g=this._core.settings,h=g.center||g.autoWidth||g.dotsData?1:g.dotsEach||g.items;if("page"!==g.slideBy&&(g.slideBy=Math.min(g.slideBy,g.items)),g.dots||"page"==g.slideBy)for(this._pages=[],a=d,b=0,c=0;a<e;a++){if(b>=h||0===b){if(this._pages.push({start:Math.min(f,a-d),end:a-d+h-1}),Math.min(f,a-d)===f)break;b=0,++c}b+=this._core.mergers(this._core.relative(a))}},e.prototype.draw=function(){var b,c=this._core.settings,d=this._core.items().length<=c.items,e=this._core.relative(this._core.current()),f=c.loop||c.rewind;this._controls.$relative.toggleClass("disabled",!c.nav||d),c.nav&&(this._controls.$previous.toggleClass("disabled",!f&&e<=this._core.minimum(!0)),this._controls.$next.toggleClass("disabled",!f&&e>=this._core.maximum(!0))),this._controls.$absolute.toggleClass("disabled",!c.dots||d),c.dots&&(b=this._pages.length-this._controls.$absolute.children().length,c.dotsData&&0!==b?this._controls.$absolute.html(this._templates.join("")):b>0?this._controls.$absolute.append(new Array(b+1).join(this._templates[0])):b<0&&this._controls.$absolute.children().slice(b).remove(),this._controls.$absolute.find(".active").removeClass("active"),this._controls.$absolute.children().eq(a.inArray(this.current(),this._pages)).addClass("active"))},e.prototype.onTrigger=function(b){var c=this._core.settings;b.page={index:a.inArray(this.current(),this._pages),count:this._pages.length,size:c&&(c.center||c.autoWidth||c.dotsData?1:c.dotsEach||c.items)}},e.prototype.current=function(){var b=this._core.relative(this._core.current());return a.grep(this._pages,a.proxy(function(a,c){return a.start<=b&&a.end>=b},this)).pop()},e.prototype.getPosition=function(b){var c,d,e=this._core.settings;return"page"==e.slideBy?(c=a.inArray(this.current(),this._pages),d=this._pages.length,b?++c:--c,c=this._pages[(c%d+d)%d].start):(c=this._core.relative(this._core.current()),d=this._core.items().length,b?c+=e.slideBy:c-=e.slideBy),c},e.prototype.next=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!0),b)},e.prototype.prev=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!1),b)},e.prototype.to=function(b,c,d){var e;!d&&this._pages.length?(e=this._pages.length,a.proxy(this._overrides.to,this._core)(this._pages[(b%e+e)%e].start,c)):a.proxy(this._overrides.to,this._core)(b,c)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.Navigation=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){"use strict";var e=function(c){this._core=c,this._hashes={},this.$element=this._core.$element,this._handlers={"initialized.owl.carousel":a.proxy(function(c){c.namespace&&"URLHash"===this._core.settings.startPosition&&a(b).trigger("hashchange.owl.navigation")},this),"prepared.owl.carousel":a.proxy(function(b){if(b.namespace){var c=a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");if(!c)return;this._hashes[c]=b.content}},this),"changed.owl.carousel":a.proxy(function(c){if(c.namespace&&"position"===c.property.name){var d=this._core.items(this._core.relative(this._core.current())),e=a.map(this._hashes,function(a,b){return a===d?b:null}).join();if(!e||b.location.hash.slice(1)===e)return;b.location.hash=e}},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this.$element.on(this._handlers),a(b).on("hashchange.owl.navigation",a.proxy(function(a){var c=b.location.hash.substring(1),e=this._core.$stage.children(),f=this._hashes[c]&&e.index(this._hashes[c]);f!==d&&f!==this._core.current()&&this._core.to(this._core.relative(f),!1,!0)},this))};e.Defaults={URLhashListener:!1},e.prototype.destroy=function(){var c,d;a(b).off("hashchange.owl.navigation");for(c in this._handlers)this._core.$element.off(c,this._handlers[c]);for(d in Object.getOwnPropertyNames(this))"function"!=typeof this[d]&&(this[d]=null)},a.fn.pagelayerOwlCarousel.Constructor.Plugins.Hash=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){function e(b,c){var e=!1,f=b.charAt(0).toUpperCase()+b.slice(1);return a.each((b+" "+h.join(f+" ")+f).split(" "),function(a,b){if(g[b]!==d)return e=!c||b,!1}),e}function f(a){return e(a,!0)}var g=a("<support>").get(0).style,h="Webkit Moz O ms".split(" "),i={transition:{end:{WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",transition:"transitionend"}},animation:{end:{WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd",animation:"animationend"}}},j={csstransforms:function(){return!!e("transform")},csstransforms3d:function(){return!!e("perspective")},csstransitions:function(){return!!e("transition")},cssanimations:function(){return!!e("animation")}};j.csstransitions()&&(a.support.transition=new String(f("transition")),a.support.transition.end=i.transition.end[a.support.transition]),j.cssanimations()&&(a.support.animation=new String(f("animation")),a.support.animation.end=i.animation.end[a.support.animation]),j.csstransforms()&&(a.support.transform=new String(f("transform")),a.support.transform3d=j.csstransforms3d())}(window.Zepto||window.jQuery,window,document);

/*
PAGELAYER
http://pagelayer.com/
(c) Pagelayer Team
*/

var pagelayer_doc_width;

// Things to do on document load
jQuery(document).ready(function(){
	
	// Current width
	pagelayer_doc_width = jQuery(document).width();
	
	// Rows
	jQuery('.pagelayer-row-stretch-full').each(function(){
		pagelayer_pl_row_full(jQuery(this));
	});
	
	jQuery('.pagelayer-anim_heading').each(function(){
		pagelayer_anim_heading(jQuery(this));
	});
	
	// Setup any sliders
	jQuery('.pagelayer-image_slider').each(function(){
		pagelayer_pl_image_slider(jQuery(this));
	});
	
	jQuery('.pagelayer-accordion').each(function(){
		pagelayer_pl_accordion(jQuery(this));
	});
	
	jQuery('.pagelayer-collapse').each(function(){
		pagelayer_pl_collapse(jQuery(this));
	});
	
	jQuery('.pagelayer-tabs').each(function(){
		pagelayer_pl_tabs(jQuery(this));
	});
	
	jQuery('.pagelayer-video').each(function(){
		pagelayer_pl_video(jQuery(this));
	});
	
	jQuery('.pagelayer-image').each(function(){
		pagelayer_pl_image(jQuery(this));
	});
	
	jQuery('.pagelayer-grid_gallery').each(function(){
		pagelayer_pl_grid_lightbox(jQuery(this));
	});
	
	jQuery('.pagelayer-row, .pagelayer-inner_row, .pagelayer-col').each(function(){
		pagelayer_pl_row_video(jQuery(this));
	});
	
	jQuery('.pagelayer-parallax-window img').each(function(){
		pagelayer_pl_row_parallax(jQuery(this));
	});
	
	jQuery('.pagelayer-recaptcha').each(function(){
		pagelayer_recaptcha_loader(jQuery(this));
	});
	
	jQuery('.pagelayer-wp_menu').each(function(){
		pagelayer_primary_menu(jQuery(this));
	});
	
	jQuery('.pagelayer-contact').each(function(){
		pagelayer_contact_form(jQuery(this));
	});
	
	jQuery('.pagelayer-countdown').each(function(){
		pagelayer_countdown(jQuery(this));
	});
	
	jQuery('.pagelayer-testimonial_slider').each(function(){
		pagelayer_pl_testimonial_slider(jQuery(this));
	});
	
	jQuery('.pagelayer-social_grp').each(function(){
		pagelayer_pl_social_profile(jQuery(this));
	});
	
	jQuery('.pagelayer-scroll-to-element').each(function () {
		pagelayer_button_element_scroll(jQuery(this));
	});

	jQuery('.pagelayer-bgimg-slider').each(function () {
		pagelayer_pl_row_slider(jQuery(this));
	});

	jQuery('.pagelayer-stars-container').each(function(){
		pagelayer_stars(jQuery(this));
	});
	
	jQuery('.pagelayer-infinite-posts').each(function(){
		pagelayer_infinite_posts(jQuery(this));
	});
	
	jQuery('.pagelayer-youtube-video').each(function(){
		pagelayer_create_yt_player(jQuery(this));
	});

	// We need to call the is visible thing to show the widgets loading effect
	if(jQuery('.pagelayer-counter-content,.pagelayer-progress-container').length > 0){

		// First Call
		pagelayer_counter();
		pagelayer_progress();
		
		jQuery(window).scroll(function() {
			pagelayer_progress();
			pagelayer_counter();
		});
	}
	
	new WOW({boxClass:'pagelayer-wow'}).init();
	
	// Remove pagelayer-wow temporary style after wow init added from wp_head
	jQuery('#pagelayer-wow-animation-style').remove();
	
});

// For automatic row change
jQuery(window).resize(function() {
	
	// Primary Menu
	jQuery('.pagelayer-wp_menu').each(function(){
		pagelayer_primary_menu(jQuery(this));
	});
	
	var new_vw = jQuery(document).width();
	
	if(new_vw == pagelayer_doc_width){
		return false;
	}
	
	pagelayer_doc_width = new_vw;
	
	// Remove style
	jQuery('.pagelayer-row-stretch-full').removeAttr('style');
	
	// Set a timeout to prevent bubbling
	setTimeout(function(){
		
		jQuery('.pagelayer-row-stretch-full').each(function(){
			pagelayer_pl_row_full(jQuery(this));
		});
	
	}, 200);
	
});

// Check if element is visible
function pagelayer_isVisible(ele) {
	
	var offset = jQuery(window).height();
	var viewTop = window.pageYOffset;
	var viewBottom = viewTop + offset - Math.min(ele.height(), ele.innerHeight());
	var top = ele.offset().top;
	var bottom = top + ele.innerHeight();
	
	if(top <= viewBottom && bottom >= viewTop){
		return true;
	}
	
	return false;
}

// Get media mode
function pagelayer_get_media_mode(){
	
	if(window.matchMedia("(min-width: "+ (pagelayer_settings['tablet_breakpoint'] + 1) +"px)").matches){
		return 'desktop';
	}
	
	if(window.matchMedia("(max-width: "+ pagelayer_settings['tablet_breakpoint'] +"px) and (min-width: "+ (pagelayer_settings['mobile_breakpoint'] + 1) +"px)").matches){
		return 'tablet';
	}
	
	if(window.matchMedia("(max-width: "+ pagelayer_settings['mobile_breakpoint'] +"px)").matches){
		return 'mobile';
	}
	
	return 'desktop';
}
	  
// Row background video and parallax
function pagelayer_pl_row_video(jEle){
	
	var vEle = jEle.children('.pagelayer-background-video');
	
	// Not a video in the element
	if(vEle.length < 1){
		return true;
	}
	
	var setup = vEle.attr('pagelayer-setup');
	if(setup && setup.length > 0){
		return true;
	}

	var frame_width = vEle.width();
	var frame_height = (frame_width/100)*56.25;
	var height = vEle.height();
	
	if(frame_height < height){
		
		frame_height = height;
		
	}
	
	vEle.children().css({'width':frame_width+'px','height':frame_height+'px'});

	if(vEle.find('.pagelayer-youtube-video').length > 0){
		pagelayer_create_yt_player(vEle.find('.pagelayer-youtube-video'));
	}

	vEle.attr('pagelayer-setup', 1);
	
}

function pagelayer_create_yt_player(jEle){
    
	var pEle = jEle.parent(),
	aspectRatioSetting = '16:9',
	containerWidth = pEle.outerWidth(),
	containerHeight = pEle.outerHeight(),
	aspectRatioArray = aspectRatioSetting.split(':'),
	aspectRatio = aspectRatioArray[0] / aspectRatioArray[1],
	isWidthFixed = containerWidth / containerHeight > aspectRatio,
	width= isWidthFixed ? containerWidth : containerHeight * aspectRatio,
	height= isWidthFixed ? containerWidth / aspectRatio : containerHeight;
	
	var yt_api_interval = setInterval(function(){
		
		if(!(window.YT && YT.loaded)){
			return
		}
		
		clearInterval(yt_api_interval);
		
		var settings ={};
		settings.loop = jEle.attr('data-loop');
		settings.videoid = jEle.attr('data-videoid');
		settings.mute = jEle.attr('data-mute');

		var player;
		
		var onPlayerReady = function(event) {
			event.target.playVideo();
		}

		player = new YT.Player(jEle[0], {
				width: width,
				height: height,
				videoId: settings.videoid,
				playerVars: {
				controls: 0,
				rel: 0,
				loop: settings.loop,
				mute:settings.mute,
				playsinline: 1,
				playlist: settings.videoid,	
			},
			events: {
				'onReady': onPlayerReady,
			}
		});

	}, 500);

}

// Row background parallax
function pagelayer_pl_row_parallax(jEle){
	
	//Parallax background
	var setup = jEle.attr('pagelayer-setup');
	if(setup && setup.length > 0){
		return true;
	}
	
	new pagelayerParallax(jEle);
	jEle.attr('pagelayer-setup', 1);
}

// Adjust rows
function pagelayer_pl_row_full(jEle){
	
	// Get current width
	var vw = jQuery('html').width();
	
	// Now give the row the width
	jEle.css({'width': vw, 'max-width': '100vw'});
	
	// Set the offset
	jEle.offset({left: 0});
	
	// Set a timeout as well as some themes can interfere with us
	setTimeout(function(){
		jEle.offset({left: 0});
	}, 500);
	
};

// Modal open
function pagelayer_render_pl_modal(param){
	jQuery(param).parent().parent().find('.pagelayer-modal-content').show();
};

// Modal close
function pagelayer_pl_modal_close(param){
	jQuery(param).parent().hide();
}

// Setup the image slider
function pagelayer_pl_image_slider(jEle){
	
	var ul = jQuery(jEle.find('.pagelayer-image-slider-ul'));
	
	// Build the options
	var options = pagelayer_fetch_dataAttrs(ul, 'data-slides-');
	
	pagelayer_owl_init(jEle, ul, options);

}

function pagelayer_get_tab_ele(temp_tabCont){
	
	if(!pagelayer_empty(temp_tabCont.children('.pagelayer-ele-wrap').length)){
		return temp_tabCont.children('.pagelayer-ele-wrap').children('.pagelayer-tab');
	}else{
		return temp_tabCont.children('.pagelayer-tab');
	}
}

function pagelayer_tab_show(el, pl_id) {
	
	var parent_id = jQuery(el).closest('.pagelayer-tabs').attr('pagelayer-id');
	
	var temp_tabCont = jQuery('[pagelayer-id='+pl_id+']').closest('.pagelayer-tabcontainer');
	pagelayer_get_tab_ele(temp_tabCont).hide();
	
	jQuery('[pagelayer-id='+pl_id+']').show();
	
	jQuery(el).parent().find('.pagelayer-tablinks').each(function(){
		jQuery(this).removeClass('active');
	});
	
	jQuery(el).addClass("active");
}

var pagelayer_tab_timers = {};

function pagelayer_pl_tabs(jEle) {
	
	var default_active = '';
	var jEle_id = jEle.attr('pagelayer-id');	

	var tabCont = jEle.children('.pagelayer-tabcontainer');
	var children = pagelayer_get_tab_ele(tabCont);
	
	// Loop thru
	children.each(function(){
		var tEle = jQuery(this);
		var pl_id = tEle.attr('pagelayer-id');
				
		var title = tEle.attr('pagelayer-tab-title') || 'Tab';
		var func = "pagelayer_tab_show(this, '"+pl_id+"')";
		
		var icon = '';
		if(tEle.attr('pagelayer-tab-icon')){
			icon = tEle.attr('pagelayer-tab-icon');
		}
		
		// Set the default tab
		if(tEle.attr('pagelayer-default_active') && !pagelayer_empty(pl_id)){
			default_active = pl_id;
		}
		
		jEle.children('.pagelayer-tabs-holder').append('<span tab-id="'+pl_id+'" class="pagelayer-tablinks" onclick="'+func+'"> <i class="'+icon+'"></i> <span>'+title+'</span></span>');
	});

	// Set the default tab
	if(default_active.length > 0){
		pagelayer_tab_show(jEle.find('[tab-id='+default_active+']'), default_active);
	// Set the first tab as active
	}else{
		var first_tab = jEle.find('[tab-id]').first();
		pagelayer_tab_show(first_tab, first_tab.attr('tab-id'));
	}

	try{
		clearInterval(pagelayer_tab_timers[jEle_id]);
	}catch(e){};
	
	var rotate = parseInt(jEle.attr('pagelayer-tabs-rotate'));
	
	// Are we to rotate
	if(rotate > 0){
		
		var i= 0;
		pagelayer_tab_timers[jEle_id] = setInterval(function () {
			
			if(i >= children.length){
				i = 0;
			}
			
			var tabCont = jEle.children('.pagelayer-tabcontainer');
			var tmp_pl_ele = pagelayer_get_tab_ele(tabCont)[i];
			
			var tmp_btn_ele = jEle.find('.pagelayer-tablinks')[i]
			var tmp_pl_id = jQuery(tmp_pl_ele).attr('pagelayer-id');
			
			jEle.find('.pagelayer-tablinks').each(function(){
				jQuery(this).removeClass('active');
			});
			
			jQuery(tmp_btn_ele).addClass("active");
			pagelayer_tab_show(tmp_btn_ele, tmp_pl_id);
			
			i++;
	   
		}, rotate);
	}
	
}

// Setup the Accordion
function pagelayer_pl_accordion(jEle){
	
	var holder = jEle.find('.pagelayer-accordion-holder');
	var accHolder = jEle.find('.pagelayer-accordion_item');
	var scrolltop = false;
	
	if(accHolder.length < 1){
		return false;
	}
		
	var icon = holder.attr('data-icon');
	var active_icon = holder.attr('data-active_icon');
	
	accHolder.find('.pagelayer-accordion-tabs span i').attr('class', icon);
	var currentActiveTab = jEle.find('.pagelayer-accordion_item.active').first();
	
	// Any URL HASH ?
	var hash = location.hash.slice(1);	
	if(!pagelayer_empty(hash)){
		var scrollTab = jEle.find('#'+hash);
	
		if(!pagelayer_empty(scrollTab) && scrollTab.length > 0){
			currentActiveTab = scrollTab.closest('.pagelayer-accordion_item');
		}
	}
	
	accHolder.find('.pagelayer-accordion-tabs').unbind('click');
	accHolder.find('.pagelayer-accordion-tabs').click(function(){
		
		var currentTab = jQuery(this).closest('.pagelayer-accordion_item');
		
		if(currentTab.hasClass('active')){
			currentTab.removeClass('active').children('.pagelayer-accordion-panel').slideUp('slow');
			currentTab.find('.pagelayer-accordion-tabs span i').attr('class', icon);
			return true;
		}
		
		accHolder.find('.pagelayer-accordion-tabs span i').attr('class', icon);
		accHolder.removeClass('active').filter(function(index){
			return accHolder[index]!=currentTab[0];
		}).children('.pagelayer-accordion-panel').slideUp('slow');							
	
		currentTab.addClass('active').children('.pagelayer-accordion-panel').slideDown('slow');
		currentTab.find('.pagelayer-accordion-tabs span i').attr('class', active_icon);
		
	});
	
	// If active first tab from all active tabs
	currentActiveTab.removeClass('active');
	currentActiveTab.find('.pagelayer-accordion-tabs').click();
}

// Setup the Collapse
function pagelayer_pl_collapse(jEle){
	
	var holder = jEle.find('.pagelayer-collapse-holder');
	var tabs = jEle.find('.pagelayer-accordion_item');
		
	if(tabs.length < 1){
		return false;
	}
		
	var setup = tabs.attr('pagelayer-setup');
	var icon = holder.attr('data-icon');
	var active_icon = holder.attr('data-active_icon');
	
	// Any URL HASH ?
	var hash = location.hash.slice(1);	
	if(!pagelayer_empty(hash)){
		var scrollTab = jEle.find('#'+hash);
	
		if(!pagelayer_empty(scrollTab) && scrollTab.length > 0){
			scrollTab.closest('.pagelayer-accordion_item').addClass('active');
		}
	}
	
	var activeTabs = jEle.find('.pagelayer-accordion_item.active');

	tabs.find('.pagelayer-accordion-tabs span i').attr('class', icon);
	jQuery(activeTabs).addClass('active').children('.pagelayer-accordion-panel').slideDown('slow');
	jQuery(activeTabs).find('.pagelayer-accordion-tabs span i').attr('class', active_icon);
		
	// Already setup ?
	if(setup && setup.length > 0){
		tabs.find('.pagelayer-accordion-tabs').unbind('click');
	}

	tabs.find('.pagelayer-accordion-tabs').click(function(){
		
		var currentTab = jQuery(this).closest('.pagelayer-accordion_item');
		
		if(currentTab.hasClass('active')){
			currentTab.removeClass('active').children('.pagelayer-accordion-panel').slideUp('slow');
			currentTab.find('.pagelayer-accordion-tabs span i').attr('class', icon);
			return true;
		}
			
		currentTab.addClass('active').children('.pagelayer-accordion-panel').slideDown('slow');
		currentTab.find('.pagelayer-accordion-tabs span i').attr('class', active_icon);
		
	});
	
	// Set that we have setup everything
	tabs.attr('pagelayer-setup', 1);
	
}

// Counter
function pagelayer_counter(){
	
	jQuery('.pagelayer-counter-content').each(function(){
		
		var jEle = jQuery(this);
		
		if(pagelayer_isVisible(jEle)){
			
			var setup = jEle.attr('pagelayer-setup');
			
			// Already setup ?
			if(setup && setup.length > 0){
				return true;
			}
			
			var options = {};
			options['duration'] = jEle.children('.pagelayer-counter-display').attr('pagelayer-counter-animation-duration');
			options['delimiter'] = jEle.children('.pagelayer-counter-display').attr('pagelayer-counter-seperator-type');
			options['toValue'] = jEle.children('.pagelayer-counter-display').attr('pagelayer-counter-last-value');					
			jEle.children('.pagelayer-counter-display').numerator( options );
		
			// Set that we have setup everything
			jEle.attr('pagelayer-setup', 1);
			
		}
	});
}

function pagelayer_progress(){
	jQuery('.pagelayer-progress-container').each(function(){
		var jEle = jQuery(this);
		
		if(pagelayer_isVisible(jEle)){
			
			var setup = jEle.attr('pagelayer-setup');
			if(setup && setup.length > 0){
				return true;
			}
			
			var progress_width = jEle.children('.pagelayer-progress-bar').attr('pagelayer-progress-width');
			if(progress_width == undefined){
				progress_width = "1";
			}
			
			var width = 0;
			var interval;
			
			var progress = function(){
				if (width >= progress_width) {
					clearInterval(interval);
				} else {
					width++;
					jEle.children('.pagelayer-progress-bar').css('width', width + '%'); 
					jEle.find('.pagelayer-progress-percent').text(width * 1  + '%');
				}
			}
			interval = setInterval(progress, 30);
			jEle.attr('pagelayer-setup', 1);
			
		}
	});
}

// Dismiss Alert Function
function pagelayer_dismiss_alert(x){
	
	if(!pagelayer_empty(pagelayer_is_live)){
		return;
	}
	
	jQuery(x).parent().parent().fadeOut();
}

// Video light box handler
function pagelayer_pl_video(jEle){
	var videoIframe = jEle.find('.pagelayer-video-iframe');
	// Adding loop, autoplay and mute properties on video before loading 
	videoIframe.on('load', function() {
		
		// Checking of video source if it is youtube or vimeo because 
		// TODO: Need to check, if this is not local file then return
		if(jQuery(this)[0].src.indexOf('youtube.com') != -1 || jQuery(this)[0].src.indexOf('vimeo.com') != -1){
			return;
		}
		
		var vidElm = jQuery(this).contents().find('video');
		var vidSrc = (pagelayer_empty(vidElm[0].src)) ? vidElm.children()[0].src : vidElm[0].src;	
		
		if(vidSrc[vidSrc.indexOf('&loop=')+6] == 1){
			vidElm.attr('loop','loop');
		}
		if(vidSrc[vidSrc.indexOf('&autoplay=')+10] == 0){
			vidElm.removeAttr('autoplay');
			vidElm[0].pause();
		}else if(vidSrc[vidSrc.indexOf('&autoplay=')+10] == 1){
			vidElm.attr('autoplay','');
			vidElm.attr('playsinline','');			
		}
		if(vidSrc[vidSrc.indexOf('&mute=')+6] == 1){
			vidElm[0].muted = "muted";
			vidElm.attr('muted','');	
		}
	});
	
	// A tag will be there ONLY if the lightbox is on
	var overlayval = jEle.find('.pagelayer-video-overlay');	
	var a = jEle.find(".pagelayer-video-holder a");
	
	// No lightbox
	if(a.length < 1 && pagelayer_empty(overlayval)){
		return;
	}

	a.nivoLightbox({
		effect: "fadeScale",
	});
	
	jEle.find(".pagelayer-video-holder .pagelayer-video-overlay").on("click", function(ev) {

		var target = jQuery(ev.target);

		if (!target.parent("a").length) {
			videoIframe[0].src = videoIframe[0].src.replace("&autoplay=0", "rel=0&autoplay=1");
			jQuery(this).hide();
		}
	});
	
}

// Image light box handler
function pagelayer_pl_image(jEle){
	
	// Drag and Drop function for image
	if (typeof pagelayer_preDAndD_image !== "undefined") {
		pagelayer_preDAndD_image(jEle);
	}
	
	// A tag will be there ONLY if the lightbox is on
	var a = jEle.find("[pagelayer-image-link-type=lightbox]");
	
	// No lightbox
	if(a.length < 1){
		return;
	}
	
	a.nivoLightbox({
		effect: "fadeScale",
	});
}

function pagelayer_stars(jEle){

	var setup = jEle.attr('pagelayer-setup');
	if(setup && setup.length > 0){
		return true;
	}
	var count = jEle.attr('pagelayer-stars-count');
		
	if (isNaN(count)) {
		count = '0';
	}
		
	i = 0;
	var stars = "";
	while(i < count){			
		stars +='<div class="pagelayer-stars-icon pagelayer-stars-empty"><i class="fas fa-star" aria-hidden="true"></i></div>';
		i++;
	}

	jEle.empty();
	jEle.append(stars);
	var starsval = jEle.attr('pagelayer-stars-value');
		
	if (isNaN(starsval)) {
		starsval = count;
	}

	starsval = starsval.split('.');		
	var fullstars = starsval[0];
	var value =  starsval[1];
	var halfstar = parseInt(fullstars) + 1;
	var emptystars = parseInt(fullstars) + 2;
	jEle.children('.pagelayer-stars-icon').attr("class","pagelayer-stars-icon");
	jEle.children('.pagelayer-stars-icon:nth-child(-n+'+ fullstars +')').addClass('pagelayer-stars-full'); 
	if(value != undefined){
		jEle.children('.pagelayer-stars-icon:nth-child('+ halfstar +')').addClass('pagelayer-stars-'+value);		
	}else{
		jEle.children('.pagelayer-stars-icon:nth-child('+ halfstar +')').addClass('pagelayer-stars-empty');
	}
	jEle.children('.pagelayer-stars-icon:nth-child(n+'+ emptystars +')').addClass('pagelayer-stars-empty'); 		
	jEle.attr('pagelayer-setup', 1);
}

// Grid Gallery pagination Off On function
function pagelayer_pl_grid_paginate(gridCont, pagination, pageValue, gridValue){
	gridCont.hide();
	pagination.removeClass('active');
	pagination.eq(pageValue).addClass('active');
	gridCont.eq(gridValue).show();
}

//Grid Gallery Lightbox
function pagelayer_pl_grid_lightbox(jEle){
	
	// Grid Gallery pagination settings
	var gridCont = jEle.find('.pagelayer-grid-gallery-container').children();
	var pagination = jEle.find('.pagelayer-grid-gallery-pagination ul').children();
	gridCont.hide();
	gridCont.eq(0).show();
	// Adding event listners to pagination
	jEle.find('.pagelayer-grid-page-item').each(function(){
		jQuery(this).on('click', function(event){
			var text = jQuery(this).text();
			switch(text){
				case '«':
					pagelayer_pl_grid_paginate(gridCont, pagination, 1, 0);
					break;
				case '»':
					pagelayer_pl_grid_paginate(gridCont, pagination, (pagination.length-2), (gridCont.length-1));
					break;
				default:
					pagelayer_pl_grid_paginate(gridCont, pagination, text, text-1);
					break;
			}
		});
	});	

	// A tag will be there ONLY if the lightbox is on
	var a = jEle.find("[pagelayer-grid-gallery-type=lightbox]");
	
	// No lightbox
	if(a.length < 1){
		return;
	}
	
	a.nivoLightbox({
		effect: "fadeScale",
		keyboardNav: true,
		clickImgToClose: false,
		clickOverlayToClose: true,
	});
}

// Is string?
function pagelayer_is_string(str){
   
   if(typeof str == 'string'){
	   return true;
   }
   
   return false;
}

// PHP equivalent empty()
function pagelayer_empty(mixed_var) {

  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, '', '0'];

  for (i = 0, len = emptyValues.length; i < len; i++) {
	if (mixed_var === emptyValues[i]) {
	  return true;
	}
  }

  if (typeof mixed_var === 'object') {
	for (key in mixed_var) {
	  // TODO: should we check for own properties only?
	  //if (mixed_var.hasOwnProperty(key)) {
	  return false;
	  //}
	}
	return true;
  }

  return false;
};

function pagelayer_fetch_dataAttrs(ele, prefix){
	
	var options = {};
	
	jQuery.each(ele.get(0).attributes, function(i, attrib){
		
		//console.log(attrib);
		if(attrib.name.includes(prefix)){
			
			var opt_name = attrib.name.substring(prefix.length);
			
			// Check for any Uppercase attribute
			if(opt_name.includes('-')){
				
				opt_name = opt_name.split('-');
				//console.log(opt_name);
				var opt_arr = [];
				jQuery.each(opt_name, function(key, value) {
					if(key != 0){
						opt_arr.push(value.charAt(0).toUpperCase() + value.slice(1));
					}else{
						opt_arr.push(value);
					}
				});
				//console.log(opt_arr);
				opt_name = opt_arr.join('');
			}
			
			// Make the values correct
			var val = attrib.value;
			if(val == 'true') val = true;
			if(val == 'false') val = false;
			if(jQuery.isNumeric(val)) val = parseInt(val);
			
			options[opt_name] = val;
		}
	});
	
	//console.log(options);
	
	if(options['controls']){
		switch(options['controls']){
			case 'arrows':
				options['nav'] = true;
				options['dots'] = false;
				break;
			case 'pager':
				options['dots'] = true;
				options['nav'] = false;
				break;
			case 'none':
				options['nav'] = false;
				options['dots'] = false;
				break;
		}
	}else{
		options['nav'] = true;
		options['dots'] = true;
	}
	
	if(options['animateIn']){
		switch(options['controls']){
			case 'horizontal':
				options['animateIn'] = 'slideInLeft';
				break;
			case 'vertical':
				options['animateIn'] = 'slideInDown';
				break;
			case 'kenburns':
				options['animateIn'] = 'zoomIn';
				break;
			default:
				options['animateIn'] = options['animateIn'];
		}
	}
	
	if(!options['items']){
		options['items'] = 1;
	}
	options['responsive'] = {
		0:{items: 1},
		500:{items: options['items']}
	}

	options['responsiveRefreshRate'] = 1000;
	
	// If we are in editor don't loop the Owl items
	if (window.location.href.indexOf('pagelayer-live=1') > -1) {
		//console.log('here');
		options['loop'] = false;
	}
	
	return options;
}

function pagelayer_owl_init(jEle, ul, options){
	
	//console.log(options);
	var setup = jEle.attr('pagelayer-setup');
	
	if( options.navtext ) {
		var right = options.navtext.replace('left','right');
		options.navText = [`<i class="${options.navtext}"></i>`, `<i class="${right}"></i>`];
	}
	
	// Already setup ?
	if(setup && setup.length > 0){
		return true;
	}
	
	var owlCar = ul.pagelayerOwlCarousel(options);
	
	// Refreshing Image slider after first load of page.
	setTimeout(function(){
		owlCar.trigger('refresh.owl.carousel');
	},700);
	
	// To prevent slider drag inside the editable area
	jEle.on('mousedown', function(e){
		var target = e.target;
		
		var isEditable = jQuery(target).closest('[contenteditable="true"]');
		
		if(isEditable.length < 1){
			return;
		}
		
		isEditable.on('mousedown.owl.core dragstart.owl.core selectstart.owl.core touchstart.owl.core touchcancel.owl.core', function(e){
			e.stopPropagation();
		});
		
	});
	
	// Set that we have setup everything
	jEle.attr('pagelayer-setup', 1);
	
}

// recaptcha handler
function pagelayer_recaptcha_loader(jEle, loadScript){
	
	loadScript = loadScript || false;
	
	// Render recaptcha
	var reParam = '';
	
	if(!pagelayer_empty(pagelayer_recaptch_lang)){
		reParam = '&hl='+pagelayer_recaptch_lang;
	}
	
	// Add recaptcha script
	if(pagelayer_empty(window.grecaptcha) && !pagelayer_empty(loadScript)){
		jQuery('body').append('<script src="https://www.google.com/recaptcha/api.js?render=explicit'+reParam+'" async defer></script>');
	}
	
	// Render recaptcha
	var recaptcha_interval = setInterval(function(){
		
		if(!pagelayer_empty(window.grecaptcha)){
			grecaptcha.ready(function() {
				try{			
					var widgetID = grecaptcha.render(jEle.get(0), {'sitekey' : jEle.data("sitekey")});
					jEle.attr('recaptcha-widget-id', widgetID);
				}catch(e){
					console.log("There is some issue in rendering reCaptcha. Please check your recaptcha site-key !");
				}
				
			});
			clearInterval(recaptcha_interval);
		}

	}, 500);
 
}

// Scroll to element button effect
function pagelayer_button_element_scroll(jEle) {

	var speed = parseInt(jEle.attr('pagelayer_scrollto_speed') * 1000);
	var idspacing = 0;
	var scrollId = jEle.attr('pagelayer_scrollto_id');

	if(jEle.attr('pagelayer_scrollto_type') == 'toid'){

		var scrolltoEle = jQuery('#' + scrollId);

		if(pagelayer_empty(scrollId) || scrolltoEle.length < 1){
			return;
		}

		var idpos = parseInt(scrolltoEle.offset().top);
		var spacing = parseInt(jEle.attr('pagelayer_scrollto_id_viewport'));

		if (isNaN(spacing)) {
			spacing = 0;
		}

		idspacing = idpos + spacing;
		
	}

	jEle.on('click', function (e) {
		e.preventDefault();
		jQuery('html, body').animate({ scrollTop: idspacing }, speed);
	});
	
}

////////////
// Freemium
////////////

// Contact Form handler - Premium
function pagelayer_contact_form(jEle){
	
	jEle = jQuery(jEle);
	var id = jEle.attr('pagelayer-id');
	
	// Set pagelayer id to input field
	jEle.find('form input[name="cfa-pagelayer-id"]').val(id);
 
}

// Contact Form Submit handler - Premium
function pagelayer_contact_submit(jEle, e){
	e.preventDefault();
	
	// Checking for required checkboxes.
	for(var checkbox_div of jQuery(jEle).find('.pagelayer-contact-checkbox')){
		checkbox_div = jQuery(checkbox_div);
		if(checkbox_div.attr('required') == 'required'){
			if(pagelayer_empty(checkbox_div.find('input:checked').length)){
				alert('Kindly select the required checkbox');
				return;
			}
		}		
	}
	
	// Trigger an action
	jQuery(document).trigger('pagelayer_contact_submit', e, jEle);
	
	// Disabling submit button with loading animation.
	jQuery(jEle).find('.pagelayer-contact-submit-btn').prop('disabled', true);
	jQuery(jEle).find('.pagelayer-contact-submit-btn .fa-spin').show('0.6');
	
	//var fdata = jQuery(jEle).closest('form').serialize();
	var redirect = jQuery(jEle).find('input[name="cfa-redirect"]');
	var formData = new FormData( jQuery(jEle)[0] );
	var par = jQuery(jEle).parent();
	
	// Append the nonce
	formData.append('pagelayer_nonce', pagelayer_global_nonce);
	
	// Hide any message
	par.find(".pagelayer-message-box").hide();
	
	// Message pos to use ?
	var msg_pos = 'top';	
	if(par.parent().hasClass('pagelayer-message-box-bottom')){
		msg_pos = 'bottom';
	}
	
	par.find(".pagelayer-message-box").removeClass('pagelayer-cf-msg-err pagelayer-cf-msg-suc');
	
	jQuery.ajax({
		url: pagelayer_ajaxurl+'action=pagelayer_contact_submit',
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		cache:false,
		success:function(result){
			var json = jQuery.parseJSON(result);
			
			jQuery(jEle).find('.pagelayer-contact-submit-btn').prop('disabled', false);
			jQuery(jEle).find('.pagelayer-contact-submit-btn .fa-spin').hide('0.6');
			
			if('success' in json){
				par.find(".pagelayer-message-"+msg_pos).addClass('pagelayer-cf-msg-suc').html(json['success']).fadeIn();
				
				if(redirect.length > 0 && !pagelayer_empty(redirect.val())){
					window.location.href = redirect.val();
				}
			}else{
				par.find(".pagelayer-message-"+msg_pos).addClass('pagelayer-cf-msg-err').html(json['failed']).fadeIn();
			}
		},
		error:function(result){
			par.find(".pagelayer-message-"+msg_pos).addClass('pagelayer-cf-msg-err').html(json['failed']).fadeIn();
		}
	});
	jEle.reset();
	
	jQuery(jEle).find('.pagelayer-recaptcha').each(function(){
		var widgetID = jQuery(this).attr('recaptcha-widget-id');
		
		if(!pagelayer_empty(window.grecaptcha)){
			grecaptcha.reset(widgetID);
		}
	});
	
	return false;
}

// Primary Menu Handler - Premium
function pagelayer_primary_menu(jEle){
	
	var container = jEle.find('.pagelayer-wp-menu-container');
	var menu_bar = jEle.find('.pagelayer-primary-menu-bar i');
	var menu_holder = jEle.find('.pagelayer-wp-menu-holder');
	var layout = menu_holder.data('layout');
	var submenu_ind = menu_holder.data('submenu_ind');
	var responsive = menu_holder.data('responsive');
	var drop_breakpoint = menu_holder.data('drop_breakpoint');
	var close = jEle.find('.pagelayer-wp_menu-close');
	
	var media_mode =  pagelayer_get_media_mode();
	
	if( (drop_breakpoint == 'tablet' && (media_mode == 'tablet' || media_mode == 'mobile')) || (drop_breakpoint == 'mobile' && media_mode == 'mobile') ){
		
		menu_holder.addClass('pagelayer-wp-menu-dropdown');
		container.addClass('pagelayer-menu-type-dropdown');
		container.removeClass('pagelayer-menu-type-'+layout);
		layout = 'dropdown';
		
	}else{
		menu_holder.removeClass('pagelayer-wp-menu-dropdown');
		container.removeClass('pagelayer-menu-type-dropdown');
		container.addClass('pagelayer-menu-type-'+layout);
	}
	
	// Set mega menu width
	// Wait for all other animations to finish
	setTimeout(function(){

		container.find('.pagelayer-mega-menu-item, .pagelayer-mega-column-item').each(function(){
  
			var liEle = jQuery(this),
			lEle = liEle.find('.pagelayer-nav_menu_item').first(),
			megaHolder = lEle.closest('.pagelayer-mega-menu'),				
			setClass = 'pagelayer-set-position';				
			
			if(liEle.hasClass('pagelayer-mega-column-item')){
				megaHolder = liEle.children('.sub-menu');
			}
			
			if(megaHolder.length < 1){
				return;
			}
						
			var Css = {};
			
			// Remove all css settings
			jQuery(document).unbind('scroll.megaMenu');
			megaHolder.css({'width' : '', 'left' : '', 'max-width' : '', 'max-height' : ''});
			
			if(layout == 'dropdown'){
				return;
			}
			
			// Set active to get position
			megaHolder.addClass(setClass);
			
			var megaLeft = megaHolder.offset().left,
			megaWidth = lEle.attr('pagelayer-mega-width'),
			wContainer = lEle.closest('.pagelayer-wp-menu-container'),
			megaCustomWidth = lEle.attr('pagelayer-mega-custom-width') || '',
			widthEle;
			
			// Is vertical menu?
			if(layout == 'vertical'){
				var docWidth = jQuery('body').width();
				var vWidth = docWidth - megaLeft;
				
				Css['max-width'] = vWidth;
				Css['width'] = vWidth;
				
				if(megaWidth == 'custom'){
					Css['width'] = megaCustomWidth;
				}
				
				megaHolder.css(Css);
				megaHolder.removeClass(setClass);
				return;
			}

			var megaMenuHeight = function(e){
				
				if(!pagelayer_empty(e) && megaHolder.is(':visible')){
					return;
				}

				var windowHeight = jQuery(window).height();
				var ulBottom = megaHolder.closest('.pagelayer-wp_menu-ul')[0].getBoundingClientRect().bottom;
				megaHolder.css('max-height', windowHeight - ulBottom);
			};

			megaMenuHeight();
			jQuery(document).on('scroll.megaMenu', megaMenuHeight);
			
			switch(megaWidth){
				case 'row_container':
					widthEle = lEle.closest('.pagelayer-row[pagelayer-id]');
					Css['width'] = widthEle.width();
					break;
				case 'custom':
					widthEle = lEle.closest('li');
					Css['width'] = megaCustomWidth;					
					break;
				default :
					widthEle = wContainer;
					Css['width'] = widthEle.width();
			}
			
			if(widthEle.length > 0){
				var wLeft = widthEle.offset().left;
				
				if( wLeft < megaLeft ){
					Css['left'] = (wLeft) - (megaLeft);
				}
			
			}
			
			megaHolder.css(Css);
			var mRect = megaHolder[0].getBoundingClientRect();
			var wRect = wContainer[0].getBoundingClientRect();
			
			// Set mega menu position
			if(megaWidth != 'custom' || mRect.right < wRect.right){
				megaHolder.removeClass(setClass);
				return;
			}
			
			var left = parseInt(megaHolder.css('left'));
			var moveLeft = mRect.right - wRect.right;
			
			if(mRect.left < moveLeft){
				moveLeft = moveLeft - (moveLeft - mRect.left);
			}
			
			left = left - moveLeft;
			megaHolder.css({'left': left});
			megaHolder.removeClass(setClass);
		});
  
	}, 500);
	
	// Menu toggle
	var toggle_class;
	jQuery(menu_bar).unbind('click');
	jQuery(menu_bar).click(function(){
		jQuery(container).toggleClass('pagelayer-togglt-on');
		
		toggle_class = jQuery(this).data('icon');
		toggle_class = ( pagelayer_empty(toggle_class) ? 'fas fa-bars' : toggle_class );
		
		if(jQuery(container).hasClass('pagelayer-togglt-on')){
			jQuery(this).removeClass(toggle_class);
			jQuery(this).addClass('fas fa-times');
		}else{
			jQuery(this).removeClass('fas fa-times');
			jQuery(this).addClass(toggle_class);
		}
	});
	
	// If has sub-menu the as icon
	var sub_menuEle = jQuery(container).find('.pagelayer-wp_menu-ul li.menu-item-has-children:not(.pagelayer-mega-menu-item), .pagelayer-wp_menu-ul li.pagelayer-mega-menu-item');
	
	var aEle_sub_menu = sub_menuEle.children('a');
	
	if(aEle_sub_menu.children('.after-icon').length < 1){
		aEle_sub_menu.append('<span class="after-icon fa fa-'+submenu_ind+'"></span>');
	}
	
	// Toggle Sub nav
	var after_icon = jQuery(container).find('.pagelayer-wp_menu-ul li.menu-item-has-children .after-icon, .pagelayer-wp_menu-ul li.pagelayer-mega-menu-item .after-icon');
	
	after_icon.unbind('click');
	after_icon.click(function(e){
		e.preventDefault();
		if(window.matchMedia("(max-width: "+pagelayer_settings['tablet_breakpoint']+"px)").matches || layout != 'horizontal'){
			jQuery(this).closest('li').toggleClass('pagelayer-active-sub-menu');

		}else{
			jQuery(this).closest('li').removeClass('pagelayer-active-sub-menu');
		}
	});
	
	close.unbind('click');
	close.click(function(){
		jQuery(container).toggleClass('pagelayer-togglt-on');
		jQuery(menu_bar).removeClass('fas fa-times');
		jQuery(menu_bar).addClass(toggle_class);
	});
	
	// To edit the mega menu in live editor
	jQuery(document).trigger('pagelayer_primary_menu_setup_end', [jEle]);	
}

var count_int ={};
// Show countdown render
function pagelayer_countdown(jEle){
	
	var expiry_date = jEle.find('.pagelayer-countdown-container').attr('pagelayer-expiry-date');
	var timetype = jEle.find('.pagelayer-countdown-container').attr('pagelayer-time-type');
	var jEle_id = jEle.attr('pagelayer-id');
	
	if(pagelayer_empty(expiry_date) || expiry_date == "{{date}}"){
		var expiry_date = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
	}
	
	var now;
	if(timetype == "server"){
		now = new Date(pagelayer_server_time*1000).getTime();
	}else{
		now = new Date().getTime();
	}

	var countDownDate = new Date(expiry_date).getTime();
	var distance = countDownDate - now;

	clearInterval(count_int[jEle_id]);
	count_int[jEle_id] = setInterval(function() {
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		jEle.find('.pagelayer-days-count').html(days);
		jEle.find('.pagelayer-hours-count').html(hours);
		jEle.find('.pagelayer-minutes-count').html(minutes);
		jEle.find('.pagelayer-seconds-count').html(seconds);
		
		// If the count down is over, write some text 
		if(distance < 0) {
			clearInterval(count_int[jEle_id]);
			jEle.find('.pagelayer-countdown-expired').show();
			jEle.find('.pagelayer-countdown-counter').hide();
		}
		
		distance = distance - 1000;
		
	}, 1000);
}

function pagelayer_pl_testimonial_slider(jEle){
	var ul = jQuery(jEle.find('.pagelayer-testimonials-holder'));
	
	// Build the options
	var options = pagelayer_fetch_dataAttrs(ul, 'data-slides-');
	
	pagelayer_owl_init(jEle, ul, options);
}

function pagelayer_anim_heading(jEle){
	var animationDelay = 2500,
		//loading bar effect
		barAnimationDelay = 3800,
		barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
		//letters effect
		lettersDelay = 50,
		//type effect
		typeLettersDelay = 150,
		selectionDuration = 500,
		typeAnimationDelay = selectionDuration + 800,
		//clip effect 
		revealDuration = 600,
		revealAnimationDelay = 1500;
	
	initHeadline();	

	function initHeadline(){
		//insert <i> element for each letter of a changing word
		singleLetters(jEle.find('.pagelayer-aheading-holder.letters').find('span'));
		//initialise headline animation
		animateHeadline(jEle.find('.pagelayer-aheading-holder'));
	}

	function singleLetters($words){
		$words.each(function(){
			var word = jQuery(this),
				letters = word.text().split(''),
				selected = word.hasClass('pagelayer-is-visible');
			for (i in letters) {
				if(word.parents('.pagelayer-aheading-rotate2').length > 0) letters[i] = '<b>' + letters[i] + '</b>';
				letters[i] = (selected) ? '<strong class="pagelayer-aheading-in">' + letters[i] + '</strong>': '<strong>' + letters[i] + '</strong>';
			}
		    var newLetters = letters.join('');
		    word.html(newLetters).css('opacity', 1);
		});
	}

	function animateHeadline($headlines){
		var duration = animationDelay;
		$headlines.each(function(){
			var headline = jQuery(this);
			
			if(headline.hasClass('pagelayer-aheading-loading-bar')){
				duration = barAnimationDelay;
				setTimeout(function(){ headline.find('.pagelayer-words-wrapper').addClass('pagelayer-is-loading') }, barWaiting);
			}else if(headline.hasClass('pagelayer-aheading-clip')){
				var spanWrapper = headline.find('.pagelayer-words-wrapper'),
					newWidth = spanWrapper.width() + 10;
				spanWrapper.css('width', newWidth);
			} else if (!headline.hasClass('type') ){
				var words = headline.find('.pagelayer-words-wrapper span'),
					width = 0;
				words.each(function(){
					var wordWidth = jQuery(this).width();
				    if (wordWidth > width) width = wordWidth;
				});
				headline.find('.pagelayer-words-wrapper').css('width', width);
			};

			//trigger animation
			setTimeout(function(){ hideWord( headline.find('.pagelayer-is-visible').eq(0) ) }, duration);
		});
	}

	function hideWord($word){
		var nextWord = takeNext($word);
		
		if($word.parents('.pagelayer-aheading-holder').hasClass('letters')){
			var bool = ($word.children('strong').length >= nextWord.children('strong').length) ? true : false;
			hideLetter($word.find('strong').eq(0), $word, bool, lettersDelay);
			showLetter(nextWord.find('strong').eq(0), nextWord, bool, lettersDelay);

		}else if($word.parents('.pagelayer-aheading-holder').hasClass('pagelayer-aheading-clip')){
			$word.parents('.pagelayer-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
				switchWord($word, nextWord);
				showWord(nextWord);
			});

		}else if($word.parents('.pagelayer-aheading-holder').hasClass('pagelayer-aheading-loading-bar')){
			$word.parents('.pagelayer-words-wrapper').removeClass('pagelayer-is-loading');
			switchWord($word, nextWord);
			setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
			setTimeout(function(){ $word.parents('.pagelayer-words-wrapper').addClass('pagelayer-is-loading') }, barWaiting);

		}else{
			switchWord($word, nextWord);
			setTimeout(function(){ hideWord(nextWord) }, animationDelay);
		}
	}

	function showWord($word, $duration){
		if($word.parents('.pagelayer-aheading-holder').hasClass('pagelayer-aheading-clip')){
			$word.parents('.pagelayer-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){ 
				setTimeout(function(){ hideWord($word) }, revealAnimationDelay); 
			});
		}
	}

	function hideLetter($letter, $word, $bool, $duration){
		$letter.removeClass('pagelayer-aheading-in').addClass('pagelayer-aheading-out');
		
		if(!$letter.is(':last-child')){
		 	setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
		}else if($bool){ 
		 	setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
		}

		if($letter.is(':last-child') && jQuery('html').hasClass('pagelayer-no-csstransitions')){
			var nextWord = takeNext($word);
			switchWord($word, nextWord);
		} 
	}

	function showLetter($letter, $word, $bool, $duration){
		$letter.addClass('pagelayer-aheading-in').removeClass('pagelayer-aheading-out');
		
		if(!$letter.is(':last-child')){ 
			setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
		}else{
			if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
		}
	}

	function takeNext($word){
		return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
	}

	function switchWord($oldWord, $newWord){
		$oldWord.removeClass('pagelayer-is-visible').addClass('pagelayer-is-hidden');
		if(!$newWord.hasClass('pagelayer-is-visible')){
  		$newWord.removeClass('pagelayer-is-hidden').addClass('pagelayer-is-visible');
    }  
	}
}

function pagelayer_pl_row_slider(jEle){
	var index = 0;
 
	var imageEls = jEle.find('.pagelayer-bgimg-slide'); // Get the images to be cycled.
	var speed = jEle.data('speed'); // Get the speed of loop.
	imageEls.first().addClass('pagelayer-slide-show');
	setInterval(function (){
		// Get the next index.  If at end, restart to the beginning.
		index = index + 1 < imageEls.length ? index + 1 : 0;
		
		// Show the next
		imageEls.eq(index).addClass('pagelayer-slide-show');
		
		// Hide the previous
		imageEls.eq(index - 1).removeClass('pagelayer-slide-show');
	}, speed);
}

function pagelayer_pl_social_profile(jEle){
	var icon_holder = jEle.find('.pagelayer-icon-holder');
	
	// Assigning animation classes to icon holder
	if(!pagelayer_empty(jEle.attr('pagelayer-animation'))){
		icon_holder.addClass('pagelayer-animation-'+jEle.attr('pagelayer-animation'));
	}
}

// Post infinite scroll handler
function pagelayer_infinite_posts(jEle) {
	
	var loader = jEle.find('.pagelayer-btn-load');
	var autoScroll = jEle.find('.pagelayer-infinite-scroll-auto').length < 1;
	
	loader.on('click', function(){
	
		var bEle = jQuery(this);
		var loaded = jEle.attr('pagelayer-post-data-loading');
		
		// Is loading?
		if(!pagelayer_empty(loaded)){
			return;
		}
		
		jEle.attr('pagelayer-post-data-loading', 1);

		var current = bEle.attr('data-current') || 1;
		var nextPage = parseInt(current) + 1;
		var load_btn = jEle.find('.pagelayer_load_button');

		bEle.hide();
		load_btn.find('.pagelayer-loader-holder').show();

		if(jEle.find('.pagelayer-post-max').attr('data-max') <= 1) {
			load_btn.text(load_btn.data('text'));
			return;
		}
		
		// Get Data from local variable
		var data = window['pagelayer_local_scripts']['pagelayer_post_' + jEle.attr("pagelayer-id")];
		
		// Add next page number to load
		if(!pagelayer_empty(data.atts)){
			data.atts['paged'] = nextPage;
		}
		
		// Get the Posts
		jQuery.ajax({
			url: pagelayer_ajaxurl + 'action=pagelayer_infinite_posts',
			type: 'POST',
			data: {
				pagelayer_nonce: pagelayer_global_nonce,
				data: data,
			},
			success: function(result){
				
				var json = jQuery.parseJSON(result);
				var content = jQuery(json['posts']).find('.pagelayer-posts-container').html();
				
				jEle.find('.pagelayer-posts-container').append(content);

				load_btn.find('.pagelayer-loader-holder').hide();

				if (jEle.find('.pagelayer-post-max').attr('data-max') == nextPage) {
					load_btn.text(load_btn.data('text'));
				}else if(autoScroll){
					bEle.show();
				}
				
				bEle.attr('data-current', nextPage);
			},
			complete: function(){
				jEle.removeAttr('pagelayer-post-data-loading');
			}
		});	
		
	});
	
	// If already scrolled
	if(pagelayer_isVisible(loader)){
		loader.click();
	}
	
	// Auto scroll?
	if(autoScroll){
		return;
	}
	
	var win = jQuery(window);
	win.on('scroll.archive_posts', function(){
		var current = parseInt(loader.attr('data-current')) || 1;
		var total = loader.attr('data-max');
		
		if(win.scrollTop() + win.height() < jEle.height() || current >= total) {
			return;
		}
	
		loader.click();
	});
	
}

////////////////
// Freemium End
////////////////



/*! WOW wow.js - v1.3.0 - 2016-10-04
* https://wowjs.uk
* Copyright (c) 2016 Thomas Grainger; Licensed MIT */!function(a,b){if("function"==typeof define&&define.amd)define(["module","exports"],b);else if("undefined"!=typeof exports)b(module,exports);else{var c={exports:{}};b(c,c.exports),a.WOW=c.exports}}(this,function(a,b){"use strict";function c(a,b){if(!(a instanceof b))throw new TypeError("Cannot call a class as a function")}function d(a,b){return b.indexOf(a)>=0}function e(a,b){for(var c in b)if(null==a[c]){var d=b[c];a[c]=d}return a}function f(a){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)}function g(a){var b=arguments.length<=1||void 0===arguments[1]?!1:arguments[1],c=arguments.length<=2||void 0===arguments[2]?!1:arguments[2],d=arguments.length<=3||void 0===arguments[3]?null:arguments[3],e=void 0;return null!=document.createEvent?(e=document.createEvent("CustomEvent"),e.initCustomEvent(a,b,c,d)):null!=document.createEventObject?(e=document.createEventObject(),e.eventType=a):e.eventName=a,e}function h(a,b){null!=a.dispatchEvent?a.dispatchEvent(b):b in(null!=a)?a[b]():"on"+b in(null!=a)&&a["on"+b]()}function i(a,b,c){null!=a.addEventListener?a.addEventListener(b,c,!1):null!=a.attachEvent?a.attachEvent("on"+b,c):a[b]=c}function j(a,b,c){null!=a.removeEventListener?a.removeEventListener(b,c,!1):null!=a.detachEvent?a.detachEvent("on"+b,c):delete a[b]}function k(){return"innerHeight"in window?window.innerHeight:document.documentElement.clientHeight}Object.defineProperty(b,"__esModule",{value:!0});var l,m,n=function(){function a(a,b){for(var c=0;c<b.length;c++){var d=b[c];d.enumerable=d.enumerable||!1,d.configurable=!0,"value"in d&&(d.writable=!0),Object.defineProperty(a,d.key,d)}}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}(),o=window.WeakMap||window.MozWeakMap||function(){function a(){c(this,a),this.keys=[],this.values=[]}return n(a,[{key:"get",value:function(a){for(var b=0;b<this.keys.length;b++){var c=this.keys[b];if(c===a)return this.values[b]}}},{key:"set",value:function(a,b){for(var c=0;c<this.keys.length;c++){var d=this.keys[c];if(d===a)return this.values[c]=b,this}return this.keys.push(a),this.values.push(b),this}}]),a}(),p=window.MutationObserver||window.WebkitMutationObserver||window.MozMutationObserver||(m=l=function(){function a(){c(this,a),"undefined"!=typeof console&&null!==console&&(console.warn("MutationObserver is not supported by your browser."),console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content."))}return n(a,[{key:"observe",value:function(){}}]),a}(),l.notSupported=!0,m),q=window.getComputedStyle||function(a){var b=/(\-([a-z]){1})/g;return{getPropertyValue:function(c){"float"===c&&(c="styleFloat"),b.test(c)&&c.replace(b,function(a,b){return b.toUpperCase()});var d=a.currentStyle;return(null!=d?d[c]:void 0)||null}}},r=function(){function a(){var b=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];c(this,a),this.defaults={boxClass:"wow",animateClass:"animated",offset:0,mobile:!0,live:!0,callback:null,scrollContainer:null,resetAnimation:!0},this.animate=function(){return"requestAnimationFrame"in window?function(a){return window.requestAnimationFrame(a)}:function(a){return a()}}(),this.vendors=["moz","webkit"],this.start=this.start.bind(this),this.resetAnimation=this.resetAnimation.bind(this),this.scrollHandler=this.scrollHandler.bind(this),this.scrollCallback=this.scrollCallback.bind(this),this.scrolled=!0,this.config=e(b,this.defaults),null!=b.scrollContainer&&(this.config.scrollContainer=document.querySelector(b.scrollContainer)),this.animationNameCache=new o,this.wowEvent=g(this.config.boxClass)}return n(a,[{key:"init",value:function(){this.element=window.document.documentElement,d(document.readyState,["interactive","complete"])?this.start():i(document,"DOMContentLoaded",this.start),this.finished=[]}},{key:"start",value:function(){var a=this;if(this.stopped=!1,this.boxes=[].slice.call(this.element.querySelectorAll("."+this.config.boxClass)),this.all=this.boxes.slice(0),this.boxes.length)if(this.disabled())this.resetStyle();else for(var b=0;b<this.boxes.length;b++){var c=this.boxes[b];this.applyStyle(c,!0)}if(this.disabled()||(i(this.config.scrollContainer||window,"scroll",this.scrollHandler),i(window,"resize",this.scrollHandler),this.interval=setInterval(this.scrollCallback,50)),this.config.live){var d=new p(function(b){for(var c=0;c<b.length;c++)for(var d=b[c],e=0;e<d.addedNodes.length;e++){var f=d.addedNodes[e];a.doSync(f)}});d.observe(document.body,{childList:!0,subtree:!0})}}},{key:"stop",value:function(){this.stopped=!0,j(this.config.scrollContainer||window,"scroll",this.scrollHandler),j(window,"resize",this.scrollHandler),null!=this.interval&&clearInterval(this.interval)}},{key:"sync",value:function(){p.notSupported&&this.doSync(this.element)}},{key:"doSync",value:function(a){if("undefined"!=typeof a&&null!==a||(a=this.element),1===a.nodeType){a=a.parentNode||a;for(var b=a.querySelectorAll("."+this.config.boxClass),c=0;c<b.length;c++){var e=b[c];d(e,this.all)||(this.boxes.push(e),this.all.push(e),this.stopped||this.disabled()?this.resetStyle():this.applyStyle(e,!0),this.scrolled=!0)}}}},{key:"show",value:function(a){return this.applyStyle(a),a.className=a.className+" "+this.config.animateClass,null!=this.config.callback&&this.config.callback(a),h(a,this.wowEvent),this.config.resetAnimation&&(i(a,"animationend",this.resetAnimation),i(a,"oanimationend",this.resetAnimation),i(a,"webkitAnimationEnd",this.resetAnimation),i(a,"MSAnimationEnd",this.resetAnimation)),a}},{key:"applyStyle",value:function(a,b){var c=this,d=a.getAttribute("data-wow-duration"),e=a.getAttribute("data-wow-delay"),f=a.getAttribute("data-wow-iteration");return this.animate(function(){return c.customStyle(a,b,d,e,f)})}},{key:"resetStyle",value:function(){for(var a=0;a<this.boxes.length;a++){var b=this.boxes[a];b.style.visibility="visible"}}},{key:"resetAnimation",value:function(a){if(a.type.toLowerCase().indexOf("animationend")>=0){var b=a.target||a.srcElement;b.className=b.className.replace(this.config.animateClass,"").trim()}}},{key:"customStyle",value:function(a,b,c,d,e){return b&&this.cacheAnimationName(a),a.style.visibility=b?"hidden":"visible",c&&this.vendorSet(a.style,{animationDuration:c}),d&&this.vendorSet(a.style,{animationDelay:d}),e&&this.vendorSet(a.style,{animationIterationCount:e}),this.vendorSet(a.style,{animationName:b?"none":this.cachedAnimationName(a)}),a}},{key:"vendorSet",value:function(a,b){for(var c in b)if(b.hasOwnProperty(c)){var d=b[c];a[""+c]=d;for(var e=0;e<this.vendors.length;e++){var f=this.vendors[e];a[""+f+c.charAt(0).toUpperCase()+c.substr(1)]=d}}}},{key:"vendorCSS",value:function(a,b){for(var c=q(a),d=c.getPropertyCSSValue(b),e=0;e<this.vendors.length;e++){var f=this.vendors[e];d=d||c.getPropertyCSSValue("-"+f+"-"+b)}return d}},{key:"animationName",value:function(a){var b=void 0;try{b=this.vendorCSS(a,"animation-name").cssText}catch(c){b=q(a).getPropertyValue("animation-name")}return"none"===b?"":b}},{key:"cacheAnimationName",value:function(a){return this.animationNameCache.set(a,this.animationName(a))}},{key:"cachedAnimationName",value:function(a){return this.animationNameCache.get(a)}},{key:"scrollHandler",value:function(){this.scrolled=!0}},{key:"scrollCallback",value:function(){if(this.scrolled){this.scrolled=!1;for(var a=[],b=0;b<this.boxes.length;b++){var c=this.boxes[b];if(c){if(this.isVisible(c)){this.show(c);continue}a.push(c)}}this.boxes=a,this.boxes.length||this.config.live||this.stop()}}},{key:"offsetTop",value:function(a){for(;void 0===a.offsetTop;)a=a.parentNode;for(var b=a.offsetTop;a.offsetParent;)a=a.offsetParent,b+=a.offsetTop;return b}},{key:"isVisible",value:function(a){var b=a.getAttribute("data-wow-offset")||this.config.offset,c=this.config.scrollContainer&&this.config.scrollContainer.scrollTop||window.pageYOffset,d=c+Math.min(this.element.clientHeight,k())-b,e=this.offsetTop(a),f=e+a.clientHeight;return d>=e&&f>=c}},{key:"disabled",value:function(){return!this.config.mobile&&f(navigator.userAgent)}}]),a}();b["default"]=r,a.exports=b["default"]});

/* 
 *   jQuery Numerator Plugin 0.2.1
 *   https://github.com/garethdn/jquery-numerator
 *
 *   Copyright 2015, Gareth Nolan
 *   http://ie.linkedin.com/in/garethnolan/

 *   Based on jQuery Boilerplate by Zeno Rocha with the help of Addy Osmani
 *   http://jqueryboilerplate.com
 *
 *   Licensed under the MIT license:
 *   http://www.opensource.org/licenses/MIT
 */

;(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.
        if (typeof jQuery === 'undefined') {
            throw 'jquery-numerator requires jQuery to be loaded first';
        }
        factory(jQuery);
    }
}(function ($) {

    var pluginName = "numerator",
    defaults = {
        easing: 'swing',
        duration: 500,
        delimiter: undefined,
        rounding: 0,
        toValue: undefined,
        fromValue: undefined,
        queue: false,
        onStart: function(){},
        onStep: function(){},
        onProgress: function(){},
        onComplete: function(){}
    };

    function Plugin ( element, options ) {
        this.element = element;
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {

        init: function () {
            this.parseElement();
            this.setValue();
        },

        parseElement: function () {
            var elText = $.trim($(this.element).text());

            this.settings.fromValue = this.settings.fromValue || this.format(elText);
        },

        setValue: function() {
            var self = this;

            $({value: self.settings.fromValue}).animate({value: self.settings.toValue}, {

                duration: parseInt(self.settings.duration, 10),

                easing: self.settings.easing,

                start: self.settings.onStart,

                step: function(now, fx) {
                    $(self.element).text(self.format(now));
                    // accepts two params - (now, fx)
                    self.settings.onStep(now, fx);
                },

                // accepts three params - (animation object, progress ratio, time remaining(ms))
                progress: self.settings.onProgress,

                complete: self.settings.onComplete
            });
        },

        format: function(value){
            var self = this;

            if ( parseInt(this.settings.rounding ) < 1) {
                value = parseInt(value, 10);
            } else {
                value = parseFloat(value).toFixed( parseInt(this.settings.rounding) );
            }

            if (self.settings.delimiter) {
                return this.delimit(value)
            } else {
                return value;
            } 
        },

        // TODO: Add comments to this function
        delimit: function(value){
            var self = this;

            value = value.toString();

            if (self.settings.rounding && parseInt(self.settings.rounding, 10) > 0) {
                var decimals = value.substring( (value.length - (self.settings.rounding + 1)), value.length ),
                    wholeValue = value.substring( 0, (value.length - (self.settings.rounding + 1)));

                return self.addDelimiter(wholeValue) + decimals;
            } else {
                return self.addDelimiter(value);
            }
        },

        addDelimiter: function(value){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, this.settings.delimiter);
        }
    };

    $.fn[ pluginName ] = function ( options ) {
        return this.each(function() {
            if ( $.data( this, "plugin_" + pluginName ) ) {
                $.data(this, 'plugin_' + pluginName, null);
            }
            $.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
        });
    };

}));

/**
 * simple-parallax-js - simpleParallax is a simple and lightweight JS plugin that gives your website parallax animations on the images
 * @version v4.2.1
 * @date: 09-03-2019 17:4:39
 * @link https://simpleparallax.com/
 */
"use strict";var _extends=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(e[i]=n[i])}return e},_createClass=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}(),_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}!function(e,t){"function"==typeof define&&define.amd?define([],function(){return t(e)}):"object"===("undefined"==typeof exports?"undefined":_typeof(exports))?module.exports=t(e):e.pagelayerParallax=t(e)}("undefined"!=typeof global?global:"undefined"!=typeof window?window:void 0,function(o){var i=function(){for(var e,t="transform webkitTransform mozTransform oTransform msTransform".split(" "),n=0;void 0===e;)e=null!=document.createElement("div").style[t[n]]?t[n]:void 0,n++;return e}();!function(){for(var a=0,e=["ms","moz","webkit","o"],t=0;t<e.length&&!o.requestAnimationFrame;++t)o.requestAnimationFrame=o[e[t]+"RequestAnimationFrame"],o.cancelAnimationFrame=o[e[t]+"CancelAnimationFrame"]||o[e[t]+"CancelRequestAnimationFrame"];o.requestAnimationFrame||(o.requestAnimationFrame=function(e,t){var n=(new Date).getTime(),i=Math.max(0,16-(n-a)),s=o.setTimeout(function(){e(n+i)},i);return a=n+i,s}),o.cancelAnimationFrame||(o.cancelAnimationFrame=function(e){clearTimeout(e)})}(),Element.prototype.matches||(Element.prototype.matches=Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector),Element.prototype.closest||(Element.prototype.closest=function(e){var t=this;if(!document.documentElement.contains(t))return null;do{if(t.matches(e))return t;t=t.parentElement||t.parentNode}while(null!==t&&1===t.nodeType);return null});var s=[],t=-1,a=void 0,r=void 0,l=void 0,h=void 0,m=!1,u=function(){function n(e,t){_classCallCheck(this,n),this.element=e,this.elementContainer=e,this.defaults={delay:.6,orientation:"up",scale:1.3,overflow:!1,transition:"cubic-bezier(0,0,0,1)",breakpoint:!1},this.settings=_extends(this.defaults,t),this.settings.breakpoint&&document.documentElement.clientWidth<=this.settings.breakpoint||(this.init=this.init.bind(this),this.animationFrame=this.animationFrame.bind(this),this.handleResize=this.handleResize.bind(this),this.isImageLoaded(this.element)?this.init():this.element.addEventListener("load",this.init),s.push(this),m||(m=!0,this.getViewportOffsetHeight(),this.animationFrame()))}return _createClass(n,[{key:"init",value:function(){this.isInit||(!1===this.settings.overflow&&this.wrapElement(),this.setStyle(),this.getElementOffset(),this.getTranslateValue(),this.animate(),o.addEventListener("resize",this.handleResize),this.isInit=!0)}},{key:"isImageLoaded",value:function(){return!!this.element.complete&&(void 0===this.element.naturalWidth||0!==this.element.naturalWidth)}},{key:"isVisible",value:function(){return this.elementBottomX>a&&this.elementTopX<r}},{key:"wrapElement",value:function(){var e=this.element.closest("picture")||this.element,t=document.createElement("div");t.classList.add("pagelayerParallax"),t.style.overflow="hidden",e.parentNode.insertBefore(t,e),t.appendChild(e),this.elementContainer=t}},{key:"unWrapElement",value:function(){var e=this.elementContainer.parentNode;if(e){for(;this.elementContainer.firstChild;)e.insertBefore(this.elementContainer.firstChild,this.elementContainer);e.removeChild(this.elementContainer)}}},{key:"setStyle",value:function(){!1===this.settings.overflow&&(this.element.style[i]="scale("+this.settings.scale+")"),0<this.settings.delay&&(this.element.style.transition="transform "+this.settings.delay+"s "+this.settings.transition),this.element.style.willChange="transform"}},{key:"unSetStyle",value:function(){this.element.style.willChange="",this.element.style[i]="",this.element.style.transition=""}},{key:"getElementOffset",value:function(){var e=this.elementContainer.getBoundingClientRect();this.elementHeight=e.height,this.elementTopX=e.top+o.pageYOffset,this.elementBottomX=this.elementHeight+this.elementTopX}},{key:"getViewportOffsetTop",value:function(){a=o.pageYOffset}},{key:"getViewportOffsetHeight",value:function(){l=document.documentElement.clientHeight}},{key:"getViewportOffsetBottom",value:function(){r=a+l}},{key:"handleResize",value:function(){this.getViewportOffsetHeight(),this.getElementOffset(),this.getRangeMax()}},{key:"getRangeMax",value:function(){var e=this.element.clientHeight;this.rangeMax=e*this.settings.scale-e,"down"!==this.settings.orientation&&"right"!==this.settings.orientation||(this.rangeMax*=-1)}},{key:"getTranslateValue",value:function(){var e=((r-this.elementTopX)/((l+this.elementHeight)/100)).toFixed(1);return e=Math.min(100,Math.max(0,e)),this.oldPercentage!==e&&(this.rangeMax||this.getRangeMax(),this.translateValue=(e/100*this.rangeMax-this.rangeMax/2).toFixed(0),this.oldTranslateValue!==this.translateValue&&(this.oldPercentage=e,this.oldTranslateValue=this.translateValue,!0))}},{key:"animate",value:function(){var e=0,t=0,n=void 0;"left"===this.settings.orientation||"right"===this.settings.orientation?t=this.translateValue+"px":e=this.translateValue+"px",n=!1===this.settings.overflow?"translate3d("+t+", "+e+", 0) scale("+this.settings.scale+")":"translate3d("+t+", "+e+", 0)",this.element.style[i]=n}},{key:"proceedElement",value:function(e){e.isVisible()&&e.getTranslateValue()&&e.animate()}},{key:"animationFrame",value:function(){if(this.getViewportOffsetTop(),t!==a){this.getViewportOffsetBottom();for(var e=0;e<s.length;e++)this.proceedElement(s[e]);h=o.requestAnimationFrame(this.animationFrame),t=a}else h=o.requestAnimationFrame(this.animationFrame)}},{key:"destroy",value:function(){this.isDestroyed||(this.unSetStyle(),!1===this.settings.overflow&&this.unWrapElement(),s.splice(s.indexOf(this),1),s.length||(m=!1,o.cancelAnimationFrame(h)),o.removeEventListener("resize",this.handleResize))}},{key:"isDestroyed",get:function(){return-1===s.indexOf(this)}}]),n}();return function(e,t){var n=[];if(e.length)for(var i=0;i<e.length;i++)n.push(new u(e[i],t));else n.push(new u(e,t));return n}});

/*!
 * Chart.js v2.8.0
 * https://www.chartjs.org
 * (c) 2019 Chart.js Contributors
 * Released under the MIT License
 */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e(function(){try{return require("moment")}catch(t){}}()):"function"==typeof define&&define.amd?define(["require"],function(t){return e(function(){try{return t("moment")}catch(t){}}())}):t.Chart=e(t.moment)}(this,function(t){"use strict";t=t&&t.hasOwnProperty("default")?t.default:t;var e={rgb2hsl:i,rgb2hsv:n,rgb2hwb:a,rgb2cmyk:o,rgb2keyword:s,rgb2xyz:l,rgb2lab:d,rgb2lch:function(t){return x(d(t))},hsl2rgb:u,hsl2hsv:function(t){var e=t[0],i=t[1]/100,n=t[2]/100;if(0===n)return[0,0,0];return[e,100*(2*(i*=(n*=2)<=1?n:2-n)/(n+i)),100*((n+i)/2)]},hsl2hwb:function(t){return a(u(t))},hsl2cmyk:function(t){return o(u(t))},hsl2keyword:function(t){return s(u(t))},hsv2rgb:h,hsv2hsl:function(t){var e,i,n=t[0],a=t[1]/100,o=t[2]/100;return e=a*o,[n,100*(e=(e/=(i=(2-a)*o)<=1?i:2-i)||0),100*(i/=2)]},hsv2hwb:function(t){return a(h(t))},hsv2cmyk:function(t){return o(h(t))},hsv2keyword:function(t){return s(h(t))},hwb2rgb:c,hwb2hsl:function(t){return i(c(t))},hwb2hsv:function(t){return n(c(t))},hwb2cmyk:function(t){return o(c(t))},hwb2keyword:function(t){return s(c(t))},cmyk2rgb:f,cmyk2hsl:function(t){return i(f(t))},cmyk2hsv:function(t){return n(f(t))},cmyk2hwb:function(t){return a(f(t))},cmyk2keyword:function(t){return s(f(t))},keyword2rgb:w,keyword2hsl:function(t){return i(w(t))},keyword2hsv:function(t){return n(w(t))},keyword2hwb:function(t){return a(w(t))},keyword2cmyk:function(t){return o(w(t))},keyword2lab:function(t){return d(w(t))},keyword2xyz:function(t){return l(w(t))},xyz2rgb:p,xyz2lab:m,xyz2lch:function(t){return x(m(t))},lab2xyz:v,lab2rgb:y,lab2lch:x,lch2lab:k,lch2xyz:function(t){return v(k(t))},lch2rgb:function(t){return y(k(t))}};function i(t){var e,i,n=t[0]/255,a=t[1]/255,o=t[2]/255,r=Math.min(n,a,o),s=Math.max(n,a,o),l=s-r;return s==r?e=0:n==s?e=(a-o)/l:a==s?e=2+(o-n)/l:o==s&&(e=4+(n-a)/l),(e=Math.min(60*e,360))<0&&(e+=360),i=(r+s)/2,[e,100*(s==r?0:i<=.5?l/(s+r):l/(2-s-r)),100*i]}function n(t){var e,i,n=t[0],a=t[1],o=t[2],r=Math.min(n,a,o),s=Math.max(n,a,o),l=s-r;return i=0==s?0:l/s*1e3/10,s==r?e=0:n==s?e=(a-o)/l:a==s?e=2+(o-n)/l:o==s&&(e=4+(n-a)/l),(e=Math.min(60*e,360))<0&&(e+=360),[e,i,s/255*1e3/10]}function a(t){var e=t[0],n=t[1],a=t[2];return[i(t)[0],100*(1/255*Math.min(e,Math.min(n,a))),100*(a=1-1/255*Math.max(e,Math.max(n,a)))]}function o(t){var e,i=t[0]/255,n=t[1]/255,a=t[2]/255;return[100*((1-i-(e=Math.min(1-i,1-n,1-a)))/(1-e)||0),100*((1-n-e)/(1-e)||0),100*((1-a-e)/(1-e)||0),100*e]}function s(t){return _[JSON.stringify(t)]}function l(t){var e=t[0]/255,i=t[1]/255,n=t[2]/255;return[100*(.4124*(e=e>.04045?Math.pow((e+.055)/1.055,2.4):e/12.92)+.3576*(i=i>.04045?Math.pow((i+.055)/1.055,2.4):i/12.92)+.1805*(n=n>.04045?Math.pow((n+.055)/1.055,2.4):n/12.92)),100*(.2126*e+.7152*i+.0722*n),100*(.0193*e+.1192*i+.9505*n)]}function d(t){var e=l(t),i=e[0],n=e[1],a=e[2];return n/=100,a/=108.883,i=(i/=95.047)>.008856?Math.pow(i,1/3):7.787*i+16/116,[116*(n=n>.008856?Math.pow(n,1/3):7.787*n+16/116)-16,500*(i-n),200*(n-(a=a>.008856?Math.pow(a,1/3):7.787*a+16/116))]}function u(t){var e,i,n,a,o,r=t[0]/360,s=t[1]/100,l=t[2]/100;if(0==s)return[o=255*l,o,o];e=2*l-(i=l<.5?l*(1+s):l+s-l*s),a=[0,0,0];for(var d=0;d<3;d++)(n=r+1/3*-(d-1))<0&&n++,n>1&&n--,o=6*n<1?e+6*(i-e)*n:2*n<1?i:3*n<2?e+(i-e)*(2/3-n)*6:e,a[d]=255*o;return a}function h(t){var e=t[0]/60,i=t[1]/100,n=t[2]/100,a=Math.floor(e)%6,o=e-Math.floor(e),r=255*n*(1-i),s=255*n*(1-i*o),l=255*n*(1-i*(1-o));n*=255;switch(a){case 0:return[n,l,r];case 1:return[s,n,r];case 2:return[r,n,l];case 3:return[r,s,n];case 4:return[l,r,n];case 5:return[n,r,s]}}function c(t){var e,i,n,a,o=t[0]/360,s=t[1]/100,l=t[2]/100,d=s+l;switch(d>1&&(s/=d,l/=d),n=6*o-(e=Math.floor(6*o)),0!=(1&e)&&(n=1-n),a=s+n*((i=1-l)-s),e){default:case 6:case 0:r=i,g=a,b=s;break;case 1:r=a,g=i,b=s;break;case 2:r=s,g=i,b=a;break;case 3:r=s,g=a,b=i;break;case 4:r=a,g=s,b=i;break;case 5:r=i,g=s,b=a}return[255*r,255*g,255*b]}function f(t){var e=t[0]/100,i=t[1]/100,n=t[2]/100,a=t[3]/100;return[255*(1-Math.min(1,e*(1-a)+a)),255*(1-Math.min(1,i*(1-a)+a)),255*(1-Math.min(1,n*(1-a)+a))]}function p(t){var e,i,n,a=t[0]/100,o=t[1]/100,r=t[2]/100;return i=-.9689*a+1.8758*o+.0415*r,n=.0557*a+-.204*o+1.057*r,e=(e=3.2406*a+-1.5372*o+-.4986*r)>.0031308?1.055*Math.pow(e,1/2.4)-.055:e*=12.92,i=i>.0031308?1.055*Math.pow(i,1/2.4)-.055:i*=12.92,n=n>.0031308?1.055*Math.pow(n,1/2.4)-.055:n*=12.92,[255*(e=Math.min(Math.max(0,e),1)),255*(i=Math.min(Math.max(0,i),1)),255*(n=Math.min(Math.max(0,n),1))]}function m(t){var e=t[0],i=t[1],n=t[2];return i/=100,n/=108.883,e=(e/=95.047)>.008856?Math.pow(e,1/3):7.787*e+16/116,[116*(i=i>.008856?Math.pow(i,1/3):7.787*i+16/116)-16,500*(e-i),200*(i-(n=n>.008856?Math.pow(n,1/3):7.787*n+16/116))]}function v(t){var e,i,n,a,o=t[0],r=t[1],s=t[2];return o<=8?a=(i=100*o/903.3)/100*7.787+16/116:(i=100*Math.pow((o+16)/116,3),a=Math.pow(i/100,1/3)),[e=e/95.047<=.008856?e=95.047*(r/500+a-16/116)/7.787:95.047*Math.pow(r/500+a,3),i,n=n/108.883<=.008859?n=108.883*(a-s/200-16/116)/7.787:108.883*Math.pow(a-s/200,3)]}function x(t){var e,i=t[0],n=t[1],a=t[2];return(e=360*Math.atan2(a,n)/2/Math.PI)<0&&(e+=360),[i,Math.sqrt(n*n+a*a),e]}function y(t){return p(v(t))}function k(t){var e,i=t[0],n=t[1];return e=t[2]/360*2*Math.PI,[i,n*Math.cos(e),n*Math.sin(e)]}function w(t){return M[t]}var M={aliceblue:[240,248,255],antiquewhite:[250,235,215],aqua:[0,255,255],aquamarine:[127,255,212],azure:[240,255,255],beige:[245,245,220],bisque:[255,228,196],black:[0,0,0],blanchedalmond:[255,235,205],blue:[0,0,255],blueviolet:[138,43,226],brown:[165,42,42],burlywood:[222,184,135],cadetblue:[95,158,160],chartreuse:[127,255,0],chocolate:[210,105,30],coral:[255,127,80],cornflowerblue:[100,149,237],cornsilk:[255,248,220],crimson:[220,20,60],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgoldenrod:[184,134,11],darkgray:[169,169,169],darkgreen:[0,100,0],darkgrey:[169,169,169],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkseagreen:[143,188,143],darkslateblue:[72,61,139],darkslategray:[47,79,79],darkslategrey:[47,79,79],darkturquoise:[0,206,209],darkviolet:[148,0,211],deeppink:[255,20,147],deepskyblue:[0,191,255],dimgray:[105,105,105],dimgrey:[105,105,105],dodgerblue:[30,144,255],firebrick:[178,34,34],floralwhite:[255,250,240],forestgreen:[34,139,34],fuchsia:[255,0,255],gainsboro:[220,220,220],ghostwhite:[248,248,255],gold:[255,215,0],goldenrod:[218,165,32],gray:[128,128,128],green:[0,128,0],greenyellow:[173,255,47],grey:[128,128,128],honeydew:[240,255,240],hotpink:[255,105,180],indianred:[205,92,92],indigo:[75,0,130],ivory:[255,255,240],khaki:[240,230,140],lavender:[230,230,250],lavenderblush:[255,240,245],lawngreen:[124,252,0],lemonchiffon:[255,250,205],lightblue:[173,216,230],lightcoral:[240,128,128],lightcyan:[224,255,255],lightgoldenrodyellow:[250,250,210],lightgray:[211,211,211],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightsalmon:[255,160,122],lightseagreen:[32,178,170],lightskyblue:[135,206,250],lightslategray:[119,136,153],lightslategrey:[119,136,153],lightsteelblue:[176,196,222],lightyellow:[255,255,224],lime:[0,255,0],limegreen:[50,205,50],linen:[250,240,230],magenta:[255,0,255],maroon:[128,0,0],mediumaquamarine:[102,205,170],mediumblue:[0,0,205],mediumorchid:[186,85,211],mediumpurple:[147,112,219],mediumseagreen:[60,179,113],mediumslateblue:[123,104,238],mediumspringgreen:[0,250,154],mediumturquoise:[72,209,204],mediumvioletred:[199,21,133],midnightblue:[25,25,112],mintcream:[245,255,250],mistyrose:[255,228,225],moccasin:[255,228,181],navajowhite:[255,222,173],navy:[0,0,128],oldlace:[253,245,230],olive:[128,128,0],olivedrab:[107,142,35],orange:[255,165,0],orangered:[255,69,0],orchid:[218,112,214],palegoldenrod:[238,232,170],palegreen:[152,251,152],paleturquoise:[175,238,238],palevioletred:[219,112,147],papayawhip:[255,239,213],peachpuff:[255,218,185],peru:[205,133,63],pink:[255,192,203],plum:[221,160,221],powderblue:[176,224,230],purple:[128,0,128],rebeccapurple:[102,51,153],red:[255,0,0],rosybrown:[188,143,143],royalblue:[65,105,225],saddlebrown:[139,69,19],salmon:[250,128,114],sandybrown:[244,164,96],seagreen:[46,139,87],seashell:[255,245,238],sienna:[160,82,45],silver:[192,192,192],skyblue:[135,206,235],slateblue:[106,90,205],slategray:[112,128,144],slategrey:[112,128,144],snow:[255,250,250],springgreen:[0,255,127],steelblue:[70,130,180],tan:[210,180,140],teal:[0,128,128],thistle:[216,191,216],tomato:[255,99,71],turquoise:[64,224,208],violet:[238,130,238],wheat:[245,222,179],white:[255,255,255],whitesmoke:[245,245,245],yellow:[255,255,0],yellowgreen:[154,205,50]},_={};for(var C in M)_[JSON.stringify(M[C])]=C;var S=function(){return new T};for(var P in e){S[P+"Raw"]=function(t){return function(i){return"number"==typeof i&&(i=Array.prototype.slice.call(arguments)),e[t](i)}}(P);var I=/(\w+)2(\w+)/.exec(P),A=I[1],D=I[2];(S[A]=S[A]||{})[D]=S[P]=function(t){return function(i){"number"==typeof i&&(i=Array.prototype.slice.call(arguments));var n=e[t](i);if("string"==typeof n||void 0===n)return n;for(var a=0;a<n.length;a++)n[a]=Math.round(n[a]);return n}}(P)}var T=function(){this.convs={}};T.prototype.routeSpace=function(t,e){var i=e[0];return void 0===i?this.getValues(t):("number"==typeof i&&(i=Array.prototype.slice.call(e)),this.setValues(t,i))},T.prototype.setValues=function(t,e){return this.space=t,this.convs={},this.convs[t]=e,this},T.prototype.getValues=function(t){var e=this.convs[t];if(!e){var i=this.space,n=this.convs[i];e=S[i][t](n),this.convs[t]=e}return e},["rgb","hsl","hsv","cmyk","keyword"].forEach(function(t){T.prototype[t]=function(e){return this.routeSpace(t,arguments)}});var F=S,L={aliceblue:[240,248,255],antiquewhite:[250,235,215],aqua:[0,255,255],aquamarine:[127,255,212],azure:[240,255,255],beige:[245,245,220],bisque:[255,228,196],black:[0,0,0],blanchedalmond:[255,235,205],blue:[0,0,255],blueviolet:[138,43,226],brown:[165,42,42],burlywood:[222,184,135],cadetblue:[95,158,160],chartreuse:[127,255,0],chocolate:[210,105,30],coral:[255,127,80],cornflowerblue:[100,149,237],cornsilk:[255,248,220],crimson:[220,20,60],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgoldenrod:[184,134,11],darkgray:[169,169,169],darkgreen:[0,100,0],darkgrey:[169,169,169],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkseagreen:[143,188,143],darkslateblue:[72,61,139],darkslategray:[47,79,79],darkslategrey:[47,79,79],darkturquoise:[0,206,209],darkviolet:[148,0,211],deeppink:[255,20,147],deepskyblue:[0,191,255],dimgray:[105,105,105],dimgrey:[105,105,105],dodgerblue:[30,144,255],firebrick:[178,34,34],floralwhite:[255,250,240],forestgreen:[34,139,34],fuchsia:[255,0,255],gainsboro:[220,220,220],ghostwhite:[248,248,255],gold:[255,215,0],goldenrod:[218,165,32],gray:[128,128,128],green:[0,128,0],greenyellow:[173,255,47],grey:[128,128,128],honeydew:[240,255,240],hotpink:[255,105,180],indianred:[205,92,92],indigo:[75,0,130],ivory:[255,255,240],khaki:[240,230,140],lavender:[230,230,250],lavenderblush:[255,240,245],lawngreen:[124,252,0],lemonchiffon:[255,250,205],lightblue:[173,216,230],lightcoral:[240,128,128],lightcyan:[224,255,255],lightgoldenrodyellow:[250,250,210],lightgray:[211,211,211],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightsalmon:[255,160,122],lightseagreen:[32,178,170],lightskyblue:[135,206,250],lightslategray:[119,136,153],lightslategrey:[119,136,153],lightsteelblue:[176,196,222],lightyellow:[255,255,224],lime:[0,255,0],limegreen:[50,205,50],linen:[250,240,230],magenta:[255,0,255],maroon:[128,0,0],mediumaquamarine:[102,205,170],mediumblue:[0,0,205],mediumorchid:[186,85,211],mediumpurple:[147,112,219],mediumseagreen:[60,179,113],mediumslateblue:[123,104,238],mediumspringgreen:[0,250,154],mediumturquoise:[72,209,204],mediumvioletred:[199,21,133],midnightblue:[25,25,112],mintcream:[245,255,250],mistyrose:[255,228,225],moccasin:[255,228,181],navajowhite:[255,222,173],navy:[0,0,128],oldlace:[253,245,230],olive:[128,128,0],olivedrab:[107,142,35],orange:[255,165,0],orangered:[255,69,0],orchid:[218,112,214],palegoldenrod:[238,232,170],palegreen:[152,251,152],paleturquoise:[175,238,238],palevioletred:[219,112,147],papayawhip:[255,239,213],peachpuff:[255,218,185],peru:[205,133,63],pink:[255,192,203],plum:[221,160,221],powderblue:[176,224,230],purple:[128,0,128],rebeccapurple:[102,51,153],red:[255,0,0],rosybrown:[188,143,143],royalblue:[65,105,225],saddlebrown:[139,69,19],salmon:[250,128,114],sandybrown:[244,164,96],seagreen:[46,139,87],seashell:[255,245,238],sienna:[160,82,45],silver:[192,192,192],skyblue:[135,206,235],slateblue:[106,90,205],slategray:[112,128,144],slategrey:[112,128,144],snow:[255,250,250],springgreen:[0,255,127],steelblue:[70,130,180],tan:[210,180,140],teal:[0,128,128],thistle:[216,191,216],tomato:[255,99,71],turquoise:[64,224,208],violet:[238,130,238],wheat:[245,222,179],white:[255,255,255],whitesmoke:[245,245,245],yellow:[255,255,0],yellowgreen:[154,205,50]},R={getRgba:O,getHsla:z,getRgb:function(t){var e=O(t);return e&&e.slice(0,3)},getHsl:function(t){var e=z(t);return e&&e.slice(0,3)},getHwb:B,getAlpha:function(t){var e=O(t);if(e)return e[3];if(e=z(t))return e[3];if(e=B(t))return e[3]},hexString:function(t,e){var e=void 0!==e&&3===t.length?e:t[3];return"#"+H(t[0])+H(t[1])+H(t[2])+(e>=0&&e<1?H(Math.round(255*e)):"")},rgbString:function(t,e){if(e<1||t[3]&&t[3]<1)return N(t,e);return"rgb("+t[0]+", "+t[1]+", "+t[2]+")"},rgbaString:N,percentString:function(t,e){if(e<1||t[3]&&t[3]<1)return W(t,e);var i=Math.round(t[0]/255*100),n=Math.round(t[1]/255*100),a=Math.round(t[2]/255*100);return"rgb("+i+"%, "+n+"%, "+a+"%)"},percentaString:W,hslString:function(t,e){if(e<1||t[3]&&t[3]<1)return V(t,e);return"hsl("+t[0]+", "+t[1]+"%, "+t[2]+"%)"},hslaString:V,hwbString:function(t,e){void 0===e&&(e=void 0!==t[3]?t[3]:1);return"hwb("+t[0]+", "+t[1]+"%, "+t[2]+"%"+(void 0!==e&&1!==e?", "+e:"")+")"},keyword:function(t){return j[t.slice(0,3)]}};function O(t){if(t){var e=[0,0,0],i=1,n=t.match(/^#([a-fA-F0-9]{3,4})$/i),a="";if(n){a=(n=n[1])[3];for(var o=0;o<e.length;o++)e[o]=parseInt(n[o]+n[o],16);a&&(i=Math.round(parseInt(a+a,16)/255*100)/100)}else if(n=t.match(/^#([a-fA-F0-9]{6}([a-fA-F0-9]{2})?)$/i)){a=n[2],n=n[1];for(o=0;o<e.length;o++)e[o]=parseInt(n.slice(2*o,2*o+2),16);a&&(i=Math.round(parseInt(a,16)/255*100)/100)}else if(n=t.match(/^rgba?\(\s*([+-]?\d+)\s*,\s*([+-]?\d+)\s*,\s*([+-]?\d+)\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)$/i)){for(o=0;o<e.length;o++)e[o]=parseInt(n[o+1]);i=parseFloat(n[4])}else if(n=t.match(/^rgba?\(\s*([+-]?[\d\.]+)\%\s*,\s*([+-]?[\d\.]+)\%\s*,\s*([+-]?[\d\.]+)\%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)$/i)){for(o=0;o<e.length;o++)e[o]=Math.round(2.55*parseFloat(n[o+1]));i=parseFloat(n[4])}else if(n=t.match(/(\w+)/)){if("transparent"==n[1])return[0,0,0,0];if(!(e=L[n[1]]))return}for(o=0;o<e.length;o++)e[o]=E(e[o],0,255);return i=i||0==i?E(i,0,1):1,e[3]=i,e}}function z(t){if(t){var e=t.match(/^hsla?\(\s*([+-]?\d+)(?:deg)?\s*,\s*([+-]?[\d\.]+)%\s*,\s*([+-]?[\d\.]+)%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)/);if(e){var i=parseFloat(e[4]);return[E(parseInt(e[1]),0,360),E(parseFloat(e[2]),0,100),E(parseFloat(e[3]),0,100),E(isNaN(i)?1:i,0,1)]}}}function B(t){if(t){var e=t.match(/^hwb\(\s*([+-]?\d+)(?:deg)?\s*,\s*([+-]?[\d\.]+)%\s*,\s*([+-]?[\d\.]+)%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)/);if(e){var i=parseFloat(e[4]);return[E(parseInt(e[1]),0,360),E(parseFloat(e[2]),0,100),E(parseFloat(e[3]),0,100),E(isNaN(i)?1:i,0,1)]}}}function N(t,e){return void 0===e&&(e=void 0!==t[3]?t[3]:1),"rgba("+t[0]+", "+t[1]+", "+t[2]+", "+e+")"}function W(t,e){return"rgba("+Math.round(t[0]/255*100)+"%, "+Math.round(t[1]/255*100)+"%, "+Math.round(t[2]/255*100)+"%, "+(e||t[3]||1)+")"}function V(t,e){return void 0===e&&(e=void 0!==t[3]?t[3]:1),"hsla("+t[0]+", "+t[1]+"%, "+t[2]+"%, "+e+")"}function E(t,e,i){return Math.min(Math.max(e,t),i)}function H(t){var e=t.toString(16).toUpperCase();return e.length<2?"0"+e:e}var j={};for(var q in L)j[L[q]]=q;var Y=function(t){return t instanceof Y?t:this instanceof Y?(this.valid=!1,this.values={rgb:[0,0,0],hsl:[0,0,0],hsv:[0,0,0],hwb:[0,0,0],cmyk:[0,0,0,0],alpha:1},void("string"==typeof t?(e=R.getRgba(t))?this.setValues("rgb",e):(e=R.getHsla(t))?this.setValues("hsl",e):(e=R.getHwb(t))&&this.setValues("hwb",e):"object"==typeof t&&(void 0!==(e=t).r||void 0!==e.red?this.setValues("rgb",e):void 0!==e.l||void 0!==e.lightness?this.setValues("hsl",e):void 0!==e.v||void 0!==e.value?this.setValues("hsv",e):void 0!==e.w||void 0!==e.whiteness?this.setValues("hwb",e):void 0===e.c&&void 0===e.cyan||this.setValues("cmyk",e)))):new Y(t);var e};Y.prototype={isValid:function(){return this.valid},rgb:function(){return this.setSpace("rgb",arguments)},hsl:function(){return this.setSpace("hsl",arguments)},hsv:function(){return this.setSpace("hsv",arguments)},hwb:function(){return this.setSpace("hwb",arguments)},cmyk:function(){return this.setSpace("cmyk",arguments)},rgbArray:function(){return this.values.rgb},hslArray:function(){return this.values.hsl},hsvArray:function(){return this.values.hsv},hwbArray:function(){var t=this.values;return 1!==t.alpha?t.hwb.concat([t.alpha]):t.hwb},cmykArray:function(){return this.values.cmyk},rgbaArray:function(){var t=this.values;return t.rgb.concat([t.alpha])},hslaArray:function(){var t=this.values;return t.hsl.concat([t.alpha])},alpha:function(t){return void 0===t?this.values.alpha:(this.setValues("alpha",t),this)},red:function(t){return this.setChannel("rgb",0,t)},green:function(t){return this.setChannel("rgb",1,t)},blue:function(t){return this.setChannel("rgb",2,t)},hue:function(t){return t&&(t=(t%=360)<0?360+t:t),this.setChannel("hsl",0,t)},saturation:function(t){return this.setChannel("hsl",1,t)},lightness:function(t){return this.setChannel("hsl",2,t)},saturationv:function(t){return this.setChannel("hsv",1,t)},whiteness:function(t){return this.setChannel("hwb",1,t)},blackness:function(t){return this.setChannel("hwb",2,t)},value:function(t){return this.setChannel("hsv",2,t)},cyan:function(t){return this.setChannel("cmyk",0,t)},magenta:function(t){return this.setChannel("cmyk",1,t)},yellow:function(t){return this.setChannel("cmyk",2,t)},black:function(t){return this.setChannel("cmyk",3,t)},hexString:function(){return R.hexString(this.values.rgb)},rgbString:function(){return R.rgbString(this.values.rgb,this.values.alpha)},rgbaString:function(){return R.rgbaString(this.values.rgb,this.values.alpha)},percentString:function(){return R.percentString(this.values.rgb,this.values.alpha)},hslString:function(){return R.hslString(this.values.hsl,this.values.alpha)},hslaString:function(){return R.hslaString(this.values.hsl,this.values.alpha)},hwbString:function(){return R.hwbString(this.values.hwb,this.values.alpha)},keyword:function(){return R.keyword(this.values.rgb,this.values.alpha)},rgbNumber:function(){var t=this.values.rgb;return t[0]<<16|t[1]<<8|t[2]},luminosity:function(){for(var t=this.values.rgb,e=[],i=0;i<t.length;i++){var n=t[i]/255;e[i]=n<=.03928?n/12.92:Math.pow((n+.055)/1.055,2.4)}return.2126*e[0]+.7152*e[1]+.0722*e[2]},contrast:function(t){var e=this.luminosity(),i=t.luminosity();return e>i?(e+.05)/(i+.05):(i+.05)/(e+.05)},level:function(t){var e=this.contrast(t);return e>=7.1?"AAA":e>=4.5?"AA":""},dark:function(){var t=this.values.rgb;return(299*t[0]+587*t[1]+114*t[2])/1e3<128},light:function(){return!this.dark()},negate:function(){for(var t=[],e=0;e<3;e++)t[e]=255-this.values.rgb[e];return this.setValues("rgb",t),this},lighten:function(t){var e=this.values.hsl;return e[2]+=e[2]*t,this.setValues("hsl",e),this},darken:function(t){var e=this.values.hsl;return e[2]-=e[2]*t,this.setValues("hsl",e),this},saturate:function(t){var e=this.values.hsl;return e[1]+=e[1]*t,this.setValues("hsl",e),this},desaturate:function(t){var e=this.values.hsl;return e[1]-=e[1]*t,this.setValues("hsl",e),this},whiten:function(t){var e=this.values.hwb;return e[1]+=e[1]*t,this.setValues("hwb",e),this},blacken:function(t){var e=this.values.hwb;return e[2]+=e[2]*t,this.setValues("hwb",e),this},greyscale:function(){var t=this.values.rgb,e=.3*t[0]+.59*t[1]+.11*t[2];return this.setValues("rgb",[e,e,e]),this},clearer:function(t){var e=this.values.alpha;return this.setValues("alpha",e-e*t),this},opaquer:function(t){var e=this.values.alpha;return this.setValues("alpha",e+e*t),this},rotate:function(t){var e=this.values.hsl,i=(e[0]+t)%360;return e[0]=i<0?360+i:i,this.setValues("hsl",e),this},mix:function(t,e){var i=t,n=void 0===e?.5:e,a=2*n-1,o=this.alpha()-i.alpha(),r=((a*o==-1?a:(a+o)/(1+a*o))+1)/2,s=1-r;return this.rgb(r*this.red()+s*i.red(),r*this.green()+s*i.green(),r*this.blue()+s*i.blue()).alpha(this.alpha()*n+i.alpha()*(1-n))},toJSON:function(){return this.rgb()},clone:function(){var t,e,i=new Y,n=this.values,a=i.values;for(var o in n)n.hasOwnProperty(o)&&(t=n[o],"[object Array]"===(e={}.toString.call(t))?a[o]=t.slice(0):"[object Number]"===e?a[o]=t:console.error("unexpected color value:",t));return i}},Y.prototype.spaces={rgb:["red","green","blue"],hsl:["hue","saturation","lightness"],hsv:["hue","saturation","value"],hwb:["hue","whiteness","blackness"],cmyk:["cyan","magenta","yellow","black"]},Y.prototype.maxes={rgb:[255,255,255],hsl:[360,100,100],hsv:[360,100,100],hwb:[360,100,100],cmyk:[100,100,100,100]},Y.prototype.getValues=function(t){for(var e=this.values,i={},n=0;n<t.length;n++)i[t.charAt(n)]=e[t][n];return 1!==e.alpha&&(i.a=e.alpha),i},Y.prototype.setValues=function(t,e){var i,n,a=this.values,o=this.spaces,r=this.maxes,s=1;if(this.valid=!0,"alpha"===t)s=e;else if(e.length)a[t]=e.slice(0,t.length),s=e[t.length];else if(void 0!==e[t.charAt(0)]){for(i=0;i<t.length;i++)a[t][i]=e[t.charAt(i)];s=e.a}else if(void 0!==e[o[t][0]]){var l=o[t];for(i=0;i<t.length;i++)a[t][i]=e[l[i]];s=e.alpha}if(a.alpha=Math.max(0,Math.min(1,void 0===s?a.alpha:s)),"alpha"===t)return!1;for(i=0;i<t.length;i++)n=Math.max(0,Math.min(r[t][i],a[t][i])),a[t][i]=Math.round(n);for(var d in o)d!==t&&(a[d]=F[t][d](a[t]));return!0},Y.prototype.setSpace=function(t,e){var i=e[0];return void 0===i?this.getValues(t):("number"==typeof i&&(i=Array.prototype.slice.call(e)),this.setValues(t,i),this)},Y.prototype.setChannel=function(t,e,i){var n=this.values[t];return void 0===i?n[e]:i===n[e]?this:(n[e]=i,this.setValues(t,n),this)},"undefined"!=typeof window&&(window.Color=Y);var U,X=Y,K={noop:function(){},uid:(U=0,function(){return U++}),isNullOrUndef:function(t){return null==t},isArray:function(t){if(Array.isArray&&Array.isArray(t))return!0;var e=Object.prototype.toString.call(t);return"[object"===e.substr(0,7)&&"Array]"===e.substr(-6)},isObject:function(t){return null!==t&&"[object Object]"===Object.prototype.toString.call(t)},isFinite:function(t){return("number"==typeof t||t instanceof Number)&&isFinite(t)},valueOrDefault:function(t,e){return void 0===t?e:t},valueAtIndexOrDefault:function(t,e,i){return K.valueOrDefault(K.isArray(t)?t[e]:t,i)},callback:function(t,e,i){if(t&&"function"==typeof t.call)return t.apply(i,e)},each:function(t,e,i,n){var a,o,r;if(K.isArray(t))if(o=t.length,n)for(a=o-1;a>=0;a--)e.call(i,t[a],a);else for(a=0;a<o;a++)e.call(i,t[a],a);else if(K.isObject(t))for(o=(r=Object.keys(t)).length,a=0;a<o;a++)e.call(i,t[r[a]],r[a])},arrayEquals:function(t,e){var i,n,a,o;if(!t||!e||t.length!==e.length)return!1;for(i=0,n=t.length;i<n;++i)if(a=t[i],o=e[i],a instanceof Array&&o instanceof Array){if(!K.arrayEquals(a,o))return!1}else if(a!==o)return!1;return!0},clone:function(t){if(K.isArray(t))return t.map(K.clone);if(K.isObject(t)){for(var e={},i=Object.keys(t),n=i.length,a=0;a<n;++a)e[i[a]]=K.clone(t[i[a]]);return e}return t},_merger:function(t,e,i,n){var a=e[t],o=i[t];K.isObject(a)&&K.isObject(o)?K.merge(a,o,n):e[t]=K.clone(o)},_mergerIf:function(t,e,i){var n=e[t],a=i[t];K.isObject(n)&&K.isObject(a)?K.mergeIf(n,a):e.hasOwnProperty(t)||(e[t]=K.clone(a))},merge:function(t,e,i){var n,a,o,r,s,l=K.isArray(e)?e:[e],d=l.length;if(!K.isObject(t))return t;for(n=(i=i||{}).merger||K._merger,a=0;a<d;++a)if(e=l[a],K.isObject(e))for(s=0,r=(o=Object.keys(e)).length;s<r;++s)n(o[s],t,e,i);return t},mergeIf:function(t,e){return K.merge(t,e,{merger:K._mergerIf})},extend:function(t){for(var e=function(e,i){t[i]=e},i=1,n=arguments.length;i<n;++i)K.each(arguments[i],e);return t},inherits:function(t){var e=this,i=t&&t.hasOwnProperty("constructor")?t.constructor:function(){return e.apply(this,arguments)},n=function(){this.constructor=i};return n.prototype=e.prototype,i.prototype=new n,i.extend=K.inherits,t&&K.extend(i.prototype,t),i.__super__=e.prototype,i}},G=K;K.callCallback=K.callback,K.indexOf=function(t,e,i){return Array.prototype.indexOf.call(t,e,i)},K.getValueOrDefault=K.valueOrDefault,K.getValueAtIndexOrDefault=K.valueAtIndexOrDefault;var Z={linear:function(t){return t},easeInQuad:function(t){return t*t},easeOutQuad:function(t){return-t*(t-2)},easeInOutQuad:function(t){return(t/=.5)<1?.5*t*t:-.5*(--t*(t-2)-1)},easeInCubic:function(t){return t*t*t},easeOutCubic:function(t){return(t-=1)*t*t+1},easeInOutCubic:function(t){return(t/=.5)<1?.5*t*t*t:.5*((t-=2)*t*t+2)},easeInQuart:function(t){return t*t*t*t},easeOutQuart:function(t){return-((t-=1)*t*t*t-1)},easeInOutQuart:function(t){return(t/=.5)<1?.5*t*t*t*t:-.5*((t-=2)*t*t*t-2)},easeInQuint:function(t){return t*t*t*t*t},easeOutQuint:function(t){return(t-=1)*t*t*t*t+1},easeInOutQuint:function(t){return(t/=.5)<1?.5*t*t*t*t*t:.5*((t-=2)*t*t*t*t+2)},easeInSine:function(t){return 1-Math.cos(t*(Math.PI/2))},easeOutSine:function(t){return Math.sin(t*(Math.PI/2))},easeInOutSine:function(t){return-.5*(Math.cos(Math.PI*t)-1)},easeInExpo:function(t){return 0===t?0:Math.pow(2,10*(t-1))},easeOutExpo:function(t){return 1===t?1:1-Math.pow(2,-10*t)},easeInOutExpo:function(t){return 0===t?0:1===t?1:(t/=.5)<1?.5*Math.pow(2,10*(t-1)):.5*(2-Math.pow(2,-10*--t))},easeInCirc:function(t){return t>=1?t:-(Math.sqrt(1-t*t)-1)},easeOutCirc:function(t){return Math.sqrt(1-(t-=1)*t)},easeInOutCirc:function(t){return(t/=.5)<1?-.5*(Math.sqrt(1-t*t)-1):.5*(Math.sqrt(1-(t-=2)*t)+1)},easeInElastic:function(t){var e=1.70158,i=0,n=1;return 0===t?0:1===t?1:(i||(i=.3),n<1?(n=1,e=i/4):e=i/(2*Math.PI)*Math.asin(1/n),-n*Math.pow(2,10*(t-=1))*Math.sin((t-e)*(2*Math.PI)/i))},easeOutElastic:function(t){var e=1.70158,i=0,n=1;return 0===t?0:1===t?1:(i||(i=.3),n<1?(n=1,e=i/4):e=i/(2*Math.PI)*Math.asin(1/n),n*Math.pow(2,-10*t)*Math.sin((t-e)*(2*Math.PI)/i)+1)},easeInOutElastic:function(t){var e=1.70158,i=0,n=1;return 0===t?0:2==(t/=.5)?1:(i||(i=.45),n<1?(n=1,e=i/4):e=i/(2*Math.PI)*Math.asin(1/n),t<1?n*Math.pow(2,10*(t-=1))*Math.sin((t-e)*(2*Math.PI)/i)*-.5:n*Math.pow(2,-10*(t-=1))*Math.sin((t-e)*(2*Math.PI)/i)*.5+1)},easeInBack:function(t){var e=1.70158;return t*t*((e+1)*t-e)},easeOutBack:function(t){var e=1.70158;return(t-=1)*t*((e+1)*t+e)+1},easeInOutBack:function(t){var e=1.70158;return(t/=.5)<1?t*t*((1+(e*=1.525))*t-e)*.5:.5*((t-=2)*t*((1+(e*=1.525))*t+e)+2)},easeInBounce:function(t){return 1-Z.easeOutBounce(1-t)},easeOutBounce:function(t){return t<1/2.75?7.5625*t*t:t<2/2.75?7.5625*(t-=1.5/2.75)*t+.75:t<2.5/2.75?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375},easeInOutBounce:function(t){return t<.5?.5*Z.easeInBounce(2*t):.5*Z.easeOutBounce(2*t-1)+.5}},$={effects:Z};G.easingEffects=Z;var J=Math.PI,Q=J/180,tt=2*J,et=J/2,it=J/4,nt=2*J/3,at={clear:function(t){t.ctx.clearRect(0,0,t.width,t.height)},roundedRect:function(t,e,i,n,a,o){if(o){var r=Math.min(o,a/2,n/2),s=e+r,l=i+r,d=e+n-r,u=i+a-r;t.moveTo(e,l),s<d&&l<u?(t.arc(s,l,r,-J,-et),t.arc(d,l,r,-et,0),t.arc(d,u,r,0,et),t.arc(s,u,r,et,J)):s<d?(t.moveTo(s,i),t.arc(d,l,r,-et,et),t.arc(s,l,r,et,J+et)):l<u?(t.arc(s,l,r,-J,0),t.arc(s,u,r,0,J)):t.arc(s,l,r,-J,J),t.closePath(),t.moveTo(e,i)}else t.rect(e,i,n,a)},drawPoint:function(t,e,i,n,a,o){var r,s,l,d,u,h=(o||0)*Q;if(!e||"object"!=typeof e||"[object HTMLImageElement]"!==(r=e.toString())&&"[object HTMLCanvasElement]"!==r){if(!(isNaN(i)||i<=0)){switch(t.beginPath(),e){default:t.arc(n,a,i,0,tt),t.closePath();break;case"triangle":t.moveTo(n+Math.sin(h)*i,a-Math.cos(h)*i),h+=nt,t.lineTo(n+Math.sin(h)*i,a-Math.cos(h)*i),h+=nt,t.lineTo(n+Math.sin(h)*i,a-Math.cos(h)*i),t.closePath();break;case"rectRounded":d=i-(u=.516*i),s=Math.cos(h+it)*d,l=Math.sin(h+it)*d,t.arc(n-s,a-l,u,h-J,h-et),t.arc(n+l,a-s,u,h-et,h),t.arc(n+s,a+l,u,h,h+et),t.arc(n-l,a+s,u,h+et,h+J),t.closePath();break;case"rect":if(!o){d=Math.SQRT1_2*i,t.rect(n-d,a-d,2*d,2*d);break}h+=it;case"rectRot":s=Math.cos(h)*i,l=Math.sin(h)*i,t.moveTo(n-s,a-l),t.lineTo(n+l,a-s),t.lineTo(n+s,a+l),t.lineTo(n-l,a+s),t.closePath();break;case"crossRot":h+=it;case"cross":s=Math.cos(h)*i,l=Math.sin(h)*i,t.moveTo(n-s,a-l),t.lineTo(n+s,a+l),t.moveTo(n+l,a-s),t.lineTo(n-l,a+s);break;case"star":s=Math.cos(h)*i,l=Math.sin(h)*i,t.moveTo(n-s,a-l),t.lineTo(n+s,a+l),t.moveTo(n+l,a-s),t.lineTo(n-l,a+s),h+=it,s=Math.cos(h)*i,l=Math.sin(h)*i,t.moveTo(n-s,a-l),t.lineTo(n+s,a+l),t.moveTo(n+l,a-s),t.lineTo(n-l,a+s);break;case"line":s=Math.cos(h)*i,l=Math.sin(h)*i,t.moveTo(n-s,a-l),t.lineTo(n+s,a+l);break;case"dash":t.moveTo(n,a),t.lineTo(n+Math.cos(h)*i,a+Math.sin(h)*i)}t.fill(),t.stroke()}}else t.drawImage(e,n-e.width/2,a-e.height/2,e.width,e.height)},_isPointInArea:function(t,e){return t.x>e.left-1e-6&&t.x<e.right+1e-6&&t.y>e.top-1e-6&&t.y<e.bottom+1e-6},clipArea:function(t,e){t.save(),t.beginPath(),t.rect(e.left,e.top,e.right-e.left,e.bottom-e.top),t.clip()},unclipArea:function(t){t.restore()},lineTo:function(t,e,i,n){var a=i.steppedLine;if(a){if("middle"===a){var o=(e.x+i.x)/2;t.lineTo(o,n?i.y:e.y),t.lineTo(o,n?e.y:i.y)}else"after"===a&&!n||"after"!==a&&n?t.lineTo(e.x,i.y):t.lineTo(i.x,e.y);t.lineTo(i.x,i.y)}else i.tension?t.bezierCurveTo(n?e.controlPointPreviousX:e.controlPointNextX,n?e.controlPointPreviousY:e.controlPointNextY,n?i.controlPointNextX:i.controlPointPreviousX,n?i.controlPointNextY:i.controlPointPreviousY,i.x,i.y):t.lineTo(i.x,i.y)}},ot=at;G.clear=at.clear,G.drawRoundedRectangle=function(t){t.beginPath(),at.roundedRect.apply(at,arguments)};var rt={_set:function(t,e){return G.merge(this[t]||(this[t]={}),e)}};rt._set("global",{defaultColor:"rgba(0,0,0,0.1)",defaultFontColor:"#666",defaultFontFamily:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",defaultFontSize:12,defaultFontStyle:"normal",defaultLineHeight:1.2,showLines:!0});var st=rt,lt=G.valueOrDefault;var dt={toLineHeight:function(t,e){var i=(""+t).match(/^(normal|(\d+(?:\.\d+)?)(px|em|%)?)$/);if(!i||"normal"===i[1])return 1.2*e;switch(t=+i[2],i[3]){case"px":return t;case"%":t/=100}return e*t},toPadding:function(t){var e,i,n,a;return G.isObject(t)?(e=+t.top||0,i=+t.right||0,n=+t.bottom||0,a=+t.left||0):e=i=n=a=+t||0,{top:e,right:i,bottom:n,left:a,height:e+n,width:a+i}},_parseFont:function(t){var e=st.global,i=lt(t.fontSize,e.defaultFontSize),n={family:lt(t.fontFamily,e.defaultFontFamily),lineHeight:G.options.toLineHeight(lt(t.lineHeight,e.defaultLineHeight),i),size:i,style:lt(t.fontStyle,e.defaultFontStyle),weight:null,string:""};return n.string=function(t){return!t||G.isNullOrUndef(t.size)||G.isNullOrUndef(t.family)?null:(t.style?t.style+" ":"")+(t.weight?t.weight+" ":"")+t.size+"px "+t.family}(n),n},resolve:function(t,e,i){var n,a,o;for(n=0,a=t.length;n<a;++n)if(void 0!==(o=t[n])&&(void 0!==e&&"function"==typeof o&&(o=o(e)),void 0!==i&&G.isArray(o)&&(o=o[i]),void 0!==o))return o}},ut=G,ht=$,ct=ot,ft=dt;ut.easing=ht,ut.canvas=ct,ut.options=ft;var gt=function(t){ut.extend(this,t),this.initialize.apply(this,arguments)};ut.extend(gt.prototype,{initialize:function(){this.hidden=!1},pivot:function(){var t=this;return t._view||(t._view=ut.clone(t._model)),t._start={},t},transition:function(t){var e=this,i=e._model,n=e._start,a=e._view;return i&&1!==t?(a||(a=e._view={}),n||(n=e._start={}),function(t,e,i,n){var a,o,r,s,l,d,u,h,c,f=Object.keys(i);for(a=0,o=f.length;a<o;++a)if(d=i[r=f[a]],e.hasOwnProperty(r)||(e[r]=d),(s=e[r])!==d&&"_"!==r[0]){if(t.hasOwnProperty(r)||(t[r]=s),(u=typeof d)==typeof(l=t[r]))if("string"===u){if((h=X(l)).valid&&(c=X(d)).valid){e[r]=c.mix(h,n).rgbString();continue}}else if(ut.isFinite(l)&&ut.isFinite(d)){e[r]=l+(d-l)*n;continue}e[r]=d}}(n,a,i,t),e):(e._view=i,e._start=null,e)},tooltipPosition:function(){return{x:this._model.x,y:this._model.y}},hasValue:function(){return ut.isNumber(this._model.x)&&ut.isNumber(this._model.y)}}),gt.extend=ut.inherits;var pt=gt,mt=pt.extend({chart:null,currentStep:0,numSteps:60,easing:"",render:null,onAnimationProgress:null,onAnimationComplete:null}),vt=mt;Object.defineProperty(mt.prototype,"animationObject",{get:function(){return this}}),Object.defineProperty(mt.prototype,"chartInstance",{get:function(){return this.chart},set:function(t){this.chart=t}}),st._set("global",{animation:{duration:1e3,easing:"easeOutQuart",onProgress:ut.noop,onComplete:ut.noop}});var bt={animations:[],request:null,addAnimation:function(t,e,i,n){var a,o,r=this.animations;for(e.chart=t,e.startTime=Date.now(),e.duration=i,n||(t.animating=!0),a=0,o=r.length;a<o;++a)if(r[a].chart===t)return void(r[a]=e);r.push(e),1===r.length&&this.requestAnimationFrame()},cancelAnimation:function(t){var e=ut.findIndex(this.animations,function(e){return e.chart===t});-1!==e&&(this.animations.splice(e,1),t.animating=!1)},requestAnimationFrame:function(){var t=this;null===t.request&&(t.request=ut.requestAnimFrame.call(window,function(){t.request=null,t.startDigest()}))},startDigest:function(){this.advance(),this.animations.length>0&&this.requestAnimationFrame()},advance:function(){for(var t,e,i,n,a=this.animations,o=0;o<a.length;)e=(t=a[o]).chart,i=t.numSteps,n=Math.floor((Date.now()-t.startTime)/t.duration*i)+1,t.currentStep=Math.min(n,i),ut.callback(t.render,[e,t],e),ut.callback(t.onAnimationProgress,[t],e),t.currentStep>=i?(ut.callback(t.onAnimationComplete,[t],e),e.animating=!1,a.splice(o,1)):++o}},xt=ut.options.resolve,yt=["push","pop","shift","splice","unshift"];function kt(t,e){var i=t._chartjs;if(i){var n=i.listeners,a=n.indexOf(e);-1!==a&&n.splice(a,1),n.length>0||(yt.forEach(function(e){delete t[e]}),delete t._chartjs)}}var wt=function(t,e){this.initialize(t,e)};ut.extend(wt.prototype,{datasetElementType:null,dataElementType:null,initialize:function(t,e){this.chart=t,this.index=e,this.linkScales(),this.addElements()},updateIndex:function(t){this.index=t},linkScales:function(){var t=this,e=t.getMeta(),i=t.getDataset();null!==e.xAxisID&&e.xAxisID in t.chart.scales||(e.xAxisID=i.xAxisID||t.chart.options.scales.xAxes[0].id),null!==e.yAxisID&&e.yAxisID in t.chart.scales||(e.yAxisID=i.yAxisID||t.chart.options.scales.yAxes[0].id)},getDataset:function(){return this.chart.data.datasets[this.index]},getMeta:function(){return this.chart.getDatasetMeta(this.index)},getScaleForId:function(t){return this.chart.scales[t]},_getValueScaleId:function(){return this.getMeta().yAxisID},_getIndexScaleId:function(){return this.getMeta().xAxisID},_getValueScale:function(){return this.getScaleForId(this._getValueScaleId())},_getIndexScale:function(){return this.getScaleForId(this._getIndexScaleId())},reset:function(){this.update(!0)},destroy:function(){this._data&&kt(this._data,this)},createMetaDataset:function(){var t=this.datasetElementType;return t&&new t({_chart:this.chart,_datasetIndex:this.index})},createMetaData:function(t){var e=this.dataElementType;return e&&new e({_chart:this.chart,_datasetIndex:this.index,_index:t})},addElements:function(){var t,e,i=this.getMeta(),n=this.getDataset().data||[],a=i.data;for(t=0,e=n.length;t<e;++t)a[t]=a[t]||this.createMetaData(t);i.dataset=i.dataset||this.createMetaDataset()},addElementAndReset:function(t){var e=this.createMetaData(t);this.getMeta().data.splice(t,0,e),this.updateElement(e,t,!0)},buildOrUpdateElements:function(){var t,e,i=this,n=i.getDataset(),a=n.data||(n.data=[]);i._data!==a&&(i._data&&kt(i._data,i),a&&Object.isExtensible(a)&&(e=i,(t=a)._chartjs?t._chartjs.listeners.push(e):(Object.defineProperty(t,"_chartjs",{configurable:!0,enumerable:!1,value:{listeners:[e]}}),yt.forEach(function(e){var i="onData"+e.charAt(0).toUpperCase()+e.slice(1),n=t[e];Object.defineProperty(t,e,{configurable:!0,enumerable:!1,value:function(){var e=Array.prototype.slice.call(arguments),a=n.apply(this,e);return ut.each(t._chartjs.listeners,function(t){"function"==typeof t[i]&&t[i].apply(t,e)}),a}})}))),i._data=a),i.resyncElements()},update:ut.noop,transition:function(t){for(var e=this.getMeta(),i=e.data||[],n=i.length,a=0;a<n;++a)i[a].transition(t);e.dataset&&e.dataset.transition(t)},draw:function(){var t=this.getMeta(),e=t.data||[],i=e.length,n=0;for(t.dataset&&t.dataset.draw();n<i;++n)e[n].draw()},removeHoverStyle:function(t){ut.merge(t._model,t.$previousStyle||{}),delete t.$previousStyle},setHoverStyle:function(t){var e=this.chart.data.datasets[t._datasetIndex],i=t._index,n=t.custom||{},a=t._model,o=ut.getHoverColor;t.$previousStyle={backgroundColor:a.backgroundColor,borderColor:a.borderColor,borderWidth:a.borderWidth},a.backgroundColor=xt([n.hoverBackgroundColor,e.hoverBackgroundColor,o(a.backgroundColor)],void 0,i),a.borderColor=xt([n.hoverBorderColor,e.hoverBorderColor,o(a.borderColor)],void 0,i),a.borderWidth=xt([n.hoverBorderWidth,e.hoverBorderWidth,a.borderWidth],void 0,i)},resyncElements:function(){var t=this.getMeta(),e=this.getDataset().data,i=t.data.length,n=e.length;n<i?t.data.splice(n,i-n):n>i&&this.insertElements(i,n-i)},insertElements:function(t,e){for(var i=0;i<e;++i)this.addElementAndReset(t+i)},onDataPush:function(){var t=arguments.length;this.insertElements(this.getDataset().data.length-t,t)},onDataPop:function(){this.getMeta().data.pop()},onDataShift:function(){this.getMeta().data.shift()},onDataSplice:function(t,e){this.getMeta().data.splice(t,e),this.insertElements(t,arguments.length-2)},onDataUnshift:function(){this.insertElements(0,arguments.length)}}),wt.extend=ut.inherits;var Mt=wt;st._set("global",{elements:{arc:{backgroundColor:st.global.defaultColor,borderColor:"#fff",borderWidth:2,borderAlign:"center"}}});var _t=pt.extend({inLabelRange:function(t){var e=this._view;return!!e&&Math.pow(t-e.x,2)<Math.pow(e.radius+e.hoverRadius,2)},inRange:function(t,e){var i=this._view;if(i){for(var n=ut.getAngleFromPoint(i,{x:t,y:e}),a=n.angle,o=n.distance,r=i.startAngle,s=i.endAngle;s<r;)s+=2*Math.PI;for(;a>s;)a-=2*Math.PI;for(;a<r;)a+=2*Math.PI;var l=a>=r&&a<=s,d=o>=i.innerRadius&&o<=i.outerRadius;return l&&d}return!1},getCenterPoint:function(){var t=this._view,e=(t.startAngle+t.endAngle)/2,i=(t.innerRadius+t.outerRadius)/2;return{x:t.x+Math.cos(e)*i,y:t.y+Math.sin(e)*i}},getArea:function(){var t=this._view;return Math.PI*((t.endAngle-t.startAngle)/(2*Math.PI))*(Math.pow(t.outerRadius,2)-Math.pow(t.innerRadius,2))},tooltipPosition:function(){var t=this._view,e=t.startAngle+(t.endAngle-t.startAngle)/2,i=(t.outerRadius-t.innerRadius)/2+t.innerRadius;return{x:t.x+Math.cos(e)*i,y:t.y+Math.sin(e)*i}},draw:function(){var t,e=this._chart.ctx,i=this._view,n=i.startAngle,a=i.endAngle,o="inner"===i.borderAlign?.33:0;e.save(),e.beginPath(),e.arc(i.x,i.y,Math.max(i.outerRadius-o,0),n,a),e.arc(i.x,i.y,i.innerRadius,a,n,!0),e.closePath(),e.fillStyle=i.backgroundColor,e.fill(),i.borderWidth&&("inner"===i.borderAlign?(e.beginPath(),t=o/i.outerRadius,e.arc(i.x,i.y,i.outerRadius,n-t,a+t),i.innerRadius>o?(t=o/i.innerRadius,e.arc(i.x,i.y,i.innerRadius-o,a+t,n-t,!0)):e.arc(i.x,i.y,o,a+Math.PI/2,n-Math.PI/2),e.closePath(),e.clip(),e.beginPath(),e.arc(i.x,i.y,i.outerRadius,n,a),e.arc(i.x,i.y,i.innerRadius,a,n,!0),e.closePath(),e.lineWidth=2*i.borderWidth,e.lineJoin="round"):(e.lineWidth=i.borderWidth,e.lineJoin="bevel"),e.strokeStyle=i.borderColor,e.stroke()),e.restore()}}),Ct=ut.valueOrDefault,St=st.global.defaultColor;st._set("global",{elements:{line:{tension:.4,backgroundColor:St,borderWidth:3,borderColor:St,borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",capBezierPoints:!0,fill:!0}}});var Pt=pt.extend({draw:function(){var t,e,i,n,a=this._view,o=this._chart.ctx,r=a.spanGaps,s=this._children.slice(),l=st.global,d=l.elements.line,u=-1;for(this._loop&&s.length&&s.push(s[0]),o.save(),o.lineCap=a.borderCapStyle||d.borderCapStyle,o.setLineDash&&o.setLineDash(a.borderDash||d.borderDash),o.lineDashOffset=Ct(a.borderDashOffset,d.borderDashOffset),o.lineJoin=a.borderJoinStyle||d.borderJoinStyle,o.lineWidth=Ct(a.borderWidth,d.borderWidth),o.strokeStyle=a.borderColor||l.defaultColor,o.beginPath(),u=-1,t=0;t<s.length;++t)e=s[t],i=ut.previousItem(s,t),n=e._view,0===t?n.skip||(o.moveTo(n.x,n.y),u=t):(i=-1===u?i:s[u],n.skip||(u!==t-1&&!r||-1===u?o.moveTo(n.x,n.y):ut.canvas.lineTo(o,i._view,e._view),u=t));o.stroke(),o.restore()}}),It=ut.valueOrDefault,At=st.global.defaultColor;function Dt(t){var e=this._view;return!!e&&Math.abs(t-e.x)<e.radius+e.hitRadius}st._set("global",{elements:{point:{radius:3,pointStyle:"circle",backgroundColor:At,borderColor:At,borderWidth:1,hitRadius:1,hoverRadius:4,hoverBorderWidth:1}}});var Tt=pt.extend({inRange:function(t,e){var i=this._view;return!!i&&Math.pow(t-i.x,2)+Math.pow(e-i.y,2)<Math.pow(i.hitRadius+i.radius,2)},inLabelRange:Dt,inXRange:Dt,inYRange:function(t){var e=this._view;return!!e&&Math.abs(t-e.y)<e.radius+e.hitRadius},getCenterPoint:function(){var t=this._view;return{x:t.x,y:t.y}},getArea:function(){return Math.PI*Math.pow(this._view.radius,2)},tooltipPosition:function(){var t=this._view;return{x:t.x,y:t.y,padding:t.radius+t.borderWidth}},draw:function(t){var e=this._view,i=this._chart.ctx,n=e.pointStyle,a=e.rotation,o=e.radius,r=e.x,s=e.y,l=st.global,d=l.defaultColor;e.skip||(void 0===t||ut.canvas._isPointInArea(e,t))&&(i.strokeStyle=e.borderColor||d,i.lineWidth=It(e.borderWidth,l.elements.point.borderWidth),i.fillStyle=e.backgroundColor||d,ut.canvas.drawPoint(i,n,o,r,s,a))}}),Ft=st.global.defaultColor;function Lt(t){return t&&void 0!==t.width}function Rt(t){var e,i,n,a,o;return Lt(t)?(o=t.width/2,e=t.x-o,i=t.x+o,n=Math.min(t.y,t.base),a=Math.max(t.y,t.base)):(o=t.height/2,e=Math.min(t.x,t.base),i=Math.max(t.x,t.base),n=t.y-o,a=t.y+o),{left:e,top:n,right:i,bottom:a}}function Ot(t,e,i){return t===e?i:t===i?e:t}function zt(t,e,i){var n,a,o,r,s=t.borderWidth,l=function(t){var e=t.borderSkipped,i={};return e?(t.horizontal?t.base>t.x&&(e=Ot(e,"left","right")):t.base<t.y&&(e=Ot(e,"bottom","top")),i[e]=!0,i):i}(t);return ut.isObject(s)?(n=+s.top||0,a=+s.right||0,o=+s.bottom||0,r=+s.left||0):n=a=o=r=+s||0,{t:l.top||n<0?0:n>i?i:n,r:l.right||a<0?0:a>e?e:a,b:l.bottom||o<0?0:o>i?i:o,l:l.left||r<0?0:r>e?e:r}}function Bt(t,e,i){var n=null===e,a=null===i,o=!(!t||n&&a)&&Rt(t);return o&&(n||e>=o.left&&e<=o.right)&&(a||i>=o.top&&i<=o.bottom)}st._set("global",{elements:{rectangle:{backgroundColor:Ft,borderColor:Ft,borderSkipped:"bottom",borderWidth:0}}});var Nt=pt.extend({draw:function(){var t=this._chart.ctx,e=this._view,i=function(t){var e=Rt(t),i=e.right-e.left,n=e.bottom-e.top,a=zt(t,i/2,n/2);return{outer:{x:e.left,y:e.top,w:i,h:n},inner:{x:e.left+a.l,y:e.top+a.t,w:i-a.l-a.r,h:n-a.t-a.b}}}(e),n=i.outer,a=i.inner;t.fillStyle=e.backgroundColor,t.fillRect(n.x,n.y,n.w,n.h),n.w===a.w&&n.h===a.h||(t.save(),t.beginPath(),t.rect(n.x,n.y,n.w,n.h),t.clip(),t.fillStyle=e.borderColor,t.rect(a.x,a.y,a.w,a.h),t.fill("evenodd"),t.restore())},height:function(){var t=this._view;return t.base-t.y},inRange:function(t,e){return Bt(this._view,t,e)},inLabelRange:function(t,e){var i=this._view;return Lt(i)?Bt(i,t,null):Bt(i,null,e)},inXRange:function(t){return Bt(this._view,t,null)},inYRange:function(t){return Bt(this._view,null,t)},getCenterPoint:function(){var t,e,i=this._view;return Lt(i)?(t=i.x,e=(i.y+i.base)/2):(t=(i.x+i.base)/2,e=i.y),{x:t,y:e}},getArea:function(){var t=this._view;return Lt(t)?t.width*Math.abs(t.y-t.base):t.height*Math.abs(t.x-t.base)},tooltipPosition:function(){var t=this._view;return{x:t.x,y:t.y}}}),Wt={},Vt=_t,Et=Pt,Ht=Tt,jt=Nt;Wt.Arc=Vt,Wt.Line=Et,Wt.Point=Ht,Wt.Rectangle=jt;var qt=ut.options.resolve;st._set("bar",{hover:{mode:"label"},scales:{xAxes:[{type:"category",categoryPercentage:.8,barPercentage:.9,offset:!0,gridLines:{offsetGridLines:!0}}],yAxes:[{type:"linear"}]}});var Yt=Mt.extend({dataElementType:Wt.Rectangle,initialize:function(){var t;Mt.prototype.initialize.apply(this,arguments),(t=this.getMeta()).stack=this.getDataset().stack,t.bar=!0},update:function(t){var e,i,n=this.getMeta().data;for(this._ruler=this.getRuler(),e=0,i=n.length;e<i;++e)this.updateElement(n[e],e,t)},updateElement:function(t,e,i){var n=this,a=n.getMeta(),o=n.getDataset(),r=n._resolveElementOptions(t,e);t._xScale=n.getScaleForId(a.xAxisID),t._yScale=n.getScaleForId(a.yAxisID),t._datasetIndex=n.index,t._index=e,t._model={backgroundColor:r.backgroundColor,borderColor:r.borderColor,borderSkipped:r.borderSkipped,borderWidth:r.borderWidth,datasetLabel:o.label,label:n.chart.data.labels[e]},n._updateElementGeometry(t,e,i),t.pivot()},_updateElementGeometry:function(t,e,i){var n=this,a=t._model,o=n._getValueScale(),r=o.getBasePixel(),s=o.isHorizontal(),l=n._ruler||n.getRuler(),d=n.calculateBarValuePixels(n.index,e),u=n.calculateBarIndexPixels(n.index,e,l);a.horizontal=s,a.base=i?r:d.base,a.x=s?i?r:d.head:u.center,a.y=s?u.center:i?r:d.head,a.height=s?u.size:void 0,a.width=s?void 0:u.size},_getStacks:function(t){var e,i,n=this.chart,a=this._getIndexScale().options.stacked,o=void 0===t?n.data.datasets.length:t+1,r=[];for(e=0;e<o;++e)(i=n.getDatasetMeta(e)).bar&&n.isDatasetVisible(e)&&(!1===a||!0===a&&-1===r.indexOf(i.stack)||void 0===a&&(void 0===i.stack||-1===r.indexOf(i.stack)))&&r.push(i.stack);return r},getStackCount:function(){return this._getStacks().length},getStackIndex:function(t,e){var i=this._getStacks(t),n=void 0!==e?i.indexOf(e):-1;return-1===n?i.length-1:n},getRuler:function(){var t,e,i=this._getIndexScale(),n=this.getStackCount(),a=this.index,o=i.isHorizontal(),r=o?i.left:i.top,s=r+(o?i.width:i.height),l=[];for(t=0,e=this.getMeta().data.length;t<e;++t)l.push(i.getPixelForValue(null,t,a));return{min:ut.isNullOrUndef(i.options.barThickness)?function(t,e){var i,n,a,o,r=t.isHorizontal()?t.width:t.height,s=t.getTicks();for(a=1,o=e.length;a<o;++a)r=Math.min(r,Math.abs(e[a]-e[a-1]));for(a=0,o=s.length;a<o;++a)n=t.getPixelForTick(a),r=a>0?Math.min(r,n-i):r,i=n;return r}(i,l):-1,pixels:l,start:r,end:s,stackCount:n,scale:i}},calculateBarValuePixels:function(t,e){var i,n,a,o,r,s,l=this.chart,d=this.getMeta(),u=this._getValueScale(),h=u.isHorizontal(),c=l.data.datasets,f=+u.getRightValue(c[t].data[e]),g=u.options.minBarLength,p=u.options.stacked,m=d.stack,v=0;if(p||void 0===p&&void 0!==m)for(i=0;i<t;++i)(n=l.getDatasetMeta(i)).bar&&n.stack===m&&n.controller._getValueScaleId()===u.id&&l.isDatasetVisible(i)&&(a=+u.getRightValue(c[i].data[e]),(f<0&&a<0||f>=0&&a>0)&&(v+=a));return o=u.getPixelForValue(v),s=(r=u.getPixelForValue(v+f))-o,void 0!==g&&Math.abs(s)<g&&(s=g,r=f>=0&&!h||f<0&&h?o-g:o+g),{size:s,base:o,head:r,center:r+s/2}},calculateBarIndexPixels:function(t,e,i){var n=i.scale.options,a="flex"===n.barThickness?function(t,e,i){var n,a=e.pixels,o=a[t],r=t>0?a[t-1]:null,s=t<a.length-1?a[t+1]:null,l=i.categoryPercentage;return null===r&&(r=o-(null===s?e.end-e.start:s-o)),null===s&&(s=o+o-r),n=o-(o-Math.min(r,s))/2*l,{chunk:Math.abs(s-r)/2*l/e.stackCount,ratio:i.barPercentage,start:n}}(e,i,n):function(t,e,i){var n,a,o=i.barThickness,r=e.stackCount,s=e.pixels[t];return ut.isNullOrUndef(o)?(n=e.min*i.categoryPercentage,a=i.barPercentage):(n=o*r,a=1),{chunk:n/r,ratio:a,start:s-n/2}}(e,i,n),o=this.getStackIndex(t,this.getMeta().stack),r=a.start+a.chunk*o+a.chunk/2,s=Math.min(ut.valueOrDefault(n.maxBarThickness,1/0),a.chunk*a.ratio);return{base:r-s/2,head:r+s/2,center:r,size:s}},draw:function(){var t=this.chart,e=this._getValueScale(),i=this.getMeta().data,n=this.getDataset(),a=i.length,o=0;for(ut.canvas.clipArea(t.ctx,t.chartArea);o<a;++o)isNaN(e.getRightValue(n.data[o]))||i[o].draw();ut.canvas.unclipArea(t.ctx)},_resolveElementOptions:function(t,e){var i,n,a,o=this.chart,r=o.data.datasets[this.index],s=t.custom||{},l=o.options.elements.rectangle,d={},u={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},h=["backgroundColor","borderColor","borderSkipped","borderWidth"];for(i=0,n=h.length;i<n;++i)d[a=h[i]]=qt([s[a],r[a],l[a]],u,e);return d}}),Ut=ut.valueOrDefault,Xt=ut.options.resolve;st._set("bubble",{hover:{mode:"single"},scales:{xAxes:[{type:"linear",position:"bottom",id:"x-axis-0"}],yAxes:[{type:"linear",position:"left",id:"y-axis-0"}]},tooltips:{callbacks:{title:function(){return""},label:function(t,e){var i=e.datasets[t.datasetIndex].label||"",n=e.datasets[t.datasetIndex].data[t.index];return i+": ("+t.xLabel+", "+t.yLabel+", "+n.r+")"}}}});var Kt=Mt.extend({dataElementType:Wt.Point,update:function(t){var e=this,i=e.getMeta().data;ut.each(i,function(i,n){e.updateElement(i,n,t)})},updateElement:function(t,e,i){var n=this,a=n.getMeta(),o=t.custom||{},r=n.getScaleForId(a.xAxisID),s=n.getScaleForId(a.yAxisID),l=n._resolveElementOptions(t,e),d=n.getDataset().data[e],u=n.index,h=i?r.getPixelForDecimal(.5):r.getPixelForValue("object"==typeof d?d:NaN,e,u),c=i?s.getBasePixel():s.getPixelForValue(d,e,u);t._xScale=r,t._yScale=s,t._options=l,t._datasetIndex=u,t._index=e,t._model={backgroundColor:l.backgroundColor,borderColor:l.borderColor,borderWidth:l.borderWidth,hitRadius:l.hitRadius,pointStyle:l.pointStyle,rotation:l.rotation,radius:i?0:l.radius,skip:o.skip||isNaN(h)||isNaN(c),x:h,y:c},t.pivot()},setHoverStyle:function(t){var e=t._model,i=t._options,n=ut.getHoverColor;t.$previousStyle={backgroundColor:e.backgroundColor,borderColor:e.borderColor,borderWidth:e.borderWidth,radius:e.radius},e.backgroundColor=Ut(i.hoverBackgroundColor,n(i.backgroundColor)),e.borderColor=Ut(i.hoverBorderColor,n(i.borderColor)),e.borderWidth=Ut(i.hoverBorderWidth,i.borderWidth),e.radius=i.radius+i.hoverRadius},_resolveElementOptions:function(t,e){var i,n,a,o=this.chart,r=o.data.datasets[this.index],s=t.custom||{},l=o.options.elements.point,d=r.data[e],u={},h={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},c=["backgroundColor","borderColor","borderWidth","hoverBackgroundColor","hoverBorderColor","hoverBorderWidth","hoverRadius","hitRadius","pointStyle","rotation"];for(i=0,n=c.length;i<n;++i)u[a=c[i]]=Xt([s[a],r[a],l[a]],h,e);return u.radius=Xt([s.radius,d?d.r:void 0,r.radius,l.radius],h,e),u}}),Gt=ut.options.resolve,Zt=ut.valueOrDefault;st._set("doughnut",{animation:{animateRotate:!0,animateScale:!1},hover:{mode:"single"},legendCallback:function(t){var e=[];e.push('<ul class="'+t.id+'-legend">');var i=t.data,n=i.datasets,a=i.labels;if(n.length)for(var o=0;o<n[0].data.length;++o)e.push('<li><span style="background-color:'+n[0].backgroundColor[o]+'"></span>'),a[o]&&e.push(a[o]),e.push("</li>");return e.push("</ul>"),e.join("")},legend:{labels:{generateLabels:function(t){var e=t.data;return e.labels.length&&e.datasets.length?e.labels.map(function(i,n){var a=t.getDatasetMeta(0),o=e.datasets[0],r=a.data[n],s=r&&r.custom||{},l=t.options.elements.arc;return{text:i,fillStyle:Gt([s.backgroundColor,o.backgroundColor,l.backgroundColor],void 0,n),strokeStyle:Gt([s.borderColor,o.borderColor,l.borderColor],void 0,n),lineWidth:Gt([s.borderWidth,o.borderWidth,l.borderWidth],void 0,n),hidden:isNaN(o.data[n])||a.data[n].hidden,index:n}}):[]}},onClick:function(t,e){var i,n,a,o=e.index,r=this.chart;for(i=0,n=(r.data.datasets||[]).length;i<n;++i)(a=r.getDatasetMeta(i)).data[o]&&(a.data[o].hidden=!a.data[o].hidden);r.update()}},cutoutPercentage:50,rotation:-.5*Math.PI,circumference:2*Math.PI,tooltips:{callbacks:{title:function(){return""},label:function(t,e){var i=e.labels[t.index],n=": "+e.datasets[t.datasetIndex].data[t.index];return ut.isArray(i)?(i=i.slice())[0]+=n:i+=n,i}}}});var $t=Mt.extend({dataElementType:Wt.Arc,linkScales:ut.noop,getRingIndex:function(t){for(var e=0,i=0;i<t;++i)this.chart.isDatasetVisible(i)&&++e;return e},update:function(t){var e,i,n=this,a=n.chart,o=a.chartArea,r=a.options,s=o.right-o.left,l=o.bottom-o.top,d=Math.min(s,l),u={x:0,y:0},h=n.getMeta(),c=h.data,f=r.cutoutPercentage,g=r.circumference,p=n._getRingWeight(n.index);if(g<2*Math.PI){var m=r.rotation%(2*Math.PI),v=(m+=2*Math.PI*(m>=Math.PI?-1:m<-Math.PI?1:0))+g,b={x:Math.cos(m),y:Math.sin(m)},x={x:Math.cos(v),y:Math.sin(v)},y=m<=0&&v>=0||m<=2*Math.PI&&2*Math.PI<=v,k=m<=.5*Math.PI&&.5*Math.PI<=v||m<=2.5*Math.PI&&2.5*Math.PI<=v,w=m<=-Math.PI&&-Math.PI<=v||m<=Math.PI&&Math.PI<=v,M=m<=.5*-Math.PI&&.5*-Math.PI<=v||m<=1.5*Math.PI&&1.5*Math.PI<=v,_=f/100,C={x:w?-1:Math.min(b.x*(b.x<0?1:_),x.x*(x.x<0?1:_)),y:M?-1:Math.min(b.y*(b.y<0?1:_),x.y*(x.y<0?1:_))},S={x:y?1:Math.max(b.x*(b.x>0?1:_),x.x*(x.x>0?1:_)),y:k?1:Math.max(b.y*(b.y>0?1:_),x.y*(x.y>0?1:_))},P={width:.5*(S.x-C.x),height:.5*(S.y-C.y)};d=Math.min(s/P.width,l/P.height),u={x:-.5*(S.x+C.x),y:-.5*(S.y+C.y)}}for(e=0,i=c.length;e<i;++e)c[e]._options=n._resolveElementOptions(c[e],e);for(a.borderWidth=n.getMaxBorderWidth(),a.outerRadius=Math.max((d-a.borderWidth)/2,0),a.innerRadius=Math.max(f?a.outerRadius/100*f:0,0),a.radiusLength=(a.outerRadius-a.innerRadius)/(n._getVisibleDatasetWeightTotal()||1),a.offsetX=u.x*a.outerRadius,a.offsetY=u.y*a.outerRadius,h.total=n.calculateTotal(),n.outerRadius=a.outerRadius-a.radiusLength*n._getRingWeightOffset(n.index),n.innerRadius=Math.max(n.outerRadius-a.radiusLength*p,0),e=0,i=c.length;e<i;++e)n.updateElement(c[e],e,t)},updateElement:function(t,e,i){var n=this,a=n.chart,o=a.chartArea,r=a.options,s=r.animation,l=(o.left+o.right)/2,d=(o.top+o.bottom)/2,u=r.rotation,h=r.rotation,c=n.getDataset(),f=i&&s.animateRotate?0:t.hidden?0:n.calculateCircumference(c.data[e])*(r.circumference/(2*Math.PI)),g=i&&s.animateScale?0:n.innerRadius,p=i&&s.animateScale?0:n.outerRadius,m=t._options||{};ut.extend(t,{_datasetIndex:n.index,_index:e,_model:{backgroundColor:m.backgroundColor,borderColor:m.borderColor,borderWidth:m.borderWidth,borderAlign:m.borderAlign,x:l+a.offsetX,y:d+a.offsetY,startAngle:u,endAngle:h,circumference:f,outerRadius:p,innerRadius:g,label:ut.valueAtIndexOrDefault(c.label,e,a.data.labels[e])}});var v=t._model;i&&s.animateRotate||(v.startAngle=0===e?r.rotation:n.getMeta().data[e-1]._model.endAngle,v.endAngle=v.startAngle+v.circumference),t.pivot()},calculateTotal:function(){var t,e=this.getDataset(),i=this.getMeta(),n=0;return ut.each(i.data,function(i,a){t=e.data[a],isNaN(t)||i.hidden||(n+=Math.abs(t))}),n},calculateCircumference:function(t){var e=this.getMeta().total;return e>0&&!isNaN(t)?2*Math.PI*(Math.abs(t)/e):0},getMaxBorderWidth:function(t){var e,i,n,a,o,r,s,l,d=0,u=this.chart;if(!t)for(e=0,i=u.data.datasets.length;e<i;++e)if(u.isDatasetVisible(e)){t=(n=u.getDatasetMeta(e)).data,e!==this.index&&(o=n.controller);break}if(!t)return 0;for(e=0,i=t.length;e<i;++e)a=t[e],"inner"!==(r=o?o._resolveElementOptions(a,e):a._options).borderAlign&&(s=r.borderWidth,d=(l=r.hoverBorderWidth)>(d=s>d?s:d)?l:d);return d},setHoverStyle:function(t){var e=t._model,i=t._options,n=ut.getHoverColor;t.$previousStyle={backgroundColor:e.backgroundColor,borderColor:e.borderColor,borderWidth:e.borderWidth},e.backgroundColor=Zt(i.hoverBackgroundColor,n(i.backgroundColor)),e.borderColor=Zt(i.hoverBorderColor,n(i.borderColor)),e.borderWidth=Zt(i.hoverBorderWidth,i.borderWidth)},_resolveElementOptions:function(t,e){var i,n,a,o=this.chart,r=this.getDataset(),s=t.custom||{},l=o.options.elements.arc,d={},u={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},h=["backgroundColor","borderColor","borderWidth","borderAlign","hoverBackgroundColor","hoverBorderColor","hoverBorderWidth"];for(i=0,n=h.length;i<n;++i)d[a=h[i]]=Gt([s[a],r[a],l[a]],u,e);return d},_getRingWeightOffset:function(t){for(var e=0,i=0;i<t;++i)this.chart.isDatasetVisible(i)&&(e+=this._getRingWeight(i));return e},_getRingWeight:function(t){return Math.max(Zt(this.chart.data.datasets[t].weight,1),0)},_getVisibleDatasetWeightTotal:function(){return this._getRingWeightOffset(this.chart.data.datasets.length)}});st._set("horizontalBar",{hover:{mode:"index",axis:"y"},scales:{xAxes:[{type:"linear",position:"bottom"}],yAxes:[{type:"category",position:"left",categoryPercentage:.8,barPercentage:.9,offset:!0,gridLines:{offsetGridLines:!0}}]},elements:{rectangle:{borderSkipped:"left"}},tooltips:{mode:"index",axis:"y"}});var Jt=Yt.extend({_getValueScaleId:function(){return this.getMeta().xAxisID},_getIndexScaleId:function(){return this.getMeta().yAxisID}}),Qt=ut.valueOrDefault,te=ut.options.resolve,ee=ut.canvas._isPointInArea;function ie(t,e){return Qt(t.showLine,e.showLines)}st._set("line",{showLines:!0,spanGaps:!1,hover:{mode:"label"},scales:{xAxes:[{type:"category",id:"x-axis-0"}],yAxes:[{type:"linear",id:"y-axis-0"}]}});var ne=Mt.extend({datasetElementType:Wt.Line,dataElementType:Wt.Point,update:function(t){var e,i,n=this,a=n.getMeta(),o=a.dataset,r=a.data||[],s=n.getScaleForId(a.yAxisID),l=n.getDataset(),d=ie(l,n.chart.options);for(d&&(void 0!==l.tension&&void 0===l.lineTension&&(l.lineTension=l.tension),o._scale=s,o._datasetIndex=n.index,o._children=r,o._model=n._resolveLineOptions(o),o.pivot()),e=0,i=r.length;e<i;++e)n.updateElement(r[e],e,t);for(d&&0!==o._model.tension&&n.updateBezierControlPoints(),e=0,i=r.length;e<i;++e)r[e].pivot()},updateElement:function(t,e,i){var n,a,o=this,r=o.getMeta(),s=t.custom||{},l=o.getDataset(),d=o.index,u=l.data[e],h=o.getScaleForId(r.yAxisID),c=o.getScaleForId(r.xAxisID),f=r.dataset._model,g=o._resolvePointOptions(t,e);n=c.getPixelForValue("object"==typeof u?u:NaN,e,d),a=i?h.getBasePixel():o.calculatePointY(u,e,d),t._xScale=c,t._yScale=h,t._options=g,t._datasetIndex=d,t._index=e,t._model={x:n,y:a,skip:s.skip||isNaN(n)||isNaN(a),radius:g.radius,pointStyle:g.pointStyle,rotation:g.rotation,backgroundColor:g.backgroundColor,borderColor:g.borderColor,borderWidth:g.borderWidth,tension:Qt(s.tension,f?f.tension:0),steppedLine:!!f&&f.steppedLine,hitRadius:g.hitRadius}},_resolvePointOptions:function(t,e){var i,n,a,o=this.chart,r=o.data.datasets[this.index],s=t.custom||{},l=o.options.elements.point,d={},u={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},h={backgroundColor:"pointBackgroundColor",borderColor:"pointBorderColor",borderWidth:"pointBorderWidth",hitRadius:"pointHitRadius",hoverBackgroundColor:"pointHoverBackgroundColor",hoverBorderColor:"pointHoverBorderColor",hoverBorderWidth:"pointHoverBorderWidth",hoverRadius:"pointHoverRadius",pointStyle:"pointStyle",radius:"pointRadius",rotation:"pointRotation"},c=Object.keys(h);for(i=0,n=c.length;i<n;++i)d[a=c[i]]=te([s[a],r[h[a]],r[a],l[a]],u,e);return d},_resolveLineOptions:function(t){var e,i,n,a=this.chart,o=a.data.datasets[this.index],r=t.custom||{},s=a.options,l=s.elements.line,d={},u=["backgroundColor","borderWidth","borderColor","borderCapStyle","borderDash","borderDashOffset","borderJoinStyle","fill","cubicInterpolationMode"];for(e=0,i=u.length;e<i;++e)d[n=u[e]]=te([r[n],o[n],l[n]]);return d.spanGaps=Qt(o.spanGaps,s.spanGaps),d.tension=Qt(o.lineTension,l.tension),d.steppedLine=te([r.steppedLine,o.steppedLine,l.stepped]),d},calculatePointY:function(t,e,i){var n,a,o,r=this.chart,s=this.getMeta(),l=this.getScaleForId(s.yAxisID),d=0,u=0;if(l.options.stacked){for(n=0;n<i;n++)if(a=r.data.datasets[n],"line"===(o=r.getDatasetMeta(n)).type&&o.yAxisID===l.id&&r.isDatasetVisible(n)){var h=Number(l.getRightValue(a.data[e]));h<0?u+=h||0:d+=h||0}var c=Number(l.getRightValue(t));return c<0?l.getPixelForValue(u+c):l.getPixelForValue(d+c)}return l.getPixelForValue(t)},updateBezierControlPoints:function(){var t,e,i,n,a=this.chart,o=this.getMeta(),r=o.dataset._model,s=a.chartArea,l=o.data||[];function d(t,e,i){return Math.max(Math.min(t,i),e)}if(r.spanGaps&&(l=l.filter(function(t){return!t._model.skip})),"monotone"===r.cubicInterpolationMode)ut.splineCurveMonotone(l);else for(t=0,e=l.length;t<e;++t)i=l[t]._model,n=ut.splineCurve(ut.previousItem(l,t)._model,i,ut.nextItem(l,t)._model,r.tension),i.controlPointPreviousX=n.previous.x,i.controlPointPreviousY=n.previous.y,i.controlPointNextX=n.next.x,i.controlPointNextY=n.next.y;if(a.options.elements.line.capBezierPoints)for(t=0,e=l.length;t<e;++t)i=l[t]._model,ee(i,s)&&(t>0&&ee(l[t-1]._model,s)&&(i.controlPointPreviousX=d(i.controlPointPreviousX,s.left,s.right),i.controlPointPreviousY=d(i.controlPointPreviousY,s.top,s.bottom)),t<l.length-1&&ee(l[t+1]._model,s)&&(i.controlPointNextX=d(i.controlPointNextX,s.left,s.right),i.controlPointNextY=d(i.controlPointNextY,s.top,s.bottom)))},draw:function(){var t,e=this.chart,i=this.getMeta(),n=i.data||[],a=e.chartArea,o=n.length,r=0;for(ie(this.getDataset(),e.options)&&(t=(i.dataset._model.borderWidth||0)/2,ut.canvas.clipArea(e.ctx,{left:a.left,right:a.right,top:a.top-t,bottom:a.bottom+t}),i.dataset.draw(),ut.canvas.unclipArea(e.ctx));r<o;++r)n[r].draw(a)},setHoverStyle:function(t){var e=t._model,i=t._options,n=ut.getHoverColor;t.$previousStyle={backgroundColor:e.backgroundColor,borderColor:e.borderColor,borderWidth:e.borderWidth,radius:e.radius},e.backgroundColor=Qt(i.hoverBackgroundColor,n(i.backgroundColor)),e.borderColor=Qt(i.hoverBorderColor,n(i.borderColor)),e.borderWidth=Qt(i.hoverBorderWidth,i.borderWidth),e.radius=Qt(i.hoverRadius,i.radius)}}),ae=ut.options.resolve;st._set("polarArea",{scale:{type:"radialLinear",angleLines:{display:!1},gridLines:{circular:!0},pointLabels:{display:!1},ticks:{beginAtZero:!0}},animation:{animateRotate:!0,animateScale:!0},startAngle:-.5*Math.PI,legendCallback:function(t){var e=[];e.push('<ul class="'+t.id+'-legend">');var i=t.data,n=i.datasets,a=i.labels;if(n.length)for(var o=0;o<n[0].data.length;++o)e.push('<li><span style="background-color:'+n[0].backgroundColor[o]+'"></span>'),a[o]&&e.push(a[o]),e.push("</li>");return e.push("</ul>"),e.join("")},legend:{labels:{generateLabels:function(t){var e=t.data;return e.labels.length&&e.datasets.length?e.labels.map(function(i,n){var a=t.getDatasetMeta(0),o=e.datasets[0],r=a.data[n].custom||{},s=t.options.elements.arc;return{text:i,fillStyle:ae([r.backgroundColor,o.backgroundColor,s.backgroundColor],void 0,n),strokeStyle:ae([r.borderColor,o.borderColor,s.borderColor],void 0,n),lineWidth:ae([r.borderWidth,o.borderWidth,s.borderWidth],void 0,n),hidden:isNaN(o.data[n])||a.data[n].hidden,index:n}}):[]}},onClick:function(t,e){var i,n,a,o=e.index,r=this.chart;for(i=0,n=(r.data.datasets||[]).length;i<n;++i)(a=r.getDatasetMeta(i)).data[o].hidden=!a.data[o].hidden;r.update()}},tooltips:{callbacks:{title:function(){return""},label:function(t,e){return e.labels[t.index]+": "+t.yLabel}}}});var oe=Mt.extend({dataElementType:Wt.Arc,linkScales:ut.noop,update:function(t){var e,i,n,a=this,o=a.getDataset(),r=a.getMeta(),s=a.chart.options.startAngle||0,l=a._starts=[],d=a._angles=[],u=r.data;for(a._updateRadius(),r.count=a.countVisibleElements(),e=0,i=o.data.length;e<i;e++)l[e]=s,n=a._computeAngle(e),d[e]=n,s+=n;for(e=0,i=u.length;e<i;++e)u[e]._options=a._resolveElementOptions(u[e],e),a.updateElement(u[e],e,t)},_updateRadius:function(){var t=this,e=t.chart,i=e.chartArea,n=e.options,a=Math.min(i.right-i.left,i.bottom-i.top);e.outerRadius=Math.max(a/2,0),e.innerRadius=Math.max(n.cutoutPercentage?e.outerRadius/100*n.cutoutPercentage:1,0),e.radiusLength=(e.outerRadius-e.innerRadius)/e.getVisibleDatasetCount(),t.outerRadius=e.outerRadius-e.radiusLength*t.index,t.innerRadius=t.outerRadius-e.radiusLength},updateElement:function(t,e,i){var n=this,a=n.chart,o=n.getDataset(),r=a.options,s=r.animation,l=a.scale,d=a.data.labels,u=l.xCenter,h=l.yCenter,c=r.startAngle,f=t.hidden?0:l.getDistanceFromCenterForValue(o.data[e]),g=n._starts[e],p=g+(t.hidden?0:n._angles[e]),m=s.animateScale?0:l.getDistanceFromCenterForValue(o.data[e]),v=t._options||{};ut.extend(t,{_datasetIndex:n.index,_index:e,_scale:l,_model:{backgroundColor:v.backgroundColor,borderColor:v.borderColor,borderWidth:v.borderWidth,borderAlign:v.borderAlign,x:u,y:h,innerRadius:0,outerRadius:i?m:f,startAngle:i&&s.animateRotate?c:g,endAngle:i&&s.animateRotate?c:p,label:ut.valueAtIndexOrDefault(d,e,d[e])}}),t.pivot()},countVisibleElements:function(){var t=this.getDataset(),e=this.getMeta(),i=0;return ut.each(e.data,function(e,n){isNaN(t.data[n])||e.hidden||i++}),i},setHoverStyle:function(t){var e=t._model,i=t._options,n=ut.getHoverColor,a=ut.valueOrDefault;t.$previousStyle={backgroundColor:e.backgroundColor,borderColor:e.borderColor,borderWidth:e.borderWidth},e.backgroundColor=a(i.hoverBackgroundColor,n(i.backgroundColor)),e.borderColor=a(i.hoverBorderColor,n(i.borderColor)),e.borderWidth=a(i.hoverBorderWidth,i.borderWidth)},_resolveElementOptions:function(t,e){var i,n,a,o=this.chart,r=this.getDataset(),s=t.custom||{},l=o.options.elements.arc,d={},u={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},h=["backgroundColor","borderColor","borderWidth","borderAlign","hoverBackgroundColor","hoverBorderColor","hoverBorderWidth"];for(i=0,n=h.length;i<n;++i)d[a=h[i]]=ae([s[a],r[a],l[a]],u,e);return d},_computeAngle:function(t){var e=this,i=this.getMeta().count,n=e.getDataset(),a=e.getMeta();if(isNaN(n.data[t])||a.data[t].hidden)return 0;var o={chart:e.chart,dataIndex:t,dataset:n,datasetIndex:e.index};return ae([e.chart.options.elements.arc.angle,2*Math.PI/i],o,t)}});st._set("pie",ut.clone(st.doughnut)),st._set("pie",{cutoutPercentage:0});var re=$t,se=ut.valueOrDefault,le=ut.options.resolve;st._set("radar",{scale:{type:"radialLinear"},elements:{line:{tension:0}}});var de=Mt.extend({datasetElementType:Wt.Line,dataElementType:Wt.Point,linkScales:ut.noop,update:function(t){var e,i,n=this,a=n.getMeta(),o=a.dataset,r=a.data||[],s=n.chart.scale,l=n.getDataset();for(void 0!==l.tension&&void 0===l.lineTension&&(l.lineTension=l.tension),o._scale=s,o._datasetIndex=n.index,o._children=r,o._loop=!0,o._model=n._resolveLineOptions(o),o.pivot(),e=0,i=r.length;e<i;++e)n.updateElement(r[e],e,t);for(n.updateBezierControlPoints(),e=0,i=r.length;e<i;++e)r[e].pivot()},updateElement:function(t,e,i){var n=this,a=t.custom||{},o=n.getDataset(),r=n.chart.scale,s=r.getPointPositionForValue(e,o.data[e]),l=n._resolvePointOptions(t,e),d=n.getMeta().dataset._model,u=i?r.xCenter:s.x,h=i?r.yCenter:s.y;t._scale=r,t._options=l,t._datasetIndex=n.index,t._index=e,t._model={x:u,y:h,skip:a.skip||isNaN(u)||isNaN(h),radius:l.radius,pointStyle:l.pointStyle,rotation:l.rotation,backgroundColor:l.backgroundColor,borderColor:l.borderColor,borderWidth:l.borderWidth,tension:se(a.tension,d?d.tension:0),hitRadius:l.hitRadius}},_resolvePointOptions:function(t,e){var i,n,a,o=this.chart,r=o.data.datasets[this.index],s=t.custom||{},l=o.options.elements.point,d={},u={chart:o,dataIndex:e,dataset:r,datasetIndex:this.index},h={backgroundColor:"pointBackgroundColor",borderColor:"pointBorderColor",borderWidth:"pointBorderWidth",hitRadius:"pointHitRadius",hoverBackgroundColor:"pointHoverBackgroundColor",hoverBorderColor:"pointHoverBorderColor",hoverBorderWidth:"pointHoverBorderWidth",hoverRadius:"pointHoverRadius",pointStyle:"pointStyle",radius:"pointRadius",rotation:"pointRotation"},c=Object.keys(h);for(i=0,n=c.length;i<n;++i)d[a=c[i]]=le([s[a],r[h[a]],r[a],l[a]],u,e);return d},_resolveLineOptions:function(t){var e,i,n,a=this.chart,o=a.data.datasets[this.index],r=t.custom||{},s=a.options.elements.line,l={},d=["backgroundColor","borderWidth","borderColor","borderCapStyle","borderDash","borderDashOffset","borderJoinStyle","fill"];for(e=0,i=d.length;e<i;++e)l[n=d[e]]=le([r[n],o[n],s[n]]);return l.tension=se(o.lineTension,s.tension),l},updateBezierControlPoints:function(){var t,e,i,n,a=this.getMeta(),o=this.chart.chartArea,r=a.data||[];function s(t,e,i){return Math.max(Math.min(t,i),e)}for(t=0,e=r.length;t<e;++t)i=r[t]._model,n=ut.splineCurve(ut.previousItem(r,t,!0)._model,i,ut.nextItem(r,t,!0)._model,i.tension),i.controlPointPreviousX=s(n.previous.x,o.left,o.right),i.controlPointPreviousY=s(n.previous.y,o.top,o.bottom),i.controlPointNextX=s(n.next.x,o.left,o.right),i.controlPointNextY=s(n.next.y,o.top,o.bottom)},setHoverStyle:function(t){var e=t._model,i=t._options,n=ut.getHoverColor;t.$previousStyle={backgroundColor:e.backgroundColor,borderColor:e.borderColor,borderWidth:e.borderWidth,radius:e.radius},e.backgroundColor=se(i.hoverBackgroundColor,n(i.backgroundColor)),e.borderColor=se(i.hoverBorderColor,n(i.borderColor)),e.borderWidth=se(i.hoverBorderWidth,i.borderWidth),e.radius=se(i.hoverRadius,i.radius)}});st._set("scatter",{hover:{mode:"single"},scales:{xAxes:[{id:"x-axis-1",type:"linear",position:"bottom"}],yAxes:[{id:"y-axis-1",type:"linear",position:"left"}]},showLines:!1,tooltips:{callbacks:{title:function(){return""},label:function(t){return"("+t.xLabel+", "+t.yLabel+")"}}}});var ue={bar:Yt,bubble:Kt,doughnut:$t,horizontalBar:Jt,line:ne,polarArea:oe,pie:re,radar:de,scatter:ne};function he(t,e){return t.native?{x:t.x,y:t.y}:ut.getRelativePosition(t,e)}function ce(t,e){var i,n,a,o,r;for(n=0,o=t.data.datasets.length;n<o;++n)if(t.isDatasetVisible(n))for(a=0,r=(i=t.getDatasetMeta(n)).data.length;a<r;++a){var s=i.data[a];s._view.skip||e(s)}}function fe(t,e){var i=[];return ce(t,function(t){t.inRange(e.x,e.y)&&i.push(t)}),i}function ge(t,e,i,n){var a=Number.POSITIVE_INFINITY,o=[];return ce(t,function(t){if(!i||t.inRange(e.x,e.y)){var r=t.getCenterPoint(),s=n(e,r);s<a?(o=[t],a=s):s===a&&o.push(t)}}),o}function pe(t){var e=-1!==t.indexOf("x"),i=-1!==t.indexOf("y");return function(t,n){var a=e?Math.abs(t.x-n.x):0,o=i?Math.abs(t.y-n.y):0;return Math.sqrt(Math.pow(a,2)+Math.pow(o,2))}}function me(t,e,i){var n=he(e,t);i.axis=i.axis||"x";var a=pe(i.axis),o=i.intersect?fe(t,n):ge(t,n,!1,a),r=[];return o.length?(t.data.datasets.forEach(function(e,i){if(t.isDatasetVisible(i)){var n=t.getDatasetMeta(i).data[o[0]._index];n&&!n._view.skip&&r.push(n)}}),r):[]}var ve={modes:{single:function(t,e){var i=he(e,t),n=[];return ce(t,function(t){if(t.inRange(i.x,i.y))return n.push(t),n}),n.slice(0,1)},label:me,index:me,dataset:function(t,e,i){var n=he(e,t);i.axis=i.axis||"xy";var a=pe(i.axis),o=i.intersect?fe(t,n):ge(t,n,!1,a);return o.length>0&&(o=t.getDatasetMeta(o[0]._datasetIndex).data),o},"x-axis":function(t,e){return me(t,e,{intersect:!1})},point:function(t,e){return fe(t,he(e,t))},nearest:function(t,e,i){var n=he(e,t);i.axis=i.axis||"xy";var a=pe(i.axis);return ge(t,n,i.intersect,a)},x:function(t,e,i){var n=he(e,t),a=[],o=!1;return ce(t,function(t){t.inXRange(n.x)&&a.push(t),t.inRange(n.x,n.y)&&(o=!0)}),i.intersect&&!o&&(a=[]),a},y:function(t,e,i){var n=he(e,t),a=[],o=!1;return ce(t,function(t){t.inYRange(n.y)&&a.push(t),t.inRange(n.x,n.y)&&(o=!0)}),i.intersect&&!o&&(a=[]),a}}};function be(t,e){return ut.where(t,function(t){return t.position===e})}function xe(t,e){t.forEach(function(t,e){return t._tmpIndex_=e,t}),t.sort(function(t,i){var n=e?i:t,a=e?t:i;return n.weight===a.weight?n._tmpIndex_-a._tmpIndex_:n.weight-a.weight}),t.forEach(function(t){delete t._tmpIndex_})}function ye(t,e){ut.each(t,function(t){e[t.position]+=t.isHorizontal()?t.height:t.width})}st._set("global",{layout:{padding:{top:0,right:0,bottom:0,left:0}}});var ke={defaults:{},addBox:function(t,e){t.boxes||(t.boxes=[]),e.fullWidth=e.fullWidth||!1,e.position=e.position||"top",e.weight=e.weight||0,t.boxes.push(e)},removeBox:function(t,e){var i=t.boxes?t.boxes.indexOf(e):-1;-1!==i&&t.boxes.splice(i,1)},configure:function(t,e,i){for(var n,a=["fullWidth","position","weight"],o=a.length,r=0;r<o;++r)n=a[r],i.hasOwnProperty(n)&&(e[n]=i[n])},update:function(t,e,i){if(t){var n=t.options.layout||{},a=ut.options.toPadding(n.padding),o=a.left,r=a.right,s=a.top,l=a.bottom,d=be(t.boxes,"left"),u=be(t.boxes,"right"),h=be(t.boxes,"top"),c=be(t.boxes,"bottom"),f=be(t.boxes,"chartArea");xe(d,!0),xe(u,!1),xe(h,!0),xe(c,!1);var g,p=d.concat(u),m=h.concat(c),v=p.concat(m),b=e-o-r,x=i-s-l,y=(e-b/2)/p.length,k=b,w=x,M={top:s,left:o,bottom:l,right:r},_=[];ut.each(v,function(t){var e,i=t.isHorizontal();i?(e=t.update(t.fullWidth?b:k,x/2),w-=e.height):(e=t.update(y,w),k-=e.width),_.push({horizontal:i,width:e.width,box:t})}),g=function(t){var e=0,i=0,n=0,a=0;return ut.each(t,function(t){if(t.getPadding){var o=t.getPadding();e=Math.max(e,o.top),i=Math.max(i,o.left),n=Math.max(n,o.bottom),a=Math.max(a,o.right)}}),{top:e,left:i,bottom:n,right:a}}(v),ut.each(p,T),ye(p,M),ut.each(m,T),ye(m,M),ut.each(p,function(t){var e=ut.findNextWhere(_,function(e){return e.box===t}),i={left:0,right:0,top:M.top,bottom:M.bottom};e&&t.update(e.width,w,i)}),ye(v,M={top:s,left:o,bottom:l,right:r});var C=Math.max(g.left-M.left,0);M.left+=C,M.right+=Math.max(g.right-M.right,0);var S=Math.max(g.top-M.top,0);M.top+=S,M.bottom+=Math.max(g.bottom-M.bottom,0);var P=i-M.top-M.bottom,I=e-M.left-M.right;I===k&&P===w||(ut.each(p,function(t){t.height=P}),ut.each(m,function(t){t.fullWidth||(t.width=I)}),w=P,k=I);var A=o+C,D=s+S;ut.each(d.concat(h),F),A+=k,D+=w,ut.each(u,F),ut.each(c,F),t.chartArea={left:M.left,top:M.top,right:M.left+k,bottom:M.top+w},ut.each(f,function(e){e.left=t.chartArea.left,e.top=t.chartArea.top,e.right=t.chartArea.right,e.bottom=t.chartArea.bottom,e.update(k,w)})}function T(t){var e=ut.findNextWhere(_,function(e){return e.box===t});if(e)if(e.horizontal){var i={left:Math.max(M.left,g.left),right:Math.max(M.right,g.right),top:0,bottom:0};t.update(t.fullWidth?b:k,x/2,i)}else t.update(e.width,w)}function F(t){t.isHorizontal()?(t.left=t.fullWidth?o:M.left,t.right=t.fullWidth?e-r:M.left+k,t.top=D,t.bottom=D+t.height,D=t.bottom):(t.left=A,t.right=A+t.width,t.top=M.top,t.bottom=M.top+w,A=t.right)}}};var we,Me=(we=Object.freeze({default:"@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}"}))&&we.default||we,_e="$chartjs",Ce="chartjs-size-monitor",Se="chartjs-render-monitor",Pe="chartjs-render-animation",Ie=["animationstart","webkitAnimationStart"],Ae={touchstart:"mousedown",touchmove:"mousemove",touchend:"mouseup",pointerenter:"mouseenter",pointerdown:"mousedown",pointermove:"mousemove",pointerup:"mouseup",pointerleave:"mouseout",pointerout:"mouseout"};function De(t,e){var i=ut.getStyle(t,e),n=i&&i.match(/^(\d+)(\.\d+)?px$/);return n?Number(n[1]):void 0}var Te=!!function(){var t=!1;try{var e=Object.defineProperty({},"passive",{get:function(){t=!0}});window.addEventListener("e",null,e)}catch(t){}return t}()&&{passive:!0};function Fe(t,e,i){t.addEventListener(e,i,Te)}function Le(t,e,i){t.removeEventListener(e,i,Te)}function Re(t,e,i,n,a){return{type:t,chart:e,native:a||null,x:void 0!==i?i:null,y:void 0!==n?n:null}}function Oe(t){var e=document.createElement("div");return e.className=t||"",e}function ze(t,e,i){var n,a,o,r,s=t[_e]||(t[_e]={}),l=s.resizer=function(t){var e=Oe(Ce),i=Oe(Ce+"-expand"),n=Oe(Ce+"-shrink");i.appendChild(Oe()),n.appendChild(Oe()),e.appendChild(i),e.appendChild(n),e._reset=function(){i.scrollLeft=1e6,i.scrollTop=1e6,n.scrollLeft=1e6,n.scrollTop=1e6};var a=function(){e._reset(),t()};return Fe(i,"scroll",a.bind(i,"expand")),Fe(n,"scroll",a.bind(n,"shrink")),e}((n=function(){if(s.resizer){var n=i.options.maintainAspectRatio&&t.parentNode,a=n?n.clientWidth:0;e(Re("resize",i)),n&&n.clientWidth<a&&i.canvas&&e(Re("resize",i))}},o=!1,r=[],function(){r=Array.prototype.slice.call(arguments),a=a||this,o||(o=!0,ut.requestAnimFrame.call(window,function(){o=!1,n.apply(a,r)}))}));!function(t,e){var i=t[_e]||(t[_e]={}),n=i.renderProxy=function(t){t.animationName===Pe&&e()};ut.each(Ie,function(e){Fe(t,e,n)}),i.reflow=!!t.offsetParent,t.classList.add(Se)}(t,function(){if(s.resizer){var e=t.parentNode;e&&e!==l.parentNode&&e.insertBefore(l,e.firstChild),l._reset()}})}function Be(t){var e=t[_e]||{},i=e.resizer;delete e.resizer,function(t){var e=t[_e]||{},i=e.renderProxy;i&&(ut.each(Ie,function(e){Le(t,e,i)}),delete e.renderProxy),t.classList.remove(Se)}(t),i&&i.parentNode&&i.parentNode.removeChild(i)}var Ne={disableCSSInjection:!1,_enabled:"undefined"!=typeof window&&"undefined"!=typeof document,_ensureLoaded:function(){var t,e,i;this._loaded||(this._loaded=!0,this.disableCSSInjection||(e=Me,i=(t=this)._style||document.createElement("style"),t._style||(t._style=i,e="/* Chart.js */\n"+e,i.setAttribute("type","text/css"),document.getElementsByTagName("head")[0].appendChild(i)),i.appendChild(document.createTextNode(e))))},acquireContext:function(t,e){"string"==typeof t?t=document.getElementById(t):t.length&&(t=t[0]),t&&t.canvas&&(t=t.canvas);var i=t&&t.getContext&&t.getContext("2d");return this._ensureLoaded(),i&&i.canvas===t?(function(t,e){var i=t.style,n=t.getAttribute("height"),a=t.getAttribute("width");if(t[_e]={initial:{height:n,width:a,style:{display:i.display,height:i.height,width:i.width}}},i.display=i.display||"block",null===a||""===a){var o=De(t,"width");void 0!==o&&(t.width=o)}if(null===n||""===n)if(""===t.style.height)t.height=t.width/(e.options.aspectRatio||2);else{var r=De(t,"height");void 0!==o&&(t.height=r)}}(t,e),i):null},releaseContext:function(t){var e=t.canvas;if(e[_e]){var i=e[_e].initial;["height","width"].forEach(function(t){var n=i[t];ut.isNullOrUndef(n)?e.removeAttribute(t):e.setAttribute(t,n)}),ut.each(i.style||{},function(t,i){e.style[i]=t}),e.width=e.width,delete e[_e]}},addEventListener:function(t,e,i){var n=t.canvas;if("resize"!==e){var a=i[_e]||(i[_e]={});Fe(n,e,(a.proxies||(a.proxies={}))[t.id+"_"+e]=function(e){i(function(t,e){var i=Ae[t.type]||t.type,n=ut.getRelativePosition(t,e);return Re(i,e,n.x,n.y,t)}(e,t))})}else ze(n,i,t)},removeEventListener:function(t,e,i){var n=t.canvas;if("resize"!==e){var a=((i[_e]||{}).proxies||{})[t.id+"_"+e];a&&Le(n,e,a)}else Be(n)}};ut.addEvent=Fe,ut.removeEvent=Le;var We=Ne._enabled?Ne:{acquireContext:function(t){return t&&t.canvas&&(t=t.canvas),t&&t.getContext("2d")||null}},Ve=ut.extend({initialize:function(){},acquireContext:function(){},releaseContext:function(){},addEventListener:function(){},removeEventListener:function(){}},We);st._set("global",{plugins:{}});var Ee={_plugins:[],_cacheId:0,register:function(t){var e=this._plugins;[].concat(t).forEach(function(t){-1===e.indexOf(t)&&e.push(t)}),this._cacheId++},unregister:function(t){var e=this._plugins;[].concat(t).forEach(function(t){var i=e.indexOf(t);-1!==i&&e.splice(i,1)}),this._cacheId++},clear:function(){this._plugins=[],this._cacheId++},count:function(){return this._plugins.length},getAll:function(){return this._plugins},notify:function(t,e,i){var n,a,o,r,s,l=this.descriptors(t),d=l.length;for(n=0;n<d;++n)if("function"==typeof(s=(o=(a=l[n]).plugin)[e])&&((r=[t].concat(i||[])).push(a.options),!1===s.apply(o,r)))return!1;return!0},descriptors:function(t){var e=t.$plugins||(t.$plugins={});if(e.id===this._cacheId)return e.descriptors;var i=[],n=[],a=t&&t.config||{},o=a.options&&a.options.plugins||{};return this._plugins.concat(a.plugins||[]).forEach(function(t){if(-1===i.indexOf(t)){var e=t.id,a=o[e];!1!==a&&(!0===a&&(a=ut.clone(st.global.plugins[e])),i.push(t),n.push({plugin:t,options:a||{}}))}}),e.descriptors=n,e.id=this._cacheId,n},_invalidate:function(t){delete t.$plugins}},He={constructors:{},defaults:{},registerScaleType:function(t,e,i){this.constructors[t]=e,this.defaults[t]=ut.clone(i)},getScaleConstructor:function(t){return this.constructors.hasOwnProperty(t)?this.constructors[t]:void 0},getScaleDefaults:function(t){return this.defaults.hasOwnProperty(t)?ut.merge({},[st.scale,this.defaults[t]]):{}},updateScaleDefaults:function(t,e){this.defaults.hasOwnProperty(t)&&(this.defaults[t]=ut.extend(this.defaults[t],e))},addScalesToLayout:function(t){ut.each(t.scales,function(e){e.fullWidth=e.options.fullWidth,e.position=e.options.position,e.weight=e.options.weight,ke.addBox(t,e)})}},je=ut.valueOrDefault;st._set("global",{tooltips:{enabled:!0,custom:null,mode:"nearest",position:"average",intersect:!0,backgroundColor:"rgba(0,0,0,0.8)",titleFontStyle:"bold",titleSpacing:2,titleMarginBottom:6,titleFontColor:"#fff",titleAlign:"left",bodySpacing:2,bodyFontColor:"#fff",bodyAlign:"left",footerFontStyle:"bold",footerSpacing:2,footerMarginTop:6,footerFontColor:"#fff",footerAlign:"left",yPadding:6,xPadding:6,caretPadding:2,caretSize:5,cornerRadius:6,multiKeyBackground:"#fff",displayColors:!0,borderColor:"rgba(0,0,0,0)",borderWidth:0,callbacks:{beforeTitle:ut.noop,title:function(t,e){var i="",n=e.labels,a=n?n.length:0;if(t.length>0){var o=t[0];o.label?i=o.label:o.xLabel?i=o.xLabel:a>0&&o.index<a&&(i=n[o.index])}return i},afterTitle:ut.noop,beforeBody:ut.noop,beforeLabel:ut.noop,label:function(t,e){var i=e.datasets[t.datasetIndex].label||"";return i&&(i+=": "),ut.isNullOrUndef(t.value)?i+=t.yLabel:i+=t.value,i},labelColor:function(t,e){var i=e.getDatasetMeta(t.datasetIndex).data[t.index]._view;return{borderColor:i.borderColor,backgroundColor:i.backgroundColor}},labelTextColor:function(){return this._options.bodyFontColor},afterLabel:ut.noop,afterBody:ut.noop,beforeFooter:ut.noop,footer:ut.noop,afterFooter:ut.noop}}});var qe={average:function(t){if(!t.length)return!1;var e,i,n=0,a=0,o=0;for(e=0,i=t.length;e<i;++e){var r=t[e];if(r&&r.hasValue()){var s=r.tooltipPosition();n+=s.x,a+=s.y,++o}}return{x:n/o,y:a/o}},nearest:function(t,e){var i,n,a,o=e.x,r=e.y,s=Number.POSITIVE_INFINITY;for(i=0,n=t.length;i<n;++i){var l=t[i];if(l&&l.hasValue()){var d=l.getCenterPoint(),u=ut.distanceBetweenPoints(e,d);u<s&&(s=u,a=l)}}if(a){var h=a.tooltipPosition();o=h.x,r=h.y}return{x:o,y:r}}};function Ye(t,e){return e&&(ut.isArray(e)?Array.prototype.push.apply(t,e):t.push(e)),t}function Ue(t){return("string"==typeof t||t instanceof String)&&t.indexOf("\n")>-1?t.split("\n"):t}function Xe(t){var e=st.global;return{xPadding:t.xPadding,yPadding:t.yPadding,xAlign:t.xAlign,yAlign:t.yAlign,bodyFontColor:t.bodyFontColor,_bodyFontFamily:je(t.bodyFontFamily,e.defaultFontFamily),_bodyFontStyle:je(t.bodyFontStyle,e.defaultFontStyle),_bodyAlign:t.bodyAlign,bodyFontSize:je(t.bodyFontSize,e.defaultFontSize),bodySpacing:t.bodySpacing,titleFontColor:t.titleFontColor,_titleFontFamily:je(t.titleFontFamily,e.defaultFontFamily),_titleFontStyle:je(t.titleFontStyle,e.defaultFontStyle),titleFontSize:je(t.titleFontSize,e.defaultFontSize),_titleAlign:t.titleAlign,titleSpacing:t.titleSpacing,titleMarginBottom:t.titleMarginBottom,footerFontColor:t.footerFontColor,_footerFontFamily:je(t.footerFontFamily,e.defaultFontFamily),_footerFontStyle:je(t.footerFontStyle,e.defaultFontStyle),footerFontSize:je(t.footerFontSize,e.defaultFontSize),_footerAlign:t.footerAlign,footerSpacing:t.footerSpacing,footerMarginTop:t.footerMarginTop,caretSize:t.caretSize,cornerRadius:t.cornerRadius,backgroundColor:t.backgroundColor,opacity:0,legendColorBackground:t.multiKeyBackground,displayColors:t.displayColors,borderColor:t.borderColor,borderWidth:t.borderWidth}}function Ke(t,e){return"center"===e?t.x+t.width/2:"right"===e?t.x+t.width-t.xPadding:t.x+t.xPadding}function Ge(t){return Ye([],Ue(t))}var Ze=pt.extend({initialize:function(){this._model=Xe(this._options),this._lastActive=[]},getTitle:function(){var t=this._options.callbacks,e=t.beforeTitle.apply(this,arguments),i=t.title.apply(this,arguments),n=t.afterTitle.apply(this,arguments),a=[];return a=Ye(a,Ue(e)),a=Ye(a,Ue(i)),a=Ye(a,Ue(n))},getBeforeBody:function(){return Ge(this._options.callbacks.beforeBody.apply(this,arguments))},getBody:function(t,e){var i=this,n=i._options.callbacks,a=[];return ut.each(t,function(t){var o={before:[],lines:[],after:[]};Ye(o.before,Ue(n.beforeLabel.call(i,t,e))),Ye(o.lines,n.label.call(i,t,e)),Ye(o.after,Ue(n.afterLabel.call(i,t,e))),a.push(o)}),a},getAfterBody:function(){return Ge(this._options.callbacks.afterBody.apply(this,arguments))},getFooter:function(){var t=this._options.callbacks,e=t.beforeFooter.apply(this,arguments),i=t.footer.apply(this,arguments),n=t.afterFooter.apply(this,arguments),a=[];return a=Ye(a,Ue(e)),a=Ye(a,Ue(i)),a=Ye(a,Ue(n))},update:function(t){var e,i,n,a,o,r,s,l,d,u,h=this,c=h._options,f=h._model,g=h._model=Xe(c),p=h._active,m=h._data,v={xAlign:f.xAlign,yAlign:f.yAlign},b={x:f.x,y:f.y},x={width:f.width,height:f.height},y={x:f.caretX,y:f.caretY};if(p.length){g.opacity=1;var k=[],w=[];y=qe[c.position].call(h,p,h._eventPosition);var M=[];for(e=0,i=p.length;e<i;++e)M.push((n=p[e],a=void 0,o=void 0,r=void 0,s=void 0,l=void 0,d=void 0,u=void 0,a=n._xScale,o=n._yScale||n._scale,r=n._index,s=n._datasetIndex,l=n._chart.getDatasetMeta(s).controller,d=l._getIndexScale(),u=l._getValueScale(),{xLabel:a?a.getLabelForIndex(r,s):"",yLabel:o?o.getLabelForIndex(r,s):"",label:d?""+d.getLabelForIndex(r,s):"",value:u?""+u.getLabelForIndex(r,s):"",index:r,datasetIndex:s,x:n._model.x,y:n._model.y}));c.filter&&(M=M.filter(function(t){return c.filter(t,m)})),c.itemSort&&(M=M.sort(function(t,e){return c.itemSort(t,e,m)})),ut.each(M,function(t){k.push(c.callbacks.labelColor.call(h,t,h._chart)),w.push(c.callbacks.labelTextColor.call(h,t,h._chart))}),g.title=h.getTitle(M,m),g.beforeBody=h.getBeforeBody(M,m),g.body=h.getBody(M,m),g.afterBody=h.getAfterBody(M,m),g.footer=h.getFooter(M,m),g.x=y.x,g.y=y.y,g.caretPadding=c.caretPadding,g.labelColors=k,g.labelTextColors=w,g.dataPoints=M,x=function(t,e){var i=t._chart.ctx,n=2*e.yPadding,a=0,o=e.body,r=o.reduce(function(t,e){return t+e.before.length+e.lines.length+e.after.length},0);r+=e.beforeBody.length+e.afterBody.length;var s=e.title.length,l=e.footer.length,d=e.titleFontSize,u=e.bodyFontSize,h=e.footerFontSize;n+=s*d,n+=s?(s-1)*e.titleSpacing:0,n+=s?e.titleMarginBottom:0,n+=r*u,n+=r?(r-1)*e.bodySpacing:0,n+=l?e.footerMarginTop:0,n+=l*h,n+=l?(l-1)*e.footerSpacing:0;var c=0,f=function(t){a=Math.max(a,i.measureText(t).width+c)};return i.font=ut.fontString(d,e._titleFontStyle,e._titleFontFamily),ut.each(e.title,f),i.font=ut.fontString(u,e._bodyFontStyle,e._bodyFontFamily),ut.each(e.beforeBody.concat(e.afterBody),f),c=e.displayColors?u+2:0,ut.each(o,function(t){ut.each(t.before,f),ut.each(t.lines,f),ut.each(t.after,f)}),c=0,i.font=ut.fontString(h,e._footerFontStyle,e._footerFontFamily),ut.each(e.footer,f),{width:a+=2*e.xPadding,height:n}}(this,g),b=function(t,e,i,n){var a=t.x,o=t.y,r=t.caretSize,s=t.caretPadding,l=t.cornerRadius,d=i.xAlign,u=i.yAlign,h=r+s,c=l+s;return"right"===d?a-=e.width:"center"===d&&((a-=e.width/2)+e.width>n.width&&(a=n.width-e.width),a<0&&(a=0)),"top"===u?o+=h:o-="bottom"===u?e.height+h:e.height/2,"center"===u?"left"===d?a+=h:"right"===d&&(a-=h):"left"===d?a-=c:"right"===d&&(a+=c),{x:a,y:o}}(g,x,v=function(t,e){var i,n,a,o,r,s=t._model,l=t._chart,d=t._chart.chartArea,u="center",h="center";s.y<e.height?h="top":s.y>l.height-e.height&&(h="bottom");var c=(d.left+d.right)/2,f=(d.top+d.bottom)/2;"center"===h?(i=function(t){return t<=c},n=function(t){return t>c}):(i=function(t){return t<=e.width/2},n=function(t){return t>=l.width-e.width/2}),a=function(t){return t+e.width+s.caretSize+s.caretPadding>l.width},o=function(t){return t-e.width-s.caretSize-s.caretPadding<0},r=function(t){return t<=f?"top":"bottom"},i(s.x)?(u="left",a(s.x)&&(u="center",h=r(s.y))):n(s.x)&&(u="right",o(s.x)&&(u="center",h=r(s.y)));var g=t._options;return{xAlign:g.xAlign?g.xAlign:u,yAlign:g.yAlign?g.yAlign:h}}(this,x),h._chart)}else g.opacity=0;return g.xAlign=v.xAlign,g.yAlign=v.yAlign,g.x=b.x,g.y=b.y,g.width=x.width,g.height=x.height,g.caretX=y.x,g.caretY=y.y,h._model=g,t&&c.custom&&c.custom.call(h,g),h},drawCaret:function(t,e){var i=this._chart.ctx,n=this._view,a=this.getCaretPosition(t,e,n);i.lineTo(a.x1,a.y1),i.lineTo(a.x2,a.y2),i.lineTo(a.x3,a.y3)},getCaretPosition:function(t,e,i){var n,a,o,r,s,l,d=i.caretSize,u=i.cornerRadius,h=i.xAlign,c=i.yAlign,f=t.x,g=t.y,p=e.width,m=e.height;if("center"===c)s=g+m/2,"left"===h?(a=(n=f)-d,o=n,r=s+d,l=s-d):(a=(n=f+p)+d,o=n,r=s-d,l=s+d);else if("left"===h?(n=(a=f+u+d)-d,o=a+d):"right"===h?(n=(a=f+p-u-d)-d,o=a+d):(n=(a=i.caretX)-d,o=a+d),"top"===c)s=(r=g)-d,l=r;else{s=(r=g+m)+d,l=r;var v=o;o=n,n=v}return{x1:n,x2:a,x3:o,y1:r,y2:s,y3:l}},drawTitle:function(t,e,i){var n=e.title;if(n.length){t.x=Ke(e,e._titleAlign),i.textAlign=e._titleAlign,i.textBaseline="top";var a,o,r=e.titleFontSize,s=e.titleSpacing;for(i.fillStyle=e.titleFontColor,i.font=ut.fontString(r,e._titleFontStyle,e._titleFontFamily),a=0,o=n.length;a<o;++a)i.fillText(n[a],t.x,t.y),t.y+=r+s,a+1===n.length&&(t.y+=e.titleMarginBottom-s)}},drawBody:function(t,e,i){var n,a=e.bodyFontSize,o=e.bodySpacing,r=e._bodyAlign,s=e.body,l=e.displayColors,d=e.labelColors,u=0,h=l?Ke(e,"left"):0;i.textAlign=r,i.textBaseline="top",i.font=ut.fontString(a,e._bodyFontStyle,e._bodyFontFamily),t.x=Ke(e,r);var c=function(e){i.fillText(e,t.x+u,t.y),t.y+=a+o};i.fillStyle=e.bodyFontColor,ut.each(e.beforeBody,c),u=l&&"right"!==r?"center"===r?a/2+1:a+2:0,ut.each(s,function(o,r){n=e.labelTextColors[r],i.fillStyle=n,ut.each(o.before,c),ut.each(o.lines,function(o){l&&(i.fillStyle=e.legendColorBackground,i.fillRect(h,t.y,a,a),i.lineWidth=1,i.strokeStyle=d[r].borderColor,i.strokeRect(h,t.y,a,a),i.fillStyle=d[r].backgroundColor,i.fillRect(h+1,t.y+1,a-2,a-2),i.fillStyle=n),c(o)}),ut.each(o.after,c)}),u=0,ut.each(e.afterBody,c),t.y-=o},drawFooter:function(t,e,i){var n=e.footer;n.length&&(t.x=Ke(e,e._footerAlign),t.y+=e.footerMarginTop,i.textAlign=e._footerAlign,i.textBaseline="top",i.fillStyle=e.footerFontColor,i.font=ut.fontString(e.footerFontSize,e._footerFontStyle,e._footerFontFamily),ut.each(n,function(n){i.fillText(n,t.x,t.y),t.y+=e.footerFontSize+e.footerSpacing}))},drawBackground:function(t,e,i,n){i.fillStyle=e.backgroundColor,i.strokeStyle=e.borderColor,i.lineWidth=e.borderWidth;var a=e.xAlign,o=e.yAlign,r=t.x,s=t.y,l=n.width,d=n.height,u=e.cornerRadius;i.beginPath(),i.moveTo(r+u,s),"top"===o&&this.drawCaret(t,n),i.lineTo(r+l-u,s),i.quadraticCurveTo(r+l,s,r+l,s+u),"center"===o&&"right"===a&&this.drawCaret(t,n),i.lineTo(r+l,s+d-u),i.quadraticCurveTo(r+l,s+d,r+l-u,s+d),"bottom"===o&&this.drawCaret(t,n),i.lineTo(r+u,s+d),i.quadraticCurveTo(r,s+d,r,s+d-u),"center"===o&&"left"===a&&this.drawCaret(t,n),i.lineTo(r,s+u),i.quadraticCurveTo(r,s,r+u,s),i.closePath(),i.fill(),e.borderWidth>0&&i.stroke()},draw:function(){var t=this._chart.ctx,e=this._view;if(0!==e.opacity){var i={width:e.width,height:e.height},n={x:e.x,y:e.y},a=Math.abs(e.opacity<.001)?0:e.opacity,o=e.title.length||e.beforeBody.length||e.body.length||e.afterBody.length||e.footer.length;this._options.enabled&&o&&(t.save(),t.globalAlpha=a,this.drawBackground(n,e,t,i),n.y+=e.yPadding,this.drawTitle(n,e,t),this.drawBody(n,e,t),this.drawFooter(n,e,t),t.restore())}},handleEvent:function(t){var e,i=this,n=i._options;return i._lastActive=i._lastActive||[],"mouseout"===t.type?i._active=[]:i._active=i._chart.getElementsAtEventForMode(t,n.mode,n),(e=!ut.arrayEquals(i._active,i._lastActive))&&(i._lastActive=i._active,(n.enabled||n.custom)&&(i._eventPosition={x:t.x,y:t.y},i.update(!0),i.pivot())),e}}),$e=qe,Je=Ze;Je.positioners=$e;var Qe=ut.valueOrDefault;function ti(){return ut.merge({},[].slice.call(arguments),{merger:function(t,e,i,n){if("xAxes"===t||"yAxes"===t){var a,o,r,s=i[t].length;for(e[t]||(e[t]=[]),a=0;a<s;++a)r=i[t][a],o=Qe(r.type,"xAxes"===t?"category":"linear"),a>=e[t].length&&e[t].push({}),!e[t][a].type||r.type&&r.type!==e[t][a].type?ut.merge(e[t][a],[He.getScaleDefaults(o),r]):ut.merge(e[t][a],r)}else ut._merger(t,e,i,n)}})}function ei(){return ut.merge({},[].slice.call(arguments),{merger:function(t,e,i,n){var a=e[t]||{},o=i[t];"scales"===t?e[t]=ti(a,o):"scale"===t?e[t]=ut.merge(a,[He.getScaleDefaults(o.type),o]):ut._merger(t,e,i,n)}})}function ii(t){return"top"===t||"bottom"===t}st._set("global",{elements:{},events:["mousemove","mouseout","click","touchstart","touchmove"],hover:{onHover:null,mode:"nearest",intersect:!0,animationDuration:400},onClick:null,maintainAspectRatio:!0,responsive:!0,responsiveAnimationDuration:0});var ni=function(t,e){return this.construct(t,e),this};ut.extend(ni.prototype,{construct:function(t,e){var i=this;e=function(t){var e=(t=t||{}).data=t.data||{};return e.datasets=e.datasets||[],e.labels=e.labels||[],t.options=ei(st.global,st[t.type],t.options||{}),t}(e);var n=Ve.acquireContext(t,e),a=n&&n.canvas,o=a&&a.height,r=a&&a.width;i.id=ut.uid(),i.ctx=n,i.canvas=a,i.config=e,i.width=r,i.height=o,i.aspectRatio=o?r/o:null,i.options=e.options,i._bufferedRender=!1,i.chart=i,i.controller=i,ni.instances[i.id]=i,Object.defineProperty(i,"data",{get:function(){return i.config.data},set:function(t){i.config.data=t}}),n&&a?(i.initialize(),i.update()):console.error("Failed to create chart: can't acquire context from the given item")},initialize:function(){var t=this;return Ee.notify(t,"beforeInit"),ut.retinaScale(t,t.options.devicePixelRatio),t.bindEvents(),t.options.responsive&&t.resize(!0),t.ensureScalesHaveIDs(),t.buildOrUpdateScales(),t.initToolTip(),Ee.notify(t,"afterInit"),t},clear:function(){return ut.canvas.clear(this),this},stop:function(){return bt.cancelAnimation(this),this},resize:function(t){var e=this,i=e.options,n=e.canvas,a=i.maintainAspectRatio&&e.aspectRatio||null,o=Math.max(0,Math.floor(ut.getMaximumWidth(n))),r=Math.max(0,Math.floor(a?o/a:ut.getMaximumHeight(n)));if((e.width!==o||e.height!==r)&&(n.width=e.width=o,n.height=e.height=r,n.style.width=o+"px",n.style.height=r+"px",ut.retinaScale(e,i.devicePixelRatio),!t)){var s={width:o,height:r};Ee.notify(e,"resize",[s]),i.onResize&&i.onResize(e,s),e.stop(),e.update({duration:i.responsiveAnimationDuration})}},ensureScalesHaveIDs:function(){var t=this.options,e=t.scales||{},i=t.scale;ut.each(e.xAxes,function(t,e){t.id=t.id||"x-axis-"+e}),ut.each(e.yAxes,function(t,e){t.id=t.id||"y-axis-"+e}),i&&(i.id=i.id||"scale")},buildOrUpdateScales:function(){var t=this,e=t.options,i=t.scales||{},n=[],a=Object.keys(i).reduce(function(t,e){return t[e]=!1,t},{});e.scales&&(n=n.concat((e.scales.xAxes||[]).map(function(t){return{options:t,dtype:"category",dposition:"bottom"}}),(e.scales.yAxes||[]).map(function(t){return{options:t,dtype:"linear",dposition:"left"}}))),e.scale&&n.push({options:e.scale,dtype:"radialLinear",isDefault:!0,dposition:"chartArea"}),ut.each(n,function(e){var n=e.options,o=n.id,r=Qe(n.type,e.dtype);ii(n.position)!==ii(e.dposition)&&(n.position=e.dposition),a[o]=!0;var s=null;if(o in i&&i[o].type===r)(s=i[o]).options=n,s.ctx=t.ctx,s.chart=t;else{var l=He.getScaleConstructor(r);if(!l)return;s=new l({id:o,type:r,options:n,ctx:t.ctx,chart:t}),i[s.id]=s}s.mergeTicksOptions(),e.isDefault&&(t.scale=s)}),ut.each(a,function(t,e){t||delete i[e]}),t.scales=i,He.addScalesToLayout(this)},buildOrUpdateControllers:function(){var t=this,e=[];return ut.each(t.data.datasets,function(i,n){var a=t.getDatasetMeta(n),o=i.type||t.config.type;if(a.type&&a.type!==o&&(t.destroyDatasetMeta(n),a=t.getDatasetMeta(n)),a.type=o,a.controller)a.controller.updateIndex(n),a.controller.linkScales();else{var r=ue[a.type];if(void 0===r)throw new Error('"'+a.type+'" is not a chart type.');a.controller=new r(t,n),e.push(a.controller)}},t),e},resetElements:function(){var t=this;ut.each(t.data.datasets,function(e,i){t.getDatasetMeta(i).controller.reset()},t)},reset:function(){this.resetElements(),this.tooltip.initialize()},update:function(t){var e,i,n=this;if(t&&"object"==typeof t||(t={duration:t,lazy:arguments[1]}),i=(e=n).options,ut.each(e.scales,function(t){ke.removeBox(e,t)}),i=ei(st.global,st[e.config.type],i),e.options=e.config.options=i,e.ensureScalesHaveIDs(),e.buildOrUpdateScales(),e.tooltip._options=i.tooltips,e.tooltip.initialize(),Ee._invalidate(n),!1!==Ee.notify(n,"beforeUpdate")){n.tooltip._data=n.data;var a=n.buildOrUpdateControllers();ut.each(n.data.datasets,function(t,e){n.getDatasetMeta(e).controller.buildOrUpdateElements()},n),n.updateLayout(),n.options.animation&&n.options.animation.duration&&ut.each(a,function(t){t.reset()}),n.updateDatasets(),n.tooltip.initialize(),n.lastActive=[],Ee.notify(n,"afterUpdate"),n._bufferedRender?n._bufferedRequest={duration:t.duration,easing:t.easing,lazy:t.lazy}:n.render(t)}},updateLayout:function(){!1!==Ee.notify(this,"beforeLayout")&&(ke.update(this,this.width,this.height),Ee.notify(this,"afterScaleUpdate"),Ee.notify(this,"afterLayout"))},updateDatasets:function(){if(!1!==Ee.notify(this,"beforeDatasetsUpdate")){for(var t=0,e=this.data.datasets.length;t<e;++t)this.updateDataset(t);Ee.notify(this,"afterDatasetsUpdate")}},updateDataset:function(t){var e=this.getDatasetMeta(t),i={meta:e,index:t};!1!==Ee.notify(this,"beforeDatasetUpdate",[i])&&(e.controller.update(),Ee.notify(this,"afterDatasetUpdate",[i]))},render:function(t){var e=this;t&&"object"==typeof t||(t={duration:t,lazy:arguments[1]});var i=e.options.animation,n=Qe(t.duration,i&&i.duration),a=t.lazy;if(!1!==Ee.notify(e,"beforeRender")){var o=function(t){Ee.notify(e,"afterRender"),ut.callback(i&&i.onComplete,[t],e)};if(i&&n){var r=new vt({numSteps:n/16.66,easing:t.easing||i.easing,render:function(t,e){var i=ut.easing.effects[e.easing],n=e.currentStep,a=n/e.numSteps;t.draw(i(a),a,n)},onAnimationProgress:i.onProgress,onAnimationComplete:o});bt.addAnimation(e,r,n,a)}else e.draw(),o(new vt({numSteps:0,chart:e}));return e}},draw:function(t){var e=this;e.clear(),ut.isNullOrUndef(t)&&(t=1),e.transition(t),e.width<=0||e.height<=0||!1!==Ee.notify(e,"beforeDraw",[t])&&(ut.each(e.boxes,function(t){t.draw(e.chartArea)},e),e.drawDatasets(t),e._drawTooltip(t),Ee.notify(e,"afterDraw",[t]))},transition:function(t){for(var e=0,i=(this.data.datasets||[]).length;e<i;++e)this.isDatasetVisible(e)&&this.getDatasetMeta(e).controller.transition(t);this.tooltip.transition(t)},drawDatasets:function(t){var e=this;if(!1!==Ee.notify(e,"beforeDatasetsDraw",[t])){for(var i=(e.data.datasets||[]).length-1;i>=0;--i)e.isDatasetVisible(i)&&e.drawDataset(i,t);Ee.notify(e,"afterDatasetsDraw",[t])}},drawDataset:function(t,e){var i=this.getDatasetMeta(t),n={meta:i,index:t,easingValue:e};!1!==Ee.notify(this,"beforeDatasetDraw",[n])&&(i.controller.draw(e),Ee.notify(this,"afterDatasetDraw",[n]))},_drawTooltip:function(t){var e=this.tooltip,i={tooltip:e,easingValue:t};!1!==Ee.notify(this,"beforeTooltipDraw",[i])&&(e.draw(),Ee.notify(this,"afterTooltipDraw",[i]))},getElementAtEvent:function(t){return ve.modes.single(this,t)},getElementsAtEvent:function(t){return ve.modes.label(this,t,{intersect:!0})},getElementsAtXAxis:function(t){return ve.modes["x-axis"](this,t,{intersect:!0})},getElementsAtEventForMode:function(t,e,i){var n=ve.modes[e];return"function"==typeof n?n(this,t,i):[]},getDatasetAtEvent:function(t){return ve.modes.dataset(this,t,{intersect:!0})},getDatasetMeta:function(t){var e=this.data.datasets[t];e._meta||(e._meta={});var i=e._meta[this.id];return i||(i=e._meta[this.id]={type:null,data:[],dataset:null,controller:null,hidden:null,xAxisID:null,yAxisID:null}),i},getVisibleDatasetCount:function(){for(var t=0,e=0,i=this.data.datasets.length;e<i;++e)this.isDatasetVisible(e)&&t++;return t},isDatasetVisible:function(t){var e=this.getDatasetMeta(t);return"boolean"==typeof e.hidden?!e.hidden:!this.data.datasets[t].hidden},generateLegend:function(){return this.options.legendCallback(this)},destroyDatasetMeta:function(t){var e=this.id,i=this.data.datasets[t],n=i._meta&&i._meta[e];n&&(n.controller.destroy(),delete i._meta[e])},destroy:function(){var t,e,i=this,n=i.canvas;for(i.stop(),t=0,e=i.data.datasets.length;t<e;++t)i.destroyDatasetMeta(t);n&&(i.unbindEvents(),ut.canvas.clear(i),Ve.releaseContext(i.ctx),i.canvas=null,i.ctx=null),Ee.notify(i,"destroy"),delete ni.instances[i.id]},toBase64Image:function(){return this.canvas.toDataURL.apply(this.canvas,arguments)},initToolTip:function(){var t=this;t.tooltip=new Je({_chart:t,_chartInstance:t,_data:t.data,_options:t.options.tooltips},t)},bindEvents:function(){var t=this,e=t._listeners={},i=function(){t.eventHandler.apply(t,arguments)};ut.each(t.options.events,function(n){Ve.addEventListener(t,n,i),e[n]=i}),t.options.responsive&&(i=function(){t.resize()},Ve.addEventListener(t,"resize",i),e.resize=i)},unbindEvents:function(){var t=this,e=t._listeners;e&&(delete t._listeners,ut.each(e,function(e,i){Ve.removeEventListener(t,i,e)}))},updateHoverStyle:function(t,e,i){var n,a,o,r=i?"setHoverStyle":"removeHoverStyle";for(a=0,o=t.length;a<o;++a)(n=t[a])&&this.getDatasetMeta(n._datasetIndex).controller[r](n)},eventHandler:function(t){var e=this,i=e.tooltip;if(!1!==Ee.notify(e,"beforeEvent",[t])){e._bufferedRender=!0,e._bufferedRequest=null;var n=e.handleEvent(t);i&&(n=i._start?i.handleEvent(t):n|i.handleEvent(t)),Ee.notify(e,"afterEvent",[t]);var a=e._bufferedRequest;return a?e.render(a):n&&!e.animating&&(e.stop(),e.render({duration:e.options.hover.animationDuration,lazy:!0})),e._bufferedRender=!1,e._bufferedRequest=null,e}},handleEvent:function(t){var e,i=this,n=i.options||{},a=n.hover;return i.lastActive=i.lastActive||[],"mouseout"===t.type?i.active=[]:i.active=i.getElementsAtEventForMode(t,a.mode,a),ut.callback(n.onHover||n.hover.onHover,[t.native,i.active],i),"mouseup"!==t.type&&"click"!==t.type||n.onClick&&n.onClick.call(i,t.native,i.active),i.lastActive.length&&i.updateHoverStyle(i.lastActive,a.mode,!1),i.active.length&&a.mode&&i.updateHoverStyle(i.active,a.mode,!0),e=!ut.arrayEquals(i.active,i.lastActive),i.lastActive=i.active,e}}),ni.instances={};var ai=ni;ni.Controller=ni,ni.types={},ut.configMerge=ei,ut.scaleMerge=ti;function oi(){throw new Error("This method is not implemented: either no adapter can be found or an incomplete integration was provided.")}function ri(t){this.options=t||{}}ut.extend(ri.prototype,{formats:oi,parse:oi,format:oi,add:oi,diff:oi,startOf:oi,endOf:oi,_create:function(t){return t}}),ri.override=function(t){ut.extend(ri.prototype,t)};var si={_date:ri},li={formatters:{values:function(t){return ut.isArray(t)?t:""+t},linear:function(t,e,i){var n=i.length>3?i[2]-i[1]:i[1]-i[0];Math.abs(n)>1&&t!==Math.floor(t)&&(n=t-Math.floor(t));var a=ut.log10(Math.abs(n)),o="";if(0!==t)if(Math.max(Math.abs(i[0]),Math.abs(i[i.length-1]))<1e-4){var r=ut.log10(Math.abs(t));o=t.toExponential(Math.floor(r)-Math.floor(a))}else{var s=-1*Math.floor(a);s=Math.max(Math.min(s,20),0),o=t.toFixed(s)}else o="0";return o},logarithmic:function(t,e,i){var n=t/Math.pow(10,Math.floor(ut.log10(t)));return 0===t?"0":1===n||2===n||5===n||0===e||e===i.length-1?t.toExponential():""}}},di=ut.valueOrDefault,ui=ut.valueAtIndexOrDefault;function hi(t){var e,i,n=[];for(e=0,i=t.length;e<i;++e)n.push(t[e].label);return n}function ci(t,e,i){return ut.isArray(e)?ut.longestText(t,i,e):t.measureText(e).width}st._set("scale",{display:!0,position:"left",offset:!1,gridLines:{display:!0,color:"rgba(0, 0, 0, 0.1)",lineWidth:1,drawBorder:!0,drawOnChartArea:!0,drawTicks:!0,tickMarkLength:10,zeroLineWidth:1,zeroLineColor:"rgba(0,0,0,0.25)",zeroLineBorderDash:[],zeroLineBorderDashOffset:0,offsetGridLines:!1,borderDash:[],borderDashOffset:0},scaleLabel:{display:!1,labelString:"",padding:{top:4,bottom:4}},ticks:{beginAtZero:!1,minRotation:0,maxRotation:50,mirror:!1,padding:0,reverse:!1,display:!0,autoSkip:!0,autoSkipPadding:0,labelOffset:0,callback:li.formatters.values,minor:{},major:{}}});var fi=pt.extend({getPadding:function(){return{left:this.paddingLeft||0,top:this.paddingTop||0,right:this.paddingRight||0,bottom:this.paddingBottom||0}},getTicks:function(){return this._ticks},mergeTicksOptions:function(){var t=this.options.ticks;for(var e in!1===t.minor&&(t.minor={display:!1}),!1===t.major&&(t.major={display:!1}),t)"major"!==e&&"minor"!==e&&(void 0===t.minor[e]&&(t.minor[e]=t[e]),void 0===t.major[e]&&(t.major[e]=t[e]))},beforeUpdate:function(){ut.callback(this.options.beforeUpdate,[this])},update:function(t,e,i){var n,a,o,r,s,l,d=this;for(d.beforeUpdate(),d.maxWidth=t,d.maxHeight=e,d.margins=ut.extend({left:0,right:0,top:0,bottom:0},i),d._maxLabelLines=0,d.longestLabelWidth=0,d.longestTextCache=d.longestTextCache||{},d.beforeSetDimensions(),d.setDimensions(),d.afterSetDimensions(),d.beforeDataLimits(),d.determineDataLimits(),d.afterDataLimits(),d.beforeBuildTicks(),s=d.buildTicks()||[],s=d.afterBuildTicks(s)||s,d.beforeTickToLabelConversion(),o=d.convertTicksToLabels(s)||d.ticks,d.afterTickToLabelConversion(),d.ticks=o,n=0,a=o.length;n<a;++n)r=o[n],(l=s[n])?l.label=r:s.push(l={label:r,major:!1});return d._ticks=s,d.beforeCalculateTickRotation(),d.calculateTickRotation(),d.afterCalculateTickRotation(),d.beforeFit(),d.fit(),d.afterFit(),d.afterUpdate(),d.minSize},afterUpdate:function(){ut.callback(this.options.afterUpdate,[this])},beforeSetDimensions:function(){ut.callback(this.options.beforeSetDimensions,[this])},setDimensions:function(){var t=this;t.isHorizontal()?(t.width=t.maxWidth,t.left=0,t.right=t.width):(t.height=t.maxHeight,t.top=0,t.bottom=t.height),t.paddingLeft=0,t.paddingTop=0,t.paddingRight=0,t.paddingBottom=0},afterSetDimensions:function(){ut.callback(this.options.afterSetDimensions,[this])},beforeDataLimits:function(){ut.callback(this.options.beforeDataLimits,[this])},determineDataLimits:ut.noop,afterDataLimits:function(){ut.callback(this.options.afterDataLimits,[this])},beforeBuildTicks:function(){ut.callback(this.options.beforeBuildTicks,[this])},buildTicks:ut.noop,afterBuildTicks:function(t){var e=this;return ut.isArray(t)&&t.length?ut.callback(e.options.afterBuildTicks,[e,t]):(e.ticks=ut.callback(e.options.afterBuildTicks,[e,e.ticks])||e.ticks,t)},beforeTickToLabelConversion:function(){ut.callback(this.options.beforeTickToLabelConversion,[this])},convertTicksToLabels:function(){var t=this.options.ticks;this.ticks=this.ticks.map(t.userCallback||t.callback,this)},afterTickToLabelConversion:function(){ut.callback(this.options.afterTickToLabelConversion,[this])},beforeCalculateTickRotation:function(){ut.callback(this.options.beforeCalculateTickRotation,[this])},calculateTickRotation:function(){var t=this,e=t.ctx,i=t.options.ticks,n=hi(t._ticks),a=ut.options._parseFont(i);e.font=a.string;var o=i.minRotation||0;if(n.length&&t.options.display&&t.isHorizontal())for(var r,s=ut.longestText(e,a.string,n,t.longestTextCache),l=s,d=t.getPixelForTick(1)-t.getPixelForTick(0)-6;l>d&&o<i.maxRotation;){var u=ut.toRadians(o);if(r=Math.cos(u),Math.sin(u)*s>t.maxHeight){o--;break}o++,l=r*s}t.labelRotation=o},afterCalculateTickRotation:function(){ut.callback(this.options.afterCalculateTickRotation,[this])},beforeFit:function(){ut.callback(this.options.beforeFit,[this])},fit:function(){var t=this,e=t.minSize={width:0,height:0},i=hi(t._ticks),n=t.options,a=n.ticks,o=n.scaleLabel,r=n.gridLines,s=t._isVisible(),l=n.position,d=t.isHorizontal(),u=ut.options._parseFont,h=u(a),c=n.gridLines.tickMarkLength;if(e.width=d?t.isFullWidth()?t.maxWidth-t.margins.left-t.margins.right:t.maxWidth:s&&r.drawTicks?c:0,e.height=d?s&&r.drawTicks?c:0:t.maxHeight,o.display&&s){var f=u(o),g=ut.options.toPadding(o.padding),p=f.lineHeight+g.height;d?e.height+=p:e.width+=p}if(a.display&&s){var m=ut.longestText(t.ctx,h.string,i,t.longestTextCache),v=ut.numberOfLabelLines(i),b=.5*h.size,x=t.options.ticks.padding;if(t._maxLabelLines=v,t.longestLabelWidth=m,d){var y=ut.toRadians(t.labelRotation),k=Math.cos(y),w=Math.sin(y)*m+h.lineHeight*v+b;e.height=Math.min(t.maxHeight,e.height+w+x),t.ctx.font=h.string;var M,_,C=ci(t.ctx,i[0],h.string),S=ci(t.ctx,i[i.length-1],h.string),P=t.getPixelForTick(0)-t.left,I=t.right-t.getPixelForTick(i.length-1);0!==t.labelRotation?(M="bottom"===l?k*C:k*b,_="bottom"===l?k*b:k*S):(M=C/2,_=S/2),t.paddingLeft=Math.max(M-P,0)+3,t.paddingRight=Math.max(_-I,0)+3}else a.mirror?m=0:m+=x+b,e.width=Math.min(t.maxWidth,e.width+m),t.paddingTop=h.size/2,t.paddingBottom=h.size/2}t.handleMargins(),t.width=e.width,t.height=e.height},handleMargins:function(){var t=this;t.margins&&(t.paddingLeft=Math.max(t.paddingLeft-t.margins.left,0),t.paddingTop=Math.max(t.paddingTop-t.margins.top,0),t.paddingRight=Math.max(t.paddingRight-t.margins.right,0),t.paddingBottom=Math.max(t.paddingBottom-t.margins.bottom,0))},afterFit:function(){ut.callback(this.options.afterFit,[this])},isHorizontal:function(){return"top"===this.options.position||"bottom"===this.options.position},isFullWidth:function(){return this.options.fullWidth},getRightValue:function(t){if(ut.isNullOrUndef(t))return NaN;if(("number"==typeof t||t instanceof Number)&&!isFinite(t))return NaN;if(t)if(this.isHorizontal()){if(void 0!==t.x)return this.getRightValue(t.x)}else if(void 0!==t.y)return this.getRightValue(t.y);return t},getLabelForIndex:ut.noop,getPixelForValue:ut.noop,getValueForPixel:ut.noop,getPixelForTick:function(t){var e=this,i=e.options.offset;if(e.isHorizontal()){var n=(e.width-(e.paddingLeft+e.paddingRight))/Math.max(e._ticks.length-(i?0:1),1),a=n*t+e.paddingLeft;i&&(a+=n/2);var o=e.left+a;return o+=e.isFullWidth()?e.margins.left:0}var r=e.height-(e.paddingTop+e.paddingBottom);return e.top+t*(r/(e._ticks.length-1))},getPixelForDecimal:function(t){var e=this;if(e.isHorizontal()){var i=(e.width-(e.paddingLeft+e.paddingRight))*t+e.paddingLeft,n=e.left+i;return n+=e.isFullWidth()?e.margins.left:0}return e.top+t*e.height},getBasePixel:function(){return this.getPixelForValue(this.getBaseValue())},getBaseValue:function(){var t=this.min,e=this.max;return this.beginAtZero?0:t<0&&e<0?e:t>0&&e>0?t:0},_autoSkip:function(t){var e,i,n=this,a=n.isHorizontal(),o=n.options.ticks.minor,r=t.length,s=!1,l=o.maxTicksLimit,d=n._tickSize()*(r-1),u=a?n.width-(n.paddingLeft+n.paddingRight):n.height-(n.paddingTop+n.PaddingBottom),h=[];for(d>u&&(s=1+Math.floor(d/u)),r>l&&(s=Math.max(s,1+Math.floor(r/l))),e=0;e<r;e++)i=t[e],s>1&&e%s>0&&delete i.label,h.push(i);return h},_tickSize:function(){var t=this,e=t.isHorizontal(),i=t.options.ticks.minor,n=ut.toRadians(t.labelRotation),a=Math.abs(Math.cos(n)),o=Math.abs(Math.sin(n)),r=i.autoSkipPadding||0,s=t.longestLabelWidth+r||0,l=ut.options._parseFont(i),d=t._maxLabelLines*l.lineHeight+r||0;return e?d*a>s*o?s/a:d/o:d*o<s*a?d/a:s/o},_isVisible:function(){var t,e,i,n=this.chart,a=this.options.display;if("auto"!==a)return!!a;for(t=0,e=n.data.datasets.length;t<e;++t)if(n.isDatasetVisible(t)&&((i=n.getDatasetMeta(t)).xAxisID===this.id||i.yAxisID===this.id))return!0;return!1},draw:function(t){var e=this,i=e.options;if(e._isVisible()){var n,a,o,r=e.chart,s=e.ctx,l=st.global.defaultFontColor,d=i.ticks.minor,u=i.ticks.major||d,h=i.gridLines,c=i.scaleLabel,f=i.position,g=0!==e.labelRotation,p=d.mirror,m=e.isHorizontal(),v=ut.options._parseFont,b=d.display&&d.autoSkip?e._autoSkip(e.getTicks()):e.getTicks(),x=di(d.fontColor,l),y=v(d),k=y.lineHeight,w=di(u.fontColor,l),M=v(u),_=d.padding,C=d.labelOffset,S=h.drawTicks?h.tickMarkLength:0,P=di(c.fontColor,l),I=v(c),A=ut.options.toPadding(c.padding),D=ut.toRadians(e.labelRotation),T=[],F=h.drawBorder?ui(h.lineWidth,0,0):0,L=ut._alignPixel;"top"===f?(n=L(r,e.bottom,F),a=e.bottom-S,o=n-F/2):"bottom"===f?(n=L(r,e.top,F),a=n+F/2,o=e.top+S):"left"===f?(n=L(r,e.right,F),a=e.right-S,o=n-F/2):(n=L(r,e.left,F),a=n+F/2,o=e.left+S);if(ut.each(b,function(n,s){if(!ut.isNullOrUndef(n.label)){var l,d,u,c,v,b,x,y,w,M,P,I,A,R,O,z,B=n.label;s===e.zeroLineIndex&&i.offset===h.offsetGridLines?(l=h.zeroLineWidth,d=h.zeroLineColor,u=h.zeroLineBorderDash||[],c=h.zeroLineBorderDashOffset||0):(l=ui(h.lineWidth,s),d=ui(h.color,s),u=h.borderDash||[],c=h.borderDashOffset||0);var N=ut.isArray(B)?B.length:1,W=function(t,e,i){var n=t.getPixelForTick(e);return i&&(1===t.getTicks().length?n-=t.isHorizontal()?Math.max(n-t.left,t.right-n):Math.max(n-t.top,t.bottom-n):n-=0===e?(t.getPixelForTick(1)-n)/2:(n-t.getPixelForTick(e-1))/2),n}(e,s,h.offsetGridLines);if(m){var V=S+_;W<e.left-1e-7&&(d="rgba(0,0,0,0)"),v=x=w=P=L(r,W,l),b=a,y=o,A=e.getPixelForTick(s)+C,"top"===f?(M=L(r,t.top,F)+F/2,I=t.bottom,O=((g?1:.5)-N)*k,z=g?"left":"center",R=e.bottom-V):(M=t.top,I=L(r,t.bottom,F)-F/2,O=(g?0:.5)*k,z=g?"right":"center",R=e.top+V)}else{var E=(p?0:S)+_;W<e.top-1e-7&&(d="rgba(0,0,0,0)"),v=a,x=o,b=y=M=I=L(r,W,l),R=e.getPixelForTick(s)+C,O=(1-N)*k/2,"left"===f?(w=L(r,t.left,F)+F/2,P=t.right,z=p?"left":"right",A=e.right-E):(w=t.left,P=L(r,t.right,F)-F/2,z=p?"right":"left",A=e.left+E)}T.push({tx1:v,ty1:b,tx2:x,ty2:y,x1:w,y1:M,x2:P,y2:I,labelX:A,labelY:R,glWidth:l,glColor:d,glBorderDash:u,glBorderDashOffset:c,rotation:-1*D,label:B,major:n.major,textOffset:O,textAlign:z})}}),ut.each(T,function(t){var e=t.glWidth,i=t.glColor;if(h.display&&e&&i&&(s.save(),s.lineWidth=e,s.strokeStyle=i,s.setLineDash&&(s.setLineDash(t.glBorderDash),s.lineDashOffset=t.glBorderDashOffset),s.beginPath(),h.drawTicks&&(s.moveTo(t.tx1,t.ty1),s.lineTo(t.tx2,t.ty2)),h.drawOnChartArea&&(s.moveTo(t.x1,t.y1),s.lineTo(t.x2,t.y2)),s.stroke(),s.restore()),d.display){s.save(),s.translate(t.labelX,t.labelY),s.rotate(t.rotation),s.font=t.major?M.string:y.string,s.fillStyle=t.major?w:x,s.textBaseline="middle",s.textAlign=t.textAlign;var n=t.label,a=t.textOffset;if(ut.isArray(n))for(var o=0;o<n.length;++o)s.fillText(""+n[o],0,a),a+=k;else s.fillText(n,0,a);s.restore()}}),c.display){var R,O,z=0,B=I.lineHeight/2;if(m)R=e.left+(e.right-e.left)/2,O="bottom"===f?e.bottom-B-A.bottom:e.top+B+A.top;else{var N="left"===f;R=N?e.left+B+A.top:e.right-B-A.top,O=e.top+(e.bottom-e.top)/2,z=N?-.5*Math.PI:.5*Math.PI}s.save(),s.translate(R,O),s.rotate(z),s.textAlign="center",s.textBaseline="middle",s.fillStyle=P,s.font=I.string,s.fillText(c.labelString,0,0),s.restore()}if(F){var W,V,E,H,j=F,q=ui(h.lineWidth,b.length-1,0);m?(W=L(r,e.left,j)-j/2,V=L(r,e.right,q)+q/2,E=H=n):(E=L(r,e.top,j)-j/2,H=L(r,e.bottom,q)+q/2,W=V=n),s.lineWidth=F,s.strokeStyle=ui(h.color,0),s.beginPath(),s.moveTo(W,E),s.lineTo(V,H),s.stroke()}}}}),gi=fi.extend({getLabels:function(){var t=this.chart.data;return this.options.labels||(this.isHorizontal()?t.xLabels:t.yLabels)||t.labels},determineDataLimits:function(){var t,e=this,i=e.getLabels();e.minIndex=0,e.maxIndex=i.length-1,void 0!==e.options.ticks.min&&(t=i.indexOf(e.options.ticks.min),e.minIndex=-1!==t?t:e.minIndex),void 0!==e.options.ticks.max&&(t=i.indexOf(e.options.ticks.max),e.maxIndex=-1!==t?t:e.maxIndex),e.min=i[e.minIndex],e.max=i[e.maxIndex]},buildTicks:function(){var t=this,e=t.getLabels();t.ticks=0===t.minIndex&&t.maxIndex===e.length-1?e:e.slice(t.minIndex,t.maxIndex+1)},getLabelForIndex:function(t,e){var i=this,n=i.chart;return n.getDatasetMeta(e).controller._getValueScaleId()===i.id?i.getRightValue(n.data.datasets[e].data[t]):i.ticks[t-i.minIndex]},getPixelForValue:function(t,e){var i,n=this,a=n.options.offset,o=Math.max(n.maxIndex+1-n.minIndex-(a?0:1),1);if(null!=t&&(i=n.isHorizontal()?t.x:t.y),void 0!==i||void 0!==t&&isNaN(e)){t=i||t;var r=n.getLabels().indexOf(t);e=-1!==r?r:e}if(n.isHorizontal()){var s=n.width/o,l=s*(e-n.minIndex);return a&&(l+=s/2),n.left+l}var d=n.height/o,u=d*(e-n.minIndex);return a&&(u+=d/2),n.top+u},getPixelForTick:function(t){return this.getPixelForValue(this.ticks[t],t+this.minIndex,null)},getValueForPixel:function(t){var e=this,i=e.options.offset,n=Math.max(e._ticks.length-(i?0:1),1),a=e.isHorizontal(),o=(a?e.width:e.height)/n;return t-=a?e.left:e.top,i&&(t-=o/2),(t<=0?0:Math.round(t/o))+e.minIndex},getBasePixel:function(){return this.bottom}}),pi={position:"bottom"};gi._defaults=pi;var mi=ut.noop,vi=ut.isNullOrUndef;var bi=fi.extend({getRightValue:function(t){return"string"==typeof t?+t:fi.prototype.getRightValue.call(this,t)},handleTickRangeOptions:function(){var t=this,e=t.options.ticks;if(e.beginAtZero){var i=ut.sign(t.min),n=ut.sign(t.max);i<0&&n<0?t.max=0:i>0&&n>0&&(t.min=0)}var a=void 0!==e.min||void 0!==e.suggestedMin,o=void 0!==e.max||void 0!==e.suggestedMax;void 0!==e.min?t.min=e.min:void 0!==e.suggestedMin&&(null===t.min?t.min=e.suggestedMin:t.min=Math.min(t.min,e.suggestedMin)),void 0!==e.max?t.max=e.max:void 0!==e.suggestedMax&&(null===t.max?t.max=e.suggestedMax:t.max=Math.max(t.max,e.suggestedMax)),a!==o&&t.min>=t.max&&(a?t.max=t.min+1:t.min=t.max-1),t.min===t.max&&(t.max++,e.beginAtZero||t.min--)},getTickLimit:function(){var t,e=this.options.ticks,i=e.stepSize,n=e.maxTicksLimit;return i?t=Math.ceil(this.max/i)-Math.floor(this.min/i)+1:(t=this._computeTickLimit(),n=n||11),n&&(t=Math.min(n,t)),t},_computeTickLimit:function(){return Number.POSITIVE_INFINITY},handleDirectionalChanges:mi,buildTicks:function(){var t=this,e=t.options.ticks,i=t.getTickLimit(),n={maxTicks:i=Math.max(2,i),min:e.min,max:e.max,precision:e.precision,stepSize:ut.valueOrDefault(e.fixedStepSize,e.stepSize)},a=t.ticks=function(t,e){var i,n,a,o,r=[],s=t.stepSize,l=s||1,d=t.maxTicks-1,u=t.min,h=t.max,c=t.precision,f=e.min,g=e.max,p=ut.niceNum((g-f)/d/l)*l;if(p<1e-14&&vi(u)&&vi(h))return[f,g];(o=Math.ceil(g/p)-Math.floor(f/p))>d&&(p=ut.niceNum(o*p/d/l)*l),s||vi(c)?i=Math.pow(10,ut._decimalPlaces(p)):(i=Math.pow(10,c),p=Math.ceil(p*i)/i),n=Math.floor(f/p)*p,a=Math.ceil(g/p)*p,s&&(!vi(u)&&ut.almostWhole(u/p,p/1e3)&&(n=u),!vi(h)&&ut.almostWhole(h/p,p/1e3)&&(a=h)),o=(a-n)/p,o=ut.almostEquals(o,Math.round(o),p/1e3)?Math.round(o):Math.ceil(o),n=Math.round(n*i)/i,a=Math.round(a*i)/i,r.push(vi(u)?n:u);for(var m=1;m<o;++m)r.push(Math.round((n+m*p)*i)/i);return r.push(vi(h)?a:h),r}(n,t);t.handleDirectionalChanges(),t.max=ut.max(a),t.min=ut.min(a),e.reverse?(a.reverse(),t.start=t.max,t.end=t.min):(t.start=t.min,t.end=t.max)},convertTicksToLabels:function(){var t=this;t.ticksAsNumbers=t.ticks.slice(),t.zeroLineIndex=t.ticks.indexOf(0),fi.prototype.convertTicksToLabels.call(t)}}),xi={position:"left",ticks:{callback:li.formatters.linear}},yi=bi.extend({determineDataLimits:function(){var t=this,e=t.options,i=t.chart,n=i.data.datasets,a=t.isHorizontal();function o(e){return a?e.xAxisID===t.id:e.yAxisID===t.id}t.min=null,t.max=null;var r=e.stacked;if(void 0===r&&ut.each(n,function(t,e){if(!r){var n=i.getDatasetMeta(e);i.isDatasetVisible(e)&&o(n)&&void 0!==n.stack&&(r=!0)}}),e.stacked||r){var s={};ut.each(n,function(n,a){var r=i.getDatasetMeta(a),l=[r.type,void 0===e.stacked&&void 0===r.stack?a:"",r.stack].join(".");void 0===s[l]&&(s[l]={positiveValues:[],negativeValues:[]});var d=s[l].positiveValues,u=s[l].negativeValues;i.isDatasetVisible(a)&&o(r)&&ut.each(n.data,function(i,n){var a=+t.getRightValue(i);isNaN(a)||r.data[n].hidden||(d[n]=d[n]||0,u[n]=u[n]||0,e.relativePoints?d[n]=100:a<0?u[n]+=a:d[n]+=a)})}),ut.each(s,function(e){var i=e.positiveValues.concat(e.negativeValues),n=ut.min(i),a=ut.max(i);t.min=null===t.min?n:Math.min(t.min,n),t.max=null===t.max?a:Math.max(t.max,a)})}else ut.each(n,function(e,n){var a=i.getDatasetMeta(n);i.isDatasetVisible(n)&&o(a)&&ut.each(e.data,function(e,i){var n=+t.getRightValue(e);isNaN(n)||a.data[i].hidden||(null===t.min?t.min=n:n<t.min&&(t.min=n),null===t.max?t.max=n:n>t.max&&(t.max=n))})});t.min=isFinite(t.min)&&!isNaN(t.min)?t.min:0,t.max=isFinite(t.max)&&!isNaN(t.max)?t.max:1,this.handleTickRangeOptions()},_computeTickLimit:function(){var t;return this.isHorizontal()?Math.ceil(this.width/40):(t=ut.options._parseFont(this.options.ticks),Math.ceil(this.height/t.lineHeight))},handleDirectionalChanges:function(){this.isHorizontal()||this.ticks.reverse()},getLabelForIndex:function(t,e){return+this.getRightValue(this.chart.data.datasets[e].data[t])},getPixelForValue:function(t){var e=this,i=e.start,n=+e.getRightValue(t),a=e.end-i;return e.isHorizontal()?e.left+e.width/a*(n-i):e.bottom-e.height/a*(n-i)},getValueForPixel:function(t){var e=this,i=e.isHorizontal(),n=i?e.width:e.height,a=(i?t-e.left:e.bottom-t)/n;return e.start+(e.end-e.start)*a},getPixelForTick:function(t){return this.getPixelForValue(this.ticksAsNumbers[t])}}),ki=xi;yi._defaults=ki;var wi=ut.valueOrDefault;var Mi={position:"left",ticks:{callback:li.formatters.logarithmic}};function _i(t,e){return ut.isFinite(t)&&t>=0?t:e}var Ci=fi.extend({determineDataLimits:function(){var t=this,e=t.options,i=t.chart,n=i.data.datasets,a=t.isHorizontal();function o(e){return a?e.xAxisID===t.id:e.yAxisID===t.id}t.min=null,t.max=null,t.minNotZero=null;var r=e.stacked;if(void 0===r&&ut.each(n,function(t,e){if(!r){var n=i.getDatasetMeta(e);i.isDatasetVisible(e)&&o(n)&&void 0!==n.stack&&(r=!0)}}),e.stacked||r){var s={};ut.each(n,function(n,a){var r=i.getDatasetMeta(a),l=[r.type,void 0===e.stacked&&void 0===r.stack?a:"",r.stack].join(".");i.isDatasetVisible(a)&&o(r)&&(void 0===s[l]&&(s[l]=[]),ut.each(n.data,function(e,i){var n=s[l],a=+t.getRightValue(e);isNaN(a)||r.data[i].hidden||a<0||(n[i]=n[i]||0,n[i]+=a)}))}),ut.each(s,function(e){if(e.length>0){var i=ut.min(e),n=ut.max(e);t.min=null===t.min?i:Math.min(t.min,i),t.max=null===t.max?n:Math.max(t.max,n)}})}else ut.each(n,function(e,n){var a=i.getDatasetMeta(n);i.isDatasetVisible(n)&&o(a)&&ut.each(e.data,function(e,i){var n=+t.getRightValue(e);isNaN(n)||a.data[i].hidden||n<0||(null===t.min?t.min=n:n<t.min&&(t.min=n),null===t.max?t.max=n:n>t.max&&(t.max=n),0!==n&&(null===t.minNotZero||n<t.minNotZero)&&(t.minNotZero=n))})});this.handleTickRangeOptions()},handleTickRangeOptions:function(){var t=this,e=t.options.ticks;t.min=_i(e.min,t.min),t.max=_i(e.max,t.max),t.min===t.max&&(0!==t.min&&null!==t.min?(t.min=Math.pow(10,Math.floor(ut.log10(t.min))-1),t.max=Math.pow(10,Math.floor(ut.log10(t.max))+1)):(t.min=1,t.max=10)),null===t.min&&(t.min=Math.pow(10,Math.floor(ut.log10(t.max))-1)),null===t.max&&(t.max=0!==t.min?Math.pow(10,Math.floor(ut.log10(t.min))+1):10),null===t.minNotZero&&(t.min>0?t.minNotZero=t.min:t.max<1?t.minNotZero=Math.pow(10,Math.floor(ut.log10(t.max))):t.minNotZero=1)},buildTicks:function(){var t=this,e=t.options.ticks,i=!t.isHorizontal(),n={min:_i(e.min),max:_i(e.max)},a=t.ticks=function(t,e){var i,n,a=[],o=wi(t.min,Math.pow(10,Math.floor(ut.log10(e.min)))),r=Math.floor(ut.log10(e.max)),s=Math.ceil(e.max/Math.pow(10,r));0===o?(i=Math.floor(ut.log10(e.minNotZero)),n=Math.floor(e.minNotZero/Math.pow(10,i)),a.push(o),o=n*Math.pow(10,i)):(i=Math.floor(ut.log10(o)),n=Math.floor(o/Math.pow(10,i)));var l=i<0?Math.pow(10,Math.abs(i)):1;do{a.push(o),10==++n&&(n=1,l=++i>=0?1:l),o=Math.round(n*Math.pow(10,i)*l)/l}while(i<r||i===r&&n<s);var d=wi(t.max,o);return a.push(d),a}(n,t);t.max=ut.max(a),t.min=ut.min(a),e.reverse?(i=!i,t.start=t.max,t.end=t.min):(t.start=t.min,t.end=t.max),i&&a.reverse()},convertTicksToLabels:function(){this.tickValues=this.ticks.slice(),fi.prototype.convertTicksToLabels.call(this)},getLabelForIndex:function(t,e){return+this.getRightValue(this.chart.data.datasets[e].data[t])},getPixelForTick:function(t){return this.getPixelForValue(this.tickValues[t])},_getFirstTickValue:function(t){var e=Math.floor(ut.log10(t));return Math.floor(t/Math.pow(10,e))*Math.pow(10,e)},getPixelForValue:function(t){var e,i,n,a,o,r=this,s=r.options.ticks,l=s.reverse,d=ut.log10,u=r._getFirstTickValue(r.minNotZero),h=0;return t=+r.getRightValue(t),l?(n=r.end,a=r.start,o=-1):(n=r.start,a=r.end,o=1),r.isHorizontal()?(e=r.width,i=l?r.right:r.left):(e=r.height,o*=-1,i=l?r.top:r.bottom),t!==n&&(0===n&&(e-=h=wi(s.fontSize,st.global.defaultFontSize),n=u),0!==t&&(h+=e/(d(a)-d(n))*(d(t)-d(n))),i+=o*h),i},getValueForPixel:function(t){var e,i,n,a,o=this,r=o.options.ticks,s=r.reverse,l=ut.log10,d=o._getFirstTickValue(o.minNotZero);if(s?(i=o.end,n=o.start):(i=o.start,n=o.end),o.isHorizontal()?(e=o.width,a=s?o.right-t:t-o.left):(e=o.height,a=s?t-o.top:o.bottom-t),a!==i){if(0===i){var u=wi(r.fontSize,st.global.defaultFontSize);a-=u,e-=u,i=d}a*=l(n)-l(i),a/=e,a=Math.pow(10,l(i)+a)}return a}}),Si=Mi;Ci._defaults=Si;var Pi=ut.valueOrDefault,Ii=ut.valueAtIndexOrDefault,Ai=ut.options.resolve,Di={display:!0,animate:!0,position:"chartArea",angleLines:{display:!0,color:"rgba(0, 0, 0, 0.1)",lineWidth:1,borderDash:[],borderDashOffset:0},gridLines:{circular:!1},ticks:{showLabelBackdrop:!0,backdropColor:"rgba(255,255,255,0.75)",backdropPaddingY:2,backdropPaddingX:2,callback:li.formatters.linear},pointLabels:{display:!0,fontSize:10,callback:function(t){return t}}};function Ti(t){var e=t.options;return e.angleLines.display||e.pointLabels.display?t.chart.data.labels.length:0}function Fi(t){var e=t.ticks;return e.display&&t.display?Pi(e.fontSize,st.global.defaultFontSize)+2*e.backdropPaddingY:0}function Li(t,e,i,n,a){return t===n||t===a?{start:e-i/2,end:e+i/2}:t<n||t>a?{start:e-i,end:e}:{start:e,end:e+i}}function Ri(t){return 0===t||180===t?"center":t<180?"left":"right"}function Oi(t,e,i,n){var a,o,r=i.y+n/2;if(ut.isArray(e))for(a=0,o=e.length;a<o;++a)t.fillText(e[a],i.x,r),r+=n;else t.fillText(e,i.x,r)}function zi(t,e,i){90===t||270===t?i.y-=e.h/2:(t>270||t<90)&&(i.y-=e.h)}function Bi(t){return ut.isNumber(t)?t:0}var Ni=bi.extend({setDimensions:function(){var t=this;t.width=t.maxWidth,t.height=t.maxHeight,t.paddingTop=Fi(t.options)/2,t.xCenter=Math.floor(t.width/2),t.yCenter=Math.floor((t.height-t.paddingTop)/2),t.drawingArea=Math.min(t.height-t.paddingTop,t.width)/2},determineDataLimits:function(){var t=this,e=t.chart,i=Number.POSITIVE_INFINITY,n=Number.NEGATIVE_INFINITY;ut.each(e.data.datasets,function(a,o){if(e.isDatasetVisible(o)){var r=e.getDatasetMeta(o);ut.each(a.data,function(e,a){var o=+t.getRightValue(e);isNaN(o)||r.data[a].hidden||(i=Math.min(o,i),n=Math.max(o,n))})}}),t.min=i===Number.POSITIVE_INFINITY?0:i,t.max=n===Number.NEGATIVE_INFINITY?0:n,t.handleTickRangeOptions()},_computeTickLimit:function(){return Math.ceil(this.drawingArea/Fi(this.options))},convertTicksToLabels:function(){var t=this;bi.prototype.convertTicksToLabels.call(t),t.pointLabels=t.chart.data.labels.map(t.options.pointLabels.callback,t)},getLabelForIndex:function(t,e){return+this.getRightValue(this.chart.data.datasets[e].data[t])},fit:function(){var t=this.options;t.display&&t.pointLabels.display?function(t){var e,i,n,a=ut.options._parseFont(t.options.pointLabels),o={l:0,r:t.width,t:0,b:t.height-t.paddingTop},r={};t.ctx.font=a.string,t._pointLabelSizes=[];var s,l,d,u=Ti(t);for(e=0;e<u;e++){n=t.getPointPosition(e,t.drawingArea+5),s=t.ctx,l=a.lineHeight,d=t.pointLabels[e]||"",i=ut.isArray(d)?{w:ut.longestText(s,s.font,d),h:d.length*l}:{w:s.measureText(d).width,h:l},t._pointLabelSizes[e]=i;var h=t.getIndexAngle(e),c=ut.toDegrees(h)%360,f=Li(c,n.x,i.w,0,180),g=Li(c,n.y,i.h,90,270);f.start<o.l&&(o.l=f.start,r.l=h),f.end>o.r&&(o.r=f.end,r.r=h),g.start<o.t&&(o.t=g.start,r.t=h),g.end>o.b&&(o.b=g.end,r.b=h)}t.setReductions(t.drawingArea,o,r)}(this):this.setCenterPoint(0,0,0,0)},setReductions:function(t,e,i){var n=this,a=e.l/Math.sin(i.l),o=Math.max(e.r-n.width,0)/Math.sin(i.r),r=-e.t/Math.cos(i.t),s=-Math.max(e.b-(n.height-n.paddingTop),0)/Math.cos(i.b);a=Bi(a),o=Bi(o),r=Bi(r),s=Bi(s),n.drawingArea=Math.min(Math.floor(t-(a+o)/2),Math.floor(t-(r+s)/2)),n.setCenterPoint(a,o,r,s)},setCenterPoint:function(t,e,i,n){var a=this,o=a.width-e-a.drawingArea,r=t+a.drawingArea,s=i+a.drawingArea,l=a.height-a.paddingTop-n-a.drawingArea;a.xCenter=Math.floor((r+o)/2+a.left),a.yCenter=Math.floor((s+l)/2+a.top+a.paddingTop)},getIndexAngle:function(t){return t*(2*Math.PI/Ti(this))+(this.chart.options&&this.chart.options.startAngle?this.chart.options.startAngle:0)*Math.PI*2/360},getDistanceFromCenterForValue:function(t){var e=this;if(null===t)return 0;var i=e.drawingArea/(e.max-e.min);return e.options.ticks.reverse?(e.max-t)*i:(t-e.min)*i},getPointPosition:function(t,e){var i=this.getIndexAngle(t)-Math.PI/2;return{x:Math.cos(i)*e+this.xCenter,y:Math.sin(i)*e+this.yCenter}},getPointPositionForValue:function(t,e){return this.getPointPosition(t,this.getDistanceFromCenterForValue(e))},getBasePosition:function(){var t=this.min,e=this.max;return this.getPointPositionForValue(0,this.beginAtZero?0:t<0&&e<0?e:t>0&&e>0?t:0)},draw:function(){var t=this,e=t.options,i=e.gridLines,n=e.ticks;if(e.display){var a=t.ctx,o=this.getIndexAngle(0),r=ut.options._parseFont(n);(e.angleLines.display||e.pointLabels.display)&&function(t){var e=t.ctx,i=t.options,n=i.angleLines,a=i.gridLines,o=i.pointLabels,r=Pi(n.lineWidth,a.lineWidth),s=Pi(n.color,a.color),l=Fi(i);e.save(),e.lineWidth=r,e.strokeStyle=s,e.setLineDash&&(e.setLineDash(Ai([n.borderDash,a.borderDash,[]])),e.lineDashOffset=Ai([n.borderDashOffset,a.borderDashOffset,0]));var d=t.getDistanceFromCenterForValue(i.ticks.reverse?t.min:t.max),u=ut.options._parseFont(o);e.font=u.string,e.textBaseline="middle";for(var h=Ti(t)-1;h>=0;h--){if(n.display&&r&&s){var c=t.getPointPosition(h,d);e.beginPath(),e.moveTo(t.xCenter,t.yCenter),e.lineTo(c.x,c.y),e.stroke()}if(o.display){var f=0===h?l/2:0,g=t.getPointPosition(h,d+f+5),p=Ii(o.fontColor,h,st.global.defaultFontColor);e.fillStyle=p;var m=t.getIndexAngle(h),v=ut.toDegrees(m);e.textAlign=Ri(v),zi(v,t._pointLabelSizes[h],g),Oi(e,t.pointLabels[h]||"",g,u.lineHeight)}}e.restore()}(t),ut.each(t.ticks,function(e,s){if(s>0||n.reverse){var l=t.getDistanceFromCenterForValue(t.ticksAsNumbers[s]);if(i.display&&0!==s&&function(t,e,i,n){var a,o=t.ctx,r=e.circular,s=Ti(t),l=Ii(e.color,n-1),d=Ii(e.lineWidth,n-1);if((r||s)&&l&&d){if(o.save(),o.strokeStyle=l,o.lineWidth=d,o.setLineDash&&(o.setLineDash(e.borderDash||[]),o.lineDashOffset=e.borderDashOffset||0),o.beginPath(),r)o.arc(t.xCenter,t.yCenter,i,0,2*Math.PI);else{a=t.getPointPosition(0,i),o.moveTo(a.x,a.y);for(var u=1;u<s;u++)a=t.getPointPosition(u,i),o.lineTo(a.x,a.y)}o.closePath(),o.stroke(),o.restore()}}(t,i,l,s),n.display){var d=Pi(n.fontColor,st.global.defaultFontColor);if(a.font=r.string,a.save(),a.translate(t.xCenter,t.yCenter),a.rotate(o),n.showLabelBackdrop){var u=a.measureText(e).width;a.fillStyle=n.backdropColor,a.fillRect(-u/2-n.backdropPaddingX,-l-r.size/2-n.backdropPaddingY,u+2*n.backdropPaddingX,r.size+2*n.backdropPaddingY)}a.textAlign="center",a.textBaseline="middle",a.fillStyle=d,a.fillText(e,0,-l),a.restore()}}})}}}),Wi=Di;Ni._defaults=Wi;var Vi=ut.valueOrDefault,Ei=Number.MIN_SAFE_INTEGER||-9007199254740991,Hi=Number.MAX_SAFE_INTEGER||9007199254740991,ji={millisecond:{common:!0,size:1,steps:[1,2,5,10,20,50,100,250,500]},second:{common:!0,size:1e3,steps:[1,2,5,10,15,30]},minute:{common:!0,size:6e4,steps:[1,2,5,10,15,30]},hour:{common:!0,size:36e5,steps:[1,2,3,6,12]},day:{common:!0,size:864e5,steps:[1,2,5]},week:{common:!1,size:6048e5,steps:[1,2,3,4]},month:{common:!0,size:2628e6,steps:[1,2,3]},quarter:{common:!1,size:7884e6,steps:[1,2,3,4]},year:{common:!0,size:3154e7}},qi=Object.keys(ji);function Yi(t,e){return t-e}function Ui(t){var e,i,n,a={},o=[];for(e=0,i=t.length;e<i;++e)a[n=t[e]]||(a[n]=!0,o.push(n));return o}function Xi(t,e,i,n){var a=function(t,e,i){for(var n,a,o,r=0,s=t.length-1;r>=0&&r<=s;){if(a=t[(n=r+s>>1)-1]||null,o=t[n],!a)return{lo:null,hi:o};if(o[e]<i)r=n+1;else{if(!(a[e]>i))return{lo:a,hi:o};s=n-1}}return{lo:o,hi:null}}(t,e,i),o=a.lo?a.hi?a.lo:t[t.length-2]:t[0],r=a.lo?a.hi?a.hi:t[t.length-1]:t[1],s=r[e]-o[e],l=s?(i-o[e])/s:0,d=(r[n]-o[n])*l;return o[n]+d}function Ki(t,e){var i=t._adapter,n=t.options.time,a=n.parser,o=a||n.format,r=e;return"function"==typeof a&&(r=a(r)),ut.isFinite(r)||(r="string"==typeof o?i.parse(r,o):i.parse(r)),null!==r?+r:(a||"function"!=typeof o||(r=o(e),ut.isFinite(r)||(r=i.parse(r))),r)}function Gi(t,e){if(ut.isNullOrUndef(e))return null;var i=t.options.time,n=Ki(t,t.getRightValue(e));return null===n?n:(i.round&&(n=+t._adapter.startOf(n,i.round)),n)}function Zi(t){for(var e=qi.indexOf(t)+1,i=qi.length;e<i;++e)if(ji[qi[e]].common)return qi[e]}function $i(t,e,i,n){var a,o=t._adapter,r=t.options,s=r.time,l=s.unit||function(t,e,i,n){var a,o,r,s=qi.length;for(a=qi.indexOf(t);a<s-1;++a)if(r=(o=ji[qi[a]]).steps?o.steps[o.steps.length-1]:Hi,o.common&&Math.ceil((i-e)/(r*o.size))<=n)return qi[a];return qi[s-1]}(s.minUnit,e,i,n),d=Zi(l),u=Vi(s.stepSize,s.unitStepSize),h="week"===l&&s.isoWeekday,c=r.ticks.major.enabled,f=ji[l],g=e,p=i,m=[];for(u||(u=function(t,e,i,n){var a,o,r,s=e-t,l=ji[i],d=l.size,u=l.steps;if(!u)return Math.ceil(s/(n*d));for(a=0,o=u.length;a<o&&(r=u[a],!(Math.ceil(s/(d*r))<=n));++a);return r}(e,i,l,n)),h&&(g=+o.startOf(g,"isoWeek",h),p=+o.startOf(p,"isoWeek",h)),g=+o.startOf(g,h?"day":l),(p=+o.startOf(p,h?"day":l))<i&&(p=+o.add(p,1,l)),a=g,c&&d&&!h&&!s.round&&(a=+o.startOf(a,d),a=+o.add(a,~~((g-a)/(f.size*u))*u,l));a<p;a=+o.add(a,u,l))m.push(+a);return m.push(+a),m}var Ji=fi.extend({initialize:function(){this.mergeTicksOptions(),fi.prototype.initialize.call(this)},update:function(){var t=this.options,e=t.time||(t.time={}),i=this._adapter=new si._date(t.adapters.date);return e.format&&console.warn("options.time.format is deprecated and replaced by options.time.parser."),ut.mergeIf(e.displayFormats,i.formats()),fi.prototype.update.apply(this,arguments)},getRightValue:function(t){return t&&void 0!==t.t&&(t=t.t),fi.prototype.getRightValue.call(this,t)},determineDataLimits:function(){var t,e,i,n,a,o,r=this,s=r.chart,l=r._adapter,d=r.options.time,u=d.unit||"day",h=Hi,c=Ei,f=[],g=[],p=[],m=s.data.labels||[];for(t=0,i=m.length;t<i;++t)p.push(Gi(r,m[t]));for(t=0,i=(s.data.datasets||[]).length;t<i;++t)if(s.isDatasetVisible(t))if(a=s.data.datasets[t].data,ut.isObject(a[0]))for(g[t]=[],e=0,n=a.length;e<n;++e)o=Gi(r,a[e]),f.push(o),g[t][e]=o;else{for(e=0,n=p.length;e<n;++e)f.push(p[e]);g[t]=p.slice(0)}else g[t]=[];p.length&&(p=Ui(p).sort(Yi),h=Math.min(h,p[0]),c=Math.max(c,p[p.length-1])),f.length&&(f=Ui(f).sort(Yi),h=Math.min(h,f[0]),c=Math.max(c,f[f.length-1])),h=Gi(r,d.min)||h,c=Gi(r,d.max)||c,h=h===Hi?+l.startOf(Date.now(),u):h,c=c===Ei?+l.endOf(Date.now(),u)+1:c,r.min=Math.min(h,c),r.max=Math.max(h+1,c),r._horizontal=r.isHorizontal(),r._table=[],r._timestamps={data:f,datasets:g,labels:p}},buildTicks:function(){var t,e,i,n=this,a=n.min,o=n.max,r=n.options,s=r.time,l=[],d=[];switch(r.ticks.source){case"data":l=n._timestamps.data;break;case"labels":l=n._timestamps.labels;break;case"auto":default:l=$i(n,a,o,n.getLabelCapacity(a))}for("ticks"===r.bounds&&l.length&&(a=l[0],o=l[l.length-1]),a=Gi(n,s.min)||a,o=Gi(n,s.max)||o,t=0,e=l.length;t<e;++t)(i=l[t])>=a&&i<=o&&d.push(i);return n.min=a,n.max=o,n._unit=s.unit||function(t,e,i,n,a){var o,r;for(o=qi.length-1;o>=qi.indexOf(i);o--)if(r=qi[o],ji[r].common&&t._adapter.diff(a,n,r)>=e.length)return r;return qi[i?qi.indexOf(i):0]}(n,d,s.minUnit,n.min,n.max),n._majorUnit=Zi(n._unit),n._table=function(t,e,i,n){if("linear"===n||!t.length)return[{time:e,pos:0},{time:i,pos:1}];var a,o,r,s,l,d=[],u=[e];for(a=0,o=t.length;a<o;++a)(s=t[a])>e&&s<i&&u.push(s);for(u.push(i),a=0,o=u.length;a<o;++a)l=u[a+1],r=u[a-1],s=u[a],void 0!==r&&void 0!==l&&Math.round((l+r)/2)===s||d.push({time:s,pos:a/(o-1)});return d}(n._timestamps.data,a,o,r.distribution),n._offsets=function(t,e,i,n,a){var o,r,s=0,l=0;return a.offset&&e.length&&(a.time.min||(o=Xi(t,"time",e[0],"pos"),s=1===e.length?1-o:(Xi(t,"time",e[1],"pos")-o)/2),a.time.max||(r=Xi(t,"time",e[e.length-1],"pos"),l=1===e.length?r:(r-Xi(t,"time",e[e.length-2],"pos"))/2)),{start:s,end:l}}(n._table,d,0,0,r),r.ticks.reverse&&d.reverse(),function(t,e,i){var n,a,o,r,s=[];for(n=0,a=e.length;n<a;++n)o=e[n],r=!!i&&o===+t._adapter.startOf(o,i),s.push({value:o,major:r});return s}(n,d,n._majorUnit)},getLabelForIndex:function(t,e){var i=this,n=i._adapter,a=i.chart.data,o=i.options.time,r=a.labels&&t<a.labels.length?a.labels[t]:"",s=a.datasets[e].data[t];return ut.isObject(s)&&(r=i.getRightValue(s)),o.tooltipFormat?n.format(Ki(i,r),o.tooltipFormat):"string"==typeof r?r:n.format(Ki(i,r),o.displayFormats.datetime)},tickFormatFunction:function(t,e,i,n){var a=this._adapter,o=this.options,r=o.time.displayFormats,s=r[this._unit],l=this._majorUnit,d=r[l],u=+a.startOf(t,l),h=o.ticks.major,c=h.enabled&&l&&d&&t===u,f=a.format(t,n||(c?d:s)),g=c?h:o.ticks.minor,p=Vi(g.callback,g.userCallback);return p?p(f,e,i):f},convertTicksToLabels:function(t){var e,i,n=[];for(e=0,i=t.length;e<i;++e)n.push(this.tickFormatFunction(t[e].value,e,t));return n},getPixelForOffset:function(t){var e=this,i=e.options.ticks.reverse,n=e._horizontal?e.width:e.height,a=e._horizontal?i?e.right:e.left:i?e.bottom:e.top,o=Xi(e._table,"time",t,"pos"),r=n*(e._offsets.start+o)/(e._offsets.start+1+e._offsets.end);return i?a-r:a+r},getPixelForValue:function(t,e,i){var n=null;if(void 0!==e&&void 0!==i&&(n=this._timestamps.datasets[i][e]),null===n&&(n=Gi(this,t)),null!==n)return this.getPixelForOffset(n)},getPixelForTick:function(t){var e=this.getTicks();return t>=0&&t<e.length?this.getPixelForOffset(e[t].value):null},getValueForPixel:function(t){var e=this,i=e._horizontal?e.width:e.height,n=e._horizontal?e.left:e.top,a=(i?(t-n)/i:0)*(e._offsets.start+1+e._offsets.start)-e._offsets.end,o=Xi(e._table,"pos",a,"time");return e._adapter._create(o)},getLabelWidth:function(t){var e=this.options.ticks,i=this.ctx.measureText(t).width,n=ut.toRadians(e.maxRotation),a=Math.cos(n),o=Math.sin(n);return i*a+Vi(e.fontSize,st.global.defaultFontSize)*o},getLabelCapacity:function(t){var e=this,i=e.options.time.displayFormats.millisecond,n=e.tickFormatFunction(t,0,[],i),a=e.getLabelWidth(n),o=e.isHorizontal()?e.width:e.height,r=Math.floor(o/a);return r>0?r:1}}),Qi={position:"bottom",distribution:"linear",bounds:"data",adapters:{},time:{parser:!1,format:!1,unit:!1,round:!1,displayFormat:!1,isoWeekday:!1,minUnit:"millisecond",displayFormats:{}},ticks:{autoSkip:!1,source:"auto",major:{enabled:!1}}};Ji._defaults=Qi;var tn={category:gi,linear:yi,logarithmic:Ci,radialLinear:Ni,time:Ji},en={datetime:"MMM D, YYYY, h:mm:ss a",millisecond:"h:mm:ss.SSS a",second:"h:mm:ss a",minute:"h:mm a",hour:"hA",day:"MMM D",week:"ll",month:"MMM YYYY",quarter:"[Q]Q - YYYY",year:"YYYY"};si._date.override("function"==typeof t?{_id:"moment",formats:function(){return en},parse:function(e,i){return"string"==typeof e&&"string"==typeof i?e=t(e,i):e instanceof t||(e=t(e)),e.isValid()?e.valueOf():null},format:function(e,i){return t(e).format(i)},add:function(e,i,n){return t(e).add(i,n).valueOf()},diff:function(e,i,n){return t.duration(t(e).diff(t(i))).as(n)},startOf:function(e,i,n){return e=t(e),"isoWeek"===i?e.isoWeekday(n).valueOf():e.startOf(i).valueOf()},endOf:function(e,i){return t(e).endOf(i).valueOf()},_create:function(e){return t(e)}}:{}),st._set("global",{plugins:{filler:{propagate:!0}}});var nn={dataset:function(t){var e=t.fill,i=t.chart,n=i.getDatasetMeta(e),a=n&&i.isDatasetVisible(e)&&n.dataset._children||[],o=a.length||0;return o?function(t,e){return e<o&&a[e]._view||null}:null},boundary:function(t){var e=t.boundary,i=e?e.x:null,n=e?e.y:null;return function(t){return{x:null===i?t.x:i,y:null===n?t.y:n}}}};function an(t,e,i){var n,a=t._model||{},o=a.fill;if(void 0===o&&(o=!!a.backgroundColor),!1===o||null===o)return!1;if(!0===o)return"origin";if(n=parseFloat(o,10),isFinite(n)&&Math.floor(n)===n)return"-"!==o[0]&&"+"!==o[0]||(n=e+n),!(n===e||n<0||n>=i)&&n;switch(o){case"bottom":return"start";case"top":return"end";case"zero":return"origin";case"origin":case"start":case"end":return o;default:return!1}}function on(t){var e,i=t.el._model||{},n=t.el._scale||{},a=t.fill,o=null;if(isFinite(a))return null;if("start"===a?o=void 0===i.scaleBottom?n.bottom:i.scaleBottom:"end"===a?o=void 0===i.scaleTop?n.top:i.scaleTop:void 0!==i.scaleZero?o=i.scaleZero:n.getBasePosition?o=n.getBasePosition():n.getBasePixel&&(o=n.getBasePixel()),null!=o){if(void 0!==o.x&&void 0!==o.y)return o;if(ut.isFinite(o))return{x:(e=n.isHorizontal())?o:null,y:e?null:o}}return null}function rn(t,e,i){var n,a=t[e].fill,o=[e];if(!i)return a;for(;!1!==a&&-1===o.indexOf(a);){if(!isFinite(a))return a;if(!(n=t[a]))return!1;if(n.visible)return a;o.push(a),a=n.fill}return!1}function sn(t){var e=t.fill,i="dataset";return!1===e?null:(isFinite(e)||(i="boundary"),nn[i](t))}function ln(t){return t&&!t.skip}function dn(t,e,i,n,a){var o;if(n&&a){for(t.moveTo(e[0].x,e[0].y),o=1;o<n;++o)ut.canvas.lineTo(t,e[o-1],e[o]);for(t.lineTo(i[a-1].x,i[a-1].y),o=a-1;o>0;--o)ut.canvas.lineTo(t,i[o],i[o-1],!0)}}var un={id:"filler",afterDatasetsUpdate:function(t,e){var i,n,a,o,r=(t.data.datasets||[]).length,s=e.propagate,l=[];for(n=0;n<r;++n)o=null,(a=(i=t.getDatasetMeta(n)).dataset)&&a._model&&a instanceof Wt.Line&&(o={visible:t.isDatasetVisible(n),fill:an(a,n,r),chart:t,el:a}),i.$filler=o,l.push(o);for(n=0;n<r;++n)(o=l[n])&&(o.fill=rn(l,n,s),o.boundary=on(o),o.mapper=sn(o))},beforeDatasetDraw:function(t,e){var i=e.meta.$filler;if(i){var n=t.ctx,a=i.el,o=a._view,r=a._children||[],s=i.mapper,l=o.backgroundColor||st.global.defaultColor;s&&l&&r.length&&(ut.canvas.clipArea(n,t.chartArea),function(t,e,i,n,a,o){var r,s,l,d,u,h,c,f=e.length,g=n.spanGaps,p=[],m=[],v=0,b=0;for(t.beginPath(),r=0,s=f+!!o;r<s;++r)u=i(d=e[l=r%f]._view,l,n),h=ln(d),c=ln(u),h&&c?(v=p.push(d),b=m.push(u)):v&&b&&(g?(h&&p.push(d),c&&m.push(u)):(dn(t,p,m,v,b),v=b=0,p=[],m=[]));dn(t,p,m,v,b),t.closePath(),t.fillStyle=a,t.fill()}(n,r,s,o,l,a._loop),ut.canvas.unclipArea(n))}}},hn=ut.noop,cn=ut.valueOrDefault;function fn(t,e){return t.usePointStyle&&t.boxWidth>e?e:t.boxWidth}st._set("global",{legend:{display:!0,position:"top",fullWidth:!0,reverse:!1,weight:1e3,onClick:function(t,e){var i=e.datasetIndex,n=this.chart,a=n.getDatasetMeta(i);a.hidden=null===a.hidden?!n.data.datasets[i].hidden:null,n.update()},onHover:null,onLeave:null,labels:{boxWidth:40,padding:10,generateLabels:function(t){var e=t.data;return ut.isArray(e.datasets)?e.datasets.map(function(e,i){return{text:e.label,fillStyle:ut.isArray(e.backgroundColor)?e.backgroundColor[0]:e.backgroundColor,hidden:!t.isDatasetVisible(i),lineCap:e.borderCapStyle,lineDash:e.borderDash,lineDashOffset:e.borderDashOffset,lineJoin:e.borderJoinStyle,lineWidth:e.borderWidth,strokeStyle:e.borderColor,pointStyle:e.pointStyle,datasetIndex:i}},this):[]}}},legendCallback:function(t){var e=[];e.push('<ul class="'+t.id+'-legend">');for(var i=0;i<t.data.datasets.length;i++)e.push('<li><span style="background-color:'+t.data.datasets[i].backgroundColor+'"></span>'),t.data.datasets[i].label&&e.push(t.data.datasets[i].label),e.push("</li>");return e.push("</ul>"),e.join("")}});var gn=pt.extend({initialize:function(t){ut.extend(this,t),this.legendHitBoxes=[],this._hoveredItem=null,this.doughnutMode=!1},beforeUpdate:hn,update:function(t,e,i){var n=this;return n.beforeUpdate(),n.maxWidth=t,n.maxHeight=e,n.margins=i,n.beforeSetDimensions(),n.setDimensions(),n.afterSetDimensions(),n.beforeBuildLabels(),n.buildLabels(),n.afterBuildLabels(),n.beforeFit(),n.fit(),n.afterFit(),n.afterUpdate(),n.minSize},afterUpdate:hn,beforeSetDimensions:hn,setDimensions:function(){var t=this;t.isHorizontal()?(t.width=t.maxWidth,t.left=0,t.right=t.width):(t.height=t.maxHeight,t.top=0,t.bottom=t.height),t.paddingLeft=0,t.paddingTop=0,t.paddingRight=0,t.paddingBottom=0,t.minSize={width:0,height:0}},afterSetDimensions:hn,beforeBuildLabels:hn,buildLabels:function(){var t=this,e=t.options.labels||{},i=ut.callback(e.generateLabels,[t.chart],t)||[];e.filter&&(i=i.filter(function(i){return e.filter(i,t.chart.data)})),t.options.reverse&&i.reverse(),t.legendItems=i},afterBuildLabels:hn,beforeFit:hn,fit:function(){var t=this,e=t.options,i=e.labels,n=e.display,a=t.ctx,o=ut.options._parseFont(i),r=o.size,s=t.legendHitBoxes=[],l=t.minSize,d=t.isHorizontal();if(d?(l.width=t.maxWidth,l.height=n?10:0):(l.width=n?10:0,l.height=t.maxHeight),n)if(a.font=o.string,d){var u=t.lineWidths=[0],h=0;a.textAlign="left",a.textBaseline="top",ut.each(t.legendItems,function(t,e){var n=fn(i,r)+r/2+a.measureText(t.text).width;(0===e||u[u.length-1]+n+i.padding>l.width)&&(h+=r+i.padding,u[u.length-(e>0?0:1)]=i.padding),s[e]={left:0,top:0,width:n,height:r},u[u.length-1]+=n+i.padding}),l.height+=h}else{var c=i.padding,f=t.columnWidths=[],g=i.padding,p=0,m=0,v=r+c;ut.each(t.legendItems,function(t,e){var n=fn(i,r)+r/2+a.measureText(t.text).width;e>0&&m+v>l.height-c&&(g+=p+i.padding,f.push(p),p=0,m=0),p=Math.max(p,n),m+=v,s[e]={left:0,top:0,width:n,height:r}}),g+=p,f.push(p),l.width+=g}t.width=l.width,t.height=l.height},afterFit:hn,isHorizontal:function(){return"top"===this.options.position||"bottom"===this.options.position},draw:function(){var t=this,e=t.options,i=e.labels,n=st.global,a=n.defaultColor,o=n.elements.line,r=t.width,s=t.lineWidths;if(e.display){var l,d=t.ctx,u=cn(i.fontColor,n.defaultFontColor),h=ut.options._parseFont(i),c=h.size;d.textAlign="left",d.textBaseline="middle",d.lineWidth=.5,d.strokeStyle=u,d.fillStyle=u,d.font=h.string;var f=fn(i,c),g=t.legendHitBoxes,p=t.isHorizontal();l=p?{x:t.left+(r-s[0])/2+i.padding,y:t.top+i.padding,line:0}:{x:t.left+i.padding,y:t.top+i.padding,line:0};var m=c+i.padding;ut.each(t.legendItems,function(n,u){var h=d.measureText(n.text).width,v=f+c/2+h,b=l.x,x=l.y;p?u>0&&b+v+i.padding>t.left+t.minSize.width&&(x=l.y+=m,l.line++,b=l.x=t.left+(r-s[l.line])/2+i.padding):u>0&&x+m>t.top+t.minSize.height&&(b=l.x=b+t.columnWidths[l.line]+i.padding,x=l.y=t.top+i.padding,l.line++),function(t,i,n){if(!(isNaN(f)||f<=0)){d.save();var r=cn(n.lineWidth,o.borderWidth);if(d.fillStyle=cn(n.fillStyle,a),d.lineCap=cn(n.lineCap,o.borderCapStyle),d.lineDashOffset=cn(n.lineDashOffset,o.borderDashOffset),d.lineJoin=cn(n.lineJoin,o.borderJoinStyle),d.lineWidth=r,d.strokeStyle=cn(n.strokeStyle,a),d.setLineDash&&d.setLineDash(cn(n.lineDash,o.borderDash)),e.labels&&e.labels.usePointStyle){var s=f*Math.SQRT2/2,l=t+f/2,u=i+c/2;ut.canvas.drawPoint(d,n.pointStyle,s,l,u)}else 0!==r&&d.strokeRect(t,i,f,c),d.fillRect(t,i,f,c);d.restore()}}(b,x,n),g[u].left=b,g[u].top=x,function(t,e,i,n){var a=c/2,o=f+a+t,r=e+a;d.fillText(i.text,o,r),i.hidden&&(d.beginPath(),d.lineWidth=2,d.moveTo(o,r),d.lineTo(o+n,r),d.stroke())}(b,x,n,h),p?l.x+=v+i.padding:l.y+=m})}},_getLegendItemAt:function(t,e){var i,n,a,o=this;if(t>=o.left&&t<=o.right&&e>=o.top&&e<=o.bottom)for(a=o.legendHitBoxes,i=0;i<a.length;++i)if(t>=(n=a[i]).left&&t<=n.left+n.width&&e>=n.top&&e<=n.top+n.height)return o.legendItems[i];return null},handleEvent:function(t){var e,i=this,n=i.options,a="mouseup"===t.type?"click":t.type;if("mousemove"===a){if(!n.onHover&&!n.onLeave)return}else{if("click"!==a)return;if(!n.onClick)return}e=i._getLegendItemAt(t.x,t.y),"click"===a?e&&n.onClick&&n.onClick.call(i,t.native,e):(n.onLeave&&e!==i._hoveredItem&&(i._hoveredItem&&n.onLeave.call(i,t.native,i._hoveredItem),i._hoveredItem=e),n.onHover&&e&&n.onHover.call(i,t.native,e))}});function pn(t,e){var i=new gn({ctx:t.ctx,options:e,chart:t});ke.configure(t,i,e),ke.addBox(t,i),t.legend=i}var mn={id:"legend",_element:gn,beforeInit:function(t){var e=t.options.legend;e&&pn(t,e)},beforeUpdate:function(t){var e=t.options.legend,i=t.legend;e?(ut.mergeIf(e,st.global.legend),i?(ke.configure(t,i,e),i.options=e):pn(t,e)):i&&(ke.removeBox(t,i),delete t.legend)},afterEvent:function(t,e){var i=t.legend;i&&i.handleEvent(e)}},vn=ut.noop;st._set("global",{title:{display:!1,fontStyle:"bold",fullWidth:!0,padding:10,position:"top",text:"",weight:2e3}});var bn=pt.extend({initialize:function(t){ut.extend(this,t),this.legendHitBoxes=[]},beforeUpdate:vn,update:function(t,e,i){var n=this;return n.beforeUpdate(),n.maxWidth=t,n.maxHeight=e,n.margins=i,n.beforeSetDimensions(),n.setDimensions(),n.afterSetDimensions(),n.beforeBuildLabels(),n.buildLabels(),n.afterBuildLabels(),n.beforeFit(),n.fit(),n.afterFit(),n.afterUpdate(),n.minSize},afterUpdate:vn,beforeSetDimensions:vn,setDimensions:function(){var t=this;t.isHorizontal()?(t.width=t.maxWidth,t.left=0,t.right=t.width):(t.height=t.maxHeight,t.top=0,t.bottom=t.height),t.paddingLeft=0,t.paddingTop=0,t.paddingRight=0,t.paddingBottom=0,t.minSize={width:0,height:0}},afterSetDimensions:vn,beforeBuildLabels:vn,buildLabels:vn,afterBuildLabels:vn,beforeFit:vn,fit:function(){var t=this,e=t.options,i=e.display,n=t.minSize,a=ut.isArray(e.text)?e.text.length:1,o=ut.options._parseFont(e),r=i?a*o.lineHeight+2*e.padding:0;t.isHorizontal()?(n.width=t.maxWidth,n.height=r):(n.width=r,n.height=t.maxHeight),t.width=n.width,t.height=n.height},afterFit:vn,isHorizontal:function(){var t=this.options.position;return"top"===t||"bottom"===t},draw:function(){var t=this,e=t.ctx,i=t.options;if(i.display){var n,a,o,r=ut.options._parseFont(i),s=r.lineHeight,l=s/2+i.padding,d=0,u=t.top,h=t.left,c=t.bottom,f=t.right;e.fillStyle=ut.valueOrDefault(i.fontColor,st.global.defaultFontColor),e.font=r.string,t.isHorizontal()?(a=h+(f-h)/2,o=u+l,n=f-h):(a="left"===i.position?h+l:f-l,o=u+(c-u)/2,n=c-u,d=Math.PI*("left"===i.position?-.5:.5)),e.save(),e.translate(a,o),e.rotate(d),e.textAlign="center",e.textBaseline="middle";var g=i.text;if(ut.isArray(g))for(var p=0,m=0;m<g.length;++m)e.fillText(g[m],0,p,n),p+=s;else e.fillText(g,0,0,n);e.restore()}}});function xn(t,e){var i=new bn({ctx:t.ctx,options:e,chart:t});ke.configure(t,i,e),ke.addBox(t,i),t.titleBlock=i}var yn={},kn=un,wn=mn,Mn={id:"title",_element:bn,beforeInit:function(t){var e=t.options.title;e&&xn(t,e)},beforeUpdate:function(t){var e=t.options.title,i=t.titleBlock;e?(ut.mergeIf(e,st.global.title),i?(ke.configure(t,i,e),i.options=e):xn(t,e)):i&&(ke.removeBox(t,i),delete t.titleBlock)}};for(var _n in yn.filler=kn,yn.legend=wn,yn.title=Mn,ai.helpers=ut,function(){function t(t,e,i){var n;return"string"==typeof t?(n=parseInt(t,10),-1!==t.indexOf("%")&&(n=n/100*e.parentNode[i])):n=t,n}function e(t){return null!=t&&"none"!==t}function i(i,n,a){var o=document.defaultView,r=ut._getParentNode(i),s=o.getComputedStyle(i)[n],l=o.getComputedStyle(r)[n],d=e(s),u=e(l),h=Number.POSITIVE_INFINITY;return d||u?Math.min(d?t(s,i,a):h,u?t(l,r,a):h):"none"}ut.where=function(t,e){if(ut.isArray(t)&&Array.prototype.filter)return t.filter(e);var i=[];return ut.each(t,function(t){e(t)&&i.push(t)}),i},ut.findIndex=Array.prototype.findIndex?function(t,e,i){return t.findIndex(e,i)}:function(t,e,i){i=void 0===i?t:i;for(var n=0,a=t.length;n<a;++n)if(e.call(i,t[n],n,t))return n;return-1},ut.findNextWhere=function(t,e,i){ut.isNullOrUndef(i)&&(i=-1);for(var n=i+1;n<t.length;n++){var a=t[n];if(e(a))return a}},ut.findPreviousWhere=function(t,e,i){ut.isNullOrUndef(i)&&(i=t.length);for(var n=i-1;n>=0;n--){var a=t[n];if(e(a))return a}},ut.isNumber=function(t){return!isNaN(parseFloat(t))&&isFinite(t)},ut.almostEquals=function(t,e,i){return Math.abs(t-e)<i},ut.almostWhole=function(t,e){var i=Math.round(t);return i-e<t&&i+e>t},ut.max=function(t){return t.reduce(function(t,e){return isNaN(e)?t:Math.max(t,e)},Number.NEGATIVE_INFINITY)},ut.min=function(t){return t.reduce(function(t,e){return isNaN(e)?t:Math.min(t,e)},Number.POSITIVE_INFINITY)},ut.sign=Math.sign?function(t){return Math.sign(t)}:function(t){return 0==(t=+t)||isNaN(t)?t:t>0?1:-1},ut.log10=Math.log10?function(t){return Math.log10(t)}:function(t){var e=Math.log(t)*Math.LOG10E,i=Math.round(e);return t===Math.pow(10,i)?i:e},ut.toRadians=function(t){return t*(Math.PI/180)},ut.toDegrees=function(t){return t*(180/Math.PI)},ut._decimalPlaces=function(t){if(ut.isFinite(t)){for(var e=1,i=0;Math.round(t*e)/e!==t;)e*=10,i++;return i}},ut.getAngleFromPoint=function(t,e){var i=e.x-t.x,n=e.y-t.y,a=Math.sqrt(i*i+n*n),o=Math.atan2(n,i);return o<-.5*Math.PI&&(o+=2*Math.PI),{angle:o,distance:a}},ut.distanceBetweenPoints=function(t,e){return Math.sqrt(Math.pow(e.x-t.x,2)+Math.pow(e.y-t.y,2))},ut.aliasPixel=function(t){return t%2==0?0:.5},ut._alignPixel=function(t,e,i){var n=t.currentDevicePixelRatio,a=i/2;return Math.round((e-a)*n)/n+a},ut.splineCurve=function(t,e,i,n){var a=t.skip?e:t,o=e,r=i.skip?e:i,s=Math.sqrt(Math.pow(o.x-a.x,2)+Math.pow(o.y-a.y,2)),l=Math.sqrt(Math.pow(r.x-o.x,2)+Math.pow(r.y-o.y,2)),d=s/(s+l),u=l/(s+l),h=n*(d=isNaN(d)?0:d),c=n*(u=isNaN(u)?0:u);return{previous:{x:o.x-h*(r.x-a.x),y:o.y-h*(r.y-a.y)},next:{x:o.x+c*(r.x-a.x),y:o.y+c*(r.y-a.y)}}},ut.EPSILON=Number.EPSILON||1e-14,ut.splineCurveMonotone=function(t){var e,i,n,a,o,r,s,l,d,u=(t||[]).map(function(t){return{model:t._model,deltaK:0,mK:0}}),h=u.length;for(e=0;e<h;++e)if(!(n=u[e]).model.skip){if(i=e>0?u[e-1]:null,(a=e<h-1?u[e+1]:null)&&!a.model.skip){var c=a.model.x-n.model.x;n.deltaK=0!==c?(a.model.y-n.model.y)/c:0}!i||i.model.skip?n.mK=n.deltaK:!a||a.model.skip?n.mK=i.deltaK:this.sign(i.deltaK)!==this.sign(n.deltaK)?n.mK=0:n.mK=(i.deltaK+n.deltaK)/2}for(e=0;e<h-1;++e)n=u[e],a=u[e+1],n.model.skip||a.model.skip||(ut.almostEquals(n.deltaK,0,this.EPSILON)?n.mK=a.mK=0:(o=n.mK/n.deltaK,r=a.mK/n.deltaK,(l=Math.pow(o,2)+Math.pow(r,2))<=9||(s=3/Math.sqrt(l),n.mK=o*s*n.deltaK,a.mK=r*s*n.deltaK)));for(e=0;e<h;++e)(n=u[e]).model.skip||(i=e>0?u[e-1]:null,a=e<h-1?u[e+1]:null,i&&!i.model.skip&&(d=(n.model.x-i.model.x)/3,n.model.controlPointPreviousX=n.model.x-d,n.model.controlPointPreviousY=n.model.y-d*n.mK),a&&!a.model.skip&&(d=(a.model.x-n.model.x)/3,n.model.controlPointNextX=n.model.x+d,n.model.controlPointNextY=n.model.y+d*n.mK))},ut.nextItem=function(t,e,i){return i?e>=t.length-1?t[0]:t[e+1]:e>=t.length-1?t[t.length-1]:t[e+1]},ut.previousItem=function(t,e,i){return i?e<=0?t[t.length-1]:t[e-1]:e<=0?t[0]:t[e-1]},ut.niceNum=function(t,e){var i=Math.floor(ut.log10(t)),n=t/Math.pow(10,i);return(e?n<1.5?1:n<3?2:n<7?5:10:n<=1?1:n<=2?2:n<=5?5:10)*Math.pow(10,i)},ut.requestAnimFrame="undefined"==typeof window?function(t){t()}:window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(t){return window.setTimeout(t,1e3/60)},ut.getRelativePosition=function(t,e){var i,n,a=t.originalEvent||t,o=t.target||t.srcElement,r=o.getBoundingClientRect(),s=a.touches;s&&s.length>0?(i=s[0].clientX,n=s[0].clientY):(i=a.clientX,n=a.clientY);var l=parseFloat(ut.getStyle(o,"padding-left")),d=parseFloat(ut.getStyle(o,"padding-top")),u=parseFloat(ut.getStyle(o,"padding-right")),h=parseFloat(ut.getStyle(o,"padding-bottom")),c=r.right-r.left-l-u,f=r.bottom-r.top-d-h;return{x:i=Math.round((i-r.left-l)/c*o.width/e.currentDevicePixelRatio),y:n=Math.round((n-r.top-d)/f*o.height/e.currentDevicePixelRatio)}},ut.getConstraintWidth=function(t){return i(t,"max-width","clientWidth")},ut.getConstraintHeight=function(t){return i(t,"max-height","clientHeight")},ut._calculatePadding=function(t,e,i){return(e=ut.getStyle(t,e)).indexOf("%")>-1?i*parseInt(e,10)/100:parseInt(e,10)},ut._getParentNode=function(t){var e=t.parentNode;return e&&"[object ShadowRoot]"===e.toString()&&(e=e.host),e},ut.getMaximumWidth=function(t){var e=ut._getParentNode(t);if(!e)return t.clientWidth;var i=e.clientWidth,n=i-ut._calculatePadding(e,"padding-left",i)-ut._calculatePadding(e,"padding-right",i),a=ut.getConstraintWidth(t);return isNaN(a)?n:Math.min(n,a)},ut.getMaximumHeight=function(t){var e=ut._getParentNode(t);if(!e)return t.clientHeight;var i=e.clientHeight,n=i-ut._calculatePadding(e,"padding-top",i)-ut._calculatePadding(e,"padding-bottom",i),a=ut.getConstraintHeight(t);return isNaN(a)?n:Math.min(n,a)},ut.getStyle=function(t,e){return t.currentStyle?t.currentStyle[e]:document.defaultView.getComputedStyle(t,null).getPropertyValue(e)},ut.retinaScale=function(t,e){var i=t.currentDevicePixelRatio=e||"undefined"!=typeof window&&window.devicePixelRatio||1;if(1!==i){var n=t.canvas,a=t.height,o=t.width;n.height=a*i,n.width=o*i,t.ctx.scale(i,i),n.style.height||n.style.width||(n.style.height=a+"px",n.style.width=o+"px")}},ut.fontString=function(t,e,i){return e+" "+t+"px "+i},ut.longestText=function(t,e,i,n){var a=(n=n||{}).data=n.data||{},o=n.garbageCollect=n.garbageCollect||[];n.font!==e&&(a=n.data={},o=n.garbageCollect=[],n.font=e),t.font=e;var r=0;ut.each(i,function(e){null!=e&&!0!==ut.isArray(e)?r=ut.measureText(t,a,o,r,e):ut.isArray(e)&&ut.each(e,function(e){null==e||ut.isArray(e)||(r=ut.measureText(t,a,o,r,e))})});var s=o.length/2;if(s>i.length){for(var l=0;l<s;l++)delete a[o[l]];o.splice(0,s)}return r},ut.measureText=function(t,e,i,n,a){var o=e[a];return o||(o=e[a]=t.measureText(a).width,i.push(a)),o>n&&(n=o),n},ut.numberOfLabelLines=function(t){var e=1;return ut.each(t,function(t){ut.isArray(t)&&t.length>e&&(e=t.length)}),e},ut.color=X?function(t){return t instanceof CanvasGradient&&(t=st.global.defaultColor),X(t)}:function(t){return console.error("Color.js not found!"),t},ut.getHoverColor=function(t){return t instanceof CanvasPattern||t instanceof CanvasGradient?t:ut.color(t).saturate(.5).darken(.1).rgbString()}}(),ai._adapters=si,ai.Animation=vt,ai.animationService=bt,ai.controllers=ue,ai.DatasetController=Mt,ai.defaults=st,ai.Element=pt,ai.elements=Wt,ai.Interaction=ve,ai.layouts=ke,ai.platform=Ve,ai.plugins=Ee,ai.Scale=fi,ai.scaleService=He,ai.Ticks=li,ai.Tooltip=Je,ai.helpers.each(tn,function(t,e){ai.scaleService.registerScaleType(e,t,t._defaults)}),yn)yn.hasOwnProperty(_n)&&ai.plugins.register(yn[_n]);ai.platform.initialize();var Cn=ai;return"undefined"!=typeof window&&(window.Chart=ai),ai.Chart=ai,ai.Legend=yn.legend._element,ai.Title=yn.title._element,ai.pluginService=ai.plugins,ai.PluginBase=ai.Element.extend({}),ai.canvasHelpers=ai.helpers.canvas,ai.layoutService=ai.layouts,ai.LinearScaleBase=bi,ai.helpers.each(["Bar","Bubble","Doughnut","Line","PolarArea","Radar","Scatter"],function(t){ai[t]=function(e,i){return new ai(e,ai.helpers.merge(i||{},{type:t.charAt(0).toLowerCase()+t.slice(1)}))}}),Cn});


!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(t=t||self).Shuffle=e()}(this,function(){"use strict";function t(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function e(t,e){for(var i=0;i<e.length;i++){var n=e[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function i(t,i,n){return i&&e(t.prototype,i),n&&e(t,n),t}function n(t){return(n=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function s(t,e){return(s=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function o(t,e){return!e||"object"!=typeof e&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function r(){}r.prototype={on:function(t,e,i){var n=this.e||(this.e={});return(n[t]||(n[t]=[])).push({fn:e,ctx:i}),this},once:function(t,e,i){var n=this;function s(){n.off(t,s),e.apply(i,arguments)}return s._=e,this.on(t,s,i)},emit:function(t){for(var e=[].slice.call(arguments,1),i=((this.e||(this.e={}))[t]||[]).slice(),n=0,s=i.length;n<s;n++)i[n].fn.apply(i[n].ctx,e);return this},off:function(t,e){var i=this.e||(this.e={}),n=i[t],s=[];if(n&&e)for(var o=0,r=n.length;o<r;o++)n[o].fn!==e&&n[o].fn._!==e&&s.push(n[o]);return s.length?i[t]=s:delete i[t],this}};var l=r,a=r;l.TinyEmitter=a;var u="undefined"!=typeof Element?Element.prototype:{},h=u.matches||u.matchesSelector||u.webkitMatchesSelector||u.mozMatchesSelector||u.msMatchesSelector||u.oMatchesSelector,f=function(t,e){if(!t||1!==t.nodeType)return!1;if(h)return h.call(t,e);for(var i=t.parentNode.querySelectorAll(e),n=0;n<i.length;n++)if(i[n]==t)return!0;return!1};var c=function(t,e){var i,n,s,o,r=0;return function(){i=this,n=arguments;var t=new Date-r;return o||(t>=e?l():o=setTimeout(l,e-t)),s};function l(){o=0,r=+new Date,s=t.apply(i,n),i=null,n=null}};function d(){}function m(t){return parseFloat(t)||0}var p=function(){function e(i,n){t(this,e),this.x=m(i),this.y=m(n)}return i(e,null,[{key:"equals",value:function(t,e){return t.x===e.x&&t.y===e.y}}]),e}(),v=function(){function e(i,n,s,o,r){t(this,e),this.id=r,this.left=i,this.top=n,this.width=s,this.height=o}return i(e,null,[{key:"intersects",value:function(t,e){return t.left<e.left+e.width&&e.left<t.left+t.width&&t.top<e.top+e.height&&e.top<t.top+t.height}}]),e}(),y={BASE:"shuffle",SHUFFLE_ITEM:"shuffle-item",VISIBLE:"shuffle-item--visible",HIDDEN:"shuffle-item--hidden"},g=0,_=function(){function e(i){t(this,e),g+=1,this.id=g,this.element=i,this.isVisible=!0,this.isHidden=!1}return i(e,[{key:"show",value:function(){this.isVisible=!0,this.element.classList.remove(y.HIDDEN),this.element.classList.add(y.VISIBLE),this.element.removeAttribute("aria-hidden")}},{key:"hide",value:function(){this.isVisible=!1,this.element.classList.remove(y.VISIBLE),this.element.classList.add(y.HIDDEN),this.element.setAttribute("aria-hidden",!0)}},{key:"init",value:function(){this.addClasses([y.SHUFFLE_ITEM,y.VISIBLE]),this.applyCss(e.Css.INITIAL),this.scale=e.Scale.VISIBLE,this.point=new p}},{key:"addClasses",value:function(t){var e=this;t.forEach(function(t){e.element.classList.add(t)})}},{key:"removeClasses",value:function(t){var e=this;t.forEach(function(t){e.element.classList.remove(t)})}},{key:"applyCss",value:function(t){var e=this;Object.keys(t).forEach(function(i){e.element.style[i]=t[i]})}},{key:"dispose",value:function(){this.removeClasses([y.HIDDEN,y.VISIBLE,y.SHUFFLE_ITEM]),this.element.removeAttribute("style"),this.element=null}}]),e}();_.Css={INITIAL:{position:"absolute",top:0,left:0,visibility:"visible",willChange:"transform"},VISIBLE:{before:{opacity:1,visibility:"visible"},after:{transitionDelay:""}},HIDDEN:{before:{opacity:0},after:{visibility:"hidden",transitionDelay:""}}},_.Scale={VISIBLE:1,HIDDEN:.001};var E=null,I=function(){if(null!==E)return E;var t=document.body||document.documentElement,e=document.createElement("div");return e.style.cssText="width:10px;padding:2px;box-sizing:border-box;",t.appendChild(e),E="10px"===window.getComputedStyle(e,null).width,t.removeChild(e),E};function b(t,e){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:window.getComputedStyle(t,null),n=m(i[e]);return I()||"width"!==e?I()||"height"!==e||(n+=m(i.paddingTop)+m(i.paddingBottom)+m(i.borderTopWidth)+m(i.borderBottomWidth)):n+=m(i.paddingLeft)+m(i.paddingRight)+m(i.borderLeftWidth)+m(i.borderRightWidth),n}var S={reverse:!1,by:null,compare:null,randomize:!1,key:"element"};function T(t,e){var i=Object.assign({},S,e),n=Array.from(t),s=!1;return t.length?i.randomize?function(t){for(var e=t.length;e;){e-=1;var i=Math.floor(Math.random()*(e+1)),n=t[i];t[i]=t[e],t[e]=n}return t}(t):("function"==typeof i.by?t.sort(function(t,e){if(s)return 0;var n=i.by(t[i.key]),o=i.by(e[i.key]);return void 0===n&&void 0===o?(s=!0,0):n<o||"sortFirst"===n||"sortLast"===o?-1:n>o||"sortLast"===n||"sortFirst"===o?1:0}):"function"==typeof i.compare&&t.sort(i.compare),s?n:(i.reverse&&t.reverse(),t)):[]}var k={},w="transitionend",C=0;function L(t){return!!k[t]&&(k[t].element.removeEventListener(w,k[t].listener),k[t]=null,!0)}function D(t,e){var i=w+(C+=1),n=function(t){t.currentTarget===t.target&&(L(i),e(t))};return t.addEventListener(w,n),k[i]={element:t,listener:n},i}function z(t){return Math.max.apply(Math,t)}function M(t,e,i,n){var s=t/e;return Math.abs(Math.round(s)-s)<n&&(s=Math.round(s)),Math.min(Math.ceil(s),i)}function A(t,e,i){if(1===e)return t;for(var n=[],s=0;s<=i-e;s++)n.push(z(t.slice(s,s+e)));return n}function F(t,e){for(var i,n=(i=t,Math.min.apply(Math,i)),s=0,o=t.length;s<o;s++)if(t[s]>=n-e&&t[s]<=n+e)return s;return 0}function x(t,e){var i={};t.forEach(function(t){i[t.top]?i[t.top].push(t):i[t.top]=[t]});var n=[],s=[],o=[];return Object.keys(i).forEach(function(t){var r=i[t];s.push(r);var l,a=r[r.length-1],u=a.left+a.width,h=Math.round((e-u)/2),f=r,c=!1;if(h>0){var d=[];(c=r.every(function(t){var e=new v(t.left+h,t.top,t.width,t.height,t.id),i=!n.some(function(t){return v.intersects(e,t)});return d.push(e),i}))&&(f=d)}if(!c&&r.some(function(t){return n.some(function(e){var i=v.intersects(t,e);return i&&(l=e),i})})){var m=o.findIndex(function(t){return t.includes(l)});o.splice(m,1,s[m])}n=n.concat(f),o.push(f)}),[].concat.apply([],o).sort(function(t,e){return t.id-e.id}).map(function(t){return new p(t.left,t.top)})}function O(t){return Array.from(new Set(t))}var N=0,H=function(e){function r(e){var i,s=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t(this,r),(i=o(this,n(r).call(this))).options=Object.assign({},r.options,s),i.options.delimeter&&(i.options.delimiter=i.options.delimeter),i.lastSort={},i.group=r.ALL_ITEMS,i.lastFilter=r.ALL_ITEMS,i.isEnabled=!0,i.isDestroyed=!1,i.isInitialized=!1,i._transitions=[],i.isTransitioning=!1,i._queue=[];var l=i._getElementOption(e);if(!l)throw new TypeError("Shuffle needs to be initialized with an element.");return i.element=l,i.id="shuffle_"+N,N+=1,i._init(),i.isInitialized=!0,i}return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&s(t,e)}(r,l),i(r,[{key:"_init",value:function(){if(this.items=this._getItems(),this.options.sizer=this._getElementOption(this.options.sizer),this.element.classList.add(r.Classes.BASE),this._initItems(this.items),this._onResize=this._getResizeFunction(),window.addEventListener("resize",this._onResize),"complete"!==document.readyState){var t=this.layout.bind(this);window.addEventListener("load",function e(){window.removeEventListener("load",e),t()})}var e=window.getComputedStyle(this.element,null),i=r.getSize(this.element).width;this._validateStyles(e),this._setColumns(i),this.filter(this.options.group,this.options.initialSort),this.element.offsetWidth,this.setItemTransitions(this.items),this.element.style.transition="height ".concat(this.options.speed,"ms ").concat(this.options.easing)}},{key:"_getResizeFunction",value:function(){var t=this._handleResize.bind(this);return this.options.throttle?this.options.throttle(t,this.options.throttleTime):t}},{key:"_getElementOption",value:function(t){return"string"==typeof t?this.element.querySelector(t):t&&t.nodeType&&1===t.nodeType?t:t&&t.jquery?t[0]:null}},{key:"_validateStyles",value:function(t){"static"===t.position&&(this.element.style.position="relative"),"hidden"!==t.overflow&&(this.element.style.overflow="hidden")}},{key:"_filter",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.lastFilter,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:this.items,i=this._getFilteredSets(t,e);return this._toggleFilterClasses(i),this.lastFilter=t,"string"==typeof t&&(this.group=t),i}},{key:"_getFilteredSets",value:function(t,e){var i=this,n=[],s=[];return t===r.ALL_ITEMS?n=e:e.forEach(function(e){i._doesPassFilter(t,e.element)?n.push(e):s.push(e)}),{visible:n,hidden:s}}},{key:"_doesPassFilter",value:function(t,e){if("function"==typeof t)return t.call(e,e,this);var i=e.getAttribute("data-"+r.FILTER_ATTRIBUTE_KEY),n=this.options.delimiter?i.split(this.options.delimiter):JSON.parse(i);function s(t){return n.includes(t)}return Array.isArray(t)?this.options.filterMode===r.FilterMode.ANY?t.some(s):t.every(s):n.includes(t)}},{key:"_toggleFilterClasses",value:function(t){var e=t.visible,i=t.hidden;e.forEach(function(t){t.show()}),i.forEach(function(t){t.hide()})}},{key:"_initItems",value:function(t){t.forEach(function(t){t.init()})}},{key:"_disposeItems",value:function(t){t.forEach(function(t){t.dispose()})}},{key:"_updateItemCount",value:function(){this.visibleItems=this._getFilteredItems().length}},{key:"setItemTransitions",value:function(t){var e=this.options,i=e.speed,n=e.easing,s=this.options.useTransforms?["transform"]:["top","left"],o=Object.keys(_.Css.HIDDEN.before).map(function(t){return t.replace(/([A-Z])/g,function(t,e){return"-".concat(e.toLowerCase())})}),r=s.concat(o).join();t.forEach(function(t){t.element.style.transitionDuration=i+"ms",t.element.style.transitionTimingFunction=n,t.element.style.transitionProperty=r})}},{key:"_getItems",value:function(){var t=this;return Array.from(this.element.children).filter(function(e){return f(e,t.options.itemSelector)}).map(function(t){return new _(t)})}},{key:"_mergeNewItems",value:function(t){var e=Array.from(this.element.children);return T(this.items.concat(t),{by:function(t){return e.indexOf(t)}})}},{key:"_getFilteredItems",value:function(){return this.items.filter(function(t){return t.isVisible})}},{key:"_getConcealedItems",value:function(){return this.items.filter(function(t){return!t.isVisible})}},{key:"_getColumnSize",value:function(t,e){var i;return 0===(i="function"==typeof this.options.columnWidth?this.options.columnWidth(t):this.options.sizer?r.getSize(this.options.sizer).width:this.options.columnWidth?this.options.columnWidth:this.items.length>0?r.getSize(this.items[0].element,!0).width:t)&&(i=t),i+e}},{key:"_getGutterSize",value:function(t){return"function"==typeof this.options.gutterWidth?this.options.gutterWidth(t):this.options.sizer?b(this.options.sizer,"marginLeft"):this.options.gutterWidth}},{key:"_setColumns",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:r.getSize(this.element).width,e=this._getGutterSize(t),i=this._getColumnSize(t,e),n=(t+e)/i;Math.abs(Math.round(n)-n)<this.options.columnThreshold&&(n=Math.round(n)),this.cols=Math.max(Math.floor(n||0),1),this.containerWidth=t,this.colWidth=i}},{key:"_setContainerSize",value:function(){this.element.style.height=this._getContainerSize()+"px"}},{key:"_getContainerSize",value:function(){return z(this.positions)}},{key:"_getStaggerAmount",value:function(t){return Math.min(t*this.options.staggerAmount,this.options.staggerAmountMax)}},{key:"_dispatch",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.isDestroyed||(e.shuffle=this,this.emit(t,e))}},{key:"_resetCols",value:function(){var t=this.cols;for(this.positions=[];t;)t-=1,this.positions.push(0)}},{key:"_layout",value:function(t){var e=this,i=this._getNextPositions(t),n=0;t.forEach(function(t,s){function o(){t.applyCss(_.Css.VISIBLE.after)}if(p.equals(t.point,i[s])&&!t.isHidden)return t.applyCss(_.Css.VISIBLE.before),void o();t.point=i[s],t.scale=_.Scale.VISIBLE,t.isHidden=!1;var r=e.getStylesForTransition(t,_.Css.VISIBLE.before);r.transitionDelay=e._getStaggerAmount(n)+"ms",e._queue.push({item:t,styles:r,callback:o}),n+=1})}},{key:"_getNextPositions",value:function(t){var e=this;if(this.options.isCentered){var i=t.map(function(t,i){var n=r.getSize(t.element,!0),s=e._getItemPosition(n);return new v(s.x,s.y,n.width,n.height,i)});return this.getTransformedPositions(i,this.containerWidth)}return t.map(function(t){return e._getItemPosition(r.getSize(t.element,!0))})}},{key:"_getItemPosition",value:function(t){return function(t){for(var e=t.itemSize,i=t.positions,n=t.gridSize,s=t.total,o=t.threshold,r=t.buffer,l=M(e.width,n,s,o),a=A(i,l,s),u=F(a,r),h=new p(n*u,a[u]),f=a[u]+e.height,c=0;c<l;c++)i[u+c]=f;return h}({itemSize:t,positions:this.positions,gridSize:this.colWidth,total:this.cols,threshold:this.options.columnThreshold,buffer:this.options.buffer})}},{key:"getTransformedPositions",value:function(t,e){return x(t,e)}},{key:"_shrink",value:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this._getConcealedItems(),i=0;e.forEach(function(e){function n(){e.applyCss(_.Css.HIDDEN.after)}if(e.isHidden)return e.applyCss(_.Css.HIDDEN.before),void n();e.scale=_.Scale.HIDDEN,e.isHidden=!0;var s=t.getStylesForTransition(e,_.Css.HIDDEN.before);s.transitionDelay=t._getStaggerAmount(i)+"ms",t._queue.push({item:e,styles:s,callback:n}),i+=1})}},{key:"_handleResize",value:function(){this.isEnabled&&!this.isDestroyed&&this.update()}},{key:"getStylesForTransition",value:function(t,e){var i=Object.assign({},e);if(this.options.useTransforms){var n=this.options.roundTransforms?Math.round(t.point.x):t.point.x,s=this.options.roundTransforms?Math.round(t.point.y):t.point.y;i.transform="translate(".concat(n,"px, ").concat(s,"px) scale(").concat(t.scale,")")}else i.left=t.point.x+"px",i.top=t.point.y+"px";return i}},{key:"_whenTransitionDone",value:function(t,e,i){var n=D(t,function(t){e(),i(null,t)});this._transitions.push(n)}},{key:"_getTransitionFunction",value:function(t){var e=this;return function(i){t.item.applyCss(t.styles),e._whenTransitionDone(t.item.element,t.callback,i)}}},{key:"_processQueue",value:function(){this.isTransitioning&&this._cancelMovement();var t=this.options.speed>0,e=this._queue.length>0;e&&t&&this.isInitialized?this._startTransitions(this._queue):e?(this._styleImmediately(this._queue),this._dispatch(r.EventType.LAYOUT)):this._dispatch(r.EventType.LAYOUT),this._queue.length=0}},{key:"_startTransitions",value:function(t){var e=this;this.isTransitioning=!0,function(t,e,i){i||("function"==typeof e?(i=e,e=null):i=d);var n=t&&t.length;if(!n)return i(null,[]);var s=!1,o=new Array(n);function r(t){return function(e,r){if(!s){if(e)return i(e,o),void(s=!0);o[t]=r,--n||i(null,o)}}}t.forEach(e?function(t,i){t.call(e,r(i))}:function(t,e){t(r(e))})}(t.map(function(t){return e._getTransitionFunction(t)}),this._movementFinished.bind(this))}},{key:"_cancelMovement",value:function(){this._transitions.forEach(L),this._transitions.length=0,this.isTransitioning=!1}},{key:"_styleImmediately",value:function(t){if(t.length){var e=t.map(function(t){return t.item.element});r._skipTransitions(e,function(){t.forEach(function(t){t.item.applyCss(t.styles),t.callback()})})}}},{key:"_movementFinished",value:function(){this._transitions.length=0,this.isTransitioning=!1,this._dispatch(r.EventType.LAYOUT)}},{key:"filter",value:function(t,e){this.isEnabled&&((!t||t&&0===t.length)&&(t=r.ALL_ITEMS),this._filter(t),this._shrink(),this._updateItemCount(),this.sort(e))}},{key:"sort",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.lastSort;if(this.isEnabled){this._resetCols();var e=T(this._getFilteredItems(),t);this._layout(e),this._processQueue(),this._setContainerSize(),this.lastSort=t}}},{key:"update",value:function(){var t=arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.isEnabled&&(t||this._setColumns(),this.sort())}},{key:"layout",value:function(){this.update(!0)}},{key:"add",value:function(t){var e=this,i=O(t).map(function(t){return new _(t)});this._initItems(i),this._resetCols();var n=T(this._mergeNewItems(i),this.lastSort),s=this._filter(this.lastFilter,n),o=function(t){return i.includes(t)},r=function(t){t.scale=_.Scale.HIDDEN,t.isHidden=!0,t.applyCss(_.Css.HIDDEN.before),t.applyCss(_.Css.HIDDEN.after)},l=this._getNextPositions(s.visible);s.visible.forEach(function(t,i){o(t)&&(t.point=l[i],r(t),t.applyCss(e.getStylesForTransition(t,{})))}),s.hidden.forEach(function(t){o(t)&&r(t)}),this.element.offsetWidth,this.setItemTransitions(i),this.items=this._mergeNewItems(i),this.filter(this.lastFilter)}},{key:"disable",value:function(){this.isEnabled=!1}},{key:"enable",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isEnabled=!0,t&&this.update()}},{key:"remove",value:function(t){var e=this;if(t.length){var i=O(t),n=i.map(function(t){return e.getItemByElement(t)}).filter(function(t){return!!t});this._toggleFilterClasses({visible:[],hidden:n}),this._shrink(n),this.sort(),this.items=this.items.filter(function(t){return!n.includes(t)}),this._updateItemCount(),this.once(r.EventType.LAYOUT,function(){e._disposeItems(n),i.forEach(function(t){t.parentNode.removeChild(t)}),e._dispatch(r.EventType.REMOVED,{collection:i})})}}},{key:"getItemByElement",value:function(t){return this.items.find(function(e){return e.element===t})}},{key:"resetItems",value:function(){var t=this;this._disposeItems(this.items),this.isInitialized=!1,this.items=this._getItems(),this._initItems(this.items),this.once(r.EventType.LAYOUT,function(){t.setItemTransitions(t.items),t.isInitialized=!0}),this.filter(this.lastFilter)}},{key:"destroy",value:function(){this._cancelMovement(),window.removeEventListener("resize",this._onResize),this.element.classList.remove("shuffle"),this.element.removeAttribute("style"),this._disposeItems(this.items),this.items.length=0,this._transitions.length=0,this.options.sizer=null,this.element=null,this.isDestroyed=!0,this.isEnabled=!1}}],[{key:"getSize",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],i=window.getComputedStyle(t,null),n=b(t,"width",i),s=b(t,"height",i);if(e){var o=b(t,"marginLeft",i),r=b(t,"marginRight",i),l=b(t,"marginTop",i),a=b(t,"marginBottom",i);n+=o+r,s+=l+a}return{width:n,height:s}}},{key:"_skipTransitions",value:function(t,e){var i=t.map(function(t){var e=t.style,i=e.transitionDuration,n=e.transitionDelay;return e.transitionDuration="0ms",e.transitionDelay="0ms",{duration:i,delay:n}});e(),t[0].offsetWidth,t.forEach(function(t,e){t.style.transitionDuration=i[e].duration,t.style.transitionDelay=i[e].delay})}}]),r}();return H.ShuffleItem=_,H.ALL_ITEMS="all",H.FILTER_ATTRIBUTE_KEY="groups",H.EventType={LAYOUT:"shuffle:layout",REMOVED:"shuffle:removed"},H.Classes=y,H.FilterMode={ANY:"any",ALL:"all"},H.options={group:H.ALL_ITEMS,speed:250,easing:"cubic-bezier(0.4, 0.0, 0.2, 1)",itemSelector:"*",sizer:null,gutterWidth:0,columnWidth:0,delimiter:null,buffer:0,columnThreshold:.01,initialSort:null,throttle:c,throttleTime:300,staggerAmount:15,staggerAmountMax:150,useTransforms:!0,filterMode:H.FilterMode.ANY,isCentered:!1,roundTransforms:!0},H.Point=p,H.Rect=v,H.__sorter=T,H.__getColumnSpan=M,H.__getAvailablePositions=A,H.__getShortColumn=F,H.__getCenteredPositions=x,H});
//# sourceMappingURL=shuffle.min.js.map


