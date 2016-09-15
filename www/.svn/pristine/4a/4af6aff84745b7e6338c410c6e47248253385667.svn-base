<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Producers_Controller extends Admin_Shop_Controller {

    protected $_oProducer;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oProducer = new Producer_Model();
    }

    public function index() {
        $this->authorize('producers', 'index');
        $this->_oTemplate->content->main_content = new View('admin/producers_index');
        $pagination = layer::GetPagination($this->_oProducer->Count()->Value, '', layer::ADMIN_PER_PAGE);
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->content->main_content->oProducers = $this->_oProducer->FindAll(layer::ADMIN_PER_PAGE, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('producer.producers_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('producers', 'add');
        if (!empty($_POST)) {
            if ($this->_oProducer->ValidateInsert($_POST, $_FILES)->Value === true) {
                $result = $this->_oProducer->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_producenta');
                        break;
                    default:
                        url::redirect('4dminix/producenci');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/producer_add');
        $this->_oTemplate->title = Kohana::lang('producer.add_producer');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function edit($id) {
        $this->authorize('producers', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            if ($this->_oProducer->ValidateUpdate($_POST, $_FILES)->Value === true) {
                $result = $this->_oProducer->Update($id, $_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_producenta/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/producenci');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/producer_edit');
        $this->_oTemplate->content->main_content->oProducerDetails = $this->_oProducer->Find($id)->Value[0];
        $this->_oTemplate->title = Kohana::lang('producer.edit_producer');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('producers', 'delete');
        $result = $this->_oProducer->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/producenci');
    }

    public function ajax_validate_producers() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if (empty($_POST['producer_name']) || $_POST['producer_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('producer.validation.error_producer_name_empty'));
            $element->addAttribute('id', 'producer_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function change_elements_positions() {
        $this->authorize('producers', 'index');
        if (!empty($_POST)) {
            $this->_oSession->set('message', $this->_oProducer->updateElementsPositions($_POST)->__toString());
            url::redirect('4dminix/producenci');
        }

        $this->_oTemplate->content->main_content = new View('admin/producer_change_position');
        $this->_oTemplate->content->main_content->oProducers = $this->_oProducer->FindAll(null, null)->Value;
        $this->_oTemplate->title = Kohana::lang('slider.admin_slider_elements_positions_site_title');
        $this->_oTemplate->render(true);
    }

}
