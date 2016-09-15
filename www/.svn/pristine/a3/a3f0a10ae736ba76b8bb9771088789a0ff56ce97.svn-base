<?php defined('SYSPATH') OR die('No direct access allowed.');
class Elements_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    private $_oElement;
    private $_oLanguage;

    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->_oElement = new Element_Model();
        $this->_oLanguage = new Language_Model();
    }

    public function validate_elements_add() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        $_POST = $clean;
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        //tu walidacja
        if(empty($_POST['name_element']) || $_POST['name_element'] == '') {
            $element = $xml->addChild('error', Kohana::lang('elements.error_name_element_empty'));
            $element->addAttribute('id', 'name_element');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['type']) || $_POST['type'] == '') {
            $element = $xml->addChild('error', Kohana::lang('elements.error_elements_empty'));
            $element->addAttribute('id', 'type');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['pageId']) || $_POST['pageId'] == '' || $_POST['pageId'] == 'null' || $_POST['pageId'] == 'undefined') {
            $element = $xml->addChild('error', Kohana::lang('elements.error_pageId_empty'));
            $element->addAttribute('id', 'page_id');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        switch($_POST['type']) {
            case "page_content":
                if(empty($_POST['title']) || $_POST['title'] == '') {
                    $element = $xml->addChild('error', Kohana::lang('page_content.error_title_empty'));
                    $element->addAttribute('id', 'title');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
                if(empty($_POST['content']) || $_POST['content'] == '') {
                    $element = $xml->addChild('error', Kohana::lang('page_content.error_content_empty'));
                    $element->addAttribute('id', 'content');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
                break;


            case "galleries":
                if(empty($_POST['name']) || $_POST['name'] == '') {
                    $element = $xml->addChild('error', Kohana::lang('gallery.error_name_empty'));
                    $element->addAttribute('id', 'name');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
//                if(empty($_POST['langs']) || $_POST['langs'] == '' || $_POST['langs'] == 'null') {
//                    $element = $xml->addChild('error', Kohana::lang('gallery.error_language_empty'));
//                    $element->addAttribute('id', 'langs');
//                    $element->addAttribute('class', 'error');
//                    $counter++;
//                }
                break;


        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();


    }

    // funkcja do wyswitelania odpowiedniego formularza przy dodawaniu elementu (galeria, aktualnosci, newsletter, page content itp)
    public function get_element_form() {
        $type = $_POST['type'];
        switch($type) {
            case 'page_content':
                $view = new View('admin_page_content_add');
                // zmienne
                $view->languages = $this->_oLanguage->GetLanguages()->Value;
                $view->display = true;
                $view->render(true);
                break;
            case 'galleries':
                $view = new View('admin_gallery_add');
                // zmienne
                $view->languages = $this->_oLanguage->GetLanguages()->Value;
                $view->render(true);
                break;
            case 'news': // newsy nie sa potrzebne, dodajemy element a aktualnosci dla niego juz pozniej
                break;
            case 'newsletter':
                break;
        }
    }

    public function element_search() {
        $sElementName = urldecode($_POST['element_search']);
        $this->_oTemplate = new View('admin_elements_list');
        $this->_oTemplate->elements = $this->_oElement->GetElementsWithName($sElementName)->Value;
        $this->_oTemplate->pages_elements = $this->_oElement->GetPagesForElements()->Value;
        $this->_oTemplate->languages = $this->_oLanguage->GetLanguages(true)->Value;
        echo $this->_oTemplate->render(true);
    }


}