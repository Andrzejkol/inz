<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Partners_Controller extends Admin_Controller {

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oPartner = new Partner_Model();
    }

    public function partners_list() {
        $this->authorize('partners', 'index');
        
        $this->_oTemplate->content->main_content = new View('admin_partners_list');
        $this->_oTemplate->content->main_content->oPartners = $this->_oPartner->GetAllPartners()->Value;
        $this->_oTemplate->title = Kohana::lang('admin.partners.index_site_title');
        $this->_oTemplate->render(true);
    }

    public function add_partner() {
        $this->authorize('partners', 'add');
        $this->_oTemplate->content->main_content = new View('admin_partners_add');
        if (!empty($_POST)) {
            //walidacja
            $valid_check = $this->_oPartner->ValidateAddPartner($_POST, $_FILES);
            if ($valid_check->Value === true) {
                $oInsert = $this->_oPartner->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $oInsert->__toString());
                url::redirect('4dminix/partnerzy');
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        $this->_oTemplate->title = Kohana::lang('admin.partners.add_site_title');
        $this->_oTemplate->render(true);
    }

    public function delete_partner($iPartnerId = null) {
        $this->authorize('partners', 'delete');

        if (!empty($_POST['partners_check'])) {
            $this->_oSession->set('message', $this->_oPartner->DeletePartnerArray($_POST['partners_check'])->__toString());
        } else if (!empty($iPartnerId)) {
            $this->_oSession->set('message', $this->_oPartner->DeletePartner($iPartnerId)->__toString());
        }
        url::redirect('4dminix/partnerzy');
    }

    public function edit_partner($iPartnerId) {
        $this->authorize('partners', 'edit');

        if (!empty($_POST)) {
            $valid_check = $this->_oPartner->ValidateEditPartner($_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_oPartner->Update($_POST, $iPartnerId, $_FILES)->__toString());
                url::redirect('4dminix/partnerzy');
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin_partners_edit');
        $this->_oTemplate->content->main_content->oPartner = $this->_oPartner->GetPartnerDetails($iPartnerId)->Value[0];
//				$this->_oSession->set('message', $this->_oPartner->UpdatePartner($iPartnerId)->__toString());
//				url::redirect('4dminix/partnerzy');

        $this->_oTemplate->title = Kohana::lang('admin.partners.edit_site_title');
        $this->_oTemplate->render(true);
    }

}
