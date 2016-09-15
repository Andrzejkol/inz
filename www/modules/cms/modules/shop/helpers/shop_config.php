<?php

defined('SYSPATH') OR die('No direct access allowed.');

class shop_config {

    public static function getConfig($key) {
        try {
            //TODO: dorobić wyłączanie cachowania
            $cache = Cache::instance();
            $result = $cache->get('shop_config');
            if (!empty($result[$key])) {
                return $result[$key];
            } else {
                $db = new Database;
                $result = $db->from(table::SHOP_CONFIGURATION)->get();
                if (!empty($result) && $result->count() > 0) {
                    $aData = array();
                    foreach ($result as $r) {
                        $aData[$r->key] = $r->value;
                    }
                    $cache->set('shop_config', $aData);
                }
                $result = $cache->get('shop_config');
                if (!empty($result[$key])) {
                    return $result[$key];
                } else {
                    return '';
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return false;
        }
    }

}
