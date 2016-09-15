<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Products_Statuses_Controller extends Admin_Shop_Controller {

    protected $_oProductStatus;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oProductStatus = new Product_Status_Model();
    }

    public function index() {
        $this->authorize('products_statuses', 'index');
        $this->_oTemplate->content->main_content = new View('admin/products_statuses_index');
        $this->_oTemplate->content->main_content->oProductsStatuses = $this->_oProductStatus->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('product_status.products_statuses_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('products_statuses', 'add');
        if (!empty($_POST)) {
            if ($this->_oProductStatus->ValidateInsert($_POST)->Value === true) {
                $result = $this->_oProductStatus->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_status_produktu');
                        break;
                    default:
                        url::redirect('4dminix/statusy_produktow');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/product_status_add');
        $this->_oTemplate->title = Kohana::lang('product_status.add_product_status');
        $this->_oTemplate->render(true);
    }

    public function edit($id) {
        $this->authorize('products_statuses', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oProductStatus->ValidateUpdate($_POST)->Value === true) {
                $result = $this->_oProductStatus->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_status_produktu/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/statusy_produktow');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/product_status_edit');
        $this->_oTemplate->content->main_content->oProductStatusDetails = $this->_oProductStatus->Find($id)->Value[0];
        $this->_oTemplate->title = Kohana::lang('product_status.edit_product_status');
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('products_statuses', 'delete');
        $result = $this->_oProductStatus->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/statusy_produktow');
    }

    public function ajax_validate_product_status() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['product_status_name']) || $_POST['product_status_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product_status.validation.error_product_status_name_empty'));
            $element->addAttribute('id', 'product_status_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
