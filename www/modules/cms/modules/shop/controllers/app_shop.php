<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Shop_Controller extends App_Controller {

    protected $_oTemplate;
    protected $_oCustomer;
    protected $_oSession;
    protected $_oLanguage;
    protected $_aLang;

    public function __construct() {
        parent::__construct();
        $this->_oSession = Session::instance();

        $this->_oAttribute = new Attribute_Model();
        $this->_oCustomer = new Customer_Model();
        $this->_oDeliveryType = new Delivery_Type_Model();
        $this->_oLanguage = new Language_Model();
        $this->_oOrder = new Order_Model();
        $this->_oOrders = new Order_Model();
        $this->_oPaymentType = new Payment_Type_Model();
        $this->_oProduct = new Product_Model();
        $this->_oProductCategory = new Product_Category_Model();
        $this->_oProductMarks = new Media_Model();
                
        
        $this->_oRebateCode = new Rebate_Code_Model();
        $this->_oSite = new Site_Model();
        $this->_oTags = new Tag_Model();
        $this->_oPage = new Page_Model();

        
        $this->_oTemplate->content->main_left = new View('app/main_left');
        $this->_oTemplate->content->main_left->vCategories = new View('app/elements/categories');
        $this->_oTemplate->content->main_left->vCategories->catlist = $this->_oProductsCategories->GetCategories()->Value;
        
        $this->_oTemplate->content->main_left->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_left->vSearch->oProducers = $this->_oProducer->GetProducers()->Value;
        $this->_oTemplate->content->main_left->vSearch->oParameters = $this->_oParameter->GetParameters()->Value;
        $parametersActiveValues = $this->_oParameter->GetParameterValues()->Value;
        $parameters = array();
        foreach ($parametersActiveValues as $value) {
            $parameters[$value->parameter_id]['id_parameter_value'][] = $value->parameter_id;
            $parameters[$value->parameter_id]['parameter_value'][] = $value->value;
        }
        $this->_oTemplate->content->main_left->vSearch->oParametersValues = $parameters;
        
        $this->_oTemplate->content->content_class_main = 'class="shop_view"';

        // TODO: pobierać to z bazy
        switch ($this->lang):
            case 'pl_PL':
                $iPageId = 17;
                break;
            case 'de_DE':
                $iPageId = 25;
                break;
            case 'en_US':
                $iPageId = 24;
                break;
        endswitch;


        $oPagesTreeForApp = $this->_oPage->GetPagesTreeForApp($this->lang, $iPageId, true);
        $this->_oTemplate->header->oPages = $oPagesTreeForApp;

        switch (uri::segment(1)) {
            case 'en':
                $lang = 'en';
                break;
            default :
                $lang = 'pl';
                break;
        }
        $this->_aLang = Kohana::config('locale.language');
    }

}

?>
