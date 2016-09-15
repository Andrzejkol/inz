<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_vouchers_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oVoucher = new Voucher_Model();
    }

    public function index() {
        $this->authorize('products', 'index');
        $this->_oTemplate->content->main_content = new View('admin/vouchers/index');
        $this->_oTemplate->content->main_content->oVouchers = $this->_oVoucher->FindAll()->Value;
        $this->_oTemplate->title = 'Vouchery';
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('products', 'add');
        if (!empty($_POST)) {
            $oCheck = $this->_oVoucher->ValidateInsert($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oVoucher->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_voucher');
                        break;
                    default:
                        url::redirect('4dminix/vouchery');
                        break;
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/vouchers/add');
        $this->_oTemplate->title = 'Dodaj voucher';
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('products', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            $oCheck = $this->_oVoucher->ValidateUpdate($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oVoucher->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_voucher/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/vouchery');
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/vouchers/edit');
        $this->_oTemplate->content->main_content->oRebateCodeDetails = $this->_oVoucher->Find($id)->Value[0];
        $this->_oTemplate->title = 'Edytuj voucher';
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('products', 'delete');
        $result = $this->_oVoucher->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/vouchery');
    }


}
