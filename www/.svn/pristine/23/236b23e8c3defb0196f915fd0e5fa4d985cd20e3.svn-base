<?php

class Polls_Controller extends Admin_Controller {

    /**
     *
     * @var Poll_Model
     */
    private $_oPoll;
    /**
     *
     * @var Element_Model
     */
    private $_elements;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oPoll = new Poll_Model();
        $this->_elements = new Element_Model();
        $this->_oTemplate->header->hover = 'elements';
    }

    /**
     *
     */
    public function categories() {
        $this->authorize('polls_categories', 'index');

        $count = count($this->_oPoll->FindCategories()->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_polls_categories_index');
        $this->_oTemplate->content->main_content->oPollsCategories = $this->_oPoll->FindCategories($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('poll.polls_categories');
        $this->_oTemplate->render(true);
    }

    public function add_category() {
        $this->authorize('polls_categories', 'add');

        //post
        if (!empty($_POST)) {
            $validations = $this->_oPoll->ValidatePollsCategories($_POST);

            if ($validations->Value == true) {
                $result = $this->_oPoll->AddCategory($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/kategorie_sond');
                } else {
                    url::redirect('4dminix/edytuj_kategorie_sond/' . $result->Value);
                }
            } else {
                $this->_oTemplate->content->msg = $validations->__toString();
            }
        }

        //widoki
        $this->_oTemplate->content->main_content = new View('admin_poll_category_add');

        //zmienne
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages('pl_PL')->Value;
        $this->_oTemplate->title = Kohana::lang('poll.add_poll_category');
        $this->_oTemplate->render(true);
    }

    public function edit_category($iCategoryId) {
        $this->authorize('polls_categories', 'edit');

        //post
        if (!empty($_POST)) {
            $validations = $this->_oPoll->ValidatePollsCategories($_POST);

            if ($validations->Value == true) {
                $this->_oSession->set('message', $this->_oPoll->EditCategory($_POST, $iCategoryId)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/kategorie_sond');
                } else {
                    url::redirect('4dminix/edytuj_kategorie_sond/' . $iCategoryId);
                }
            } else {
                $this->_oTemplate->content->msg = $validations->__toString();
            }
        }

        //widoki
        $this->_oTemplate->content->main_content = new View('admin_poll_category_edit');

        //zmienne
        $oCategoryDetails = $this->_oPoll->GetCategory($iCategoryId)->Value;
        $this->_oTemplate->content->main_content->oCategories = $oCategoryDetails;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oCategoryDetails[0]->lang)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oCategoryDetails[0]->element_id)->Value;
        $this->_oTemplate->title = Kohana::lang('poll.edit_poll_category');
        $this->_oTemplate->render(true);
    }

    public function delete_category($iCategoryId = null) {
        $this->authorize('polls_categories', 'delete');

        if (!empty($_POST['polls_category_check'])) {
            $aPollsCategories = $_POST['polls_category_check'];
            $this->_oSession->set('message', $this->_oPoll->DeletePollsCategoryArray($aPollsCategories)->__toString());
            url::redirect('4dminix/kategorie_sond');
        } else if (!empty($iCategoryId)) {
            $this->_oSession->set('message', $this->_oPoll->DeleteCategory($iCategoryId)->__toString());
            url::redirect('4dminix/kategorie_sond');
        } else {
            url::redirect('4dminix/kategorie_sond');
        }
    }

    public function index($iCategoryId) {
        $this->authorize('polls', 'index');

        $count = $this->_oPoll->Count()->Value;
        $oPagination = layer::GetPagination($count, '', polls_helper::PERPAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $pagination = layer::GetPagination($this->_oPoll->Count()->Value);
        $this->_oTemplate->content->main_content = new View('admin_polls_index');
        $this->_oTemplate->content->main_content->iCategoryId = $iCategoryId;
        $this->_oTemplate->content->main_content->oPolls = $this->_oPoll->FindAll($iCategoryId, $limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->content->main_content->pollCategoryName = $this->_oPoll->GetCategory($iCategoryId)->Value[0]->category_name;
        $this->_oTemplate->title = Kohana::lang('poll.polls_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add($iCategoryId, $iPageId = null) {
        $this->authorize('polls', 'add');

        if (!empty($_POST)) {
            $valid = $this->_oPoll->ValidatePolls($_POST);
            if ($valid->Value == true) {
                $result = $this->_oPoll->Insert($iCategoryId, $_POST);
                $this->_oSession->set('message', $result->__toString());
                if (!empty($iPageId)) {
                    url::redirect('4dminix/strona/' . $iPageId);
                } else {
                    if (isset($_POST['submit_back'])) {
                        url::redirect('4dminix/kategoria_sondy/' . $iCategoryId);
                    } else {
                        url::redirect('4dminix/edytuj_sonde/' . $iCategoryId . '/' . $result->Value);
                    }
                }
            } else {
                $this->_oTemplate->content->msg = $valid->__toString();
            }
        }

        $oCategoryDetails = $this->_oPoll->GetCategory($iCategoryId)->Value;
        $this->_oTemplate->content->main_content = new View('admin_poll_add');
        $this->_oTemplate->content->main_content->oCategoryDetails = $oCategoryDetails;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->aCategories = $this->_oPoll->GetCategoriesAsArray($oCategoryDetails[0]->lang)->Value;
        $this->_oTemplate->title = Kohana::lang('poll.add_poll');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function edit($iCategoryId, $iQuestionId, $iPageId = null) {
        $this->authorize('polls', 'edit');

        if (!empty($_POST)) {
            $valid = $this->_oPoll->ValidatePolls($_POST);
            if ($valid->Value == true) {
                $this->_oSession->set('message', $this->_oPoll->Update($iCategoryId, $iQuestionId, $_POST)->__toString());
                if (!empty($iPageId)) {
                    url::redirect('4dminix/strona/' . $iPageId);
                } else {
                    if (isset($_POST['submit_back'])) {
                        url::redirect('4dminix/kategoria_sondy/' . $iCategoryId);
                    } else {
                        url::redirect('4dminix/edytuj_sonde/' . $iCategoryId . '/' . $iQuestionId);
                    }
                }
            } else {
                $this->_oTemplate->content->msg = $valid->__toString();
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_poll_edit');
        $this->_oTemplate->content->main_content->bAllowChange = $this->_oPoll->AllowChange($iQuestionId)->Value;
        $this->_oTemplate->content->main_content->oPoll = $this->_oPoll->GetResults($iQuestionId)->Value;
        $this->_oTemplate->content->main_content->oPollDetails = $this->_oPoll->FindQuestion($iQuestionId)->Value;
        $this->_oTemplate->content->main_content->oPollAnswers = $this->_oPoll->FindAnswers($iQuestionId)->Value;
        $this->_oTemplate->title = Kohana::lang('poll.admin_poll_edit');
        $this->_oTemplate->render(true);
    }

    /**
     * TODO: błąd, a co jeśli VALUE === false?
     * @param integer $id
     */
    public function delete($iCategoryId = null, $iQuestionId = null, $iPageId = null) {
        $this->authorize('polls', 'delete');

        if (!empty($_POST['polls_check']) && !empty($_POST['category_id'])) {
            $this->_oSession->set('message', $this->_oPoll->DeletePollsArray($_POST['polls_check'])->__toString());
            if (!empty($_POST['page_id'])) {
                url::redirect('4dminix/strona/' . $_POST['page_id']);
            } else {
                url::redirect('4dminix/kategoria_sondy/' . $_POST['category_id']);
            }
        } else if (!empty($iQuestionId)) {
            $this->_oSession->set('message', $this->_oPoll->Delete($iQuestionId)->__toString());
            if (!empty($iPageId)) {
                url::redirect('4dminix/strona/' . $iPageId);
            } else {
                url::redirect('4dminix/kategoria_sondy/' . $iCategoryId);
            }
        } else {
            url::redirect('4dminix/kategoria_sondy/' . $iCategoryId);
        }
    }

    /**
     *
     */
    public function poll($iQuestionId) {
        $iQuestionId += 0;
        $this->_oTemplate->content->main_content = new View('app_poll');
        $this->_oTemplate->content->main_content->oQuestion = $this->_oPoll->FindQuestion($iQuestionId)->Value;
        $this->_oTemplate->content->main_content->oAnswers = $this->_oPoll->FindAnswers($iQuestionId)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iAnswerId
     */
    public function show_results($iQuestionId) {
        if (!empty($_POST['vote']) && $_POST['vote'] + 0 > 0) {
            $this->_oPoll->Vote($_POST['vote']);
        }
        $this->_oTemplate->content->main_content = new View('app/app_poll_results');
        $this->_oTemplate->content->main_content->oQuestion = $this->_oPoll->FindQuestion($iQuestionId)->Value;
        $this->_oTemplate->content->main_content->oAnswers = $this->_oPoll->GetResults($iQuestionId)->Value;
        $this->_oTemplate->render(true);
    }

    // TODO: tutaj to cookie poprawic
    public function add_vote() {
        $idQuestion = $this->_oPoll->Vote($_POST['answer'])->Value;
        cookie::set('olicms_polls_' . $idQuestion, TRUE);
//        $oQuestion = $this->_oPoll->FindQuestion($idQuestion)->Value;
        $oAnswers = $this->_oPoll->GetResults($idQuestion)->Value;
        // $oPoll = $this->_oPoll->GetPollForPage($iPageId)->Value;

        $i = 0;
        foreach ($oAnswers as $p) :
            $aTablica[$i]['answer'] = $p->answer;
            $aTablica[$i]['votes'] = $p->votes;
            $i++;
        endforeach;
        //header('content-type: application/json');
        echo json_encode($aTablica);

        //echo $vPollResult;
        //$this->vPollResult->render(true);
        //echo $this->_oPoll->GenerateLink($idQuestion)->Value;
    }

    public function get_polls_for_lang() {
        $sCategoriesList = $this->_oPoll->GetCategoriesForLang($_POST['lang'])->Value;
        echo $sCategoriesList;
    }

    public function set_active($iCategoryId, $iQuestionId) {
        $this->_oPoll->SetActivePoll($iCategoryId, $iQuestionId);
        url::redirect('4dminix/kategoria_sondy/' . $iCategoryId);
    }

    //        zmienne do widokow gdzie bedzie wypluta sonda
    //        $this->_oTemplate->content->main_content->check = $this->poll->CheckUserStatus()->Value;
    //        $this->_oTemplate->content->main_content->poll = $this->poll->GetActivePoll()->Value;
//
}

?>