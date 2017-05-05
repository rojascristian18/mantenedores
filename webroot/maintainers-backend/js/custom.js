/* jshint bitwise:true, browser:true, eqeqeq:true, forin:true, globalstrict:true, indent:4, jquery:true,
   loopfunc:true, maxerr:3, noarg:true, node:true, noempty:true, onevar: true, quotmark:single,
   strict:true, undef:true, white:false */
/* global FB, webroot, fullwebroot */

/*!
 * Books & Bits | Backend
 */

//<![CDATA[
'use strict';

/**
 * jQuery
 */
jQuery(document).ready(function($)
{
	/**
	 * Idioma español datepicker
	 */
	if ( $('.datepicker').length > 0 ) {
		!function(a)
		{
			a.fn.datepicker.dates.es = {
				days			: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				daysShort		: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
				daysMin			: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				months			: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthsShort		: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				today			: 'Hoy',
				clear			: 'Borrar',
				weekStart		: 1,
				defaultDate 	: '2017-01-01',
				format			: 'yyyy-mm-dd'
			}
		}(jQuery);
	}

	/**
	 * Datepicker
	 */
	if ($('.datepicker').length > 0) {
		$('.datepicker').datepicker({
			language	: 'es',
			format		: 'yyyy-mm-dd'
		});
	}

	/**
	 * Masked
	 */
	
	if($("input[class^='mask_']").length > 0){
        $("input.mask_fono").mask('9 9999 9999');
        $("input.mask_ssn").mask('999-99-9999');
        $("input.mask_date").mask('9999-99-99');
        $("input.mask_product").mask('a*-999-a999');
        $("input.mask_phone").mask('99 (999) 999-99-99');
        $("input.mask_phone_ext").mask('99 (999) 999-9999? x99999');
        $("input.mask_credit").mask('9999-9999-9999-9999');
        $("input.mask_percent").mask('99%');
    }


    ;(function($){
		$.fn.rut = function(opt){
			var defaults = $.extend({
				error_html: '<span class="rut-error">Rut incorrecto</span>',
				formatear : true,
				on : 'blur',
				required : true,
				placeholder : true,
				fn_error : function(input){
					mostrar_error(input, defaults.error_html);
				},
				fn_validado: function(input){}
			}, opt);
			return this.each(function(){
				var $t = $(this);
				$t.wrap('<div class="rut-container"></div>');
				$t.attr('pattern', '[0-9]{7,8}-[0-9k]{1}');
				if(defaults.required) $t.attr('required', 'required');
				if(defaults.placeholder) $t.attr('placeholder', '12345678-5');
				if(defaults.formatear){
					$t.on('blur', function(){
						$t.val($.rut.formatear($t.val()));
					});
				}
				$t.on(defaults.on, function(){
					$('.rut-error').remove();
					if($.rut.validar($t.val()) && $.trim($t.val()) != '')
						defaults.fn_validado($t);
					else
						defaults.fn_error($t);
				});
			});
		}
		function mostrar_error(input, error){
			input.closest('.rut-container').append(error);
		}
	})(jQuery);
	jQuery.rut = {
		validar : function(rut){
			if (!/^[0-9]+-[0-9kK]{1}$/.test(rut))
				return false;
			var tmp = rut.split('-');
			var dv = tmp[1], rut 	= tmp[0];
			if(dv == 'K') dv = 'k';
			return ($.rut.dv(rut) == dv);
		},
		dv : function(rut){
			var M=0,S=1;
			for(;rut;rut=Math.floor(rut/10))
				S=(S+rut%10*(9-M++%6))%11;
			return S ? S-1 : 'k';
		},
		formatear : function(rut){
			return rut.replace(/^(\d{7,8})(\w{1})$/, '$1-$2');
		},
		quitar_formato : function(rut){
			rut = rut.split('-').join('').split('.').join('');
			return rut;
		}
	};

	/**
	 * MAsked Rut
	 * @param  {[type]} $('.masked_rut') [description]
	 * @return {[type]}                  [description]
	 */
	if ( $('.masked_rut').length ) {
		$('.masked_rut').rut();
	}


	/**
	 * Validaciones
	 */
	// Validation Engine init
	if ($('.validate').length) {
		$('.validate').validate({
            rules: {                                            
                'data[Usuario][email]': {
                        required: true,
                        email: true
                },
                'data[Usuario][clave]': {
                        required: false,
                        minlength: 4,
                        maxlength: 15
                },
                'data[Usuario][clave_nueva]': {
                        required: false,
                        minlength: 4,
                        maxlength: 15,
                },
                'data[Usuario][rep_clave_nueva]': {
                        required: false,
                        minlength: 4,
                        maxlength: 15,
                        equalTo: '#UsuarioClaveNueva'
                },
                'data[Usuario][nombre]': {
                        required: true,
                        maxlength: 30,
                },
                'data[Usuario][apellidos]': {
                        required: true,
                        maxlength: 70,
                },
                'data[Usuario][fono]': {
                        required: true,
                        maxlength: 11,
                }
            },
            messages: {                                            
                'data[Usuario][email]': {
                        required: 'Requerido',
                        email: 'Ingrese un email válido'
                },
                'data[Usuario][clave]': {
                        minlength: 'Largo mínimo: 5',
                        maxlength: 'Largo máxmimo: 5'
                },
                'data[Usuario][clave_nueva]': {
                        minlength: 'Largo mínimo: 5',
                        maxlength: 'Largo máxmimo: 5'
                },
                'data[Usuario][rep_clave_nueva]': {
                        minlength: 'Largo mínimo: 5',
                        maxlength: 'Largo máxmimo: 5',
                        equalTo: 'Las contraseñas no coinciden'
                },
                'data[Usuario][nombre]': {
                        required: 'Requerido',
                        maxlength: 'Largo permitido 30'
                },
                'data[Usuario][apellidos]': {
                        required: 'Requerido',
                        maxlength: 'Largo permitido: 70'
                },
                'data[Usuario][fono]': {
                        required: 'requerido',
                        maxlength: '',
                },
                'data[Usuario][rut]': {
                        required: 'requerido'
                }
            }                                       
        });
	}


	/**
	 * Agregar un nuevo clon
	 */
	$('.js-clon-agregar').on('click', function(evento, data)
	{
		evento.preventDefault();

		var $this			= $(this),
			$scope			= $this.parents('.js-clon-scope').first(),
			$base			= $('.js-clon-base', $scope),
			$contenedor		= $('.js-clon-contenedor', $scope),
			$clon			= $base.clone(),
			$tr;

		/**
		 * Hace visible al elemento clonado y quita los atributos de deshabilitado
		 */
		$clon.removeClass('hidden js-clon-base');
		$clon.find('input, select, textarea').each(function()
		{
			$(this).removeAttr('disabled');
		});

		/**
		 * Si es accion clonar, copia los datos y escribe la fila bajo la seleccionada
		 */
		if ( typeof(data) === 'object' && typeof(data.clone) !== 'undefined' )
		{
			$tr			= $(data.element).parents('tr').first();
			$tr.find('input, select, textarea').each(function(index)
			{
				$clon.find('input, select, textarea').eq(index).val($(this).val());
			});
			$tr.after($clon.show());
		}

		/**
		 * Si es accion agregar, agrega la fila al final de la tabla
		 */
		else
		{
			$contenedor.append($clon.show());
		}

		/**
		 * Reindexa
		 */
		clonReindexar();

		/**
		 * Actualiza el alto del contenido
		 */
		page_content_onresize();
	});

	/**
	 * Eliminar clon
	 */
	$('.js-clon-contenedor').on('click', '.js-clon-eliminar', function(evento)
	{
		evento.preventDefault();

		var $this			= $(this),
			$tr				= $this.parents('tr').first();

		$tr.remove();

		/**
		 * Reindexa
		 */
		clonReindexar();
	});

	/**
	 * Clonar
	 */
	$('.js-clon-contenedor').on('click', '.js-clon-clonar', function(evento)
	{
		evento.preventDefault();
		var $scope			= $(this).parents('.js-clon-scope').first();
		$('.js-clon-agregar', $scope).trigger('click', { clone: true, element: this });
	});

	/**
	 * Agrega un clon en blanco si es necesario
	 */
	if ( $('.js-clon-blank').length )
	{
		$('.js-clon-blank').parents('.js-clon-scope').find('.js-clon-agregar').trigger('click');
	}

	/**
	 * Reindexa los input clonados, agregados o eliminados
	 */
	function clonReindexar()
	{
		var $contenedor			= $('.js-clon-contenedor');

		$contenedor.find('tr:visible').each(function(index)
		{
			$(this).find('input, select, textarea').each(function()
			{
				var $that		= $(this),
					nombre		= $that.attr('name').replace(/[(\d)]/g, (index + 1));

				$that.attr('name', nombre);
			});
		});
	}
});
//]]>
