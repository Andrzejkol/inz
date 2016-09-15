<?php defined('SYSPATH') OR die('No direct access allowed.');

class Reports_Controller extends Admin_Controller {

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function create_users($username) {
        $result = null;
        switch($username) {
            case 'administrator':
                $result = $this->_user->CreateUser('administrators', 'administrator', '4dminix');
                break;
            case 'guest':
                $result = $this->_user->CreateUser('guests', 'guest', 'guest');
                break;
        }
        switch($result->Type) {
            case ErrorReporting::SUCCESS:
                echo 'Dodano '.$username."\n";
                break;
            case ErrorReporting::ERROR:
                echo 'Problem podczas dodawania '.$username."\n";
                break;
        }
    }

    public function index() {
        $totalItems = $this->_user->Count()->Value;
        $perpage = 10;
        $pagination =  new Pagination(
            array(
                'query_string' => 'page',
                'style' => "digg",
                'total_items' => $totalItems,
                'items_per_page' => $perpage,
                'auto_hide' => true
            )
        );
        $this->_oTemplate->content->main_content = new View('admin_users_index');
        $this->_oTemplate->content->main_content->users = $this->_user->FindAll($perpage, $pagination->sql_offset)->Value;
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->title = Kohana::lang('user.newsletters_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function view($id) {
        $this->_oTemplate->content->main_content = new View('admin_reports_index');
        $this->_oTemplate->content->main_content->oreports = $this->_->FindAll($perpage, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('report.report_view');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->_oTemplate->content->main_content = new View('admin_reports_index');
        $this->_oTemplate->content->main_content->oreports = $this->_->FindAll($perpage, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('report.report_view');
        $this->_oTemplate->render(true);
    }
}