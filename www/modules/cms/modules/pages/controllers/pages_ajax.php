<?php defined('SYSPATH') OR die('No direct access allowed.');
class Pages_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    private $_oPage;

    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->news = new News_Model();
        $this->_oPage = new Page_Model();
        
    }

    public function validate_pages_add() {
        //$_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
		$defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
		$xml = new SimpleXMLElement($defString);

        //tu walidacja
		if(empty($_POST['name_page']) || $_POST['name_page'] == '') {
			$element = $xml->addChild('error', Kohana::lang('pages.error_name_page_empty'));
			$element->addAttribute('id', 'name_page');
            $element->addAttribute('class', 'error');
			$counter++;
		}
        if(empty($_POST['lang']) || $_POST['lang'] == '') {
			$element = $xml->addChild('error', Kohana::lang('news.error_lang_empty'));
			$element->addAttribute('id', 'lang');
            $element->addAttribute('class', 'error');
			$counter++;
		}

		$xml->addAttribute('counter', $counter);
		echo $xml->asXML();


    }

    public function delete_news_image() {
        echo $this->news->AjaxDeleteImages($_POST);
    }

    public function get_parent_pages_for_lang() {
        $lang = $_POST['lang'];

        $result = $this->_oPage->GetPagesForLang($lang)->Value;
        echo $result;
    }

    public function get_pages_for_lang() {
        $_POST = layer::Clean($_POST);
        $sLang = $_POST['lang'];
        $result = $this->_oPage->GetPagesForLang($sLang, true)->Value;
        echo $result;
    }
    
    public function get_brands_pages_for_lang() {
        $lang = $_POST['lang'];

        $result = $this->_oPage->GetBrandsPagesForLang($lang)->Value;
        echo $result;
    }


    public function get_brand_image($pageId) {
        $pageId+=0;
        $result = $this->_oPage->GetPageIcon($pageId)->Value;
        echo $result;
    }

    public function page_search() {
        $_POST = layer::Clean($_POST);

        $this->_oTemplate = new View('admin_pages_list');
        $this->_oTemplate->pages = $this->_oPage->GetPagesWithName($_POST['page_search'], $_POST['language'])->Value;
        echo $this->_oTemplate->render(true);
    }

    
    public function change_status() {
        if(!isset($_GET['id_page'])){
            return;
        }
        
        $id_page = intval($_GET['id_page']);
        $db = new Database();
        $result = $db->select('available')
                ->from(table::PAGES)
                ->where('id_page', $id_page)
                ->get();
        
        if(isset($result[0])){
            if($result[0]->available == 'Y'){
                $status = 'N';
            }
            else{
                $status = 'Y';
            }
            $db->update(table::PAGES, array('available' => $status), array('id_page' => $id_page));
            echo $status; return;
        }
        else{
            return;
        }
    }

    public function change_homepage() {
        if(!isset($_GET['id_page'])){
            return;
        }
        
        $id_page = intval($_GET['id_page']);
        
        $return = $this->_oPage->SwitchHomepage($id_page);
        echo $return;
        
    }

}