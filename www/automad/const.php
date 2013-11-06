<?php defined('AUTOMAD') or die('Direct access not permitted!');
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
 *	AUTOMAD CMS
 *
 *	Copyright (c) 2013 by Marc Anton Dahmen
 *	http://marcdahmen.de
 *
 *	Licensed under the MIT license.
 */


// Base URL for all URLs relative to the root
define('BASE_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));


// Pretty URLs
if (file_exists(BASE_DIR . '/.htaccess')) {
	// If .htaccess exists, assume that pretty URLs are enabled and INDEX is empty
	define('INDEX', '');
} else {
	// If not, INDEX will be defined
	define('INDEX', '/index.php');
}


// Debugging
if (!defined('DEBUG_MODE')) {
	define('DEBUG_MODE', false);
}


// Site defaults

// Directory for the pages
if (!defined('SITE_PAGES_DIR')) {
	define('SITE_PAGES_DIR', '/pages');
}
// Directory for shared/sitewide items
if (!defined('SITE_SHARED_DIR')) {
	define('SITE_SHARED_DIR', '/shared');
}
// Sidewide settings/variable
if (!defined('SITE_SETTINGS_FILE')) {
	define('SITE_SETTINGS_FILE', BASE_DIR . SITE_SHARED_DIR . '/site.txt'); 
}
// Directory for themes
if (!defined('SITE_THEMES_DIR')) {
	define('SITE_THEMES_DIR', '/themes');
}
// Title for 404 page
if (!defined('SITE_ERROR_PAGE_TITLE')) {
	define('SITE_ERROR_PAGE_TITLE', '404');
}
// Title for search results page
if (!defined('SITE_RESULTS_PAGE_TITLE')) {
	define('SITE_RESULTS_PAGE_TITLE', 'Search Results');
}
// URL of search results page
if (!defined('SITE_RESULTS_PAGE_URL')) {
	define('SITE_RESULTS_PAGE_URL', '/results');
}


// Template defaults

// Default template directory
if (!defined('TEMPLATE_DEFAULT_DIR')) {
	define('TEMPLATE_DEFAULT_DIR', '/automad/templates');
}
// Default template name
if (!defined('TEMPLATE_DEFAULT_NAME')) {
	define('TEMPLATE_DEFAULT_NAME', 'default');
}
// Left delimiter for template variables
if (!defined('TEMPLATE_VAR_DELIMITER_LEFT')) {
	define('TEMPLATE_VAR_DELIMITER_LEFT', '[');
}
// Right delimiter for template variables
if (!defined('TEMPLATE_VAR_DELIMITER_RIGHT')) {
	define('TEMPLATE_VAR_DELIMITER_RIGHT', ']');
}
// Left delimiter for template functions
if (!defined('TEMPLATE_FN_DELIMITER_LEFT')) {
	define('TEMPLATE_FN_DELIMITER_LEFT', '$[');
}
// Right delimiter for template functions
if (!defined('TEMPLATE_FN_DELIMITER_RIGHT')) {
	define('TEMPLATE_FN_DELIMITER_RIGHT', ']');
}


// HTML defaults

// Navigation class
if (!defined('HTML_CLASS_NAV')) {
	define('HTML_CLASS_NAV', 'nav');
}
// Previous page link class
if (!defined('HTML_CLASS_PREV')) {
	define('HTML_CLASS_PREV', 'prev');
}
// Next page link class
if (!defined('HTML_CLASS_NEXT')) {
	define('HTML_CLASS_NEXT', 'next');
}
// Filter menu class
if (!defined('HTML_CLASS_FILTER')) {
	define('HTML_CLASS_FILTER', 'filter');
}
// Navigation tree class
if (!defined('HTML_CLASS_TREE')) {
	define('HTML_CLASS_TREE', 'tree');
}
// Page list class
if (!defined('HTML_CLASS_LIST')) {
	define('HTML_CLASS_LIST', 'list');
}
// Sort menu class
if (!defined('HTML_CLASS_SORT')) {
	define('HTML_CLASS_SORT', 'sort');
}
// Class for link to Home page in navigation 
if (!defined('HTML_CLASS_HOME')) {
	define('HTML_CLASS_HOME', 'home');
}
// Class for current page in navigation
if (!defined('HTML_CLASS_CURRENT')) {
	define('HTML_CLASS_CURRENT', 'current');
}
// Class for a page within the path of the current page in the navigation
if (!defined('HTML_CLASS_CURRENT_PATH')) {
	define('HTML_CLASS_CURRENT_PATH', 'currentPath');
}
// Breadcrumbs class
if (!defined('HTML_CLASS_BREADCRUMBS')) {
	define('HTML_CLASS_BREADCRUMBS', 'breadcrumbs');
}
// Breadcrumbs items separator
if (!defined('HTML_BREADCRUMB_SEPARATOR')) {
	define('HTML_BREADCRUMB_SEPARATOR', ' &gt; ');
}
// Search form class
if (!defined('HTML_CLASS_SEARCH')) {
	define('HTML_CLASS_SEARCH', 'search');
}
// Placeholder text for search field
if (!defined('HTML_SEARCH_PLACEHOLDER')) {
	define('HTML_SEARCH_PLACEHOLDER', 'Search ...');
}
// Filter menu text for "all items"
if (!defined('HTML_FILTERS_ALL')) {
	define('HTML_FILTERS_ALL', 'All');
}
// Sort menu text for ascending
if (!defined('HTML_SORT_ASC')) {
	define('HTML_SORT_ASC', 'ascending');
}
// Sort menu text for descending
if (!defined('HTML_SORT_DESC')) {
	define('HTML_SORT_DESC', 'descending');
}
// Max characters in list output
if (!defined('HTML_LIST_MAX_STR_LENGTH')) {
	define('HTML_LIST_MAX_STR_LENGTH', 150);
}
// Default sort direction
if (!defined('HTML_DEFAULT_SORT_DIR')) {
	define('HTML_DEFAULT_SORT_DIR', 'sort_asc');
}
// Default sort types
if (!defined('HTML_DEFAULT_SORT_TYPES')) {
	define('HTML_DEFAULT_SORT_TYPES', 'Original Order, title: By Title');
}


// Parsing defaults

// File extension of data file
if (!defined('PARSE_DATA_FILE_EXTENSION')) {
	define('PARSE_DATA_FILE_EXTENSION', 'txt');
}
// Block separator - separates all key/value pairs
if (!defined('PARSE_BLOCK_SEPARATOR')) {
	define('PARSE_BLOCK_SEPARATOR', '---');
}
// Pair separator - separates the key from the value
if (!defined('PARSE_PAIR_SEPARATOR')) {
	define('PARSE_PAIR_SEPARATOR', ':');
}
// Tool options separator
if (!defined('PARSE_OPTION_SEPARATOR')) {
	define('PARSE_OPTION_SEPARATOR', ',');
}
// Tags separator
if (!defined('PARSE_TAG_SEPARATOR')) {
	define('PARSE_TAG_SEPARATOR', ',');
}
// Tags key (to identify tags in the page's txt file)
if (!defined('PARSE_TAGS_KEY')) {
	define('PARSE_TAGS_KEY', 'tags');
}
// List of file extensions to identify file in URL
if (!defined('PARSE_REGISTERED_FILE_EXTENSIONS')) {
	define('PARSE_REGISTERED_FILE_EXTENSIONS', serialize(array('css', 'jpg', 'jpeg', 'png', 'svg', 'tif', 'tiff', 'js')));
}

 
include(BASE_DIR . '/automad/version.php');
 
 
?>
