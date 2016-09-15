<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Newsletters_Controller extends Admin_Controller {

    /**
     *
     * @var Newsletter_Model
     */
    private $_newsletter;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_newsletter = new Newsletter_Model();
        $this->_oTemplate->header->hover = 'newsletter';
    }

    /**
     *
     */
    public function index() {
        $this->authorize('newsletters', 'index');

        $count = $this->_newsletter->Count()->Value;
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_newsletters_index');
        $this->_oTemplate->content->main_content->newsletters = $this->_newsletter->FindAll($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('newsletter.newsletters_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function newsletter_add() {
        $this->authorize('newsletters', 'add');

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            $oValid = $this->_newsletter->validateAdd($_POST);
            if ($oValid->Value === true) {
                $result = $this->_newsletter->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/newslettery');
                } else {
                    url::redirect('4dminix/edytuj_newsletter/' . $result->Value);
                }
            } else {
                $this->_oTemplate->content->msg = $oValid->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $lang = (!empty($_POST['language']) ? $_POST['language'] : 'pl_PL');
        $this->_oTemplate->content->main_content->allNewsletterGroups = $this->_newsletter->FindAllGroups(null, null, array('lang' => $lang))->Value;
        $this->_oTemplate->title = Kohana::lang('newsletter.add_newsletter');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function newsletter_edit($id) {
        $this->authorize('newsletters', 'edit');

        $id += 0;
        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            $oValid = $this->_newsletter->validateAdd($_POST);
            if ($oValid->Value === true) {
                $result = $this->_newsletter->Update($id, $_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/newslettery');
                } else {
                    url::redirect('4dminix/edytuj_newsletter/' . $id);
                }
            } else {
                $this->_oTemplate->content->msg = $oValid->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_edit');
        $oNewsletter = $this->_newsletter->Find($id)->Value;
        $this->_oTemplate->content->main_content->newsletter = $oNewsletter;
        $this->_oTemplate->content->main_content->newsletterImages = $this->_newsletter->getImages($id)->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $lang = (!empty($_POST['language']) ? $_POST['language'] : $oNewsletter[0]->language);
        $this->_oTemplate->content->main_content->allNewsletterGroups = $this->_newsletter->FindAllGroups(null, null, array('lang' => $lang))->Value;
        $oNewsletterGroups = $this->_newsletter->FindAllNewsletterGroups($id)->Value;
        $aNewsletterGroups = array();
        foreach ($oNewsletterGroups as $ong) {
            $aNewsletterGroups[] = $ong->newsletter_group_id;
        }
        $this->_oTemplate->content->main_content->aNewsletterGroups = $aNewsletterGroups;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_newsletter_edit');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iNewsletterId
     */
    public function newsletter_preview($iNewsletterId) {
        $this->authorize('newsletters', 'edit');

        $iNewsletterId += 0;
        $this->_oTemplate = View::factory(newsletter::NEWSLETTER_VIEW);
        $this->_oTemplate->oImages = array();
        $this->_oTemplate->sNewsletterTitle = '';
        $this->_oTemplate->sContent = '';
//				@TODO: Odkomentować, jeśli jest potrzeba dodawania zdjęć do newslettera
//                $oImages = $this->_newsletter->getImages($iNewsletterId)->Value;
//                if (!empty($oImages)) {
//                    $this->_oTemplate->oImages = $oImages;
//                }

        $oNewsletter = $this->_newsletter->Find($iNewsletterId)->Value;
        if (!empty($oNewsletter)) {
            Kohana::config_set('locale.language', $oNewsletter[0]->language);
            $sTitle = $oNewsletter[0]->title;
            $sContent = $oNewsletter[0]->content;
        }

        $this->_oTemplate->sNewsletterTitle = $sTitle;
        $this->_oTemplate->sContent = $sContent;
        $this->_oTemplate->email = 'noreply@olicom.pl';
        $this->_oTemplate->verifyString = 'abcd1234';
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function newsletter_delete($id = null) {
        $this->authorize('newsletters', 'delete');

        $id += 0;
        if (!empty($_POST['newsletter_check'])) {
            $result = $this->_newsletter->DeleteNewsletterArray($_POST['newsletter_check']);
        }
        if (!empty($id)) {
            $result = $this->_newsletter->DeleteNewsletter($id);
        }
        if (isset($result) && $result->Value === true) {
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/newslettery');
        }
    }

    /**
     * 
     */
    public function newsletter_groups() {
        $this->authorize('newsletters', 'groups_index');

        if (!empty($_POST['confirm'])) {
            $this->_oSession->set('message', $this->_newsletter->InsertGroup($_POST)->__toString());
            url::redirect('4dminix/newsletter_grupy');
        }

        $count = $this->_newsletter->CountGroups()->Value;
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_newsletter_groups_index');
        $this->_oTemplate->content->main_content->groups = $this->_newsletter->FindAllGroups($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_newsletters_groups');
        $this->_oTemplate->render(true);
    }

    /**
     * 
     */
    public function newsletter_group_add() {
        $this->authorize('newsletters', 'group_add');

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            //            if(count($this->_newsletter->validateAdd($_POST)->Value) == 0) {
            $result = $this->_newsletter->InsertGroup($_POST);
            if ($result->Value !== false) {
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/newsletter_grupy');
                } else {
                    url::redirect('4dminix/newsletter_edytuj_grupe/' . $result->Value);
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_group_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages(false)->Value;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_add_newsletter_group');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $groupId
     */
    public function newsletter_group_edit($groupId) {
        $this->authorize('newsletters', 'group_edit');

        $groupId+=0;
        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {

            $result = $this->_newsletter->UpdateGroup($groupId, $_POST);
            if ($result->Value !== false) {
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/newsletter_grupy');
                } else {
                    url::redirect('4dminix/newsletter_edytuj_grupe/' . $groupId);
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_group_edit');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages(false)->Value;
        $this->_oTemplate->content->main_content->oGroupDetails = $this->_newsletter->FindGroup($groupId)->Value;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_edit_newsletter_group');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function newsletter_group_delete($id = null) {
        $this->authorize('newsletters', 'group_delete');

        $id += 0;
        if (!empty($_POST['newsletter_groups_check'])) {
            $result = $this->_newsletter->DeleteNewsletterGroupArray($_POST['newsletter_groups_check']);
        } else if (!empty($id)) {
            $result = $this->_newsletter->DeleteNewsletterGroup($id);
        }
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/newsletter_grupy');
    }

    /**
     *
     */
    public function newsletter_emails() {
        $this->authorize('newsletters', 'emails_index');

        $aArgs = !empty($_GET) ? $_GET : array();
        $count = $this->_newsletter->CountEmails($aArgs)->Value;

        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_newsletter_emails_index');

        $oEmails = $this->_newsletter->FindAllEmails($limit, $offset, $aArgs)->Value;
        $oE = array();
        foreach ($oEmails as $e) {
            $gropus = $this->_newsletter->FindAllEmailGroups($e->id_email)->Value;
            $e->oGroups = $gropus;
            $oE[] = $e;
            //echo Kohana::debug($gropus);
        }
        $oE = new ArrayObject($oE);
        $oEmails = $oE;

        $this->_oTemplate->content->main_content->oEmails = $oEmails;

        $this->_oTemplate->content->main_content->oPagination = $oPagination;

        $this->_oTemplate->content->main_content->emailGroups = $this->_newsletter->FindAllGroups()->Value;


        $this->_oTemplate->title = Kohana::lang('newsletter.admin_newsletters_emails');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function newsletter_email_add() {
        $this->authorize('newsletters', 'email_add');

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            if(!empty($_POST['email'])) {
            
                $email_array = explode("\n", $_POST['email']);
                
                $res_array = array();
            foreach($email_array as $arr) {
                $_POST['email'] = trim($arr);
                $oAddCheck = $this->_newsletter->ValidateEmailAdd($_POST);
                
                if ($oAddCheck->Value === true) {
                    $result = $this->_newsletter->InsertEmail($_POST);
                    $res_array[$arr] = $result->__toString();
                }
                else {
                    $res_array[$arr] = $oAddCheck->__toString();
                }
            }
            $htm = '';
            foreach($res_array as $key => $ra) {
                $htm .= '<li>'.$key.': '.strip_tags($ra).'</li>';
            }
            $this->_oTemplate->content->msg = '<ul>'.$htm.'</ul>';
            
            if (isset($_POST['submit_back'])) {
                url::redirect('4dminix/emaile');
            }
                
//           $this->_oSession->set('message', $result->__toString());
//                if (isset($_POST['submit_back'])) {
//                    url::redirect('4dminix/emaile');
//                } else {
//                    url::redirect('4dminix/edytuj_email/' . $result->Value);
//                }
//            } else {
//                $this->_oSession->set('message', $oAddCheck->__toString());
//                $this->_oTemplate->content->msg = $oAddCheck->__toString();
//                //url::redirect('4dminix/dodaj_email');
//            }
            
            }
            else {
                $this->_oTemplate->content->msg = '<div class="error"><strong>Wystąpiły następujące błędy</strong>: <ul><li>Musisz podać adres e-mail.</li></ul></div>';
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_email_add');
        $this->_oTemplate->content->main_content->oNewsletterGroups = $this->_newsletter->FindAllGroups()->Value;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_add_newsletter_email');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $emailId
     */
    public function newsletter_email_edit($emailId) {
        $this->authorize('newsletters', 'email_edit');

        $emailId+=0;

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            $oUpdateCheck = $this->_newsletter->ValidateEmailAdd($_POST, $emailId);
            if ($oUpdateCheck->Value === true) {
                $result = $this->_newsletter->UpdateEmail($emailId, $_POST);
                $this->_oSession->set('message', $result->__toString());
            } else {
                $this->_oSession->set('message', $oUpdateCheck->__toString());
                url::redirect('4dminix/edytuj_email/' . $emailId);
            }

            if (isset($_POST['submit_back'])) {
                url::redirect('4dminix/emaile');
            } else {
                url::redirect('4dminix/edytuj_email/' . $emailId);
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_newsletter_email_edit');
        $this->_oTemplate->content->main_content->oEmailDetails = $this->_newsletter->FindEmail($emailId)->Value;
        $this->_oTemplate->content->main_content->oNewsletterGroups = $this->_newsletter->FindAllGroups()->Value;
        $oNewsletterEmailGroups = $this->_newsletter->FindAllEmailGroups($emailId)->Value;
        $aNewsletterEmailsGroups = array();
        foreach ($oNewsletterEmailGroups as $neg) {
            $aNewsletterEmailsGroups[] = $neg->newsletter_group_id;
        }
        $this->_oTemplate->content->main_content->aNewsletterEmailGroups = $aNewsletterEmailsGroups;
        $this->_oTemplate->title = Kohana::lang('newsletter.admin_edit_newsletter_email');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $emailId
     */
    public function newsletter_email_delete($emailId = null) {
        $this->authorize('newsletters', 'email_delete');

        $emailId += 0;

        if (!empty($_POST['newsletter_emails_check'])) {
            $result = $this->_newsletter->DeleteEmailArray($_POST['newsletter_emails_check']);
        } else if (!empty($emailId)) {
            $result = $this->_newsletter->DeleteEmail($emailId);
        }
        if (isset($result) && $result->Value === true) {
            $this->_oSession->set('message', $result->__toString());
        }

        url::redirect('4dminix/emaile');
    }

    /**
     *
     * @param integer $id
     */
    public function newsletter_send($id) {
        $this->authorize('newsletters', 'send');

        $id += 0;

        $this->_oTemplate->content->main_content = new View('admin_newsletter_send');
        $oNewsletter = $this->_newsletter->Find($id)->Value;
        $this->_oTemplate->content->main_content->oNewsletter = $oNewsletter;
        $allNewsletterGroups = $this->_newsletter->FindAllGroups(null, null, array('lang' => $oNewsletter[0]->language))->Value;
        if (!empty($allNewsletterGroups) && $allNewsletterGroups->count() > 0) {
            foreach ($allNewsletterGroups as $key => $group) {
                $check = $this->_newsletter->FindAllEmails(null, null, array('group' => $group->id_newsletter_group, 'status' => 1, 'verified' => 1))->Value;
                $aEmailsCount[$group->id_newsletter_group] = $check->count();
            }
        }
        $this->_oTemplate->content->main_content->allNewsletterGroups = $allNewsletterGroups;
        $this->_oTemplate->content->main_content->aEmailsCount = $aEmailsCount;
        $oNewsletterGroups = $this->_newsletter->FindAllNewsletterGroups($id)->Value;
        $aNewsletterGroups = array();
        foreach ($oNewsletterGroups as $ong) {
            $aNewsletterGroups[] = $ong->newsletter_group_id;
        }
        $this->_oTemplate->content->main_content->aNewsletterGroups = $aNewsletterGroups;
        $this->_oTemplate->title = Kohana::lang('newsletter.sending_newsletter');
        $this->_oTemplate->render(true);
    }
	
	public function export_to_csv() {		
		$result = $this->_newsletter->exportEmailsToCsv();
		if ($result->Value != false) {
			header("Content-type: application/csv");
			header("Content-Disposition: attachment;filename=$result->Value");
			// Send file to browser
			readfile($result->Value);
			unlink($result->Value);
		} else {
			$this->_oSession->set('message', $result->__toString());
			url::redirect('4dminix/emaile');
		}
	}

}