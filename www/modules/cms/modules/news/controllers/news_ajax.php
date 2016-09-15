<?php defined('SYSPATH') OR die('No direct access allowed.');
class News_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    private $_oNews;


    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->news = new News_Model();
        $this->_oNews = new News_Model();
        $this->language = new Language_Model();
    }

    public function validate_news_category_add() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if(empty($_POST['title']) || $_POST['title'] == '') {
            $element = $xml->addChild('error', Kohana::lang('news.error_news_category_title_empty'));
            $element->addAttribute('id', 'title');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['lang']) || $_POST['lang'] == '') {
            $element = $xml->addChild('error', Kohana::lang('news.error_language_empty'));
            $element->addAttribute('id', 'lang');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['page_id']) || $_POST['page_id'] == '' || $_POST['page_id'] == 'null') {
            $element = $xml->addChild('error', Kohana::lang('news.error_news_category_pages_empty'));
            $element->addAttribute('id', 'page_id');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function validate_news_add() {
        //$_POST = layer::Clean($_POST);
        $counter = 0;
        header('Content-type: text/xml; charset=utf-8');
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if(empty($_POST['title']) || $_POST['title'] == '') {
            $element = $xml->addChild('error', Kohana::lang('news.error_title_empty'));
            $element->addAttribute('id', 'title');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['news_categories']) || $_POST['news_categories'] == '' || $_POST['news_categories'] == 'null') {
            $element = $xml->addChild('error', Kohana::lang('news.error_news_categories_empty'));
            $element->addAttribute('id', 'news_categories');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['description']) || $_POST['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('news.error_description_empty'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['lang']) || $_POST['lang'] == '') {
            $element = $xml->addChild('error', Kohana::lang('news.error_language_empty'));
            $element->addAttribute('id', 'lang');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(!empty($_POST['news_start_date']) && !empty($_POST['news_end_date'])) {
            $start_date = layer::DateToInt($_POST['news_start_date']);
            $end_date = layer::DateToInt($_POST['news_end_date']);
            if($start_date>$end_date) {
                $element = $xml->addChild('error', Kohana::lang('news.error_news_start_date_bigger_than_end_date'));
                $element->addAttribute('id', 'news_start_date');
                $element->addAttribute('class', 'error');
                $counter++;
            }
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function delete_news_image() {
        echo $this->news->AjaxDeleteImages($_POST);
    }

    public function get_form_edit() {

        $editID = $_POST['id'];

        $idNews = explode('_', $editID);
        $newsId = end($idNews);

        $view = new View('admin_news_edit');
        $view->news = $this->news->GetNews($newsId)->Value;
        $view->languages = $this->language->GetLanguages()->Value;
        $view->render(true);


    }

    public function get_news_categories_for_lang() {
        $lang = $_POST['lang'];
        $result = $this->_oNews->GetNewsCategoriesForLang($lang)->Value;
        echo $result;
    }



    public function get_news_table($elementId = null) {
        // obiekty do modeli
        $this->language = new Language_Model();

        //widoki
        $this->main_content = new View('admin_news_table');

        // zmienne do widokow
		$oCategory = $this->news->GetNewsCategoryForElement($elementId)->Value;
		$count = $this->news->CountNewsForCategory($oCategory[0]->id_news_category)->Value;
//        $count = $this->news->NewsCount($elementId)->Value;


        $pagination = new Pagination(array(
                        'base_url'    => 'news_ajax/get_news_table/'.$elementId.'/', // base_url will default to current uri
                        'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
                        'total_items'    => $count, // $news->count(), // use db count query here of course
                        'items_per_page' => news_helper::PER_PAGE, // it may be handy to set defaults for stuff like this in config/pagination.php
                        'style'          => 'default_ajax' // pick one from: classic (default), digg, extended, punbb, or add your own!
        ));

        $this->main_content->pagination = $pagination;
        $this->main_content->news = $this->news->GetAllNews($oCategory[0]->id_news_category, $pagination->items_per_page, $pagination->sql_offset )->Value;
        $this->main_content->languages = $this->language->GetLanguages()->Value;
		$this->main_content->iCategoryId = $oCategory[0]->id_news_category;
        $this->main_content->render(true);
    }
    
    
    public function change_status() {
        if(!isset($_GET['id_news'])){
            return;
        }
        
        $id_news = intval($_GET['id_news']);
        $db = new Database();
        $result = $db->select('available')
                ->from(table::NEWS)
                ->where('id_news', $id_news)
                ->get();
        
        if(isset($result[0])){
            if($result[0]->available == '1'){
                $status = '0';
            }
            else{
                $status = '1';
            }
            $db->update(table::NEWS, array('available' => $status), array('id_news' => $id_news));
            echo $status; return;
        }
        else{
            return;
        }
    }
}
