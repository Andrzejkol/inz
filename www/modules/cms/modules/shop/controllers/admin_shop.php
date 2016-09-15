<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Shop_Controller extends Admin_Controller {

    protected $_oOrder;
    protected $_oProduct;
    protected $_oProductCategory;
    protected $_oUser;
    protected $_oCurrencies;
    protected $_lang;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        list($this->_lang, $lang) = $this->_oLanguage->SetLanguage()->Value;

        //obiekty
        $this->_oOrder = new Order_Model();
        $this->_oProduct = new Product_Model();
        $this->_oProductCategory = new Product_Category_Model();
        $this->_oUser = new User_Model();
        $this->_oAttribute = new Attribute_Model();
        $this->_oLanguage = new Language_Model();
        $this->_oCurrencies = new Currencies_Model();

        //przypisania zmiennych
        $this->_oTemplate->header->hover = 'shop';
    }

}
