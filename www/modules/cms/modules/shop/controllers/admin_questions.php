<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Questions_Controller extends Admin_Shop_Controller {

    protected $_oQuestion;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oQuestion = new Question_Model();
    }

    public function index() {
        $this->authorize('questions', 'index');
        $sort = array();
        $args = array();
        $pagination = layer::GetPagination($this->_oQuestion->Count($args, $sort)->Value);
        $this->_oTemplate->content->main_content = new View('admin/questions_index');
        $this->_oTemplate->content->main_content->oQuestions = $this->_oQuestion->FindAll(layer::PER_PAGE, $pagination->sql_offset, $args, $sort)->Value;
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->title = Kohana::lang('question.titles.questions_index');
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $iQuestionId
     */
    public function preview($iQuestionId = null) {
        $this->authorize('questions', 'preview');
        if (!empty($_POST['responsed'])) {
            $this->_oQuestion->Save($iQuestionId, $_POST);
        }
        $this->_oTemplate->content->main_content = new View('admin/question_preview');
        $this->_oTemplate->content->main_content->oQuestionDetails = $this->_oQuestion->Find($iQuestionId)->Value;
        $this->_oTemplate->title = Kohana::lang('question.titles.question_preview');
        $this->_oTemplate->render(true);
    }

    /**
     * @param integer $iQuestionId
     */
    public function delete($iQuestionId = null) {
        $this->authorize('questions', 'delete');

        $result = $this->_oQuestion->Delete($iQuestionId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/zapytania_klientow');
    }

}
