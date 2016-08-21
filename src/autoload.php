<?php
/**
* Html Form Helper.
*
* @author Patrick Purcell
* @copyright Copyright (c) 2016 WCP Digital
* @license http://opensource.org/licenses/MIT
* @link http://www.wcpdigital.com.au
* @link http://patrickpurcell.bio
* @version 1.0.0 <20/08/2016>
*/
function phpHtmlFormHelper( $className )
{
	$className = str_replace('\\' , DIRECTORY_SEPARATOR, $className);
	$path = dirname( __FILE__ ).DIRECTORY_SEPARATOR.$className.'.php';
	if( is_readable( $path ) ){
		require_once $path;
	}
	
};

spl_autoload_register('phpHtmlFormHelper');