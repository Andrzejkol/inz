<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Klasa Question_Model służąca do zarządzania pytaniami klientów.
 *
 */
class Question_Model extends Model_Core {

    private $_rDb;

    public function __construct() {
        parent::__construct();
        $this->_rDb = new Database();
    }

    public function Insert($aPost) {
        try {
            $this->_rDb->insert(table::SHOP_QUESTIONS, array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'product_id' => $_POST['product_id'],
                'product_info' => $_POST['product_info'],
                'message' => $_POST['message'],
                'date' => TIME
                    )
            );
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Count($args, $sort) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_QUESTIONS));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Save($iQuestionId, $aPost) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->update(table::SHOP_QUESTIONS, array('responsed' => $aPost['responsed']), array('id_question' => $iQuestionId)), Kohana::lang('question.question_deleted_successful'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Delete($iQuestionId) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::SHOP_QUESTIONS, array('id_question' => $iQuestionId)), Kohana::lang('question.question_deleted_successful'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function FindAll($iLimit, $iOffset) {
        try {
		$questions_orderby = 'id_question';
		$kind = 'DESC';
		if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==1 ) {$questions_orderby='id_question'; $kind='ASC';}
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==2 ) {$questions_orderby='id_question'; $kind='DESC';}
		
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==3 ) {$questions_orderby='date'; $kind='ASC';}
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==4 ) {$questions_orderby='date'; $kind='DESC';}
		
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==5 ) {$questions_orderby='name'; $kind='ASC';}
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==6 ) {$questions_orderby='name'; $kind='DESC';}
		
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==7 ) {$questions_orderby='message'; $kind='ASC';}
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==8 ) {$questions_orderby='message'; $kind='DESC';}
		
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==9 ) {$questions_orderby='responsed'; $kind='ASC';}
		else if(!empty($_GET['questions_orderby']) && $_GET['questions_orderby']==10 ) {$questions_orderby='responsed'; $kind='DESC';}
		
		
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby($questions_orderby, $kind)->limit($iLimit, $iOffset)->getwhere(table::SHOP_QUESTIONS));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Find($iQuestionId) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_QUESTIONS, array('id_question' => $iQuestionId)));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

}
