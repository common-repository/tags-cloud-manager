(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function() {

		console.log('--->'+$('span.tcm_menu-title-tag').parent().attr('style','background-color: #ffffff !important; color: #000000 !important'));

		$('#tcm-styles-custom').change(function(){
			$('.tcm-custom-style').show();
			$('.tcm-simple-style').hide();
		});
		$('#tcm-styles-simple').change(function(){
			$('.tcm-custom-style').hide();
			$('.tcm-simple-style').show();
			$('.tcm-cloud a').addClass('tcm-custom-jquery-style');
		});


		$('#tcm-border-top').change(function(){
			if(this.checked == false){
				$('.border-top').hide();
				$('.tcm-cloud a').css('border-top','none');
			}else{
				$('.border-top').show();
				var width = $('#tcm-border-width-top').val();
				var style = $('#tcm-border-style-top').val();
				var color = $('#tcm-border-color-top').val();
				$('.tcm-cloud a').css('border-top',width+'px '+style+' '+color+' ');
			}
		});

		$('#tcm-border-bottom').change(function(){
			if(this.checked == false){
				$('.border-bottom').hide();
				$('.tcm-cloud a').css('border-bottom','none');
			}else{
				$('.border-bottom').show();
				var width = $('#tcm-border-width-bottom').val();
				var style = $('#tcm-border-style-bottom').val();
				var color = $('#tcm-border-color-bottom').val();
				$('.tcm-cloud a').css('border-bottom',width+'px '+style+' '+color+' ');
			}
		});

		$('#tcm-border-left').change(function(){
			if(this.checked == false){
				$('.border-left').hide();
				$('.tcm-cloud a').css('border-left','none');
			}else{
				$('.border-left').show();
				var width = $('#tcm-border-width-left').val();
				var style = $('#tcm-border-style-left').val();
				var color = $('#tcm-border-color-left').val();
				$('.tcm-cloud a').css('border-left',width+'px '+style+' '+color+' ');
			}
		});

		$('#tcm-border-right').change(function(){
			if(this.checked == false){
				$('.border-right').hide();
				$('.tcm-cloud a').css('border-right','none');
			}else{
				$('.border-right').show();
				var width = $('#tcm-border-width-right').val();
				var style = $('#tcm-border-style-right').val();
				var color = $('#tcm-border-color-right').val();
				$('.tcm-cloud a').css('border-right',width+'px '+style+' '+color+' ');
			}
		});

		$('#tcm-text-decoration').change(function(){
			if(this.checked == false){
				$('.tcm-text-decoration').hide();
					$('.tcm-cloud a').css('text-decoration','none');
			}else{
				$('.tcm-text-decoration').show();
				var line = $('#tcm-text-decoration-line').val();
				if(line == 'none'){
					$('.tcm-cloud a').css('text-decoration','none');	
				}else{
					var style = $('#tcm-text-decoration-style').val();
					var color = $('#tcm-text-decoration-color').val();

					$('.tcm-cloud a').css('text-decoration-line',line);
					$('.tcm-cloud a').css('text-decoration-style',style);
					$('.tcm-cloud a').css('text-decoration-color',color);
				}
			}
		});

		$('#tcm-separator').keyup(function(){
			var separator = $('#tcm-separator').val();

			if(separator){
				$('.tcm-separator-check').show();
				$('.tcm-cloud a.tcm_separator').text(separator);

					var separator_check = $('#tcm-separator-check').checked;

				if(!separator_check){
					$('.tcm-separator-decoration').hide();
					$('.tcm-cloud a.tcm_separator').hide();
				}else{
					$('.tcm-separator-decoration').show();
					$('.tcm-cloud a.tcm_separator').show();
				}
			}else{
				$('.tcm-separator-check').hide();
				$('.tcm-separator-decoration').hide();
				$('.tcm-cloud a.tcm_separator').hide();
			}
		});


		$('#tcm-separator-check').change(function(){
			if(this.checked == false){
				$('.tcm-separator-decoration').hide();
				$('.tcm-cloud a.tcm_separator').hide();
			}else{
				$('.tcm-separator-decoration').show();
				$('.tcm-cloud a.tcm_separator').show();
			}
		});


		$('#tcm-separator-decoration').change(function(){
			if(this.checked == false){
		        $('.tcm-cloud a.tcm_separator').css('border','none');
		        $('.tcm-cloud a.tcm_separator').css('padding','0px');
		        $('.tcm-cloud a.tcm_separator').css('margin','opx');
		        $('.tcm-cloud a.tcm_separator').css('float','left');
		        $('.tcm-cloud a.tcm_separator').css('display','inline-block');
			}else{
				var width = $('#tcm-border-width-top').val();
				var style = $('#tcm-border-style-top').val();
				var color = $('#tcm-border-color-top').val();
				$('.tcm-cloud a').css('border-top',width+'px '+style+' '+color+' ');

				var width = $('#tcm-border-width-bottom').val();
				var style = $('#tcm-border-style-bottom').val();
				var color = $('#tcm-border-color-bottom').val();
				$('.tcm-cloud a').css('border-bottom',width+'px '+style+' '+color+' ');

				var width = $('#tcm-border-width-left').val();
				var style = $('#tcm-border-style-left').val();
				var color = $('#tcm-border-color-left').val();
				$('.tcm-cloud a').css('border-left',width+'px '+style+' '+color+' ');

				var width = $('#tcm-border-width-right').val();
				var style = $('#tcm-border-style-right').val();
				var color = $('#tcm-border-color-right').val();
				$('.tcm-cloud a').css('border-right',width+'px '+style+' '+color+' ');

				var padding_top = $('#tcm-padding-top').val();
				var padding_bottom = $('#tcm-padding-bottom').val();
				var padding_left = $('#tcm-padding-left').val();
				var padding_right = $('#tcm-padding-right').val();
				$('.tcm-cloud a').css('padding',padding_top+'px '+padding_right+'px '+padding_bottom+'px '+padding_left+'px');

				var margin_top = $('#tcm-margin-top').val();
				var margin_bottom = $('#tcm-margin-bottom').val();
				var margin_left = $('#tcm-margin-left').val();
				var margin_right = $('#tcm-margin-right').val();
				$('.tcm-cloud a').css('margin',margin_top+'px '+margin_right+'px '+margin_bottom+'px '+margin_left+'px');
			}
		});

		$('#tcm-show-count-on').change(function(){
			if(this.checked == true){
				$('.tag-link-count').show();
			}
		});
		$('#tcm-show-count-off').change(function(){
			if(this.checked == true){
				$('.tag-link-count').hide();
			}
		});

		$('#tcm-flat').change(function(){
				$('.tcm-preview-list').hide();
				$('.tcm-preview-flat').show();
		});
		$('#tcm-list').change(function(){
				$('.tcm-preview-flat').hide();

				$('.tcm-cloud a').css('float','none');
				$('.tcm-preview-list').show();
		});


// Custom Style
		$('#tcm-border-width-top, #tcm-border-style-top, #tcm-border-color-top').change(function(){
			var width = $('#tcm-border-width-top').val();
			var style = $('#tcm-border-style-top').val();
			var color = $('#tcm-border-color-top').val();
			$('.tcm-cloud a').css('border-top',width+'px '+style+' '+color+' ');
		});

		$('#tcm-border-width-bottom, #tcm-border-style-bottom, #tcm-border-color-bottom').change(function(){
			var width = $('#tcm-border-width-bottom').val();
			var style = $('#tcm-border-style-bottom').val();
			var color = $('#tcm-border-color-bottom').val();
			$('.tcm-cloud a').css('border-bottom',width+'px '+style+' '+color+' ');
		});

		$('#tcm-border-width-left, #tcm-border-style-left, #tcm-border-color-left').change(function(){
			var width = $('#tcm-border-width-left').val();
			var style = $('#tcm-border-style-left').val();
			var color = $('#tcm-border-color-left').val();
			$('.tcm-cloud a').css('border-left',width+'px '+style+' '+color+' ');
		});

		$('#tcm-border-width-right, #tcm-border-style-right, #tcm-border-color-right').change(function(){
			var width = $('#tcm-border-width-right').val();
			var style = $('#tcm-border-style-right').val();
			var color = $('#tcm-border-color-right').val();
			$('.tcm-cloud a').css('border-right',width+'px '+style+' '+color+' ');
		});



		$('#tcm-padding-top, #tcm-padding-bottom, #tcm-padding-right, #tcm-padding-left').change(function(){
			var padding_top = $('#tcm-padding-top').val();
			var padding_bottom = $('#tcm-padding-bottom').val();
			var padding_left = $('#tcm-padding-left').val();
			var padding_right = $('#tcm-padding-right').val();
			var padding = padding_top+'px '+padding_right+'px '+padding_bottom+'px '+padding_left+'px';
			if( $(this).parents('div').hasClass("tcm-preview-flat") ){
				$('.tcm-cloud a').css('float','left');
			}
			$('.tcm-cloud a').css('padding',padding);
		});
		$('#tcm-margin-top, #tcm-margin-bottom, #tcm-margin-right, #tcm-margin-left').change(function(){
			var margin_top = $('#tcm-margin-top').val();
			var margin_bottom = $('#tcm-margin-bottom').val();
			var margin_left = $('#tcm-margin-left').val();
			var margin_right = $('#tcm-margin-right').val();
			var margin = margin_top+'px '+margin_right+'px '+margin_bottom+'px '+margin_left+'px';
			if( $(this).parents('div').hasClass("tcm-preview-flat") ){
				$('.tcm-cloud a').css('float','left');
			}
			$('.tcm-cloud a').css('margin',margin);
		});



		$('#tcm-border-radius-top-right, #tcm-border-radius-top-left, #tcm-border-radius-bottom-right, #tcm-border-radius-bottom-left').change(function(){
			var top_right = $('#tcm-border-radius-top-right').val();
			var top_left = $('#tcm-border-radius-top-left').val();
			var bottom_right = $('#tcm-border-radius-bottom-right').val();
			var bottom_left = $('#tcm-border-radius-bottom-left').val();

			$('.tcm-cloud a').css('border-top-left-radius',top_left+'px');
			$('.tcm-cloud a').css('border-top-right-radius',top_right+'px');
			$('.tcm-cloud a').css('border-bottom-left-radius',bottom_left+'px');
			$('.tcm-cloud a').css('border-bottom-right-radius',bottom_right+'px');
		});



		$('#tcm-text-color').change(function(){
			var color = $('#tcm-text-color').val();
			$('.tcm-cloud a').css('color',color);
		});

		$('#tcm-text-hover-color').change(function(){
			var color = $('#tcm-text-color').val();
			var hover_color = $('#tcm-text-hover-color').val();
			$('.tcm-cloud a').attr('onMouseOver',"this.style.color='"+hover_color+"'");
			$('.tcm-cloud a').attr('onMouseOut',"this.style.color='"+color+"'");
		});

		$('#tcm-bg-color').change(function(){
			var color = $('#tcm-bg-color').val();
			$('.tcm-cloud a').css('background-color',color);
		});


		$('#tcm-text-decoration-line, #tcm-text-decoration-style, #tcm-text-decoration-color').change(function(){
			var line = $('#tcm-text-decoration-line').val();
			if(line == 'none'){
				$('.tcm-cloud a').css('text-decoration','none');	
			}else{
				var style = $('#tcm-text-decoration-style').val();
				var color = $('#tcm-text-decoration-color').val();

				$('.tcm-cloud a').css('text-decoration-line',line);
				$('.tcm-cloud a').css('text-decoration-style',style);
				$('.tcm-cloud a').css('text-decoration-color',color);
			}	
		});
		
	});
})( jQuery );


function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
