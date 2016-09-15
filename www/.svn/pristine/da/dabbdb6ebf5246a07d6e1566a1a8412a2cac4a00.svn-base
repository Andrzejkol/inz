<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Attributes_Controller extends Admin_Shop_Controller {

    protected $_oAttribute;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oAttribute = new Attribute_Model();
    }

    public function index() {
        $this->authorize('attributes', 'index');
        $this->_oTemplate->content->main_content = new View('admin/attributes_index');
        $pagination = layer::GetPagination($this->_oAttribute->Count()->Value);
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->content->main_content->oAttributes = $this->_oAttribute->FindAll(layer::PER_PAGE, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('attribute.attributes_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('attributes', 'add');
        if (!empty($_POST)) {
            if ($this->_oAttribute->ValidateAttributeAdd($_POST)) {
                $result = $this->_oAttribute->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_atrybut');
                        break;
                    default:
                        url::redirect('4dminix/atrybuty');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/attribute_add');
        $this->_oTemplate->title = Kohana::lang('attribute.add_attribute');
        $this->_oTemplate->render(true);
    }

    public function add_value($iAttributeId) {
        $this->authorize('attributes_values', 'add');
        $iAttributeId += 0;
        if (!empty($_POST)) {
            if ($this->_oAttribute->ValidateAttributeValueEdit($_POST)) {
                $result = $this->_oAttribute->InsertAttributeValue($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_wartosc_atrybutu/' . $iAttributeId);
                        break;
                    default:
                        url::redirect('4dminix/edytuj_atrybut/' . $iAttributeId);
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/attribute_value_add');
        $this->_oTemplate->content->main_content->iAttributeId = $iAttributeId;
        $this->_oTemplate->title = Kohana::lang('attribute.add_attribute_value');
        $this->_oTemplate->render(true);
    }

    public function edit($id) {
        $this->authorize('attributes', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oAttribute->ValidateAttributeEdit($_POST)) {
                $result = $this->_oAttribute->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_atrybut/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/atrybuty');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/attribute_edit');
        $this->_oTemplate->content->main_content->oAttributeDetails = $this->_oAttribute->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->oAttributeValues = $this->_oAttribute->FindAttributeValues($id)->Value;
        $this->_oTemplate->title = Kohana::lang('attribute.edit_attribute');
        $this->_oTemplate->render(true);
    }

    public function edit_value($iId, $sLanguage) {
        $this->authorize('attributes_values', 'edit');
        $iId += 0;
        $sLanguage = strval($sLanguage);
        if (!empty($_POST)) {
            if ($this->_oAttribute->ValidateAttributeValueEdit($_POST)) {
                $result = $this->_oAttribute->UpdateAttributeValue($iId, $_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_wartosc_atrybutu/' . $iId . '/' . $sLanguage);
                        break;
                    default:
                        $result = $this->_oAttribute->FindAttributeValue($iId, $sLanguage)->Value[0];
                        url::redirect('4dminix/edytuj_atrybut/' . $result->attribute_id);
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/attribute_value_edit');
        $this->_oTemplate->content->main_content->oAttributeValue = $this->_oAttribute->FindAttributeValue($iId, $sLanguage)->Value[0];
        $this->_oTemplate->title = Kohana::lang('attribute.edit_attribute_value');
        $this->_oTemplate->render(true);
    }

    public function delete($id) {
        $this->authorize('attributes', 'delete');
        $result = $this->_oAttribute->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/atrybuty');
    }

    public function delete_value($iAttributeId, $iAttributeValueId) {
        $this->authorize('attributes_values', 'delete');
        $result = $this->_oAttribute->DeleteValue($iAttributeValueId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/edytuj_atrybut/' . $iAttributeId);
    }

    public function ajax_validate_attributes() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['attribute_name']) || $_POST['attribute_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('attribute.validation.error_attribute_name_empty'));
            $element->addAttribute('id', 'attribute_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function ajax_validate_attributes_values() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['attribute_value']) || $_POST['attribute_value'] == '') {
            $element = $xml->addChild('error', Kohana::lang('attribute.validation.error_attribute_value_empty'));
            $element->addAttribute('id', 'attribute_value');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
