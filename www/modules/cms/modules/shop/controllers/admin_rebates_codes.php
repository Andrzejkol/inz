<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Rebates_Codes_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oRebateCode = new Rebate_Code_Model();
        $this->_oRebateGroup = new Rebate_Group_Model();
    }

    public function index() {
        $this->authorize('rebates_codes', 'index');
        $this->_oTemplate->content->main_content = new View('admin/rebate_codes/index');
        $this->_oTemplate->content->main_content->oRebateCode = $this->_oRebateCode->FindAll()->Value;
        $this->_oTemplate->title = 'Kody rabatowe';
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('rebates_codes', 'add');
        if (!empty($_POST)) {
            $oCheck = $this->_oRebateCode->ValidateInsert($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oRebateCode->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_kod_rabatowy');
                        break;
                    default:
                        url::redirect('4dminix/kody_rabatowe');
                        break;
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/rebate_codes/add');
        $this->_oTemplate->title = 'Dodaj kod rabatowy';
        $this->_oTemplate->content->main_content->oProducts = $this->_oProduct->GetAllProductListing()->Value;
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('rebates_codes', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            $oCheck = $this->_oRebateCode->ValidateUpdate($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oRebateCode->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_kod_rabatowy/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/kody_rabatowe');
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/rebate_codes/edit');
        $this->_oTemplate->content->main_content->oRebateCodeDetails = $this->_oRebateCode->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->oProducts = $this->_oProduct->GetAllProductListing()->Value;
        $this->_oTemplate->content->main_content->aSelectedProducts = $this->_oRebateCode->GetProductForRebate($id, TRUE)->Value;
        $this->_oTemplate->title = 'Edytuj kod rabatowy';
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('rebates_codes', 'delete');
        $result = $this->_oRebateCode->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/kody_rabatowe');
    }

    public function ajax_validate_rebates_groups() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['group_name']) || $_POST['group_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('rebate_group.validation.error_group_name_empty'));
            $element->addAttribute('id', 'group_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (isset($_POST['rebate'])) { // jest zdefiniowana wartosc vat
            if (valid::digit($_POST['rebate']) == true) {
                if ($_POST['rebate'] < 0) {
                    $element = $xml->addChild('error', Kohana::lang('rebate_group.validation.error_rebate_less_than_zero'));
                    $element->addAttribute('id', 'rebate');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
            } else {
                $element = $xml->addChild('error', Kohana::lang('rebate_group.validation.error_rebate_not_number'));
                $element->addAttribute('id', 'rebate');
                $element->addAttribute('class', 'error');
                $counter++;
            }
        } else {
            $element = $xml->addChild('error', Kohana::lang('rebate_group.validation.error_rebate_empty'));
            $element->addAttribute('id', 'rebate');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
