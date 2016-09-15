<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Languages_Controller extends Admin_Controller {
    public function __construct() {
        $this->_oLanguage = new Language_Model();
    }
    
    //$this->oLanguages
    
    public function ajax() {
        if(!empty($_POST)){            
            $this->_oLanguage->UpdateTranslation($_POST);            
        }
    }
    
   public function ajax_get(){
       if(!empty($_POST)){
           $result = $this->_oLanguage->GetTranslation($_POST);
           echo $result;           
       }
   }
}

?>