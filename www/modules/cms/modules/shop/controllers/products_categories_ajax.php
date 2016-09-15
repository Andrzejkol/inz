<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *
 */
class Products_Categories_Ajax_Controller extends Controller_Core {
    

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     */
    public function validate_product_category_add() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product_category.product_category_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    /**
     *
     */
    public function validate_product_category_edit() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product_category.product_category_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function search_categories() {
        $clean = urldecode($_POST['category_search']);
        header('Content-type: text/html; charset=utf-8');
        $v = new View('search_category_results');
        $oModel = new Product_Category_Model();
        $v->oProductsCategories = $oModel->SearchCategories($clean)->Value;
        echo $v->render(true);
    }
}