<?php

class Admin_Payment_Types_Controller extends Admin_Shop_Controller {

    protected $_oPaymentType;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oPaymentType = new Payment_Type_Model();
    }

    public function index() {
        $this->authorize('payment_types', 'index');
        $this->_oTemplate->content->main_content = new View('admin/payment_type/index');
        $this->_oTemplate->content->main_content->oPaymentTypes = $this->_oPaymentType->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('payment_type.payment_types_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('payment_types', 'add');
        if (!empty($_POST)) {
            $oCheck = $this->_oPaymentType->ValidateInsert($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oPaymentType->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_typ_platnosci');
                        break;
                    default:
                        url::redirect('4dminix/typy_platnosci');
                        break;
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/payment_type/add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->title = Kohana::lang('payment_type.add_payment_type');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('payment_types', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            $oCheck = $this->_oPaymentType->ValidateUpdate($_POST);
            if ($oCheck->Value === true) {
                $result = $this->_oPaymentType->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_typ_platnosci/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/typy_platnosci');
                }
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/payment_type/edit');
        $this->_oTemplate->content->main_content->oPaymentTypeDetails = $this->_oPaymentType->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->title = Kohana::lang('payment_type.edit_payment_type');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('payment_types', 'delete');
        $result = $this->_oPaymentType->DeletePaymentType($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/typy_platnosci');
    }

    public function ajax_validate_payment_type() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['payment_type']) || $_POST['payment_type'] == '') {
            $element = $xml->addChild('error', Kohana::lang('payment_type.validation.error_payment_type_empty'));
            $element->addAttribute('id', 'payment_type');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (!empty($_POST['payment_cost'])) {
            if (valid::numeric($_POST['payment_cost']) == true) {
                if ($_POST['payment_cost'] < 0) {
                    $element = $xml->addChild('error', Kohana::lang('payment_type.validation.error_payment_cost_less_than_zero'));
                    $element->addAttribute('id', 'payment_cost');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
            } else {
                $element = $xml->addChild('error', Kohana::lang('payment_type.validation.error_payment_cost_not_number'));
                $element->addAttribute('id', 'payment_cost');
                $element->addAttribute('class', 'error');
                $counter++;
            }
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
