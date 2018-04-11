$(function() {

	$.fn.extend({	
	// Devuelve true si el elemento está en window
	isInScene : function(arg)
		{	
			// Fuerza que arg sea un objeto
			arg = arg || {};
			// Valor por defecto de desfase
			arg.desfase = arg.desfase || 0;
			// Fuerza a que desfase sea númerico
			arg.desfase = parseInt(arg.desfase,10);
	 
			// Posición vertical del elemento respecto al principio del documento
			var pos_container = $(this).offset().top;
	 
			// Altura del elemento
			var container_height = $(this).outerHeight();
	 
			// Posición vertical de document
			var pos_document = $(document).scrollTop();
	 
			// Alto ventana
			var window_height = $(window).height();	
	 
			return (pos_document+window_height > pos_container+arg.desfase && pos_container+container_height > pos_document+arg.desfase);
		}
	});

	var comentarios = function(){

		var limit 	= 3, 
			offset 	= 0,
			slice   = 1,
			semaforoVisualizado = true;

		var slideMenu = function(){
			if ($('#sliding_menu').length) {
				 $('#sliding_menu').menu();
			}
		} 

	    var uiScroller = function(){

	        if($(".scroll").length > 0){
	            $(".scroll").mCustomScrollbar({axis:"y", autoHideScrollbar: true, scrollInertia: 20, advanced: {autoScrollOnFocus: false}});
	        }
	    }

        var feBsFileInput = function(){
        	// Aplica solo para Admin
            if($("input.fileinput").length > 0 && $('.mantainers .sidebar').length == 0){
                $("input.fileinput").bootstrapFileInput();
            }
        }
        
        var validarFormularioEnviar = function($formulario, $tipo) {
        	
        	$formulario.validate({
				rules: {
					'data[Comentario][tarea_id]': {
						required: true
					},
					'data[Comentario][comentario]': {
						required: true
					}
				},
				messages: {
					'data[Comentario][tarea_id]': {
						required: 'Requerido'
					},
					'data[Comentario][comentario]': {
						required: 'Requerido'
					},
					'data[Usuario][medio_de_pago]': {
						required: 'Requerido'
					}
				},
				submitHandler: function(form) {
					var selector 	= '#' + form.getAttribute('id') + ' .respuestaMessage';
				    var data 		= new FormData(document.getElementById($formulario.attr('id')));

        			procesandoFormulario($formulario);

        			$.ajax({
			            type: 'post',
			            url: $formulario.attr('action'),
			            dataType: 'html',
			            data: data,
			            cache: false,
			            processData: false,
                		contentType: false,
			            success: function (data, textStatus, jqXHR) {
			              	
			              	var response = $.parseJSON(data);
			            	
			            	if(response.code == 200)
			            	{	
			            		cuadroRespuesta(selector, response.message, response.code);
			            		limpiarFormulario($formulario);

			            		if ($tipo == 'modal') {
			            			// Refrescar listado de comentarios
			            			obtenerComentariosPorTareaId($formulario.find('#ComentarioTareaId').val());
			            		}

			            		// Refrescar tareas
			            		actualizarTareas();
			            		
			            	}

			            	if (response.code == 500)
			            	{
			            		cuadroRespuesta(selector, response.message, response.code);
			            	}

			            	finalizadoFormulario($formulario);

			            },
			            error: function(jqXHR, textStatus, errorThrown){
					        cuadroRespuesta(selector, 'Error inseperado. Intene nuevamente.', 500);
					        limpiarFormulario($formulario);
					        finalizadoFormulario($formulario);  
					    }
			        });

			        return false;
				  }
			});
        }

        var toogleFormulario = function(){
        	if ($('#FormularioComentarios').length) {

        		var collapsedTexto 	= 'Cancelar <i class="fa fa-close" aria-hidden="true"></i>',
        			texto			= 'Escribir mensaje';


        		$('.btn-toggle-formulario').on('click', function(){

        			var btn = $(this);

        			$('#FormularioComentarios').on('show.bs.collapse', function () {
					  btn.html(collapsedTexto);
					});

					$('#FormularioComentarios').on('hide.bs.collapse', function () {
					  btn.html(texto);
					});
        		});
        	}
        }

        var cuadroRespuesta = function(selector, respuesta, codigo){
        	console.log(selector)
        	var contexto = $(selector),
        		titulo = contexto.find('.cardTitle'),
        		btn = contexto.find('.btn-toggle-respuesta');

        		if (codigo == 200) {
        			contexto.addClass('success');
        			titulo.html(respuesta);

        			if (btn.hasClass('reintentar')) {
        				btn.removeClass('reintentar');
        			}

        			btn.addClass('aceptar');
        			btn.html('Aceptar <i class="fa fa-check" aria-hidden="true"></i>');
        		}	

        		if (codigo == 500) {
        			contexto.addClass('error');
        			titulo.html(respuesta);
        			
        			if (btn.hasClass('aceptar')) {
        				btn.removeClass('aceptar');
        			}
        			
        			btn.addClass('reintentar');
        			btn.html('Volver a intentar <i class="fa fa-paper-plane" aria-hidden="true"></i>');
        		}


        	$('body').on('click', selector + ' .btn-toggle-respuesta', function(){
        		if ($(this).hasClass('aceptar')) {
        			$(selector).removeClass('success');
        			$(selector + ' .btn-toggle-formulario').trigger('click');
        		}

        		if ($(this).hasClass('reintentar')) {
        			$(selector).removeClass('error');
        		}

        	});
        }

        var limpiarFormulario = function($formulario){
        	$.each($formulario.find('textarea, select'), function(){
        		$(this).val('');
        	});

        	$formulario.find('.fileinput > span').text('Seleccione archivo');
        	$formulario.find('.fileinput').attr('title', 'Seleccione archivo');
        }

        var procesandoFormulario = function($formulario) {
        	$.each($formulario.find('input, textarea, select, button'), function(){
        		$(this).attr('disabled', 'disabled');
        	});
        }

        var finalizadoFormulario = function($formulario) {
        	$.each($formulario.find('input, textarea, select, button'), function(){
        		$(this).removeAttr('disabled');
        	});
        }

        var enviarFormulario = function() {
        	if ($('#FormularioComentarios').length) {
        		
        		var $formulario = $('#FormularioComentarios');

        		limpiarFormulario($formulario);
        		validarFormularioEnviar($formulario, 'lista');
        	}
        }

        var actualizarTareas = function(formularioId){
        	offset = 0;
        	$('#actualizarTareas').attr('disabled', 'disabled');
        	$('#listadoTareasAjax .list-group').html('');
        	$('#listadoTareasAjaxModal .modal-body-comentarios').html('');
        	obtenerTareas();
        }

        var obtenerTareas = function(){

        	var id = $('.sidebar').data('id');
        	var role = $('.sidebar').data('role');

        	if ($('#listadoTareasAjax').length && id != '' && role != '' ) {
        		$.get( webroot + '/comentarios/obtenerTareasComentarios/' + id + '/' + role + '/' + limit + '/' + offset, function(respuesta){
					$res = $.parseJSON(respuesta);
					
					if ($res.code == 200) {
						$('#listadoTareasAjax .list-group').append($res.data);
						offset = offset + slice;

						verComentariosTarea();
						$('#actualizarTareas').removeAttr('disabled');
					}
					
					if ($res.code == 400) {
						$('#listadoTareasAjax .list-group').html($res.data);
						$('#actualizarTareas').removeAttr('disabled');
					}
		      	})
		      	.fail(function(){

		      		console.info('fail');
					
				});
        	}
        }

        var verComentariosTarea = function(){

        	$(document).on('click', '.btn-tarea', function(){
        		var $this 					= $(this),
        			$comentarios 			= $($this.attr('href')).html(),
        			$modal 					= $('#listadoTareasAjaxModal'),
        			$idTarea 				= $this.data('id'),
        			$tituloModal 			= $modal.find('.modal-title').eq(0),
        			$contenedorResultado 	= $modal.find('.modal-body-comentarios').eq(0);

        			$tituloModal.html('<i class="fa fa-comments"></i> Mensajes de ' + $this.text());
        			obtenerComentariosPorTareaId($idTarea);
        			$modal.modal('show');

        			var $formulario = $('#FormularioComentariosModal');
        			
        			$formulario.find('#ComentarioTareaId').val($idTarea);
					
	        		limpiarFormulario($formulario);
	        		validarFormularioEnviar($formulario, 'modal');

	        		// Comienza la actualización automática de mensajes
	        		modalComentarios();
        			
        	});

        }

        var obtenerComentariosPorTareaId = function($id){

        	var idUser 		= $('.sidebar').data('id');
        	var roleUser 	= $('.sidebar').data('role');

        	if ( $id != '' && idUser != '' && roleUser != '' ) {
        		$.get( webroot + '/comentarios/obtenerComentariosPorTareaId/' + idUser + '/' + roleUser + '/' + $id, function(respuesta){
					$res = $.parseJSON(respuesta);
					
					if ($res.code == 200) {
						$('#listadoTareasAjaxModal .modal-body-comentarios').html($res.data);
						scrollVisualizar();
					}
					
					if ($res.code == 400) {
						$('#listadoTareasAjaxModal .modal-body-comentarios').html($res.data);
					}
		      	})
		      	.fail(function(){

		      		console.info('fail');
					
				});
      	  	}
      
        }

        var comentarioVisualizado = function(id, contexto)
        {	
        	var totalcomentarios = parseInt($('#count_mensajes').text());

        	$.get( webroot + '/comentarios/visualizado/' + id, function(respuesta){
				$res = $.parseJSON(respuesta);
				
				if ($res.code == 200) {
					contexto.find('span.visto').html('<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>');
					if (totalcomentarios > 0) {
						totalcomentarios = totalcomentarios - 1;
						$('#count_mensajes').text(totalcomentarios);
					}
				}

				console.log($res.message);

				semaforoVisualizado = true;
	      	})
	      	.fail(function(){

	      		console.info('fail');
				
			});
        }

        var scrollVisualizar = function(){

        	$('.messages .item.not-my').each(function(){
        		var $this = $(this);
        		
    			if ($this.isInScene() && $this.find('i.visto').length == 0 && semaforoVisualizado == true) {
        			comentarioVisualizado($this.find('.heading a').data('id'), $this);
        			semaforoVisualizado = false;
        		}

        		$('.modal-body-comentarios').scroll(function(){
	        		if ($this.isInScene() && semaforoVisualizado == true && $this.find('i.visto').length == 0 ) {
	        			comentarioVisualizado($this.find('.heading a').data('id'), $this);
	        			semaforoVisualizado = false;
	        		}
	        	});
 
        	});
        }

        var modalComentarios = function(){

        	var refrescarComentarios;

        	if ($('#listadoTareasAjaxModal').length) {
        		// Si el modal está abierto refresca los mensajes cada 15 segundos.
        		$('#listadoTareasAjaxModal').on('shown.bs.modal', function(e){

        			$id = $('#FormularioComentariosModal').find('#ComentarioTareaId').val();

        			refrescarComentarios = setInterval(function(){
        				obtenerComentariosPorTareaId($id);
        			}, 15000);
        		});

        		// Si el modal está cerrado se deja de actualizar.
        		$('#listadoTareasAjaxModal').on('hidden.bs.modal', function(e){
        			clearInterval(refrescarComentarios);
        		});
        	}
        }

        var btnActualizarTareas = function(){
        	if ($('#actualizarTareas').length) {
        		$('#actualizarTareas').on('click', function(){
        			actualizarTareas();
        		});
        	}
        }

        var tareaSeleccionada = function(){
        	if ($('#tarea_container').length) {
        		$('select[name="data[Comentario][tarea_id]"] option[value="' + $('#tarea_container').data('tarea') + '"]').prop('selected', true);
        	}
        }

		return {
			init: function(){
				uiScroller();
				feBsFileInput();
				enviarFormulario();
				toogleFormulario();
				obtenerTareas();
				btnActualizarTareas();
				slideMenu();
				tareaSeleccionada();
			}
		}
	}();


	comentarios.init();

});