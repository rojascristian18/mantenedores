/* jshint bitwise:true, browser:true, eqeqeq:true, forin:true, globalstrict:true, indent:4, jquery:true,
   loopfunc:true, maxerr:3, noarg:true, node:true, noempty:true, onevar: true, quotmark:single,
   strict:true, undef:true, white:false */
/* global FB, webroot, fullwebroot */

//<![CDATA[
'use strict';

/**
 * jQuery
 */
jQuery(document).ready(function($)
{
	/**
	* Copy icons
	*/
	if ($('#modal_iconos').length > 0) {
		$('.icons-list > li').on('click', function(){
			var inputIcon = $('#ModuloIcono');
			var icono = $(this).children().attr('class');

			inputIcon.val( icono );
			
			$('#modal_iconos').modal('hide');

		}); 
	}
});
//]]>
