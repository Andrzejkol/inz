<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * ajaxy do appki
 */
class Olishop_Ajax_Controller  extends Controller_Core {

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
      
        $this->oOlishop = new Olishop_Model();
    }

    public function test() {
        $orders = $this->oOlishop->FindAllOrders()->Value;
        $order_list = array();
        foreach ($orders as $order) {
            array_push($order_list, $order);
        }
          echo json_encode($order_list);
        //echo $order_list;
      //  var_dump($order_list);
    }
     public function test2($id) {
        $order_det = $this->oOlishop->GetOrderDetails($id)->Value;
        $order_list = array();
        foreach ($order_det as $order) {
            array_push($order_list, $order);
        }
          echo json_encode($order_list[0]);
        //echo $order_list;
      //  var_dump($order_list);
        
    }

}
?>
