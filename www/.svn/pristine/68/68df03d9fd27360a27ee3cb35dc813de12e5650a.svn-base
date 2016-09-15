<?php defined('SYSPATH') OR die('No direct access allowed.');
class Page_content_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->_oPageContent = new Page_content_Model();
    }

    public function validate_page_content_add() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
		$defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
		$xml = new SimpleXMLElement($defString);

        //tu walidacja
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
        if(empty($_POST['page_id']) || $_POST['page_id'] == '' || $_POST['page_id'] == 'null') {
			$element = $xml->addChild('error', Kohana::lang('page_content.error_page_id_empty'));
			$element->addAttribute('id', 'page_id');
            $element->addAttribute('class', 'error');
			$counter++;
		}

		$xml->addAttribute('counter', $counter);
		echo $xml->asXML();

    }

    }