<?php 
/*
 *	                  ....
 *	                .:   '':.
 *	                ::::     ':..
 *	                ::.         ''..
 *	     .:'.. ..':.:::'    . :.   '':.
 *	    :.   ''     ''     '. ::::.. ..:
 *	    ::::.        ..':.. .''':::::  .
 *	    :::::::..    '..::::  :. ::::  :
 *	    ::'':::::::.    ':::.'':.::::  :
 *	    :..   ''::::::....':     ''::  :
 *	    :::::.    ':::::   :     .. '' .
 *	 .''::::::::... ':::.''   ..''  :.''''.
 *	 :..:::'':::::  :::::...:''        :..:
 *	 ::::::. '::::  ::::::::  ..::        .
 *	 ::::::::.::::  ::::::::  :'':.::   .''
 *	 ::: '::::::::.' '':::::  :.' '':  :
 *	 :::   :::::::::..' ::::  ::...'   .
 *	 :::  .::::::::::   ::::  ::::  .:'
 *	  '::'  '':::::::   ::::  : ::  :
 *	            '::::   ::::  :''  .:
 *	             ::::   ::::    ..''
 *	             :::: ..:::: .:''
 *	               ''''  '''''
 *	
 *
 *	AUTOMAD
 *
 *	Copyright (c) 2016 by Marc Anton Dahmen
 *	http://marcdahmen.de
 *
 *	Licensed under the MIT license.
 *	http://automad.org/license
 */


namespace Automad\GUI;


defined('AUTOMAD') or die('Direct access not permitted!');


/**
 *	The Accounts class provides all methods for creating and loading user accounts. 
 *
 *	@author Marc Anton Dahmen <hello@marcdahmen.de>
 *	@copyright Copyright (c) 2016 Marc Anton Dahmen <hello@marcdahmen.de>
 *	@license MIT license - http://automad.org/license
 */

class Accounts {
	
	
	/**
	 *	Install the first user account.
	 *
	 *	@return Error message in case of an error.
	 */
	
	public static function install() {
		
		if (!empty($_POST)) {
	
			if ($_POST['username'] && $_POST['password1'] && ($_POST['password1'] === $_POST['password2'])) {
		
				$accounts = array();
				$accounts[$_POST['username']] = Accounts::passwordHash($_POST['password1']);
		
				// Download accounts.php
				header('Expires: -1');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Type: application/octet-stream');
				header('Content-Transfer-Encoding: binary');
				header('Content-Disposition: attachment; filename=' . basename(AM_FILE_ACCOUNTS));
				ob_end_flush();
				echo Accounts::generatePHP($accounts);
				die;
		
			} else {
		
				return Text::get('error_form');
	
			}
	
		}
			
	}
	

	/**
	 *	Generate the PHP code for the accounts file. Basically the code returns the unserialized serialized array with all users.
	 *	That way, the accounts array can be stored as PHP.
	 *	The accounts file has to be a PHP file for security reasons. When trying to access the file directly via the browser, 
	 *	it gets executed instead of revealing any user names.
	 *	
	 *	@param array $accounts
	 *	@return The PHP code as string
	 */
	
	public static function generatePHP($accounts) {
		
		return 	"<?php defined('AUTOMAD') or die('Direct access not permitted!');\n" .
			'return unserialize(\'' . serialize($accounts) . '\');' .
			"\n?>";
			
	} 
	
	
	/**
	 *	Get the accounts array by including the accounts PHP file.
	 *
	 *	@return The accounts array
	 */
	
	public static function get() {
		
		return (include AM_FILE_ACCOUNTS);
		
	}
	
	
	/**
	 *	Create hash from password to store in accounts.txt.
	 *
	 *	@param string $password
	 *	@return Hashed/salted password
	 */

	public static function passwordHash($password) {
		
		$salt = '$2y$10$' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 22);
		
		return crypt($password, $salt);
		
	}


	/**
	 *	Verify if a password matches its hashed version.
	 *
	 *	@param string $password (clear text)
	 *	@param string $hash (hashed password)
	 *	@return true/false 
	 */

	public static function passwordVerified($password, $hash) {
		
		return ($hash === crypt($password, $hash));
		
	}
	
	
	/**
	 *	Save the accounts array as PHP to AM_FILE_ACCOUNTS.
	 *
	 *	@return Success (true/false)
	 */

	public static function write($accounts) {
		
		return @file_put_contents(AM_FILE_ACCOUNTS, Accounts::generatePHP($accounts));
		
	}


}


?>