<?php defined('SYSPATH') OR die('No direct access allowed.');
class Page_content_Model extends Model_Core {

    private $thumbpath;
    private $thumbwidth;
    private $thumbheight;

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->thumbpath = page_content_helper::SMALL_PATH;
        $this->thumbwidth = page_content_helper::THUMBWIDTH;
        $this->thumbheight = page_content_helper::THUMBHEIGHT;

    }

    /**
     *
     * @param Array $data
     * @param Array $files
     * @return ErrorReporting
     */
    public function Insert(Array $post, Array $files = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            $data['title'] = strip_tags($post['title']);
            $data['content'] = $post['content'];
            if(!empty($post['show_title'])) {
                $data['show_title']= $post['show_title'];
            } else {
                $data['show_title']= 'Y';
            }

            $elements['type'] = element_helper::$elements_types_for_switch['page_content'];
            $elements['lang'] = $post['lang'];
            $elements['date_added'] = time();
            $elements['available'] = 1;

            // dodajemy element
            $element_insert = $this->db->insert(table::ELEMENTS,$elements);

            $data['element_id'] = $element_insert->insert_id();
            $pages_elements['element_id'] = $data['element_id'];
            //dodajemy polaczenie ze stronami
            if(is_array($post['page_id'])) {
                foreach($post['page_id'] as $iPId) {
                    $pages_elements['page_id'] = $iPId;
                    $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
                }
            } else {
                $pages_elements['page_id'] = $post['page_id'];
                $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
            }

            // uzupelniamy zawartosc strony
            $insert = $this->db->insert(table::PAGE_CONTENT, $data);
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('page_content.success_insert_page_content'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }

    /*
     * @param Array $data
     * @return ErrorReporting
    */
    public function Update($page_contentID, Array $data) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $post['page_id'] = $data['page_id'];
            if(!empty($data['show_title'])) {
                $data['show_title']= $data['show_title'];
            } else {
                $data['show_title']= 'Y';
            }
            $elements['lang'] = $data['lang'];
            $elements['modified_date'] = time();

            unset($data['back'], $data['save_changes'], $data['page_id'], $data['type_id'], $data['type_name'], $data['lang'], $data['submit'],  $data['submit_back']);

            // update wiadomosci
            $this->db->update(table::PAGE_CONTENT, $data, array('id_page_content' => $page_contentID));

            $result = $this->db->from(table::PAGE_CONTENT)->where(array('id_page_content' => $page_contentID))->get();

            $this->db->update(table::ELEMENTS, $elements, array('id_element'=>$result[0]->element_id));

            $pages_elements['element_id'] = $result[0]->element_id;

            // usuwamy poprzednie polaczenia
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id'=>$pages_elements['element_id']));
            
            // dodajemy polaczenie ze stronami
            if(is_array($post['page_id'])) {
                foreach($post['page_id'] as $iPId) {
                    $pages_elements['page_id'] = $iPId;
                    $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
                }
            } else {
                $pages_elements['page_id'] = $post['page_id'];
                $this->db->insert(table::PAGES_ELEMENTS, $pages_elements);
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('page_content.success_update_page_content'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_update_page_content'));
        }
    }

    /*
     * Zapisywanie zmian zawartości strony przy edycji całej strony.
     * @param Array $aPost
     * @param Array $aFiles
     * @return ErrorReporting
    */
    public function UpdateByElementId(array $aPost) {
        try {
            $data = array();
            $elementId = $aPost['type_id'];
            $data['title'] = $aPost['title'];
            $data['content'] = $aPost['content'];
            $data['element_id'] = $elementId;
            if(!empty($aPost['show_title'])) {
                $data['show_title']= $aPost['show_title'];
            } else {
                $data['show_title']= 'Y';
            }

            // update wiadomosci
            $this->db->update(table::PAGE_CONTENT, $data, array('element_id' => $elementId));

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('page_content.success_update_page_content'));
        }
        catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_update_page_content'));
        }
    }

    public function Delete($elementId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $elementId+=0;

            //usuwamy z page_contents
            $this->db->delete(table::PAGE_CONTENT, array('element_id' => $elementId));

            // usuwamy z pages_elements
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $elementId));

            //usuwamy z elements
            $this->db->delete(table::ELEMENTS, array('id_element' => $elementId));

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('page_content.success_delete_page_content'));
        }
        catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_delete_page_content'));
        }
    }

    public function DeleteArray($aElementsIds) {
        try {
            if(is_array($aElementsIds)) {
                foreach($aElementsIds as $iEI) {
                    $this->Delete($iEI);

                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('page_content.success_delete_page_content'));
            }
            else {
                $aElementsIds+=0;
                return $this->Delete($aElementsIds);
            }
        }
        catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_delete_array'));
        }
    }



    public function GetPageContent($page_contentID) {
        try {
            $results = $this->db->from(table::PAGE_CONTENT)
                    ->join(table::ELEMENTS, table::ELEMENTS.'.id_element', table::PAGE_CONTENT.'.element_id')
                    ->where(array('id_page_content'=>$page_contentID))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('page_content.success_insert_page_content'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }


    /*
     * Pobiera zawartość strony (page content) dla edycji całej strony (pages)
     * @param Integer $iElementId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetPageContentByElementId($iElementId) {
        try {
            $results = $this->db->from(table::PAGE_CONTENT)
                    ->join(table::ELEMENTS, table::ELEMENTS.'.id_element', table::PAGE_CONTENT.'.element_id')
                    ->where(array('element_id'=>$iElementId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('page_content.success_get_page_content_by_element_id'));
        }
        catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_get_page_content_by_element_id'));
        }
    }

    public function GetAllPagesContents($limit = null, $offset = null) {
        try {
            $result = $this->db->from(table::PAGE_CONTENT)
            		->select('*, elements.date_added AS element_date_added')
                    ->join(table::ELEMENTS, table::ELEMENTS.'.id_element', table::PAGE_CONTENT.'.element_id')
                    ->join(table::LANGUAGES, table::LANGUAGES.'.name', table::ELEMENTS.'.lang')
                    ->join(table::PAGES_ELEMENTS, table::ELEMENTS.'.id_element', table::PAGES_ELEMENTS.'.element_id')
                    ->join(table::PAGES, table::PAGES_ELEMENTS.'.page_id', table::PAGES.'.id_page');                    
            
            if(isset($limit) && isset($offset)){
                $result = $result
                        ->limit($limit, $offset);
            }
            
            if(!empty($_GET['content_orderby'])) {
            		switch ($_GET['content_orderby']) {
                		case 1:
                			$result = $result->orderby(array('title' => 'ASC'));
                    	break;
                		case 2:
                			$result = $result->orderby(array('title' => 'DESC'));
                    	break;
                    	case 3:
                			$result = $result->orderby(array('name_page' => 'ASC'));
                    	break;
                    	case 4:
                			$result = $result->orderby(array('name_page' => 'DESC'));
                    	break;
                    	case 5:
                			$result = $result->orderby(array('description' => 'ASC'));
                    	break;
                    	case 6:
                			$result = $result->orderby(array('description' => 'DESC'));
                    	break;
                    	case 7:
                			$result = $result->orderby(array('element_date_added' => 'ASC'));
                    	break;
                    	case 8:
                			$result = $result->orderby(array('element_date_added' => 'DESC'));
                    	break;
                    	
                		}	
                    }
            else {
                  	$result = $result->orderby(array('name'=>'ASC', 'title'=>'ASC'));
            }
            
            $result = $result->get();
            
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('page_content.success_insert_page_content'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }

    public function ValidatePageContent($post) {
        // pole tytul (title) i tresc (description) nie moga byc puste i musi byc wybrana strona
        if(empty($post['title'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_title_empty'));
        }
        else if(empty($post['content'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_content_empty'));
        }
        else if(empty($post['page_id'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_page_id_empty'));
        }
        else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }


    /*
     * Walidacja zawartości strony przy edycji całej strony (pages)
     * // pole tytul (title) i tresc (description) nie moga byc puste
     * @param Array $aData
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ValidatePageContentByElementId($aData) {
        
        //if(empty($aData['title'][$aData['type_id']])) {
        if(empty($aData['title'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_title_empty'));
        }
        else if(empty($aData['content'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_content_empty'));
        }
        else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }
}
?>