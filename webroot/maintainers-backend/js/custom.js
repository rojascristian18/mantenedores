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

    // jQuery Mask Plugin v1.14.10
	// github.com/igorescobar/jQuery-Mask-Plugin
	var $jscomp={scope:{},findInternal:function(a,f,c){a instanceof String&&(a=String(a));for(var l=a.length,g=0;g<l;g++){var b=a[g];if(f.call(c,b,g,a))return{i:g,v:b}}return{i:-1,v:void 0}}};$jscomp.defineProperty="function"==typeof Object.defineProperties?Object.defineProperty:function(a,f,c){if(c.get||c.set)throw new TypeError("ES3 does not support getters and setters.");a!=Array.prototype&&a!=Object.prototype&&(a[f]=c.value)};
	$jscomp.getGlobal=function(a){return"undefined"!=typeof window&&window===a?a:"undefined"!=typeof global&&null!=global?global:a};$jscomp.global=$jscomp.getGlobal(this);$jscomp.polyfill=function(a,f,c,l){if(f){c=$jscomp.global;a=a.split(".");for(l=0;l<a.length-1;l++){var g=a[l];g in c||(c[g]={});c=c[g]}a=a[a.length-1];l=c[a];f=f(l);f!=l&&null!=f&&$jscomp.defineProperty(c,a,{configurable:!0,writable:!0,value:f})}};
	$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(a,c){return $jscomp.findInternal(this,a,c).v}},"es6-impl","es3");
	(function(a,f,c){"function"===typeof define&&define.amd?define(["jquery"],a):"object"===typeof exports?module.exports=a(require("jquery")):a(f||c)})(function(a){var f=function(b,h,e){var d={invalid:[],getCaret:function(){try{var a,n=0,h=b.get(0),e=document.selection,k=h.selectionStart;if(e&&-1===navigator.appVersion.indexOf("MSIE 10"))a=e.createRange(),a.moveStart("character",-d.val().length),n=a.text.length;else if(k||"0"===k)n=k;return n}catch(A){}},setCaret:function(a){try{if(b.is(":focus")){var p,
	d=b.get(0);d.setSelectionRange?d.setSelectionRange(a,a):(p=d.createTextRange(),p.collapse(!0),p.moveEnd("character",a),p.moveStart("character",a),p.select())}}catch(z){}},events:function(){b.on("keydown.mask",function(a){b.data("mask-keycode",a.keyCode||a.which);b.data("mask-previus-value",b.val())}).on(a.jMaskGlobals.useInput?"input.mask":"keyup.mask",d.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){b.keydown().keyup()},100)}).on("change.mask",function(){b.data("changed",!0)}).on("blur.mask",
	function(){c===d.val()||b.data("changed")||b.trigger("change");b.data("changed",!1)}).on("blur.mask",function(){c=d.val()}).on("focus.mask",function(b){!0===e.selectOnFocus&&a(b.target).select()}).on("focusout.mask",function(){e.clearIfNotMatch&&!g.test(d.val())&&d.val("")})},getRegexMask:function(){for(var a=[],b,d,e,k,c=0;c<h.length;c++)(b=m.translation[h.charAt(c)])?(d=b.pattern.toString().replace(/.{1}$|^.{1}/g,""),e=b.optional,(b=b.recursive)?(a.push(h.charAt(c)),k={digit:h.charAt(c),pattern:d}):
	a.push(e||b?d+"?":d)):a.push(h.charAt(c).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));a=a.join("");k&&(a=a.replace(new RegExp("("+k.digit+"(.*"+k.digit+")?)"),"($1)?").replace(new RegExp(k.digit,"g"),k.pattern));return new RegExp(a)},destroyEvents:function(){b.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(a){var d=b.is("input")?"val":"text";if(0<arguments.length){if(b[d]()!==a)b[d](a);d=b}else d=b[d]();return d},calculateCaretPosition:function(a,d){var h=
	d.length,e=b.data("mask-previus-value")||"",k=e.length;8===b.data("mask-keycode")&&e!==d?a-=d.slice(0,a).length-e.slice(0,a).length:e!==d&&(a=a>=k?h:a+(d.slice(0,a).length-e.slice(0,a).length));return a},behaviour:function(e){e=e||window.event;d.invalid=[];var h=b.data("mask-keycode");if(-1===a.inArray(h,m.byPassKeys)){var h=d.getMasked(),c=d.getCaret();setTimeout(function(a,b){d.setCaret(d.calculateCaretPosition(a,b))},10,c,h);d.val(h);d.setCaret(c);return d.callbacks(e)}},getMasked:function(a,b){var c=
	[],p=void 0===b?d.val():b+"",k=0,g=h.length,f=0,l=p.length,n=1,v="push",w=-1,r,u;e.reverse?(v="unshift",n=-1,r=0,k=g-1,f=l-1,u=function(){return-1<k&&-1<f}):(r=g-1,u=function(){return k<g&&f<l});for(var y;u();){var x=h.charAt(k),t=p.charAt(f),q=m.translation[x];if(q)t.match(q.pattern)?(c[v](t),q.recursive&&(-1===w?w=k:k===r&&(k=w-n),r===w&&(k-=n)),k+=n):t===y?y=void 0:q.optional?(k+=n,f-=n):q.fallback?(c[v](q.fallback),k+=n,f-=n):d.invalid.push({p:f,v:t,e:q.pattern}),f+=n;else{if(!a)c[v](x);t===x?
	f+=n:y=x;k+=n}}p=h.charAt(r);g!==l+1||m.translation[p]||c.push(p);return c.join("")},callbacks:function(a){var f=d.val(),p=f!==c,g=[f,a,b,e],k=function(a,b,d){"function"===typeof e[a]&&b&&e[a].apply(this,d)};k("onChange",!0===p,g);k("onKeyPress",!0===p,g);k("onComplete",f.length===h.length,g);k("onInvalid",0<d.invalid.length,[f,a,b,d.invalid,e])}};b=a(b);var m=this,c=d.val(),g;h="function"===typeof h?h(d.val(),void 0,b,e):h;m.mask=h;m.options=e;m.remove=function(){var a=d.getCaret();d.destroyEvents();
	d.val(m.getCleanVal());d.setCaret(a);return b};m.getCleanVal=function(){return d.getMasked(!0)};m.getMaskedVal=function(a){return d.getMasked(!1,a)};m.init=function(c){c=c||!1;e=e||{};m.clearIfNotMatch=a.jMaskGlobals.clearIfNotMatch;m.byPassKeys=a.jMaskGlobals.byPassKeys;m.translation=a.extend({},a.jMaskGlobals.translation,e.translation);m=a.extend(!0,{},m,e);g=d.getRegexMask();if(c)d.events(),d.val(d.getMasked());else{e.placeholder&&b.attr("placeholder",e.placeholder);b.data("mask")&&b.attr("autocomplete",
	"off");c=0;for(var f=!0;c<h.length;c++){var l=m.translation[h.charAt(c)];if(l&&l.recursive){f=!1;break}}f&&b.attr("maxlength",h.length);d.destroyEvents();d.events();c=d.getCaret();d.val(d.getMasked());d.setCaret(c)}};m.init(!b.is("input"))};a.maskWatchers={};var c=function(){var b=a(this),c={},e=b.attr("data-mask");b.attr("data-mask-reverse")&&(c.reverse=!0);b.attr("data-mask-clearifnotmatch")&&(c.clearIfNotMatch=!0);"true"===b.attr("data-mask-selectonfocus")&&(c.selectOnFocus=!0);if(l(b,e,c))return b.data("mask",
	new f(this,e,c))},l=function(b,c,e){e=e||{};var d=a(b).data("mask"),h=JSON.stringify;b=a(b).val()||a(b).text();try{return"function"===typeof c&&(c=c(b)),"object"!==typeof d||h(d.options)!==h(e)||d.mask!==c}catch(u){}},g=function(a){var b=document.createElement("div"),c;a="on"+a;c=a in b;c||(b.setAttribute(a,"return;"),c="function"===typeof b[a]);return c};a.fn.mask=function(b,c){c=c||{};var e=this.selector,d=a.jMaskGlobals,h=d.watchInterval,d=c.watchInputs||d.watchInputs,g=function(){if(l(this,b,
	c))return a(this).data("mask",new f(this,b,c))};a(this).each(g);e&&""!==e&&d&&(clearInterval(a.maskWatchers[e]),a.maskWatchers[e]=setInterval(function(){a(document).find(e).each(g)},h));return this};a.fn.masked=function(a){return this.data("mask").getMaskedVal(a)};a.fn.unmask=function(){clearInterval(a.maskWatchers[this.selector]);delete a.maskWatchers[this.selector];return this.each(function(){var b=a(this).data("mask");b&&b.remove().removeData("mask")})};a.fn.cleanVal=function(){return this.data("mask").getCleanVal()};
	a.applyDataMask=function(b){b=b||a.jMaskGlobals.maskElements;(b instanceof a?b:a(b)).filter(a.jMaskGlobals.dataMaskAttr).each(c)};g={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&g("input"),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},
	S:{pattern:/[a-zA-Z]/}}};a.jMaskGlobals=a.jMaskGlobals||{};g=a.jMaskGlobals=a.extend(!0,{},g,a.jMaskGlobals);g.dataMask&&a.applyDataMask();setInterval(function(){a.jMaskGlobals.watchDataMask&&a.applyDataMask()},g.watchInterval)},window.jQuery,window.Zepto);
	

	if($("input[class^='mask_']").length > 0){
        $("input.mask_fono").mask('9 9999 9999');
        $("input.mask_money").mask('000.000.000.000.000', {reverse: true});
        $("input.mask_medida").mask('99999999999.000000', {
        	onKeyPress: function(cep, event, current, options) {
        		var partes = cep.split('.');
        		var valor = '';
        		if ( typeof(partes[1]) != 'undefined' && partes[1].length < 6) {
        			var faltan = 6 - partes[1].length 
        			console.log(faltan);
        			for (var i = 0; i < faltan; i++) {
        				partes[1] = partes[1] + '0';
        			};
        			valor = partes[0] + '.' + partes[1];
        			current.val(valor);
        		}

        		if(typeof(partes[1]) == 'undefined') {
        			current.val( cep + '.000000' );
        		}
        	}
        });
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
                        minlength: 11
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
                        minlength: 'Ingrese 9 dígitos',
                },
                'data[Usuario][rut]': {
                        required: 'requerido'
                }
            }                                       
        });
	}

	/**
	 * Validate product
	 */

	if ( $('.validate-product').length ) {
		var validateProduct = $('.validate-product').validate({
			rules: {
				'data[Producto][grupocaracteristica_id]': {
					required: true
				},
				'data[Producto][fabricante_id]': {
					required: true
				},
				'data[Producto][nombre]': {
					required: true,
					minlength: 1,
                    maxlength: 70
				},
				'data[Producto][referencia]': {
					required: true,
					minlength: 2,
                    maxlength: 32
				},
				'data[Producto][descripcion_corta]': {
					required: true,
					minlength: 50,
					maxlength: 800
				},
				'data[Producto][descripcion]': {
					required: true,
				},
				'data[Producto][precio]': {
					required: true,
				},
				'data[Producto][largo]': {
					required: true,
				},
				'data[Producto][alto]': {
					required: true,
				},
				'data[Producto][profundidad]': {
					required: true,
				},
				'data[Producto][peso]': {
					required: true,
				},
				'data[Producto][peso]': {
					required: true,
				}

			},
			messages: {
				'data[Producto][grupocaracteristica_id]': {
					required: 'Requerido'
				},
				'data[Producto][fabricante_id]': {
					required: 'Requerido'
				},
				'data[Producto][nombre]': {
					required: 'Requerido',
					minlength: '1 carácteres mínimo',
                    maxlength: '70 carácteres máximo'
				},
				'data[Producto][referencia]': {
					required: 'Requerido',
					minlength: '2 carácteres mínimo',
                    maxlength: '32 carácteres máximo'
				},
				'data[Producto][descripcion_corta]': {
					required: 'Requerido',
					minlength: '50 carácteres mínimo',
					maxlength: '800 carácteres máximo'
				},
				'data[Producto][descripcion]': {
					required: 'Requerido',
				},
				'data[Producto][precio]': {
					required: "Requerido",
				},
				'data[Producto][largo]': {
					required: 'Requerido',
				},
				'data[Producto][alto]': {
					required: 'Requerido',
				},
				'data[Producto][profundidad]': {
					required: 'Requerido',
				},
				'data[Producto][peso]': {
					required: 'Requerido',
				}
			}
		});

		$.validator.messages.number = 'Ingrese solo números';
		$.validator.messages.pattern = 'Carácteres no válidos';
		$.validator.messages.required = 'Requerido';
		$.validator.messages.url = 'URL no válida';

		$.validator.addClassRules('not-blank', {
			required: true  	
		});

		$.validator.addClassRules('is-url', {
			required: true,
			url : true  	
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

		var $this				= $(this),
			$tr					= $this.parents('tr').first(),
			$inputHide 			= $this.parents('tr').first().find('input[type="hidden"]'),
			inputEliminadosVal 	= $('#ElementosEliminados').val();
	
		// Lo agegamos al input de elementos eliminados separados por coma(,)
		if ( inputEliminadosVal != "" ) inputEliminadosVal += ",";

		inputEliminadosVal += $inputHide.val();

		console.info('Inputs eliminados: ' + inputEliminadosVal);
		$('#ElementosEliminados').val(inputEliminadosVal);


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


	/* Extended summernote editor */
    if($(".summernote").length > 0){
        $(".summernote").summernote({
        	lang: 'es-ES',
        	height: 200,
	        toolbar: [
		        ['font', ['bold', 'underline', 'clear']],
		        ['para', ['ul', 'ol', 'paragraph']],
		        ['table', ['table']],
		        ['view', [ 'help']]
			]
        });
    }

    if($(".summernote-small").length > 0){
        $(".summernote-small").summernote({
        	lang: 'es-ES',
        	height: 100,
	        toolbar: [
		        ['font', ['bold', 'underline', 'clear']],
		        ['para', ['ul', 'ol', 'paragraph']],
			]
        });
    }

    function insertarNombreFinal() {
    	var $campo = $('.input_nombre_final');
    	console.info($('.string_nombre_final').text());
    	$campo.val( $('.string_nombre_final').text() );
    }

    function doNoAplica(element, agregar_texto) {
    	var $input = element.parent().siblings('input');

    	if (element.prop('checked')) {

			// Guarda el pattern en un atributo data para restaurarlo si es necesario
			// y se remueve para que no valide el campo para cuando se agregue el texto No aplica
			$input.attr('data-pattern', $input.attr('pattern'));
			$input.removeAttr('pattern');

			if (typeof(agregar_texto) != 'undefined') {
				$input.val('Ingrese texto');
			}
		}else{

			// Se recetea el input agregandole nuevamente la validación pattern
			if($input.data('pattern').length) {
				$input.attr('pattern', $input.data('pattern'));
			}
			$input.val('');	
		}
    }

    // No aplica
   	function noAplica() {
   		$('.js-no-aplica').on('click', function(){
   			doNoAplica($(this), true);
		});

		$('.js-no-aplica').each(function(){
			doNoAplica($(this));
		});
   	}


    function obtenerTablaCaracteristicas(grupo) {
    	var $contexto 	= $('#caracteristicas'),
    		$producto 	= $('#ProductoId').val();

    	if (typeof(grupo) != 'undefined' && typeof($producto) == 'undefined') {
    		$.get( webroot + 'maintainers/productos/obtenerEspecificaciones/' + grupo, function(respuesta){
				$contexto.find('.js-add').eq(0).html(respuesta);
				noAplica();
		  	})
		  	.fail(function(){
				$contexto.find('.js-add').eq(0).html(respuesta);
			});
    	}

    	if (typeof(grupo) != 'undefined' && typeof($producto) != 'undefined') {
    		$.get( webroot + 'maintainers/productos/obtenerEspecificaciones/' + grupo + '/' + $producto, function(respuesta){
    			$contexto.find('.js-add').eq(0).html(respuesta);
    			noAplica();
		  	})
		  	.fail(function(){
				$contexto.find('.js-add').eq(0).html(respuesta);
			});
    	}

    }


    function obtenerTablaCompetidores(grupo) {
    	var $contexto 	= $('#competencias'),
    		$producto 	= $('#ProductoId').val();

    	if (typeof(grupo) != 'undefined' && typeof($producto) == 'undefined') {
    		$.get( webroot + 'maintainers/productos/obtenerCompetidores/' + grupo, function(respuesta){
				$contexto.find('.js-competidor-add').eq(0).html(respuesta);
				noAplica();
		  	})
		  	.fail(function(){
				$contexto.find('.js-competidor-add').eq(0).html(respuesta);
			});
    	}

    	if (typeof(grupo) != 'undefined' && typeof($producto) != 'undefined') {
    		$.get( webroot + 'maintainers/productos/obtenerCompetidores/' + grupo + '/' + $producto, function(respuesta){
    			$contexto.find('.js-competidor-add').eq(0).html(respuesta);
    			noAplica();
		  	})
		  	.fail(function(){
				$contexto.find('.js-competidor-add').eq(0).html(respuesta);
			});
    	}

    }

    /**
     * Preview de nombre de productos
     * @param  {[type]} $('.string_nombre_final').length [description]
     * @return {[type]}                                  [description]
     */
    if ($('.string_nombre_final').length) {

    	$(document).ready(function(){
    		$('.string_nombre_final .nombre_preview').html($('.string_nombre').val());

    		$('.string_nombre_final .referencia_preview').html($('.string_referencia').val());

    		var nombreGrupo = $('.string_grupo').find('option:selected').text();
    		if ($('.string_grupo').val() === '') {
    			nombreGrupo = '';
    		}

    		$('.string_nombre_final .grupo_preview').html(nombreGrupo);

    		var nombreMarca = $('.string_marca').find('option:selected').text();
    		if ($('.string_marca').val() === '') {
    			nombreMarca = '';
    		}
    		console.log(nombreMarca);
    		$('.string_nombre_final .marca_preview').html(nombreMarca);

    		insertarNombreFinal();
    		obtenerTablaCaracteristicas($('.string_grupo').val());
    		obtenerTablaCompetidores($('.string_grupo').val());
    	});

    	$('.string_nombre').on('keyup', function(event){
    		$('.string_nombre_final .nombre_preview').html($('.string_nombre').val());

    		insertarNombreFinal();
    	});

    	$('.string_referencia').on('keyup', function(event){
    		$('.string_nombre_final .referencia_preview').html($('.string_referencia').val());

    		insertarNombreFinal();
    	});

    	$('.string_grupo').on('change', function(){
    		var nombreGrupo = $(this).find('option:selected').text();
    		if ($(this).val() === '') {
    			nombreGrupo = '';
    		}

    		$('.string_nombre_final .grupo_preview').html(nombreGrupo);

    		insertarNombreFinal();
    		obtenerTablaCaracteristicas($(this).val());
    		obtenerTablaCompetidores($(this).val());
    	});

    	$('.string_marca').on('change', function(){
    		var nombreMarca = $(this).find('option:selected').text();
    		if ($(this).val() === '') {
    			nombreMarca = '';
    		}

    		$('.string_nombre_final .marca_preview').html(nombreMarca);

    		insertarNombreFinal();
    	});
    }


    //Bootstrap file input
    if($("input.fileinput").length > 0){
        $("input.fileinput").bootstrapFileInput();
    }
	//END Bootstrap file input


	//Bootstrap Popover
    $('body').popover({selector : '.popover-dismiss', placement : 'auto'});
    	

	// Carrusel
	if($(".owl-carousel").length > 0){
        $(".owl-carousel").owlCarousel({mouseDrag: true, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
    }
    
});
//]]>
