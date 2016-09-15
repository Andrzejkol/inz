<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *
 */
class Products_Ajax_Controller extends Controller_Core {
    

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
    public function validate_product_add() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product.product_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
//        if(empty($clean['short_description']) || $clean['short_description'] == '') {
//            $element = $xml->addChild('error', Kohana::lang('product.short_description_required'));
//            $element->addAttribute('id', 'short_description');
//            $element->addAttribute('class', 'error');
//            $counter++;
//        }
        if(empty($clean['description']) || $clean['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product.description_required'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }


    /**
     *
     */
    public function validate_product_edit() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product.product_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
//        if(empty($clean['short_description']) || $clean['short_description'] == '') {
//            $element = $xml->addChild('error', Kohana::lang('product.short_description_required'));
//            $element->addAttribute('id', 'short_description');
//            $element->addAttribute('class', 'error');
//            $counter++;
//        }
        if(empty($clean['description']) || $clean['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('product.description_required'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    /**
     *
     */
     public function get_categories() {
        $aClean = array();
        foreach($_POST as $key => $value) {
            $aClean[$key] = urldecode($value);
        }
        header('Content-type: text/html; charset=utf-8');
        $oProductCategory = new Product_Category_Model();
        $aCategories = $oProductCategory->GetCategoriesAsArray('name', 'pl');
        echo $oProductCategory->GetCategoriesAsOption(0, $aCategories);
    }

     public function wypluj() {
        
        echo ('wyplute');
    }
    /**
     *
     */
    public function search_products() {
        $clean = urldecode($_POST['product_search']);
        header('Content-type: text/html; charset=utf-8');
        $v = new View('search_products_results');
        $oModel = new Product_Model();
        $v->oProducts = $oModel->SearchProducts($clean)->Value;
        echo $v->render(true);
    }

	public function search() {
        //header('Content-type: text/html; charset=utf8');
        $searchTerm = !empty($_GET['term'])?urldecode($_GET['term']):'';
        if(!empty($searchTerm)) {
            $productModel = new Product_Model();
            $result = $productModel->SearchByName($searchTerm);
            $aJSON = array();
            foreach($result as $r) {
                $aJSON[] = array('id' => $r->product_id, 'value' => $r->product_name, 'label' => $r->product_name);
            }
            echo json_encode($aJSON);
        } else {
            echo json_encode(array('id' => 0, 'value' => 0, 'label' => ''));
        }
    }

    /**
     * 
     */
    public function get_parameter_values() {
        $clean['parameter_id'] = urldecode($_POST['parameter_id'])+0;
        if(!empty($_POST['product_id'])) {
            $clean['product_id'] = urldecode($_POST['product_id'])+0;
        }
        header('Content-type: text/html; charset=utf-8');
        $v = new View('admin/parameter_values');
        $oProductModel=new Product_Model();
        $oParameterModel=new Parameter_Model();
        if(!empty($clean['product_id']) && $clean['product_id']>0 && $oProductModel->ParameterValueExists($clean['parameter_id'], $clean['product_id'])->Value) {
            $v->oValues=$oProductModel->GetProductParameterValues($clean['parameter_id'], $clean['product_id'])->Value;
        } else {
            $v->oValues=$oParameterModel->GetParameterValues($clean['parameter_id'])->Value;
        }
        Kohana::log('error', '<pre>'.print_r($v->oValues, true).'</pre>');
        echo $v->render(true);
    }

    /**
     *
     */
    public function get_attribute_values() {
        $clean['attribute_id'] = urldecode($_POST['attribute_id'])+0;
        if(!empty($_POST['product_id'])) {
            $clean['product_id'] = urldecode($_POST['product_id'])+0;
        }
        header('Content-type: text/html; charset=utf-8');
        $v = new View('admin/attribute_values');
        $oProductModel = new Product_Model();
        $oAttributeModel = new Attribute_Model();
        if(!empty($clean['product_id']) && $clean['product_id']>0) {
            $v->oValues = $oProductModel->GetProductAttributeValues($clean['attribute_id'], $clean['product_id'])->Value;
        } else {
            $v->oValues = $oAttributeModel->GetAttributeValues($clean['attribute_id'])->Value;
        }
        echo $v->render(true);
    }
}