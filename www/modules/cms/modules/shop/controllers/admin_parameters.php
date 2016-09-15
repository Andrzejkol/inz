<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Parameters_Controller extends Admin_Shop_Controller {

    protected $_oParameter;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oParameter = new Parameter_Model();
    }

    public function index() {
        $this->authorize('parameters', 'index');
        $this->_oTemplate->content->main_content = new View('admin/parameters_index');
        $pagination = layer::GetPagination($this->_oParameter->Count()->Value);
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->content->main_content->oParameters = $this->_oParameter->FindAll(layer::PER_PAGE, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('parameter.titles.parameters_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('parameters', 'add');
        if (!empty($_POST)) {
            if ($this->_oParameter->ValidateInsert($_POST)) {
                $result = $this->_oParameter->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_parametr');
                        break;
                    default:
                        url::redirect('4dminix/parametry');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/parameter_add');
        $this->_oTemplate->title = Kohana::lang('parameter.titles.add_parameter');
        $this->_oTemplate->content->main_content->oCategories = $this->_oProductCategory->GetCategories('category_name', $this->_lang)->Value;
        $this->_oTemplate->render(true);
    }

    public function edit($id) {
        $this->authorize('parameters', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oParameter->ValidateUpdate($_POST)) {
                $result = $this->_oParameter->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_parametr/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/parametry');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/parameter_edit');
        $this->_oTemplate->content->main_content->oParameterDetails = $this->_oParameter->Find($id)->Value[0];
        $this->_oTemplate->content->main_content->oParameterValues = $this->_oParameter->FindValues($id)->Value;
        $this->_oTemplate->content->main_content->oCategories = $this->_oProductCategory->GetCategories('category_name', $this->_lang)->Value;
        $this->_oTemplate->content->main_content->aCurrentCategories = $this->_oParameter->GetCurrentParameterCategoriesAsArray($id, $this->_lang)->Value;
        $this->_oTemplate->title = Kohana::lang('parameter.titles.edit_parameter');
        $this->_oTemplate->render(true);
    }

    public function edit_value($iId, $sLanguage) {
        $this->authorize('parameters_values', 'edit');
        $iId += 0;
        $sLanguage = strval($sLanguage);
        if (!empty($_POST)) {
            if ($this->_oParameter->ValidateparameterValueEdit($_POST)) {
                $result = $this->_oParameter->UpdateParameterValue($iId, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_wartosc_parametru/' . $iId . '/' . $sLanguage);
                        break;
                    default:
                        url::redirect('4dminix/parametry');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/parameter_value_edit');
        $this->_oTemplate->content->main_content->oParameterValue = $this->_oParameter->FindValue($iId, $sLanguage)->Value[0];
        $this->_oTemplate->title = Kohana::lang('parameter.edit_prameter_value');
        $this->_oTemplate->render(true);
    }

    public function delete($id) {
        $this->authorize('parameters', 'delete');
        $result = $this->_oParameter->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/parametry');
    }

    public function delete_value($iParameterId, $iParameterValueId) {
        $this->authorize('parameters_values', 'delete');
        $result = $this->_oParameter->DeleteValue($iParameterValueId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/edytuj_parametr/' . $iParameterId);
    }

    public function ajax_validate_parameters() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['parameter_name']) || $_POST['parameter_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('parameter.validation.error_parameter_name_empty'));
            $element->addAttribute('id', 'parameter_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if (empty($_POST['countCategories']) || $_POST['countCategories'] == '' || $_POST['countCategories'] == 0) {
            $element = $xml->addChild('error', Kohana::lang('parameter.validation.error_categories_empty'));
            $element->addAttribute('id', 'categories');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function ajax_validate_edit_parameters() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['parameter_name']) || $_POST['parameter_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('parameter.validation.error_parameter_name_empty'));
            $element->addAttribute('id', 'parameter_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if (empty($_POST['countCategories']) || $_POST['countCategories'] == '' || $_POST['countCategories'] == 0) {
            $element = $xml->addChild('error', Kohana::lang('parameter.validation.error_categories_empty'));
            $element->addAttribute('id', 'categories');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
