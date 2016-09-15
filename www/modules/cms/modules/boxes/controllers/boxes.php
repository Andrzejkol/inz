<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Boxes_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_boxes = new Boxes_Model();
        $this->_elements = new Element_Model();
        $this->_oTemplate->header->hover = 'boxes';
    }

    /**
     *
     */
    public function index() {
        $this->authorize('boxes', 'index');

        $limit = layer::ADMIN_PER_PAGE;

        if (get_class($this->_boxes->getAllBoxesSet()) == 'ErrorReporting') {
            $oPagination = null;
            $offset = 0;
            $msg = 'empty results';
        } else {
            $oPagination = layer::GetPagination($this->_boxes->get($id_boxes)->Value->count(), '', $limit);
            $offset = $oPagination->sql_offset;
        }

        $this->_oTemplate->content->main_content = new View('admin_boxes_index');
        $this->_oTemplate->title = Kohana::lang('admin.boxes.index_site_title');
        $this->_oTemplate->content->main_content->oBoxes = $this->_boxes->getAllBoxesSet()->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->render(true);
    }

    /**
     * 	TODO: dopracować ten skrypt. W pobieraniu boxów musi brać pod uwagę limit i offset
     */
    public function list_boxes($id_boxes_set) {
        $this->authorize('boxes', 'index');

        $limit = layer::ADMIN_PER_PAGE;

        $oPagination = layer::GetPagination($this->_boxes->get($id_boxes_set)->Value->count(), '', $limit);
        $offset = $oPagination->sql_offset;
        $offset = 0;

        $this->_oTemplate->content->main_content = new View('admin_boxes_list');
        $this->_oTemplate->title = Kohana::lang('boxes.admin_boxes_index_list_title');
        $this->_oTemplate->content->main_content->boxes_set_id = $id_boxes_set;
        $this->_oTemplate->content->main_content->oBoxes = $this->_boxes->get($id_boxes_set)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->render(true);
    }

    public function edit($id_boxes) {
        $this->authorize('boxes', 'edit');
        if (!empty($_POST)) {
            $result = $this->_boxes->UpdateBoxesSet($id_boxes, $_POST);
            $this->_oTemplate->content->msg = $result->__toString();
            if ($result->Value) {
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/boxes/edit/' . $id_boxes);
                } else {
                    url::redirect('4dminix/boxes');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin_boxes_edit');
        $this->_oTemplate->title = Kohana::lang('boxes.admin_boxes_index_site_title');
        $oBox = $this->_boxes->getBoxesSet($id_boxes);
        $this->_oTemplate->content->main_content->box = $oBox->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oBox->lang)->Value;
        $oBox2 = $this->_boxes->getBoxesSet($id_boxes)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oBox2[0]->element_id)->Value;
        $this->_oTemplate->render(true);
    }

    public function editBox($id_box, $boxes_set_id, $iPageId = null) {
        $this->authorize('boxes', 'edit');
        if (!empty($_POST)) {
            
            $result = $this->_boxes->edit($id_box, $_POST, $_FILES);
            $this->_oTemplate->content->msg = $result->__toString();
            $this->_oSession->set('message', $result->__toString());
            if ($result->Value) {
                if (!empty($iPageId)) {
                    url::redirect('4dminix/strona/' . $iPageId);
                } else if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/boxes/' . $boxes_set_id);
                } else {
                    url::redirect('4dminix/box/edit/' . $id_box.'/'. $boxes_set_id);
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin_box_edit');
        $this->_oTemplate->title = Kohana::lang('admin.boxes.edit_box');
        $this->_oTemplate->content->main_content->oBoxes = $this->_boxes->getBox2Edit($id_box)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->render(true);
    }

    public function addBox($boxes_set_id, $iPageId = null) {
        $this->authorize('boxes', 'add');
        if (!empty($_POST)) {
            $valid_check = $this->_boxes->ValidateAddBox($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_boxes->add($_POST, $_FILES);

                $this->_oSession->set('message', $result->__toString());
                if ($result->Value !== false) {
                    if (!empty($iPageId)) {
                        url::redirect('4dminix/strona/' . $iPageId);
                    } else {
                        url::redirect('4dminix/boxes/' . $boxes_set_id);
                    }
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_box_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->boxes_set_id = $boxes_set_id;
        $this->_oTemplate->title = Kohana::lang('admin.boxes.add_box');
        $this->_oTemplate->render(true);
    }

    public function add_boxes($iPageId = null) {
        $this->authorize('boxes', 'add');
        if (!empty($_POST)) {
            $valid_check = $this->_boxes->ValidateAddBoxes($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_boxes->InsertBoxes($_POST);
                $this->_oSession->set('message', $result->__toString());
                if ($result->Value !== false) {
                    if (isset($_POST['submit_back'])) {
                        url::redirect('4dminix/boxes');
                    } else {
                        url::redirect('4dminix/boxes');
                    }
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_boxes_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->title = Kohana::lang('admin.boxes.add_block');
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages()->Value;
        $this->_oTemplate->content->main_content->iPageId = $iPageId;
        $this->_oTemplate->render(true);
    }

    public function delete($boxes_set_id = null) {
        $this->authorize('boxes', 'delete');

        if (!empty($_POST['boxes_check'])) {
            $this->_oSession->set('message', $this->_boxes->DeleteBoxesSetArray($_POST['boxes_check'])->__toString());
            url::redirect('4dminix/boxes');
        } else if (!empty($boxes_set_id)) {
            $this->_oSession->set('message', $this->_boxes->DeleteBoxesSet($boxes_set_id)->__toString());
            url::redirect('4dminix/boxes');
        } else {
            url::redirect('4dminix/boxes');
        }
    }

    public function deleteBox($boxes_id = null, $boxes_set_id = null, $iPageId = null) {
        $this->authorize('boxes', 'delete');
        if (!empty($_POST['box_check'])) {
            $aBoxes = $_POST['box_check'];
            $this->_oSession->set('message', $this->_boxes->DeleteBoxesArray($aBoxes)->__toString());
            if (!empty($_POST['page_id'])) {
                url::redirect('4dminix/strona/' . $_POST['page_id']);
            } else if ($_POST['boxes_set_id']) {
                url::redirect('4dminix/boxes/' . $_POST['boxes_set_id']);
            } else {
                url::redirect('4dminix/boxes');
            }
        } else if (!empty($boxes_id)) {
            $this->_oSession->set('message', $this->_boxes->DeleteBoxes($boxes_id)->__toString());
        }
        if (!empty($iPageId)) {
            url::redirect('4dminix/strona/' . $iPageId);
        } else if (!empty($boxes_set_id)) {
            url::redirect('4dminix/boxes/' . $boxes_set_id);
        } else {
            url::redirect('4dminix/boxes');
        }
    }

    public function change_elements_positions($boxes_set_id = null, $iPageId = null) {
        $this->authorize('boxes', 'element_position');
        if (!empty($_POST)) {
            $this->_oSession->set('message', $this->_boxes->updateElementsPositions($_POST)->__toString());
            if (!empty($iPageId)) {
                url::redirect('4dminix/strona/' . $iPageId);
            } else {
                url::redirect('4dminix/boxes/' . $boxes_set_id);
            }
        }

        $this->_oTemplate->content->main_content = new View('boxes_change_elements_positions');
        $this->_oTemplate->content->main_content->boxes_set_id = $boxes_set_id;
        $this->_oTemplate->content->main_content->aBoxesElements = $this->_boxes->get($boxes_set_id)->Value;
        $this->_oTemplate->title = 'Zmień kolejność boxów.';
        $this->_oTemplate->render(true);
    }

}
