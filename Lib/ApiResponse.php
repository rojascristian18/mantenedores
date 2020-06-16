<?php
class ApiResponse
{
	const AUTH_INCOMPLETO					= 'AUTH_INCOMPLETO MSG';
	const AUTH_CLIENTE_INEXISTENTE			= 'AUTH_CLIENTE_INEXISTENTE MSG';
	const AUTH_CLIENTE_CLAVE_ERRONEA		= 'AUTH_CLIENTE_CLAVE_ERRONEA MSG';
	const AUTH_CLIENTE_INACTIVO				= 'AUTH_CLIENTE_INACTIVO MSG';
	const AUTH_FORMULARIO_INEXISTENTE		= 'AUTH_FORMULARIO_INEXISTENTE MSG';
	const AUTH_FORMULARIO_INACTIVO			= 'AUTH_FORMULARIO_INACTIVO MSG';
	private static $clase							= null;

	public static function init($class = null)
	{
		if ( $class )
		{
			self::$clase	= $class;
		}
	}

	public static function code($code = null)
	{
		if ( ! $code )
		{
			return false;
		}

		if ( self::$clase )
		{
			self::$clase->apiCode				= $code;
			self::$clase->apiCodeMessage		= constant("self::$code");
		}

		return false;
	}
}
