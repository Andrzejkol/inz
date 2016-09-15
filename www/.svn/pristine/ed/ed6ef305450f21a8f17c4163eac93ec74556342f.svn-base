<?php defined('SYSPATH') OR die('No direct access allowed.');
// dla strony
function GetTreeAsList($iParentId, &$aIdsArray, &$config, &$url) {    
    try {
        $tmpArray = array();
        foreach ($aIdsArray as $ar) {
            if ($ar->parent_id == $iParentId) {
                $tmpArray[] = $ar;
            }            
        }        
        if (!empty($tmpArray)) {

            foreach ($tmpArray as $ar) {
				if ($ar->page_type != 'link') {
					if(!empty($ar->url)){
						$url .= $ar->url.'/';// dodajemy do adresu url danej strony
					}
					else {
						$url .= $ar->url;
					}
				} else {
                    $url .= 'link/'; // dodajemy do adresu url danej strony
                }
				// Założenia: strona główna dla języka ang. ma w bazie pole 'url' ustawione na 'en', podobnie dla innych wersji językowych
                if( $ar->lang == 'en_US' && $url !== 'en/' && !strstr($url, '/en/') ){
                    $config_url = 'en/';
                }
                elseif( $ar->lang == 'de_DE' && $url !== 'de/' && !strstr($url, '/de/') ){
                    $config_url = 'de/';
                }
                elseif( $ar->lang == 'ru_RU' && $url !== 'ru/' && !strstr($url, '/ru/') ){
                    $config_url = 'ru/';
                }
                else{
                    $config_url = ''; // pl
                }
                if($ar->homepage == 1){
                    $config["/"] = 'index/contents/'.$ar->id_page; // routes dla strony głównej
                }
                if($ar->homepage == 0 && $ar->page_type == 'shop'){
                    $config[$config_url . $url] = 'app_products/index'; // routes dla strony sklepu
                }
                else {
                    $config[ $config_url . $url] = 'index/contents/'.$ar->id_page; // robimy dla tej strony routes
                }
                //$config[($ar->lang == 'en_US' && $url !== 'en/' && !strstr($url, 'en/') ? 'en/' : ($ar->lang == 'de_DE' && $url !== 'de/' && !strstr($url, 'de/') ? 'de/' : ($ar->lang == 'ru_RU' && $url !== 'ru/' && !strstr($url, 'ru/') ? 'ru/' : ''))) . $url] = 'index/contents/'.$ar->id_page; // robimy dla tej strony routes
                GetTreeAsList($ar->id_page, $aIdsArray, $config, $url); // szukamy czy ma podstrony
            }
        }
        $aUrl = explode('/', $url); // rozbijamy url
        $Count = count($aUrl)-2; //liczymy z ilu elementów składa się adres i usuwamy jeden ostatni (2 dlatego, że w for iterujemy od 0)

        $url = ''; // czyścimy adres
        for($i=0; $i<$Count; $i++) { // budujemy adres
            $url .= $aUrl[$i].'/'; // dodajemy do adresu wszystkie potrzebne składowe
        }
        return $config;
    } catch (Exception $ex) {
        Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
        return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_tree_as_list'));
    }
}

function GetNewsCategoriesRoutes(&$config) {
    try {

        $db = new Database();
        $oCats = $db->from(table::NEWS)->get();
        
        //TODO - URLe dla aktualnosci powinny byc generowane per kategoria

        foreach($oCats as $oC) {
			switch ($oC->lang) {
				case 'pl_PL' :
					$url = 'aktualnosc/';
					break;
				case 'en_US' :
					$url = 'en/news/';
					break;
				case 'de_DE' :
					$url = 'de/aktualität/';
					break;
				case 'ru_RU' :
					$url = 'ru/своевременность';
					break;
			}
			//generowanie URL dla aktualnosci
			if(!empty($oC->url)) {
				$url .= string::prepareURL($oC->id_news . '-' . $oC->url).'/';	
			}
			else {
            	$url .= string::prepareURL($oC->id_news . '-' . $oC->title).'/';
            }
            $config[$url] = 'index/news/'.$oC->id_news;

        }
        //var_dump($config);
        return $config;
    } catch (Exception $ex) {
        Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
        return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_tree_as_list'));
    }
}

// Deklaracja zmiennych do budowania routes
//$config = array();
//$url = '';
//$db = new Database();
//$result = $db->from('pages')->get(); // pobieram strony
//GetTreeAsList(0, $result, $config, $url); // budujemy routes
//GetNewsCategoriesRoutes($config); // routes dla aktualnosci



// cachowanie
$config = array();
$url = '';
$db = new Database();
$result = $db->from('pages')->get(); // pobieram strony
GetTreeAsList(0, $result, $config, $url); // budujemy routes
GetNewsCategoriesRoutes($config); // routes dla aktualnosci


//--

$languages = $db->from(table::LANGUAGES)->get();



if(isset($result[0])){
    $config['_default'] = 'index/contents/'.$result[0]->id_page;
}
if (!empty($languages) && $languages->count() > 0) {
//	Założenia: polski język jest domyślny
	foreach ($languages as $language) {
		if ($language->name === 'pl_PL') {
			$lang = '';
		} else {
			$lang = $language->name{0} . $language->name{1} . '/';			
		}
		$config[$lang . 'index/confirm_subscribe'] = 'index/confirm_subscribe';
		$config[$lang . 'index/confirm_unsubscribe'] = 'index/confirm_unsubscribe';
	}
}
//echo '<pre>';
//var_dump($config);
//echo '</pre>';
//exit;



