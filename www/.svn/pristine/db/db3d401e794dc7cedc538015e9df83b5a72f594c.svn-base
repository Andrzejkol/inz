<?php defined('SYSPATH') OR die('No direct access allowed.');
class Galleries_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
    }

    public function validate_gallery_add() {
        $_POST = layer::Clean($_POST);
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        //tu walidacja
        if(empty($_POST['name']) || $_POST['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('gallery.error_name_empty'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['langs']) || $_POST['langs'] == '' || $_POST['langs'] == 'null') {
            $element = $xml->addChild('error', Kohana::lang('gallery.error_language_empty'));
            $element->addAttribute('id', 'langs');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if(empty($_POST['page_id']) || $_POST['page_id'] == '' || $_POST['page_id'] == 'null') {
            $element = $xml->addChild('error', Kohana::lang('gallery.error_page_id_empty'));
            $element->addAttribute('id', 'page_id');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

} 