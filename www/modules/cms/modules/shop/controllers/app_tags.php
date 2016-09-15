<?php defined('SYSPATH') OR die('No direct access allowed.');
class App_Tags_Controller extends App_Shop_Controller {

    const ALLOW_PRODUCTION = TRUE;

    public function  __construct() {
        parent::__construct();
        $this->_oSite = new Site_Model();
        $this->_oPage = new Page_Model();
        $this->_oNews = new News_Model();
        $this->_oTags = new Tag_Model();
        $this->_oPageContent = new Page_content_Model();
        $this->_oProductCategory = new Product_Category_Model();
        $this->_oProduct = new Product_Model();
        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];
        $this->_oTemplate = new View('app/template');
        $this->_oTemplate->header = new View('app/header');
        $this->_oTemplate->content = new View('app/main');
        $this->_oTemplate->content->main_left = new View('app/main_left');
        $this->_oTemplate->content->main_left->vContact= new View('app/elements/box_contact');
        $this->_oTemplate->content->main_left->vProvider = new View('app/elements/box_provider');
        $this->_oTemplate->content->main_left->vTags = new View('app/elements/box_tags');
        $this->_oTemplate->content->main_left->vTags->tags = $this->_oTags->GetTags();
        $this->_oTemplate->content->main_right = new View('app/main_right');
        $this->_oTemplate->content->main_right->oArticles = $this->_oNews->GetAllNews(1, 5, 0)->Value;
        $this->_oTemplate->content->main_right->vSecureShopping = new View('app/elements/box_secure_shopping');
        $this->_oTemplate->content->main_right->vPromotions = new View('app/elements/box_product_promotions');
        $this->_oTemplate->content->main_right->vPromotions->oProducts = $this->_oProduct->GetProductPromotions(4)->Value;
        $this->_oTemplate->content->main_right->vGardeningTips = new View('app/elements/box_gardening_tips');
        $this->_oTemplate->content->main_right->vGardeningTips->oArticles = $this->_oNews->GetAllNews(1, 5, 0)->Value;
        $this->_oTemplate->header->sLoggedAs = Customer_Model::GetLogedInfo();
        $this->_oTemplate->footer = new View('app/footer');
        $this->_oTemplate->header->menu_select = 0;

        if(!empty($_COOKIE['language'])) {
            $this->lang = $_COOKIE['language'];
            $language = explode('_', $this->lang);
            $lang = $language[0];
        }
        else {
            $this->lang = 'pl_PL';
            $lang = 'pl';
        }
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

    public function listing($iTagId) {
        $this->_oTemplate->content->main_content = new View('app/main_content');
//        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
//        $this->_oTemplate->content->main_content->vBreadcrumbs->oCats = $this->_oProductCategory->GetParentCategories($iCategoryId)->Value;
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = 'Produkty z tagiem';
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        $oCount = $this->_oTags->GetProductsWithTags($iTagId, true)->Value;
        if(!empty($oCount[0]->count)) {
            $iTotalItems = $oCount[0]->count;
        }
        else {
            $iTotalItems = 0;
        }

        $iLimit = Product_Model::PRODUCTS_LIMIT;

        //$pagination = layer::GetPagination($iTotalItems, false, $iLimit);
        $pagination = new Pagination(array(
                //'base_url'    => 'news_ajax/get_news_table/', // base_url will default to current uri
                        'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
                        'total_items'    => $iTotalItems, // use db count query here of course
                        'items_per_page' => $iLimit, // it may be handy to set defaults for stuff like this in config/pagination.php
                        'style'          => 'pagg', // pick one from: classic (default), digg, extended, punbb, or add your own!
                        'auto_hide'      => TRUE,
        ));
//        var_dump($this->_oTags->GetProductsWithTags($iTagId)->Value);
//        exit();
        $this->_oTemplate->content->main_content->vProductListing->oProducts = $this->_oProduct->GetProductListing(array('id_tag_dict' => $iTagId))->Value;
        $this->_oTemplate->content->main_content->vPaginationBottom = new View('app/elements/pagination_bottom');
        $this->_oTemplate->content->main_content->vPaginationTop->pagination = $pagination;
        $this->_oTemplate->content->main_content->vPaginationBottom->pagination = $pagination;



        $this->_oTemplate->title = Kohana::lang('product.products_index');
        $this->_oTemplate->description = 'XXX (listing)';
        $this->_oTemplate->keywords = 'YYY (listing)';
        $this->_oTemplate->render(true);
    }


}