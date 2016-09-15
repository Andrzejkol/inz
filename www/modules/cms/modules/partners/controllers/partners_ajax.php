<?php
defined('SYSPATH') OR die('No direct access allowed.');
class Partners_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    private $_oPartners;


    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->partner = new Partner_Model();
        $this->language = new Language_Model();
    }

	public function validate_partner_add() {
        //$_POST = layer::Clean($_POST);
        $counter = 0;
        header('Content-type: text/xml; charset=utf-8');
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if(empty($_POST['name']) || $_POST['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_name_empty'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['description']) || $_POST['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_description_empty'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }
		if(empty($_POST['web_address']) || $_POST['web_address'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_web_address_empty'));
            $element->addAttribute('id', 'web_address');
            $element->addAttribute('class', 'error');
            $counter++;
        }
		if (empty($_POST['photo']) || $_POST['photo'] == ''){
			$element = $xml->addChild('error', Kohana::lang('partners.error_photo_empty'));
            $element->addAttribute('id', 'photo');
            $element->addAttribute('class', 'error');
            $counter++;
		}

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

	public function validate_partner_edit(){
		$counter = 0;
        header('Content-type: text/xml; charset=utf-8');
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);
        //tu walidacja
        if(empty($_POST['name']) || $_POST['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_name_empty'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($_POST['description']) || $_POST['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_description_empty'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }
		if(empty($_POST['web_address']) || $_POST['web_address'] == '') {
            $element = $xml->addChild('error', Kohana::lang('partners.error_web_address_empty'));
            $element->addAttribute('id', 'web_address');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
	}
}

?>
