<?php

defined('SYSPATH') or die('No direct script access.');

class languages {
    
    const FLAG_PATH = 'img/flag/';
        
    public static function ShowTranslationBox($table, $id, $input) {
        $db = new Database();        
        $html = '';
        //$langs = $db->from(table::LANGUAGES)->where(array('name !=' => cookie::get('language')))->get();
        $langs = $db->from(table::LANGUAGES)->where(array('name !=' => 'pl_PL'))->get();
        foreach($langs as $lng) {
            //$html .= "<span class=\"show-$lng->name\" onclick=\"showLangPopUp('$lng->name','$id','$table','$input');\">";
            $html .= "<span class=\"show-transbox\">";
            $html .= "<span class=\"tr_lang\">$lng->name</span><span class=\"tr_id\">$id</span><span class=\"tr_table\">$table</span><span class=\"tr_input\">$input</span>";
            $html .= html::image(languages::FLAG_PATH.$lng->flag);
            $html .='</span>';
        }        
        echo $html;
            
    }
    
}

?>