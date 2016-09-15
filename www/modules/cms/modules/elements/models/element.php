<?php defined('SYSPATH') OR die('No direct access allowed.');
class Element_Model extends Model_Core {
    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->_oPageContent = new Page_content_Model();
        $this->gallery = new Gallery_Model();
        $this->news = new News_Model();
    }

    /**
     *
     * @param Array $data
     * @return ErrorReporting
     */
    public function Insert(Array $post) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            // dane elementu
            $data['name_element'] = $post['name_element'];
            $data['type'] = $post['type'];

            $result = $this->db->insert(table::ELEMENTS, $data); // dodajemy element

            $elementId = $result->insert_id();

            $pages_elements = array();
            $pages_elements['element_id'] = $elementId;

            foreach($post['page_id'] as $pi) { // dodajemy powiazania elementu ze stronami
                $pages_elements['page_id'] = $pi;
                $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
            }

            $this->db->query('COMMIT');

            return new ErrorReporting(ErrorReporting::SUCCESS, $elementId, Kohana::lang('elements.success_insert_elements'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_insert_elements'));
        }
    }

    public function AddElement(Array $post) {
        try {

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            // sprawdzamy czy dane elementu są poprawne
            $valid_check = $this->ValidateElements($post);
            if($valid_check->Value===true) {
                $elementId = $this->Insert($post)->Value; // dodajemy element
                $post['element_id'] = $elementId;
            }
            else {
                return new ErrorReporting(ErrorReporting::ERROR, false, $valid_check->Message); // blad z inserta
            }

            // w zaleznosci od wybranego typu obsluga
            switch($post['type']) {
                case element_helper::$elements_types_for_switch['page_content']:
                //validacja
                    $valid_check = $this->_oPageContent->ValidatePageContent($post);
                    if($valid_check->Value===true) {
                        $result = $this->_oPageContent->Insert($post);
                        $this->db->query('COMMIT');
                        return new ErrorReporting(ErrorReporting::SUCCESS, true, $result->Message); // Dodano page content
                    }
                    else {
                        return new ErrorReporting(ErrorReporting::ERROR, false, $valid_check->Message); // blad z inserta dla page content
                    }
                    break;
                case element_helper::$elements_types_for_switch['galleries']:
                // walidacja
                    $valid_check = $this->gallery->ValidateAddGallery($post);
                    if($valid_check->Value===true) {
                        $result = $this->gallery->Insert($post);
                        $this->db->query('COMMIT');
                        return new ErrorReporting(ErrorReporting::SUCCESS, true, $result->Message); // blad z inserta dla page content
                    }
                    else {
                        return new ErrorReporting(ErrorReporting::ERROR, false, $valid_check->Message); // blad z inserta dla page content
                    }
                    break;
                case element_helper::$elements_types_for_switch['news']:

                    break;
                case element_helper::$elements_types_for_switch['newsletter']:
                    break;
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('elements.success_add_element'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            // TODO: jesli blad to wywalamy obrazek jesli zostal wrzucony
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_add_element'));
        }
    }

    /*
     * @param Array $data
     * @return ErrorReporting
    */
    public function Update($elementID, Array $data) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            $page_id = $data['page_id'];
            unset($data['back'], $data['save_changes'], $data['page_id']);

            $result = $this->db->update(table::ELEMENTS, $data, array('id_element' => $elementID));

            $pages_elements = array();

            $this->db->delete(table::PAGES_ELEMENTS, array('element_id'=>$elementID));

            foreach($page_id as $pi) {
                $pages_elements['element_id'] = $elementID;
                $pages_elements['page_id'] = $pi;
                $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
            }


            $this->db->query('COMMIT');

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('elements.success_update_elements'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            // TODO: jesli blad to wywalamy obrazek jesli zostal wrzucony
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_update_elements'));
        }
    }
    public function Delete($elementId) {
        try {
            $elementId += 0;
            $result = $this->db->from(table::ELEMENTS)->where(array('id_element' => $elementId))->get();

            if($result->count()>0) {
                $elementType = $result[0]->type;

                // usuwamy dane elementu
                $this->db->delete(table::ELEMENTS, array('id_element' => $elementId));
                // usuwamy powiazania elementu ze stronami
                $this->db->delete(table::PAGES_ELEMENTS, array('element_id'=>$elementId));
                //usuwamy szczegolowe dane w zaleznosci od typu(page_content, galerie)
                switch($elementType) {
                    case element_helper::$elements_types_for_switch['page_content']:
                        $this->_oPageContent->Delete($elementId);
                        break;
                    case element_helper::$elements_types_for_switch['galleries']:
                        $this->gallery->DeleteGallery($elementId);
                        break;
                    case element_helper::$elements_types_for_switch['news']:
                        $this->news->DeleteNews($elementId);
                        break;
                }

                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('elements.success_delete_elements'));
            }
            else {
                return new ErrorReporting(ErrorReporting::INFO, true, Kohana::lang('elements.info_delete_elements'));
            }
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_delete_elements'));
        }
    }

    /*
     * Pobiera strony do selecta (galleries.php add_gallery)
     * @param String $lang
     * @return ErrorReporting (Array $pages || Bool false)
     */
    public function GetPages($lang = null) {
        try {
            $this->db->from(table::PAGES);
            if(!empty($lang)) {
                $this->db->where(array('lang'=>$lang));
            }
            $results = $this->db->get();
            $pages = array();
            foreach($results as $result) {
                $pages[$result->id_page] = $result->name_page;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $pages, Kohana::lang('user.get_pages_success'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function GetLangForPage($elementId) {
        try {
            $result = $this->db->from(table::PAGES)
                    ->join(table::PAGES_ELEMENTS, table::PAGES_ELEMENTS.'.page_id', table::PAGES.'.id_page')
                    ->select('lang')->where('element_id', $elementId)->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->lang, Kohana::lang('pages.success_GetLangForPage'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_GetLangForPage'));
        }
    }

    public function GetSelectedPages($elementId) {
        try {
            $results = $this->db->from(table::PAGES_ELEMENTS)->where(array('element_id'=>$elementId))
                    ->get();
            $pages = array();
            //$pages[0] = 'wybierz';
            foreach($results as $result) {
                $pages[] = $result->page_id;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $pages, Kohana::lang('pages.success_insert_news'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }



    public function GetElement($elementID) {
        try {
            $results = $this->db->from(table::ELEMENTS)
                    //->join(TABLE::PAGES_ELEMENTS, TABLE::PAGES_ELEMENTS.'.element_id', TABLE::ELEMENTS.'.id_element')
                    ->where(array('id_element'=>$elementID))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('elements.success_insert_elements'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_insert_elements'));
        }
    }
    public function GetAllElements() {
        try {
            $result = $this->db->from(table::ELEMENTS)
                    //->join(TABLE::PAGES_ELEMENTS, TABLE::PAGES_ELEMENTS.'.element_id', TABLE::ELEMENTS.'.id_element')
                    //->join(TABLE::PAGES, TABLE::PAGES.'.id_page', TABLE::PAGES_ELEMENTS.'.page_id' )
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('elements.success_insert_elements'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_insert_elements'));
        }
    }
    public function GetPagesForElements() {
        try {
            $result = $this->db->from(TABLE::PAGES_ELEMENTS)
                    ->join(TABLE::PAGES, TABLE::PAGES.'.id_page', TABLE::PAGES_ELEMENTS.'.page_id' )
                    ->get();

            $pages_elements = array();
            foreach($result as $res) {
                $pages_elements[$res->element_id][] = $res->name_page;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $pages_elements, Kohana::lang('elements.success_insert_elements'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_insert_elements'));
        }
    }

    public function ValidateElements($data) {
        // pole tytul (title) i tresc (description) nie moga byc puste
        if(empty($data['name_element'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_name_element_empty'));
        }
        else if(empty($data['type'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_type_empty'));
        }
        else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function GetElementsWithName($sElementName) {
        try {
            $result = $this->db->from(table::ELEMENTS)
                    ->like('name_element', $sElementName)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('elements.success_GetElementsWithName'));
        }
        catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('elements.error_GetElementsWithName'));
        }
    }

}
?>