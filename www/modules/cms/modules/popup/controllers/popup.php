<?php

class Popup_Controller extends Admin_Controller {

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oPopup = new Popup_Model();
    }

    public function index() {
        $this->authorize('popup', 'index');

        $count = $this->_oPopup->PopupGet(TRUE)->Value;
        $oPagination = layer::GetPagination($count, '', popup_helper::POPUP_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;
        $this->_oTemplate->content->main_content = new View('admin/popup_index');

        $this->_oTemplate->content->main_content->oPopups = $this->_oPopup->PopupGet(NULL, NULL, $limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;

        $this->_oTemplate->title = 'Popupy - lista';
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('popup', 'index');

        $this->_oTemplate->content->main_content = new View('admin/popup_add');
        if (!empty($_POST)) {
            $validations = $this->_oPopup->Validate_add($_POST);
            if ($validations->Value == true) {
                $result = $this->_oPopup->Add($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/popup');
                } else {
                    $this->_oTemplate->content->msg = $result->__toString();
                    unset($_POST);
                }
            } else {
                $this->_oTemplate->content->msg = $validations->__toString();
            }
        }

        $this->_oTemplate->title = 'Popupy - nowy';
        $this->_oTemplate->render(true);
    }

    public function edit($iId) {
        $this->authorize('popup', 'index');

        $this->_oTemplate->content->main_content = new View('admin/popup_edit');

        if (!empty($_POST)) {
            $validations = $this->_oPopup->Validate_add($_POST);
            if ($validations->Value == true) {
                $result = $this->_oPopup->Update($iId, $_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/popup');
                } else {
                    $this->_oTemplate->content->msg = $result->__toString();
                    unset($_POST);
                }
            } else {
                $this->_oTemplate->content->msg = $validations->__toString();
            }
        }
        $oElement = $this->_oPopup->PopupGet(NULL, $iId, 1, 0)->Value;
        $this->_oTemplate->content->main_content->oElement = $oElement[0];


        $this->_oTemplate->title = 'Popupy - nowy';
        $this->_oTemplate->render(true);
    }

    public function delete($iId) {
        $this->authorize('popup', 'index');
        $result = $this->_oPopup->delete($iId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/popup');
    }

}

?>