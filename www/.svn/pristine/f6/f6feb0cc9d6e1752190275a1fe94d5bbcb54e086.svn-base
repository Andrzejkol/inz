<?php

defined('SYSPATH') OR die('No direct access allowed.');

class popup_helper {

    const POPUP = 'popup';
    const POPUP_TYPE = 'popup_type';
    const POPUP_PER_PAGE = 15;

    static public function getElement($iId) {
        $oDb = Database::instance();
        $result = $oDb->from(popup_helper::POPUP)
                ->join(popup_helper::POPUP_TYPE, array('type_id' => 'id_type'), 'LEFT')
               
                ->where(array( 'date_start <=' => date('Y-m-d', time()), 'date_end >=' => date('Y-m-d', time()), 'active' => '1','id_type' => $iId))
                ->orderby('date_end', 'asc')
                ->get();

        return $result[0];
    }

}

?>