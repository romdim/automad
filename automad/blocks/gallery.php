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
 *	Copyright (c) 2020-2021 by Marc Anton Dahmen
 *	https://marcdahmen.de
 *
 *	Licensed under the MIT license.
 *	https://automad.org/license
 */


namespace Automad\Blocks;
use Automad\Core\Parse as Parse;
use Automad\Core\Image as Image;
use Automad\Core\Str as Str;


defined('AUTOMAD') or die('Direct access not permitted!');


/**
 *	The gallery block.
 *
 *	@author Marc Anton Dahmen
 *	@copyright Copyright (c) 2020-2021 by Marc Anton Dahmen - https://marcdahmen.de
 *	@license MIT license - https://automad.org/license
 */

class Gallery {


	/**	
	 *	Render a gallery block.
	 *	
	 *	@param object $data
	 *	@param object $Automad
	 *	@return string the rendered HTML
	 */

	public static function render($data, $Automad) {
		
		// Use a factor of 0.85 to multiply with the row height of the grid to get a good
		// result since the aspect ratio is dependent on the actual row width and not the 
		// minimum row width.
		$masonryRowHeight = 20 * 0.85;
		$defaults = array(
			'globs' => '*.jpg, *.png, *.gif',
			'width' => 250,
			'cleanBottom' => true,
			'stretched' => true
		);

		$data = array_merge($defaults, (array) $data);
		$data = (object) $data;

		if ($files = Parse::fileDeclaration($data->globs, $Automad->Context->get())) {

			$files = array_filter($files, function($file) {
				return Parse::fileIsImage($file);
			});

			// Adding styles for devices smaller than width.
			$maxWidth = $data->width * 1.75;
			$style = "<style scoped>@media (max-width: ${maxWidth}px) { .am-gallery-masonry { grid-template-columns: 1fr; } }</style>";

			$cleanBottom = '';

			if ($data->cleanBottom) {
				$cleanBottom = ' am-gallery-masonry-clean-bottom';
			}

			$html = '<figure>' . 
					$style . 
					'<div class="am-gallery-masonry' . $cleanBottom . '" style="--am-gallery-item-width:' . $data->width . 'px">';

			foreach ($files as $file) {

				$Image = new Image($file, 2 * $data->width);
				$caption = Str::stripTags(Parse::caption($file));
				$file = Str::stripStart($file, AM_BASE_DIR);
				$span = round($Image->height / ($masonryRowHeight * 2) );

				$html .= <<< HTML
						<div 
						class="am-gallery-masonry-item"
						style="--am-gallery-masonry-rows: $span;"
						>
							<a href="$file" class="am-gallery-img-small" data-caption="$caption" data-am-block-lightbox>
								<img src="$Image->file" />
							</a>
						</div>
HTML;

			}

			return $html . '</div></figure>';

		}

	}


}