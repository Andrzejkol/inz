<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_taxes_Controller extends Admin_Shop_Controller {

    public function __construct() {
        parent::__construct();
        $this->_oTax = new Tax_Model();
    }

    /**
     *
     */
    public function index() {
        $this->authorize('taxes', 'index');
        $this->_oTemplate->content->main_content = new View('admin/taxes_index');
        $this->_oTemplate->content->main_content->oTaxes = $this->_oTax->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('tax.taxes_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add() {
        $this->authorize('taxes', 'add');
        if (!empty($_POST)) {
            if ($this->_oTax->ValidateInsert($_POST)->Value === true) {
                $result = $this->_oTax->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_stawke_vat');
                        break;
                    default:
                        url::redirect('4dminix/stawki_vat');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/tax_add');
        $this->_oTemplate->title = Kohana::lang('tax.add_tax');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('taxes', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oTax->ValidateUpdate($_POST)->Value === true) {
                $result = $this->_oTax->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_stawke_vat/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/stawki_vat');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/tax_edit');
        $this->_oTemplate->content->main_content->oTaxDetails = $this->_oTax->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->iTaxId = $id;
        $this->_oTemplate->title = Kohana::lang('tax.edit_tax');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('taxes', 'delete');
        $result = $this->_oTax->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/stawki_vat');
    }

    /**
     *
     */
    public function ajax_validate_taxes() {
        $this->_db = new Database();
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['tax_name']) || $_POST['tax_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('tax.validation.error_tax_name_empty'));
            $element->addAttribute('id', 'tax_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (isset($_POST['tax_value'])) { // jest zdefiniowana wartosc vat
            if (valid::digit($_POST['tax_value']) == true) {
                if ($_POST['tax_value'] < 0) {
                    $element = $xml->addChild('error', Kohana::lang('tax.validation.error_tax_value_less_than_zero'));
                    $element->addAttribute('id', 'tax_value');
                    $element->addAttribute('class', 'error');
                    $counter++;
                } else { // wartosc liczbowa to sprawdzamy czy juz istnieje
                    $_POST['tax_id']+=0;
                    $this->_db->from(table::SHOP_TAXES)
                            ->where(array('tax_value' => $_POST['tax_value']))
                            ->select('COUNT(*) AS ile');

                    if (!empty($_POST['tax_id'])) {
                        $this->_db->where(array('id_tax!=' => $_POST['tax_id']));
                    }

                    $oCheckTaxes = $this->_db->get();

                    if ($oCheckTaxes[0]->ile > 0) {
                        $element = $xml->addChild('error', Kohana::lang('tax.validation.error_tax_value_exist'));
                        $element->addAttribute('id', 'tax_value');
                        $element->addAttribute('class', 'error');
                        $counter++;
                    }
                }
            } else {
                $element = $xml->addChild('error', Kohana::lang('tax.validation.error_tax_value_not_number'));
                $element->addAttribute('id', 'tax_value');
                $element->addAttribute('class', 'error');
                $counter++;
            }
        } else {
            $element = $xml->addChild('error', Kohana::lang('tax.validation.error_tax_value_empty'));
            $element->addAttribute('id', 'tax_value');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
