<?php defined('SYSPATH') OR die('No direct access allowed.');

class App_Products_Categories_Controller extends App_Shop_Controller {

    private $_oUser;
    private $_acl;
    private $_aLang;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;


    public function __construct() {
        parent::__construct();
        list($this->_aLang, $lang) = $this->_oLanguage->SetLanguage()->Value;
        Kohana::config_set('locale.language', $this->_aLang);
        parent::__construct();
        $this->_oSite = new Site_Model();
        $this->_oPageContent = new Page_content_Model();
        $this->_oTags = new Tag_Model();
        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];
        $this->_oTemplate->content->main_left = new View('app/main_left');
        /*$this->_oTemplate->content->main_left->vContact = new View('app/elements/box_contact');
        $this->_oTemplate->content->main_left->vProvider = new View('app/elements/box_provider');
        $this->_oTemplate->content->main_left->vRecommended = new View('app/elements/box_product_recommended');
        $this->_oTemplate->content->main_left->vRecommended->oProduct = $this->_oProduct->GetRecommendedProduct()->Value;
        $this->_oTemplate->content->main_left->vTags = new View('app/elements/box_tags');
        $this->_oTemplate->content->main_left->vTags->tags = $this->_oTags->GetTags();
        $this->_oTemplate->content->main_right = new View('app/main_right');
        $this->_oTemplate->content->main_right->vPromotions = new View('app/elements/box_product_promotions');
        $this->_oTemplate->content->main_right->vPromotions->oProducts = $this->_oProduct->GetProductPromotions(4)->Value;
        $this->_oTemplate->content->main_right->vGardeningTips = new View('app/elements/box_gardening_tips');
        $this->_oTemplate->content->main_right->vGardeningTips->oArticles = $this->_oNews->GetAllNews(1, 5, 0)->Value;
        $this->_oTemplate->content->main_right->vSecureShopping = new View('app/elements/box_secure_shopping');
         
         */
        $this->_oTemplate->header->sLoggedAs = Customer_Model::GetLogedInfo();
        
        $this->_oTemplate->footer = new View('app/footer');
        $this->_oTemplate->lang = $lang;
        $this->_oTemplate->header->lang = $lang;
        $allProducts = 0;
        foreach($this->_aCartContent as $allProd) {
            $allProducts += $allProd['count'];
        }
        $this->_oTemplate->header->productsCount = $allProducts;
        $sum = 0.0;
        if(count($this->_aCartContent)) {
            foreach($this->_aCartContent as $product) {
                $sum += ($product['price']*$product['count']);
            }
        }
        $this->_oTemplate->header->productsSummary = $sum;
    }

    public function listing() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        if(!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vProductCategoryListing = new View('app/elements/product_category_listing');
        $this->_oTemplate->content->main_content->vProductCategoryListing->oProductsCategories = $this->_oProductCategory->GetMainCategories()->Value;
        $this->_oTemplate->content->main_content->vProductCategoryListing->aProductsSubCategories = $this->_oProductCategory->GetSubCategoriesForMainCategories(3)->Value;
//        $pagination = layer::GetPagination($this->_oProduct->Count()->Value);

//        $pagination = layer::GetPagination($this->_oProduct->Count()->Value);
//        $this->_oTemplate->content->main_content->oProducts = $this->_oProduct->GetProductListing($perpage, $pagination->sql_offset)->Value;
//        $oCategoryDetails = $this->_oCategory->GetCategoryDetails()->Value[0];
//        $this->_oTemplate->content->main_content->oCategoryDetails = $oCategoryDetails;
//        $this->_oTemplate->content->main_content->pagination = $pagination;

        $this->_oTemplate->title = '';
        $this->_oTemplate->description = 'XXX (listing)';
        $this->_oTemplate->keywords = 'YYY (listing)';
        $this->_oTemplate->render(true);
    }


}