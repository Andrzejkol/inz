<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Dotpay_Controller extends App_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->_oDotpay = new Dotpay_Model();
        
    }
    
    
//    public function test() {
//        $this->_oTemplate->content->main_content = new View('dotpay_form');
//        $this->_oTemplate->content->main_content->sGet = '';
//        $this->_oTemplate->content->main_content->sControl = '';
//        $this->_oTemplate->content->main_content->Price = '';
//                
//        $this->_oTemplate->render(true);
//    }
    
//    public function zaplacono() {
//        $oDb = new Database();
//        //$oDb->update(table::SHOP_ORDERS, array('paid'=>'Y'), array('id_order'=>1));
//        echo 'OK';
//    }
    
    public function check() {
        //$oDb = new Database();
        $oCheck = $this->_oDotpay->CheckPayment();
        echo $oCheck->Value;
    }
}
?>
