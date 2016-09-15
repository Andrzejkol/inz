<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Rebates_Groups_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oRebateGroup = new Rebate_Group_Model();
    }

    public function index() {
        $this->authorize('rebates_groups', 'index');
        $this->_oTemplate->content->main_content = new View('admin/rebates_groups_index');
        $this->_oTemplate->content->main_content->oRebatesGroups = $this->_oRebateGroup->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('rebate_group.rebates_groups_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('rebates_groups', 'add');
        if (!empty($_POST)) {
            if ($this->_oRebateGroup->ValidateInsert($_POST)->Value === true) {
                $result = $this->_oRebateGroup->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_grupe_rabatowa');
                        break;
                    default:
                        url::redirect('4dminix/grupy_rabatowe');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/rebates_group_add');
        $this->_oTemplate->title = Kohana::lang('rebate_group.add_rebate_group');
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('rebates_groups', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oRebateGroup->ValidateUpdate($_POST)->Value === true) {
                $result = $this->_oRebateGroup->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_grupe_rabatowa/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/grupy_rabatowe');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/rebates_group_edit');
        $this->_oTemplate->content->main_content->oRebateGroupDetails = $this->_oRebateGroup->Find($id)->Value[0];
        $this->_oTemplate->title = Kohana::lang('rebate_group.edit_rebate_group');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('rebates_groups', 'delete');
        $result = $this->_oRebateGroup->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/grupy_rabatowe');
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
