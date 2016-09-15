<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Controller extends Controller_Core {

    protected $_oSession;
    protected $_oUser;
    protected $_oAcl;
    protected $_oLanguage;
    protected $_oPage;
    protected $_oTemplate;
    protected $oLanguages;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        Kohana::config_set('locale.language', 'pl_PL');

        // obiekty
        $this->_oSession = Session::instance();
        $this->_oAcl = !empty($_SESSION['_acl']) ? $_SESSION['_acl'] : array();
        $this->_oLanguage = new Language_Model();
        $this->_oPage = new Page_Model();
        $this->_oUser = new User_Model();

        // funkcje
        $this->oLanguages = $this->_oLanguage->GetLanguages(true)->Value;

        // widoki
        $this->_oTemplate = new View('admin/template');
        $this->_oTemplate->header = new View('admin/header');
        $this->_oTemplate->content = new View('admin/main');
        $this->_oTemplate->content->main_left = new View('admin/elements/menu01');
        $this->_oTemplate->content->main_right = null;
        $this->_oTemplate->footer = new View('admin/footer');

        //przypisania zmiennych
        $this->_oTemplate->content->main_left->langs = $this->oLanguages;
        $this->_oTemplate->content->main_left->pages = $this->_oPage->GetPagesTree();
        $this->_oTemplate->content->msg = $this->_oSession->get_once('message', null);

        //turn on to debug:
        if (!request::is_ajax()) {
     //       $this->profile = new Profiler_Core();
        }
    }

    protected function authorize($resource, $privilege) {
        if (empty($this->_oAcl['logged_in']) || $this->_oAcl['logged_in'] === false) {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }

        if ($this->_oUser->IsAllowed($this->_oAcl, $resource, $privilege)->Value === false) {
            url::redirect('4dminix/brak_dostepu');
        }
    }

}
