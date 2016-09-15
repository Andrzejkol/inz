<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Contact_Forms_Controller extends Admin_Controller {

    /**
     * @var Contact_Form_Model
     */
    private $_contactForm;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_contactForm = new Contact_Form_Model();
        $this->_oTemplate->header->hover = 'elements';
        
    }

    /**
     *
     */
    public function list_contact_forms() {
        $this->authorize('contact_forms', 'index');

        $count = $this->_contactForm->Count()->Value;
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;


        $this->_oTemplate->content->main_content = new View('admin_contact_forms_list');
        $this->_oTemplate->title = Kohana::lang('contact_form.admin_contact_forms_list_site_title');
        $this->_oTemplate->content->main_content->contactForms = $this->_contactForm->FindAll($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add_contact_form() {
        $this->authorize('contact_forms', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            //walidacja
            $valid_check = $this->_contactForm->ValidateContactFormAdd($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_contactForm->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/formularze_kontaktowe');
                } else {
                    url::redirect('4dminix/edytuj_formularz_kontaktowy/' . $result->Value->insert_id());
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }
        // widoki
        $this->_oTemplate->content->main_content = new View('admin_contact_form_add');
        $sLanguage = 'pl_PL';
        if (!empty($_POST['language'])) {
            $sLanguage = $_POST['language'];
        }
        $this->_oTemplate->title = Kohana::lang('contact_form.admin_add_contact_form_site_title');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $sLanguage)->Value;
        $this->_oTemplate->content->main_content->sLanguage = $sLanguage;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $contact_formId
     * @param string $contact_formLang
     */
    public function edit_contact_form($iContactFormId) {
        $this->authorize('contact_forms', 'edit');

        // dzialanie posta
        if (!empty($_POST)) {
            // walidacja
            $valid_check = $this->_contactForm->ValidateContactFormEdit($iContactFormId, $_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_contactForm->Update($iContactFormId, $_POST)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/formularze_kontaktowe');
                } else {
                    url::redirect('4dminix/edytuj_formularz_kontaktowy/' . $iContactFormId);
                }
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }
        // widoki
        $this->_oTemplate->content->main_content = new View('admin_contact_form_edit');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('contact_form.admin_contact_form_edit_site_title');
        $oContactForm = $this->_contactForm->Find($iContactFormId)->Value;
        $this->_oTemplate->content->main_content->contact_form = $oContactForm;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oContactForm[0]->language)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oContactForm[0]->element_id)->Value;
        $this->_oTemplate->render(true);
    }

    public function list_logs() {
        $this->authorize('contact_forms', 'index');

        $this->_oTemplate->content->main_content = new View('admin_contact_form_logs_list');
        $oLogs = $this->_contactForm->GetAllLogs()->Value;
        
        if (!empty($oLogs) && $oLogs !== false) {
            $count = $oLogs->count();
            $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
            $limit = $oPagination->items_per_page;
            $offset = $oPagination->sql_offset;
            $this->_oTemplate->content->main_content->oLogs = $this->_contactForm->GetAllLogs($limit, $offset)->Value;
            $this->_oTemplate->content->main_content->oPagination = $oPagination;
        }
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $contact_formId
     * @param string $contact_formLang
     */
    public function delete_contact_form($iContactFormId) {
        $this->authorize('contact_forms', 'index');

        if (!empty($iContactFormId)) {
            $this->_oSession->set('message', $this->_contactForm->Delete($iContactFormId)->__toString());
            url::redirect('4dminix/formularze_kontaktowe');
        } else {
            url::redirect('4dminix/formularze_kontaktowe');
        }
    }

    /**
     *
     * @param integer $iContactFormId
     */
    public function show($iContactFormId) {
        $v = new View('app_contact_form');
        $v->render(true);
    }

    /**
     * 
     */
    public function send() {
        if (!empty($_POST['contact_form_submit'])) {
            $oCheck = $this->_contactForm->ValidateSend($_POST);
            if ($oCheck->Value == true) {
                $result = $this->_contactForm->SendMessage($_POST);
                $this->_oSession->set('message', $result->__toString());
                if ($result->Type == ErrorReporting::SUCCESS) {
                    url::redirect('kontakt');
                } else {
                    url::redirect('kontakt');
                }
            } else {
                $this->_oSession->set('message', $oCheck->__toString());
                url::redirect('kontakt');
            }
        }
    }

}