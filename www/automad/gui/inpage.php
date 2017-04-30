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
 *	Copyright (c) 2017 by Marc Anton Dahmen
 *	http://marcdahmen.de
 *
 *	Licensed under the MIT license.
 *	http://automad.org/license
 */


namespace Automad\GUI;
use Automad\Core as Core;


defined('AUTOMAD') or die('Direct access not permitted!');


/**
 *	The InPage class provides all methods related to edit content directly in the page. 
 *
 *	@author Marc Anton Dahmen
 *	@copyright Copyright (c) 2017 Marc Anton Dahmen - <http://marcdahmen.de>
 *	@license MIT license - http://automad.org/license
 */

class InPage {
	
	
	/**
	 *      The constructor.
	 */
	
	public function __construct() {
		
		if (User::get()) {
			
			// Prepare text modules.
			Text::parseModules();
			
		}
		
	}
	
	
	/**
	 *      Process the page markup and inject all needed GUI markup if an user is logged in.
	 *      
	 *      @param string $str
	 *      @return string The processed $str
	 */
	
	public function createUI($str) {
		
		if (User::get()) {
			$str = $this->injectAssets($str);
			$str = $this->injectMarkup($str);
			$str = $this->processTemporaryEditButtons($str);
			$str = Prefix::add($str);
		}
		
		return $str;
		
	}
	
	
	/**
	 *      Inject GUI markup like bottom menu and modal dialogs.
	 *      
	 *      @param string $str
	 *      @return string The processed $str
	 */
	
	private function injectMarkup($str) {
		
		$urlGui = AM_BASE_INDEX . AM_PAGE_GUI;
		$urlData = $urlGui . '?' . http_build_query(array('context' => 'edit_page', 'url' => AM_REQUEST)) . '#' . Core\Str::sanitize(Text::get('btn_data'));
		$urlFiles = $urlGui . '?' . http_build_query(array('context' => 'edit_page', 'url' => AM_REQUEST)) . '#' . Core\Str::sanitize(Text::get('btn_files'));
		$urlCache = $urlGui . '?context=system_settings#' . Core\Str::sanitize(Text::get('sys_cache'));
		$urlLogout = $urlGui . '?context=logout';
		
		$html = '<div class="am-inpage">' .
				// Menu.
				'<div class="am-inpage-menubar">' .
					'<div class="uk-button-group">' .
						'<a href="' . $urlGui . '" class="uk-button uk-button-large"><i class="uk-icon-automad"></i></a>' .
						'<a href="' . $urlData . '" class="uk-button uk-button-large"><i class="uk-icon-file-text"></i></a>' .
						'<a href="' . $urlFiles . '" class="uk-button uk-button-large"><i class="uk-icon-folder-open"></i></a>' .
						'<a href="' . $urlCache . '" class="uk-button uk-button-large"><i class="uk-icon-cog"></i></a>' .
						'<a href="' . $urlLogout . '" class="uk-button uk-button-large"><i class="uk-icon-power-off"></i></a>' .
						'<a href="#" class="am-drag-handle uk-button uk-button-large"><i class="uk-icon-arrows"></i></a>' .
					'</div>' .
				'</div>' .
				// Modal.
				'<div id="am-inpage-edit-modal" class="uk-modal">' .
					'<div class="uk-modal-dialog uk-modal-dialog-blank">' .
						'<div class="uk-container uk-container-center">' .
							'<form class="uk-form uk-form-stacked uk-margin-large-top" data-am-inpage-handler="' . AM_BASE_INDEX . AM_PAGE_GUI . '?ajax=inpage_edit">' .
								'<div class="uk-modal-header">' . 
									Text::get('inpage_edit_title') . '&nbsp;' .
									'<a href="#" class="uk-modal-close uk-close"></a>' .
								'</div>' .
								'<div class="uk-margin-bottom uk-text-muted">' . 
									'<i class="uk-icon-file-text-o"></i>&nbsp;&nbsp;<span id="am-inpage-edit-modal-title"></span>' .
								'</div>' .
								'<input type="hidden" name="url" value="' . AM_REQUEST . '" />' .
								'<div class="uk-modal-footer">' . 
									'<div class="uk-text-right">' .
										'<button type="button" class="uk-modal-close uk-button">' .
											'<i class="uk-icon-close"></i>&nbsp;&nbsp;' . Text::get('btn_close') . 
										'</button>&nbsp;' .
										'<button type="submit" class="uk-button uk-button-primary">' .
											'<i class="uk-icon-check"></i>&nbsp;&nbsp;' . Text::get('btn_save') . 
										'</button>' .
									'</div>' .
								'</div>' .
							'</form>' .
						'</div>' .
					'</div>' .
				'</div>' .
			'</div>';
		
		return str_replace('</body>', $html . '</body>', $str);
		
	}
	
	
	/**
	 *      Add all needed assets for inpage-editing to the <head> element. 
	 *      
	 *      @param string $str
	 *      @return string The processed markup
	 */
	
	private function injectAssets($str) {
		
		$assets = 	"\n" .
				'<!-- Automad GUI -->' . "\n" .
				'<link href="' . AM_BASE_URL . '/automad/gui/dist/automad.min.css" rel="stylesheet">' . "\n" .
				'<script type="text/javascript" src="' . AM_BASE_URL . '/automad/gui/dist/libs.min.js"></script>' . "\n" .
				'<script type="text/javascript" src="' . AM_BASE_URL . '/automad/gui/dist/automad.min.js"></script>' . "\n" .
				// Cleanup window object by removing jQuery and UIkit.
				'<script type="text/javascript">$.noConflict(true);delete window.UIkit;</script>' . "\n" .
				'<!-- Automad GUI end -->' . "\n";
			
		// Check if there is already any other script tag and try to prepend all assets as first items.
		if (preg_match('/\<script.*\<\/head\>/is', $str)) {
			return preg_replace('/(\<script.*\<\/head\>)/is', $assets . "\n$1", $str);
		} else {
			return str_replace('</head>', $assets . "\n</head>", $str);
		}
		
	}
	
	
	/**
	 *      Inject a temporary markup for an edit button.
	 *      
	 *      @param string $value
	 *      @param string $key
	 *      @param object $Context
	 *      @return string The processed $value 
	 */
	
	public function injectTemporaryEditButton($value, $key, $Context) {
		
		// Only inject button if $key is no runtime var and a user is logged in.
		if (preg_match('/^\w/', $key) && User::get()) {
			$value .= 	AM_DEL_INPAGE_BUTTON_OPEN . 
					json_encode(array(
						'context' => $Context->get()->url, 
						'key' => $key
					), JSON_UNESCAPED_SLASHES) . 
					AM_DEL_INPAGE_BUTTON_CLOSE;
		}	
		
		return $value;
		
	}
	
	
	/**
	 *      Process the temporary buttons to edit variable in the page. 
	 *      All invalid buttons (within tags and in links) will be removed.
	 *      
	 *      @param string $str
	 *      @return string The processed markup
	 */
	
	private function processTemporaryEditButtons($str) {
		
		// Remove invalid buttons.
		// Within HTML tags.
		$str = 	preg_replace('/' . Core\Regex::inPageEditButtonInTag() .'/is', '$1$3', $str);
		// In links, buttons etc.
		$str = 	preg_replace_callback('/' . Core\Regex::$invalidInPageButtonTags . '/is', function($matches) {
				return preg_replace('/' . Core\Regex::inPageEditButton() . '/is', '', $matches[0]);
			}, $str);
		
		// Enable valid buttons.
		$str = str_replace(
			array(AM_DEL_INPAGE_BUTTON_OPEN, AM_DEL_INPAGE_BUTTON_CLOSE), 
			array(
				' <span class="am-inpage"><a href="#am-inpage-edit-modal" class="uk-button uk-button-mini uk-button-primary" data-uk-modal data-am-inpage-content=\'', 
				'\'><i class="uk-icon-pencil"></i>&nbsp;&nbsp;' . Text::get('btn_edit') . '</a></span>&nbsp;&nbsp;'
			), 
			$str
		);
		
		return $str;
		
	}
	
	
}