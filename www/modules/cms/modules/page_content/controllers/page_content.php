<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Page_content_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_page_content = new Page_content_Model();
        $this->_oTemplate->header->hover = 'elements';
    }

    /**
     *
     */
    public function add_page_content($iPageId = null) {
        $this->authorize('page_content', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            $valid_check = $this->_page_content->ValidatePageContent($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_page_content->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/zawartosc_strony');
                } else {
                    unset($_POST);
                    //url::redirect('4dminix/edytuj_zawartosc_strony/' . $result->Value);
                }
            } else {
                $this->_oTemplate->msg = $valid_check->__toString();
            }
        }
        // widoki
        $this->_oTemplate->content->main_content = new View('admin_page_content_add');
        // zmienne do widokow

        $sLanguage = 'pl_PL';

        if (!empty($iPageId)) {
            $oPageData = $this->_oPage->GetPage($iPageId)->Value;
            $sLanguage = $oPageData[0]->lang;
        }

        $this->_oTemplate->title = Kohana::lang('page_content.admin_page_content_add_site_title');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $sLanguage)->Value;
        $this->_oTemplate->content->main_content->iPageId = $iPageId;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iPageContentId
     */
    public function edit_page_content($iPageContentId) {
        $this->authorize('page_content', 'edit');

        if (!empty($_POST)) {
            $valid_check = $this->_page_content->ValidatePageContent($_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_page_content->Update($iPageContentId, $_POST)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/zawartosc_strony');
                } else {
                    url::redirect('4dminix/edytuj_zawartosc_strony/' . $iPageContentId);
                }
				
                unset($_POST);
            } else {
                $this->_oTemplate->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_page_content_edit');

        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('page_content.admin_page_content_edit_site_title');
        $oPageContentDetails = $this->_page_content->GetPageContent($iPageContentId)->Value;
        $this->_oTemplate->content->main_content->page_content = $oPageContentDetails;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oPageContentDetails[0]->lang)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oPageContentDetails[0]->element_id)->Value;

        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function list_page_content() {
        $this->authorize('page_content', 'index');

        $count = count($this->_page_content->GetAllPagesContents()->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_page_content_list');
        $this->_oTemplate->title = Kohana::lang('page_content.admin_page_content_list_site_title');
        $this->_oTemplate->content->main_content->page_content = $this->_page_content->GetAllPagesContents($limit, $offset)->Value;
		$this->_oTemplate->content->main_content->page_content2 = $this->_page_content->GetAllPagesContents($limit, $offset)->Value; 		
		
		$temp=$this->_page_content->GetAllPagesContents($limit, $offset)->Value; 

        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iPageContent
     */
    public function delete_page_content($iPageContent = null) {
        $this->authorize('page_content', 'delete');

        if (!empty($_POST['page_content_check'])) {
            $aPageContents = $_POST['page_content_check'];
            $this->_oSession->set('message', $this->_page_content->DeleteArray($aPageContents)->__toString());
            url::redirect('4dminix/zawartosc_strony');
        } else if (!empty($iPageContent)) {
            $this->_oSession->set('message', $this->_page_content->Delete($iPageContent)->__toString());
            url::redirect('4dminix/zawartosc_strony');
        } else {
            url::redirect('4dminix/zawartosc_strony');
        }
    }

}