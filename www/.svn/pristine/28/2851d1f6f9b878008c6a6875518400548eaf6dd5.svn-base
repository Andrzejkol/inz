<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Pages_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    /**
     *
     * @var News_Model
     */
    private $_news;

    /**
     *
     * @var Gallery_Model
     */
    private $_gallery;

    /**
     *
     * @var Poll_Model
     */
    private $_oPoll;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_page_content = new Page_content_Model();
        $this->_news = new News_Model();
        $this->_gallery = new Gallery_Model();
        $this->_oPoll = new Poll_Model();
        $this->_oBoxes = new Boxes_Model();
        $this->_oTemplate->header->hover = 'pages';
    }

    public function homepage() {
        $this->authorize('pages', 'index');

        //widoki
        $this->_oTemplate->content->main_content = new View('admin_homepage');
        //zmienne
        $this->_oTemplate->title = Kohana::lang('pages.site_title');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add_page() {
        $this->authorize('pages', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            $valid_check = $this->_oPage->ValidatePages($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_oPage->InsertPage($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/strony');
                } else {
                    //url::redirect('4dminix/edytuj_strone/' . $result->Value);
                    url::redirect('4dminix/dodaj_strone');
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_pages_add');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('pages.site_title');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(false, 'pl_PL')->Value;
        $this->_oTemplate->render(true);
    }

    public function edit_page($pageID) {
        $this->authorize('pages', 'edit');

        // dzialanie posta
        if (!empty($_POST)) {
            $valid_check = $this->_oPage->ValidatePages($_POST, $pageID);

            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_oPage->UpdatePage($pageID, $_POST, $_FILES)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/strony');
                } else {
                    url::redirect('4dminix/edytuj_strone/' . $pageID);
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }
        // widoki
        $this->_oTemplate->content->main_content = new View('admin_pages_edit');

        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('pages.admin_pages_edit_site_title');

        //$this->_oTemplate->content->main_content->pages = $this->_oPage->GetPage($pageID)->Value;
        $this->_oTemplate->content->main_content->parent = $this->_oPage->GetPageParents($pageID)->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPage($pageID)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;

        $this->_oTemplate->render(true);
    }

    public function list_pages() {
        $this->authorize('pages', 'index');

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_pages_list');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('pages.admin_pages_list_site_title');

        $count = count($this->_oPage->GetAllPages()->Value);

        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetAllPages($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages(false, true)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;

        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $iPageId
     */
    public function delete_page($iPageId = null) {
        $this->authorize('pages', 'delete');

        $valid_check = $this->_oPage->ValidateDeletePages($_POST, $iPageId);
        if ($valid_check->Value === true) {
            if (!empty($_POST['pages_check'])) {
                $aPages = $_POST['pages_check'];
                $this->_oSession->set('message', $this->_oPage->DeletePagesArray($aPages)->__toString());
                url::redirect('4dminix/strony');
            } else if (!empty($iPageId)) {
                $this->_oSession->set('message', $this->_oPage->DeletePage($iPageId)->__toString());
                url::redirect('4dminix/strony');
            } else {
                $this->_oSession->set('message', '<div class="warning">' . Kohana::lang('pages.no_pages_selected_to_delete') . '</div>');
                url::redirect('4dminix/strony');
            }
        } else {
            $this->_oSession->set('message', $valid_check->__toString());
            url::redirect('4dminix/strony');
        }
    }

    /**
     *
     * @param <type> $pageId
     */
    public function edit_page_content($pageId) {
        $this->authorize('pages', 'edit');

        if (!empty($_POST)) {
            //var_dump($_POST);
            switch ($_POST['type_name']) {
                case 'page_content':
                    $valid_check = $this->_page_content->ValidatePageContentByElementId($_POST);
                    if ($valid_check->Value === true) {
                        $this->_oTemplate->content->msg = $this->_page_content->UpdateByElementId($_POST, $_FILES)->__toString();
                    } else {
                        $this->_oTemplate->content->msg = $valid_check->__toString();
                    }
                    break;
                case 'galleries':

                    $i = 0;

                    //	exit;
                    foreach ($_FILES['photo']['name'] as $filename) {

                        //	var_dump($filename);
                        $photo = array(
                            'name' => $_FILES['photo']['name'][$i],
                            'tmp_name' => $_FILES['photo']['tmp_name'][$i],
                            'type' => $_FILES['photo']['type'][$i],
                            'error' => $_FILES['photo']['error'][$i],
                            'size' => $_FILES['photo']['size'][$i]
                        );

                        $validation = $this->_gallery->ValidateAddImage($photo, $_POST);

                        if ($validation->Value == true) {

                            $aErrors[$i] = $this->_gallery->AddImage($_POST, $photo)->__toString();
                        } else {
                            $aErrors[$i] = $validation->__toString();
                        }
                        $i++;
                    }
                    $errorsHtml = array();
                    $errorsHtml = '';


                    if (!empty($aErrors)) {

                        foreach ($aErrors as $aE) {
                            $errorsHtml .= $aE;
                        }
                    }
                    $errorsHtml = Kohana::lang('gallery.following_errors') . ': <ul>' . $errorsHtml . '</ul>';
                    $this->_oTemplate->content->msg = $errorsHtml;



                    //    $this->_oTemplate->content->msg = $this->_gallery->AddImage($_POST, $_FILES)->__toString();
                    break;
                case 'settings':
                    $valid_check = $this->_oPage->ValidatePages($_POST, $pageId);

                    if ($valid_check->Value === true) {
                        $this->_oSession->set('message', $this->_oPage->UpdatePage($pageId, $_POST, $_FILES)->__toString());
                        if (isset($_POST['submit_back'])) {
                            url::redirect('4dminix/strony');
                        } else {
                            url::redirect('4dminix/strona/' . $pageId);
                        }
                    } else {
                        $this->_oTemplate->content->msg = $valid_check->__toString();
                    }
                    break;
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_edit_page_content');
        $this->_oTemplate->content->main_content->pageName = $this->_oPage->GetPage($pageId)->Value[0]->name_page;
        $this->_oTemplate->title = Kohana::lang('pages.admin_edit_page_content_site_title');
        $page_contents = $this->_oPage->GetPageContents($pageId)->Value;
        //var_dump($page_contents);
        $views = array();
        foreach ($page_contents as $pc) {
            switch ($pc->type) {
                case 'page_content':
                    $views[$pc->id_element] = new View('admin_page_content_edit');
                    // zmienne
                    $oPageContentDetails = $this->_page_content->GetPageContentByElementId($pc->id_element)->Value;
                    $views[$pc->id_element]->page_content = $oPageContentDetails;
                    $views[$pc->id_element]->title = (!empty($views[$pc->id_element]->page_content[0]->title)) ? 'Treść strony: ' . $views[$pc->id_element]->page_content[0]->title : 'zawartosc strony';
                    $views[$pc->id_element]->bNoSitesCheck = true;
                    break;
                case 'galleries':
                    $views[$pc->id_element] = new View('admin_gallery_view');
                    // zmienne
                    $oGalleryDetails = $this->_gallery->GetGalleryByElementId($pc->id_element)->Value;
//                            $count = $this->_gallery->GetGalleryByElementId($pc->id_element)->Value->count();
                    $views[$pc->id_element]->gallery = $oGalleryDetails;
                    $views[$pc->id_element]->galleryId = $oGalleryDetails[0]->id_gallery;
                    $views[$pc->id_element]->photos = $this->_gallery->GetPhotosByElementId($pc->id_element)->Value;
                    $views[$pc->id_element]->title = 'Galeria: ' . $views[$pc->id_element]->gallery[0]->name;
                    $views[$pc->id_element]->iPageId = $pageId;
                    break;
                case 'news':
                    $views[$pc->id_element] = new View('admin_news_list_ajax');
                    // zmienne
                    $oCategory = $this->_news->GetNewsCategoryForElement($pc->id_element)->Value;
                    $count = $this->_news->CountNewsForCategory($oCategory[0]->id_news_category)->Value;
                    $pagination = new Pagination(array(
                        'base_url' => 'news_ajax/get_news_table/' . $pc->id_element . '/', // base_url will default to current uri
                        'uri_segment' => 'page', // pass a string as uri_segment to trigger former 'label' functionality
                        'total_items' => $count, //$news->count(), // use db count query here of course
                        'items_per_page' => news_helper::PER_PAGE, // it may be handy to set defaults for stuff like this in config/pagination.php
                        'style' => 'default_ajax', // pick one from: classic (default), digg, extended, punbb, or add your own!
                        'auto_hide' => TRUE,
                    ));
                    $oNewsDetails = $this->_news->GetAllNews($oCategory[0]->id_news_category, $pagination->items_per_page, $pagination->sql_offset)->Value;
                    $views[$pc->id_element]->news = $oNewsDetails;
                    $views[$pc->id_element]->pagination = $pagination;
                    $views[$pc->id_element]->pagination->elementId = $pc->id_element;
                    $views[$pc->id_element]->title = Kohana::lang('pages.news') . ': ' . $oCategory[0]->news_category_name;
//                            $views[$pc->id_element]->news = $this->_news->GetNewsByElementId($pc->id_element)->Value;
                    $views[$pc->id_element]->languages = $this->_oLanguage->GetLanguages()->Value;
                    $views[$pc->id_element]->iCategoryId = $oCategory[0]->id_news_category;
                    $views[$pc->id_element]->iPageId = $pageId;
                    break;

                case 'boxes':
                    if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'index')->Value == true) {
                        $views[$pc->id_element] = new View('admin_boxes_list');
                        $boxes_set = $this->_oBoxes->getBoxesSetByElement($pc->id_element)->Value;
                        $views[$pc->id_element]->oBoxes = $this->_oBoxes->get($boxes_set[0]->id_boxes_set)->Value;
                        $views[$pc->id_element]->title = 'Boksy : ' . $boxes_set[0]->name;
                        $views[$pc->id_element]->boxes_set_id = $boxes_set[0]->id_boxes_set;
                        $views[$pc->id_element]->iPageId = $pageId;
                        // dorobić paginację
                    }
                    break;

                case 'polls':
                    $views[$pc->id_element] = new View('admin_polls_index_ajax');
//                            $iTotalItems = $this->_oPoll->GetCategoriesForPage($pageId, true)->Value; // ten count powinien być robiony na sondach umieszczonych na tej stronie
                    $iPerpage = polls_helper::PERPAGE;
                    $oCategoryDetails = $this->_oPoll->GetCategoryForElementId($pc->id_element)->Value;
                    $oPolls = $this->_oPoll->FindAll($oCategoryDetails[0]->id_poll_category/* , $iPerpage, $pagination->sql_offset */)->Value;
                    $pagination = new Pagination(
                            array(
                        'base_url' => 'polls_ajax/get_polls_table/' . $pc->id_element . '/', // base_url will default to current uri
                        'uri_segment' => 'page', // pass a string as uri_segment to trigger former 'label' functionality
                        'total_items' => $oPolls->count(), //$news->count(), // use db count query here of course
                        'items_per_page' => $iPerpage, // it may be handy to set defaults for stuff like this in config/pagination.php
                        'style' => 'default_ajax', // pick one from: classic (default), digg, extended, punbb, or add your own!
                        'auto_hide' => TRUE,
                            )
                    );
                    $views[$pc->id_element]->iCategoryId = $oCategoryDetails[0]->id_poll_category;
                    $views[$pc->id_element]->oPolls = $this->_oPoll->FindAll($oCategoryDetails[0]->id_poll_category, $iPerpage, $pagination->sql_offset)->Value;
                    $views[$pc->id_element]->title = Kohana::lang('pages.polls') . ': ' . $oCategoryDetails[0]->category_name;
                    $views[$pc->id_element]->pagination = $pagination;
                    $views[$pc->id_element]->iPageId = $pageId;
                    break;
//                        case 'contact_form':
//                            $views[$pc->id_element] = new View('admin_page_content_edit');
//                            $oPageContentDetails = $this->_page_content->GetPageContentByElementId($pc->id_element)->Value;
//                            $views[$pc->id_element]->page_content = $oPageContentDetails;
//                            $views[$pc->id_element]->title = (!empty($views[$pc->id_element]->page_content[0]->title)) ? 'zawartosc strony '.$views[$pc->id_element]->page_content[0]->title : 'zawartosc strony';
//                            $views[$pc->id_element]->bNoSitesCheck = true;
//                            break;
            }
        }
        $this->_oTemplate->content->main_content->views = $views;
        $this->_oTemplate->content->main_content->edit = new View('admin_pages_edit');
        $this->_oTemplate->content->main_content->edit->pages = $this->_oPage->GetPage($pageId)->Value;
        $this->_oTemplate->content->main_content->edit->parent = $this->_oPage->GetPageParents($pageId)->Value;
        $this->_oTemplate->content->main_content->pages = $page_contents;
        $this->_oTemplate->content->main_content->iPageId = $pageId;
        $languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->languages = $languages;
        $this->_oTemplate->content->main_content->edit->languages = $languages;

        $this->_oTemplate->render(true);
    }

}
