<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Orders_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $sort = array();
        if (!empty($_GET['orderby'])) {
            if (!empty($_GET['order_type']) && $_GET['order_type'] == 'DESC') {
                $sort[$_GET['orderby']] = 'DESC';
            } else {
                $sort[$_GET['orderby']] = 'ASC';
            }
        } else {
            $sort['order_date'] = 'DESC';
        }
        $args = array();
        if (!empty($_GET['filter'])) {
            if (!empty($_GET['date_order_from'])) {
                $df = explode('-', $_GET['date_order_from']);
                $args['date_order_from'] = mktime(0, 0, 0, $df[1], $df[0], $df[2]) + date('Z'); // date('Z'); -> offset ze względu na strefę czasową
            }
            if (!empty($_GET['date_order_to'])) {
                $dt = explode('-', $_GET['date_order_to']);
                $args['date_order_to'] = mktime(23, 59, 59, $dt[1], $dt[0], $dt[2]) + date('Z'); // date('Z'); -> offset ze względu na strefę czasową
            }
            if (!empty($_GET['order_number'])) {
                $args['order_number'] = $_GET['order_number'];
            }
            if (!empty($_GET['orders_status_search'])) {
                $args['status_id'] = $_GET['orders_status_search'];
            }
            if (!empty($_GET['order_first_name'])) {
                $args['customer_first_name'] = $_GET['order_first_name'];
            }
            if (!empty($_GET['order_last_name'])) {
                $args['customer_last_name'] = $_GET['order_last_name'];
            }
            if (!empty($_GET['order_mail'])) {
                $args['customer_email'] = $_GET['order_mail'];
            }
        }
        $this->authorize('orders', 'index');
        $this->_oOrder->Count($args, $sort)->Value;

        $pagination = layer::GetPagination($this->_oOrder->Count($args, $sort)->Value, 'admin_digg', layer::ADMIN_PER_PAGE);
        //var_dump($pagination);
        $this->_oTemplate->content->main_content = new View('admin/orders_index');
        $this->_oTemplate->content->main_content->oOrders = $this->_oOrder->FindAllOrders(null, null, layer::ADMIN_PER_PAGE, $pagination->sql_offset, $args, $sort)->Value;
        $this->_oTemplate->content->main_content->aOrdersStatuses = $this->_oOrder->GetOrdersStatuses(true)->Value;
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->title = Kohana::lang('order.titles.orders_index');
        $this->_oTemplate->render(true);
    }

    /**
     * @param Integer $iOrderId
     */
    public function edit($iOrderId) {
        $this->authorize('orders', 'edit');
        $iOrderId += 0;
        if (!empty($_POST['cmd'])) {
            switch ($_POST['cmd']) {
                case 'change_state':
                    $this->_oOrder->ChangeDelivieryComments($iOrderId, $_POST['orders_comments_edit']);
                    $result = $this->_oOrder->ChangeStatus($_POST['orders_status_search'], $iOrderId);
                    $this->_oSession->set('message', $result->Message);
                    url::redirect('4dminix/edytuj_zamowienie/' . $iOrderId);
                    break;
            }
        }
        if (!empty($_POST['paid_submit'])) {
            $result = $this->_oOrder->ChangePaid($_POST['paid'], $iOrderId);
            $this->_oSession->set('message', $result->Message);
            url::redirect('4dminix/edytuj_zamowienie/' . $iOrderId);
        }

        $oCustomer = new Customer_Model();
        $this->_oTemplate->content->main_content = new View('admin/order_edit');
//                $oOrder = new Order_Model($iOrderId);
        $this->_oTemplate->content->main_content->oOrderDetails = $this->_oOrder->FindOrder(array('id_order' => $iOrderId))->Value;
        $this->_oTemplate->content->main_content->aOrdersStatuses = $this->_oOrder->GetOrdersStatuses(true)->Value;
        $this->_oTemplate->content->main_content->oOrdersProducts = $this->_oOrder->GetOrdersProducts($iOrderId)->Value;
        $this->_oTemplate->content->main_content->oCustomerDetails = $oCustomer->GetOrderCustomer($iOrderId)->Value;
        $this->_oTemplate->content->main_content->aProductAttr = $this->_oAttribute->GetAttributesAsArray()->Value;
        $this->_oTemplate->content->main_content->aStates = layer::GetStates()->Value;
        $this->_oTemplate->title = Kohana::lang('order.titles.order_edit');
        $this->_oTemplate->render(true);
    }

    /**
     * @param Integer $iId
     */
    public function delete($iOrderId = null) {
        $this->authorize('orders', 'delete');
        if (!empty($_POST['order_check'])) {
            $result = $this->_oOrder->DeleteOrdersArray($_POST['order_check']);
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/zamowienia');
        } else if ($iOrderId) {
            $result = $this->_oOrder->DeleteOrder($iOrderId);
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/zamowienia');
        }
    }

    /**
     * @todo: coś dziwna ta funkcja :) chyba tez model jest niepotrzebnie w niej tworzony
     */
    public function change_state() {
        header('Content-type: text/html; charset=utf8');
        if (!empty($_POST['oid']) && !empty($_POST['sid'])) {
            $db = new Order_Model();
            echo $db->ChangeStatus($_POST['sid'], $_POST['oid'])->Message;
            exit;
        }
        echo '';
        exit;
    }

}
