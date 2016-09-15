<?php

class Poll_Model extends Model_Core {

    protected $db;

    public function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert($iCategoryId, $data) {
        try {

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $answers = $data['answer'];

            //uzupelniamy tabelke polls_questions
            $aPollsQuestions['question'] = $data['question'];
            $aPollsQuestions['language'] = $this->GetQuestionLang($iCategoryId);
            $aPollsQuestions['date_added'] = time();
            $aData['start_date'] = (!empty($data['start_date'])) ? layer::DateToInt($data['start_date']) : '';
            $aData['end_date'] = (!empty($data['end_date'])) ? layer::DateToInt($data['end_date']) : '';

            $results = $this->db->insert(table::POLLS_QUESTIONS, $aPollsQuestions);

            $iQuestionId = $results->insert_id();

            //uzupelniamy tabelke polls_answers
            foreach ($answers as $a) {
                $a = trim($a);
                if (!empty($a)) {
                    $this->db->insert(table::POLLS_ANSWERS, array('question_id' => $iQuestionId, 'answer' => $a));
                }
            }

            //uzupelniamy tabelke polls_questions_to_categories
            if (isset($data['active'])) {
                $this->db->update(table::POLLS_QUESTIONS_TO_CATEGORIES, array('active' => 'N'), array('poll_category_id' => $iCategoryId));
                $aPollsQuestionsToCategories['active'] = $data['active'];
            }
            $aPollsQuestionsToCategories['poll_question_id'] = $iQuestionId;
            $aPollsQuestionsToCategories['poll_category_id'] = $iCategoryId;

            $this->db->insert(table::POLLS_QUESTIONS_TO_CATEGORIES, $aPollsQuestionsToCategories);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $iQuestionId, Kohana::lang('poll.insert_poll_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.insert_poll_exception'));
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     */
    public function Update($iCategoryId, $iQuestionId, array $data) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $answers = $data['answer'];

            $aData['question'] = $data['question'];
            $aData['start_date'] = (!empty($data['start_date'])) ? layer::DateToInt($data['start_date']) : '';
            $aData['end_date'] = (!empty($data['end_date'])) ? layer::DateToInt($data['end_date']) : '';

            //update tabelki polls_questions
            $this->db->update(table::POLLS_QUESTIONS, $aData, array('id_question' => $iQuestionId));

            //update tabelki polls_answers
            // usuwamy wszystkie odpowiedzi i dodajemy je na nowo
            $this->db->delete(table::POLLS_ANSWERS, array('question_id' => $iQuestionId));
            $this->db->delete(table::POLLS_VOTERS, array('question_id' => $iQuestionId));

            $aAnswersData = array();
            $aAnswersData['question_id'] = $iQuestionId;

            foreach ($answers as $iKey => $sValue) {
                $sValue = trim($sValue);
                if (!empty($sValue)) {
                    $aAnswersData['answer'] = $sValue;
                    $this->db->insert(table::POLLS_ANSWERS, $aAnswersData);
                }
                //$this->db->update(table::POLLS_ANSWERS, array('answer' => $sValue), array('id_answer' => $iKey, 'question_id' => $iQuestionId));
            }

            //update tabelki polls_questions_to_categories
            if (isset($data['active'])) {
                $this->db->update(table::POLLS_QUESTIONS_TO_CATEGORIES, array('active' => 'Y'), array('poll_question_id' => $iQuestionId, 'poll_category_id' => $iCategoryId));
            } else {
                $this->db->update(table::POLLS_QUESTIONS_TO_CATEGORIES, array('active' => 'N'), array('poll_category_id' => $iCategoryId));
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.update_poll_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.update_poll_exception'));
        }
    }

    /**
     *
     * @param integer $iQuestionId
     * @return ErrorReporting
     */
    public function Delete($iQuestionId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $this->db->delete(table::POLLS_ANSWERS, array('question_id' => $iQuestionId));
            $this->db->delete(table::POLLS_QUESTIONS, array('id_question' => $iQuestionId));
            $this->db->delete(table::POLLS_QUESTIONS_TO_CATEGORIES, array('poll_question_id' => $iQuestionId));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.delete_poll_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.delete_poll_exception'));
        }
    }

    public function DeletePollsArray($aPolls) {
        try {
            foreach ($aPolls as $iPoll) {
                $this->Delete($iPoll);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.delete_poll_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.delete_poll_exception'));
        }
    }

    public function AddCategory($Post) {
        try {
            //        var_dump($Post);
            //        exit();
            //uzupelniamy tabele elements
            $aElements['type'] = element_helper::$elements_types_for_switch['polls'];
            $aElements['date_added'] = time();
            $aElements['lang'] = $Post['lang'];

            $results = $this->db->insert(table::ELEMENTS, $aElements);

            $iElementId = $results->insert_id();

            //uzupelniamy tabele pages_elements
            $aPagesElements['element_id'] = $iElementId;
            $pages_id = $Post['page_id'];
            if (is_array($pages_id)) {
                foreach ($pages_id as $page_id) {
                    $aPagesElements['page_id'] = $page_id;
                    $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
                }
            } else {
                $aPagesElements['page_id'] = $pages_id;
                $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
            }
            //uzupelniamy tabele polls_categories
            $aPollsCategories['category_name'] = $Post['category_name'];
            $aPollsCategories['element_id'] = $iElementId;

            $insert = $this->db->insert(table::POLLS_CATEGORIES, $aPollsCategories);

            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('poll.insert_poll_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.insert_poll_category_error'));
        }
    }

    public function EditCategory($Post, $iCategoryId) {
        try {
//            var_dump($Post);
//            exit();
//zapisanie zaznaczonych stron do zmiennej
            $pages_id = $Post['page_id'];

            //pobieramy id elementu
            $iElementId = $this->GetCategoryElementId($iCategoryId)->Value;

            //uzupelniamy tabele elements
            $aElements['modified_date'] = time();
            $aElements['lang'] = $Post['lang'];

            //update tabeli elements
            $this->db->update(table::ELEMENTS, $aElements, array('id_element' => $iElementId));

            //usuwamy istniejące powiazania kategorii ze stronami
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $iElementId));

            //zapisanie dla każdej zaznaczonej strony osobnego wpisu w tabelce pages_elements
            $aPagesElements['element_id'] = $iElementId;
            if (is_array($pages_id)) {
                foreach ($pages_id as $page_id) {
                    $aPagesElements['page_id'] = $page_id;
                    $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
                }
            } else {
                $aPagesElements['page_id'] = $pages_id;
                $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
            }

            //uzupelniamy tabele polls_categories
            $aPollsCategories['category_name'] = $Post['category_name'];

            //update tabeli galleries
            $this->db->update(table::POLLS_CATEGORIES, $aPollsCategories, array('element_id' => $iElementId));

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.edit_poll_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.edit_poll_category_exception'));
        }
    }

    public function DeleteCategory($iCategoryId) {
        try {
            $iElementId = $this->GetCategoryElementId($iCategoryId)->Value;
            $this->db->delete(table::ELEMENTS, array('id_element' => $iElementId));
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $iElementId));
            $this->db->delete(table::POLLS_CATEGORIES, array('element_id' => $iElementId));

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.delete_poll_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.delete_category_exception'));
        }
    }

    public function DeletePollsCategoryArray($aPollsCategories) {
        try {
            if (is_array($aPollsCategories)) {
                foreach ($aPollsCategories as $iPC) {
                    $this->DeleteCategory($iPC);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.delete_poll_category_success'));
            } else {
                $aPollsCategories+=0;
                return $this->DeleteCategory($aPollsCategories);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.delete_category_exception'));
        }
    }

    public function FindCategories($limit = null, $offset = null) {
        try {
			
			
		$polls_categories_orderby = 'category_name';
		$kind = 'ASC';
		if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==1 ) {$polls_categories_orderby='category_name'; $kind='ASC';}
		else if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==2 ) {$polls_categories_orderby='category_name'; $kind='DESC';}
		
		else if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==3 ) {$polls_categories_orderby='lang'; $kind='ASC';}
		else if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==4 ) {$polls_categories_orderby='lang'; $kind='DESC';}
		
		else if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==5 ) {$polls_categories_orderby='date_added'; $kind='ASC';}
		else if(!empty($_GET['polls_categories_orderby']) && $_GET['polls_categories_orderby']==6 ) {$polls_categories_orderby='date_added'; $kind='DESC';}
		
		
		
            $result = $this->db->from(table::POLLS_CATEGORIES)
					->orderby($polls_categories_orderby, $kind)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::POLLS_CATEGORIES . '.element_id');

            if (isset($limit) && isset($offset)) {
                $result = $result
                        ->limit($limit, $offset);
            }

            $result = $result->get();


            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.find_categories_exception'));
        }
    }

    /**
     *
     * @param integer $limit
     * @param integer $offset
     * @param string [$orderBy]
     * @param string [$orderType]
     * @return ErrorReporting
     */
    public function FindAll($iCategoryId, $limit = null, $offset = null) {
        try {
            /* $results = */
		$polls_orderby = 'question';
		$kind = 'ASC';
		if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==1 ) {$polls_orderby='question'; $kind='ASC';}
		else if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==2 ) {$polls_orderby='question'; $kind='DESC';}
		
		else if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==3 ) {$polls_orderby='date_added'; $kind='ASC';}
		else if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==4 ) {$polls_orderby='date_added'; $kind='DESC';}
		
		else if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==5 ) {$polls_orderby='active'; $kind='DESC';}
		else if(!empty($_GET['polls_orderby']) && $_GET['polls_orderby']==6 ) {$polls_orderby='active'; $kind='ASC';}
			
			
			
			$this->db->from(table::POLLS_QUESTIONS)
                    ->join(table::POLLS_QUESTIONS_TO_CATEGORIES, table::POLLS_QUESTIONS_TO_CATEGORIES . '.poll_question_id', table::POLLS_QUESTIONS . '.id_question')
                    ->where(array('poll_category_id' => $iCategoryId))
                    ->orderby($polls_orderby, $kind);
            if (!empty($limit) && empty($offset)) {
                $this->db->limit($limit);
            } else if (!empty($limit) && !empty($offset)) {
                $this->db->limit($limit, $offset);
            }
            $results = $this->db->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.find_all_polls_exception'));
        }
    }

    /**
     *
     * @param integer $iQuestionId
     * @return ErrorReporting
     */
    public function FindQuestion($iQuestionId) {
        try {
            $results = $this->db->from(table::POLLS_QUESTIONS)
                    ->join(table::POLLS_QUESTIONS_TO_CATEGORIES, table::POLLS_QUESTIONS_TO_CATEGORIES . '.poll_question_id', table::POLLS_QUESTIONS . '.id_question')
                    ->where(array('id_question' => $iQuestionId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.find_question_exception'));
        }
    }

    /**
     *
     * @param integer $iQuestionId
     * @return ErrorReporting
     */
    public function FindAnswers($iQuestionId) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::POLLS_ANSWERS, array('question_id' => $iQuestionId)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.find_answers_exception'));
        }
    }

    /**
     *
     * @param integer $iAnswerId
     * @return ErrorReporting
     */
    public function GetActivePoll() {
        try {
            $results = $this->db->from(table::POLLS_QUESTIONS)
                    ->join(table::POLLS_ANSWERS, table::POLLS_ANSWERS . '.question_id', table::POLLS_QUESTIONS . '.id_question')
                    ->where('active', 'Y')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('poll.vote_poll_exception'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.vote_poll_exception'));
        }
    }

    public function SetActivePoll($iCategoryId, $iQuestionId) {
        try {
            //czyszczenie aktywnych
            $this->db->update(table::POLLS_QUESTIONS_TO_CATEGORIES, array('active' => 'N'), array('poll_category_id' => $iCategoryId));

            //ustawienie aktywnego pytania
            $this->db->update(table::POLLS_QUESTIONS_TO_CATEGORIES, array('active' => 'Y'), array('poll_question_id' => $iQuestionId, 'poll_category_id' => $iCategoryId));

            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.vote_poll_exception'));
        }
    }

    /**
     * Generuje linka w wynikiem (obrazek)
     * @param Integer $iQuestionId
     * @return ErrorReporting
     */
    public function GenerateLink($iQuestionId) {
        try {
            $results = $this->db->from(table::POLLS_ANSWERS)->where(array('question_id' => $iQuestionId))->get();

            $answers = '';
            $votes = '';
            foreach ($results as $result) {
                $answer = trim($result->answer);
                $answers .= $answer . '|';
                $votes .= $result->votes . ',';
            }

            $answers = rtrim($answers, '|');
            $votes = rtrim($votes, ',');

            $link = 'http://chart.apis.google.com/chart?chs=250x100&chd=t:' . $votes;
            $link .= '&cht=p3&chdl=' . urlencode($answers);
            $link .= '&chf=bg,s,FAFAFA';

            $image = "<img src='" . $link . "' alt='graf' />";

            return new ErrorReporting(ErrorReporting::SUCCESS, $image, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.vote_poll_exception'));
        }
    }

    /**
     * Sprawdza czy bieżacy uzytkownik odpowiedział już na sonde
     * @param Integer $iQuestionId
     * @return ErrorReporting
     */
    public function CheckUserStatus($iQuestionId) {
        $db_check = $this->db->from(table::POLLS_VOTERS)
                ->where(array('ip' => $_SERVER['REMOTE_ADDR'], 'question_id' => $iQuestionId))
                ->get();
        $cookie = 'olicms_polls_' . $iQuestionId;

        if ($db_check->count() > 0 || isset($_COOKIE[$cookie])) {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->GenerateLink($iQuestionId)->Value, '');
        } else {
            return new ErrorReporting(ErrorReporting::WARNING, false);
        }
    }

    public function Vote($iAnswerId) {
        try {
            $iAnswerId += 0;
            $oQuestionDetail = $this->db->getwhere(table::POLLS_ANSWERS, array('id_answer' => $iAnswerId));
            $idQuesion = $oQuestionDetail[0]->question_id;
            $this->db->query("UPDATE " . table::POLLS_ANSWERS . " SET votes = votes + 1 WHERE id_answer = " . $iAnswerId);
            $this->db->insert(table::POLLS_VOTERS, array('question_id' => $oQuestionDetail[0]->question_id, 'answer_id' => $iAnswerId, 'ip' => $_SERVER['REMOTE_ADDR']));

            return new ErrorReporting(ErrorReporting::SUCCESS, $idQuesion, Kohana::lang('poll.vote_poll_exception'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.vote_poll_exception'));
        }
    }

    public function GetCategoriesAsArray($sLang) {
        try {
            $oCategories = $this->db->from(table::POLLS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::POLLS_CATEGORIES . '.element_id')
                    ->where(array('lang' => $sLang))
                    ->get();
            $aCategories = array();
            foreach ($oCategories as $oCategory) {
                $aCategories[$oCategory->id_poll_category] = $oCategory->category_name;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aCategories, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_pages_for_element_as_array'));
        }
    }

    private function GetCategoryElementId($iCategoryId) {
        try {
            $iCategoryId+=0;
            $result = $this->db->from(table::POLLS_CATEGORIES)->where(array('id_poll_category' => $iCategoryId))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result[0]->element_id, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.error_get_category_element_id'));
        }
    }

    public function GetCategory($iCategoryId) {
        try {
            $iCategoryId += 0;
            $results = $this->db->from(table::POLLS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::POLLS_CATEGORIES . '.element_id')
                    ->where(array('id_poll_category' => $iCategoryId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.get_category_exception'));
        }
    }

    /*
     * Pobiera danych Kategorii dla elementu
     * Używane przy edycji zawartości całej strony (pages)
     * @param Integer $iElementId
     * @return Integer $result[0]->id_pool_category || Bool false
     */

    public function GetCategoryForElementId($iElementId) {
        try {
            $iElementId += 0;
            $result = $this->db->from(table::POLLS_CATEGORIES)
                    ->where(array('element_id' => $iElementId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.get_category_for_element_id'));
        }
    }

    public function GetQuestionLang($iCategoryId) {
        $results = $this->db->from(table::POLLS_CATEGORIES)
                ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::POLLS_CATEGORIES . '.element_id')
                ->where(array('id_poll_category' => $iCategoryId))
                ->get();
        return $results[0]->lang;
    }

    public function GetCategoriesForLang($sLang) {
        try {
            $results = $this->db->from(table::POLLS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::POLLS_CATEGORIES . '.element_id')
                    ->where(array('lang' => $sLang))
                    ->get();

            $html = '';
            foreach ($results as $result) {
                $html .= "<option value='" . $result->id_poll_category . "'>" . $result->category_name . "</option>";
            }

            return new ErrorReporting(ErrorReporting::ERROR, $html, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.get_categories_for_lang_exception'));
        }
    }

    public function AllowChange($iQuestionId) {
        try {
            // sprawdzamy czy sonda jest aktywna
            $iCount = $this->db->from(table::POLLS_QUESTIONS_TO_CATEGORIES)->where(array('poll_question_id' => $iQuestionId, 'active' => 'Y'))->select('COUNT(*) AS count')->get();
            if (!empty($iCount) && $iCount[0]->count > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, false);
            }

            // sprawdzamy czy sa odpowiedzi na ta sonde
            $oCheckVotes = $this->db->from(table::POLLS_ANSWERS)->where(array('question_id' => $iQuestionId))->select('SUM(votes) AS sum_votes')->get();
            if (!empty($oCheckVotes) && $oCheckVotes[0]->sum_votes > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, false);
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, true);

            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.count_polls_exception'));
        }
    }

    /**
     *
     * @param integer $iQuestionId
     * @return ErrorReporting
     */
    public function GetResults($iQuestionId) {
        try {
            $iQuestionId += 0;
            $results = $this->db->query("SELECT *, (SELECT SUM(votes) FROM " . table::POLLS_ANSWERS . " WHERE question_id = " . $iQuestionId . ") AS all_votes FROM " . table::POLLS_ANSWERS . " WHERE question_id = " . $iQuestionId . " GROUP BY id_answer ORDER BY id_answer ");
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.count_polls_exception'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::POLLS_QUESTIONS), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.count_polls_exception'));
        }
    }

    /**
     * Walidacja przy dodawaniu sondy (pytania)
     * @param array $post
     * @return ErrorReporting
     */
    public function ValidatePolls(array $aPost) {
        $alert = '';
        if (empty($aPost['question'])) {
            $alert .= '<li>' . Kohana::lang('poll.validate_question_required') . '</li>';
        }
        if (empty($aPost['answer'])) {
            $alert .= '<li>' . Kohana::lang('poll.validate_answer_required') . '</li>';
        }
        if (!empty($aPost['start_date']) && !preg_match('/^\d{2}-\d{2}-\d{4}$/', $aPost['start_date'])) {
            $alert .= '<li>' . Kohana::lang('poll.validate.start_data_wrong_format') . '</li>';
        }
        if (!empty($aPost['end_date']) && !preg_match('/^\d{2}-\d{2}-\d{4}$/', $aPost['end_date'])) {
            $alert .= '<li>' . Kohana::lang('poll.validate.end_data_wrong_format') . '</li>';
        }
        if (!empty($aPost['start_date']) && preg_match('/^\d{2}-\d{2}-\d{4}$/', $aPost['start_date']) && !empty($aPost['end_date']) && preg_match('/^\d{2}-\d{2}-\d{4}$/', $aPost['end_date'])) {
            $iStartDate = layer::DateToInt($aPost['start_date']);
            $iEndDate = layer::DateToInt($aPost['end_date']);
            if ($iStartDate > $iEndDate) {
                $alert .= '<li>' . Kohana::lang('poll.validate.start_date_bigger_than_end_date') . '</li>';
            } else if ($iStartDate == $iEndDate) {
                $alert .= '<li>' . Kohana::lang('poll.validate.start_date_equal_end_date') . '</li>';
            }
        }

        if (!empty($alert)) {
            $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidatePollsCategories($aPost) {
        $alert = '';
        if (empty($aPost['category_name'])) {
            $alert .= '<li>' . Kohana::lang('poll.empty_category_name_error') . '</li>';
        }
        if (!isset($aPost['page_id'])) {
            $alert .= '<li>' . Kohana::lang('poll.empty_page_id_error') . '</li>';
        }
        if (!empty($alert)) {
            $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    /**
     * Zwraca categorie dla danej strony lub ich liczbę, jeśli drugi parametr jest ustawiony na true
     * @param integer $iPageId
     * @param bool $bCount 
     */
    public function GetCategoriesForPage($iPageId, $bCount = false) {
        try {
            $iPageId+=0;
            $result = $this->db->from(table::PAGES)
                    ->join(table::PAGES_ELEMENTS, table::PAGES_ELEMENTS . '.page_id', table::PAGES . '.id_page')
                    ->join(table::POLLS_CATEGORIES, table::POLLS_CATEGORIES . '.element_id', table::PAGES_ELEMENTS . '.element_id')
                    ->get();
            if ($bCount === true) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result->count());
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.count_polls_exception'));
        }
    }

    /**
     *  Pobiera sonde dla danej strony
     * @param Integer $iPageId
     * @return ErrorReporting (Object MySql Result)
     */
    public function GetPollForPage($iPageId) {
        try {
            $iPageId+=0;
            $iTime = time();
            // dla podanej strony sprawdzamy jaka jest przypisana kategoria
            $result = $this->db->from(table::PAGES_ELEMENTS)
                    ->join(table::POLLS_CATEGORIES, table::POLLS_CATEGORIES . '.element_id', table::PAGES_ELEMENTS . '.element_id')
                    ->join(table::POLLS_QUESTIONS_TO_CATEGORIES, table::POLLS_QUESTIONS_TO_CATEGORIES . '.poll_category_id', table::POLLS_CATEGORIES . '.id_poll_category')
                    ->join(table::POLLS_QUESTIONS, table::POLLS_QUESTIONS . '.id_question', table::POLLS_QUESTIONS_TO_CATEGORIES . '.poll_question_id')
                    ->join(table::POLLS_ANSWERS, table::POLLS_ANSWERS . '.question_id', table::POLLS_QUESTIONS . '.id_question')
                    ->where(array('page_id' => $iPageId, 'active' => 'Y'))
                    ->get();


//            $query = "SELECT * FROM (".table::PAGES_ELEMENTS.")
//            JOIN ".table::POLLS_CATEGORIES." ON (".table::POLLS_CATEGORIES.".`element_id` = ".table::PAGES_ELEMENTS.".`element_id`)
//            JOIN ".table::POLLS_QUESTIONS_TO_CATEGORIES." ON (".table::POLLS_QUESTIONS_TO_CATEGORIES.".`poll_category_id` = ".table::POLLS_CATEGORIES.".`id_poll_category`)
//            JOIN ".table::POLLS_QUESTIONS." ON (".table::POLLS_QUESTIONS.".`id_question` = ".table::POLLS_QUESTIONS_TO_CATEGORIES.".`poll_question_id`)
//            JOIN ".table::POLLS_ANSWERS." ON (".table::POLLS_ANSWERS.".`question_id` = ".table::POLLS_QUESTIONS.".`id_question`)
//            WHERE `page_id` = ".$iPageId." AND `active` = 'Y'
//            AND (
//                ( start_date > ".$iTime." AND end_date < ".$iTime." ) OR
//                    start_date > ".$iTime." OR end_date < ".$iTime. "
//                )";
            // sprawdzamy czy sonda jest w dacie
            if (!empty($result[0]->start_date) && $result[0]->start_date > $iTime) {
                return new ErrorReporting(ErrorReporting::SUCCESS, false);
            }
            if (!empty($result[0]->end_date) && $result[0]->end_date < $iTime) {
                return new ErrorReporting(ErrorReporting::SUCCESS, false);
            }

            //var_dump($result);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.count_polls_exception'));
        }
    }
    
    
    public function DeletePollByElementId($elementId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $elementId+=0;

            $gallery = $this->db->from(table::POLLS_CATEGORIES)->where(array('element_id' => $elementId))->get();

            //usuwamy wszystkie
            foreach ($pools as $p) {
                if ($this->DeleteCategory($p->id_poll_category)->Type === ErrorReporting::ERROR) {
                    throw new Exception();
                }
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('poll.success_delete_poll_category'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('poll.error_delete_poll_category'));
        }
    }

}

