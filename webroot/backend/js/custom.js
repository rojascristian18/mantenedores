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
	var todo = '';

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

	/**
	 * Seleccionar/Deseleccionar todo
	 */
	if ( $('#seleccionar-todo-lista').length ) {
		$('#seleccionar-todo-lista').on('click', function() {
			if ($(this).prop('checked')) {
				console.info('Seleccionar todos');
				$(this).parents('.table').eq(0).find('.lista-check').prop('checked', true);
			}else{
				console.info('Deseleccionar todos');
				$(this).parents('.table').eq(0).find('.lista-check').prop('checked', false);
			}
		});
	}

	/**
	 * Data tables
	 */
	 if($(".datatable").length > 0){
        $(".datatable").dataTable();
        $(".datatable").on('page.dt',function () {
            onresize(100);
        });
    }

    /**
     * Buscardo de caracteristicas
     * @param  {[type]} $('.input-caracteristica-buscar').lenght [description]
     * @return {[type]}                                          [description]
     */
    
    if ($('.input-caracteristicas-buscar').length > 0) {
    	
    	// Se limpia el campo
    	$('.input-caracteristicas-buscar').val('');

    	$('.input-caracteristicas-buscar').each(function(){
			var $esto 	= $(this),
				grupoId = 0;

			if ( $('#GrupocaracteristicaId').length > 0 ) {
				grupoId = $('#GrupocaracteristicaId').val();
			}
			
			// Se buscan las características
			$esto.autocomplete({
			   	source: function(request, response) {
			      	$.get( webroot + 'admin/grupocaracteristicas/buscarCaracteristicas/' + request.term + '/' + grupoId, function(respuesta){
						response( $.parseJSON(respuesta) );
			      	})
			      	.fail(function(){

						noty({text: 'Ocurrió un error al obtener la información. Intente nuevamente.', layout: 'topRight', type: 'error'});

						setTimeout(function(){
							$.noty.closeAll();
						}, 10000);
					});
			    },
			    select: function( event, ui ) {
			        console.log("Seleccionado: " + ui.item.value + " id " + ui.item.id);
			        todo = ui.item.todo;
			    },
			    open: function(event, ui) {
	                var autocomplete = $(".ui-autocomplete:visible");
	                var oldTop = autocomplete.offset().top;
	                var width  = $esto.width();
	                var newTop = oldTop - $esto.height() + 25;

	                autocomplete.css("top", newTop);
	                autocomplete.css("width", width);
	                autocomplete.css("position", 'absolute');
	            }
			});
	    });

	    // Botón agregar característica a la lista
		$('.button-caracteristicas-buscar').on('click', function(event) {
			event.preventDefault();

			$('#tablaCaracteristicas tbody').append(todo);
			$('.input-caracteristicas-buscar').val('');
		});

		// Botón quitar característica de la lista
		$(document).on('click', '.quitar', function(event){
			event.preventDefault();
			$(this).parents('tr').eq(0).remove();
		});
	}
});
//]]>
