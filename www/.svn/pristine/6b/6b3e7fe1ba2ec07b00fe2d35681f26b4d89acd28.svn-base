<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Elements_Controller extends Admin_Controller {

    /**
     * @var Element_Model
     */
    private $_elements;

    const ALLOW_PRODUCTION = TRUE;

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     */
    public function __construct() {
        parent::__construct();
        $this->_elements = new Element_Model();
    }

    /**
     *
     * @param <type> $lang
     */
    public function add_elements($lang) {
        $this->authorize('elements', 'add');

        $this->_oTemplate->content->main_content = new View('admin_elements_add');
        if (!empty($_POST)) {
            var_dump($_POST);
            $_POST['lang'] = $lang;
            $insert = $this->_elements->AddElement($_POST);
            $this->_oTemplate->content->msg = $insert->__toString();
            if ($insert->Value === true) {
                $this->_oSession->set('message', $insert->__toString());
                url::redirect('4dminix/elementy');
            } else { // jesli byl blad to musi wgrac widok formularza dla typu
                //$this->_oTemplate->content->msg = $this->_oSession->get_once('message', null);
                switch ($_POST['type']) {
                    case 'page_content':
                        $this->_oTemplate->content->main_content->form = new View('admin_page_content_add');
                        // zmienne
                        $this->_oTemplate->content->main_content->form->languages = $this->_oLanguage->GetLanguages()->Value;
                        break;
                    case 'galleries':
                        $this->_oTemplate->content->main_content->form = new View('admin_gallery_add');
                        // zmienne
                        $this->_oTemplate->content->main_content->form->languages = $this->_oLanguage->GetLanguages()->Value;
                        break;
                    case 'news':
                        //$this->_oTemplate->content->main_content->form = new View('admin_news_add');
                        // zmienne
                        //$this->_oTemplate->content->main_content->form->languages = $this->_oLanguage->GetLanguages()->Value;
                        break;
                    case 'newsletter':
                        //$views[] = new View('admin_gallery_edit');
                        break;
                    case 'contact_form':
                        $this->_oTemplate->content->main_content->form = new View('admin_page_content_add');
                        $this->_oTemplate->content->main_content->form->languages = $this->_oLanguage->GetLanguages()->Value;
                        break;
                }
            }
        }

        $this->_oTemplate->title = Kohana::lang('elements.site_title');
        $this->_oTemplate->content->main_content->elements_type = element_helper::$elements_type;
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages($lang)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $elementID
     */
    public function edit_elements($elementID) {
        $this->authorize('elements', 'edit');

        if (!empty($_POST)) {

            $valid_check = $this->_elements->ValidateElements($_POST);

            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_elements->Update($elementID, $_POST)->__toString());
                url::redirect('4dminix/elementy');
            } else {
                $this->_oTemplate->msg = $valid_check->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_elements_edit');
        $this->_oTemplate->title = Kohana::lang('elements.admin_elements_edit_site_title');
        $this->_oTemplate->content->main_content->elements_type = element_helper::$elements_type;
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages($this->_elements->GetLangForPage($elementID)->Value)->Value;
        $this->_oTemplate->content->main_content->select_pages = $this->_elements->GetSelectedPages($elementID)->Value;
        $this->_oTemplate->content->main_content->elements = $this->_elements->GetElement($elementID)->Value;

        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function list_elements() {
        $this->authorize('elements', 'index');

        $this->_oTemplate->content->main_content = new View('admin_elements_list');
        $this->_oTemplate->title = Kohana::lang('elements.admin_elements_list_site_title');
        $this->_oTemplate->content->main_content->elements = $this->_elements->GetAllElements()->Value;
        $this->_oTemplate->content->main_content->pages_elements = $this->_elements->GetPagesForElements()->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages(true)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param Integer $elementID
     */
    public function delete_elements($elementID) {
        $this->authorize('elements', 'delete');

        $this->_oSession->set('message', $this->_elements->Delete($elementID)->__toString());
        url::redirect('4dminix/elementy');
    }

}