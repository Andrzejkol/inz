<?php

defined('SYSPATH') OR die('No direct access allowed.');

class News_Controller extends Admin_Controller {

    /**
     * @var News_Model
     */
    private $_news;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_news = new News_Model();
        $this->_oTemplate->header->hover = 'elements';
    }

    /**
     *
     */
    public function add_news($iNewsCategoryId = null, $iPageId = null) {
        $this->authorize('news', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            //walidacja
            $valid_check = $this->_news->ValidateNews($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_news->Insert($_POST, $_FILES);
                
                $this->_oSession->set('message', $result->__toString());
                //$idPage = $this->_news->GetPageIdByElementId($_POST['name_elements'][0]);
                if (!empty($iPageId)) {
                    url::redirect('4dminix/strona/' . $iPageId);
                } else if (!empty($iNewsCategoryId)) {
                    if (isset($_POST['submit_back'])) {
                        url::redirect('4dminix/aktualnosci/' . $iNewsCategoryId);
                    } else {
                        url::redirect('4dminix/edytuj_aktualnosc/' . $result->Value . '/' . $iNewsCategoryId);
                    }
                } else {
                    url::redirect('4dminix/kategorie_aktualnosci');
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_add');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('news.site_title');
        $this->_oTemplate->content->main_content->iNewsCategoryId = $iNewsCategoryId;
        $oCategoryDetails = $this->_news->GetNewsCategoryDetails($iNewsCategoryId)->Value;
        if (!empty($oCategoryDetails[0]->lang)) {
            $lang = $oCategoryDetails[0]->lang;
        } else {
            $lang = 'pl_PL';
        }
        $this->_oTemplate->content->main_content->oCategoryDetails = $lang;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->aNewsCategories = $this->_news->GetNewsCategoriesAsArray($lang)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param <type> $newsId
     */
    public function edit_news($iNewsId, $iNewsCategoryId = null, $iPageId = null) {
        $this->authorize('news', 'edit');

        // dzialanie posta
        if (!empty($_POST)) {
            $valid_check = $this->_news->ValidateNews($_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_news->Update($iNewsId, $_POST, $_FILES)->__toString());
                $iNewsCategoryId+=0;
                if (!empty($iPageId)) {
                    url::redirect('4dminix/strona/' . $iPageId);
                } else {
                    if (isset($_POST['submit_back'])) {
                        url::redirect('4dminix/aktualnosci/' . $iNewsCategoryId);
                    } else {
                        url::redirect('4dminix/edytuj_aktualnosc/' . $iNewsId . '/' . $iNewsCategoryId);
                    }
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_edit');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('news.admin_news_edit_site_title');
        $oNews = $this->_news->GetNews($iNewsId)->Value;
        $this->_oTemplate->content->main_content->news = $oNews;
         $oNewsImages = $this->_news->GetNewsImages($iNewsId)->Value;
        $this->_oTemplate->content->main_content->newsimages = $oNewsImages;
        $this->_oTemplate->content->main_content->aNewsCategories = $this->_news->GetNewsCategoriesAsArray($oNews[0]->lang)->Value;
        $this->_oTemplate->content->main_content->aNewsCategoriesSelected = $this->_news->GetNewsCategoriesForNews($iNewsId)->Value;
        $this->_oTemplate->content->main_content->oNewsComments = $this->_news->getComments($iNewsId)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $elementId
     */
    public function list_news($iNewsCategoryId = null) {
        $this->authorize('news', 'index');

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_list');

        $count = count($this->_news->GetAllNews($iNewsCategoryId)->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        // zmienne do widokow
        $iNewsCategoryId+=0;
        $this->_oTemplate->title = Kohana::lang('news.admin_news_list_site_title');
        $this->_oTemplate->content->main_content->iNewsCategoryId = $iNewsCategoryId;
        $this->_oTemplate->content->main_content->news = $this->_news->GetAllNews($iNewsCategoryId, $limit, $offset)->Value;

        $oNewsCategoryDetails = $this->_news->GetNewsCategoryDetails($iNewsCategoryId)->Value[0];
        $this->_oTemplate->content->main_content->sNewsCategoryName = $oNewsCategoryDetails->news_category_name;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;

        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $newsId
     */
    public function delete_news($iNewsId = null, $iNewsCategoryId = null, $iPageId = null) {
        $this->authorize('news', 'delete');

        if (!empty($_POST['news_check']) && !empty($_POST['category_id'])) {
            $this->_oSession->set('message', $this->_news->DeleteNewsArray($_POST['news_check'])->__toString());
            if (!empty($_POST['page_id'])) {
                url::redirect('4dminix/strona/' . $_POST['page_id']);
            } else {
                url::redirect('4dminix/aktualnosci/' . $_POST['category_id']);
            }
        } else if (!empty($iNewsId)) {
            $this->_oSession->set('message', $this->_news->DeleteNews($iNewsId)->__toString());
            if (!empty($iPageId)) {
                url::redirect('4dminix/strona/' . $iPageId);
            } else {
                url::redirect('4dminix/aktualnosci/' . $iNewsCategoryId);
            }
        } else {
            url::redirect('4dminix/aktualnosci');
        }
    }

//    /**
//     *
//     * @param Integer $elementId
//     */
//    public function news($elementId = null) {
//        if(!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
//            if($this->_oUser->IsAllowed($this->_oAcl, 'news', 'add')->Value == true) {
//                //dzialanie posta
//                if(!empty($_POST)) {
//                    //walidacja
//                    $valid_check = $this->_news->ValidateNews($_POST);
//                    if($valid_check->Value===true) {
//                        $this->_oSession->set('message', $this->_news->Insert($_POST, $_FILES)->__toString());
//                        //url::redirect('4dminix/newsy');
//                    } else {
//                        $this->_oTemplate->msg = $valid_check->__toString();
//                    }
//                } else {
//                    //widoki
//                    $this->_oTemplate->content->main_content = new View('admin_news');
//
//                    // zmienne do widokow
//
//                    $this->_oTemplate->title = Kohana::lang('news.admin_news_site_title');
//                    $count = $this->_news->NewsCount($elementId)->Value;
//
//                    $pagination = new Pagination(array(
//                            //'base_url'    => 'news_ajax/get_news_table/', // base_url will default to current uri
//                            //'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
//                                    'total_items'    => $count, // use db count query here of course
//                                    'items_per_page' => news_helper::LIMIT, // it may be handy to set defaults for stuff like this in config/pagination.php
//                                    'style'          => 'admin_default' // pick one from: classic (default), digg, extended, punbb, or add your own!
//                    ));
//
//                    $this->_oTemplate->content->main_content->pagination = $pagination;
//                    $this->_oTemplate->content->main_content->news = $this->_news->GetAllNews(0, $pagination->items_per_page, $pagination->sql_offset )->Value;
//                    $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
//
//                    $this->_oTemplate->render(true);
//                }
//            } else {
//                url::redirect('4dminix/brak_dostepu');
//            }
//        } else {
//            $this->_oSession->set('requested_url', '/'.url::current());
//            url::redirect('4dminix/admin_logowanie');
//        }
//    }

    /* NEWS CATEGORIES */

    /**
     *
     * @param Integer $elementId
     */
    public function news_categories_list() {
        $this->authorize('news_categories', 'index');

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_categories_list');

        $count = count($this->_news->GetNewsCategories()->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('news.admin_news_categories_list_site_title');
        $this->_oTemplate->content->main_content->oNewsCategories = $this->_news->GetNewsCategories($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->sLanguages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;

        $this->_oTemplate->render(true);
    }

    public function add_news_category($iPageId = null) {
        $this->authorize('news_categories', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            //walidacja
            $valid_check = $this->_news->ValidateNewsCategories($_POST);
            if ($valid_check->Value !== false) {
                $result = $this->_news->InsertNewsCategory($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/kategorie_aktualnosci');
                } else {
                    url::redirect('4dminix/edytuj_kategorie_aktualnosci/' . $result->Value);
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_categories_add');
        // zmienne do widokow

        $sLanguage = 'pl_PL';
        
        if (!empty($iPageId)) {
            $oPageData = $this->_oPage->GetPage($iPageId)->Value;
            $sLanguage = $oPageData[0]->lang;
        }

        $this->_oTemplate->title = Kohana::lang('news.admin_news_categories_add_site_title');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $sLanguage)->Value;
        $this->_oTemplate->content->main_content->iPageId = $iPageId;
        $Categories = $this->_news->GetMainCategories()->Value;
        $this->_oTemplate->content->main_content->oCategories = $Categories;
        $this->_oTemplate->content->main_content->sLanguage = $sLanguage;
        $this->_oTemplate->render(true);
    }

    public function edit_news_category($iNewsCategoryId) {
        $this->authorize('news_categories', 'edit');

        // dzialanie posta
        if (!empty($_POST)) {
            //walidacja
            $valid_check = $this->_news->ValidateNewsCategories($_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_news->UpdateNewsCategory($_POST, $iNewsCategoryId)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/kategorie_aktualnosci');
                } else {
                    url::redirect('4dminix/edytuj_kategorie_aktualnosci/' . $iNewsCategoryId);
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }
      

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_news_categories_edit');
        // zmienne do widokow
           $Categories = $this->_news->GetMainCategories()->Value;
        $this->_oTemplate->content->main_content->oCategories = $Categories;
        $this->_oTemplate->title = Kohana::lang('news.admin_news_categories_edit_site_title');
        $oNewsCategoryDetails = $this->_news->GetNewsCategoryDetails($iNewsCategoryId)->Value;
        $this->_oTemplate->content->main_content->oNewsCategoryDetails = $oNewsCategoryDetails;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, (!empty($_POST['lang']) ? $_POST['lang'] : (!empty($oNewsCategoryDetails[0]->lang) ? $oNewsCategoryDetails[0]->lang : '')))->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oNewsCategoryDetails[0]->element_id)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $iNewsCategoryId
     */
    public function delete_news_category($iNewsCategoryId = null) {
        $this->authorize('news_categories', 'delete');

        if (!empty($_POST['news_category_check'])) {
            $aNewsCategories = $_POST['news_category_check'];
            $this->_oSession->set('message', $this->_news->DeleteNewsCategoryArray($aNewsCategories)->__toString());
            url::redirect('4dminix/kategorie_aktualnosci');
        } else if (!empty($iNewsCategoryId)) {
            $this->_oSession->set('message', $this->_news->DeleteNewsCategory($iNewsCategoryId)->__toString());
            url::redirect('4dminix/kategorie_aktualnosci');
        } else {
            url::redirect('4dminix/kategorie_aktualnosci');
        }
    }

    public function delete_comment($iCommentId) {
        $this->_oSession->set('message', $this->_news->DeleteComment($iCommentId)->__toString());
        url::redirect($_SERVER['HTTP_REFERER']);
    }

}
