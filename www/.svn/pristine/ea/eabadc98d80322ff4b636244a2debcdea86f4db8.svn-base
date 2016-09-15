<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *
 */
class Orders_Ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;


    public function __construct() {
        parent::__construct();
        $this->_oOrder = new Order_Model();
    }

    public function search_order() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/html; charset=utf-8');
        $v = new View('admin/orders_index');
        $v->oOrders = $this->_oOrder->FindOrderByOrderNumber($_POST)->Value;
        $v->aOrdersStatuses = $this->_oOrder->GetOrdersStatuses(true)->Value;
        echo $v->render(true);
    }

    public function change_status() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/html; charset=utf8');
        $state = '';
        if(!empty($_POST['id_order']) && !empty($_POST['status_id'])) {
            $db = new Order_Model();
            $result = $db->ChangeStatus($_POST['status_id'], $_POST['id_order']);
            echo $result->Message;
            exit;
        }
        echo Kohana::lang('order.cannot_update_status');
        exit;
    }
}