<?php

defined('SYSPATH') OR die('No direct access allowed.');

class boxes {

    const SMALL_PATH = 'files/boxes/small/';
    const BIG_PATH = 'files/boxes/big/';
    const THUMBWIDTH = 84;
    const THUMBHEIGHT = 79;
    const BIGWIDTH = 280;
    const BIGHEIGHT = 170;

    public static function GetBoxSetName($iBoxesSetId) {
        $db = new Database();
        $iBoxesSetId += 0;
        $result = $db->select('name')->from(table::BOXES_SET)->where(array('id_boxes_set' => $iBoxesSetId))->get();

        return $result[0]->name;
    }

}

?>