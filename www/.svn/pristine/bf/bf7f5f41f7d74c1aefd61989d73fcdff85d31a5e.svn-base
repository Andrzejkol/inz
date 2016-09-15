<?php

defined('SYSPATH') OR die('No direct access allowed.');

class news_helper {

    const SMALL_PATH = 'files/news/small/';
    const MEDIUM_PATH = 'files/news/medium/';
    const BIG_PATH = 'files/news/big/';
    const LIMIT = 5;
    const PER_PAGE = 10;

    public static function NewsAnchor($oNews, $sText = NULL) {
        switch ($oNews->lang) {
            case 'en_US' :
                $url = 'en/news/';
                break;
            case 'de_DE' :
                $url = 'de/aktualität/';
                break;
            case 'ru_RU' :
                $url = 'ru/своевременность';
                break;
            default :
                $url = 'aktualnosc/';
                break;
        }
        if (!empty($oNews->url)) {
            echo html::anchor($url . string::prepareURL($oNews->id_news . '-' . $oNews->url), (!empty($sText) ? $sText : $oNews->title));
        } else {
            echo html::anchor($url . string::prepareURL($oNews->id_news . '-' . $oNews->title), (!empty($sText) ? $sText : $oNews->title));
        }
    }

}

?>
