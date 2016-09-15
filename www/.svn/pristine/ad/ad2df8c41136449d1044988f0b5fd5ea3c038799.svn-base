<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Contents_Controller extends App_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oLanguage = New Language_Model();
        list($this->_aLang, $lang) = $this->_oLanguage->SetLanguage()->Value;
        Kohana::config_set('locale.language', $this->_aLang);
        $this->_oSite = new Site_Model();
        $this->_oTags = new Tag_Model();
        $this->_oProducer = new Producer_Model();
        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];
//        $this->_oTemplate->content->main_left->vContact = new View('app/elements/box_contact');
//        $this->_oTemplate->content->main_left->vProvider = new View('app/elements/box_provider');
//        $this->_oTemplate->content->main_left->vRecommended = new View('app/elements/box_product_recommended');
//        $this->_oTemplate->content->main_left->vRecommended->oProduct = $this->_oProduct->GetRecommendedProduct()->Value;
//        $this->_oTemplate->content->main_left->vTags = new View('app/elements/box_tags');
//        $this->_oTemplate->content->main_left->vTags->tags = $this->_oTags->GetTags();
//        $this->_oTemplate->content->main_right = new View('app/main_right');
//        $this->_oTemplate->content->main_right->vPromotions = new View('app/elements/box_product_promotions');
//        $this->_oTemplate->content->main_right->vPromotions->oProducts = $this->_oProduct->GetProductPromotions(4)->Value;
//        $this->_oTemplate->content->main_right->vGardeningTips = new View('app/elements/box_gardening_tips');
//        $this->_oTemplate->content->main_right->vGardeningTips->oArticles = $this->_oNews->GetAllNews(1, 5, 0)->Value;
//        $this->_oTemplate->content->main_right->vSecureShopping = new View('app/elements/box_secure_shopping');
        $this->_oTemplate->header->sLoggedAs = Customer_Model::GetLogedInfo();
        $this->_oTemplate->lang = $lang;
        $this->_oTemplate->header->lang = $lang;
        $allProducts = 0;
        foreach ($this->_aCartContent as $allProd) {
            $allProducts += $allProd['count'];
        }
        $this->_oTemplate->header->productsCount = $allProducts;
        $sum = 0.0;
        if (count($this->_aCartContent)) {
            foreach ($this->_aCartContent as $product) {
                $sum += ($product['price'] * $product['count']);
            }
        }
        $this->_oTemplate->header->productsSummary = $sum;
       
      
    }

    public function contents($iPageId) {
        $oContents = $this->_oPage->GetPageContents($iPageId)->Value;
        $oElements = $this->_oPage->GetPageElements($iPageId);
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/contents');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = $oElements[$oContents[0]->element_id][0]->title;
        $this->_oTemplate->content->main_content->vContent->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vContent->vPaginationTop->sTitle = $oElements[$oContents[0]->element_id][0]->title;
        $this->_oTemplate->content->main_content->vContent->oPageContents = $oContents;
        $this->_oTemplate->content->main_content->vContent->oElements = $this->_oPage->GetPageElements($iPageId);

        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function ask_question($iProductId = null) {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/contact');
        $this->_oTemplate->content->main_content->vContent->productId = $iProductId;
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('app.ask_question');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('app.ask_question');

        if (!empty($_POST)) {
            $valid_check = $this->_oSite->ValidateForm($_POST);
            if ($valid_check->Value == true) {
                $this->_oTemplate->content->main_content->vContent->msg = $this->_oSite->SendMessage($_POST)->__toString();
                $_POST = array();
            } else {
                $this->_oTemplate->content->main_content->vContent->msg = $valid_check->__toString();
            }
        }

        $captcha = new Captcha;

        $this->_oTemplate->content->main_content->vContent->captcha = $captcha;
        $this->_oTemplate->content->main_content->vContent->oProductDetails = $this->_oProduct->GetProductDetails($iProductId, $this->_aLang)->Value;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function order_form($iProductId) {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/order_form');
        $this->_oTemplate->content->main_content->vContent->productId = $iProductId;
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('app.order_form');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('app.order_form');
        if (!empty($_POST)) {
            $valid_check = $this->_oSite->ValidateOrderForm($_POST);
            if ($valid_check->Value == true) {
                $this->_oTemplate->content->main_content->vContent->msg = $this->_oSite->SendOrderForm($_POST)->__toString();
                $_POST = array();
            } else {
                $this->_oTemplate->content->main_content->vContent->msg = $valid_check->__toString();
            }
        }
//        $captcha = new Captcha;
//        $this->_oTemplate->content->main_content->vContent->captcha = $captcha;
        $this->_oTemplate->content->main_content->vContent->oProductDetails = $this->_oProduct->GetProductDetails($iProductId, $this->_aLang)->Value;
        $this->_oTemplate->title = Kohana::lang('meta.order_form');
        $this->_oTemplate->render(true);
    }

    public function articles() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/articles');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('app.gardening_tips');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('app.gardening_tips');
        $this->_oTemplate->content->main_content->vContent->oArticles = $this->_oNews->GetAllNews(1)->Value;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function article($iNewsId) {
        $oNews = $this->_oNews->GetNews($iNewsId)->Value;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/article');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = $oNews[0]->title;
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = $oNews[0]->title;
        $this->_oTemplate->content->main_content->vContent->oArticle = $oNews;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function site_map() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/site_map');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('app.site_maps');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('app.site_maps');
        $this->_oTemplate->content->main_content->vContent->oSitemap = $this->_oSite->GenerateSiteMap()->Value;
        $this->_oTemplate->content->main_content->vContent->oProducers = $this->_oProducer->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

}
