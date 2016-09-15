<?php

class Admin_Delivery_Types_Controller extends Admin_Shop_Controller {

    protected $_oDeliveryType;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oDeliveryType = new Delivery_Type_Model();
    }

    public function index() {
        $this->authorize('delivery_types', 'index');
        $this->_oTemplate->content->main_content = new View('admin/delivery_types_index');
        $this->_oTemplate->content->main_content->oDeliveryTypes = $this->_oDeliveryType->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('delivery_type.delivery_types_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('delivery_types', 'add');
        if (!empty($_POST)) {
            if ($this->_oDeliveryType->ValidateInsert($_POST)->Value === true) {
                $result = $this->_oDeliveryType->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_typ_dostawy');
                        break;
                    default:
                        url::redirect('4dminix/typy_dostaw');
                        break;
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin/delivery_type_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->title = Kohana::lang('delivery_type.add_delivery_type');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('delivery_types', 'edit');
        $id += 0;
        if (!empty($_POST['submit'])) {
            if ($this->_oDeliveryType->ValidateUpdate($_POST)->Value === true) {
                $result = $this->_oDeliveryType->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_typ_dostawy/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/typy_dostaw');
                }
            }
        } else if (!empty($_POST['add_range'])) { // dodajemy koszt dostawy dla przedzialu
            $oCheck = $this->_oDeliveryType->DeliveryRangeAddValidate($id, $_POST);
            if ($oCheck->Value === TRUE) {
                $oAdd = $this->_oDeliveryType->DeliveryRangeAdd($id, $_POST);
                $this->_oTemplate->content->msg = $oAdd->__toString();
                unset($_POST);
            } else {
                $this->_oTemplate->content->msg = $oCheck->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/delivery_type_edit');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->oDeliveryTypeDetails = $this->_oDeliveryType->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->oDeliveryRanges = $this->_oDeliveryType->DeliveryRangeGet($id)->Value;
        $this->_oTemplate->title = Kohana::lang('delivery_type.edit_delivery_type');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('delivery_types', 'delete');
        $result = $this->_oDeliveryType->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/typy_dostaw');
    }

    public function delete_range($iRangeId, $iDeliveryId) {
        $this->authorize('delivery_types', 'edit');
        $result = $this->_oDeliveryType->DeleteRange($iRangeId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/edytuj_typ_dostawy/' . $iDeliveryId);
    }

    public function ajax_validate_delivery_type() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['delivery_type']) || $_POST['delivery_type'] == '') {
            $element = $xml->addChild('error', Kohana::lang('delivery_type.validation.error_delivery_type_empty'));
            $element->addAttribute('id', 'delivery_type');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        /*    if (!empty($_POST['delivery_cost'])) {
          if (valid::numeric($_POST['delivery_cost']) == true) {
          if ($_POST['delivery_cost'] < 0) {
          $element = $xml->addChild('error', Kohana::lang('delivery_type.validation.error_delivery_cost_less_than_zero'));
          $element->addAttribute('id', 'delivery_cost');
          $element->addAttribute('class', 'error');
          $counter++;
          }
          } else {
          $element = $xml->addChild('error', Kohana::lang('delivery_type.validation.error_delivery_cost_not_number'));
          $element->addAttribute('id', 'delivery_cost');
          $element->addAttribute('class', 'error');
          $counter++;
          }
          } */
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
