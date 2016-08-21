<?php
namespace WCPDigital\Html;

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
class FormHelper
{
	const CSRF_TOKEN_KEY = '__csrf__';
	
	const INPUT_TEXT      = 'text'; 
	const INPUT_NUMBER    = 'number'; 
	const INPUT_DATETIME  = 'datetime'; 
	const INPUT_DATE      = 'date'; 
	const INPUT_TIME      = 'time'; 
	const INPUT_MONTH      = 'month'; 
	const INPUT_WEEK      = 'week'; 
	const INPUT_EMAIL     = 'email'; 
	const INPUT_TEL       = 'tel'; 
	const INPUT_URL       = 'url'; 
	const INPUT_SEARCH    = 'search'; 
	const INPUT_COLOR      = 'color'; 
	const INPUT_RANGE      = 'range'; 
	
	const INPUT_PASSWORD = 'password'; 
	const INPUT_HIDDEN   = 'hidden';
	const INPUT_CHECKBOX = 'checkbox'; 
	const INPUT_RADIO    = 'radio'; 
	const INPUT_FILE     = 'file'; 
	const INPUT_SELECT   = 'select'; 
	const INPUT_TEXTAREA = 'textarea'; 
	
	const BUTTON_SUBMIT  = 'submit';
	const BUTTON_RESET   = 'reset'; 
	const BUTTON         = 'button'; 
	
	const REQUEST_POST = 'POST';
	const REQUEST_GET = 'GET';
	const REQUEST_PUT = 'PUT';
	const REQUEST_DELETE = 'DELETE';
	const REQUEST_HEAD = 'HEAD';
	
	const RULE_USERNAME = 'username';
	const RULE_EMAIL = 'email';
	const RULE_TEL = 'tel';
	const RULE_URL = 'url';
	const RULE_NUMBER = 'number';
	const RULE_DIGITS = 'digits';
	const RULE_DATEISO = 'dateiso';
	const RULE_CREDITCARD = 'creditcard';
	
	/**
	* HTML Label.
	*
	* @param string $for.
	* @param string $text.
	* @param array $attrs.
	*
	* @return string.
	*/
	public function label($for, $text = '', array $attrs = array() )
	{
		$attributes = $this->attributes( $attrs );
		return '<label for="'.$for.'" '.$attributes.' >'.$text.'</label>';
	}
	
	/**
	* HTML Link .
	*
	* @param string $url.
	* @param string $text.
	* @param array $attrs.
	*
	* @return string.
	*/
	public function link($url, $text = '', array $attrs = array() )
	{
		$attributes = $this->attributes( $attrs );
		return '<a href="'.$url.'" '.$attributes.' >'.$text.'</a>';
	}
	
	/**
	* HTML input.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	* @param string $type.
	*
	* @return string.
	*/		
	public function input($name, $value = '', array $attrs = array(), $type = self::INPUT_TEXT  )
	{
		$attributes = $this->attributes( $attrs );
		return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$attributes.' >';
	}
	
	/**
	* HTML Hidden input.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function hidden($name, $value = '', array $attrs = array() )
	{
		return $this->input($name, $value, $attrs, self::INPUT_HIDDEN );
	}
			
	/**
	* HTML Text input.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function text($name, $value = '', array $attrs = array() )
	{
		return $this->input($name, $value, $attrs, self::INPUT_TEXT );
	}
	
	/**
	* HTML Email input.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function email($name, $value = '', array $attrs = array() )
	{
		return $this->input($name, $value, $attrs, self::INPUT_EMAIL );
	}
	
	/**
	* HTML Password input.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/	
	public function password($name, $value = '', array $attrs = array() )
	{
		return $this->input($name, $value, $attrs, self::INPUT_PASSWORD );
	}

	/**
	* HTML Checkbox input.
	*
	* @param string $name.
	* @param string $value.
	* @param bool $checked.
	* @param array $attrs.
	*
	* @return string.
	*/	
	public function checkbox($name, $value = '', $checked = false, array $attrs = array() )
	{
		if( $checked ){
			$attrs['checked'] = 'checked';
		}
		return $this->input($name, $value, $attrs, self::INPUT_CHECKBOX );
	}

	/**
	* HTML Radio input.
	*
	* @param string $name.
	* @param string $value.
	* @param bool $checked.
	* @param array $attrs.
	*
	* @return string.
	*/	
	public function radio($name, $value = '', $checked = false, array $attrs = array() )
	{
		if( $checked ){
			$attrs['checked'] = 'checked';
		}
		return $this->input($name, $value, $attrs, self::INPUT_RADIO );
	}
	
	/**
	* HTML File input.
	*
	* @param string $name.
	* @param array $attrs.
	*
	* @return string.
	*/	
	public function file($name, array $attrs = array() )
	{
		return $this->input($name, '', $attrs, self::INPUT_FILE );
	}
	
	/**
	* HTML Select input.
	*
	* @param string $name.
	* @param array $list.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/	
	public function select($name, array $list, $value = '',  array $attrs = array() )
	{

		$options = '';
		foreach( $list as $key => $val ){
			$options .= '<option value="'.$key.'" '.$this->isSelected( $value, $key ).' >'.$val."</option>\n";
		}
		
		$attributes = $this->attributes( $attrs );
		return '<select name="'.$name.'" '.$attributes.' >'."\n".$options.'</select>';
	}

	/**
	* HTML Textarea.
	*
	* @param string $name.
	* @param string $value.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function textarea($name, $value = '', array $attrs = array() )
	{
		$attributes = $this->attributes( $attrs );
		return '<textarea name="'.$name.'" '.$attributes.' >'.$value.'</textarea>';
	}

	
	/**
	* HTML button.
	*
	* @param string $text.
	* @param array $attrs.
	* @param string $type.
	*
	* @return string.
	*/		
	public function button($text, array $attrs = array(), $type = self::BUTTON )
	{
		$attributes = $this->attributes( $attrs );
		return '<button type="'.$type.'" '.$attributes.' >'.$text.'</button>';
	}	
	
	/**
	* HTML Submit.
	*
	* @param string $text.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function reset($text, array $attrs = array() )
	{
		return $this->button($text, $attrs, self::BUTTON_RESET );
	}	
	
	/**
	* HTML Submit.
	*
	* @param string $text.
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function submit($text, array $attrs = array() )
	{
		return $this->button($text, $attrs, self::BUTTON_SUBMIT );
	}	
	
	/**
	* Attributes.
	*
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function attributes( array $attrs  )
	{
		$attributes = array();
		foreach( $attrs as $key => $val ){
			$attributes[] = (string)$key . '="' . (string)$val . '"';
		}		
		return implode(' ', $attributes);
	}
	
	/**
	* Serialize.
	*
	* @param array $attrs.
	*
	* @return string.
	*/		
	public function serialize( array $attrs  )
	{
		$attributes = array();
		foreach( $attrs as $key => $val ){
			$attributes[] = (string)$key . '=' . (string)$val . '';
		}		
		return implode('&', $attributes);
	}
	
	/**
	* Is Selected.
	*
	* @param string $a.
	* @param string $b.
	*
	* @return string.
	*/		
	public function isSelected( $a, $b  ){
		if( $a == $b){
			return ' selected="selected" ';
		}
		return '';
	}
	
	/**
	* Is Chcecked.
	*
	* @param string $value.
	*
	* @return string.
	*/					
	public function isChecked( $value )
	{
		$positives = array(true,'true','True','TRUE',1,'1','yes','YES','Y','checked','check' );
		
		if( in_array( $value, $positives, true ) )
			return ' checked="checked" ';
		
		return '';
	}
	
	/**
	* Form php raw input.
	*
	* @return string.
	*/			
	public function raw()
	{
		return file_get_contents('php://input');
	}
	
	/**
	* Form Request Value.
	*
	* @param string $name.
	* @param string $defaultValue.
	*
	* @return string.
	*/			
	public function request( $name, $defaultValue = null )
	{
		$value = $defaultValue;
		
		// Try POST as the Primary
		if( !empty($_POST[ $name ] ) ){
			$value = $_POST[ $name ];
		}
		
		// Try GET as the Secondary
		else if( !empty($_GET[ $name ] ) ){
			$value = $_GET[ $name ];
		}

		return $value;
	}

	/**
	* Form GET Value.
	*
	* @param string $name.
	* @param string $defaultValue.
	*
	* @return string.
	*/			
	public function get( $name, $defaultValue = null )
	{
		$value = $defaultValue;
		
		if( !empty($_GET[ $name ] ) ){
			$value = $_GET[ $name ];
		}
		return $value;
	}
	
	/**
	* Form POST Value.
	*
	* @param string $name.
	* @param string $defaultValue.
	*
	* @return string.
	*/			
	public function post( $name, $defaultValue = null )
	{
		$value = $defaultValue;
		
		if( !empty($_POST[ $name ] ) ){
			$value = $_POST[ $name ];
		}
		return $value;
	}
	
	/**
	* Is Request Method POST.
	*
	* @return bool.
	*/		
	public function isPost()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD']) === self::REQUEST_POST);
	}
	
	/**
	* Is Request Method  GET.
	*
	* @return bool.
	*/			
	public function isGet()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD']) === self::REQUEST_GET);
	}
	
	/**
	* Is Request Method  PUT.
	*
	* @return bool.
	*/		
	public function isPut()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD']) === self::REQUEST_PUT);
	}
	
	/**
	* Is Request Method  DELETE.
	*
	* @return bool.
	*/			
	public function isDelete()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD']) === self::REQUEST_DELETE);
	}
	
	/**
	* Is Request Method  HEAD.
	*
	* @return bool.
	*/		
	public function isHead()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD']) === self::REQUEST_HEAD);
	}
	
	/**
	* Create a CSRF Token
	* Generates a unique key and, optionally, stores it in the session.
	*
	* @return string 
	*/
	public function createToken( $key )
	{
		if( !$this->hasSession() ){
			throw new \Exception('You must start a PHP session to use CSRF tokens.');
		}
		
		$token = md5( uniqid(rand(), true) );
		
		$_SESSION[self::CSRF_TOKEN_KEY.$key] = $token;
		
		return $token;
	}
	
	/**
	* Get CSRF Token
	*
	* @return string 
	*/
	public function getToken( $key )
	{
		if( !$this->hasSession() ){
			throw new \Exception('You must start a PHP session to use CSRF tokens.');
		}
		
		$token = !empty( $_SESSION[self::CSRF_TOKEN_KEY.$key] )
			? $_SESSION[self::CSRF_TOKEN_KEY.$key]
			: null;
			
		return $token;
	}
	
	/**
	* Validate a CSRF Token
	* Compare a value against the token stored in the session.
	*
	* @return bool 
	*/
	public function validateToken( $key, $token )
	{
		if( !$this->hasSession() ){
			throw new \Exception('You must start a PHP session to use CSRF tokens.');
		}
		
		$sessToken = !empty( $_SESSION[self::CSRF_TOKEN_KEY.$key] ) 
						? $_SESSION[self::CSRF_TOKEN_KEY.$key] 
						: null;
		return ( !empty($token) && $token == $sessToken );
	}
	
	/**
	* Has PHP Session
	* Loosely check for an existing php session.
	*
	* @return bool 
	*/	
	public function hasSession()
	{
		return !( session_status() === PHP_SESSION_NONE || session_id() === '' );
	}
	
	
	/**
	 * Sanitize
     * Strips tags and optionally reduces string to specified length.
     *
     * @param string $string
     * @param int    $maxlength
     * @param string $allowed
     * @return string
     */
    public function sanitize( $string, $maxlength = 0, $allowed = '' )
    {
        $text = trim( strip_tags( $string, $allowed ) );
        if( $maxlength > 0 ){
			$text = substr($text, 0, $maxlength);
        }
        if( $text == null ) {
            return '';
        }
        return $text;
    }
	
	/**
	 * Sanitize Data
     * Strips tags and optionally reduces string to specified length.
     *
     * @param array $arr
     * @param int    $maxlength
     * @param string $allowed
     * @return array
     */
	public function sanitizeData( array $arr, $maxlength = 0, $allowed = '' )
	{
		$nArr = array();
		foreach( $arr as $k => $v ){
			$k = $this->sanitize( $k, $maxlength, $allowed );
			
			if( is_array( $v ) ){
				$v = $this->sanitizeArray( $v, $maxlength, $allowed );
			}
			
			else{
				$v = $this->sanitize( $v, $maxlength, $allowed );
			}
			
			$nArr[$k] = $v;
		}
		return $nArr;
	}
	

	/**
	* Validate value based on type.
	*
	* @param string $value.
	* @param string $type.
	*
	* @return bool.
	*/	
	public static function validate($value, $rule = '' )
	{
		$isValid = true;
		switch( strtolower( $rule ) )
		{
			case self::RULE_USERNAME:
				$isValid = preg_match("/^[a-zA-Z0-9]{4,10}$/", $value );
				break;

			case self::RULE_EMAIL:
				$isValid = preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/i", $value );
				break;

			case self::RULE_TEL:
				$isValid = preg_match("/^[0-9 .\-+()]+$/i", $value );
				break;

			case self::RULE_URL:
				$isValid = preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value );
				break;
				
			case self::RULE_NUMBER:
				$isValid = preg_match("/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/", $value );
				break;
				
			case self::RULE_DIGITS:
				$isValid = preg_match("/^\d+$/", $value );
				break;
				
			case self::RULE_DATEISO:
				$isValid = preg_match("/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/i", $value );
				break;	
				
			case self::RULE_CREDITCARD:
			
				// Clean out "spacing" characters
				$value = (string)preg_replace('/[^\d]/', '', $value);
				
				//Test using the Luhn algorithm
				$sum = '';
				for ($i = strlen($value) - 1; $i >= 0; -- $i) {
					$sum .= $i & 1 ? $value[$i] : $value[$i] * 2;
				}
				$isValid = array_sum(str_split($sum)) % 10 === 0;
				break;
				
			default:
				break;
		}
		return $isValid;
	}
	
	
}

