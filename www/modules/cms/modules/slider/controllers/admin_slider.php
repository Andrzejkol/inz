<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Admin_Slider_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oSlider = new Slider_Model();
        $this->_oTemplate->header->hover = 'slider';
    }

    /**
     *
     */
    public function index() {
        $this->authorize('slider', 'index');
        if (!empty($_POST) AND ! empty($_POST['slider_check'])) {
            $this->_oSession->set('msg', $this->_oSlider->batchDelete($_POST['slider_check']));
            url::redirect('4dminix/slider');
        }
        $this->_oTemplate->content->main_content = new View('admin/slider_index');
        $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg', NULL);
        $this->_oTemplate->title = Kohana::lang('slider.admin_slider_index_site_title');

        $iSliderElementsCount = $this->_oSlider->GetAll(TRUE)->Value;
        $oPagination = layer::GetPagination($iSliderElementsCount, '', slider_helper::ADMIN_PER_PAGE);

        $this->_oTemplate->content->main_content->iSliderElementsCount = $iSliderElementsCount;
        $aSliderElements = $this->_oSlider->GetAll(FALSE, slider_helper::ADMIN_PER_PAGE, $oPagination->sql_offset, TRUE)->Value;
        $this->_oTemplate->content->main_content->aSliderElements = $aSliderElements;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('slider', 'add');
        if ($this->_oSlider->CheckMaxElements()->Value === TRUE) {
            if (!empty($_POST)) {
                $oValid = $this->_oSlider->ValidateAdd($_POST, $_FILES);
                if ($oValid->Type === ErrorReporting::SUCCESS) {
                    $this->_oSession->set('msg', $this->_oSlider->insert($_POST, $_FILES));
                    url::redirect('4dminix/slider');
                } else {
                    $this->_oSession->set('msg', $oValid->__toString());
                }
            }
            $this->_oTemplate->content->main_content = new View('admin/slider_add');
            $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg', NULL);
            $this->_oTemplate->content->main_content->aNewsTitles = $this->_oSlider->getNewsTitles(TRUE, TRUE)->Value;
            $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
            $this->_oTemplate->title = Kohana::lang('slider.admin_slider_add_site_title');
            $this->_oTemplate->render(true);
        } else {
            $this->_oSession->set('msg', Kohana::lang('slider.max_elements_number_exceeded'));
            url::redirect('4dminix/slider');
        }
    }

    public function edit($iElementId) {
        $this->authorize('slider', 'edit');
        $this->_oTemplate->content->main_content = new View('admin/slider_edit');
        $ElementType = $this->_oSlider->getElement($iElementId)->Value;
        $oSliderElement = $this->_oSlider->getElementDetails($iElementId, $ElementType->slider_type_id)->Value;

        if (!empty($_POST)) {

            if (!empty($_POST['link']) && !empty($_POST['or_link'])) {
                unset($_POST['link']);
            }

            $oValid = $this->_oSlider->ValidateEdit($_POST, $_FILES);

            if ($oValid->Type === ErrorReporting::SUCCESS) {
                $this->_oSession->set('msg', $this->_oSlider->update($iElementId, $_POST, $_FILES));
                url::redirect('4dminix/slider');
            } else {
                $this->_oSession->set('msg', $oValid->__toString());
            }
        }
        $this->_oTemplate->content->main_content->oSliderElement = $oSliderElement;
        $this->_oTemplate->content->main_content->type = $ElementType->slider_type_id;
        $this->_oTemplate->content->main_content->aNewsTitles = $this->_oSlider->getNewsTitles(TRUE, TRUE)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg', NULL);
        //$this->_oTemplate->content->main_content->aNewsTitles = $this->_oSlider->getNewsTitles(TRUE, TRUE)->Value;
        //$this->_oTemplate->title = Kohana::lang('slider.admin_slider_add_site_title');
        $this->_oTemplate->render(true);
    }

    public function delete($iElementId) {
        $this->authorize('slider', 'delete');
        $this->_oSession->set('msg', $this->_oSlider->delete($iElementId)->__toString());
        url::redirect('4dminix/slider');
    }

    public function change_elements_positions() {
        $this->authorize('slider', 'element_position');
        if (!empty($_POST)) {
            $this->_oSession->set('msg', $this->_oSlider->updateElementsPositions($_POST)->__toString());
            url::redirect('4dminix/slider');
        }

        $this->_oTemplate->content->main_content = new View('admin/slider_change_elements_positions');
        $this->_oTemplate->content->main_content->aSliderElements = $this->_oSlider->GetAll(FALSE, NULL, NULL, TRUE)->Value;
        $this->_oTemplate->title = Kohana::lang('slider.admin_slider_elements_positions_site_title');
        $this->_oTemplate->render(true);
    }

}
