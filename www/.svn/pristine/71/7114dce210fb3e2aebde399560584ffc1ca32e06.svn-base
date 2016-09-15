<?php defined('SYSPATH') OR die('No direct access allowed.');

class slider_helper {
    const SLIDER_MAX_ELEMENTS = 20;
	const ADMIN_PER_PAGE = 10;
	
	// Typ elementu slidera z tabeli slider_elements
	const ELEMENT_TYPE_NEWS = 1;
	const ELEMENT_TYPE_SLIDER_NEWS = 2;
	const ELEMENT_TYPE_IMAGE = 3;

	static $aValidImageMimes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
	const SLIDER_IMAGE_PATH = 'files/slider/big/';
	const SLIDER_IMAGE_MEDIUM_PATH = 'files/slider/medium/';
	const SLIDER_IMAGE_SMALL_PATH = 'files/slider/small/';
	const SLIDER_IMAGE_WIDTH = 960;
	const SLIDER_IMAGE_HEIGHT = 360;
	const SLIDER_IMAGE_MEDIUM_WIDTH = 960;
	const SLIDER_IMAGE_MEDIUM_HEIGHT = 360;
	const SLIDER_IMAGE_SMALL_WIDTH = 220;
	const SLIDER_IMAGE_SMALL_HEIGHT = 100;
	
	/**
	 * Returns the path to the image file based on the sliter element's type
	 * @param int $iTypeId
	 * @param string $sSize ('big'|'medium'|'small')
	 * @return string 
	 */
	public static function GetImagePathForType($iTypeId, $sSize)
	{
		switch ($iTypeId)
		{
			case self::ELEMENT_TYPE_NEWS:
				switch ($sSize)
				{
					case 'big':
						$sPath = news_helper::BIG_PATH;
						break;
					case 'medium':
						$sPath = news_helper::MEDIUM_PATH;
						break;
					case 'small':
						$sPath = news_helper::SMALL_PATH;
						break;
				}
				break;
			default :
				switch ($sSize)
				{
					case 'big':
						$sPath = self::SLIDER_IMAGE_PATH;
						break;
					case 'medium':
						$sPath = self::SLIDER_IMAGE_MEDIUM_PATH;
						break;
					case 'small':
						$sPath = self::SLIDER_IMAGE_SMALL_PATH;
						break;
				}
				break;
		}
		return $sPath;
	}
}
?>