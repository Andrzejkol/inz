<?php

defined('SYSPATH') or die('No direct script access.');

class dotpay {
        
    const ID = '12345';
    const PIN = '123456789012345';
    
    const BACK_URL = 'zamowienie/podsumowanie';
    const BACK_URLC = 'dotpay/check'; // wprowadzic w panelu dotpay
    
    const DOTPAY_LOGS = 'dotpay_logs';
    
    public static function Log(array $aData) {
        $db = database::instance();
        $db->insert(self::DOTPAY_LOGS, $aData);
    }
    
    public static function GetBackUrlC() {
        return 'http://'.$_SERVER['HTTP_HOST'].url::base().self::BACK_URLC;
    }
    
    public static function GetBackUrl($sGet = NULL) {
        return 'http://'.$_SERVER['HTTP_HOST'].url::base().self::BACK_URL.$sGet;
    }
    
}
?>
