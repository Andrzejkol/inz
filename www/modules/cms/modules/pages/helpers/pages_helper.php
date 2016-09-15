<?php

defined('SYSPATH') OR die('No direct access allowed.');

class pages_helper {

    const SMALL_PATH = 'files/page_icons/small/';
    const BIG_PATH = 'files/page_icons/big/';
    const PAGES_ORDER = 'DESC'; // kolejnosc na liscie stron
    const THUMB_PATH = 'files/page_icons/thumb/';
    const TOP_PATH = 'files/page_icons/top/';
    const THUMBWIDTH = 400;
    const THUMBHEIGHT = 200;
    const TOPWIDTH = 940;
    const TOPHEIGHT = 285;

    /**
     * Tworzy adres dla strony podanej poprzez id
     * @author Hubert Kulczak
     * @todo Poprawić obsługę jezyków
     * @param Integer $iPageId
     * @param Bool $bFromThisId - jesli true to link bedzie zawieral tez url tej strony, jesli false to tylko parenty
     * @return String $sUrl - url do strony
     */
    static public function CreateAddress($iPageId, $bFromThisId = null) {
        try {
            $oDb = new Database();

//            switch (Kohana::config('locale.language')) {
//                case 'en_US':
//                    $url = array('en');
//                    break;
//                default :
//                    break;
//            }
            $url = array();
            $result = $oDb->from(table::PAGES)->where(array('id_page' => $iPageId))->get();
            //pobieramy kategorie nadrzedna dla wybranej
            if (!empty($bFromThisId)) {
                self::_BuildUrl($iPageId, $url);
            } else {
                self::_BuildUrl($result[0]->parent_id, $url);
            }
            if ($result[0]->url !== 'en' && !array_search('en', $url) && $result[0]->url !== 'de' && !array_search('de', $url) && $result[0]->url !== 'ru' && !array_search('en', $url)) {
                switch (Kohana::config('locale.language')) {
                    case 'en_US':
                        $url[] = 'en';
                        break;
                    case 'de_DE':
                        $url[] = 'de';
                        break;
                    case 'ru_RU':
                        $url[] = 'ru';
                        break;
                }
            }
            $url = array_reverse($url);
            $sUrl = join('/', $url) . '/';
            //var_dump($sUrl);
            return $sUrl;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('site.error.create_address'));
        }
    }

    /**
     * Funkcja budująca adres url - zbiera do tablicy wszystkie url przechodzac po parentach
     * @author Hubert Kulczak
     * @param <type> $iPageId
     * @param array $url
     * @return <type>
     */
    static private function _BuildUrl($iPageId, &$url) {
        //pobieramy dane kategorii
        $oDb = new Database();
        $result = $oDb->from(table::PAGES)->where(array('id_page' => $iPageId))->get();
        $url[] = $result[0]->url;
        if (!empty($result[0]->parent_id)) {
            //pobieramy kategorie nadrzedna dla wybranej
            return self::_BuildUrl($result[0]->parent_id, $url);
        }

        return $url;
    }

}

?>